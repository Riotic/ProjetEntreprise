<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use PDF;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\SynthstutController;
use App\Http\Controllers\SynthstucController;
use App\Http\Controllers\SynthstueController;
use App\Models\Synthstut;
use App\Models\Synthstuc;
use App\Models\Synthstue;

class UserController extends Controller
{
    public function index()
    {
        if (Auth::user()) {
            $users = User::orderBy('role', 'asc')->paginate(8);
            if($users){ return view('users.index', compact('users'));}
            else{abort(404);}
        } else {
            return view('auth.error');
        }
    }

    public function show(User $user)
    {
        return view('users.show', [
            'user' => $user
        ]);
    }

    public function indexUserCreated($id)
    {
	if (Gate::allows('isFormatriceOrAdmin')) {
            if (Auth::user()) {
                $users = User::where('id_creator',$id)->orderBy('created_at', 'desc')->paginate(8);
                return view('users.index', compact('users'));
            } else {
                return view('auth.error');
            }
        } else {
            abort(403, 'Unauthorized action.');
        }
    }

    public function create()
    {
        return view('users.create');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'role' => ['required', 'string', 'max:255'],
            'id_creator' => ['string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'intervenant' => ['string'],
        ]);
        $data = "--".Auth::user()->id."--Créateur : ".Auth::user()->name." ".Auth::user()->surname."--".Auth::user()->email."--Compte Crée :".$request->name." ".$request->surname."--".$request->email."---none";

        DB::insert('insert into notifications ( type,notifiable_type,notifiable_id,data,read_at,created_at) values (?, ?,?,?,?,?)', ['mail','Création de compte Admin',Auth::user()->id,$data,date('Y-m-d H:i:s'),date('Y-m-d H:i:s')]);

        $validated['password'] = Hash::make($request->password);

        User::create($validated);

        $users = User::all();
        return redirect()->route('users.index', ['users' => $users]);
    }


    public function edit(User $user)
    {

        return view('users.edit', ['user' => $user]);
    }

    public function update(Request $request, User $user)
    {
        $user->name=$request['name'];
        $user->surname=$request['surname'];
        if(Auth::user()->role == 'admin'){
            $user->password=Hash::make($request->password);
            $user->role=$request['role'];
        };
        $user->update();
        return redirect()->route('users.show' , ['user' => $user->id])->with('status', 'Mise à jour réussi');
    }


    public function destroy(User $user)
    {
	$id = $user->id;
        if ($user->role == 'tuc'){
            $synthstuc = Synthstuc::where('client_id', $id);
            // dd($synthstuc);
            if ($synthstuc){ Synthstuc::where('client_id', $id)->delete();}
        }
        if ($user->role == 'tut'){
            $synthstut = Synthstut::where('client_id', $id);
            // dd($synthstut);
            if ($synthstut){ Synthstuc::where('client_id', $id)->delete();}
        }
        if ($user->role == 'tue'){
            $synthstue = Synthstue::where('client_id', $id);
            // dd($synthstuc);
            if ($synthstue){ Synthstue::where('client_id', $id)->delete();}
        }
        $user->delete();
	    $users = User::all()->paginate(8);
        return view('users.index', compact('users'));
    }

    public function pdf_log($id)
    {
        $filename = date('Y m d ').'Feuille-emargement-'.Auth::user()->id;
        $notifications = DB::select('select * from notifications where id='.$id.';');
        foreach ($notifications as $key ) {
            $array = [
                'data' => $key->data,
                'notifiable_type' => $key->notifiable_type,
            ];
        }
        $pdf = PDF::loadView('dashboard.notifications', $array);
        if ($pdf) {
            return $pdf->download(''.$filename.'.pdf');
        } else {
            return redirect('search')->with('Echec', 'UN ERREUR TROP GRAVE!');
        }
    }

    public function downloadPDF()
    {
        if (Auth::user()) {
            $id_synthese = Auth::user()->id_synthese;
            if (Auth::user()->role == 'tut') {
                $id_synthese = DB::select('select * from synthstuts where id='.$id_synthese.';');
                foreach ($id_synthese as $synthstuc) {
                    $job = $synthstuc->metier;
                    $endingDate  = date('Y/m/d', strtotime($synthstuc->updated_at));
                }
                $img = "https://i.ibb.co/h9YBMK1/logo.png";
                $template ='synthstuts.pdf';
                $signature = "";
            } else {
                $id_synthese = DB::select('select * from synthstucs where id='.$id_synthese.';');
                foreach ($id_synthese as $synthstuc) {
                    $job = $synthstuc->metier;
                    $endingDate  = date('Y/m/d', strtotime($synthstuc->updated_at));
                }
                $img = "https://i.ibb.co/vX2q2qW/logo-candidat.png";
                $template ='synthstucs.pdf';
                $signature = "";
            }

            $intervenants= DB::select('select intervenant from users where id='.Auth::user()->id_creator.';');
            foreach ($intervenants as $key_) {
                $intervenant =$key_->intervenant;
            }

            $organisme = Auth::user()->organisme;

            if (strpos(strtoupper($organisme), 'EP') !== false){
                $organisme = "EVOLUTION PROFESSIONNELLE enregistré sous le numéro de déclaration d’activité 11756182775 auprès de la DIRECCTE (Direction régionale des entreprises, de la concurrence, de la consommation, du travail et de l’emploi) de l’Ile-de-France";
                $representant = "Monsieur Florent COVILETTE";
                $organisme_2 = "EVOLUTION PROFESSIONNELLE";
                $pied_page = "EVOLUTION PROFESSIONNELLE - 128 rue de la Boétie - 75008 Paris\n N° SIRET 87789243000019 - N° Déclaration d'activité 11756182775\n Organisme de Formation non assujetti à la TVA";
            } else if(strpos(strtoupper($organisme), 'AC') !== false){
                $organisme = "AC CONSEILS enregistré sous le numéro de déclaration d’activité 17755658275 auprès de la DIRECCTE (Direction régionale des entreprises, de la concurrence, de la consommation, du travail et de l’emploi) de l’Ile-de-France";
                $representant = " Madame Célia BEAUCOURT ";
                $organisme_2 = "AC CONSEILS ";
                $pied_page = "AC CONSEILS – 6 rue Musset – 75016 Paris\n N° de SIREN 831312681 - N° Déclaration d’activité : 11755658275\n Organisme de Formation non assujetti à la TVA";
            }else {
                $organisme = "PM GROUPE FRANCE enregistré sous le numéro de déclaration d’activité 11755175375 auprès de la DIRECCTE (Direction régionale des entreprises, de la concurrence, de la consommation, du travail et de l’emploi) de l’Ile-de-France";
                $representant = "Monsieur Florent COVILETTE";
                $organisme_2 = "PM GROUPE FRANCE ";
                $pied_page = "PM GROUPE FRANCE - 128 rue de la Boétie - 75008 Paris\nN° de SIRET 79127535700030 - N° Déclaration d'activité : 11755175375 \nOrganisme de Formation non assujetti à la TVA";
            }


            $filename = date('Y m d ').'attestation-FIN-'.Auth::user()->surname.'_'.Auth::user()->id;
            $array = [
                'filename' => $filename,
                'pied_page' => $pied_page,
                'representant' => $representant,
                'organisme' => $organisme,
                'beginDate' => date('Y/m/d', strtotime(Auth::user()->created_at)),
                'endingDate' => $endingDate,
                'intervenant' => $intervenant,
                'do_at' => "Paris, le ".date('Y/m/d'),
                'organisme_2' => $organisme_2,
                'civility' => Auth::user()->civilite,
                'fullname' => Auth::user()->surname." ".Auth::user()->name,
                'img' => $img,
                'job' => $job,
                'signature' => $signature
            ];
            //return $array;
            $pdf = PDF::loadView($template, $array)->save('./results/'.$filename.'.pdf');

            $data = "--".Auth::user()->id."--Téléchargement Attestation : ".Auth::user()->name." ".Auth::user()->surname."--".Auth::user()->email." Document"."---".Auth::user()->id_creator;
            DB::insert('insert into notifications ( type,notifiable_type,notifiable_id,data,read_at,created_at) values (?, ?,?,?,?,?)', ['stagiaire','Téléchargement Attestation',Auth::user()->id,$data,date('Y-m-d H:i:s'),date('Y-m-d H:i:s')]);

            if ($pdf) {
                return $pdf->download(''.$filename.'.pdf');
            } else {
                return redirect('search')->with('Echec', 'UN ERREUR TROP GRAVE!');
            }
        } else {
            return view('auth.error');
        }
    }

    public function valid_sign(Request $request)
    {
        if (Auth::user()) {
            $id_synthese = Auth::user()->id_synthese;
            if (Auth::user()->role == 'tut') {
                $color = '37aff0';
                $link = 'https://bilan.trouver-un-therapeute.fr';
                $img = "https://i.ibb.co/5YqHDRb/therapeute.png";
            }elseif (Auth::user()->role == 'tuc'){
            $color = '2153C1';
            $link = 'https://bilan.trouver-un-candidat.com/';
            $img = "https://i.ibb.co/vX2q2qW/logo-candidat.png";}
            else {
            $color = '2153C1';
            $link = 'https://bilan.trouver-un-candidat.com/';
            $img = "https://i.ibb.co/vX2q2qW/logo-candidat.png";
            }

            $intervenants= DB::select('select intervenant from users where id='.Auth::user()->id_creator.';');
            foreach ($intervenants as $key_) {
                $intervenant =$key_->intervenant;
            }

            $organisme = Auth::user()->organisme;


            $sign= DB::select('select * from sign where id_user='.Auth::user()->id.';');
            if ($sign) {
                foreach ($sign as $signkey ) {
                    $do_at_one = $signkey->do_at_one;
                    $do_at_two = $signkey->do_at_two;
                    $do_at_three = $signkey->do_at_three;
                    $do_at_four = $signkey->do_at_four;
                }
            } else {
                $do_at_one = date('d/m/Y');
                $do_at_two = date('d/m/Y');
                $do_at_three = date('d/m/Y');
                $do_at_four = date('d/m/Y');
            }


            if (strpos(strtoupper($organisme), 'EP') !== false){
                $organisme = "EVOLUTION PROFESSIONNELLE enregistré sous le numéro de déclaration d’activité 11756182775 auprès de la DIRECCTE (Direction régionale des entreprises, de la concurrence, de la consommation, du travail et de l’emploi) de l’Ile-de-France";
                $representant = "Monsieur Florent COVILETTE";
                $organisme_2 = "EVOLUTION PROFESSIONNELLE";
                $pied_page = "EVOLUTION PROFESSIONNELLE - 128 rue de la Boétie - 75008 Paris\n N° SIRET 87789243000019 - N° Déclaration d'activité 11756182775\n Organisme de Formation non assujetti à la TVA";
            } else if(strpos(strtoupper($organisme), 'AC') !== false){
                $organisme = "AC CONSEILS enregistré sous le numéro de déclaration d’activité 17755658275 auprès de la DIRECCTE (Direction régionale des entreprises, de la concurrence, de la consommation, du travail et de l’emploi) de l’Ile-de-France";
                $representant = " Madame Célia BEAUCOURT ";
                $organisme_2 = "AC CONSEILS ";
                $pied_page = "AC CONSEILS – 6 rue Musset – 75016 Paris\n N° de SIREN 831312681 - N° Déclaration d’activité : 11755658275\n Organisme de Formation non assujetti à la TVA";
            }else {
                $organisme = "PM GROUPE FRANCE enregistré sous le numéro de déclaration d’activité 11755175375 auprès de la DIRECCTE (Direction régionale des entreprises, de la concurrence, de la consommation, du travail et de l’emploi) de l’Ile-de-France";
                $representant = "Monsieur Florent COVILETTE";
                $organisme_2 = "PM GROUPE FRANCE ";
                $pied_page = "PM GROUPE FRANCE - 128 rue de la Boétie - 75008 Paris\nN° de SIRET 79127535700030 - N° Déclaration d'activité : 11755175375 \nOrganisme de Formation non assujetti à la TVA";
            }

            $array = [
                'i' => Auth::user()->id,
                'civility' => Auth::user()->civilite,
                'pied_page' => $pied_page,
                'img' => $img,
                'beginDate' => date('d', strtotime(Auth::user()->created_at)),
                'endingDate' => date('d-m-Y', strtotime(Auth::user()->created_at . ' +5 day')),
                'fullname' => Auth::user()->surname." ".Auth::user()->name,
                'do_at_one' => $do_at_one,
                'do_at_two' => $do_at_two,
                'do_at_three' => $do_at_three,
                'do_at_four' => $do_at_four,
                'link' => $link,
                'color' => $color,
                'sign' => $request->sig_data_url
            ];
            $data = "--".Auth::user()->id."--Signature FEUILLE D'EMARGEMENT Bilan de Compétences  : ".Auth::user()->name." ".Auth::user()->surname."--".Auth::user()->email." Document"."---".Auth::user()->id_creator;
            DB::insert('insert into notifications ( type,notifiable_type,notifiable_id,data,read_at,created_at) values (?, ?,?,?,?,?)', ['stagiaire','Signature FEUILLE D EMARGEMENT',Auth::user()->id,$data,date('Y-m-d H:i:s'),date('Y-m-d H:i:s')]);

            $filename = date('Y-m-d', strtotime(date('Y-m-d')))."-".Auth::user()->surname.Auth::user()->name;
            $pdf = PDF::loadView('feuille-emargement', $array)->save('./feuille-emargement/'.$filename.'.pdf');
            if ($pdf) {
                return redirect()->back()->with('sign', 'sign');
            } else {
                return redirect('index')->with('Echec', 'UN ERREUR TROP GRAVE!');
            }
        } else {
            return view('auth.error');
        }
    }

	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexTUC($id)
    {
        if (Auth::user()) {
            $synthstucs = Synthstuc::where('user_id', '=', $id)->orderBy('created_at', 'desc')->paginate(8);
            return view('synthstucs.index', compact('synthstucs'));
        }else {
            return view('auth.error');
        }
    }

    public function indexTUE($id)
    {
        if (Auth::user()) {
            $synthstues = Synthstue::where('user_id', '=', $id)->orderBy('created_at', 'desc')->paginate(8);
            return view('synthstues.index', compact('synthstues'));
        }else {
            return view('auth.error');
        }
    }

	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexTUT($id)
    {
        if (Auth::user()) {
            $synthstuts = Synthstut::where('user_id', '=', $id)->orderBy('created_at', 'desc')->paginate(8);
            // $synthstucs = DB::table('synthstucs')->where('user_id', '=', $id)->get();
            return view('synthstuts.index', compact('synthstuts'));
        }else {
            return view('auth.error');
        }
    }
}

