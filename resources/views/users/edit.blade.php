@extends('dashboard.home') @section('main')

<?php ?>

<div>
    <div>
            <div class="formclass">
                 <h1 id="SignUpTitle" >Modifier compte pour la plateforme</h1>

        <form action="{{ route('users.update', $user->id) }}"  method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
                <!-- Name -->
                <p><input  type="text"  placeholder="{{$user->surname}}" name="surname" value="{{$user->surname}}" required autofocus /></p>
                <p><input  type="text"  placeholder="{{$user->name}}" name="name" value="{{$user->name}}" required autofocus /></p>

            @if (Auth::user()->role == 'admin')
            <select id="mySelect" onclick=refresh()>
                <option value="other">Choissisez le rôle de l'utilisateur</option>
                <option value="formatrice">Formatrice</option>
                <option value="informaticien">Informaticien</option>
            </select>
            <!--   role   -->
            <input type="text" placeholder="I change on select" name="role" value="{{$user->role}}" hidden required autofocus  id="change">
            <!-- Password -->
           <p><input id="password" type="password"  placeholder="Mot de passe" name="password" required autocomplete="new-password" /></p>
           <!-- Confirm Password -->
           <p><input id="password_confirmation" placeholder="Confirmation du mot de passe"  type="password" name="password_confirmation" required/></p>
           <!--   après   -->
            @endif
            {{-- <p>Mettez une photo si vous le désirez<input type="file" name="PDPuser"></p> --}}
            <x-button id="formSend">{{ __('Modifier compte') }}</x-button>

        </form>
    </div>
    <script>
        function refresh() {
            var x = document.getElementById("mySelect").value;
            document.getElementById("change").value = x;
            console.log(x); // en
        }
    </script>

    </div>
</div>
@endsection

