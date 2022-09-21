@extends('dashboard.home') @section('main')

<div class="main_div" class="section dashboard">
    <section class="profile">
        <div class="tab-pane fade show active profile-overview" id="profile-overview">

            <h5 class="card-title">Profile</h5>

            <div class="row">
                <div class="col-lg-3 col-md-4 label ">Nom</div>
                <div class="col-lg-9 col-md-8">{{$user->name}}</div>
            </div>

            <div class="row">
                <div class="col-lg-3 col-md-4 label">Prénom</div>
                <div class="col-lg-9 col-md-8">{{$user->surname}}</div>
            </div>

            <div class="row">
                <div class="col-lg-3 col-md-4 label">Role</div>
                <div class="col-lg-9 col-md-8">{{$user->role}}</div>
            </div>


            <div class="row">
                <div class="col-lg-3 col-md-4 label">Email</div>
                <div class="col-lg-9 col-md-8">{{$user->email}}</div>
            </div>

            @can('update', $user)
                <a href="{{ route('users.edit', $user->id) }}">
                    <button>Editer</button>
                </a>
            @endcan

            @can('delete', $user)
                <form action="{{ route('users.destroy', $user->id) }}" method="post">
                    @csrf
                    @method('DELETE')
		    <button onclick="return confirm('Confirmer la suppression ?')" type="submit">Supprimer</button>
                </form>
            @endcan


        </div>

    </section>
</div>
@endsection
