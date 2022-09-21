@extends('dashboard.home')

@section('main')

@php function shorten($string, $maxLength) { return substr($string, 0, $maxLength); } @endphp
<div class=main_div>
    <div class="square">

    @can('update', $synthstuc)
    <a href="{{ route('synthstucs.edit', $synthstuc->id) }}">
        <button class="btn btn" >Editer</button>
    </a>
    @endcan

    @can('delete', $synthstuc)
    <form action="{{ route('synthstucs.destroy', $synthstuc->id) }}" method="post">
        @csrf
        @method('DELETE')
        <button class="btn btn" type="submit">Supprimer</button>
    </form>
    @endcan

    <div class="card">
        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
          @if ( $synthstuc->photoProfil == "none")
          <img src="https://trouver-un-candidat.com/wp-content/themes/superio/images/placeholder.png" height="100" width="100" alt="Profile" class="rounded-circle">
          @else
          <img src="/syn/public/TuC_profil_pictures/{{$synthstuc->photoProfil}}" alt="Profile"  height="100" width="100" class="rounded-circle">
          @endif
          <h2>{{$synthstuc->nom}}</h2>
          <div class="social-links mt-2">
            <a href="{{$synthstuc->website}}" target="_blank" class="twitter"><i class="bi bi-twitter"></i></a>
            <a href="{{$synthstuc->reseau_autre}}" target="_blank" class="facebook"><i class="bi bi-facebook"></i></a>
            <a href="{{$synthstuc->reseau_autre}}" target="_blank" class="instagram"><i class="bi bi-instagram"></i></a>
            <a href="{{$synthstuc->linkedin}}" target="_blank" class="linkedin"><i class="bi bi-linkedin"></i></a>
          </div>
          <div class="col-md-10 body">
            @if ( $synthstuc->CV == "none")

            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <i class="bi bi-exclamation-octagon me-1"></i>
              Aucun CV n'a été trouvé.
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
              @else

              <small >VISUAL DE CV</small><br>
              <embed src="/syn/public/TuC_CV/{{$synthstuc->CV}}" width="300" height="375" type="application/pdf">
              @endif
          </div>
        </div>
      </div>
      <section class="profile">
      <div class="tab-pane fade show active profile-overview" id="profile-overview">

          <h5 class="card-title">Profile Details</h5>

          <div class="row">
            <div class="col-lg-3 col-md-4 label ">Nom & Prénom</div>
            <div class="col-lg-9 col-md-8">{{$synthstuc->nom}} {{$synthstuc->prenom}}</div>
          </div>

          <div class="row">
            <div class="col-lg-3 col-md-4 label">Website</div>
            <div class="col-lg-9 col-md-8">{{$synthstuc->website}}</div>
          </div>

          <div class="row">
            <div class="col-lg-3 col-md-4 label">Linkedin</div>
            <div class="col-lg-9 col-md-8">{{$synthstuc->linkedin}}</div>
          </div>

          <div class="row">
              <div class="col-lg-3 col-md-4 label">Metier</div>
              <div class="col-lg-9 col-md-8">{{$synthstuc->metier}}</div>
            </div>


          <div class="row">
            <div class="col-lg-3 col-md-4 label">Address</div>
            <div class="col-lg-9 col-md-8">{{$synthstuc->adresse}}</div>
          </div>

          <div class="row">
              <div class="col-lg-3 col-md-4 label">departement</div>
              <div class="col-lg-9 col-md-8">{{$synthstuc->departement}}</div>
            </div>

          <div class="row">
            <div class="col-lg-3 col-md-4 label">Phone</div>
            <div class="col-lg-9 col-md-8">{{$synthstuc->telephone}}</div>
          </div>

          <div class="row">
            <div class="col-lg-3 col-md-4 label">Email</div>
            <div class="col-lg-9 col-md-8">{{$synthstuc->email}}</div>
          </div>

        </div>
      </section>

    </div>
</div>

@endsection
