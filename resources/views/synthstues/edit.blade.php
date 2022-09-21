@extends('dashboard.home')

@section('main')
@php

use App\Models\User;
use Cmgmyr\Messenger\Models\Thread;
@endphp
<div class=main_div>
        <div class="square">
                    <div class="row">
                        <div class="col-md-8">

                            <form action="{{ route('synthstues.update', $synthstue->id) }}" method="POST" enctype="multipart/form-data">
                                {{ method_field('PUT') }}
                                @csrf
                            <!-- Recent Activity -->
                            <div class="card">
                              <div class="card-body">
                                <h5 class="card-title">Modifier la Synthèse <span>| {{$synthstue->nom}}</span></h5>

                                <h5>Photo de profil JPG/PNG</h5>
                                <div class="child">
                                    <img src="" alt="product {{$synthstue->photoProfil}} picture"><br>
                                </div>
                                <input class="form-control" type="file" placeholder="Photo de profil" value="{{$synthstue->photoProfil}}" name="photoProfil"><br>
                                <h5>CV en pdf</h5>
                                <input class="form-control" type="file" placeholder="CV" value="{{$synthstue->CV}}" name="CV"><br>

                                <h5 class="card-title">Metier</span></h5>
                                <input class="form-control" type="text" placeholder="Metier" value="{{$synthstue->metier}}" name="metier"><br>
                                <h5 class="card-title">Adresse</span></h5>
                                <p>Si la personne n'a pas d'adresse ayant le même format "1, Rue Victor Hugo - Paris" passez cette partie sans rien remplir".</p><br>
                                <input class="form-control" type="text" placeholder="Adresse" value="{{$synthstue->adresse}}" name="adresse"><br>
                                <h5 class="card-title">Telephone</span></h5>
                                <small>Exemple: 06 41 89 43 01</small><br>
                                <input class="form-control" type="tel" placeholder="Telephone" value="{{$synthstue->telephone}}" pattern="[0]{1}[0-9]{1} [0-9]{2} [0-9]{2} [0-9]{2} [0-9]{2}" name="telephone" title="Ecrivez le numéro de téléphone en respectant le format qui vous est indiqué"><br>

                                <h5 class="card-title">Email</span></h5>
                                <input class="form-control" type="email" placeholder="Email" value="{{$synthstue->email}}" name="email"><br>
                                <h5 class="card-title">Website</span></h5>
                                <small>Format:http(s)://..../</small><br>
                                <input class="form-control" type="text" placeholder="Website" value="{{$synthstue->website}}" pattern="https?://.+/" name="website" title="Ecrivez le site sous format http(s) avec un / à la fin comme indiqué si dessus"><br>
				<h5 class="card-title">instagram</span></h5>
                                <input class="form-control" type="text" placeholder="instagram" value="{{$synthstue->instagram}}" pattern="https?://.+/" name="instagram" title="Ecrivez le site sous format http(s) avec un / à la fin comme indiqué si dessus"><br>
                                <h5 class="card-title">twitter</span></h5>
                                <input class="form-control" type="text" placeholder="twitter" value="{{$synthstue->twitter}}" pattern="https?://.+/" name="twitter" title="Ecrivez le site sous format http(s) avec un / à la fin comme indiqué si dessus"><br>
                                <h5 class="card-title">facebook</span></h5>
                                <input class="form-control" type="text" placeholder="facebook" value="{{$synthstue->facebook}}" pattern="https?://.+/" name="facebook" title="Ecrivez le site sous format http(s) avec un / à la fin comme indiqué si dessus"><br>
                                <h5 class="card-title">Linkedin</span></h5>
                                <input class="form-control" type="text" placeholder="Linkedin" value="{{$synthstue->linkedin}}" pattern="https?://.+/" name="linkedin" title="Ecrivez le site sous format http(s) avec un / à la fin comme indiqué si dessus"><br>
                                <h5 class="card-title">Autre réseau social</span></h5>
                                <input class="form-control" type="text" placeholder="Autre réseau social" value="{{$synthstue->reseau_autre}}" pattern="https?://.+/" name="reseau_autre" title="Ecrivez le site sous format http(s) avec un / à la fin comme indiqué si dessus"><br>

                                <h5 class="card-title">Experiences  </span></h5>
                                @php
                                Carbon\Carbon::setLocale('fr');
                                    $experiences = $synthstue->experiences;
                                    $experiences = json_decode(($experiences),  true);
                                    $formations = $synthstue->formations;
                                    $formations = json_decode(($formations),  true);
                                @endphp
                                <table class="table responsive table-responsive">
                                  <thead>
                                    <tr>
                                      <th><small>Début</small> </th>
                                      <th>Fin</th>
                                      <th> Fonction occupée : </th>
                                      <th>Entreprises</th>
                                      <th> Mes missions </th>
                                    </tr>
                                  </thead>
                                  <tbody id="pExp">
                                    @if (isset($synthstue->experiences))
                                      @for ($i = 0; $i < count($experiences); $i++)
                                      <tr id="tr-exp{{$i}}">
                                        <td>{{ date('d F Y', strtotime($experiences[$i]["ANNEE DE DEBUT"])) }} </td>
                                        <td>{{ date('d F Y', strtotime($experiences[$i]["ANNEE DE FIN"]))}}</td>
                                        <td>{{ $experiences[$i]["Fonction Occupee"]}}</td>
                                        <td>{{ $experiences[$i]["Entreprises"]}}</td>
                                        <td>{{ $experiences[$i]["Missions - Tâches"]}}</td>
                                        <td> <a onclick="if(confirm('Vous allez supprimer toutes les expériences ?')) removeExp({{$i}});" class="btn btn-danger btn-lg btn-block"> <i class="bi bi-trash-fill"></i> </a></td>
                                      </tr>
                                      @endfor
                                    @endif
                                  </tbody>
                                </table>
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
                                                          <textarea class="form-control" hidden type="text" name="acquis" id="acquis" placeholder="Decrivez avec vos propres mots"></textarea>
                                                      </div>
                                                      <div class="form ">
                                                          <textarea class="form-control" hidden type="text" name="commentaire" id="commentaire" placeholder="Decrivez avec vos propres mots"></textarea>
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
                                <textarea hidden class="form-control" type="text" id="all_Exp" placeholder="Experiences" value="" name="experiences">{{$synthstue->experiences}}</textarea><br>

                                <h5 class="card-title">Formations</span></h5>
                                <table class="table responsive table-responsive">
                                  <thead>
                                    <tr>
                                      <th>Début</th>
                                      <th>Fin</th>
                                      <th> Organisme / Ecole / Université </th>
                                      <th>Diplôme</th>
                                      <th> Buts </th>
                                    </tr>
                                  </thead>
                                  <tbody id="pFor">
                                    @if (isset($synthstue->formations))
                                      @for ($i = 0; $i < count($formations); $i++)
                                      <tr id="tr-for{{$i}}">
                                        <td>{{ date('d F Y', strtotime($formations[$i]["ANNEE DE DEBUT"]))}}</td>
                                        <td>{{ date('d F Y', strtotime($formations[$i]["ANNEE DE FIN"]))}}</td>
                                        <td>{{ $formations[$i]["Organisme / Ecole"]}}</td>
                                        <td>{{ $formations[$i]["Diplome"]}}</td>
                                        <td>{{ $formations[$i]["Buts de la formation"]}}</td>
                                        <td> <a onclick="if(confirm('Vous allez supprimer toutes les formations ?')) removeFor({{$i}});" class="btn btn-danger btn-lg btn-block"> <i class="bi bi-trash-fill"></i> </a></td>
                                      </tr>
                                      @endfor
                                    @endif
                                  </tbody>
                                </table>
                                <textarea hidden class="form-control" type="text" id="all_For" placeholder="Formations" value="" name="formations">{{$synthstue->formations}}</textarea><br>

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
                                <h5 class="card-title">Departement</span></h5>
				<input class="form-control" type="text" hidden name="departement" id="changeDep" value="{{$synthstue->departement}}" >
                                <input class="form-control" type="text" disabled value="Departement actuel : {{$synthstue->departement}}"><br>
				<div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Ne cliquez pas sur le choix de département si vous ne voulez pas changer de département</h5>
                                        <small>Choississez Le Département</small><br>
                                        <select onclick="checkIfSelectClicked()" class="form-control" id="departement" value="{{$synthstue->departement}}" >
                                                @include('components.departementTUC')
                                        </select>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Synthèse</h5>
                                        <div class="quill-editor-full" id="init_synthese" data-placeholder="Ecrivez la synthèse ici" placeholder="Ecrivez la synthèse ici">
                                            <?PHP echo $synthstue->synthese; ?>
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


                                    <div class="d-grid gap-2 mt-3">
                                        <button class="btn btn-success" onclick='test()' type="submit">Update </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        </div>
                        <div class="col-md-4 ">
                          <div class="card">
                              <div class="card-body">
                                  <div class="title text color-red">
                                      <br>
                                      <h4 class="card-title">Modifications Démandées par le candidat</h4>
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
                            <div class="card">
                              <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                                @if ( $synthstue->photoProfil == "none")
                                <img src="http://trouver-un-expert.com/wp-content/uploads/2022/08/cropped-T1Exp-logo-removebg-preview.png" height="100" width="100" alt="Profile" class="rounded-circle">
                                @else
                                <img src="../TuE_profil_pictures/{{$synthstue->photoProfil}}" alt="Profile"  height="100" width="100" class="rounded-circle">
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
                                    Aucun CV n'a été trouvé.
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                  </div>
                                    @else

                                    <small >VISUAL DE CV</small><br>
                                    <embed src="../TuC_CV/{{ $synthstue->CV }}" width="300" height="375" type="application/pdf">
                                    @endif
                                </div>
                              </div>
                            </div>
                            <section class="profile">
                              <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                  <h5 class="card-title">About</h5>
                                  <p class="small fst-italic"><?php echo $synthstue->nom; ?></p>

                                  <h5 class="card-title">Profile Details</h5>

                                  <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">Nom & Prénom</div>
                                    <div class="col-lg-9 col-md-8">{{$synthstue->nom}} {{$synthstue->prenom}}</div>
                                  </div>

                                  <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Website</div>
                                    <div class="col-lg-9 col-md-8">{{$synthstue->website}}</div>
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

        </div>
</div>

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
  function removeExp(index){
    var all_Exp =  document.getElementById('all_Exp').innerHTML;
    all_Exp = JSON.parse(all_Exp);
    let newExpArr = [];
    for( var i = 0; i < all_Exp.length; i++){
        if ( i != index) {
          newExpArr.push(all_Exp[i]);
        }
    }
    console.log(newExpArr);
    document.getElementById('all_Exp').innerHTML = JSON.stringify(newExpArr);
    document.getElementById('tr-exp'+index).style.display = "none";
  }
  function removeFor(index){
    var all_For =  document.getElementById('all_For').innerHTML;
    all_For = JSON.parse(all_For);
    let newForArr = [];
    for( var i = 0; i < all_For.length; i++){
        if ( i != index) {
          newForArr.push(all_For[i]);
        }
    }
    console.log(newForArr);
    document.getElementById('all_For').innerHTML = JSON.stringify(newForArr);
    document.getElementById('tr-for'+index).style.display = "none";
  }
  function addExp(index){
    document.getElementById('tr-exp'+index).style.display = "none";
  }
</script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>

    function saveExp() {
    var Exp = [];
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
                  console.log(document.getElementById('all_Exp').innerHTML.length);
                document.getElementById('pExp').innerHTML += "<tr><td>" + document.getElementById('annee_debut').value + "</td><td>" + document.getElementById('annee_fin').value + "</td><td>" + document.getElementById('Entreprises').value + "</td><td>" + document.getElementById('Fonction').value + "</td><td>" + document.getElementById('acquis').value + "</td><td>" + document.getElementById('missions').value + "</td><td>" + document.getElementById('commentaire').value + "</td></tr>";
                if (document.getElementById('all_Exp').innerHTML.length > 10 ) {
                  var all_Exp =  document.getElementById('all_Exp').innerHTML;
                  all_Exp = JSON.parse(all_Exp);
                  Exp.push.apply(Exp, all_Exp)
                  console.log(Exp);
                  document.getElementById('all_Exp').innerHTML = JSON.stringify(Exp);
                }
                if (document.getElementById('all_Exp').innerHTML.length < 10) {
                  console.log(Exp);
                  document.getElementById('all_Exp').innerHTML = JSON.stringify(Exp);
                }
                resetExp();
            } else {
                swal("Error!", " Veuillez actualiser la page!", "error");
            }
        }
    }

    function saveFor() {
    var For = [];
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
                if (document.getElementById('all_For').innerHTML.length > 10) {
                  var all_For =  document.getElementById('all_For').innerHTML;
                  all_For = JSON.parse(all_For);
                  For.push.apply(For, all_For)
                  console.log(For);
                  document.getElementById('all_For').innerHTML = JSON.stringify(For);
                }
                if (document.getElementById('all_For').innerHTML.length < 10) {
                  console.log(For);
                  document.getElementById('all_For').innerHTML = JSON.stringify(For);
                }
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

</script>
@endsection
