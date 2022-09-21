<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use App\Models\Synthstut;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Cmgmyr\Messenger\Models\Message;
use Cmgmyr\Messenger\Models\Participant;
use Cmgmyr\Messenger\Models\Thread;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;



class SynthstutController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Synthstut $synthstuts)
    {
	if (Gate::allows('isFormatriceOrAdmin')) {
            $synthstuts = Synthstut::orderBy('created_at', 'desc')->paginate(8);
            // récupére les données de la table produits
            return view('synthstuts.index', compact('synthstuts'));
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
        //return view('synthstuts.create');
        if (Gate::allows('isFormatriceOrAdmin')) {
            return view('synthstuts.create');
        } else {
            abort(403, 'Unauthorized action.');
        }
    }

    public function createWithID($id)
    {
        //return view('synthstuts.create_id');
        if (Gate::allows('isFormatriceOrAdmin')) {
            return view('synthstuts.create_id');
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
    public function storeWithID(Request $request, $id)
    {

	$validated = $request->validate([
            'photoProfil' => 'nullable',
            'photoCouverture' => 'nullable',
            'photoCarrousel1' => 'nullable',
            'photoCarrousel2' => 'nullable',
            'photoCarrousel3' => 'nullable',
            'prenom' => 'required|max:255',
            'nom' => 'required|max:1000',
            'metier' => 'required|max:1000',
            'adresse' => 'nullable',
            'adresseBis' => 'nullable',
            'telephone' => 'nullable',
            'email' => 'required',
            'website' => 'nullable',
	        'instagram' => 'nullable',
            'twitter' => 'nullable',
            'linkedin' => 'nullable',
            'facebook' => 'nullable',
            'youtube' => 'nullable',
            'horaire' => 'nullable',
            'motsClefs' => 'nullable',
            'departement'=> 'nullable',
            'citation' => 'nullable',
            'synthese'=> 'nullable'
        ]);

        $validated['user_id']= Auth::user()->id;
        $validated['client_id']= $id;

        if($request->hasFile('photoProfil')){
            $destinationPDP = public_path('TuT_profil_pictures/'.$request->photoProfil);
            if(File::exists($destinationPDP))
            {
                File::delete($destinationPDP);
            }
            $file = $request->file('photoProfil');
            $prenomNomPDP = $request["prenom"] . $request["nom"] . "_PDP";
            $filenamePDP= $prenomNomPDP . "." . $request->file('photoProfil') ->getClientOriginalExtension() ;
            $file->move(public_path('TuT_profil_pictures/'), $filenamePDP);
            $validated['photoProfil']=$filenamePDP;
        };

        if($request->hasFile('photoCouverture')){
            $destinationCV = public_path('TuT_wallpaper/'.$request->photoCouverture);
            if(File::exists($destinationCV))
            {
                File::delete($destinationCV);
            }
            $file = $request->file('photoCouverture');
            $prenomNomPDC = $request["prenom"] . $request["nom"] . "_PDC";
            $filenamePDC= $prenomNomPDC . "." . $request->file('photoCouverture') ->getClientOriginalExtension() ;
            $file->move(public_path('TuT_wallpaper/'), $filenamePDC);
            $validated['photoCouverture']=$filenamePDC;
        };

        if($request->hasFile('photoCarrousel1')){
            $destinationCV = public_path('TuT_carrousel'.$request->photoCarrousel1);
            if(File::exists($destinationCV))
            {
                File::delete($destinationCV);
            }
            $file = $request->file('photoCarrousel1');
            $prenomNomPCar1 = $request["prenom"] . $request["nom"] . "_PCar1";
            $filenamePCar1 = $prenomNomPCar1 . "." . $request->file('photoCarrousel1') ->getClientOriginalExtension() ;
            $file->move(public_path('TuT_carrousel'), $filenamePCar1);
            $validated['photoCarrousel1']=$filenamePCar1;
        };

        if($request->hasFile('photoCarrousel2')){
            $destinationCV = public_path('TuT_carrousel'.$request->photoCarrousel2);
            if(File::exists($destinationCV))
            {
                File::delete($destinationCV);
            }
            $file = $request->file('photoCarrousel2');
            $prenomNomPCar2 = $request["prenom"] . $request["nom"] . "_PCar2";
            $filenamePCar2 = $prenomNomPCar2 . "." . $request->file('photoCarrousel2') ->getClientOriginalExtension() ;
            $file->move(public_path('TuT_carrousel'), $filenamePCar2);
            $validated['photoCarrousel2']=$filenamePCar2;
        };


        if($request->hasFile('photoCarrousel3')){
            $destinationCV = public_path('TuT_carrousel'.$request->photoCarrousel3);
            if(File::exists($destinationCV))
            {
                File::delete($destinationCV);
            }
            $file = $request->file('photoCarrousel3');
            $prenomNomPCar3 = $request["prenom"] . $request["nom"] . "_PCar3";
            $filenamePCar3 = $prenomNomPCar3 . "." . $request->file('photoCarrousel3') ->getClientOriginalExtension() ;
            $file->move(public_path('TuT_carrousel'), $filenamePCar3);
            $validated['photoCarrousel3']=$filenamePCar3;
        };

        $data = "--".Auth::user()->id."--".$validated["nom"]." ".$validated["prenom"]."--".$validated["email"]."---none";
        DB::insert('insert into notifications ( type,notifiable_type,notifiable_id,data,read_at,created_at) values (?, ?,?,?,?,?)', ['creation','Création de Synthèse TUT',Auth::user()->id,$data,date('Y-m-d H:i:s'),date('Y-m-d H:i:s')]);


        $titleThread = 'Messagerie '.$validated["nom"].' '.$validated["prenom"].'-'.Auth::user()->name.' '.Auth::user()->surname;
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
	    $validated['motsClefs'] = $validated['motsClefs'].", therapeute";
        $synthstut = Synthstut::create($validated);
        $synth_id = $synthstut->id;
        $userToModify = User::find($id);
        // $state = DB::table('users')->where('id', $id)->update('id_synthese', $synth_id);
        $userToModify['id_synthese'] = $synth_id;
        $userToModify->save();
        switch ($request->input('action')) {
            case 'create':
                return redirect()->route('synthstuts.show' , ['synthstut' => $synthstut->id]);
                break;

            case 'save':
                return redirect()->route('synthstuts.edit' , ['synthstut' => $synthstut->id]);
                break;
        }


    }




    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Synthstut $synthstut)
    {

        /*return view('synthstuts.show', [
            'synthstut' => $synthstut
        ]);*/
	$user = Auth::user();
        if ($user->can('view', $synthstut)){
	    $client = User::find($synthstut->client_id);
            return view('synthstuts.show', [
                'synthstut' => $synthstut,
		'client' => $client,
            ]);
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Synthstut $synthstut)
    {

        if (Auth::user()) {
        $id_tuc = DB::SELECT("SELECT id FROM `users` where id_synthese='".$synthstut->id."' ");
        //$id_tuc = DB::SELECT("SELECT id FROM `users` where email='".$synthstut->email."' ");
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

        $userId = Auth::id();
        $users = User::whereNotIn('id', $thread->participantsUserIds($userId))->get();

        $thread->markAsRead($userId);

        return view('synthstuts.edit', compact('thread', 'users','synthstut'));
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
    public function update(Request $request, Synthstut $synthstut)
    {

        $synthstut->metier=$request['metier'];
        $synthstut->adresse=$request['adresse'];
        $synthstut->adresseBis=$request['adresseBis'];
        $synthstut->telephone=$request['telephone'];
        $synthstut->email=$request['email'];
        $synthstut->website=$request['website'];
	    $synthstut->instagram=$request['instagram'];
        $synthstut->twitter=$request['twitter'];
        $synthstut->linkedin=$request['linkedin'];
        $synthstut->facebook=$request['facebook'];
        $synthstut->youtube=$request['youtube'];
        $synthstut->horaire=$request['horaire'];
        $synthstut->motsClefs=$request['motsClefs'];
        $synthstut->departement=$request['departement'];
        $synthstut->citation=$request['citation'];
        $synthstut->synthese=$request['synthese'];
        if($request->hasfile('photoProfil'))
        {
	    $destinationPDP = public_path('TuT_profil_pictures/'.$synthstut->photoProfil);
            if(File::exists($destinationPDP))
            {
                File::delete($destinationPDP);
            }
            $file = $request->file('photoProfil');
            //recovering initial pic_name
            $prenomNomPDP = $synthstut["prenom"] . $synthstut["nom"] . "_PDP";
            $filenamePDP= $prenomNomPDP . "." . $request->file('photoProfil') ->getClientOriginalExtension() ;
	    $file->move(public_path('TuT_profil_pictures/'), $filenamePDP);
            $synthstut->photoProfil =$filenamePDP;
        };
        if($request->hasfile('photoCouverture'))
        {
	    $destinationPC = public_path('TuT_wallpaper/'.$synthstut->photoCouverture);
            if(File::exists($destinationPC))
            {
                File::delete($destinationPC);
            }
            $file = $request->file('photoCouverture');
            //recovering initial pic_name
            $prenomNomPC = $synthstut["prenom"] . $synthstut["nom"] . "_PC";
            $filenamePC= $prenomNomPC . "." . $request->file('photoCouverture') ->getClientOriginalExtension() ;
	    $file->move(public_path('TuT_wallpaper/'), $filenamePC);
            $synthstut->photoCouverture =$filenamePC;
        };
        if($request->hasfile('photoCarrousel1'))
        {
	    $destinationPC = public_path('TuT_carrousel/'.$synthstut->photoCarrousel1);
            if(File::exists($destinationPC))
            {
                File::delete($destinationPC);
            }
            $file = $request->file('photoCarrousel1');
            //recovering initial pic_name
            $prenomNomPC = $synthstut["prenom"] . $synthstut["nom"] . "_PC1";
            $filenamePC= $prenomNomPC . "." . $request->file('photoCarrousel1') ->getClientOriginalExtension() ;
	    $file->move(public_path('TuT_carrousel/'), $filenamePC);
            $synthstut->photoCarrousel1 =$filenamePC;
        };
        if($request->hasfile('photoCarrousel2'))
        {
            $destinationPC = public_path('TuT_carrousel/'.$synthstut->photoCarrousel2);
            if(File::exists($destinationPC))
            {
                File::delete($destinationPC);
            }
            $file = $request->file('photoCarrousel2');
            //recovering initial pic_name
            $prenomNomPC = $synthstut["prenom"] . $synthstut["nom"] . "_PC2";
            $filenamePC= $prenomNomPC . "." . $request->file('photoCarrousel2') ->getClientOriginalExtension() ;
            $file->move(public_path('TuT_carrousel/'), $filenamePC);

            $synthstut->photoCarrousel2 =$filenamePC;
        };
        if($request->hasfile('photoCarrousel3'))
        {
            $destinationPC = public_path('TuT_carrousel/'.$synthstut->photoCarrousel3);
            if(File::exists($destinationPC))
            {
                File::delete($destinationPC);
            }
            $file = $request->file('photoCarrousel3');
            //recovering initial pic_name
            $prenomNomPC = $synthstut["prenom"] . $synthstut["nom"] . "_PC3";
            $filenamePC= $prenomNomPC . "." . $request->file('photoCarrousel3') ->getClientOriginalExtension() ;
            $file->move(public_path('TuT_carrousel/'), $filenamePC);

            $synthstut->photoCarrousel3 =$filenamePC;
        };
        $synthstut->update();
        switch ($request->input('action')) {
            case 'edit':
                return redirect()->route('synthstuts.show' , ['synthstut' => $synthstut->id]);
                break;

            case 'save':
                return redirect()->route('synthstuts.edit' , ['synthstut' => $synthstut->id]);
                break;
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Synthstut $synthstut)
    {
        $id = $synthstut['user_id'];

        //recovering path of the old picture
        $pathPDP = public_path('TuT_profil_pictures/'.$synthstut->photoProfil);
        //checking if old picture is already in this directory if yes deleting the picture
        if(file_exists($pathPDP))
        {
            unlink($pathPDP);
        }
        //recovering path of the old picture
        $pathPC = public_path('TuT_wallpaper/'.$synthstut->photoCouverture);
        //checking if old picture is already in this directory if yes deleting the picture
        if(file_exists($pathPC))
        {
            unlink($pathPC);
        }
        $pathPC1 = public_path('TuT_carrousel/'.$synthstut->photoCarrousel1);
        //checking if old picture is already in this directory if yes deleting the picture
        if(file_exists($pathPC1))
        {
            unlink($pathPC1);
        }
        $pathPC2 = public_path('TuT_carrousel/'.$synthstut->photoCarrousel2);
        //checking if old picture is already in this directory if yes deleting the picture
        if(file_exists($pathPC2))
        {
            unlink($pathPC2);
        }
        $pathPC2 = public_path('TuT_carrousel/'.$synthstut->photoCarrousel2);
        //checking if old picture is already in this directory if yes deleting the picture
        if(file_exists($pathPC2))
        {
            unlink($pathPC2);
        }
        $user = Auth::user();
	if ($user->can('delete', $synthstut)){
            $synthstut->delete();
            if (Auth::user()->role == 'formatrice'){$synthstuts = DB::table('synthstuts')->where('user_id', '=', $id)->paginate(8);}
            else{ $synthstuts = Synthstut::orderBy('created_at', 'desc')->paginate(8); }
                // récupére les données de la table produits
            return view('synthstuts.index', compact('synthstuts'));
        } else {
            abort(403, 'Unauthorized');
        }
    }



    public function init_tut(Request $request)
    {
        if (Auth::user()) {
            $id = Auth::user()->id;
            $user = User::create([
                'name' => $request->name,
                'surname' => $request->surname,
                'role' => 'tut',
                'id_creator' =>  $id,
                'email' => $request->email,
		        'PDPuser' => $request->PDPuser,
                'password' => Hash::make($request->password),
                'organisme' => $request->organisme,
                'civilite' => $request->civilite,
            ]);
            $data = "--".Auth::user()->id."--Créateur : ".Auth::user()->name." ".Auth::user()->surname."--".Auth::user()->email."--Compte Crée :".$request->name.$request->surname." , ".$request->email."---".Auth::user()->id;
            DB::insert('insert into notifications ( type,notifiable_type,notifiable_id,data,read_at,created_at) values (?, ?,?,?,?,?)', ['mail','Création de compte TUT',Auth::user()->id,$data,date('Y-m-d H:i:s'),date('Y-m-d H:i:s')]);
            if ($user) {
                $dates=explode(" - ",$request->dates);
                $do_at_one = date('Y-M-d', strtotime($dates[0]));
                $do_at_two = date('Y-M-d', strtotime($dates[0] . ' +1 day'));
                $do_at_three = date('Y-M-d', strtotime($dates[0] . ' +2 day'));
                $do_at_four =  date('Y-M-d', strtotime($dates[1]));
                DB::insert('insert into sign ( id_user,id_creator,do_at_one,do_at_two,do_at_three,do_at_four) values (?,?,?,?,?,?)', [$user->id,$id,$do_at_one,$do_at_two,$do_at_three,$do_at_four]);

                return redirect('/synthstuts/create/'.$user->id.'')->with('user', $user);
            } else {
                return view('auth.error');
            }

        }else {
            return view('auth.error');
        }
    }


    public function search_tut(Request $request)
    {

       if($request->ajax()){

         $output="";
         if (Auth::user()) {
             $id = Auth::user()->id;
         }
         $search_tut = User::where('id','LIKE','%'.$request->search."%")
                                    ->Orwhere('name','LIKE','%'.$request->search."%")
                                    ->Orwhere('surname','LIKE','%'.$request->search."%")
                                    ->Orwhere('email','LIKE','%'.$request->search."%")
                                    ->get();

         if(count($search_tut) > 0){

            foreach ($search_tut as  $row) {
                if ((($row->id_creator) == $id) && (($row->id_synthese) == "none") && (($row->role) == "tut")) {
                    $output.='<tr>'.

                    '<td>'.'<span class="col-green">'.$row->id. '</span> </td>'.

                    '<td>'.
                       '<b>'.$row->name.'</b>'.
                    '</td>'.

                    '<td>'.$row->surname.'</td>'.

                    '<td>'.'<span class="text-muted">'.$row->email.'</span>'.'</td>'.

                    '<td>'.
                       '<a href="/synthstuts/create/'.$row->id.'" class="btn btn-primary waves-effect waves-float waves-green">'.'<i class="bi bi-brush">'.'</i>'.' Créer la synthèse</a>'.
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

    public function ma_synthese_tut()
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

                return view('synthstuts.synthstuts', compact('thread', 'userss'));
            } else {
                return view('auth.error');
            }

        }
    }


    public function synthstuts_create($id)
    {
        return view('synthstuts.create_id', ['id' => $id]);
    }

    public function validation()
    {
        if (Auth::user()) {
            if (Auth::user()->role == 'tut') {
                return view('synthstuts.validation');
            }elseif (Auth::user()->role == 'tuc') {
                return view('synthstucs.validation');
            }else{
                return redirect('/messages');
            }
        }else{
            return view('auth.error');
        }
    }

    public function valid(Request $request)
    {
        // dd($request->browser);
        if (Auth::user()) {
            if (Auth::user()->role == 'tut') {
                $data = "--".Auth::user()->id."--".Auth::user()->name." ".Auth::user()->surname."--".Auth::user()->email."---".Auth::user()->id_creator;
                DB::insert('insert into notifications ( type,notifiable_type,notifiable_id,data,read_at,created_at) values (?, ?,?,?,?,?)', ['synthese '.Auth::user()->role.'','Validation finale',Auth::user()->id,$data,date('Y-m-d H:i:s'),date('Y-m-d H:i:s')]);

                $synthese = DB::update('update synthstuts set status = "3" where id = '.$request->input('id_synthstuts').'');
                return redirect('/ma_synthese_tut')->with('synthese', 'Votre Synthèse');
            } else if(Auth::user()->role == 'tuc'){

                $data = "--".Auth::user()->id."--".Auth::user()->name." ".Auth::user()->surname."--".Auth::user()->email."---".Auth::user()->id_creator;
                DB::insert('insert into notifications ( type,notifiable_type,notifiable_id,data,read_at,created_at) values (?, ?,?,?,?,?)', ['synthese '.Auth::user()->role.'','Validation finale',Auth::user()->id,$data,date('Y-m-d H:i:s'),date('Y-m-d H:i:s')]);

                $synthese = DB::update('update synthstucs set status = "3" where id = '.$request->input('id_synthstucs').'');
                return redirect('/ma_synthes_tuc')->with('synthese', 'Votre Synthèse');
            }else {
                return redirect('/messages');
            }

        } else {
            return view('auth.error');
        }

    }
}
