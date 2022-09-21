
<!DOCTYPE html>
<html>

<head>
    <title>FEUILLE-EMARGEMENT</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="/" crossorigin="anonymous">
</head>
<style>
    
    .page-break {
        page-break-after: always;
    }
    footer { position: fixed; bottom: -20px; left: 0px; right: 0px; height: 50px; text-align:center; font-size: 10px;}
</style>


<body>
<footer>
    {!! nl2br($pied_page) !!}
</footer>
<div style="margin:0 auto;font-size:1.05em; font-family: 'Open Sans', sans-serif;">
    <div style="text-align: center">
        <img style='width:180px' src='{{ $img }}'><br>
    </div>
    <p style="text-align: center; font-size: 25px; background-color: #{{$color}}; padding: 0px 80px; color: white"> <b>FEUILLE D'EMARGEMENT </b> <br> Bilan de Compétences <br> du {{ $beginDate }} au {{ $endingDate }}   </p>
    <div style="text-align: justify !important;">
        <p style="margin-bottom: 10px">
            Nom et Prénom du titulaire : <b>{{ $civility }} {{ $fullname }}</b>
        </p>
        <p style="margin-bottom: 10px">
            <table class="table" border=1>
                <thead>
                    <tr>
                        <th class="text-center"><h5>Rendez-vous avec la consultante</h5></th>
                        <th class="text-center"><h5>Signature</h5></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th class="text-center">
                            <small>{{ $do_at_one }}</small>
                            <br>
                            <small>Rdv 1</small> <br>
                            <b>Mon itinéraire professionnel </b>
                        </th>
                        <th class="text-center">
                            <img style='width:190px' src='{{ $sign }}'><br>
                            <small style="margin-left: 25px;font-style: italic;font-family: cursive;text-align: center;">{{ $fullname }}</small>
                        </th>
                    </tr>
                    <tr>
                        <th class="text-center">
                            <small>{{ $do_at_two }}</small>
                            <br>
                            <small>Rdv 2 </small><br>
                            <b>Mes motivations, ma personnalité</b>
                        </th>
                        <th class="text-center">
                            <img style='width:190px' src='{{ $sign }}'><br>
                            <small style="margin-left: 25px;font-style: italic;font-family: cursive;text-align: center;">{{ $fullname }}</small>
                        </th>
                    </tr>
                    <tr>
                        <th class="text-center">
                            <small>{{ $do_at_three }}</small>
                            <br>
                            <small>Rdv 3 </small><br>
                            <b>Mes aspirations et mes freins</b>
                        </th>
                        <th class="text-center">
                            <img style='width:190px' src='{{ $sign }}'><br>
                            <small style="margin-left: 25px;font-style: italic;font-family: cursive;text-align: center;">{{ $fullname }}</small>
                        </th>
                    </tr>
                    <tr>
                        <th class="text-center">
                            <small>{{ $do_at_four }}</small>
                            <br>
                            <small>Rdv 4</small><br>
                            <b>Mon projet professionnel</b>
                        </th>
                        <th class="text-center">
                            <img style='width:190px' src='{{ $sign }}'><br>
                            <small style="margin-left: 25px;font-style: italic;font-family: cursive;text-align: center;">{{ $fullname }}</small>
                        </th>
                    </tr>
                </tbody>
            </table>
        </p>
        <p style='font-size:16px;margin-bottom: 10px'>
            J’atteste m'être connecté(e) et avoir suivi les ateliers présents sur la plateforme d’e-learning
            <a href="{{ $link }}" target="_blank" rel="noopener noreferrer">{{ $link }}</a>
        </p>
        <p style="margin-bottom: 10px">
            <table class="table" border=1>
                <thead>
                    <tr>
                        <th class="text-center"><small><b>Connexion à la plateforme d’e-learning</small></b></th>
                        <th class="text-center"><small><b>Signature</small></b></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th class="text-center">
                            <small> Inter Rendez-vous </small>
                            <br>
                            <small> Semaine du {{ $beginDate }} au {{ $endingDate }}</small>
                        </th>
                        <th class="text-center">
                            <img style='width:190px' src='{{ $sign }}'><br>
                            <sub><small> Signé par {{ $fullname }}</small></sub>
                        </th>
                    </tr>
                </tbody>
            </table>
        </p>
    </div>
</div>
</body>

</html>
