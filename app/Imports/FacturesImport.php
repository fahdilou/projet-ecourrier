<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Models\Facture;
use App\Models\EtatFacture;
use App\Models\Configuration;
use Illuminate\Support\Facades\Log;

class FacturesImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
{
    try {
    $id = 75;


   
    foreach ($collection as $row) {
        try {
                    
        $erreurLigne = $row;


        $dateFactureExcel = $row[2];
        $date_arriver_facture = $row[6];

        $date_entrer_dcag = $row[7];
        $date_sortie_dcag = $row[8];
        $date_entrer_control = $row[9];
        $date_sortie_control = $row[10];
        $date_entrer_audit = $row[11];
        $date_sortie_audit = $row[12];
        $date_entrer_kirene = $row[13];
        $date_sortie_kirene = $row[14];
        $date_depot_banque = $row[15];

        if (!is_numeric($dateFactureExcel)) {
            $dateFactureExcel = null;
        }
        if (!is_numeric($date_arriver_facture)) {
            $date_arriver_facture = null;
        }
        if (!is_numeric($date_entrer_dcag)) {
            $date_entrer_dcag = null;
        }
        if (!is_numeric($date_sortie_dcag)) {
            $date_sortie_dcag = null;
        }

        if (!is_numeric($date_entrer_control)) {
            $date_entrer_control = null;
        }
        if (!is_numeric($date_sortie_control)) {
            $date_sortie_control = null;
        }

        if (!is_numeric($date_entrer_audit)) {
            $date_entrer_audit = null;
        }
        if (!is_numeric($date_sortie_audit)) {
            $date_sortie_audit = null;
        }

        if (!is_numeric($date_entrer_kirene)) {
            $date_entrer_kirene = null;
        }
        if (!is_numeric($date_sortie_kirene)) {
            $date_sortie_kirene = null;
        }

        if (!is_numeric($date_depot_banque)) {
            $date_depot_banque = null;
        }

        // Formatage de la date
        $dateFactureExcel = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($dateFactureExcel)->format('Y-m-d');
        $date_arriver_facture = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($date_arriver_facture)->format('Y-m-d');

        $date_entrer_dcag = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($date_entrer_dcag)->format('Y-m-d');
        $date_sortie_dcag = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($date_sortie_dcag)->format('Y-m-d');
        $date_entrer_control = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($date_entrer_control)->format('Y-m-d');
        $date_sortie_control = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($date_sortie_control)->format('Y-m-d');
        $date_entrer_audit = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($date_entrer_audit)->format('Y-m-d');
        $date_sortie_audit = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($date_sortie_audit)->format('Y-m-d');
        $date_entrer_kirene = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($date_entrer_kirene)->format('Y-m-d');
        $date_sortie_kirene = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($date_sortie_kirene)->format('Y-m-d');
        $date_depot_banque = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($date_depot_banque)->format('Y-m-d');

        // Extraction des autres données
        //$id = $id + 1;
        $numero_facture = $row[3];
        $fournisseur = $row[1];
        $montant = $row[4];
        $commentaire = $row[5];

        
       
        // Vous pouvez extraire d'autres données ici

        // Vérification des valeurs vides et conversion en null
        if (empty($numero_facture)) {
            $numero_facture = "N.A";
        }
        if (empty($fournisseur)) {
            $fournisseur = "N.A";
        }
        if (empty($montant)) {
            $montant = 0;
        }
        if ($date_arriver_facture == "1970-01-01") {
            $date_arriver_facture = $dateFactureExcel;
        }

        if ( $date_entrer_dcag == "1970-01-01") {
            $date_entrer_dcag = null;
        }
        if ( $date_sortie_dcag == "1970-01-01") {
            $date_sortie_dcag = null;
        }

        if ( $date_entrer_control == "1970-01-01") {
            $date_entrer_control = null;
        }
        if ( $date_sortie_control == "1970-01-01") {
            $date_sortie_control = null;
        }

        if ( $date_entrer_audit == "1970-01-01") {
            $date_entrer_audit = null;
        }
        if ( $date_sortie_audit == "1970-01-01") {
            $date_sortie_audit = null;
        }

        if ( $date_entrer_kirene == "1970-01-01") {
            $date_entrer_kirene = null;
        }
        if ( $date_sortie_kirene == "1970-01-01") {
            $date_sortie_kirene = null;
        }

        if ( $date_depot_banque == "1970-01-01") {
            $date_depot_banque = null;
        }

        // Vérification de la devise
        $devise = 'XOF'; // Par défaut
        if (stripos($montant, 'EUR') !== false || stripos($montant, 'EUROS') !== false || stripos($montant, '£') !== false || stripos($montant, 'EURO') !== false) {
            $devise = 'EUR';
            // Remplacez les symboles de devise et nettoyez la chaîne de montant
$montant = preg_replace('/[^0-9.,]/', '', $montant);
            // Supprimez "EUR" ou "EUROS" de la chaîne de montant
            $montant = str_ireplace(['EUR', 'EUROS','EURO','£'], '', $montant);
            // Supprimez les espaces blancs de début et de fin
            $montant = trim($montant);
            // Supprimez tous les espaces non numériques de la valeur du montant
$montant = preg_replace("/[^0-9.,]/", "", $montant);
            // Remplacez les virgules par un point pour obtenir un montant valide
            $montant = str_replace(' ', '', $montant);
$montant = str_replace(',', '.', $montant);
$montant = floatval($montant);
        }
        if (stripos($montant, 'USD') !== false || stripos($montant, 'Dollars US') !== false) {
            $devise = 'USD';
            // Supprimez "EUR" ou "EUROS" de la chaîne de montant
            $montant = str_ireplace(['USD','Dollars US'], '', $montant);
            // Supprimez les espaces blancs de début et de fin
            $montant = trim($montant);
            // Supprimez tous les espaces non numériques de la valeur du montant
$montant = preg_replace("/[^0-9.,]/", "", $montant);
            $montant = str_replace(' ', '', $montant);
$montant = str_replace(',', '.', $montant);
// Supprimez les espaces de la valeur du montant

$montant = floatval($montant);
        }
        // Supprimez les espaces blancs de début et de fin
        $montant = trim($montant);
        // Supprimez tous les espaces non numériques de la valeur du montant
$montant = preg_replace("/[^0-9.,]/", "", $montant);
        $montant = str_replace(' ', '', $montant);
$montant = str_replace(',', '.', $montant);
// Supprimez les espaces de la valeur du montant

$montant = floatval($montant);


// Vérifiez la longueur de la valeur du montant
$maxMontantLength = 10; 

if (strlen($montant) > $maxMontantLength) {
    $montant = 0; // Mettez la valeur à zéro si elle dépasse la longueur maximale
}



        // Insertion dans la base de données
       $facture_create = Facture::create([
          
            'numero_facture' => $numero_facture,
            'fournisseur' => $fournisseur,
            'date_facture' => $dateFactureExcel,
            'montant' => $montant,
            'commentaire' => $commentaire,
            'date_arriver_facture' => $date_arriver_facture,
            'devise' => $devise, 
            'who_create' => "Admin", 
            'etat_workflow' => "1",
            'etat_traitement' => "1", 
            // Définissez la devise ici
            // Ajoutez d'autres colonnes ici
        ]);
$a = 1;
$vars = $facture_create->id;
$id = $vars;

        if ( $date_entrer_dcag != null) {
            EtatFacture::create([
                'facture_id' => $id, // L'ID de la facture créée précédemment
                'workflow_id' => "3", 
                'etapetraitement_id' => "1",
                'date_entree' => $date_entrer_dcag,
                'date_sortie' => $date_sortie_dcag,
                'who_update' => "Admin", 
                
            ]);
            Facture::where('id', $id) // Utilisez l'ID de la facture créée précédemment
            ->update(['etat_workflow' => "3"]);
        }
        $a = 2;
//dd($date_entrer_control);
        if ( $date_entrer_control != null) {
            $var = 10; 
            
        EtatFacture::create([
            'facture_id' => $id, // L'ID de la facture créée précédemment
            'workflow_id' => "4", 
            'etapetraitement_id' => "1",
            'date_entree' => $date_entrer_control,
            'date_sortie' => $date_sortie_control,
            'who_update' => "Admin", 
            
        ]);
            Facture::where('id', $id) // Utilisez l'ID de la facture créée précédemment
            ->update(['etat_workflow' => "4"]);
            //dd($var);

        }

       
        if ( $date_entrer_audit != null) {
            EtatFacture::create([
                'facture_id' => $id, // L'ID de la facture créée précédemment
                'workflow_id' => "5", 
                'etapetraitement_id' => "1",
                'date_entree' => $date_entrer_audit,
                'date_sortie' => $date_sortie_audit,
                'who_update' => "Admin", 
                
            ]);
            Facture::where('id', $id) // Utilisez l'ID de la facture créée précédemment
            ->update(['etat_workflow' => "5"]);
        }

        
       
        if ( $date_entrer_kirene != null) {
            EtatFacture::create([
                'facture_id' => $id, // L'ID de la facture créée précédemment
                'workflow_id' => "6", 
                'etapetraitement_id' => "1",
                'date_entree' => $date_entrer_kirene,
                'date_sortie' => $date_sortie_kirene,
                'who_update' => "Admin", 
                
            ]);
            Facture::where('id', $id) // Utilisez l'ID de la facture créée précédemment
            ->update(['etat_workflow' => "6"]);
        }
       

        if ( $date_depot_banque != null) {
            Facture::where('id', $id) // Utilisez l'ID de la facture créée précédemment
        ->update(['etat_workflow' => "2"], ['etat_traitement' => null]);

            EtatFacture::create([
                'facture_id' => $id, // L'ID de la facture créée précédemment
                'workflow_id' => "2", 
                'etapetraitement_id' => null,
                'date_entree' => $date_depot_banque,
                'date_sortie' => $date_depot_banque,
                'who_update' => "Admin", 
                
            ]);
        }

       $facture = Facture::findOrFail($vars);
       //dd($facture);
       //trouver le montant_autorisation
       $montant_autorisation = Configuration::where('name', 'montant_autorisation')->first();

       
       
       if ( $facture->etat_workflow == 5 && $facture->devise == 'XOF') {
        if ($facture->montant <= $montant_autorisation->value)
                {
                    $facture->etat_workflow = 10; // Mettre l'état à 2 si c'est le dernier workflow
                    $facture->etat_traitement = 0;
                
                   $facture->save();
                  // dd($facture->montant);
                }

       }
       //dd($facture);
      
      // unset($row);

       

        if ($erreurLigne !== null) {
            Log::error('Ligne en erreur : ' . implode(', ', $erreurLigne->toArray()));
        }

    } catch (\Exception $e) {
        Log::error('Erreur lors de l\'importation du fichier Excel, ligne en erreur : ' . implode(', ', $row->toArray()));
        continue; 
    } 
    }

    
} catch (\Exception $e) {
    $this->importError = $e; 
    Log::error('Erreur lors de l\'importation du fichier Excel : ' . $e->getMessage());
}
}



}
