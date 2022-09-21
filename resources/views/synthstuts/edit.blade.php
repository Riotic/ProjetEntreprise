@extends('dashboard.home')

@section('main')
<div class=main_div>
        <div class="square">
            <div class="row">
                <div class="col-md-9">
                    <form action="{{ route('synthstuts.update', $synthstut->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Photo de profil JPG/PNG</h5>
                                <p>Veuillez mettre une photo de 200x200 en dessous de 2000ko/2Mo s'il vous plaît</p>
                                <img src="../TuT_profil_pictures/{{$synthstut->photoProfil}}" style="height: 300px;"/>
                                <input class="form-control" value="{{$synthstut->photoProfil}}"  type="file" placeholder="Photo de profil"  name="photoProfil"><br>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Photo Couverture</h5>
                                <p>Veuillez mettre une photo de 800x800 en dessous de 2000ko/2Mo s'il vous plaît</p>
                                <div class="child">
                                    <img src="../TuT_wallpaper/{{$synthstut->photoCouverture}}" style="height: 300px;" alt="product {{$synthstut->photoCouverture}} picture"><br>
                                </div>
                                <input class="form-control" type="file" placeholder="Photo de Couverture"  name="photoCouverture"><br>
                            </div>
                        </div>
                        <p></p>
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Photo de carrousel 1</h5>
                                <p>Veuillez mettre des photos de 1170x400 approximativement en dessous de 2000ko/2Mo s'il vous plaît</p>
                                <div class="child">
                                    <img src="../TuT_carrousel/{{$synthstut->photoCarrousel1}}" style="height: 300px;" alt="product {{$synthstut->photoCarrousel1}} picture"><br>
                                </div>
                                <input class="form-control" type="file" placeholder="Photo Carrousel 1"  name="photoCarrousel1"><br>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Photo de carrousel 2</h5>
                                <div class="child">
                                    <img src="../TuT_carrousel/{{$synthstut->photoCarrousel2}}" style="height: 300px;" alt="product {{$synthstut->photoCarrousel2}} picture"><br>
                                </div>
                                <input class="form-control" type="file" placeholder="Photo Carrousel 2"  name="photoCarrousel2"><br>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Photo de carrousel 3</h5>
                                <div class="child">
                                    <img src="../TuT_carrousel/{{$synthstut->photoCarrousel3}}" style="height: 300px;" alt="product {{$synthstut->photoCarrousel3}} picture"><br>
                                </div>
                                <input class="form-control" type="file" placeholder="Photo Carrousel 3"  name="photoCarrousel3"><br>
                            </div>
                        </div>
                        <p></p>
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Prenom</h5>
                                <input class="form-control" type="text" placeholder="Prenom" value='{{$synthstut->prenom}}' name="prenom"><br>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">NOM</h5>
                                <input class="form-control" type="text" placeholder="NOM" value='{{$synthstut->nom}}' name="nom"><br>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Metier</h5>
                                <input class="form-control" type="text" placeholder="Metier" value='{{$synthstut->metier}}' name="metier"><br>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <small>Remplissez l'adresse au fur et à mesure et validez à la fin</small><br>
                                <p>Si la personne n'a pas d'adresse ayant le même format "1, Rue Victor Hugo - Paris" passez cette partie sans rien remplir".</p><br>
                                <h5 class="card-title">Adresse</h5>
                                <input class="form-control" class="form-control" type="text" placeholder="Adresse" value='{{$synthstut->adresse}}' id='adress' name="adresse" >
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <small>Remplissez l'adresse au fur et à mesure et validez à la fin</small><br>
                                <p>Si la personne n'a pas d'adresse ayant le même format "1, Rue Victor Hugo - Paris" passez cette partie sans rien remplir".</p><br>
                                <h5 class="card-title">Deuxieme adresse</h5>
                                <input class="form-control" class="form-control" type="text" placeholder="Adresse" value='{{$synthstut->adresseBis}}' id='adressBis' name="adresseBis" >
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Telephone</h5>
                                <small>Format:06 41 89 43 01</small><br>
                                <input class="form-control" type="tel" placeholder="Telephone" value='{{$synthstut->telephone}}' pattern="[0]{1}[0-9]{1} [0-9]{2} [0-9]{2} [0-9]{2} [0-9]{2}" name="telephone" title="Ecrivez le numéro de téléphone en respectant le format qui vous est indiqué"><br>

                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Email</h5>
                                <input class="form-control" type="email" placeholder="Email" value='{{$synthstut->email}}' name="email"><br>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Website</h5>
                                <input class="form-control" type="text" pattern="https?://.+/" title="Ecrivez le site sous format http(s) avec un / à la fin comme indiqué si dessus" placeholder="Website" value='{{$synthstut->website}}' name="website"><br>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">instagram</h5>
                                <input class="form-control" type="text" pattern="https?://.+/" title="Ecrivez le site sous format http(s) avec un / à la fin comme indiqué si dessus" placeholder="instagram" value='{{$synthstut->instagram}}' name="instagram"><br>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">twitter</h5>
                                <input class="form-control" type="text" pattern="https?://.+/" title="Ecrivez le site sous format http(s) avec un / à la fin comme indiqué si dessus" placeholder="twitter" value='{{$synthstut->twitter}}' name="twitter"><br>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Linkedin</h5>
                                <input class="form-control" type="text" pattern="https?://.+/" title="Ecrivez le site sous format http(s) avec un / à la fin comme indiqué si dessus" placeholder="Linkedin" value='{{$synthstut->linkedin}}' name="linkedin"><br>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Facebook</h5>
                                <input class="form-control" type="text" pattern="https?://.+/" title="Ecrivez le site sous format http(s) avec un / à la fin comme indiqué si dessus" placeholder="Facebook" value='{{$synthstut->facebook}}' name="facebook"><br>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Youtube</h5>
                                <input class="form-control" type="text" pattern="https?://.+/" title="Ecrivez le site sous format http(s) avec un / à la fin comme indiqué si dessus" placeholder="Youtube" value='{{$synthstut->youtube}}' name="youtube"><br>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Horaires</h5>
                                <input hidden id="stockHoraire" name="horaire" value='{{$synthstut->horaire}}'>
                                <input class="form-control" disabled type="text" placeholder="Horaires" value='Anciennes horaires = {{$synthstut->horaire}}'><br>
                                <p>Important : Veuillez remplir les cases des jours que désirez modifier en suivant ces horaires (ex: midi = 12 - 00, neuf heures = 09 - 00, en evitant les horaires comme 12h 69).</p>
                                <p>Lundi : Horaire Ouverture - <input id="lundiMatin1" class="input-hour" maxlength="2" pattern="[0-2]{1}[0-9]{1}"> - <input id="lundiMatin2" class="input-hour" maxlength="2" pattern="[0-5]{1}[0-9]{1}"> : Horaire Fermeture - <input id="lundiApresMidi1" class="input-hour" maxlength="2" pattern="[0-2]{1}[0-9]{1}"> - <input id="lundiApresMidi2" class="input-hour" maxlength="2" pattern="[0-5]{1}[0-9]{1}"></p>
                                <p>Mardi : Horaire Ouverture - <input id="mardiMatin1" class="input-hour" maxlength="2" pattern="[0-2]{1}[0-9]{1}"> - <input id="mardiMatin2" class="input-hour" maxlength="2" pattern="[0-5]{1}[0-9]{1}"> : Horaire Fermeture - <input id="mardiApresMidi1" class="input-hour" maxlength="2" pattern="[0-2]{1}[0-9]{1}"> - <input id="mardiApresMidi2" class="input-hour" maxlength="2" pattern="[0-5]{1}[0-9]{1}"></p>
                                <p>Mercredi : Horaire Ouverture - <input id="mercrediMatin1" class="input-hour" maxlength="2" pattern="[0-2]{1}[0-9]{1}"> - <input id="mercrediMatin2" class="input-hour" maxlength="2" pattern="[0-5]{1}[0-9]{1}"> : Horaire Fermeture - <input id="mercrediApresMidi1" class="input-hour" maxlength="2" pattern="[0-2]{1}[0-9]{1}"> - <input id="mercrediApresMidi2" class="input-hour" maxlength="2" pattern="[0-5]{1}[0-9]{1}"></p>
                                <p>Jeudi : Horaire Ouverture - <input id="jeudiMatin1" class="input-hour" maxlength="2" pattern="[0-2]{1}[0-9]{1}"> - <input id="jeudiMatin2" class="input-hour" maxlength="2" pattern="[0-5]{1}[0-9]{1}"> : Horaire Fermeture - <input id="jeudiApresMidi1" class="input-hour" maxlength="2" pattern="[0-2]{1}[0-9]{1}"> - <input id="jeudiApresMidi2" class="input-hour" maxlength="2" pattern="[0-5]{1}[0-9]{1}"></p>
                                <p>Vendredi : Horaire Ouverture - <input id="vendrediMatin1" class="input-hour" maxlength="2" pattern="[0-2]{1}[0-9]{1}"> - <input id="vendrediMatin2" class="input-hour" maxlength="2" pattern="[0-5]{1}[0-9]{1}"> : Horaire Fermeture - <input id="vendrediApresMidi1" class="input-hour" maxlength="2" pattern="[0-2]{1}[0-9]{1}"> - <input id="vendrediApresMidi2" class="input-hour" maxlength="2" pattern="[0-5]{1}[0-9]{1}"></p>
                                <p>Samedi : Horaire Ouverture - <input id="samediMatin1" class="input-hour" maxlength="2" pattern="[0-2]{1}[0-9]{1}"> - <input id="samediMatin2" class="input-hour" maxlength="2" pattern="[0-5]{1}[0-9]{1}"> : Horaire Fermeture - <input id="samediApresMidi1" class="input-hour" maxlength="2" pattern="[0-2]{1}[0-9]{1}"> - <input id="samediApresMidi2" class="input-hour" maxlength="2" pattern="[0-5]{1}[0-9]{1}"></p>
                                <p>Dimanche : Horaire Ouverture - <input id="dimancheMatin1" class="input-hour" maxlength="2" pattern="[0-2]{1}[0-9]{1}"> - <input id="dimancheMatin2" class="input-hour" maxlength="2" pattern="[0-5]{1}[0-9]{1}"> : Horaire Fermeture - <input id="dimancheApresMidi1" class="input-hour" maxlength="2" pattern="[0-2]{1}[0-9]{1}"> - <input id="dimancheApresMidi2" class="input-hour" maxlength="2" pattern="[0-5]{1}[0-9]{1}"></p>
                                <p id="validateHour" onclick="getHoraires()" class="btn btn-primary btn-sm">Valider</p>
                                <input class="form-control" id="displayNewHour" disabled type="text" value='Nouvelles horaires'><br>
                            </div>

                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Mots-Clés</h5>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="input-group mb-3">
                                            <input type="text"  class="form-control" value='{{$synthstut->motsClefs}}' id="motsClefs" name="motsClefs" aria-describedby="basic-addon2">
                                        </div>
                                    </div>
                                </div>
                                <p id="allkeyword"></p>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
				<h5 class="card-title">Departement</span></h5>
				<input class="form-control" type="text" hidden name="departement" id="changeDep" value="{{$synthstut->departement}}" >
                                <input class="form-control" type="text" disabled value="Departement actuel : {{$synthstut->departement}}"><br>
				<div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Ne cliquez pas sur le select si vous ne voulez pas changer de département</h5>
                                        <small>Choississez Le Département</small><br>
                                        <select onclick="checkIfSelectClicked()" class="form-control" id="departement" value="{{$synthstut->departement}}" >
                                                @include('components.departementTUT')
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Citation</h5>
                                <input class="form-control" type="text" placeholder="Citation" value='{{$synthstut->citation}}' name="citation"><br>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Synthèse</h5>
                                <div class="quill-editor-full" id="init_synthese" data-placeholder="Ecrivez la synthèse ici" placeholder="Ecrivez la synthèse ici">
                                    <?PHP echo $synthstut->synthese; ?>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Aperçu Synthèse</h5>
                                <p id="result" class="ql-editor"></p>
                                <textarea style="display: none;" id="synthese" name="synthese" value='test' placeholder="Synthèse" id="" cols="30" rows="10"></textarea><br>
                            </div>
                        </div>
                        @if (Auth::user()->role == 'admin' || Auth::user()->role == 'formatrice')
                            <button class="btn btn-success" name="action" onclick="test()" type="submit" value="edit">Modifier</button>
                            <div style="position: fixed; bottom: 25px; right: 100px; "><button name="action" onclick="test()" type="submit" value="save"> Sauvegarder le travail déja effectué</button> </div>
                        @endif

                    </form>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="title text color-red">
                                <br>
                                <h4 class="card-title">Modifications Démandées par le Thérapeute</h4>
                            </div>
                            <div class="body">
                                <div class="accordion accordion-flush" id="accordionFlushExample">
                                    <div class="accordion-item">

                                      @each('messenger.partials.messages', $thread->messages, 'message')

                                      @include('messenger.partials.form-message')
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>

<style>
    .ql-image {
        display: none !important;
    }
</style>
<script>
    function capitalizeFirstLetter(str) {
        const capitalized = str.charAt(0).toUpperCase() + str.slice(1);
        return capitalized;
    }
</script>
<script>
    var intervalId = window.setInterval(function() {
        var myEditor = document.querySelector('#init_synthese');
        var html = myEditor.children[0].innerHTML;
        document.getElementById('synthese').innerHTML = html;
        result.innerHTML = html;
        //setCookie('html', html, 30);
    }, 3000);
</script>
<script>
    selectClicked = 0;
    function checkIfSelectClicked() {
        selectClicked = 1;
    }

    function test() {
        if (selectClicked == 1){
            x = document.getElementById('departement').value;
    	    document.getElementById('changeDep').value = x;
        } else {
            console.log('aucun département renseigné')
        }
    }


    function makeAGoodHourFormatOutOfValues(idHoraire1, idHoraire2, idHoraire3, idHoraire4){
        hourFormat = document.getElementById(idHoraire1).value + ':'
        + document.getElementById(idHoraire2).value + ',' +
        document.getElementById(idHoraire3).value + ':' +
        document.getElementById(idHoraire4).value + '|';
        return hourFormat;
    }
    function checkIfThereIsHour(hour){
        check = hour.split(',');
        if ( (check[1].length > 4) && (check[2].length > 4)){
            horaires.push(hour);
            return hour;
        } else {
            return false;
        }
    }
    function getHoraires() {
        horaires = [];
        lundiHoraire = "Lundi," + makeAGoodHourFormatOutOfValues("lundiMatin1","lundiMatin2","lundiApresMidi1","lundiApresMidi2");
        mardiHoraire = "Mardi," + makeAGoodHourFormatOutOfValues("mardiMatin1","mardiMatin2","mardiApresMidi1","mardiApresMidi2");
        mercrediHoraire = "Mercredi," + makeAGoodHourFormatOutOfValues("mercrediMatin1","mercrediMatin2","mercrediApresMidi1","mercrediApresMidi2");
        jeudiHoraire = "Jeudi," + makeAGoodHourFormatOutOfValues("jeudiMatin1","jeudiMatin2","jeudiApresMidi1","jeudiApresMidi2");
        vendrediHoraire = "Vendredi," + makeAGoodHourFormatOutOfValues("vendrediMatin1","vendrediMatin2","vendrediApresMidi1","vendrediApresMidi2");
        samediHoraire = "Samedi," + makeAGoodHourFormatOutOfValues("samediMatin1","samediMatin2","samediApresMidi1","samediApresMidi2");
        dimancheHoraire = "dimanche," + makeAGoodHourFormatOutOfValues("dimancheMatin1","dimancheMatin2","dimancheApresMidi1","dimancheApresMidi2");
        lundiHoraire = checkIfThereIsHour(lundiHoraire);
        mardiHoraire = checkIfThereIsHour(mardiHoraire);
        mercrediHoraire = checkIfThereIsHour(mercrediHoraire);
        jeudiHoraire = checkIfThereIsHour(jeudiHoraire);
        vendrediHoraire = checkIfThereIsHour(vendrediHoraire);
        samediHoraire = checkIfThereIsHour(samediHoraire);
        dimancheHoraire = checkIfThereIsHour(dimancheHoraire);
        horaires = horaires.join('');
        document.getElementById("displayNewHour").value = horaires;
        document.getElementById("stockHoraire").value = horaires;
    }

</script>
@endsection

