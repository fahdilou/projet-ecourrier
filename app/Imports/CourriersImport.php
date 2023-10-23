<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Models\Courrier;
use Illuminate\Support\Facades\Log;

class CourriersImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
{
   
    $id = 6300;


    foreach ($collection as $row) {
       
                    
        $erreurLigne = $row;


        $date_arriver = $row[0];

        $date_debut_traitement = $row[4];
        $date_fin_traitement = $row[4];
        

        if (!is_numeric($date_arriver)) {
            $date_arriver = null;
        }
        
        if (!is_numeric($date_debut_traitement)) {
            $date_debut_traitement = '45200';
        }
        if (!is_numeric($date_fin_traitement)) {
            $date_fin_traitement = '45200';
        }
        
        // Formatage de la date
        $date_arriver = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($date_arriver)->format('Y-m-d');
        $date_debut_traitement = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($date_debut_traitement)->format('Y-m-d');
        $date_fin_traitement = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($date_fin_traitement)->format('Y-m-d');
       
        // Extraction des autres données
        $id = $id + 1;
        $expediteur = $row[1];
        $motif = $row[2];
        $affectation = $row[3];
        $observation = $row[5];
       

        
       
      

        // Vérification des valeurs vides et conversion en null
        if (empty($expediteur)) {
            $expediteur = "N.A";
        }
        if (empty($motif)) {
            $motif = "N.A";
        }
        if (empty($affectation)) {
            $affectation = "N.A";
        }
        if (empty($observation)) {
            $observation = "N.A";
        }
        

        if ( $date_arriver == "1970-01-01") {
            $date_arriver = null;
        }
        if ( $date_debut_traitement == "1970-01-01") {
            $date_debut_traitement = null;
        }

        if ( $date_fin_traitement == "1970-01-01") {
            $date_fin_traitement = null;
        }
        

        

        
        // Insertion dans la base de données
        Courrier::create([
            
            'expediteur' => $expediteur,
            'motif' => $motif,
            'affectation' => $affectation,
            'observation' => $observation,
            'date_arriver' => $date_arriver,
            'date_debut_traitement' => $date_debut_traitement,
            'date_fin_traitement' => $date_fin_traitement,
            'who_create' => "Admin", 
            'statut' => 'TRAITE',
            // Définissez la devise ici
            // Ajoutez d'autres colonnes ici
        ]);


       

        unset($row);
       

    
    }

   

}



}
