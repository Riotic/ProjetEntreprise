<?php

namespace App\Http\Controllers;

use App\Models\Synthstue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\User;
use App\Helper\Helper;
use App\Models\notification;
use Illuminate\Support\Facades\Auth;
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

class SynthstueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Synthstue $synthstues)
    {
        if (Gate::allows('isFormatriceOrAdmin')) {
	    $synthstues = Synthstue::orderBy('created_at', 'desc')->paginate(8);
	    return view('synthstues.index', compact('synthstues'));
        } else {
            abort(403, 'Unauthorized action.');
        }
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
            return view('synthstues.create');
        } else {
            abort(403, 'Unauthorized action.');
        }
    }

    public function createWithID($id)
    {
        //
        if (Gate::allows('isFormatriceOrAdmin')) {
            return view('synthstues.create_id');
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
            $destinationCV = public_path('TuE_CV/'.$request->CV);
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
            $file->move(public_path('TuE_CV/'), $filenameCV);
            // $request->file('CV') -> storeAs('TuE_CV', $filenameCV, [ 'disk' => 'TuE_CV']);

            // storing path on the BDD
            $validated['CV'] =$filenameCV;

        }
        if($request->hasfile('photoProfil'))
        {
            $destinationCV = public_path('TuE_profil_pictures/'.$request->CV);
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
            $file->move(public_path('TuE_profil_pictures/'), $filenamePDP);
            // storing path on the BDD
            $validated['photoProfil']=$filenamePDP;
        }
        $synthstue = Synthstue::create($validated);
        $synth_id = $synthstue->id;
        // dd($synth_id);
        $data = "--".Auth::user()->id."--".$validated["nom"]." ".$validated["prenom"]."--".$validated["email"]."---none";
        $userToModify = User::find($id);
        // $state = DB::table('users')->where('id', $id)->update('id_synthese', $synth_id);
        $userToModify['id_synthese'] = $synth_id;
        $userToModify->save();

        // dd($state);
        DB::insert('insert into notifications ( type,notifiable_type,notifiable_id,data,read_at,created_at) values (?, ?,?,?,?,?)', ['creation','Création de Synthèse TUE',Auth::user()->id,$data,date('Y-m-d H:i:s'),date('Y-m-d H:i:s')]);

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

        return redirect()->route('synthstues.show' , ['synthstue' => $synthstue->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Synthstue $synthstue)
    {
	if (Auth::user()) {
		$client = User::find($synthstue->client_id);
		$user = Auth::user();
        	if ($user){
	            return view('synthstues.show', [
                	'synthstue' => $synthstue,
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
    public function edit(Synthstue $synthstue)
    {

        if (Auth::user()) {
        $user = Auth::user();
        if ($user->can('update', $synthstue)){
        $id_tue = DB::SELECT("SELECT id FROM `users` where email='".$synthstue->email."' ");
        foreach ($id_tue as $keys ) {
            $id_tue = $keys->id;
        }
        $idd = DB::SELECT("SELECT thread_id FROM `messenger_participants` where user_id='".$id_tue."'");
        foreach ($idd as $key ) {
            $ids = $key->thread_id;
        }

        try {
            $thread = Thread::findOrFail($ids);
        } catch (ModelNotFoundException $e) {
            Session::flash('error_message', 'The thread with ID: ' . $ids . ' was not found.');

            return redirect()->route('messages');
        }

        $userId = Auth::id();
        $users = User::whereNotIn('id', $thread->participantsUserIds($userId))->get();

        $thread->markAsRead($userId);

            return view('synthstues.edit', compact('thread', 'users','synthstue'));
        } else {
            abort(403, 'Unauthorized action.');
        }
        }else {
            return view('auth.error');
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Synthstue $synthstue)
    {

        $synthstue->metier=$request['metier'];
        $synthstue->adresse=$request['adresse'];
        $synthstue->telephone=$request['telephone'];
        $synthstue->website=$request['website'];
        $synthstue->instagram=$request['instagram'];
        $synthstue->twitter=$request['twitter'];
        $synthstue->facebook=$request['facebook'];
        $synthstue->linkedin=$request['linkedin'];
        $synthstue->reseau_autre=$request['reseau_autre'];
        $synthstue->experiences=$request['experiences'];
        $synthstue->formations=$request['formations'];
        $synthstue->departement=$request['departement'];
        $synthstue->synthese=$request['synthese'];
        if($request->hasfile('CV'))
        {
            $destinationCV = public_path('TuE_CV/'.$synthstue->CV);
            if(File::exists($destinationCV))
            {
                File::delete($destinationCV);
            }
            $file = $request->file('CV');
            //recovering initial pic_name
            $prenomNomCV = $synthstue["prenom"] . $synthstue["nom"] . "_CV";
            $filenameCV= $prenomNomCV . "." . $request->file('CV') ->getClientOriginalExtension() ;

            $file->move(public_path('TuE_CV/'), $filenameCV);

            $synthstue->CV =$filenameCV;

        }
        if($request->hasfile('photoProfil'))
        {
            $destinationCV = public_path('TuE_profil_pictures/'.$synthstue->photoProfil);
            if(File::exists($destinationCV))
            {
                File::delete($destinationCV);
            }
            $file = $request->file('photoProfil');
            //recovering initial pic_name
            $prenomNomPDP = $synthstue["prenom"] . $synthstue["nom"]  . "_PDP";
            $filenamePDP= $prenomNomPDP . "." . $request->file('photoProfil') ->getClientOriginalExtension();
            // $filenameCV=date("Y-m-d_H:i:s") . $filenameCV;
            // upload folder in a folder and adding dateTime for avoid name mismatch
            $file->move(public_path('TuE_profil_pictures/'), $filenamePDP);
            // storing path on the BDD
            $synthstue->photoProfil=$filenamePDP;

        }
        $user = Auth::user();
	if ($user->can('update', $synthstue)){
            $synthstue->update();
            return redirect()->route('synthstues.show' , ['synthstue' => $synthstue->id])->with('status', 'Mise à jour réussi');
        } else {
            abort(403, 'Unauthorized');
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Synthstue $synthstue)
    {
        $id = $synthstue['user_id'];
        //recovering path of the old picture
        $pathCV = public_path('TuE_CV/'.$synthstue->CV);
        //checking if old picture is already in this directory if yes deleting the picture
        if(file_exists($pathCV))
        {
            unlink($pathCV);
        }
        //recovering path of the old picture
        $pathPDP = public_path('TuE_profil_pictures/'.$synthstue->photoProfil);
        //checking if old picture is already in this directory if yes deleting the picture
        if(file_exists($pathPDP))
        {
            unlink($pathPDP);
        }

        $user = Auth::user();
        if ($user->can('delete', $synthstue)){
            $synthstue->delete();
            $synthstues = DB::table('synthstues')->where('user_id', '=', $id)->get();
            // récupére les données de la table produits
            return view('synthstues.index', [
                'synthstues' => $synthstues
            ]);
        } else {
            abort(403, 'Unauthorized');
        }
    }

    public function init_tue(Request $request)
    {
        if (Auth::user()) {
            $id = Auth::user()->id;
            $user = User::create([
                'name' => $request->name,
                'surname' => $request->surname,
                'role' => 'tue',
                'id_creator' =>  $id,
		        'PDPuser' => $request->PDPuser,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'organisme' => $request->organisme,
                'civilite' => $request->civilite,
            ]);
            $data = "--".Auth::user()->id."--Créateur : ".Auth::user()->name." ".Auth::user()->surname."--".Auth::user()->email."--Compte Crée :".$request->name." ".$request->surname."--".$request->email."---".Auth::user()->id;

            DB::insert('insert into notifications ( type,notifiable_type,notifiable_id,data,read_at,created_at) values (?, ?,?,?,?,?)', ['mail','Création de compte TUE',Auth::user()->id,$data,date('Y-m-d H:i:s'),date('Y-m-d H:i:s')]);
            if ($user) {

                $dates=explode(" - ",$request->dates);
                $do_at_one = date('Y-M-d', strtotime($dates[0]));
                $do_at_two = date('Y-M-d', strtotime($dates[0] . ' +1 day'));
                $do_at_three = date('Y-M-d', strtotime($dates[0] . ' +2 day'));
                $do_at_four =  date('Y-M-d', strtotime($dates[1]));
                DB::insert('insert into sign ( id_user,id_creator,do_at_one,do_at_two,do_at_three,do_at_four) values (?,?,?,?,?,?)', [$user->id,$id,$do_at_one,$do_at_two,$do_at_three,$do_at_four]);

                return redirect('/synthstues/create/'.$user->id.'')->with('user', $user);
            } else {
                return view('auth.error');
            }

        }else {
            return view('auth.error');
        }
    }


    public function search(Request $request, Synthstue $synthstues)
    {
        if (Auth::user()->role == 'admin'){
            $search = DB::select(" (SELECT  id, prenom, nom, type, metier, photoProfil FROM synthstues WHERE  prenom LIKE '%" . $request['query'] . "%' OR nom LIKE '%" .  $request['query'] ."%') UNION (SELECT id, prenom, nom, type, metier, photoProfil FROM synthstues WHERE  prenom LIKE '%" . $request['query'] . "%' OR nom LIKE '%" .  $request['query'] ."%')");
        }else {
            $search = DB::select(" (SELECT  id, prenom, nom, type, metier, photoProfil FROM synthstues WHERE  user_id ='". $request['user_id'] ."' AND (prenom LIKE '%" . $request['query'] . "%' OR nom LIKE '%" .  $request['query'] ."%')) UNION (SELECT id, prenom, nom, type, metier, photoProfil FROM synthstues WHERE  user_id ='". $request['user_id'] ."' AND (prenom LIKE '%" . $request['query'] . "%' OR nom LIKE '%" .  $request['query'] ."%'))");
        }
        //return json_encode($search);
        return view('dashboard.search', ['search' => $search]);
    }
// hiqsetheqsihtqpetpiqheptihqsethqptihqisthpqithqithpiehtpqth
    public function search_tue(Request $request)
    {
       if(Auth::user()->role == 'admin'){
        if($request->ajax()){

            $output="";
            if (Auth::user()) {
                $id = Auth::user()->id;
            }
            $search_tue = User::where('id','LIKE','%'.$request->search."%")
                                       ->Orwhere('name','LIKE','%'.$request->search."%")
                                       ->Orwhere('surname','LIKE','%'.$request->search."%")
                                       ->Orwhere('email','LIKE','%'.$request->search."%")
                                       ->get();

            if(count($search_tue) > 0){

               foreach ($search_tue as  $row) {

                    $output.='<tr>'.

                    '<td>'.'<span class="col-green">'.$row->id. '</span> </td>'.

                    '<td>'.
                        '<b>'.$row->name.'</b>'.
                    '</td>'.

                    '<td>'.$row->surname.'</td>'.

                    '<td>'.'<span class="text-muted">'.$row->email.'</span>'.'</td>'.

                    '<td>'.
                        '<a href="/synthstues/create/'.$row->id.'" class="btn btn-primary waves-effect waves-float waves-green">'.'<i class="bi bi-brush">'.'</i>'.' Créer la synthèse</a>'.
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
       }else{
            if($request->ajax()){

            $output="";
            if (Auth::user()) {
                $id = Auth::user()->id;
            }
            $search_tue = User::where('id','LIKE','%'.$request->search."%")
                                       ->Orwhere('name','LIKE','%'.$request->search."%")
                                       ->Orwhere('surname','LIKE','%'.$request->search."%")
                                       ->Orwhere('email','LIKE','%'.$request->search."%")
                                       ->get();

            if(count($search_tue) > 0){

               foreach ($search_tue as  $row) {
                   if ((($row->id_creator) == $id) && (($row->id_synthese) == "none") && (($row->role) == "tue")) {
                       $output.='<tr>'.

                       '<td>'.'<span class="col-green">'.$row->id. '</span> </td>'.

                       '<td>'.
                          '<b>'.$row->name.'</b>'.
                       '</td>'.

                       '<td>'.$row->surname.'</td>'.

                       '<td>'.'<span class="text-muted">'.$row->email.'</span>'.'</td>'.

                       '<td>'.
                          '<a href="/synthstues/create/'.$row->id.'" class="btn btn-primary waves-effect waves-float waves-green">'.'<i class="bi bi-brush">'.'</i>'.' Créer la synthèse</a>'.
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

    public function ma_synthes_tue()
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

                return view('synthstues.synthstues', compact('thread', 'userss'));
            } else {
                return view('auth.error');
            }

        }else {
            return view('auth.error');
        }


    }


    public function synthstues_create($id)
    {
        return view('synthstues.create_id', ['id' => $id]);
    }
}
