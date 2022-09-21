@extends('dashboard.home') @section('main')

<div class="main_div" class="section dashboard">
    @if ($message = Session::get("success"))
    <p style="float: left; position: absolute; top:70px; left:20px;">
        {{ $message }}
    </p>
    @endif
    @if (Auth::user()->role == 'admin' || Auth::user()->role == 'formatrice' )
    <div class="row">
        @foreach ($users as $user)
        <div class="col-md-3">
            <div class="card">
                @if($user->role == "admin")
                <img src="https://i.ibb.co/bPW4b2n/neutral-min.png" class="card-img-top" alt="...">
                @elseif ($user->role == "tut")
                <img src="https://i.ibb.co/h9YBMK1/logo.png" class="card-img-top" alt="...">
                @elseif ($user->role == "tuc")
                <img src="https://i.ibb.co/vX2q2qW/logo-candidat.png" class="card-img-top" alt="...">
                @elseif ($user->role == "formatrice")
                <img src="https://i.ibb.co/3h7n0yd/engineer-min.png" class="card-img-top" alt="...">
                @endif
                <div class="card-body">

                    Nom :
                    <span class="card-title">{{ $user->name }}<br></span> Prénom :
                    <span class="card-title"> {{ $user->surname }}<br></span>

                    <p class="card-text">

                        @if ($user->role == 'formatrice' || $user->role == 'informaticien' || $user->role == 'admin' )
                            <br>
                            <a  class="btn btn-primary" href="{{ route("users.indexTUC", $user->id ) }}">TUC</a>
                            <br>
                            <a class="btn btn-primary"  href="{{ route("users.indexTUT", $user->id ) }}">TUT</a>
                            <br>
                        @endif
                        @if ($user->role == 'tuc')
                            <br>
                            {{-- ?php echo $user->id_creator;? --}}
                            @if ($user->id_synthese != 'none')
                                <a class="btn btn-primary" href="{{ route('synthstucs.show', $user->id_synthese ) }}">Description Synthèse</a>
                            @else
                                <a class="btn btn-primary" href="{{ route('synthstucs_create', $user->id) }}">Synthèse non crée</a>
                            @endif
                            <br>
                            {{-- ?php echo $user->id_synthese;? --}}
                        @endif
                        @if ($user->role == 'tut')
                            <br>
                            {{-- ?php echo $user->id_creator;? --}}
                            @if ($user->id_synthese != 'none')
                                <a class="btn btn-primary" href="{{ route('synthstuts.show', $user->id_synthese ) }}">Description Synthèse</a>
                            @else
                                <a class="btn btn-primary" href="{{ route('synthstuts_create', $user->id) }}">Synthèse non crée</a>
                            @endif
                            {{-- ?php echo $user->id_synthese;? --}}
                            <br>
                        @endif
                        <a class="btn btn-secondary" href="{{ route('users.show', $user->id) }}">Voir profil</a>
                    </p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <h5>Pagination:</h5>
    {{ $users->links() }}
    @endif
</div>
@endsection
