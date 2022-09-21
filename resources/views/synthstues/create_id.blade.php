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

            <input type="hidden" name="" value="@auth{{ Auth::user()->id }}@endauth"> @php $users = DB::select('select * from users where id='.$id.' ;'); @endphp @foreach ($users as $user)
            <form action="{{ route('synthstues.storeWithId', $user->id ) }}" method="POST" enctype="multipart/form-data">
                @csrf
                {{-- ?php echo $user->id; ? --}}
                <input type="hidden" name="id_synthese" value="{{ $id }}">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Photo de profil JPG/PNG</h5>
                        <input class="form-control" type="file" placeholder="Photo de profil" name="photoProfil"><br>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">CV en pdf</h5>
                        <input class="form-control" type="file" placeholder="CV" name="CV"><br>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Prenom</h5>
                        <input class="form-control" type="text" placeholder="Exemple: Jean " value='{{ $user->surname }}' name="prenom" required><br>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">NOM</h5>
                        <input class="form-control" type="text" placeholder="Exemple: RICHARD  " value='{{ $user->name }}' name="nom" required><br>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Metier</h5>
                        <input class="form-control" type="text" placeholder="Exemple : Conseiller" value='' name="metier" required><br>
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
                        <h5 class="card-title">Telephone</h5>
                        <small>Format : XX XX XX XX XX</small><br>
                        <input class="form-control" type="tel" id="telephone" placeholder="Exemple: 06 41 89 43 01" title="Ecrivez le numéro de téléphone en respectant le format qui vous est indiqué" value='' pattern="[0]{1}[0-9]{1} [0-9]{2} [0-9]{2} [0-9]{2} [0-9]{2}" name="telephone"><br>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Email</h5>
                        <input class="form-control" type="email" placeholder="Exemple : test@test.com" value='{{ $user->email }}' name="email" required><br>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Website</h5>
                        <small>Format : http(s)://website.com/</small><br>
                        <input class="form-control" type="text" pattern="https?://.+/" title="Ecrivez le site sous format http(s) avec un / à la fin comme indiqué si dessus"  placeholder="Exemple: https://website.com " value='' name="website"><br>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">instagram</h5>
                        <small>Format : http(s)://instagram.com/</small><br>
                        <input class="form-control" type="text" pattern="https?://.+/" title="Ecrivez le site sous format http(s) avec un / à la fin comme indiqué si dessus"  placeholder="Exemple: https://instagram.com " value='' name="instagram"><br>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">twitter</h5>
                        <small>Format : http(s)://twitter.com/</small><br>
                        <input class="form-control" type="text" pattern="https?://.+/" title="Ecrivez le site sous format http(s) avec un / à la fin comme indiqué si dessus"  placeholder="Exemple: https://twitter.com " value='' name="twitter"><br>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">facebook</h5>
                        <small>Format : http(s)://facebook.com/</small><br>
                        <input class="form-control" type="text" pattern="https?://.+/" title="Ecrivez le site sous format http(s) avec un / à la fin comme indiqué si dessus"  placeholder="Exemple: https://facebook.com " value='' name="facebook"><br>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Linkedin</h5>
                        <small>Format : http(s)://linkedin.fr/</small><br>
                        <input class="form-control" type="text" pattern="https?://.+/" title="Ecrivez le site sous format http(s) avec un / à la fin comme indiqué si dessus" placeholder="Exemple: https://www.linkedin.com/in/" value='' name="linkedin"><br>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Autre réseau social</h5>
                        <small>Format : http(s)://facebook.com/</small><br>
                        <input class="form-control" type="text" pattern="https?://.+/" title="Ecrivez le site sous format http(s) avec un / à la fin comme indiqué si dessus" placeholder="Exemple: https://www.facebook.com/profile" value='' name="reseau_autre"><br>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Experiences</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <ul>
                                    <div class="modal fade" id="largeModal" tabindex="-1" aria-hidden="true" style="display: none;">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <img src="https://i.ibb.co/7KKcgdc/egbw.jpg" alt="egbw" border="0" width="70px">
                                                    <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form ">
                                                        <label class="title text-capitalize" for="">Date de début :</label>
                                                        <input class="form-control" type="date" name="annee_debut" id="annee_debut">
                                                    </div>
                                                    <div class="form ">
                                                        <label class="title text-capitalize" for="">Date de fin :</label>
                                                        <input class="form-control" type="date" name="annee_fin" id="annee_fin" placeholder="Decrivez avec vos propres mots">
                                                    </div>
                                                    <div class="form ">
                                                        <label class="title text-capitalize" for="">Entreprises  :</label>
                                                        <input class="form-control" type="text" name="Entreprises" id="Entreprises" placeholder="Titre de l'entreprise">
                                                    </div>
                                                    <div class="form ">
                                                        <label class="title text-capitalize" for="">Fonction occupée  :</label>
                                                        <input class="form-control" type="text" name="Fonction" id="Fonction" placeholder="Titre ">
                                                    </div>
                                                    <div class="form ">
                                                        <label class="title text-capitalize" for="">Mes missions / tâches  :</label>
                                                        <textarea class="form-control" type="text" name="missions" id="missions" placeholder="Decrivez avec vos propres mots"></textarea>
                                                    </div>
                                                    <div class="form ">
                                                        <textarea class="form-control" hidden type="text" hidden name="acquis" id="acquis" placeholder="Decrivez avec vos propres mots"></textarea>
                                                    </div>
                                                    <div class="form ">
                                                        <textarea class="form-control" hidden type="text" hidden name="commentaire" id="commentaire" placeholder="Decrivez avec vos propres mots"></textarea>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default _closeModal_" data-bs-dismiss="modal" id="closeModal">ANNULER</button>
                                                    <button type="button" class="btn btn-success btn-block" onclick="saveExp()">AJOUTER</button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#largeModal"> Ajouter une expérience  professionnelle </button>

                                </ul>
                            </div>
                            <table class="table table-responsive" id="pExp"></table>
                        </div>
                        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
                        <script>
                            var Exp = [];
                            var For = [];

                            function saveExp() {
                                if (document.getElementById('Fonction').value.length < 2) {
                                    swal("EXPERIENCE Vide !", " Ajouter du texte !", "error");
                                } else {
                                    Exp.push({
                                        "ANNEE DE DEBUT": document.getElementById('annee_debut').value,
                                        "ANNEE DE FIN": document.getElementById('annee_fin').value,
                                        "Fonction Occupee": document.getElementById('Fonction').value,
                                        "Entreprises": document.getElementById('Entreprises').value,
                                        "Missions - Tâches": document.getElementById('missions').value,
                                    });
                                    if (true) {
                                        console.log(Exp);
                                        document.getElementById('pExp').innerHTML += "<tr><td>" + document.getElementById('annee_debut').value + "</td><td>" + document.getElementById('annee_fin').value + "</td><td>" + document.getElementById('Entreprises').value + "</td><td>" + document.getElementById('Fonction').value + "</td><td>" + document.getElementById('acquis').value + "</td><td>" + document.getElementById('missions').value + "</td></tr>";
                                        document.getElementById('all_Exp').innerHTML = JSON.stringify(Exp);
                                        resetExp();
                                    } else {
                                        swal("Error!", " Veuillez actualiser la page!", "error");
                                    }
                                }
                            }

                            function saveFor() {
                                if (document.getElementById('Ecole_formation').value.length < 2) {
                                    swal("FORMATIONS Vide !", " Ajouter du texte !", "error");
                                } else {
                                    For.push({
                                        "ANNEE DE DEBUT": document.getElementById('annee_debut_formation').value,
                                        "ANNEE DE FIN": document.getElementById('annee_fin_formation').value,
                                        "Organisme / Ecole": document.getElementById('Ecole_formation').value,
                                        "Diplome": document.getElementById('Diplome_formation').value,
                                        "Buts de la formation": document.getElementById('Buts_formation').value,
                                    });
                                    if (true) {
                                        console.log(For);
                                        document.getElementById('pFor').innerHTML += "<tr><td>" + document.getElementById('annee_debut_formation').value + "</td><td>" + document.getElementById('annee_fin_formation').value + "</td><td>" + document.getElementById('Ecole_formation').value + "</td><td>" + document.getElementById('Diplome_formation').value + "</td><td>" + document.getElementById('Buts_formation').value + "</td></tr>";
                                        document.getElementById('all_For').innerHTML = JSON.stringify(For);
                                        resetFor();
                                    } else {
                                        swal("Error!", " Veuillez actualiser la page!", "error");
                                    }
                                }
                            }

                            function resetExp() {

                                var elements = document.getElementById("largeModal").getElementsByTagName('textarea');
                                for (var ii = 0; ii < elements.length; ii++) {
                                    elements[ii].value = "";
                                }
                                var elements = document.getElementById("largeModal").getElementsByTagName('input');
                                for (var ii = 0; ii < elements.length; ii++) {
                                    elements[ii].value = "";
                                }
                            }

                            function resetFor() {

                                var elements = document.getElementById("largeModalformation").getElementsByTagName('textarea');
                                for (var ii = 0; ii < elements.length; ii++) {
                                    elements[ii].value = "";
                                }
                                var elements = document.getElementById("largeModalformation").getElementsByTagName('input');
                                for (var ii = 0; ii < elements.length; ii++) {
                                    elements[ii].value = "";
                                }
                            }
                        </script>
                        <textarea class="form-control" hidden readonly type="text" id="all_Exp" placeholder="Experiences" name="experiences"></textarea>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Formations</h5>
                        <strong>MES FORMATIONS INITIALES ET CONTINUES</strong>
                        <div class="modal fade" id="largeModalformation" tabindex="-1" aria-hidden="true" style="display: none;">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <img src="https://i.ibb.co/7KKcgdc/egbw.jpg" alt="egbw" border="0" width="70px">
                                        <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form ">
                                            <label class="title text-capitalize" for="">Date de début :</label>
                                            <input class="form-control" type="date" name="annee_debut_formation " id="annee_debut_formation">
                                        </div>
                                        <div class="form ">
                                            <label class="title text-capitalize" for="">Date de fin :</label>
                                            <input class="form-control" type="date" name="annee_fin_formation" id="annee_fin_formation">
                                        </div>
                                        <div class="form ">
                                            <label class="title text-capitalize" for="">Organisme / Ecole / Université / Qualification  :</label>
                                            <input class="form-control" type="text" name="Ecole_formation" id="Ecole_formation" placeholder="Université">
                                        </div>
                                        <div class="form ">
                                            <label class="title text-capitalize" for="">Diplôme, niveau obtenu :</label>
                                            <input class="form-control" type="text" name="Diplome_formation" id="Diplome_formation" placeholder="Diplôme">
                                        </div>
                                        <div class="form ">
                                            <label class="title text-capitalize" for="">Buts  :</label>
                                            <textarea class="form-control" type="text" name="Buts_formation" id="Buts_formation" placeholder="Buts "></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default  " data-bs-dismiss="modal" id="closeModal">Cancel</button>
                                        <button type="button" class="btn btn-success btn-block" onclick="saveFor()">ADD</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <ul>
                            <button type="button" class="btn btn-block btn-success" data-bs-toggle="modal" data-bs-target="#largeModalformation">Ajouter une formation </button>
                        </ul>
                        <textarea hidden class="form-control" readonly id="all_For" type="text" placeholder="Formations " name="formations"></textarea>
                        <table class="table table-responsive" id="pFor"></table>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Departement</h5>
                        <small>Choississez Le Département</small><br>
                        <select name="departement" class="form-control" id="departement">
                                @include('components.departementTUC')
                            </select>
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
                        <textarea style="display: none;" class="form-control" name="synthese" value='' placeholder="Synthèse" id="synthese" cols="30" rows="10"></textarea><br> {{-- <input class="form-control" type="file" placeholder="Image" name="picture"><br>                        --}}

                    </div>
                </div>
                <button class="btn btn-primary btn-block btn-lg">
                        Créer
                    </button><br>

            </form>
            @endforeach
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <br>
                    <img src="https://i.ibb.co/KK8HYbQ/g.jpg" style="height: 90px" alt="" srcset="">
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <p>
                        <img src="https://easypdf.com/images/Word-to-PDF.png" style="height: 60px" alt="" srcset="">
                    </p>
                    <a class="btn btn-default btn-block btn-lg" href="https://smallpdf.com/word-to-pdf" target="_blank">CONVERTIR WORD EN PDF</a>
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
    document.getElementById('telephone').addEventListener('input', function (e) {
    e.target.value = e.target.value.replace(/[^\dA-Z]/g, '').replace(/(.{2})/g, '$1 ').trim();
    });
</script>
<script>
    function refreshAdress() {
        var marker = document.getElementById("marker").value;
        document.getElementById("adress").value = marker;
        document.getElementById("display").value = marker;
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
@endsection
