@extends('dashboard.home')

@section('main')

@php function shorten($string, $maxLength) { return substr($string, 0, $maxLength); } @endphp
<div class=main_div>
    <div class="square">

    @can('update', $synthstue)
    <a href="{{ route('synthstues.edit', $synthstue->id) }}">
        <button class="btn btn" >Editer</button>
    </a>
    @endcan

    @can('delete', $synthstue)
    <form action="{{ route('synthstues.destroy', $synthstue->id) }}" method="post">
        @csrf
        @method('DELETE')
	<button class="btn btn" onclick="return confirm('Confirmer la suppression ?')" type="submit">Supprimer</button>
    </form>
    @endcan

    @php

        $formations = $synthstue->formations;
        $experiences = $synthstue->experiences;
        $jsonStrip = array('{','}','"','[',']');
        $virgBetween = array(',');
        $virgBetweenDouble = array(',,');
        $breakStrip = array('<br>','&nbsp;');
        $thinkHTML = array('</');
        $forBetterDate = array(':vV', ',');
        $thinkOfMistakes = array(':');
        // $thinkHTMLLi = array('<li>');
        $changeMultipleEnter = array('ENTERENTER', 'ENTERENTERENTER', 'ENTERENTERENTERENTER');

        try{
            $formations = str_replace($jsonStrip, "", $formations);
            $formations = str_replace($thinkOfMistakes, ":vV", $formations);
            $formations = str_replace($forBetterDate, ":-v:", $formations);
            $formations[1] = date( "Y", strtotime($formations[1]));
            $formations[3] = date( "Y", strtotime($formations[3]));
            if( $formations[1] == $formations[3]) {
                $formations[3] = "none";
            }else{ $formations[3] = "-".$formations[3];}
            $formations = implode(',', $formations);
            $formations = str_replace($virgBetweenDouble, ",", $formations);
            $formations = str_replace($virgBetween, ":vV", $formations);
        }catch (Exception $e){
             $formations = Null;
        }

        try{
            $experiences = str_replace($jsonStrip, "", $experiences);
            $experiences = str_replace($thinkOfMistakes, ":vV", $experiences);
            $experiences = str_replace($forBetterDate, ":-v:", $experiences);
            $experiences = explode(":-v:", $experiences);
            $experiences[1] = date( "d/m/Y", strtotime($experiences[1]));
            $experiences[3] = date( "d/m/Y", strtotime($experiences[3]));
            $experiences = implode(',', $experiences);
            $experiences = str_replace($virgBetweenDouble, ",", $experiences);
            $experiences = str_replace($virgBetween, ":vV", $experiences);
        }catch (Exception $e){
            $experiences = Null;
        }

        $synthese = $synthstue->synthese;
        $doubleCoteStrip = array('"');
        $synthese = str_replace($doubleCoteStrip, "'", $synthese);
        //$synthese = str_replace($thinkHTMLLi, "<li>- ", $synthese);
        $synthese = str_replace($thinkHTML, "ENTER</", $synthese);
        $synthese = str_replace($breakStrip, "ENTER", $synthese);
        $synthese = str_replace($changeMultipleEnter, "ENTER", $synthese);
        $synthese = str_replace($changeMultipleEnter, "ENTER", $synthese);
        $synthese = strip_tags($synthese);

        // dd($synthese);
        // dd($formations);
        // dd($experiences);
    @endphp
    <p hidden id="jsonData" >
        [{
        "identifiant": "{{$client->PDPuser}}",
        "email": "{{$client->email}}",
        "role": "{{$client->role}}",
        "prenom": "{{$synthstue->prenom}}",
        "nom": "{{$synthstue->nom}}",
        "website": "{{$synthstue->website}}",
        "telephone": "{{$synthstue->telephone}}",
        "adresse": "{{$synthstue->adresse}}",
        "formations": "{{$formations}}",
        "experiences": "{{$experiences}}",
        "departement": "{{$synthstue->departement}}",
        "titreSEO": "{{$synthstue->prenom.' '.$synthstue->nom.', '.$synthstue->metier}}",
        "synthese": "{{$synthstue->prenom.' '.$synthstue->nom.', '.$synthstue->metier.' - '.$synthstue->departement.$synthese.$synthstue->prenom.' '.$synthstue->nom}}"
        }]
    </p>
    {{-- <p id="JsonData">{{$synthstue}}</p> --}}

    @if ( Auth::user()->role == 'admin' )
        <a id="downloadFile" href="data:attachment/text," target="_blank" download="myFile.txt" class="download-btn">Download</a>
    @endif


    <div class="card">
        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
          @if ( $synthstue->photoProfil == "none")
          <img src="http://trouver-un-expert.com/wp-content/uploads/2022/08/cropped-T1Exp-logo-removebg-preview.png" height="100" width="100" alt="Profile" class="rounded-circle">
          @else
          <img src="../syn/public/TuE_profil_pictures/{{$synthstue->photoProfil}}" alt="Profile"  height="100" width="100" class="rounded-circle">
            @if ( Auth::user()->role == 'admin')
            <a href="../syn/public/TuE_profil_pictures/{{$synthstue->photoProfil}}" download class="download-btn">Download</a>
            @endif
          @endif
          <h2>{{$synthstue->nom}}</h2>
          <div class="social-links mt-2">
            <a href="{{$synthstue->website}}" target="_blank" class="twitter"><i class="bi bi-twitter"></i></a>
            <a href="{{$synthstue->reseau_autre}}" target="_blank" class="facebook"><i class="bi bi-facebook"></i></a>
            <a href="{{$synthstue->reseau_autre}}" target="_blank" class="instagram"><i class="bi bi-instagram"></i></a>
            <a href="{{$synthstue->linkedin}}" target="_blank" class="linkedin"><i class="bi bi-linkedin"></i></a>
          </div>
          <div class="col-md-10 body">
            @if ( $synthstue->CV == "none")

            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <i class="bi bi-exclamation-octagon me-1"></i>
              Aucun CV n'a ??t?? trouv??.
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
              @else

              <small >VISUAL DE CV</small><br>
              <embed src="../syn/public/TuE_CV/{{$synthstue->CV}}" width="300" height="375" type="application/pdf">
                @if ( Auth::user()->role == 'admin')
                    <a href="../syn/public/TuE_CV/{{$synthstue->CV}}" download class="download-btn">Download</a>
                @endif
              @endif
          </div>
        </div>
      </div>
      <section class="profile">
      <div class="tab-pane fade show active profile-overview" id="profile-overview">

          <h5 class="card-title">Profile Details</h5>

          <div class="row">
            <div class="col-lg-3 col-md-4 label ">Pr??nom & NOM  </div>
            <div class="col-lg-9 col-md-8" id="prenomNOM">{{$synthstue->prenom}} {{$synthstue->nom}}</div>
          </div>

          <div class="row">
            <div class="col-lg-3 col-md-4 label">Website</div>
            <div class="col-lg-9 col-md-8">{{$synthstue->website}}</div>
          </div>

          <div class="row">
            <div class="col-lg-3 col-md-4 label">Linkedin</div>
            <div class="col-lg-9 col-md-8">{{$synthstue->linkedin}}</div>
          </div>

          <div class="row">
              <div class="col-lg-3 col-md-4 label">Metier</div>
              <div class="col-lg-9 col-md-8">{{$synthstue->metier}}</div>
            </div>


          <div class="row">
            <div class="col-lg-3 col-md-4 label">Address</div>
            <div class="col-lg-9 col-md-8">{{$synthstue->adresse}}</div>
          </div>

          <div class="row">
              <div class="col-lg-3 col-md-4 label">departement</div>
              <div class="col-lg-9 col-md-8">{{$synthstue->departement}}</div>
            </div>

          <div class="row">
            <div class="col-lg-3 col-md-4 label">Phone</div>
            <div class="col-lg-9 col-md-8">{{$synthstue->telephone}}</div>
          </div>

          <div class="row">
            <div class="col-lg-3 col-md-4 label">Email</div>
            <div class="col-lg-9 col-md-8">{{$synthstue->email}}</div>
          </div>

        </div>
      </section>

    </div>
</div>

<script>
    var prenomNOM = document.getElementById('prenomNOM').innerText + '.json';
    var jsonData = document.getElementById('jsonData').innerText;
    var hiddenElement = document.querySelector('#downloadFile');
    hiddenElement.setAttribute("href", 'data:text/json;charset=utf-8,' + encodeURI(jsonData))
    hiddenElement.setAttribute("target", '_blank')
    hiddenElement.setAttribute("download", prenomNOM)
</script>

@endsection
