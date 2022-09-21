<?php
namespace App\Helper;

class Helper
{
      public function createPicture($getData, $forWhat)
      {
        //recovering initial pic_name
        global $request;
        global $prenomNomPDP;
        $makeFile = $prenomNomPDP . $forWhat;
        $filenamePDP= $makeFile . "." . $request->file($getData) ->getClientOriginalExtension() ;
        // $filenamePDP=date("Y-m-d_H:i:s") . $filenamePDP;
        // upload folder in a folder and adding dateTime for avoid name mismatch
        $request->file($getData) -> storeAs('TuC_profil_pictures', $filenamePDP, [ 'disk' => 'TuC_profil_pictures']);
        // storing path on the BDD
        $validated[$getData]=$filenamePDP;
      }

}
?>
