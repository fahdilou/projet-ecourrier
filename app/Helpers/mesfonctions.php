<?php

use App\Models\Lot;
use App\Models\Camion;
use App\Models\Souche;
use App\Models\Sceller;
use App\Models\TrBltraite;
use App\Models\TrBlSynchro;
use App\Models\Justifavance;
use Illuminate\Support\Carbon;


function concatWords($existingWords) {

    return implode(',', $existingWords);

}


function extractUsernameFromEmail($email) {
    $username = strstr($email, '@', true); // Récupère la partie avant le symbole "@"
    $username = str_replace('.', '', $username); // Supprime les éventuels points dans le nom d'utilisateur
    return $username;
}


function convertToRistourneCode($codeClient) {
    if(substr($codeClient, 0, 1) === "D") {
        return 'RD' . substr($codeClient, 2);
    } else {
        // gérer le cas où le code client n'est pas sous le format attendu
        return null;
    }
}




function nbjoursentredeuxdates($datedebut,$datefin){

    $carbon_datedebut = Carbon::parse($datedebut);
    $carbon_datefin = Carbon::parse($datefin);

    return $nb = $carbon_datedebut->diffInDays($carbon_datefin);

}



function calculSomme(...$vars) {
  $somme = 0;

  foreach ($vars as $var) {
      if (is_numeric($var)) {
          $somme += $var;
      } elseif (is_string($var) && strpos($var, ',') !== false) {
          $elements = explode(',', $var);
          foreach ($elements as $element) {
              if (is_numeric($element)) {
                  $somme += $element;
              }
          }
      }
  }

  return $somme;
}


function generer($typesouche)
{


    $souche = Souche::select('last_souche')->where('type','=',$typesouche)->first();


    $pieces = explode('-',$souche->last_souche);

    $today = date("m/y");

    if ($pieces[1]===$today)
    {
        /** @noinspection TypesCastingCanBeUsedInspection */
        $n=intval($pieces[2])+1;

        $newid="$pieces[0]-$pieces[1]-$n";


    } else {
        $n=1;
        $newid="$pieces[0]-$today-$n";



    }
    return $newid;


}


function consommer($numero,$type) {

    $souche = Souche::where('type',$type)->first();
    $souche->last_souche = $numero;
    $souche->save();
}

function numeric($number){
    $data = number_format($number, 0, ',', ' ');
    return $data;
 }
 
 
 function numeric2($number){
    $data = number_format($number, 2, ',', ' ');
    return $data;
 }


 function cleanAmount($amount){
    
     // Supprimer les espaces et remplacer la virgule par un point
     $valeurSansEspaces = str_replace(' ', '', $amount);
     $valeurAvecPoint = str_replace(',', '.', $valeurSansEspaces);
     // Convertir en nombre décimal
     $valeurDecimale = (float) $valeurAvecPoint;
     
     return $valeurDecimale;
}




 function convertirDate($date) {

    //convertir la date en human format

    // Utiliser la fonction strtotime() pour convertir la date en un timestamp
    $timestamp = strtotime($date);
  
    // Utiliser la fonction date() pour formater le timestamp en une date au format désiré
    $dateFormatee = date("j F Y", $timestamp);
  
    // Retourner la date formatée
    return $dateFormatee;
}


function ecrireEnLettres($nombre) {
    // Tableaux contenant les noms des nombres de 0 à 19 et des dizaines
    $nombres = array("zéro", "un", "deux", "trois", "quatre", "cinq", "six", "sept", "huit", "neuf", "dix", "onze", "douze", "treize", "quatorze", "quinze", "seize", "dix-sept", "dix-huit", "dix-neuf");
    $dizaines = array("", "dix", "vingt", "trente", "quarante", "cinquante", "soixante", "soixante-dix", "quatre-vingt", "quatre-vingt-dix");
  
    // Si le nombre est inférieur à 20, on retourne directement le nom correspondant dans le tableau des nombres
    if ($nombre < 20) {
      return $nombres[$nombre];
    }
    // Sinon, on décompose le nombre en deux parties : les dizaines et les unités
    else {
      $dizainesPart = floor($nombre / 10);
      $unitesPart = $nombre % 10;
  
      // Si le nombre est un multiple de 10, on retourne simplement le nom des dizaines
      if ($unitesPart == 0) {
        return $dizaines[$dizainesPart];
      }
      // Sinon, on retourne le nom des dizaines suivi du nom des unités, en ajoutant un "et" entre les deux
      else {
        return $dizaines[$dizainesPart] . " et " . $nombres[$unitesPart];
      }
    }
}



