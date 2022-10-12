@extends('dashboard.home') @section('main')
<div>
    <div>
            <div class="formclass">
                 <h1 id="SignUpTitle" >Créer un compte pour la plateforme</h1>

        <form method="POST" action="{{ route('users.store') }}"  method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Name -->
            <p><input  type="text" placeholder="Prénom" name="surname" :value="old('surname')" required autofocus /></p>
                <p><input  type="text" placeholder="Nom" name="name" :value="old('name')" required autofocus /></p>
            <!-- Role -->
            <input type="text" hidden value="" placeholder="I change on select" name="role" :value="old('role')" required autofocus  id="change">

            <select id="mySelect" onclick=refresh()>
                <option value="other">Choissisez le rôle de l'utilisateur</option>
                <option value="formatrice">Formatrice</option>
                <option value="informaticien">Informaticien</option>
            </select>

            <select name="intervenant" id="intervenant">
                {{-- Ceci sont des faux noms générés via https://en.namefake.com/french-france/female/31b5473b5c600e3f1f1febe9abb918b5 --}}
                <option value="Madame Jacynthe Collier, psychologue et consultante en accompagnement professionnel et conduite du changement">Madame Jacynthe Collier, psychologue et consultante en accompagnement professionnel et conduite du changement</option>
                <option value="Madame Julie D'Amore, psychologue du Travail, des Organisations et du Personnel.">Madame Julie D'Amore, psychologue du Travail, des Organisations et du Personnel.</option>
                <option value="Madame Michelle Mercier, consultante en Bilan de compétences et accompagnement professionnel de carrière.">Madame Michelle Mercier, consultante en Bilan de compétences et accompagnement professionnel de carrière.</option>
                <option value="Madame Nicole Tanguy, consultante en recrutement, management Opérationnel et des Entreprises, coaching individuel d’accompagnement.">Madame Nicole Tanguy, consultante en recrutement, management Opérationnel et des Entreprises, coaching individuel d’accompagnement.</option>
                <option value="Madame Alice Marechal, psychologue clinicienne et consultante en accompagnement professionnel et conduite du changement.">Madame Alice Marechal, psychologue clinicienne et consultante en accompagnement professionnel et conduite du changement.</option>
               
            </select>

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
        function refresh() {
            var x = document.getElementById("mySelect").value;
            document.getElementById("change").value = x;
            console.log(x); // en
        }
        function admin() {
            var mdp = document.getElementById("mdpAdmin").value;
            var y = 'admin';
            if(mdp == 'IAmAdmin'){
                document.getElementById("change").value = y;
            };
            console.log(y);
        }
    </script>

    </div>
</div>
@endsection

