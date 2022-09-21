@extends('dashboard.home')

@section('main')

@php
function shorten($string, $maxLength) {
    return substr($string, 0, $maxLength);
}
@endphp
<div class="main_div row">
    @if ($message = Session::get("success"))
        <p style="float: left; position: absolute; top:70px; left:20px;">
            {{ $message }}
        </p>
    @endif
    <div class="row">
    @foreach ($synthstucs as $synthstuc)
        <div class="col-md-3" style="text-align:center">

            <div class="card">
              <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                @if ($synthstuc->status == "3")
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle me-1"></i>
                    Synthèse Validée par le stagiaire
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                @endif
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
                <div class="" >
                  @if ( $synthstuc->CV == "none")

                  <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-octagon me-1"></i>
                    Aucun CV n'a été trouvé.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                    @else

                    <small >VISUAL DE CV</small><br>
                    <embed src="/syn/public/TuC_CV/{{ $synthstuc->CV }}" width="200" height="275" type="application/pdf">
                    @endif

                </div>
                <a class="btn btn-primary" href="{{ route('synthstucs.show', $synthstuc->id) }}">Description Synthèse</a>
              </div>
            </div>

      </div>
@endforeach
<h5>Pagination:</h5>
    {{ $synthstucs->links() }}
</div>
</div>
@endsection
