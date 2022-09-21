@extends('dashboard.home')

@section('main')
<div class=main_div>
        <div class="square">
          @if (session('synthese'))
            <script>
              window.document.onload = function(e){

                swal({
                icon: "success",
              });
              }
            </script>
            <div class="col-md-12">
              <div class="card full-height shadow">
                <div class="card-body">
                  <br>
                  <div class="alert alert-success" role="alert">
                      {{ session('success') }}
                      <b>Votre Synthèse est bien validé</b>
                  </div>
                </div>
              </div>
            </div>
          @endif
          @auth
            @php
                $id = Auth::user()->id;
                $id_formatrice = DB::select('select id_creator from users where id='.$id.' ;');
                foreach ($id_formatrice as $key ) {
                  $id_synthese = DB::select('select * from synthstuts where user_id='.$key->id_creator.' and  client_id='.Auth::user()->id.';');
                  //$id_synthese = DB::select('select * from synthstuts where user_id='.$key->id_creator.' and email="'.Auth::user()->email.'";');
                }
            @endphp
            @foreach ($id_synthese as $synthstut)
              <div class="row">
                  <div class="col-md-9">
                      <form action="#" method="POST" enctype="multipart/form-data">
                          @csrf
                          @method('PUT')
                          <div class="card">
                              <div class="card-body">
                                  <h5 class="card-title">Photo de profil JPG/PNG</h5>
                                  <img src="/syn/public/TuT_profil_pictures/{{$synthstut->photoProfil}}" style="height: 300px;"/>
                              </div>
                          </div>
                          <div class="card">
                              <div class="card-body">
                                  <h5 class="card-title">Photo Couverture</h5>
                                  <div class="child">
                                      <img src="/syn/public/TuT_wallpaper/{{$synthstut->photoCouverture}}" style="height: 300px;" alt="product {{$synthstut->photoCouverture}} picture"><br>
                                  </div>
                              </div>
                          </div>
                          <p></p>
                          <div class="card">
                              <div class="card-body">
                                  <h5 class="card-title">Photo de carrousel 1</h5>
                                  <div class="child">
                                      <img src="/syn/public/TuT_carrousel/{{$synthstut->photoCarrousel1}}" style="height: 300px;" alt="product {{$synthstut->photoCarrousel1}} picture"><br>
                                  </div>
                              </div>
                          </div>
                          <div class="card">
                              <div class="card-body">
                                  <h5 class="card-title">Photo de carrousel 2</h5>
                                  <div class="child">
                                      <img src="/syn/public/TuT_carrousel/{{$synthstut->photoCarrousel2}}" style="height: 300px;" alt="product {{$synthstut->photoCarrousel2}} picture"><br>
                                  </div>
                              </div>
                          </div>
                          <div class="card">
                              <div class="card-body">
                                  <h5 class="card-title">Photo de carrousel 3</h5>
                                  <div class="child">
                                      <img src="/syn/public/TuT_carrousel/{{$synthstut->photoCarrousel3}}" style="height: 300px;" alt="product {{$synthstut->photoCarrousel3}} picture"><br>
                                  </div>
                              </div>
                          </div>
                          <div class="card">
                              <div class="card-body">
                                  <h5 class="card-title">Metier</h5>
                                  <input class="form-control" type="text" placeholder="Metier" disabled value='{{$synthstut->metier}}' name="metier"><br>
                              </div>
                          </div>
                          <div class="card">
                              <div class="card-body">
                                  <h5 class="card-title">Adresse</h5>
                                  <input class="form-control" class="form-control" type="text" disabled placeholder="Adresse" value='{{$synthstut->adresse}}' id='adress' name="adresse" >
                              </div>
                          </div>
                          <div class="card">
                              <div class="card-body">
                                  <h5 class="card-title">Telephone</h5>
                                  <small>Format:06 41 89 43 01</small><br>
                                  <input class="form-control" type="tel" placeholder="Telephone" disabled value='{{$synthstut->telephone}}' pattern="[0-9]{2} [0-9]{2} [0-9]{2} [0-9]{2} [0-9]{2}" name="telephone" title="Ecrivez le numéro de téléphone en respectant le format qui vous est indiqué"><br>

                              </div>
                          </div>
                          <div class="card">
                              <div class="card-body">
                                  <h5 class="card-title">Email</h5>
                                  <input class="form-control" type="email" placeholder="Email" disabled value='{{$synthstut->email}}' name="email"><br>
                              </div>
                          </div>
                          <div class="card">
                              <div class="card-body">
                                  <h5 class="card-title">Website</h5>
                                  <input class="form-control" type="text" placeholder="Website" disabled value='{{$synthstut->website}}' name="website"><br>
                              </div>
                          </div>
			<div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Instagram</h5>
                                <input class="form-control" type="text" placeholder="instagram" disabled value='{{$synthstut->instagram}}' name="instagram"><br>
                            </div>
                          </div>
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Twitter</h5>
                                <input class="form-control" type="text" placeholder="twitter" disabled value='{{$synthstut->twitter}}' name="twitter"><br>
                            </div>
                        </div>
                          <div class="card">
                              <div class="card-body">
                                  <h5 class="card-title">Linkedin</h5>
                                  <input class="form-control" type="text" placeholder="Linkedin" disabled value='{{$synthstut->linkedin}}' name="linkedin"><br>
                              </div>
                          </div>
                          <div class="card">
                              <div class="card-body">
                                  <h5 class="card-title">Facebook</h5>
                                  <input class="form-control" type="text" placeholder="Facebook" disabled value='{{$synthstut->facebook}}' name="facebook"><br>
                              </div>
                          </div>
                          <div class="card">
                              <div class="card-body">
                                  <h5 class="card-title">Youtube</h5>
                                  <input class="form-control" type="text" placeholder="Youtube" disabled value='{{$synthstut->youtube}}' name="youtube"><br>
                              </div>
                          </div>
                          <div class="card">
                              <div class="card-body">
                                  <h5 class="card-title">Horaires</h5>
                                  <input class="form-control" type="text" placeholder="Horaires" disabled value='{{$synthstut->horaire}}' name="horaire"><br>
                              </div>
                          </div>
                          <div class="card">
                              <div class="card-body">
                                  <h5 class="card-title">Mots-Clés</h5>
                                  <input class="form-control" type="text" placeholder="Mots-Clés" disabled value='{{$synthstut->motsClefs}}' name="motsClefs"><br>
                              </div>
                          </div>
                          <div class="card">
                              <div class="card-body">
                                  <h5 class="card-title">Departement</h5>
                                  <input class="form-control" type="text" placeholder="Departement" disabled value='{{$synthstut->departement}}' name="departement"><br>
                              </div>
                          </div>
                          <div class="card">
                              <div class="card-body">
                                  <h5 class="card-title">Citation</h5>
                                  <input class="form-control" type="text" placeholder="Citation" disabled value='{{$synthstut->citation}}' name="citation"><br>
                              </div>
                          </div>
                          <div class="card">
                              <div class="card-body">
                                  <h5 class="card-title">Aperçu Synthèse</h5>
                                  <p id="result" class="ql-editor">  </p>
                                  <?PHP echo $synthstut->synthese; ?>
                                  <textarea style="display: none;" id="synthese" name="synthese" value='test' placeholder="Synthèse" id="" cols="30" rows="10"></textarea><br>
                              </div>
                          </div>
                          @if (Auth::user()->role == 'admin' || Auth::user()->role == 'formatrice')
                            <button class="btn btn-success" onclick="test()" type="submit">Modifier</button>
                          @endif
                      </form>
                  </div>
                  <div class="col-md-3">
                      <div class="card">
                          <div class="card-body">
                              <div class="title text color-red">
                                  <br>
                                  <h4 class="card-title">Demander des modifications</h4>
                              </div>
                              <div class="body">
                                  <div class="accordion accordion-flush" id="accordionFlushExample">
                                      <div class="accordion-item">

                                        @each('messenger.partials.messages', $thread->messages, 'message')

                                        @php
                                            $thread_id = DB::SELECT("SELECT id FROM `synthstuts` where status='3' and email='".Auth::user()->email."'");
                                        @endphp
                                        @if (count($thread_id) < 1)
                                        @include('messenger.partials.form-message')
                                        @endif
                                      </div>
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

<style>
    .ql-image {
        display: none !important;
    }
</style>
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
