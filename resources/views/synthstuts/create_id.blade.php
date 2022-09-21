
@extends('dashboard.home') @section('main')
<div class=main_div>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="row">
        <div class="middlesquare col-md-9">
            <input class="form-control" type="hidden" name="" value="@auth <?php echo Auth::user()->id; ?>  @endauth">
            @php $users = DB::select('select * from users where id='.$id.' ;'); @endphp
            @foreach ($users as $user)
            <form action="{{ route('synthstuts.storeWithId', $user->id ) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id_synthese" value="{{ $id }}">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Photo de profil JPG/PNG</h5>
                        <p>Veuillez mettre une photo de 200x200 en dessous de 2000ko/2Mo s'il vous plaît</p>
                        <input class="form-control" type="file" placeholder="Photo de profil" name="photoProfil"><br>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Photo Couverture</h5>
                        <p>Veuillez mettre une photo de 800x800 en dessous de 2000ko/2Mo s'il vous plaît</p>
                        <input class="form-control" type="file" placeholder="Photo de Couverture" name="photoCouverture"><br>
                    </div>
                </div>
                <p></p>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Photo de carrousel 1</h5>
                        <p>Veuillez mettre des photos de 1170x400 approximativement en dessous de 2000ko/2Mo s'il vous plaît</p>
                        <input class="form-control" type="file" placeholder="Photo Carrousel 1" name="photoCarrousel1"><br>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Photo de carrousel 2</h5>
                        <input class="form-control" type="file" placeholder="Photo Carrousel 2" name="photoCarrousel2"><br>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Photo de carrousel 3</h5>
                        <input class="form-control" type="file" placeholder="Photo Carrousel 3" name="photoCarrousel3"><br>
                    </div>
                </div>
                <p></p>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Prenom</h5>
                        <input class="form-control" type="text" placeholder="Prenom" value='{{ $user->surname }}' name="prenom"><br>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">NOM</h5>
                        <input class="form-control" type="text" placeholder="NOM" value='{{ $user->name }}' name="nom"><br>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Metier</h5>
                        <input class="form-control" type="text" placeholder="Metier" value='' name="metier"><br>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Adresse</h5>
                        <p><small> Si la personne n'a pas d'adresse ayant le même format "1, Rue Victor Hugo - Paris" passez cette partie sans rien remplir".</small></p><br>
                        <div id="map"></div>
                        <input class="form-control" type="text" placeholder="Adresse" value='' id='adress' name="adresse" hidden> <input type="text" placeholder="N'oubliez pas de valider votre adresse" id='display' name="adresse" disabled>
                        <div class="btn btn-primary" onclick=refreshAdress()>Valider adresse</div><br>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Deuxieme Adresse</h5>
                        <p><small> Si la personne n'a pas d'adresse ayant le même format "1, Rue Victor Hugo - Paris" passez cette partie sans rien remplir".</small></p><br>
                        <div id="map"></div>
                        <input class="form-control" type="text" placeholder="Deuxieme Adresse" value='' id='adressBis' name="adresseBis" hidden> <input type="text" placeholder="N'oubliez pas de valider votre adresse" id='displayBis' name="adresseBis" disabled>
                        <div class="btn btn-primary" onclick=refreshAdress2()>Valider deuxieme adresse</div><br>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Telephone</h5>
                        <small>Format:06 41 89 43 01</small><br>
                        <input class="form-control" type="tel" placeholder="Exemple: 06 41 89 43 01" value='' pattern="[0]{1}[0-9]{1} [0-9]{2} [0-9]{2} [0-9]{2} [0-9]{2}" name="telephone" title="Ecrivez le numéro de téléphone en respectant le format qui vous est indiqué"><br>

                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Email</h5>
                        <input class="form-control" type="email" placeholder="Email" value='{{ $user->email }}' name="email"><br>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Website</h5>
                        <small>Format : http(s)://website.com/</small><br>
                        <input class="form-control" type="text" pattern="https?://.+/" title="Ecrivez le site sous format http(s) avec un / à la fin comme indiqué si dessus" placeholder="Website" value='' name="website"><br>
                    </div>
                </div>
		<div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Instagram</h5>
                        <small>Format : http(s)://instagram.com/</small><br>
                        <input class="form-control" type="text" pattern="https?://.+/" title="Ecrivez le site sous format http(s) avec un / à la fin comme indiqué si dessus"  placeholder="Exemple: https://instagram.com " value='' name="instagram"><br>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Twitter</h5>
                        <small>Format : http(s)://twitter.com/</small><br>
                        <input class="form-control" type="text" pattern="https?://.+/" title="Ecrivez le site sous format http(s) avec un / à la fin comme indiqué si dessus"  placeholder="Exemple: https://twitter.com " value='' name="twitter"><br>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Linkedin</h5>
                        <small>Format : http(s)://linkedin.fr/</small><br>
                        <input class="form-control" type="text" pattern="https?://.+/" title="Ecrivez le site sous format http(s) avec un / à la fin comme indiqué si dessus" placeholder="Linkedin" value='' name="linkedin"><br>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Facebook</h5>
                        <small>Format : http(s)://facebook.com/</small><br>
                        <input class="form-control" type="text" pattern="https?://.+/" title="Ecrivez le site sous format http(s) avec un / à la fin comme indiqué si dessus" placeholder="Facebook" value='' name="facebook"><br>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Youtube</h5>
                        <small>Format : http(s)://youtube.com/</small><br>
                        <input class="form-control" type="text" pattern="https?://.+/" title="Ecrivez le site sous format http(s) avec un / à la fin comme indiqué si dessus" placeholder="Youtube" value='' name="youtube"><br>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Horaires</h5>
                        <div class="d-grid gap-2 mt-3">
                            <button data-bs-toggle="modal" data-bs-target="#ExtralargeModal" class="btn btn-primary" type="button">Ajouter les horaires</button>
                        </div>
                        <input class="form-control" type="text" placeholder="Horaires" readonly value='' id="horaire" name="horaire"><br>
                        <div class="modal fade" id="ExtralargeModal" tabindex="-1" style="display: none;" aria-hidden="true">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <div class="col-6">
                                            <h5 class="modal-title">Sélectionnez les Horaires  </h5>
                                        </div>
                                        <div class="col-6">
                                            ou <a class="float-right btn btn-warning rounded-pill btn-block" onclick="manuelHour()"> Ajouter Manuellement</a>
                                        </div>
                                        <button type="button" class="btn-close btn-danger" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div><div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-2">
                                                Lundi
                                            </div>
                                            <div class="col-md-10">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label class="">Heure d'Ouverture</label>
                                                        <select id="Lundihourstart" type="text" class="form-control" name="Lundihourstart">
                                                        <?php
                                                            $start=strtotime('08:00');
                                                            $end=strtotime('16:30');

                                                            for ($i=$start;$i<=$end;$i = $i + 15*60)
                                                            {
                                                            echo '<option value="'.date('H:i A',$i).'">'.date('H:i A',$i).' </option>';
                                                            }
                                                        ?>
                                                    </select>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="">Heure de Fermeture</label>
                                                        <select id="Lundihourend" type="text" class="form-control" name="Lundihourend">
                                                        <?php
                                                            $start=strtotime('18:00');
                                                            $end=strtotime('20:30');

                                                            for ($i=$start;$i<=$end;$i = $i + 15*60)
                                                            {
                                                            echo '<option value="'.date('H:i A',$i).'">'.date('H:i A',$i).' </option>';
                                                            }
                                                        ?>
                                                    </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-2">
                                                Mardi
                                            </div>
                                            <div class="col-md-10">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label class="">Heure d'Ouverture</label>
                                                        <select id="Mardihourstart" type="text" class="form-control" name="Mardihourstart">
                                                        <?php
                                                            $start=strtotime('08:00');
                                                            $end=strtotime('16:30');

                                                            for ($i=$start;$i<=$end;$i = $i + 15*60)
                                                            {
                                                            echo '<option value="'.date('H:i A',$i).'">'.date('H:i A',$i).' </option>';
                                                            }
                                                        ?>
                                                    </select>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="">Heure de Fermeture</label>
                                                        <select id="Mardihourend" type="text" class="form-control" name="Mardihourend">
                                                        <?php
                                                            $start=strtotime('18:00');
                                                            $end=strtotime('20:30');

                                                            for ($i=$start;$i<=$end;$i = $i + 15*60)
                                                            {
                                                            echo '<option value="'.date('H:i A',$i).'">'.date('H:i A',$i).' </option>';
                                                            }
                                                        ?>
                                                    </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-2">
                                                Mercredi
                                            </div>
                                            <div class="col-md-10">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label class="">Heure d'Ouverture</label>
                                                        <select id="Mercredihourstart" type="text" class="form-control" name="Mercredihourstart">
                                                        <?php
                                                            $start=strtotime('08:00');
                                                            $end=strtotime('16:30');

                                                            for ($i=$start;$i<=$end;$i = $i + 15*60)
                                                            {
                                                            echo '<option value="'.date('H:i A',$i).'">'.date('H:i A',$i).' </option>';
                                                            }
                                                        ?>
                                                    </select>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="">Heure de Fermeture</label>
                                                        <select id="Mercredihourend" type="text" class="form-control" name="Mercredihourend">
                                                        <?php
                                                            $start=strtotime('18:00');
                                                            $end=strtotime('20:30');

                                                            for ($i=$start;$i<=$end;$i = $i + 15*60)
                                                            {
                                                            echo '<option value="'.date('H:i A',$i).'">'.date('H:i A',$i).' </option>';
                                                            }
                                                        ?>
                                                    </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-2">
                                                Jeudi
                                            </div>
                                            <div class="col-md-10">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label class="">Heure d'Ouverture</label>
                                                        <select id="Jeudihourstart" type="text" class="form-control" name="Jeudihourstart">
                                                        <?php
                                                            $start=strtotime('08:00');
                                                            $end=strtotime('16:30');

                                                            for ($i=$start;$i<=$end;$i = $i + 15*60)
                                                            {
                                                            echo '<option value="'.date('H:i A',$i).'">'.date('H:i A',$i).' </option>';
                                                            }
                                                        ?>
                                                    </select>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="">Heure de Fermeture</label>
                                                        <select id="Jeudihourend" type="text" class="form-control" name="Jeudihourend">
                                                        <?php
                                                            $start=strtotime('18:00');
                                                            $end=strtotime('20:30');

                                                            for ($i=$start;$i<=$end;$i = $i + 15*60)
                                                            {
                                                            echo '<option value="'.date('H:i A',$i).'">'.date('H:i A',$i).' </option>';
                                                            }
                                                        ?>
                                                    </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-2">
                                                Vendredi
                                            </div>
                                            <div class="col-md-10">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label class="">Heure d'Ouverture</label>
                                                        <select id="Vendredihourstart" type="text" class="form-control" name="Vendredihourstart">
                                                        <?php
                                                            $start=strtotime('08:00');
                                                            $end=strtotime('16:30');

                                                            for ($i=$start;$i<=$end;$i = $i + 15*60)
                                                            {
                                                            echo '<option value="'.date('H:i A',$i).'">'.date('H:i A',$i).' </option>';
                                                            }
                                                        ?>
                                                    </select>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="">Heure de Fermeture</label>
                                                        <select id="Vendredihourend" type="text" class="form-control" name="Vendredihourend">
                                                        <?php
                                                            $start=strtotime('18:00');
                                                            $end=strtotime('20:30');

                                                            for ($i=$start;$i<=$end;$i = $i + 15*60)
                                                            {
                                                            echo '<option value="'.date('H:i A',$i).'">'.date('H:i A',$i).' </option>';
                                                            }
                                                        ?>
                                                    </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-2">
                                                Samedi
                                            </div>
                                            <div class="col-md-10">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label class="">Heure d'Ouverture</label>
                                                        <select id="Samedihourstart" type="text" class="form-control" name="Samedihourstart">
                                                        <?php
                                                            $start=strtotime('08:30');
                                                            $end=strtotime('16:30');

                                                            for ($i=$start;$i<=$end;$i = $i + 15*60)
                                                            {
                                                            echo '<option value="'.date('H:i A',$i).'">'.date('H:i A',$i).' </option>';
                                                            }
                                                        ?>
                                                    </select>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="">Heure de Fermeture</label>
                                                        <select id="Samedihourend" type="text" class="form-control" name="Samedihourend">
                                                        <?php
                                                            $start=strtotime('18:00');
                                                            $end=strtotime('20:30');

                                                            for ($i=$start;$i<=$end;$i = $i + 15*60)
                                                            {
                                                            echo '<option value="'.date('H:i A',$i).'">'.date('H:i A',$i).' </option>';
                                                            }
                                                        ?>
                                                    </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" id="dismissExtralargeModal" data-bs-dismiss="modal">Annuler   </button>
                                        <button type="button" class="btn btn-primary" onclick="AddSchedule()">Sauvegarder</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Mots-Clés</h5>
                        <div class="row">
                            <div class="col-md-9">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" value='' id="initial_motsClefs" name="initial_motsClefs" placeholder="Mots-Clé sans therapeute" aria-label="Mots-Clé" aria-describedby="basic-addon2">
                                    <span class="input-group-text" id="basic-addon2"> </span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <small>Veuillez ajouter un mot clé à la fois avec la première lettre en majuscule</small><br>
                                <a href="javascript:void(Addkeyword())" class="btn btn-primary btn-block ">Ajouter un Mots-Clé</a> <br>
                            </div>
                        </div>
                        <input type="text" hidden class="form-control" value='' id="motsClefs" name="motsClefs" aria-describedby="basic-addon2">
                        <p id="allkeyword"></p>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Departement</h5>
                        <select name="departement" class="form-control" id="departement">
                            @include('components.departementTUT')
                        </select>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Citation</h5>
                        <input class="form-control" type="text" placeholder="Citation" value='' name="citation"><br>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Synthèse</h5>
                        <div class="quill-editor-full" id="init_synthese" data-placeholder="Ecrivez la synthèse ici" placeholder="Ecrivez la synthèse ici">
                            <p></p>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Aperçu Synthèse</h5>
                        <p id="result" class="ql-editor"></p>
                        <textarea style="display: none;" id="synthese" name="synthese" value='' placeholder="Synthèse" id="" cols="30" rows="10"></textarea><br>
                    </div>
                </div>
                <button class="btn btn-success" name="action" type="submit" value="create">CREER</button>
                <div style="position: fixed;
                bottom: 25px;
                right: 100px; "><button name="action" type="submit" value="save"> Sauvegarder le travail déja effectué</button> </div>
            </form>
            @endforeach
        </div>
    </div>

</div>

<style>
    .ql-image {
        display: none !important;
    }
</style>
<script>
    function refreshAdress() {
        var marker = document.getElementById("marker").value;
        document.getElementById("adress").value = marker;
        document.getElementById("display").value = marker;
    }
    function refreshAdress2() {
        var marker = document.getElementById("marker").value;
        document.getElementById("adressBis").value = marker;
        document.getElementById("displayBis").value = marker;
    }
</script>
<script>
    function capitalizeFirstLetter(str) {
        const capitalized = str.charAt(0).toUpperCase() + str.slice(1);
        return capitalized;
    }

    listOfAllKeyWords = [];
    x = 0;

    function supressKeyWord(d) {
    var test = document.getElementById(`keyWords${d}`);
    test.remove();
    listOfAllKeyWords.splice(d,1);
    document.getElementById("motsClefs").value = listOfAllKeyWords;
    }
    function Addkeyword() {
        a = document.getElementById("initial_motsClefs").value;

        document.getElementById("initial_motsClefs").value = capitalizeFirstLetter(a);
        var keyword = document.getElementById("initial_motsClefs").value;
        if (keyword.length > 2) {
            x = x + 1;
            document.getElementById("allkeyword").innerHTML += `<span class='badge rounded-pill bg-primary m-0 p-2 pl-5' id='keyWords${x}'>` + keyword + `<i class='bi bi-x' onclick='supressKeyWord(${x})'></i></span>`;
            document.getElementById("initial_motsClefs").value = "";
            listOfAllKeyWords.push(" " + keyword);
        } else {
            swal("Error!", " Ajouter du texte !", "error");
        }
        document.getElementById("motsClefs").value = listOfAllKeyWords;
	}
</script>
<script>
    function AddSchedule() {
        Lundi = "Lundi," + document.getElementById('Lundihourstart').value + "," + document.getElementById('Lundihourend').value;
        Lundi = Lundi.replaceAll(' AM', '');
        Lundi = Lundi.replaceAll(' PM', '');
        Mardi = "Mardi," + document.getElementById('Mardihourstart').value + "," + document.getElementById('Mardihourend').value;
        Mardi = Mardi.replaceAll(' AM', '');
        Mardi = Mardi.replaceAll(' PM', '');
        Mercredi = "Mercredi," + document.getElementById('Mercredihourstart').value + "," + document.getElementById('Mercredihourend').value;
        Mercredi = Mercredi.replaceAll(' AM', '');
        Mercredi = Mercredi.replaceAll(' PM', '');
        Jeudi = "Jeudi," + document.getElementById('Jeudihourstart').value + "," + document.getElementById('Jeudihourend').value;
        Jeudi = Jeudi.replaceAll(' AM', '');
        Jeudi = Jeudi.replaceAll(' PM', '');
        Vendredi = "Vendredi," + document.getElementById('Vendredihourstart').value + "," + document.getElementById('Vendredihourend').value;
        Vendredi = Vendredi.replaceAll(' AM', '');
        Vendredi = Vendredi.replaceAll(' PM', '');
        Samedi = "Samedi," + document.getElementById('Samedihourstart').value + "," + document.getElementById('Samedihourend').value;
        Samedi = Samedi.replaceAll(' AM', '');
        Samedi = Samedi.replaceAll(' PM', '');
        document.getElementById("horaire").value = "" + Lundi + "|" + Mardi + "|" + Mercredi + "|" + Jeudi + "|" + Vendredi + "|" + Samedi;
        document.getElementById("dismissExtralargeModal").click();
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

<script type="text/javascript">
    function NoComma() {
        z = document.getElementById("motsClefs").value.slice(0, -2);
        document.getElementById("motsClefs").value = z;
    }
    function manuelHour(){
        document.getElementById("dismissExtralargeModal").click();
        swal("Ajouter d'autres horaires", {
        content: "input",
        })
        .then((value) => {
            swal(`Vous avez ajouté  :\n\n ${value} \n \n Si oui validé`).then(function(isConfirm) {
            if (isConfirm) {
            document.getElementById("horaire").value = value;
            }
            });
        });
        }
</script>
@endsection
