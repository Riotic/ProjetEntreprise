@extends('dashboard.home')

@section('main')

<div class=main_div>
    <div class="square">
        <div class="row sdfs">
          @auth
            @php
                $id = Auth::user()->id;
                $id_formatrice = DB::select('select id_creator from users where id='.$id.' ;');
                foreach ($id_formatrice as $key ) {
                  $id_synthese = DB::select('select * from synthstucs where user_id='.$key->id_creator.' and client_id="'.Auth::user()->id.'";');
                  //$id_synthese = DB::select('select * from synthstucs where user_id='.$key->id_creator.' and email="'.Auth::user()->email.'";');
                }
            @endphp
            @foreach ($id_synthese as $synthstuc)
            <div class="col-md-9">
                <div class="card">
                    <div class="card-body">
                      <h5 class="card-title">Ma Synthèse <span>| {{$synthstuc->nom}} , {{$synthstuc->telephone}} , {{$synthstuc->email}}</span></h5>

                      <h5>Photo de profil JPG/PNG</h5>
                      <div class="child">
                        @if ( $synthstuc->photoProfil == "none")
                        <img src="https://trouver-un-candidat.com/wp-content/themes/superio/images/placeholder.png" height="100" width="100" alt="Profile" class="rounded-circle">
                        @else
                        <img src="{{ asset("../syn/public/TuC_profil_pictures/".$synthstuc->photoProfil."") }}" alt="Profile ddd"  height="100" width="100" class="rounded-circle">
                        @endif
                      </div>
                        @if ($synthstuc->CV != 'none')
                            <small >VISUAL DE CV</small><br>
                            <embed src="../syn/public/TuC_CV/{{ $synthstuc->CV }}" width="300" height="375" type="application/pdf">
                        @else
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="bi bi-exclamation-octagon me-1"></i>
                            Aucun CV n'a été trouvé.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif

                      <h5 class="card-title">Metier</span></h5>
                      <input class="form-control" type="text" placeholder="Metier" disabled value="{{$synthstuc->metier}}" name="metier"><br>
                      <h5 class="card-title">Adresse</span></h5>
                      <input class="form-control" type="text" placeholder="Adresse" disabled value="{{$synthstuc->adresse}}" name="adresse"><br>

		      <h5 class="card-title">Instagram</span></h5>
                      <input class="form-control" type="text" placeholder="instagram" disabled value="{{$synthstuc->instagram}}" pattern="https?://.+/" name="instagram" title="Ecrivez les sites en respectant le format qui vous est indiqué"><br>
                      <h5 class="card-title">Twitter</span></h5>
                      <input class="form-control" type="text" placeholder="twitter" disabled value="{{$synthstuc->twitter}}" pattern="https?://.+/" name="twitter" title="Ecrivez les sites en respectant le format qui vous est indiqué"><br>
                      <h5 class="card-title">Facebook</span></h5>
                      <input class="form-control" type="text" placeholder="facebook" disabled value="{{$synthstuc->facebook}}" pattern="https?://.+/" name="facebook" title="Ecrivez les sites en respectant le format qui vous est indiqué"><br>
		      <h5 class="card-title">Website</span></h5>
                      <input class="form-control" type="text" placeholder="Website" disabled value="{{$synthstuc->website}}" pattern="https?://.+/" name="website" title="Ecrivez les sites en respectant le format qui vous est indiqué"><br>
                      <h5 class="card-title">Linkedin</span></h5>
                      <input class="form-control" type="text" placeholder="Linkedin" disabled value="{{$synthstuc->linkedin}}" pattern="https?://.+/" name="linkedin" title="Ecrivez les sites en respectant le format qui vous est indiqué"><br>
                      <h5 class="card-title">Autre réseau social</span></h5>
                      <input class="form-control" type="text" placeholder="Autre réseau social" disabled value="{{$synthstuc->reseau_autre}}" pattern="https?://.+/" name="reseau_autre" title="Ecrivez les sites en respectant le format qui vous est indiqué"><br>
                      <h5 class="card-title">Experiences </span></h5>
                                @php
                                Carbon\Carbon::setLocale('fr');
                                    $experiences = $synthstuc->experiences;
                                    $experiences = json_decode(($experiences),  true);
                                    $formations = $synthstuc->formations;
                                    $formations = json_decode(($formations),  true);
                                @endphp
                                <table class="table responsive table-responsive">
                                  <thead>
                                    <tr>
                                      <th><small>Début</small> </th>
                                      <th>Fin</th>
                                      <th> Fonction occupée : </th>
                                      <th>Entreprises</th>
                                      <th> Mes missions / tâches </th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    @if (isset($synthstuc->experiences))
                                      @for ($i = 0; $i < count($experiences); $i++)
                                      <tr>
                                        <td>{{ date('d F Y', strtotime($experiences[$i]["ANNEE DE DEBUT"])) }} </td>
                                        <td>{{ date('d F Y', strtotime($experiences[$i]["ANNEE DE FIN"]))}}</td>
                                        <td>{{ $experiences[$i]["Fonction Occupee"]}}</td>
                                        <td>{{ $experiences[$i]["Entreprises"]}}</td>
                                        <td>{{ $experiences[$i]["Missions - Tâches"]}}</td>
                                      </tr>
                                      @endfor
                                    @endif
                                  </tbody>
                                </table>
                                <textarea hidden class="form-control" type="text" placeholder="Experiences" value="" name="experiences">{{$synthstuc->experiences}}</textarea><br>
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
                                  <tbody>
                                    @if (isset($synthstuc->formations))
                                      @for ($i = 0; $i < count($formations); $i++)
                                      <tr>
                                        <td>{{ date('d F Y', strtotime($formations[$i]["ANNEE DE DEBUT"]))}}</td>
                                        <td>{{ date('d F Y', strtotime($formations[$i]["ANNEE DE FIN"]))}}</td>
                                        <td>{{ $formations[$i]["Organisme / Ecole"]}}</td>
                                        <td>{{ $formations[$i]["Diplome"]}}</td>
                                        <td>{{ $formations[$i]["Buts de la formation"]}}</td>
                                      </tr>
                                      @endfor
                                    @endif
                                  </tbody>
                                </table>
                                <textarea hidden class="form-control" type="text" placeholder="Formations" value="" name="formations">{{$synthstuc->formations}}</textarea><br>
                                <h5 class="card-title">Departement</span></h5>
                      <input class="form-control" type="text" placeholder="Departement" value="{{$synthstuc->departement}}" disabled name="departement"><br>


                      <div class="card">
                          <div class="card-body">
                              <h5 class="card-title">Aperçu Synthèse</h5>
                              <p id="result" class="ql-editor"><?PHP echo $synthstuc->synthese; ?> </p>
                              <textarea style="display: none;" id="synthese" name="synthese" value='test' placeholder="Synthèse" id="" cols="30" rows="10"></textarea><br>
                          </div>
                      </div>
                      </div>
                  </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <br>
                        <h4>Demander des modifications</h4>
                        <div class="body">
                            <div class="accordion accordion-flush" id="accordionFlushExample">
                                <div class="accordion-item">

                                  @each('messenger.partials.messages', $thread->messages, 'message')

                                  @php
                                    $synthstucs = DB::SELECT("SELECT id FROM `synthstucs` where status='3' and email='".Auth::user()->email."'");
                                @endphp
                                @if (count($synthstucs) < 1)
                                @include('messenger.partials.form-message')
                                @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
          @endauth

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
@endsection

