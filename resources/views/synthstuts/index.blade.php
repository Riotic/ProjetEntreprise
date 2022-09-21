@extends('dashboard.home') @section('main')

@php function shorten($string, $maxLength) { return substr($string, 0, $maxLength); } @endphp
<style>
    .col-lg-3{
        width: 100% !important;
    }
</style>
<div class=main_div>
    @if ($message = Session::get("success"))
    <p style="float: left; position: absolute; top:70px; left:20px;">
        {{ $message }}
    </p>
    @endif
    <div class="row">
    @foreach ($synthstuts as $synthstut)
    <div class="col-md-3">

        <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                @if ($synthstut->status == "3")
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle me-1"></i>
                    Synthèse Validée par le stagiaire
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                @endif

                <img src="/syn/public/TuT_profil_pictures/{{$synthstut->photoProfil}}" style="width: 120px" alt="synthstut {{$synthstut->nom}} picture" class="rounded-circle">
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
                            <img src="/syn/public/TuT_wallpaper/{{$synthstut->photoCouverture}}" alt=" "><br>
                        </div>
                        <div class="child col-md-3">
                            <p>Photo Carrousel1</p>
                            <img src="/syn/public/TuT_carrousel/{{$synthstut->photoCarrousel1}}" alt=" "><br>
                        </div>
                        <div class="child col-md-3">
                            <p>Photo Carrousel2</p>
                            <img src="/syn/public/TuT_carrousel/{{$synthstut->photoCarrousel2}}" alt=" "><br>
                        </div>
                        <div class="child col-md-3">
                            <p>Photo Carrousel3</p>
                            <img src="/syn/public/TuT_carrousel/{{$synthstut->photoCarrousel3}}" alt=" "><br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <section class="profile">
            <div class="tab-pane fade show active profile-overview" id="profile-overview">

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
                    <div class="col-lg-3 col-md-4 label">Horaire</div>
                    <div class="col-lg-9 col-md-8" style="overflow: hidden;">{{$synthstut->horaire}}</div>
                </div>

                <div class="row">
                    <div class="col-lg-3 col-md-4 label">Addresse</div>
                    <div class="col-lg-9 col-md-8">{{$synthstut->adresse}}</div>
                </div>

                <div class="row">
                    <div class="col-lg-3 col-md-4 label">Département</div>
                    <div class="col-lg-9 col-md-8">{{$synthstut->departement}}</div>
                </div>

                <div class="row">
                    <div class="col-lg-3 col-md-4 label">Phone</div>
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
            <a class="btn btn-primary" href="{{ route('synthstuts.show', $synthstut->id) }}">Description Synthèse</a>

        </section>
    </div>
    @endforeach
<h5>Pagination:</h5>
    {{ $synthstuts->links() }}
</div>
</div>
@endsection
