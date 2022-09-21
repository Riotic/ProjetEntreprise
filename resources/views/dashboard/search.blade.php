@extends('dashboard.home')

@section('main')

<div class=main_div>
    <div class="square">
        <div class="row">
            @if (count($search) > 0)
            @foreach ($search as $item)
            <div class="col-xxl-4 col-md-6">
                <div class="card info-card sales-card">
                  <div class="card-body">
                    <h5 class="card-title">Synthèse
                        <span>|
                            @if ($item->type == 'tuc')
                                Trouver Un Candidat
                            @elseif ($item->type == 'tue')
                                Trouver Un Expert
                            @elseif ($item->type == 'tut')
                                Trouver un thérapeute
                            @endif

                        @if ($item->type == 'tuc')
                            <img src="https://bilan.trouver-un-candidat.com/wp-content/uploads/2022/04/cropped-icon-32x32.png" alt="" srcset="">
                        @elseif ($item->type == 'tue')
                            <img src="http://trouver-un-expert.com/wp-content/uploads/2022/08/cropped-T1Exp-logo-removebg-preview.png" width="32px" alt="" srcset="">
                        @elseif ($item->type == 'tut')
                            <img src="https://trouver-un-therapeute.fr/wp-content/uploads/2020/12/cropped-cropped-logo-therapeute1-1-192x192.png" style="width: 32px" alt="" srcset="">
                        @endif
                        </span></h5>
                    <div class="d-flex align-items-center">
                      <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        @if ($item->type == 'tuc')
                          @if ($item->type == 'none')
                            <img src="/TuC_profil_pictures/{{ $item->photoProfil }}" style="width: 80px" alt="Profile" class="rounded-circle">
                          @else
                            <img src="https://bilan.trouver-un-candidat.com/wp-content/uploads/2022/04/cropped-icon-32x32.png" alt="" srcset="">
                          @endif
                        @elseif ($item->type == 'tue')
                          @if ($item->type == 'none')
                            <img src="/TuE_profil_pictures/{{ $item->photoProfil }}" style="width: 80px" alt="Profile" class="rounded-circle">
                          @else
                            <img src="http://trouver-un-expert.com/wp-content/uploads/2022/08/cropped-T1Exp-logo-removebg-preview.png" width="32px" alt="" srcset="">
                          @endif
                        @elseif ($item->type == 'tut')
                          @if ($item->type == 'none')
                            <img src="../TuT_profil_pictures/{{ $item->photoProfil }}" style="width: 80px" alt="synthstut NOM picture" class="rounded-circle">
                          @else
                          <img src="https://trouver-un-therapeute.fr/wp-content/uploads/2021/08/cropped-Symbole-complet-couleur-bleu-uni-sansfond.png" style="width: 32px" alt="" srcset="">
                          @endif
                        @endif
                      </div>
                      <div class="ps-3">
                        <h6>{{ $item->prenom }}, {{ $item->nom }}</h6>
                        <span class="text-success small pt-1 fw-bold">Activité : </span> <span class="text-muted small pt-2 ps-2"> {{ $item->metier }}</span>
                      </div>
                    </div>
                    <ul class="d-flex justify-content-end">
                        <div class="d-grid gap-2 mt-3">

                             @if ($item->type == 'tuc')
                                <a href="{{ route('synthstucs.show', $item->id) }}" class="btn btn-success btn-lg ">Modifier <i class="bi bi-pencil-fill"></i></a>
                             @elseif ($item->type == 'tue')
                                <a href="{{ route('synthstues.show', $item->id) }}" class="btn btn-success btn-lg ">Modifier <i class="bi bi-pencil-fill"></i></a>
                             @elseif ($item->type == 'tut')
                                <a href="{{ route('synthstuts.show', $item->id) }}" class="btn btn-success btn-lg ">Modifier <i class="bi bi-pencil-fill"></i></a>
                             @endif
                        </div>
                    </ul>
                  </div>
                </div>
              </div>
            @endforeach
            @else
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-octagon me-1"></i>
                Aucune information n'a été trouvée.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            @endif

        </div>

    </div>
</div>

@endsection

