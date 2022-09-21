@extends('dashboard.home') @section('main')
<div class="main_div contact">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-9">
                    @if(isset($users))
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus, eaque facere repudiandae quam dolore dicta animi fugit. Eaque quia quo esse velit, amet odio, ratione accusantium voluptatibus provident modi fugiat!
                    @endif
                    <div class="col-md-12">
                        <div class="info-box card">
                            <div class="row card-body">
                                <div class="col-md-12">
                                    <label for=""><br></label>
                                    <input type="text" class="form-control lonf" id="search" name="search" value="" placeholder="Écrivez votre recherche">
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <br>
                                <table id="DataTable" class="table table-hover m-b-0">
                                    <thead>
                                        <tr>
                                            <th data-breakpoints="sm xs">ID</th>
                                            <th data-breakpoints="sm xs">Nom</th>
                                            <th data-breakpoints="xs">Prénom</th>
                                            <th data-breakpoints="sm xs">Email</th>
                                            <th data-breakpoints="sm xs md">Créer la synthèse</th>
                                            <th data-breakpoints="sm xs md">Modifier</th>
                                        </tr>
                                    </thead>
                                    <tbody id='tbody'>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="col-lg-12">
                                <div class="info-box ">
                                    <i class="bi bi-person-plus"></i>
                                    <h3>Ajouter Un Nouveau Candidat</h3>
                                    <p>Enovyer un mail,<br>Et créer sa synthèse</p>
                                </div>
                                <button type="button" class="btn btn-lg btn-primary" data-bs-toggle="modal" data-bs-target="#largeModal"> + Ajouter Un Nouveau Candidat </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@easepick/bundle@1.2.0/dist/index.umd.min.js"></script>
<style>
    .easepick-wrapper {
        z-index: 9999 !important;
    }
</style>
<div class="modal fade" id="largeModal" tabindex="-1" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <img src="https://i.ibb.co/7KKcgdc/egbw.jpg" alt="egbw" border="0" width="70px">
                <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    <form action="/init_tuc" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Civilité</h5>
                                        <select class="form-control" name="civilite" id="civilite">
                                            <option value="Mme">Mme</option>
                                            <option value="M.">M.</option>
                                        </select>
                                        <br>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">organisme : PM / AC / EP</h5>
                                        <select class="form-control" name="organisme" id="organisme">
                                            <option value="AC">AC</option>
                                            <option value="EP">EP</option>
                                            <option value="PM">PM</option>
                                        </select>
                                        <br>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Prenom du candidat</h5>
                                <input class="form-control" type="text" placeholder="Prenom " value='' id="surname" name="surname" required><br>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Nom du candidat</h5>
                                <input class="form-control" type="text" placeholder="Nom " value='' id="name" name="name"  required><br>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Email du candidat</h5>
                                <input class="form-control" type="email" placeholder="Email : test@test.com" id="email" value='' name="email" required><br>
                            </div>
                        </div>


                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Identifiant du candidat</h5>
                                <input type="text" value="" placeholder="Identifiant" name="PDPuser" id="PDPuser" hidden />
                                <input type="text" value="" placeholder="Identifiant" name="identifiant" id="display" disabled />
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Mot de passe du candidat </h5>
                                <input class="form-control" type="text" placeholder="Prenom.Nom" value='' id="password" name="password" required><br>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <i class="bi bi-exclamation-octagon me-1"></i>
                                <h6 class="card-title">Important et obligatoire, Remplir les horaires des Rendez-vous ( Voir suivi Admin )</h6>
                                <br>
                                <div class="row">
                                    <input id="datepicker" name="dates" required onclick="enableButton()"/>
                                    <script>
                                        const picker = new easepick.create({
                                            element: document.getElementById('datepicker'),
                                            css: [
                                                'https://cdn.jsdelivr.net/npm/@easepick/bundle@1.2.0/dist/index.css',
                                            ],
                                            plugins: ['RangePlugin'],
                                            RangePlugin: {
                                                tooltipNumber(num) {
                                                    num = num +1;
                                                    return num - 1;
                                                },
                                                locale: {
                                                    one: 'Rdv ',
                                                    other: 'Rdv ',
                                                },
                                            },
                                        });
                                    </script>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <a id="link_mail" onclick="call_candidat()" class="btn btn-block btn-primary">ENVOYER UN MAIL POUR SIGNALER </a><br>
                            <button id="button_register" type="submit" class="btn btn-block btn-success" disabled >SAUVEGARDER </button>
                        </div>

                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default _closeModal_" data-bs-dismiss="modal" id="closeModal">ANNULER</button>
            </div>
        </div>

    </div>
</div>
<script type="text/javascript">
    const search = document.getElementById('search');
    const tableBody = document.getElementById('tbody');

    function getContent() {
        const searchValue = search.value;
        const xhr = new XMLHttpRequest();
        xhr.open('GET', '{{ route('search_tuc') }}/?search=' + searchValue, true);
        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                tableBody.innerHTML = xhr.responseText;
            }
        }
        xhr.send()
    };

    search.addEventListener('input', getContent);
    function capitalizeFirstLetter(str) {
        const capitalized = str.charAt(0).toUpperCase() + str.slice(1);
        return capitalized;
    }
    const UpperCaseThat = () => {
            let z = document.getElementById("name").value.toUpperCase();
            document.getElementById("name").value = z;
    };

    const refresh = () => {
            UpperCaseThat();
            let x = document.getElementById("surname").value;
            let y = capitalizeFirstLetter(x);
            let prenomClean = y.normalize("NFD").replace(/[\u0300-\u036f]/g, "").split(' ').join('-');
            let z = document.getElementById("name").value;
            let nomClean = z.normalize("NFD").replace(/[\u0300-\u036f]/g, "").split(' ').join('-');
            let identifiant = prenomClean + '.' + nomClean.toUpperCase();
            document.getElementById("surname").value = y;
	    document.getElementById("display").value = identifiant;
            t = document.getElementById("display").value;
            document.getElementById("PDPuser").value = t;
    };
    setInterval(refresh, 500);
</script>
<script>
    var intervalId = window.setInterval(function() {
        if ((document.getElementById("surname").value.length) > 2 && (document.getElementById("name").value.length) > 2) {
            document.getElementById("password").value = "M@formation2022";
        }
        //setCookie('html', html, 30);
    }, 3000);
</script>
<script>
    function call_candidat() {
    var content = "Synthèse Bilan de compétences \nPour vous connecter sur la plateforme https://bdc-synthese.fr/ veuillez utiliser les logins suivants. \nEmail : " + document.getElementById("email").value + " \nMot de passe :  M@formation2022 \nAprès divers entretiens avec votre formateur(rice) vous aurez vos identifiants et mot de passe pour vous connecter sur la plateforme trouver-un-candidat.com/";

        var link = "mailto:" + document.getElementById("email").value
             + "?cc=contact@trouver-un-candidat.com"
             + "&subject=" + encodeURIComponent("Vos identifiants pour vous connecter sur la plateforme BDCsynthese")
             + "&body=" + encodeURIComponent(content);

        window.location.href = link;
        if (true) {
            setTimeout(function(){
                document.getElementById('link_mail').style.display = "none";
                document.getElementById('button_register').style.display = "block";
            }, 2000);
        }

    }
    function enableButton(){
        checkDate = document.getElementById("datepicker").value;
        tailleDate = checkDate.length;
        if(tailleDate > 5 ){
            document.getElementById("button_register").disabled = false;
        }
        console.log(checkDate);
    }
</script>
@endsection
