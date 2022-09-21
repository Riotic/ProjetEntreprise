
<!DOCTYPE html>
<html>

<head>
    <title>{{ $filename }}</title>
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
    {!! nl2br($pied_page) !!}
</footer>
<div style="margin:0 auto;font-size:1.05em; ">
    <div style="text-align: center">
        <img style='width:180px' src='{{ $img }}'>
    </div>
    <p style="text-align: center; font-size: 35px; background-color: #37aff0; padding: 0px 80px; color: white">ATTESTATION INDIVIDUELLE DE FIN DE FORMATION</p>
    <div style="text-align: justify !important;">
        <p style="margin-bottom: 50px">Je soussigné(e) {{ $representant }}, représentant(e) légal(e) de l’organisme de formation
            {{ $organisme }} atteste que {{ $civility }} {{ $fullname }}, {{ $job }} a suivi le Bilan de Compétences sur la période du
            {{ $beginDate  }} au {{ $endingDate }}.
        </p><p style='margin-left: 30px; font-size:16px;'><span style="text-decoration: underline">Durée du Bilan de compétences</span> : 24h00</p>
        <p style='margin-left: 30px; font-size:16px;'>Intervenant(e) : {{ $intervenant }}</p>
        <p style='margin-left: 30px; font-size:16px;'>
            <span style="text-decoration: underline">Objectifs pédagogiques mentionnés dans le programme de formation</span> :
        </p>
        <p style='margin-left: 30px; font-size:16px;margin-bottom: 50px'>
            Le bilan de compétences est une réflexion professionnelle pour repérer les atouts,
            les axes de développement, et les traduire en objectifs de changement. Les bénéficiaires apprendront à mieux se connaître au
            travers de questionnaires de personnalité, à valoriser l’estime de soi et ainsi comprendre les choix, les causes de changement,
            les différentes expériences, les formations effectuées ou suivies qu’ils ont fait lors de leurs parcours professionnels.
        </p>

        <p style='margin-left: 30px; font-size:16px;margin-bottom: 50px'>
            Lors de la deuxième phase, l’exploration de l’histoire professionnelle et personnelle
            permettra d’identifier les compétences construites et de rédiger un portfolio de compétences.
        </p>

        <p style='margin-left: 30px;font-size:16px;margin-bottom: 50px'>
            Identifier, clarifier et valider un projet de développement de compétences, ainsi que la rédaction d’un plan d’action en lien
            avec le développement de compétences.
        </p>

        <p style='margin-left: 30px; font-size:16px;margin-bottom: 50px'>
            Enfin, lors de la dernière phase du bilan de compétences, la consultante délivrera aux bénéficiaires les informations
            recueillies via leurs travaux effectués au préalable, analysera en synergie avec les stagiaires les compétences révélées
            et pour finir rédigera la synthèse du bilan de compétences.
        </p>

        <div class="page-break"></div>

        <p style='margin-left: 30px; font-size:16px;'>
            <span style="text-decoration: underline">Résultats de l’évaluation des acquis </span> :
        </p>

        <p style='margin-left: 30px; font-size:16px;margin-bottom: 50px'>
            Le participant a appris à mieux se connaître au travers des questionnaires de personnalité, à valoriser l’estime
            de soi et ainsi comprendre ses choix, les causes de changement, ses différentes expériences, ses formations effectuées
            ou suivies qu’il a fait lors de son parcours professionnel.
        </p>

        <p style='font-size:16px;margin-bottom: 50px'>
            Le bilan de compétences a permis au bénéficiaire de valider son projet réaliste et réalisable et ainsi définir son plan
            d’actions pour la concrétisation de celui-ci.
        </p>

        <p>Fait à {{ $do_at }}</p>

        <div style='margin-top: 40px;'>
            <div style='float:left;'>
                <p>{{ $organisme_2 }}</p>
                <p>{{ $representant }}</p>
                <p>Gérant(e)</p>
            </div>
            <div style='float:right; margin-top: 39px'>
                <p>{{ $civility }} {{ $fullname }}</p>
                <p>Bénéficiaire</p>
            </div>
        </div>

        <div style="clear: both"></div>
        
        
        
        
        
        <div>
            <div style='float:left; margin-left: 10px;'>
                <div style="margin-bottom: 20px">Signature</div>
                @if(strpos(strtoupper($representant), 'BEAUCOURT') !== false)
                    <div>
                        <img style='width:180px' src='https://i.ibb.co/F6W98Rm/signature-beaucourt.png'>
                    </div>
                @elseif(strpos(strtoupper($representant), 'COVILETTE') !== false)
                    <div>
                        <img style='width:180px' src='https://i.ibb.co/wNT9TNK/signature-colivette.png'>
                    </div>
                @endif

                @if(strpos(strtoupper($organisme_2), 'AC') !== false)
                    <img style='width:180px;' src='https://i.ibb.co/ZWSd6zB/tampon-ac.png'>
                @elseif(strpos(strtoupper($organisme_2), 'PM') !== false)
                	<img style='width:180px;' src='https://i.ibb.co/BjWhsvN/tampon-pm.png'>
                @elseif(strpos(strtoupper($organisme_2), 'EVOLUTION') !== false)
                	<img style='width:180px;' src='https://i.ibb.co/Cz89s7d/tampon-evolution.png'>
                @endif
            </div>
            <div style='float:right; margin-right: 10px;'>
                <div>Signature</div>
            </div>
        </div>
        <div style="clear: both"></div>
    </div>

</div>
</body>

</html>
