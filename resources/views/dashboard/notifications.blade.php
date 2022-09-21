
<!DOCTYPE html>
<html>

<head>
    <title>LOGS</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<style>
    .page-break {
        page-break-after: always;
    }
    footer { position: fixed; bottom: -20px; left: 0px; right: 0px; height: 50px; text-align:center; font-size: 10px;}
</style>



<body>
<footer>
    PM GROUPE FRANCE - 128 rue de la Boétie - 75008 Paris
                N° de SIRET 79127535700030 - N° Déclaration d'activité : 11755175375   
                Organisme de Formation non assujetti à la TVA
</footer>
<div style="margin:0 auto;font-size:1.05em; font-family: 'Open Sans', sans-serif;">
    <div style="text-align: center">
        <img style='width:180px' src='https://i.ibb.co/h9YBMK1/logo.png'>
        <img style='width:180px' src='https://i.ibb.co/vX2q2qW/logo-candidat.png'>
    </div>
    <p style="text-align: center; font-size: 35px; background-color: #2153C1; padding: 0px 80px; color: white">FEUILLE RECAPITULATIVE DE LOGS</p>
    <div style="text-align: justify !important;">
        <p style="margin-bottom: 50px">
            {{ $notifiable_type }}
            <br><br>
            {{ $data }}
        </p>
    </div>

</div>
</body>

</html>