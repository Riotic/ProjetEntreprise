@extends('layouts.default')
@section('main')
{{-- @php
	abort(404);
@endphp --}}
<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

            <div class="formclass">
                 <h1 id="SignUpTitle" >Créer un compte pour la plateforme</h1>
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <p><input  type="text" placeholder="Prénom" name="surname" :value="old('surname')" required autofocus /></p>
                <p><input  type="text" placeholder="Nom" name="name" :value="old('name')" required autofocus /></p>
            <!-- Role -->
            <input type="text" hidden value="" placeholder="I change on select" name="role" :value="old('role')" required autofocus  id="change">

            {{-- <select id="mySelect" onclick=refresh()>
                <option value="other">Choissisez le rôle de l'utilisateur</option>
                <option value="formatrice">Formatrice</option>
                <option value="informaticien">Informaticien</option>
            </select> --}}

            <div class="row-direction">
            <input id="mdpAdmin" type="password" value="" placeholder="Si votre rôle est admin tapez le mot de passe ici" >
            <div class="btn" onclick=admin()>Cliquez ici pour validez admin</div>
            </div>

            {{-- <p>Mettez une photo si vous le désirez<input type="file" name="PDPuser"></p> --}}

                <p><input  id="email" type="email" placeholder="E-mail" name="email" :value="old('email')" required/></p>
            <!-- Password -->
                <p><input id="password" type="password"  placeholder="Mot de passe" name="password" required autocomplete="new-password" /></p>
            <!-- Confirm Password -->
            <p><input id="password_confirmation" placeholder="Confirmation du mot de passe"  type="password" name="password_confirmation" required/></p>
            <!--   après   -->
                <p><a class="RoadToLogIn" href="{{ route('login') }}">
                    {{ __('Retour à la page login') }}
                    <br/>
                </a></p>
                <x-button id="formSend">{{ __('Créer compte') }}</x-button>

        </form>
    </div>
    <script>
        // function refresh() {
        //     var x = document.getElementById("mySelect").value;
        //     document.getElementById("change").value = x;
        //     console.log(x); // en
        // }
        function admin() {
            var mdp = document.getElementById("mdpAdmin").value;
            var y = 'admin';
            if(mdp == 'admin6288'){
                document.getElementById("change").value = y;
            };
            console.log(y);
        }

    </script>

    </x-auth-card>
</x-guest-layout>
@endsection
