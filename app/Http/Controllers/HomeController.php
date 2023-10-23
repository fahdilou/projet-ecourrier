<?php

namespace App\Http\Controllers;

use App\Models\Aller;
use App\Models\Courrier;
use App\Models\Facture;
use App\Models\Workflow;
use App\Models\EtatFacture;
use App\Models\EtapeTraitement;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

    
        // Comptage par mois pour les statuts des courriers
        $months = [];
        $enregistrerData = [];
        $encourData = [];
        $traiteData = [];

        for ($month = 1; $month <= 12; $month++) {
            $months[] = date('M', mktime(0, 0, 0, $month, 1));
            $enregistrerData[] = Courrier::where('statut', 'ENREGISTREMENT')
                ->whereMonth('created_at', $month)
                ->count();
            $encourData[] = Courrier::where('statut', 'EN COURS DE TRAITEMENT')
                ->whereMonth('created_at', $month)
                ->count();
            $traiteData[] = Courrier::where('statut', 'TRAITE')
                ->whereMonth('created_at', $month)
                ->count();
        }



         // Comptage par mois pour les statuts des courriers
         $months_facture = [];
         $enregistrerData_facture = [];
         $encourData_facture = [];
         $traiteData_facture = [];
 
         for ($month_facture = 1; $month_facture <= 12; $month_facture++) {
             $months_facture[] = date('M', mktime(0, 0, 0, $month, 1));
             $enregistrerData_facture[] = Facture::where('etat_workflow', '1')
                 ->whereMonth('created_at', $month_facture)
                 ->count();
             $encourData_facture[] = Facture::where('etat_workflow', '>', 2)
                 ->whereMonth('created_at', $month_facture)
                 ->count();
             $traiteData_facture[] = Facture::where('etat_workflow', '2')
                 ->whereMonth('created_at', $month_facture)
                 ->count();
         }




        return view('home', compact('months', 'enregistrerData', 'encourData', 'traiteData', 'months_facture', 'enregistrerData_facture', 'encourData_facture', 'traiteData_facture'));
    }


    
}
