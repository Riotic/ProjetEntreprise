@extends('dashboard.home')

@section('main')

@php function shorten($string, $maxLength) { return substr($string, 0, $maxLength); } @endphp
@php
    $test = $synthstut->departement;
    $cutTheSlash = array(' / ');
    $forSEO = str_replace($cutTheSlash, " ", $test);
    $departementWithNoNumber = explode(' / ', $synthstut->departement);
    $departementWithNoNumber = $departementWithNoNumber[0];
    $doubleQuotes = array('"', '”', "“", "«", "»", "„", "“" );
    // clean des doubles quotes pour pouvoir l'entrer en json.
    $synthese = '<p>'.$synthstut->metier.' - '.$synthstut->departement.'</p>'.$synthstut->synthese.'<p>'.$synthstut->metier.' - '.$synthstut->departement.'- <a href="https://trouver-un-therapeute.fr">Trouver-un-thérapeute.fr</a></p>';
    $synthese = str_replace($doubleQuotes, "'", $synthese);

    $metaDescription = strip_tags($synthstut->synthese);
    $metaDescription = substr($metaDescription, 0, 70).'...';
    $metaDescription = str_replace($doubleQuotes, "'", $metaDescription);

    $horaire = substr($synthstut->horaire, 0, -1);
    $citation = str_replace($doubleQuotes, "'", $synthstut->citation);

    $motsClef = str_replace($doubleQuotes, "", $synthstut->motsClefs);
    // dd($synthese);
@endphp
<div class=main_div>

    @can('update', $synthstut)
    <a href="{{ route('synthstuts.edit', $synthstut->id) }}">
        <button class="btn btn-primary btn-lg">Editer</button>
    </a>
    @endcan

    @can('delete', $synthstut)
    <form action="{{ route('synthstuts.destroy', $synthstut->id) }}" method="post">
        @csrf
        @method('DELETE')
	<button class="btn btn-danger btn-lg" onclick="return confirm('Confirmer la suppression ?')" type="submit">Supprimer</button>
    </form>
    @endcan

    <p hidden id="csv" >
        [{
        "Titre du profil": "{{$synthstut->prenom.' '.$synthstut->nom.', '.$synthstut->metier.' - '.$forSEO}}",
        "Adresse": "{{$synthstut->adresse}}",
        "Deuxieme adresse": "{{$synthstut->adresseBis}}",
        "Telephone": "{{$synthstut->telephone}}",
        "Email": "{{$client->email}}",
        "Website": "{{$synthstut->website}}",
        "Twitter": "{{$synthstut->twitter}}",
        "Facebook": "{{$synthstut->facebook}}",
        "Linkedin": "{{$synthstut->linkedin}}",
        "Chaine youtube": "{{$synthstut->youtube}}",
        "Instagram": "{{$synthstut->instagram}}",
        "Video youtube": "{{$synthstut->youtube}}",
        "Horaire": "{{$horaire}}",
        "Mots clés": "{{$motsClef}}",
        "Departement": "{{$departementWithNoNumber}}",
        "Citation": "{{$citation}}"
        }]
    </p>

    <p hidden id="jsonData" >
        [{
        "identifiant": "{{$client->PDPuser}}",
        "email": "{{$client->email}}",
        "prenom": "{{$synthstut->prenom}}",
        "nom": "{{$synthstut->nom}}",
        "synthese": "{{$synthese}}",
        "requete cible": "{{$synthstut->metier." - ".$departementWithNoNumber}}",
        "meta description": "{{$metaDescription}}"
        }]
    </p>

    @if ( Auth::user()->role == 'admin' )
        <a id="csvDownload" href="data:attachment/text," target="_blank" download="myFile.txt" class="download-btn">Download CSV</a>
        <a id="downloadFile" href="data:attachment/text," target="_blank" download="myFile.txt" class="download-btn">Download JsonPosteur</a>
    @endif

    <div class="card">
        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

            <img src="../syn/public/TuT_profil_pictures/{{$synthstut->photoProfil}}" style="width: 120px" alt="synthstut {{$synthstut->nom}} picture" class="rounded-circle">
	    @if ( Auth::user()->role == 'admin')
            <a href="../syn/public/TuT_profil_pictures/{{$synthstut->photoProfil}}" download class="download-btn">Download</a>
            @endif
            <h2>{{$synthstut->nom}}</h2>
            <div class="social-links mt-2">
                <a href="{{$synthstut->website}}" target="_blank" class="twitter"><i class="bi bi-twitter"></i></a>
                <a href="{{$synthstut->facebook}}" target="_blank" class="facebook"><i class="bi bi-facebook"></i></a>
                <a href="{{$synthstut->youtube}}" target="_blank" class="instagram"><i class="bi bi-youtube"></i></a>
                <a href="{{$synthstut->linkedin}}" target="_blank" class="linkedin"><i class="bi bi-linkedin"></i></a>
            </div>
            <div class="col-md-10 body">
                <div class="row">

                    <div class="child col-md-3">
                        <p>Photo de couverture</p>
                        <img src="../syn/public/TuT_wallpaper/{{$synthstut->photoCouverture}}" alt="product {{$synthstut->photoCouverture}} picture"><br>
			@if ( Auth::user()->role == 'admin')
        		    <a href="../syn/public/TuT_wallpaper/{{$synthstut->photoCouverture}}" download class="download-btn">Download</a>
	           	@endif

                    </div>
                    <div class="child col-md-3">
                        <p>Photo Carrousel1</p>
                        <img src="../syn/public/TuT_carrousel/{{$synthstut->photoCarrousel1}}" alt="product {{$synthstut->photoCarrousel1}} picture"><br>
			@if ( Auth::user()->role == 'admin')
                            <a href="../syn/public/TuT_carrousel/{{$synthstut->photoCarrousell}}" download class="download-btn">Download</a>
                        @endif

                    </div>
                    <div class="child col-md-3">
                        <p>Photo Carrousel2</p>
                        <img src="../syn/public/TuT_carrousel/{{$synthstut->photoCarrousel2}}" alt="product {{$synthstut->photoCarrousel2}} picture"><br>
			@if ( Auth::user()->role == 'admin')
                            <a href="../syn/public/TuT_carrousel/{{$synthstut->photoCarrousel2}}" download class="download-btn">Download</a>
                        @endif
                    </div>

                    <div class="child col-md-3">
                        <p>Photo Carrousel3</p>
                        <img src="../syn/public/TuT_carrousel/{{$synthstut->photoCarrousel3}}" alt="product {{$synthstut->photoCarrousel3}} picture"><br>
			@if ( Auth::user()->role == 'admin')
                            <a href="../syn/public/TuT_carrousel/{{$synthstut->photoCarrousel3}}" download class="download-btn">Download</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="profile">
        <div class="tab-pane fade show active profile-overview" id="profile-overview">
            <h5 class="card-title">About</h5>

            <h5 class="card-title">Profile Details</h5>

            <div class="row">
                <div class="col-lg-3 col-md-4 label ">Prénom & NOM  </div>
                <div class="col-lg-9 col-md-8" id="prenomNOM">{{$synthstut->prenom}} {{$synthstut->nom}}</div>
            </div>

            <div class="row">
                <div class="col-lg-3 col-md-4 label">Website</div>
                <div class="col-lg-9 col-md-8">{{$synthstut->website}}</div>
              </div>

              <div class="row">
                <div class="col-lg-3 col-md-4 label">Linkedin</div>
                <div class="col-lg-9 col-md-8">{{$synthstut->linkedin}}</div>
              </div>

            <div class="row">
                <div class="col-lg-3 col-md-4 label">Metier</div>
                <div class="col-lg-9 col-md-8">{{$synthstut->metier}}</div>
            </div>


            <div class="row">
                <div class="col-lg-3 col-md-4 label">Horaire</div>
                <div class="col-lg-9 col-md-8">{{$synthstut->horaire}}</div>
            </div>

            <div class="row">
                <div class="col-lg-3 col-md-4 label">Adresse</div>
                <div class="col-lg-9 col-md-8">{{$synthstut->adresse}}</div>
            </div>

            <div class="row">
                <div class="col-lg-3 col-md-4 label">Deuxieme adresse</div>
                <div class="col-lg-9 col-md-8">{{$synthstut->adresseBis}}</div>
            </div>

            <div class="row">
                <div class="col-lg-3 col-md-4 label">Departement</div>
                <div class="col-lg-9 col-md-8">{{$synthstut->departement}}</div>
            </div>

            <div class="row">
                <div class="col-lg-3 col-md-4 label">Telephone</div>
                <div class="col-lg-9 col-md-8">{{$synthstut->telephone}}</div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-4 label">Les mots Clefs</div>
                <div class="col-lg-9 col-md-8">{{$synthstut->motsClefs}}</div>
            </div>

            <div class="row">
                <div class="col-lg-3 col-md-4 label">Email</div>
                <div class="col-lg-9 col-md-8">{{$synthstut->email}}</div>
            </div>

        </div>

    </section>
</div>

<script>
    var prenomNOM = document.getElementById('prenomNOM').innerText + 'CSV.json';
    var csv = document.getElementById('csv').innerText;
    var hiddenElement = document.querySelector('#csvDownload');
    hiddenElement.setAttribute("href", 'data:text/json;charset=utf-8,' + encodeURI(csv))
    hiddenElement.setAttribute("target", '_blank')
    hiddenElement.setAttribute("download", prenomNOM)

    var prenomNOM = document.getElementById('prenomNOM').innerText + 'POSTEUR.json';
    var jsonData = document.getElementById('jsonData').innerText;
    var hiddenElement = document.querySelector('#downloadFile');
    hiddenElement.setAttribute("href", 'data:text/json;charset=utf-8,' + encodeURI(jsonData))
    hiddenElement.setAttribute("target", '_blank')
    hiddenElement.setAttribute("download", prenomNOM)
</script>

@endsection
