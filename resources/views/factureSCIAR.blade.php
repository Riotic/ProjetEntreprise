
<!DOCTYPE html>
<html>

<head>
    <title>{{ $i}}</title>
    <link rel="stylesheet" type="text/css"
        href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="/"
        crossorigin="anonymous">
</head>

<style>
    .b {
        font-family: 'Courier New', Courier, monospace, serif;
        font-weight: bolder;
    }
</style>

<body style="width: 92%;margin-left:3%;">
    <div class="row">
        <div class="col-sm" style="max-width: 70% !important;float: left;">
            <p>
            <h5  style="max-width: 70% !important;color: #0099ff; border: 2px solid black; padding: 3%;font-family: 'Courier New', Courier, monospace, serif; font-weight: bolder;margin-left: -10px;">SCI 128 RUE LA BOETIE</h5>
            </p>
        </div>
        <div class="col-sm">
            <p style="text-align: right;">
                <span style="font-weight: bold;font-size: 22px;">FACTURE{{ $f }}</span><br>
                <span class="text-right" style="align-text: right;">N° {{ $i}}  {{ $f }}<br>
                Date: le {{ $i }}</span>
            </p>
        </div>
    </div>
    <div class="row">
        <table>
            <tbody>
                <tr>
                    <td colspan="5">
                        128 rue de la Boétie <br />
                        75008 PARIS <br />
                        Siret : 84471932800016<br /><br />
                        <div class="row" style="font-size: 13px;">
                            <div class="col-md-1"><b>Objet : </b>
                            </div>
                            <div class="col-md-11">
                                 FOURNITURE DE SUPPORT PEDAGOGIQUE <br>
                                <small> Concepton & délivrance de support pédagogique</small>
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="panel panel-default invoice" id="invoice">
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-6 top-left">
                    <br><br>
                    <h3 class="marginright"><b> </b>
                    </h3>
                </div>

                <div class="col-sm-6 top-right" style="position: relative;left:65%;top:-100px;">
                    <b> FACTURER À :</b><br />
                    AGENCE RECRUTEMENT<br />
                    128 RUE DE LA BOETIE<br />
                    75008 PARIS<br />
                    SIRET: 877 892 430 00019<br />
                </div>

            </div>
            <div class="row table-row" style="margin-top: -12%;font-size:12px;">
                <table class="table" border=1>
                    <tr class=" table-striped" style="height: 10px !important;background-color: lightgray;font-weight:bolder;font-size:12px;">
                        <td class="text-center" style="">DESCRIPTION</td>
                        <td class="text-center" style="">Quantité</td>
                        <td class="text-center" style="">Prix Unitaire</td>
                        <td class="text-center" style="">MONTANT HT</td>
                    </tr>
                    <tr style="height: 10px !important;">
                        <td class="text-left">Fourniture bilan pédagogique</td>
                        <td class="text-left"></td>
                        <td class="text-left"></td>
                        <td class="text-center"><b> 350 €</b></td>
                    </tr>
                    <tr style="outline: thin solid">
                        <td class="text-left">{{ $i}}</td>
                        <td class="text-left"></td>
                        <td class="text-left"></td>
                        <td class="text-left"></td>
                    </tr>
                    <tr style="outline: thin solid">
                        <td class="text-left">Prise en compte des spécificités du stagiaire</td>
                        <td class="text-left"></td>
                        <td class="text-left"></td>
                        <td class="text-left"></td>
                    </tr>
                    <tr style="outline: thin solid">
                        <td class="text-left">Co-construction du programme détaillé</td>
                        <td class="text-left"></td>
                        <td class="text-left"></td>
                        <td class="text-left"></td>
                    </tr>
                    <tr>
                        <td style="border:none;" class="text-left"> </td>
                        <td style="border:none;"  class="text-left"></td>
                        <td style="border:none;"  class="text-center"><b>TOTAL HT</b></td>
                        <td style="border:none;background-color: lightgray;font-weight:bolder;"  class="text-center"><b>350 €</b></td>
                    </tr>
                </table>
                <span style="font-size:12px;font-style:italic;font-weight:bolder;">NOUS VOUS REMERCIONS DE VOTRE CONFIANCE</span>
                    <span style="position:relative;top:-40px;margin-left:80%;font-size:8px;">TVA non applicable, art. 293B du CGI</span>
            </div>
        </div>
    </div>
    <div class="" style="margin-top: -2%;margin-left: -20px;width:105%;"><br>
        <img src="https://i.ibb.co/b3j4rzP/rib-true.png" style="height: 80%;width:95%;z-index: -1" alt="" srcset="">
        
    </div>
            <div class="font-weight-bold" style="position:relative;top: 70px;z-index:1px;font-size:10px;line-height: 90%;font-style:italic;"><center><b> SCI 128 RUE LA BOETIE</b> <br>
                    <b>128 rue de la boetie - Siret 79127535700030</b>
                </center>
            </div>
</body>
</html>