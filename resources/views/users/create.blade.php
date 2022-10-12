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
                <option value="Madame Soumaya TRIKI, psychologue et consultante en accompagnement professionnel et conduite du changement">Madame Soumaya TRIKI, psychologue et consultante en accompagnement professionnel et conduite du changement</option>
                <option value="Madame Amélia LAMRI, psychologue du Travail, des Organisations et du Personnel.">Madame Amélia LAMRI, psychologue du Travail, des Organisations et du Personnel.</option>
                <option value="Madame Tifenn GUINANT, consultante en Bilan de compétences et accompagnement professionnel de carrière.">Madame Tifenn GUINANT, consultante en Bilan de compétences et accompagnement professionnel de carrière.</option>
                <option value="Madame Barbara LACRESSONNIERE, consultante en recrutement, management Opérationnel et des Entreprises, coaching individuel d’accompagnement.">Madame Barbara LACRESSONNIERE, consultante en recrutement, management Opérationnel et des Entreprises, coaching individuel d’accompagnement.</option>
                <option value="Madame Mathilde GARCIA, psychologue clinicienne et consultante en accompagnement professionnel et conduite du changement.">Madame Mathilde GARCIA, psychologue clinicienne et consultante en accompagnement professionnel et conduite du changement.</option>
                <option value="Madame Virginie COURVOISIER, coach certifiée RNCP, spécialisée en transition professionnelle et évolution de carrière.">Madame Virginie COURVOISIER, coach certifiée RNCP, spécialisée en transition professionnelle et évolution de carrière.</option>
                <option value="Martine LOUVEL DE MONCEAUX : Consultante Bilan de compétences et développement professionnel">Martine LOUVEL DE MONCEAUX : Consultante Bilan de compétences et développement professionnel</option>
                <option value="Estelle RIVIERE, psychologue du travail et consultante en bilan de competence">Estelle RIVIERE, psychologue du travail et consultante en bilan de competence</option>
                <option value="Madame Céline BONET, consultante vie professionnelle, en bilan de compétenes et coach professionnelle certifiée.">Madame Céline BONET, consultante vie professionnelle, en bilan de compétenes et coach professionnelle certifiée.</option>
                <option value="Madame Emilie ROZIER, formatrice depuis plus de 15 ans et consultante en bilan de compétences.">Madame Emilie ROZIER, formatrice depuis plus de 15 ans et consultante en bilan de compétences.</option>
                <option value="Madame Françoise MARGUET, consultante en RH et en bilans de compétences.">Madame Françoise MARGUET, consultante en RH et en bilans de compétences.</option>
		<option value="Madame Dovy BURLANDI, formatrice en bilans de compétences.">Madame Dovy BURLANDI,formatrice en bilan de compétence</option>
                <option value="Madame Thi-Van MUONGHANE, Formatrice, coach et consultante en bilan de compétences, depuis plus de 10 ans.">Madame Thi-Van MUONGHANE, Formatrice, coach et consultante en bilan de compétences, depuis plus de 10 ans.</option>
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

