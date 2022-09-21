<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\File;
use App\Models\User;
use App\Helper\Helper;
use App\Models\notification;
use Illuminate\Support\Facades\Auth;
use App\Models\Synthstuc;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Nullable;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Cmgmyr\Messenger\Models\Message;
use Cmgmyr\Messenger\Models\Participant;
use Cmgmyr\Messenger\Models\Thread;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class SynthstucController extends Controller
{
    // public function __construct()
    // {
    //     $this->authorizeResource(Synthstuc::class, 'Synthstuc');
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Synthstuc $synthstucs)
    {
        if (Gate::allows('isFormatriceOrAdmin')) {
	    $synthstucs = Synthstuc::orderBy('created_at', 'desc')->paginate(8);
	    return view('synthstucs.index', compact('synthstucs'));
        } else {
            abort(403, 'Unauthorized action.');
        }
    }


    public function showSynth($id1, $id2)
    {
        $synthstut = DB::select()
        ->where('id', '=', $id1)
        ->where('user_id', '=', $id2)
        ->get();
        return view('synthstuts.show', [
            'synthstut' => $synthstut
        ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
	if (Gate::allows('isFormatriceOrAdmin')) {
            return view('synthstucs.create');
        } else {
            abort(403, 'Unauthorized action.');
        }
    }

    public function createWithID($id)
    {
        //
        if (Gate::allows('isFormatriceOrAdmin')) {
            return view('synthstucs.create_id');
        } else {
            abort(403, 'Unauthorized action.');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeWithId(Request $request, $id)
    {
        $validated = $request->validate([
            'photoProfil' => 'nullable',
            'CV' => 'nullable',
            'nom' => 'required|max:255',
            'prenom' => 'required|max:1000',
            'metier' => 'required|max:1000',
            'adresse' => 'nullable',
            'telephone' => 'nullable',
            'email' => 'required',
            'website' => 'nullable',
	        'instagram' => 'nullable',
            'twitter' => 'nullable',
            'facebook' => 'nullable',
            'linkedin' => 'nullable',
            'reseau_autre' => 'nullable',
            'formations' => 'nullable',
            'experiences' => 'nullable',
            'departement'=> 'nullable',
            'synthese'=> 'nullable'
        ]);

        $validated['user_id']= Auth::user()->id;
        $validated['client_id']= $id;

	if($request->hasfile('CV'))
        {
            $destinationCV = public_path('TuC_CV/'.$request->CV);
            if(File::exists($destinationCV))
            {
                File::delete($destinationCV);
            }
            $file = $request->file('CV');
            //recovering initial pic_name
            $prenomNomCV = $request["prenom"] . $request["nom"] . "_CV";
            $filenameCV= $prenomNomCV . "." . $request->file('CV') ->getClientOriginalExtension() ;
            // $filenameCV=date("Y-m-d_H:i:s") . $filenameCV;
            // upload folder in a folder and adding dateTime for avoid name mismatch
            $file->move(public_path('TuC_CV/'), $filenameCV);
            // $request->file('CV') -> storeAs('TuC_CV', $filenameCV, [ 'disk' => 'TuC_CV']);

            // storing path on the BDD
            $validated['CV'] =$filenameCV;

        }
        if($request->hasfile('photoProfil'))
        {
            $destinationCV = public_path('TuC_profil_pictures/'.$request->CV);
            if(File::exists($destinationCV))
            {
                File::delete($destinationCV);
            }
            $file = $request->file('photoProfil');
            //recovering initial pic_name
            $prenomNomPDP = $request["prenom"] . $request["nom"]  . "_PDP";
            $filenamePDP= $prenomNomPDP . "." . $request->file('photoProfil') ->getClientOriginalExtension();
            // $filenameCV=date("Y-m-d_H:i:s") . $filenameCV;
            // upload folder in a folder and adding dateTime for avoid name mismatch
            $file->move(public_path('TuC_profil_pictures/'), $filenamePDP);
            // storing path on the BDD
            $validated['photoProfil']=$filenamePDP;
        }
        $synthstuc = Synthstuc::create($validated);
        $synth_id = $synthstuc->id;
        // dd($synth_id);
        $data = "--".Auth::user()->id."--".$validated["nom"]." ".$validated["prenom"]."--".$validated["email"]."---none";
        $userToModify = User::find($id);
        // $state = DB::table('users')->where('id', $id)->update('id_synthese', $synth_id);
        $userToModify['id_synthese'] = $synth_id;
        $userToModify->save();

        // dd($state);
        DB::insert('insert into notifications ( type,notifiable_type,notifiable_id,data,read_at,created_at) values (?, ?,?,?,?,?)', ['creation','Création de Synthèse TUC',Auth::user()->id,$data,date('Y-m-d H:i:s'),date('Y-m-d H:i:s')]);

        // donne un titre au thread qui fait sens
        $titleThread = 'Messagerie '.$userToModify['name'].' '.$userToModify['surname'].'-'.Auth::user()->name.' '.Auth::user()->surname;
        $thread = Thread::create([
            'subject' => $titleThread,
        ]);

        // Message
        Message::create([
            'thread_id' => $thread->id,
            'user_id' => Auth::id(),
            'body' => 'Demandez moi des modifications pour votre synthèse via cette messagerie',
        ]);

        // Sender
        Participant::create([
            'thread_id' => $thread->id,
            'user_id' => Auth::id(),
            'last_read' => new Carbon(),
        ]);

        $thread->addParticipant($validated['client_id']);
        switch ($request->input('action')) {
            case 'create':
                return redirect()->route('synthstucs.show' , ['synthstuc' => $synthstuc->id]);
                break;

            case 'save':
                return redirect()->route('synthstucs.edit' , ['synthstuc' => $synthstuc->id]);
                break;
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Synthstuc $synthstuc)
    {
	if (Auth::user()) {
		$client = User::find($synthstuc->client_id);
		$user = Auth::user();
        	if ($user){
	            return view('synthstucs.show', [
                	'synthstuc' => $synthstuc,
			'client' => $client
            	]);
        	} else {
            	abort(403, 'Unauthorized action.');
        	}
        }else {
            return view('auth.error');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Synthstuc $synthstuc)
    {

        if (Auth::user()) {
        $user = Auth::user();
        if ($user->can('update', $synthstuc)){
        $id_tuc = DB::SELECT("SELECT id FROM `users` where email='".$synthstuc->email."' ");
        foreach ($id_tuc as $keys ) {
            $id_tuc = $keys->id;
        }
        $idd = DB::SELECT("SELECT thread_id FROM `messenger_participants` where user_id='".$id_tuc."'");
        foreach ($idd as $key ) {
            $ids = $key->thread_id;
        }

        try {
            $thread = Thread::findOrFail($ids);
        } catch (ModelNotFoundException $e) {
            Session::flash('error_message', 'The thread with ID: ' . $ids . ' was not found.');

            return redirect()->route('messages');
        }

        // show current user in list if not a current participant
        // $users = User::whereNotIn('id', $thread->participantsUserIds())->get();

        // don't show the current user in list
        $userId = Auth::id();
        $users = User::whereNotIn('id', $thread->participantsUserIds($userId))->get();

        $thread->markAsRead($userId);


            return view('synthstucs.edit', compact('thread', 'users','synthstuc'));
            //return view('synthstucs.edit', ['synthstuc' => $synthstuc]);*/
        } else {
            abort(403, 'Unauthorized action.');
        }
        }else {
            return view('auth.error');
        }
        //return view('synthstucs.edit', ['synthstuc' => $synthstuc]);*/

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Synthstuc $synthstuc)
    {
        // $prenomNomPDP = $request["prenom"] . $request["nom"] . "_PDP";
        // $filenamePDP= $prenomNomPDP . "." . $request->file('photoProfil') ->getClientOriginalExtension() ;

        $synthstuc->metier=$request['metier'];
        $synthstuc->adresse=$request['adresse'];
        $synthstuc->telephone=$request['telephone'];
        $synthstuc->website=$request['website'];
        $synthstuc->instagram=$request['instagram'];
        $synthstuc->twitter=$request['twitter'];
        $synthstuc->facebook=$request['facebook'];
        $synthstuc->linkedin=$request['linkedin'];
        $synthstuc->reseau_autre=$request['reseau_autre'];
        $synthstuc->experiences=$request['experiences'];
        $synthstuc->formations=$request['formations'];
        $synthstuc->departement=$request['departement'];
        $synthstuc->synthese=$request['synthese'];
        if($request->hasfile('CV'))
        {
            $destinationCV = public_path('TuC_CV/'.$synthstuc->CV);
            if(File::exists($destinationCV))
            {
                File::delete($destinationCV);
            }
            $file = $request->file('CV');
            //recovering initial pic_name
            $prenomNomCV = $synthstuc["prenom"] . $synthstuc["nom"] . "_CV";
            $filenameCV= $prenomNomCV . "." . $request->file('CV') ->getClientOriginalExtension() ;
            // $filenameCV=date("Y-m-d_H:i:s") . $filenameCV;
            // upload folder in a folder and adding dateTime for avoid name mismatch
            $file->move(public_path('TuC_CV/'), $filenameCV);
            // $request->file('CV') -> storeAs('TuC_CV', $filenameCV, [ 'disk' => 'TuC_CV']);

            // storing path on the BDD
            $synthstuc->CV =$filenameCV;

        }
        if($request->hasfile('photoProfil'))
        {
            $destinationCV = public_path('TuC_profil_pictures/'.$synthstuc->CV);
            if(File::exists($destinationCV))
            {
                File::delete($destinationCV);
            }
            $file = $request->file('photoProfil');
            //recovering initial pic_name
            $prenomNomPDP = $synthstuc["prenom"] . $synthstuc["nom"]  . "_PDP";
            $filenamePDP= $prenomNomPDP . "." . $request->file('photoProfil') ->getClientOriginalExtension();
            // $filenameCV=date("Y-m-d_H:i:s") . $filenameCV;
            // upload folder in a folder and adding dateTime for avoid name mismatch
            $file->move(public_path('TuC_profil_pictures/'), $filenamePDP);
            // storing path on the BDD
            $synthstuc->photoProfil=$filenamePDP;

        }
        $user = Auth::user();
        switch ($request->input('action')) {
            case 'edit':
                if ($user->can('update', $synthstuc)){
                    $synthstuc->update();
                    return redirect()->route('synthstucs.show' , ['synthstuc' => $synthstuc->id])->with('status', 'Mise à jour réussi');
                } else {
                    abort(403, 'Unauthorized');
                }
            case 'save':
                if ($user->can('update', $synthstuc)){
                    $synthstuc->update();
                    return redirect()->route('synthstucs.edit' , ['synthstuc' => $synthstuc->id])->with('status', 'Mise à jour réussi');
                } else {
                    abort(403, 'Unauthorized');
                }
                break;
        }

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Synthstuc $synthstuc)
    {
        $id = $synthstuc['user_id'];
        //recovering path of the old picture
        $pathCV = public_path('TuC_CV/'.$synthstuc->CV);
        //checking if old picture is already in this directory if yes deleting the picture
        if(file_exists($pathCV))
        {
            unlink($pathCV);
        }
        //recovering path of the old picture
        $pathPDP = public_path('TuC_profil_pictures/'.$synthstuc->photoProfil);
        //checking if old picture is already in this directory if yes deleting the picture
        if(file_exists($pathPDP))
        {
            unlink($pathPDP);
        }
        /*$synthstuc->delete();
        $synthstucs = DB::table('synthstucs')->where('user_id', '=', $id)->get();
        // récupére les données de la table produits
        return view('synthstucs.index', [
            'synthstucs' => $synthstucs
        ]);*/
        $user = Auth::user();
	if ($user->can('delete', $synthstuc)){
            $synthstuc->delete();
            if (Auth::user()->role == 'formatrice'){$synthstucs = DB::table('synthstucs')->where('user_id', '=', $id)->paginate(8);}
            else{ $synthstucs = Synthstuc::orderBy('created_at', 'desc')->paginate(8); }
            // récupére les données de la table produits
            return view('synthstucs.index', compact('synthstucs'));
        } else {
            abort(403, 'Unauthorized');
        }
    }

    public function init_tuc(Request $request)
    {
        if (Auth::user()) {
            $id = Auth::user()->id;
            $user = User::create([
                'name' => $request->name,
                'surname' => $request->surname,
                'role' => 'tuc',
                'id_creator' =>  $id,
		'PDPuser' => $request->PDPuser,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'organisme' => $request->organisme,
                'civilite' => $request->civilite,
            ]);
            $data = "--".Auth::user()->id."--Créateur : ".Auth::user()->name." ".Auth::user()->surname."--".Auth::user()->email."--Compte Crée :".$request->name." ".$request->surname."--".$request->email."---".Auth::user()->id;

            DB::insert('insert into notifications ( type,notifiable_type,notifiable_id,data,read_at,created_at) values (?, ?,?,?,?,?)', ['mail','Création de compte TUC',Auth::user()->id,$data,date('Y-m-d H:i:s'),date('Y-m-d H:i:s')]);
            if ($user) {

                $dates=explode(" - ",$request->dates);
                $do_at_one = date('Y-M-d', strtotime($dates[0]));
                $do_at_two = date('Y-M-d', strtotime($dates[0] . ' +1 day'));
                $do_at_three = date('Y-M-d', strtotime($dates[0] . ' +2 day'));
                $do_at_four =  date('Y-M-d', strtotime($dates[1]));
                DB::insert('insert into sign ( id_user,id_creator,do_at_one,do_at_two,do_at_three,do_at_four) values (?,?,?,?,?,?)', [$user->id,$id,$do_at_one,$do_at_two,$do_at_three,$do_at_four]);

                return redirect('/synthstucs/create/'.$user->id.'')->with('user', $user);
            } else {
                return view('auth.error');
            }

        }else {
            return view('auth.error');
        }
    }


    public function search(Request $request, Synthstuc $synthstucs)
    {
	if (Auth::user()->role == 'admin'){
            $search = DB::select(" (SELECT  id, prenom, nom, type, metier, photoProfil FROM synthstuts WHERE  prenom LIKE '%" . $request['query'] . "%' OR nom LIKE '%" .  $request['query'] ."%') UNION (SELECT id, prenom, nom, type, metier, photoProfil FROM synthstucs WHERE  prenom LIKE '%" . $request['query'] . "%' OR nom LIKE '%" .  $request['query'] ."%')");
        }else {
            $search = DB::select(" (SELECT  id, prenom, nom, type, metier, photoProfil FROM synthstuts WHERE  user_id ='". $request['user_id'] ."' AND (prenom LIKE '%" . $request['query'] . "%' OR nom LIKE '%" .  $request['query'] ."%')) UNION (SELECT id, prenom, nom, type, metier, photoProfil FROM synthstucs WHERE  user_id ='". $request['user_id'] ."' AND (prenom LIKE '%" . $request['query'] . "%' OR nom LIKE '%" .  $request['query'] ."%'))");
        }
        //return json_encode($search);
        return view('dashboard.search', ['search' => $search]);
    }

    public function search_tuc(Request $request)
    {

       if($request->ajax()){

         $output="";
         if (Auth::user()) {
             $id = Auth::user()->id;
         }
         $search_tuc = User::where('id','LIKE','%'.$request->search."%")
                                    ->Orwhere('name','LIKE','%'.$request->search."%")
                                    ->Orwhere('surname','LIKE','%'.$request->search."%")
                                    ->Orwhere('email','LIKE','%'.$request->search."%")
                                    ->get();

         if(count($search_tuc) > 0){

            foreach ($search_tuc as  $row) {
                if ((($row->id_creator) == $id) && (($row->id_synthese) == "none") && (($row->role) == "tuc")) {
                    $output.='<tr>'.

                    '<td>'.'<span class="col-green">'.$row->id. '</span> </td>'.

                    '<td>'.
                       '<b>'.$row->name.'</b>'.
                    '</td>'.

                    '<td>'.$row->surname.'</td>'.

                    '<td>'.'<span class="text-muted">'.$row->email.'</span>'.'</td>'.

                    '<td>'.
                       '<a href="/synthstucs/create/'.$row->id.'" class="btn btn-primary waves-effect waves-float waves-green">'.'<i class="bi bi-brush">'.'</i>'.' Créer la synthèse</a>'.
                    '</td>'.

                    '</td>'.

                    '</tr>';
                }
            }
            return $output;

         }else {
            return $output ='<div class="col-md-12 alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-octagon me-1"></i>
            Aucune information n a été trouvée.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        }

       }

    }

    public function search_log(Request $request)
    {

       if($request->ajax()){

         $output="";
         if (Auth::user()) {
             $id = Auth::user()->id;
         }
         $search_log = notification::where('id','LIKE','%'.$request->search."%")
                                    ->Orwhere('type','LIKE','%'.$request->search."%")
                                    ->Orwhere('notifiable_type','LIKE','%'.$request->search."%")
                                    ->Orwhere('data','LIKE','%'.$request->search."%")
                                    ->get();

         if(count($search_log) > 0){

            foreach ($search_log as  $row) {
                $output.='<tr>'.

                '<td>'.'<span class="col-green">'.date('l jS \of F Y h:i:s A', strtotime($row->read_at)). '</span> </td>'.

                '<td>'.
                    '<b>'.$row->type.'</b>'.
                '</td>'.

                '<td>'.$row->notifiable_type.'</td>'.

                '<td>'.'<span class="text-muted">'.$row->data.'</span>'.'</td>'.

                '<td>'.
                    '<a href="/pdf/'.$row->id.'" class="btn btn-primary waves-effect waves-float waves-green">'.'<i class="bi bi-brush">'.'</i>'.' Exporter en PDF</a>'.
                '</td>'.

                '</td>'.

                '</tr>';
            }
            return $output;

         }else {
            return $output ='<div class="col-md-12 alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-octagon me-1"></i>
            Aucune information n a été trouvée.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        }

       }

    }

    public function ma_synthes_tuc()
    {
        if (Auth::user()) {
            $idd = DB::SELECT("SELECT thread_id FROM `messenger_participants` where user_id='".Auth::user()->id."'");

            if ($idd) {
                foreach ($idd as $key ) {
                    $ids = $key->thread_id;
                }
                try {
                    $thread = Thread::findOrFail($ids);
                } catch (ModelNotFoundException $e) {
                    Session::flash('error_message', 'The thread with ID: ' . $ids . ' was not found.');

                    return redirect()->route('messages');
                }

                // show current user in list if not a current participant
                // $users = User::whereNotIn('id', $thread->participantsUserIds())->get();

                // don't show the current user in list
                $userId = Auth::id();
                $userss = User::whereNotIn('id', $thread->participantsUserIds($userId))->get();

                $thread->markAsRead($userId);

                return view('synthstucs.synthstucs', compact('thread', 'userss'));
            } else {
                return view('auth.error');
            }

        }else {
            return view('auth.error');
        }


    }


    public function synthstucs_create($id)
    {
        return view('synthstucs.create_id', ['id' => $id]);
    }


}
