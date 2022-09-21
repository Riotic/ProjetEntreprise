@extends('dashboard.home') @section('main')
<div class="main_div contact">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    @php
    $synthstuts = DB::SELECT("SELECT * FROM `synthstuts` where client_id='".Auth::user()->id."'");
    //$synthstuts = DB::SELECT("SELECT * FROM `synthstuts` where email='".Auth::user()->email."'");
    $msg_count = DB::SELECT("SELECT id FROM `messenger_messages` where user_id='".Auth::user()->id."'");

    $thread_id = DB::SELECT("SELECT thread_id FROM `messenger_participants` where user_id='".Auth::user()->id."'");
    foreach ($thread_id as $key) {
        $sms_count = DB::SELECT("SELECT id FROM `messenger_messages` where user_id='".Auth::user()->id_creator."' and thread_id='".$key->thread_id."'");
    }
    @endphp
    @foreach ($synthstuts as $synthstut)
    <div class="row">
        <section class="section profile">
            <div class="row">
                <div class="col-xxl-3 col-md-3">
                    <div class="card info-card valid-card">

                        <div class="card-body">
                            <h5 class="card-title">Validez <span>| Votre Synthèse</span></h5>

                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-patch-check-fill"></i>
                                </div>
                                <div class="ps-3 d-grid gap-2 mt-3">
                                    <button type="button" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#largeModal">Valider Ici</button>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="card info-card revenue-card">

                        <div class="filter">
                            <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-patch-question-fill"></i></a>
                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                <li class="dropdown-header text-start">
                                    <h6>A quoi sert le SEO</h6>
                                </li>

                                <li><a class="dropdown-item" href="#">Audit de visibilité de votre site</a></li>
                                <li><a class="dropdown-item" href="#">Arriver dans les premiers résultats de Google</a></li>
                                <li><a class="dropdown-item" href="#">Accroître votre chiffre d’affaire</a></li>
                            </ul>
                        </div>

                        <div class="card-body">
                            <h5 class="card-title">Score SEO <span>| Estimée</span></h5>

                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-lightning-charge"></i>
                                </div>
                                <div class="ps-3">
                                    <h6 id="seo"></h6>
                                    <span class="text-success small pt-1 fw-bold">{{$random = str_pad(rand(90,96), 2, "0", STR_PAD_LEFT); }}%</span> <span class="text-muted small pt-2 ps-1">De chance sur votre mot clé</span>

                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card info-card customers-card">

                        <div class="card-body">
                            <h5 class="card-title">Messages <span>| Envoyés</span></h5>

                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-envelope-fill"></i>
                                </div>
                                <div class="ps-3">
                                    <h6>{{count($msg_count)}} </h6>
                                    <a href="/messages"><span class="text-danger small pt-1 fw-bold">Écrivez </span></a><span class="text-muted small pt-2 ps-1">à votre Formatrice</span>

                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="card info-card sales-card">

                        <div class="card-body">
                            <h5 class="card-title">Messages <span>| Reçus</span></h5>

                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-box"></i>
                                </div>
                                <div class="ps-3">
                                  <h6>{{ count($sms_count) }}</h6>
                                  <span class="text-success small pt-1 fw-bold">Envoyés</span> <span class="text-muted small pt-2 ps-1">par votre formatrice</span>

                                </div>
                              </div>

                        </div>
                    </div>
                </div>
                <div class="col-xl-6">

                    <div class="card">
                        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                            @if ( $synthstut->photoProfil == "none")
                            <img src="https://trouver-un-therapeute.fr/wp-content/uploads/2019/06/PHOTO-2018-retouche%CC%81e.jpg" height="100" width="100" alt="Profile" class="rounded-circle">
                            @else
                            <img src="../syn/public/TuT_profil_pictures/{{$synthstut->photoProfil}}" alt="Profil e" class="rounded-circle">
                            @endif

                            <h2>{{$synthstut->nom}} {{$synthstut->prenom}}</h2>
                            <h3>{{$synthstut->metier}} </h3>
                            <div class="social-links mt-2">
                                <a href="{{$synthstut->website}}" class="globe"><i class="bi bi-globe"></i></a>
                                <a href="{{$synthstut->facebook}}" class="facebook"><i class="bi bi-facebook"></i></a>
                                <a href="{{$synthstut->youtube}}" class="youtube"><i class="bi bi-youtube"></i></a>
                                <a href="{{$synthstut->linkedin}}" class="linkedin"><i class="bi bi-linkedin"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div id="description" class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                            <p>
                                <?php echo $synthstut->synthese; ?>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3">

                    <div class="card">
                        <div class="card-body pt-3">
                            <div class=" pt-2">

                                <div class="tab-pane profile-overview" id="profile-overview">

                                    <h5 class="card-title">Profile Details</h5>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label ">Nom & Prénom</div>
                                        <div class="col-lg-9 col-md-8">{{$synthstut->nom}} {{$synthstut->prenom}}</div>
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
                                        <div class="col-lg-3 col-md-4 label">Address</div>
                                        <div class="col-lg-9 col-md-8">{{$synthstut->adresse}}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">departement</div>
                                        <div class="col-lg-9 col-md-8">{{$synthstut->departement}}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Phone</div>
                                        <div class="col-lg-9 col-md-8">{{$synthstut->telephone}}</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Les mots Clefs</div>
                                        <div class="col-lg-9 col-md-8">
                                            @php
                                                echo  str_replace(';', ', ', $synthstut->motsClefs);
                                            @endphp
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Email</div>
                                        <div class="col-lg-9 col-md-8">{{$synthstut->email}}</div>
                                    </div>

                                </div>

                            </div>
                            <!-- End Bordered Tabs -->

                        </div>
                    </div>

                </div>
            </div>
        </section>
    </div>

<div class="modal fade" id="largeModal" tabindex="-1" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <img src="https://i.ibb.co/VHcsf0z/sreeer-min.png" alt="egbw" border="0" width="70px">
                <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    <form action="/valid" method="POST" enctype="multipart/form-data">
                        @csrf
                        {{-- <input type="text" name="browser" hidden id="browser" value="{{  json_encode(get_browser(null, true)) }}"> --}}
                        <input type="hidden" name="id_synthstuts" value="{{$synthstut->id}}">
                        <div class="card">
                            <div class="card-body">
                                <p class="text-center">
                                    <img src="https://i.ibb.co/56gbSsM/ends-removebg-preview-min.png" height="250" alt="sreeer-min" border="0">
                                    <h5 class="card-title text-center">Je valide la synthèse corédigé avec ma consultante en bilan de compétences et je donne mon accord pour diffusion sur Internet.</h5>
                                </p>
                            </div>
                        </div>
                        <div class="card">
                            <button id="link_mail" type="submit" onclick="" class="btn btn-block btn-success">CONFIRMER</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default _closeModal_" data-bs-dismiss="modal" id="closeModal">Fermer</button>
                <a href="/messages" target="_blank" class="btn btn-danger " >DEMANDER DES MODIFICATIONS</a>
            </div>
        </div>

    </div>
</div>
    @endforeach
</div>
<script>
    setTimeout(function(){

        const res = document.getElementById('description').textContent;
        console.log(res.split(' ').length);
        var seo = res.split(' ').length;
        if (seo > 500 && seo < 1200) {
            function randomIntFromInterval(min, max) {
            return Math.floor(Math.random() * (max - min + 1) + min);
            }

            const rndInt = randomIntFromInterval(91, 96);
            document.getElementById('seo').innerText = rndInt;
        } else {
            function randomIntFromInterval(min, max) {
            return Math.floor(Math.random() * (max - min + 1) + min);
            }

            const rndInt = randomIntFromInterval(84, 86);
            document.getElementById('seo').innerText = rndInt;
        }
        //console.log(seo);
    }, 2000);
</script>
@endsection
