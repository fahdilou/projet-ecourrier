<?php

namespace App\Http\Controllers;

use App\Models\Facture;
use App\Models\Workflow;
use App\Models\EtatFacture;
use App\Models\EtapeTraitement;
use App\Models\Souche;
use App\Models\Configuration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Validation\Rule;
use DataTables;


class FactureController extends Controller
{
    public function index()
    {
        $factures = Facture::all();
        return view('factures.index', compact('factures'));
    }

    public function show($id)
    {
        $facture = Facture::findOrFail($id);
        return view('factures.show', compact('facture'));
    }

    public function create()
    {
        $workflows = Workflow::all();
        $etapetraitements = EtapeTraitement::all();
        $fournisseurs = Facture::pluck('fournisseur')->toArray();
        $fournisseurs = array_map('trim', $fournisseurs); // Supprime les espaces autour de chaque élément
        $fournisseurs = array_unique($fournisseurs);
        $fournisseurs = array_slice($fournisseurs, 0, 1000);

        
        $facturesEnregistrement = Facture::where('etat_workflow', '1')->whereDate('created_at', Date::today()) ->orderby('updated_at', 'desc')->get();
        $workflows_debut = Workflow::where('type', 'DEBUT')->get();
        $workflows_fin = Workflow::where('type', 'FIN')->get();
        $etatfacture = EtatFacture::all();
        $workflows_any = Workflow::whereNotNull('num_ordre')->orderBy('num_ordre')->get();

        return view('factures.create', compact('workflows', 'etapetraitements', 'fournisseurs','facturesEnregistrement','workflows_debut','workflows_fin','etatfacture','workflows_any'));
    }

    public function store(Request $request)
    {


        $lastSouche = Souche::orderByDesc('id')->first();
        $newSouche = $lastSouche->last_souche + 1;

       // $montant = $request->input('montant');
       
        //dd($montant);
        // Valider les données du formulaire avant de créer la facture
        $request->validate([
            'fournisseur' => 'required|string',
            'date_facture' => 'required|date|before_or_equal:today', 
            'date_arriver_facture' => 'required|date|before_or_equal:today',
            'numero_facture' => [
                'required',
                'string',
                Rule::unique((new Facture)->getTable())->where(function ($query) use ($request) {
                    return $query->where('fournisseur', $request->input('fournisseur'));
                }),
            ],
            'devise' => 'required|string|in:XOF,EUR,USD',
            'montant_hidden' => 'required|numeric',
            'commentaire' => 'nullable|string',
            'who_create' => 'required|string',
            'date_facture' => [
                'required',
                'date',
                function ($attribute, $value, $fail) use ($request) {
                    $dateArriverFacture = $request->input('date_arriver_facture');
                    if ($value > $dateArriverFacture) {
                        $fail("La date de facture doit être antérieure à la date d'arrivée de la facture.");
                    }
                },
            ],
        ], [
            'numero_facture.unique' => 'Ce numéro de facture existe déjà pour ce fournisseur.',
            'date_facture.before_or_equal' => 'La date de facture doit être inférieure ou égale à la date du jour.',
            'date_arriver_facture.before_or_equal' => 'La date d\'arrivée de la facture doit être inférieure ou égale à la date du jour.',
        ]);
        

       

         // Trouver l'ID du workflow de type "Début"
         $workflowDebut = Workflow::where('type', 'DEBUT')->firstOrFail();


        $facture = new Facture([
           
            'fournisseur' => $request->input('fournisseur'),
            'date_facture' => $request->input('date_facture'),
            'date_arriver_facture' => $request->input('date_arriver_facture'),
            'numero_facture' => $request->input('numero_facture'),
            'devise' => $request->input('devise'),
            'montant' => $request->input('montant_hidden'),
            'commentaire' => $request->input('commentaire'),
            'who_create' => $request->input('who_create'),
            'etat_workflow' => $workflowDebut->id,
            'etat_traitement' => 0,
        ]);

      


        // Sauvegarder la nouvelle facture
        $facture->save();

        

        // Enregistrer l'état de la facture dans la table etat_factures
        $etatFacture = new EtatFacture([
            'facture_id' => $facture->id,
            'workflow_id' => $workflowDebut->id,
           
            'date_entree' => now(),
            'who_update' => $facture->who_create,
        ]);

        // Sauvegarder l'état de la facture
        $etatFacture->save();



        $lastSouche->update([
            'last_souche' => $newSouche,
        ]);
        

        // Rediriger l'utilisateur vers la liste des factures avec un message de succès
        return redirect()->route('factures.create')->with('success', 'La facture a été créée avec succès.');
    }

    public function obtenirEtapes($workflow_id)
    {
        // les étapes de traitement en fonction de l'ID du workflow
        $etapes = EtapeTraitement::where('parent_id', $workflow_id)->get();

        return response()->json($etapes); 
    }


    public function enCours()
    {
           $nombreWorkflow = Workflow::whereNotNull('num_ordre')->count();
        $workflows_any = Workflow::whereNotNull('num_ordre')->orderBy('num_ordre')->get();

        
        
        $workflows_debut = Workflow::where('type', 'DEBUT')->get();
        $workflows_fin = Workflow::where('type', 'FIN')->get();

       

        return view('factures.enCours', compact('nombreWorkflow', 'workflows_any', 'workflows_debut', 'workflows_fin'));
    }



    public function create_table(Request $request)
    {
        $today = now(); //  date actuelle
        $query = Facture::query()
            ->select('id', 'numero_facture', 'fournisseur', 'date_facture', 'date_arriver_facture', 'montant', 'devise', 'updated_at', 'commentaire')
            ->where('etat_workflow', 1)
            ->whereDate('created_at', $today);
    
      
    
        $workflow = Workflow::whereNotNull('num_ordre')->orderBy('num_ordre')->get();
        $workflows = 1;
    
       
        return DataTables::eloquent($query)
            ->addColumn('date_enregistrement', function ($facture) use ($workflows) {
               
                $etatfacture = EtatFacture::where('facture_id', $facture->id)
                    ->where('workflow_id', $workflows)
                    ->first();
    
                if ($etatfacture && $etatfacture->date_entree && $etatfacture->date_entree != '1970-01-01') {
                    return date('d/m/Y', strtotime($etatfacture->date_entree));
                } else {
                    return '';
                }
            })
            ->toJson();
    }
    



    
public function enregistrement_table(Request $request)
{
    $query = Facture::query()
        ->select('id', 'numero_facture', 'fournisseur', 'date_facture', 'date_arriver_facture', 'montant', 'devise', 'etat_workflow', 'updated_at', 'commentaire')
        ->where('etat_workflow', '1')
        ->orderBy('updated_at', 'desc')
        ->latest()->limit(1000);

      
        

$workflow = Workflow::whereNotNull('num_ordre')->orderBy('num_ordre')->get();
$workflows = 1 ;
return DataTables::eloquent($query)

->addColumn('date_enregistrement', function ($facture) use ($workflows) {
    $etatfacture = EtatFacture::where('facture_id', $facture->id)
        ->where('workflow_id', $workflows) 
        ->first();

    if ($etatfacture && $etatfacture->date_entree && $etatfacture->date_entree != '1970-01-01') {
        return date('d/m/Y', strtotime($etatfacture->date_entree));
    } else {
        return '';
    }
})

    
    ->toJson();

}






public function encours_table(Request $request)
{
    $query = Facture::query()
        ->select('id', 'numero_facture', 'fournisseur', 'date_facture', 'date_arriver_facture', 'montant', 'devise', 'etat_workflow', 'updated_at', 'commentaire')
        ->where('etat_workflow', '>', 2)
        ->orderBy('updated_at', 'desc')
        ->latest()->limit(2000);

       

      

$workflow = Workflow::whereNotNull('num_ordre')->orderBy('num_ordre')->get();
$workflows = 1 ;
return DataTables::eloquent($query)

->addColumn('date_enregistrement', function ($facture) use ($workflows) {
    $etatfacture = EtatFacture::where('facture_id', $facture->id)
        ->where('workflow_id', $workflows) // Assurez-vous d'obtenir l'ID du workflow correct
        ->first();

    if ($etatfacture && $etatfacture->date_entree && $etatfacture->date_entree != '1970-01-01') {
        return date('d/m/Y', strtotime($etatfacture->date_entree));
    } else {
        return '';
    }
})

->addColumn('date_entrer_workflow1', function ($facture) {
    $etatfacture = EtatFacture::where('facture_id', $facture->id)
        ->where('workflow_id', '3') // Assurez-vous d'obtenir l'ID du workflow correct
        ->first();

    if ($etatfacture && $etatfacture->date_entree && $etatfacture->date_entree != '1970-01-01') {
        return date('d/m/Y', strtotime($etatfacture->date_entree));
    } else {
        return '';
    }
})


->addColumn('date_sortie_workflow1', function ($facture) {
    $etatfacture = EtatFacture::where('facture_id', $facture->id)
        ->where('workflow_id', '3') // Assurez-vous d'obtenir l'ID du workflow correct
        ->first();

    if ($etatfacture && $etatfacture->date_sortie && $etatfacture->date_sortie != '1970-01-01') {
        return date('d/m/Y', strtotime($etatfacture->date_sortie));
    } else {
        return '';
    }
})



->addColumn('date_entrer_workflow2', function ($facture) {
    $etatfacture = EtatFacture::where('facture_id', $facture->id)
        ->where('workflow_id', '4') // Assurez-vous d'obtenir l'ID du workflow correct
        ->first();

    if ($etatfacture && $etatfacture->date_entree && $etatfacture->date_entree != '1970-01-01') {
        return date('d/m/Y', strtotime($etatfacture->date_entree));
    } else {
        return '';
    }
})


->addColumn('date_sortie_workflow2', function ($facture) {
    $etatfacture = EtatFacture::where('facture_id', $facture->id)
        ->where('workflow_id', '4') // Assurez-vous d'obtenir l'ID du workflow correct
        ->first();

    if ($etatfacture && $etatfacture->date_sortie && $etatfacture->date_sortie != '1970-01-01') {
        return date('d/m/Y', strtotime($etatfacture->date_sortie));
    } else {
        return '';
    }
})


->addColumn('date_entrer_workflow3', function ($facture) {
    $etatfacture = EtatFacture::where('facture_id', $facture->id)
        ->where('workflow_id', '5') // Assurez-vous d'obtenir l'ID du workflow correct
        ->first();

    if ($etatfacture && $etatfacture->date_entree && $etatfacture->date_entree != '1970-01-01') {
        return date('d/m/Y', strtotime($etatfacture->date_entree));
    } else {
        return '';
    }
})


->addColumn('date_sortie_workflow3', function ($facture) {
    $etatfacture = EtatFacture::where('facture_id', $facture->id)
        ->where('workflow_id', '5') 
        ->first();

    if ($etatfacture && $etatfacture->date_sortie && $etatfacture->date_sortie != '1970-01-01') {
        return date('d/m/Y', strtotime($etatfacture->date_sortie));
    } else {
        return '';
    }
})



->addColumn('date_entrer_workflow4', function ($facture) {
    $etatfacture = EtatFacture::where('facture_id', $facture->id)
        ->where('workflow_id', '6') 
        ->first();

    if ($etatfacture && $etatfacture->date_entree && $etatfacture->date_entree != '1970-01-01') {
        return date('d/m/Y', strtotime($etatfacture->date_entree));
    } else {
        return '';
    }
})


->addColumn('date_sortie_workflow4', function ($facture) {
    $etatfacture = EtatFacture::where('facture_id', $facture->id)
        ->where('workflow_id', '6') 
        ->first();

    if ($etatfacture && $etatfacture->date_sortie && $etatfacture->date_sortie != '1970-01-01') {
        return date('d/m/Y', strtotime($etatfacture->date_sortie));
    } else {
        return '';
    }
})

->addColumn('etat', function ($facture) {
    
    $workflow = Workflow::where('id', $facture->etat_workflow)
    ->first();

    if ($workflow) {
        $etatFacture = EtatFacture::where('workflow_id', $facture->etat_workflow)
            ->where('facture_id', $facture->id)
            ->first();

        if ($etatFacture && $etatFacture->date_sortie !== null) {
            return 'NEANT';
        } 
        
        else {
            return $workflow->libelle;
        }
    } else {
        return 'NEANT';
    }
})



    
    ->toJson();

}





public function traiter_table(Request $request)
{
    $query = Facture::query()
        ->select('id', 'numero_facture', 'fournisseur', 'date_facture', 'date_arriver_facture', 'montant', 'devise', 'etat_workflow', 'updated_at', 'commentaire')
        ->where('etat_workflow', '2')
        ->orderBy('updated_at', 'desc')
        ->latest()->limit(200);

      

$workflow = Workflow::whereNotNull('num_ordre')->orderBy('num_ordre')->get();
$workflows = 1 ;
return DataTables::eloquent($query)

->addColumn('date_enregistrement', function ($facture) use ($workflows) {
    $etatfacture = EtatFacture::where('facture_id', $facture->id)
        ->where('workflow_id', $workflows) 
        ->first();

    if ($etatfacture && $etatfacture->date_entree && $etatfacture->date_entree != '1970-01-01') {
        return date('d/m/Y', strtotime($etatfacture->date_entree));
    } else {
        return '';
    }
})

->addColumn('date_entrer_workflow1', function ($facture) {
    $etatfacture = EtatFacture::where('facture_id', $facture->id)
        ->where('workflow_id', '3') 
        ->first();

    if ($etatfacture && $etatfacture->date_entree && $etatfacture->date_entree != '1970-01-01') {
        return date('d/m/Y', strtotime($etatfacture->date_entree));
    } else {
        return '';
    }
})


->addColumn('date_sortie_workflow1', function ($facture) {
    $etatfacture = EtatFacture::where('facture_id', $facture->id)
        ->where('workflow_id', '3') // Assurez-vous d'obtenir l'ID du workflow correct
        ->first();

    if ($etatfacture && $etatfacture->date_sortie && $etatfacture->date_sortie != '1970-01-01') {
        return date('d/m/Y', strtotime($etatfacture->date_sortie));
    } else {
        return '';
    }
})



->addColumn('date_entrer_workflow2', function ($facture) {
    $etatfacture = EtatFacture::where('facture_id', $facture->id)
        ->where('workflow_id', '4') 
        ->first();

    if ($etatfacture && $etatfacture->date_entree && $etatfacture->date_entree != '1970-01-01') {
        return date('d/m/Y', strtotime($etatfacture->date_entree));
    } else {
        return '';
    }
})


->addColumn('date_sortie_workflow2', function ($facture) {
    $etatfacture = EtatFacture::where('facture_id', $facture->id)
        ->where('workflow_id', '4') 
        ->first();

    if ($etatfacture && $etatfacture->date_sortie && $etatfacture->date_sortie != '1970-01-01') {
        return date('d/m/Y', strtotime($etatfacture->date_sortie));
    } else {
        return '';
    }
})


->addColumn('date_entrer_workflow3', function ($facture) {
    $etatfacture = EtatFacture::where('facture_id', $facture->id)
        ->where('workflow_id', '5') 
        ->first();

    if ($etatfacture && $etatfacture->date_entree && $etatfacture->date_entree != '1970-01-01') {
        return date('d/m/Y', strtotime($etatfacture->date_entree));
    } else {
        return '';
    }
})


->addColumn('date_sortie_workflow3', function ($facture) {
    $etatfacture = EtatFacture::where('facture_id', $facture->id)
        ->where('workflow_id', '5') 
        ->first();

    if ($etatfacture && $etatfacture->date_sortie && $etatfacture->date_sortie != '1970-01-01') {
        return date('d/m/Y', strtotime($etatfacture->date_sortie));
    } else {
        return '';
    }
})



->addColumn('date_entrer_workflow4', function ($facture) {
    $etatfacture = EtatFacture::where('facture_id', $facture->id)
        ->where('workflow_id', '6') 
        ->first();

    if ($etatfacture && $etatfacture->date_entree && $etatfacture->date_entree != '1970-01-01') {
        return date('d/m/Y', strtotime($etatfacture->date_entree));
    } else {
        return '';
    }
})


->addColumn('date_sortie_workflow4', function ($facture) {
    $etatfacture = EtatFacture::where('facture_id', $facture->id)
        ->where('workflow_id', '6') 
        ->first();

    if ($etatfacture && $etatfacture->date_sortie && $etatfacture->date_sortie != '1970-01-01') {
        return date('d/m/Y', strtotime($etatfacture->date_sortie));
    } else {
        return '';
    }
})


->addColumn('date_fin', function ($facture) {
    $etatfacture = EtatFacture::where('facture_id', $facture->id)
        ->where('workflow_id', '2') 
        ->first();

    if ($etatfacture && $etatfacture->date_entree && $etatfacture->date_entree != '1970-01-01') {
        return date('d/m/Y', strtotime($etatfacture->date_entree));
    } else {
        return '';
    }
})
    
    ->toJson();

}






    //traitement dune facture en cour

    public function traiter_etapes(Request $request)
    {

        $request->validate([
            'id' => 'required|int',
            'selected_date' => ['required', 'date', function ($attribute, $value, $fail) {
                // Comparer la date sélectionnée avec la date d'aujourd'hui
                if (strtotime($value) > strtotime(now())) {
                    $fail("La date sélectionnée ne doit pas être supérieure à la date d'aujourd'hui.");
                }
            }],
            'who_update' => 'required|string',
            
           
        ]);


        $id = $request->input('id');
        $whoUpdate = $request->input('who_update');
        $selectedDate = $request->input('selected_date');
          
         
        // Trouver la facture par son ID
        $facture = Facture::findOrFail($id);

        // Trouver le workflow avec le numéro d'ordre le plus bas
       
        $workflowEnCours = $facture->etat_workflow ;

        $workflowEnCours_complet = Workflow::findOrFail($workflowEnCours);

       

            $etatfacture_actuels = EtatFacture::where('facture_id', $id)
            ->where('workflow_id', $workflowEnCours)
            ->orderBy('created_at', 'desc')
            ->first();
            

        if ($etatfacture_actuels->date_entree > $selectedDate) {
            return response()->json(['error' => true, 'message' => "Vérifier la date sélectionnée."]);
        }

        // Trouver l'étape de traitement la plus basse du workflow
        $etapeEnCours = EtapeTraitement::where('parent_id', $workflowEnCours)
                                        ->orderBy('num_ordre')
                                        ->first();
                                      
        
        // Vérifier si le workflow actuel a le plus grand num_ordre
            $dernierWorkflow = Workflow::whereNotNull('num_ordre')
            ->orderBy('num_ordre', 'desc')
            ->first();


            $workflowSuivant = Workflow::where('num_ordre', '>', $workflowEnCours_complet->num_ordre)
            ->orderBy('num_ordre')
            ->first();

            
            if ($workflowSuivant) {
                $workflowSuivant_id = $workflowSuivant->id;
            }
            else {
                $workflowSuivant_id = 2;
            }


        // Mettre à jour les états de la facture
        if ($workflowEnCours_complet->num_ordre == $dernierWorkflow->num_ordre) {
            
        $facture->etat_workflow = 2; // Mettre l'état à 2 si c'est le dernier workflow
        $facture->etat_traitement = 0;
        $etapeEnCours->id = null ;
        
        } else {
        
        $facture->etat_workflow = $workflowSuivant->id; // Passer à l'état suivant
        $facture->etat_traitement = $etapeEnCours->id;

        }

        // Sauvegarder l'état de la facture
        $facture->save();

     
       
          //trouver le etat facture actuel

          $etatfacture_actuel = EtatFacture::where('facture_id', $id)
          ->where('workflow_id', $workflowEnCours);
         
        
        

        // Enregistrer l'état de la facture dans la table etat_factures
        $etatFacture = new EtatFacture([
            'facture_id' => $facture->id,
            'workflow_id' => $workflowSuivant_id,
            'etapetraitement_id' => $etapeEnCours->id, 
            'date_entree' => $selectedDate,
            'who_update' => $request->input('who_update'),
        ]);

        // Sauvegarder l'état de la facture
        $etatFacture->save();

        // Retourner à la page précédente avec un message de succès
        return response()->json(['success' => true]);
    }







    //traitement dune facture en cour en sortie workflow

    public function traiter_etapes_sortie(Request $request)
    {

        $request->validate([
            'id' => 'required|int',
            'selected_date' => ['required', 'date', function ($attribute, $value, $fail) {
                // Comparer la date sélectionnée avec la date d'aujourd'hui
                if (strtotime($value) > strtotime(now())) {
                    $fail("La date sélectionnée ne doit pas être supérieure à la date d'aujourd'hui.");
                }
            }],
            'who_update' => 'required|string',
            
           
        ]);


        $id = $request->input('id');
        $whoUpdate = $request->input('who_update');
        $selectedDate = $request->input('selected_date');
          
         
        // Trouver la facture par son ID
        $facture = Facture::findOrFail($id);

        //trouver le montant_autorisation
        $montant_autorisation = Configuration::where('name', 'montant_autorisation')
            ->first();
            


if ($facture->etat_workflow == 10 ) {
   
    $facture->etat_workflow = 2; // Mettre l'état à 2 si c'est le dernier workflow
    $facture->etat_traitement = 0;
   
    $create_etat = 1;

    $facture->save();


             // Enregistrer l'état de la facture dans la table etat_factures
        $etatFacture = new EtatFacture([
            'facture_id' => $facture->id,
            'workflow_id' => $facture->etat_workflow,
            'etapetraitement_id' => null, 
            'date_entree' => $selectedDate,
            'date_sortie' => $selectedDate,
            'who_update' => $request->input('who_update'),
        ]);

        // Sauvegarder l'état de la facture
        $etatFacture->save();
   
}
else{
        // Trouver le workflow avec le numéro d'ordre le plus bas
       
        $workflowEnCours = $facture->etat_workflow ;

        $workflowEnCours_complet = Workflow::findOrFail($workflowEnCours);
        
       

            $etatfacture_actuels = EtatFacture::where('facture_id', $id)
            ->where('workflow_id', $workflowEnCours)
            ->orderBy('created_at', 'desc')
            ->first();
            

        if ($etatfacture_actuels->date_entree > $selectedDate) {
            return response()->json(['error' => true, 'message' => "Vérifier la date sélectionnée."]);
        }

        // Trouver l'étape de traitement la plus basse du workflow
        $etapeEnCours = EtapeTraitement::where('parent_id', $workflowEnCours)
                                        ->orderBy('num_ordre')
                                        ->first();
                                  
        
        // Vérifier si le workflow actuel a le plus grand num_ordre
            $dernierWorkflow = Workflow::whereNotNull('num_ordre')
            ->orderBy('num_ordre', 'desc')
            ->first();

           
            $workflowSuivant = Workflow::where('num_ordre', '>', $workflowEnCours_complet->num_ordre)
            ->orderBy('num_ordre')
            ->first();

            
            if ($workflowSuivant) {
                $workflowSuivant_id = $workflowSuivant->id;
            }
            else {
                $workflowSuivant_id = 2;
            }
             
          
            if ($facture->etat_workflow == 5 && ($facture->devise == 'XOF' )) {
                
                if ($facture->montant <= $montant_autorisation->value)
                {
                    $facture->etat_workflow = 10; // Mettre l'état à 2 si c'est le dernier workflow
                    $facture->etat_traitement = 0;
                    $etapeEnCours->id = null;
                    $create_etat = 1;
                }
                
               
            }
            
       
        // Sauvegarder la facture mise à jour
        $facture->save();
       
          //trouver le etat facture actuel

          $etatfacture_actuel = EtatFacture::where('facture_id', $id)
          ->where('workflow_id', $workflowEnCours)
          ->update(['date_sortie' => $selectedDate]);
        
         if ($facture->etat_workflow == 2)
         {

             // Enregistrer l'état de la facture dans la table etat_factures
        $etatFacture = new EtatFacture([
            'facture_id' => $facture->id,
            'workflow_id' => $workflowSuivant_id,
            'etapetraitement_id' => $etapeEnCours->id, 
            'date_entree' => $selectedDate,
            'date_sortie' => $selectedDate,
            'who_update' => $request->input('who_update'),
        ]);

        // Sauvegarder l'état de la facture
        $etatFacture->save();


         }

        }

        

        // Retourner à la page précédente avec un message de succès
        return response()->json(['success' => true]);
    }







//etape bouton banque

    
    public function traiter_etapes_banque(Request $request)
    {

        $request->validate([
            'id' => 'required|int',
            'selected_date' => ['required', 'date', function ($attribute, $value, $fail) {
                // Comparer la date sélectionnée avec la date d'aujourd'hui
                if (strtotime($value) > strtotime(now())) {
                    $fail("La date sélectionnée ne doit pas être supérieure à la date d'aujourd'hui.");
                }
            }],
            'who_update' => 'required|string',
            
           
        ]);


        $id = $request->input('id');
        $whoUpdate = $request->input('who_update');
        $selectedDate = $request->input('selected_date');
          
         
        // Trouver la facture par son ID
        $facture = Facture::findOrFail($id);

        //trouver le montant_autorisation
        $montant_autorisation = Configuration::where('name', 'montant_autorisation')
            ->first();
            


if ($facture->etat_workflow == 10 ) {
   
    $facture->etat_workflow = 2; // Mettre l'état à 2 si c'est le dernier workflow
    $facture->etat_traitement = 0;
   
    $create_etat = 1;

    $facture->save();


             // Enregistrer l'état de la facture dans la table etat_factures
        $etatFacture = new EtatFacture([
            'facture_id' => $facture->id,
            'workflow_id' => $facture->etat_workflow,
            'etapetraitement_id' => null, 
            'date_entree' => $selectedDate,
            'date_sortie' => $selectedDate,
            'who_update' => $request->input('who_update'),
        ]);

        // Sauvegarder l'état de la facture
        $etatFacture->save();
   
}
else{
        // Trouver le workflow avec le numéro d'ordre le plus bas
       
        $workflowEnCours = $facture->etat_workflow ;

        $workflowEnCours_complet = Workflow::findOrFail($workflowEnCours);
        
       

            $etatfacture_actuels = EtatFacture::where('facture_id', $id)
            ->where('workflow_id', $workflowEnCours)
            ->orderBy('created_at', 'desc')
            ->first();
            

        if ($etatfacture_actuels->date_entree > $selectedDate) {
            return response()->json(['error' => true, 'message' => "Vérifier la date sélectionnée."]);
        }

        // Trouver l'étape de traitement la plus basse du workflow
        $etapeEnCours = EtapeTraitement::where('parent_id', $workflowEnCours)
                                        ->orderBy('num_ordre')
                                        ->first();
                                  
        
        // Vérifier si le workflow actuel a le plus grand num_ordre
            $dernierWorkflow = Workflow::whereNotNull('num_ordre')
            ->orderBy('num_ordre', 'desc')
            ->first();

           
            $workflowSuivant = Workflow::where('num_ordre', '>', $workflowEnCours_complet->num_ordre)
            ->orderBy('num_ordre')
            ->first();

            
            if ($workflowSuivant) {
                $workflowSuivant_id = $workflowSuivant->id;
            }
            else {
                $workflowSuivant_id = 2;
            }
             
            


            // Mettre à jour les états de la facture
        if ($workflowEnCours_complet->num_ordre == $dernierWorkflow->num_ordre) {
            
            $facture->etat_workflow = 2; // Mettre l'état à 2 si c'est le dernier workflow
            $facture->etat_traitement = 0;
            $etapeEnCours->id = null ;
            $create_etat = 1;
            
            } 
            

       
        // Sauvegarder la facture mise à jour
        $facture->save();
       
          //trouver le etat facture actuel

          $etatfacture_actuel = EtatFacture::where('facture_id', $id)
          ->where('workflow_id', $workflowEnCours)
          ->update(['date_sortie' => $selectedDate]);
        
         if ($facture->etat_workflow == 2)
         {

             // Enregistrer l'état de la facture dans la table etat_factures
        $etatFacture = new EtatFacture([
            'facture_id' => $facture->id,
            'workflow_id' => $workflowSuivant_id,
            'etapetraitement_id' => $etapeEnCours->id, 
            'date_entree' => $selectedDate,
            'date_sortie' => $selectedDate,
            'who_update' => $request->input('who_update'),
        ]);

        // Sauvegarder l'état de la facture
        $etatFacture->save();


         }

        }

        

        // Retourner à la page précédente avec un message de succès
        return response()->json(['success' => true]);
    }









    //page facture traite

    public function traite(Request $request)
{
    $workflows_any = Workflow::whereNotNull('num_ordre')->orderBy('num_ordre')->get();
    $workflows_debut = Workflow::where('type', 'DEBUT')->get();
    $workflows_fin = Workflow::where('type', 'FIN')->get();
    $fournisseurs = Facture::pluck('fournisseur')->toArray();
        $fournisseurs = array_map('trim', $fournisseurs); // Supprime les espaces autour de chaque élément
        $fournisseurs = array_unique($fournisseurs);
        $fournisseurs = array_slice($fournisseurs, 0, 1000);

    
    return view('factures.traite', compact('workflows_any','workflows_debut','workflows_fin','fournisseurs'));

}

public function traite_table(Request $request)
{
    $query = Facture::query()
        ->select('id', 'numero_facture', 'fournisseur', 'date_facture', 'date_arriver_facture', 'montant', 'devise', 'etat_workflow', 'updated_at','commentaire')
        ->where('etat_workflow', '2')
        ->orderBy('updated_at', 'desc')
        ->latest()->limit(250);
       

      

$workflow = Workflow::whereNotNull('num_ordre')->orderBy('num_ordre')->get();
$workflows = 1 ;
return DataTables::eloquent($query)

->addColumn('date_enregistrement', function ($facture) use ($workflows) {
    $etatfacture = EtatFacture::where('facture_id', $facture->id)
        ->where('workflow_id', $workflows) 
        ->first();

    if ($etatfacture && $etatfacture->date_entree && $etatfacture->date_entree != '1970-01-01') {
        return date('d/m/Y', strtotime($etatfacture->date_entree));
    } else {
        return '';
    }
})

->addColumn('date_entrer_workflow1', function ($facture) {
  
    $etatfacture = EtatFacture::where('facture_id', $facture->id)
        ->where('workflow_id', '3') 
        ->first();

    if ($etatfacture && $etatfacture->date_entree && $etatfacture->date_entree != '1970-01-01') {
        return date('d/m/Y', strtotime($etatfacture->date_entree));
    } else {
        return '';
    }
})


->addColumn('date_sortie_workflow1', function ($facture) {
  
    $etatfacture = EtatFacture::where('facture_id', $facture->id)
        ->where('workflow_id', '3') 
        ->first();

    if ($etatfacture && $etatfacture->date_sortie && $etatfacture->date_sortie != '1970-01-01') {
        return date('d/m/Y', strtotime($etatfacture->date_sortie));
    } else {
        return '';
    }
})



->addColumn('date_entrer_workflow2', function ($facture) {
    $etatfacture = EtatFacture::where('facture_id', $facture->id)
        ->where('workflow_id', '4') 
        ->first();

    if ($etatfacture && $etatfacture->date_entree && $etatfacture->date_entree != '1970-01-01') {
        return date('d/m/Y', strtotime($etatfacture->date_entree));
    } else {
        return '';
    }
})


->addColumn('date_sortie_workflow2', function ($facture) {
    $etatfacture = EtatFacture::where('facture_id', $facture->id)
        ->where('workflow_id', '4') 
        ->first();

    if ($etatfacture && $etatfacture->date_sortie && $etatfacture->date_sortie != '1970-01-01') {
        return date('d/m/Y', strtotime($etatfacture->date_sortie));
    } else {
        return '';
    }
})


->addColumn('date_entrer_workflow3', function ($facture) {
    $etatfacture = EtatFacture::where('facture_id', $facture->id)
        ->where('workflow_id', '5') 
        ->first();

    if ($etatfacture && $etatfacture->date_entree && $etatfacture->date_entree != '1970-01-01') {
        return date('d/m/Y', strtotime($etatfacture->date_entree));
    } else {
        return '';
    }
})


->addColumn('date_sortie_workflow3', function ($facture) {
    $etatfacture = EtatFacture::where('facture_id', $facture->id)
        ->where('workflow_id', '5')
        ->first();

    if ($etatfacture && $etatfacture->date_sortie && $etatfacture->date_sortie != '1970-01-01') {
        return date('d/m/Y', strtotime($etatfacture->date_sortie));
    } else {
        return '';
    }
})



->addColumn('date_entrer_workflow4', function ($facture) {
  
    $etatfacture = EtatFacture::where('facture_id', $facture->id)
        ->where('workflow_id', '6')
        ->first();

    if ($etatfacture && $etatfacture->date_entree && $etatfacture->date_entree != '1970-01-01') {
        return date('d/m/Y', strtotime($etatfacture->date_entree));
    } else {
        return '';
    }
})


->addColumn('date_sortie_workflow4', function ($facture) {
   
    $etatfacture = EtatFacture::where('facture_id', $facture->id)
        ->where('workflow_id', '6') 
        ->first();

    if ($etatfacture && $etatfacture->date_sortie && $etatfacture->date_sortie != '1970-01-01') {
        return date('d/m/Y', strtotime($etatfacture->date_sortie));
    } else {
        return '';
    }
})


->addColumn('date_fin', function ($facture) {
    $etatfacture = EtatFacture::where('facture_id', $facture->id)
        ->where('workflow_id', '2') 
        ->first();

    if ($etatfacture && $etatfacture->date_entree && $etatfacture->date_entree != '1970-01-01') {
        return date('d/m/Y', strtotime($etatfacture->date_entree));
    } else {
        return '';
    }
})
    
    ->toJson();

}



//table traiter filter


public function traite_table_filter(Request $request)
{
    
    $start_date = $request->input('start_date');
    $end_date = $request->input('end_date');
    $fournisseur = $request->input('fournisseur');
    //dd('Statut:', 'TRAITE', 'Date de début:', $start_date, 'Date de fin:', $end_date, 'fournisseur:', $fournisseur);
    // Initialisez la requête en filtrant les courriers traités
    $facturesTraites = Facture::where('etat_workflow', '2')
    ->when($start_date, function ($query, $start_date) {
        return $query->where('date_arriver_facture', '>=', $start_date);
    })
    ->when($end_date, function ($query, $end_date) {
        return $query->where('date_arriver_facture', '<=', $end_date);
    })
    ->when($fournisseur, function ($query, $fournisseur) {
        return $query->where('fournisseur', $fournisseur);
    });
    

   

    
    $workflow = Workflow::whereNotNull('num_ordre')->orderBy('num_ordre')->get();
    
    $workflows = 1 ;

    return DataTables::eloquent($facturesTraites)
   

    
->addColumn('date_enregistrement', function ($facture) use ($workflows) {
    $etatfacture = EtatFacture::where('facture_id', $facture->id)
        ->where('workflow_id', $workflows) // Assurez-vous d'obtenir l'ID du workflow correct
        ->first();

    if ($etatfacture && $etatfacture->date_entree && $etatfacture->date_entree != '1970-01-01') {
        return date('d/m/Y', strtotime($etatfacture->date_entree));
    } else {
        return '';
    }
})

->addColumn('date_entrer_workflow1', function ($facture) {
    $etatfacture = EtatFacture::where('facture_id', $facture->id)
        ->where('workflow_id', '3')
        ->first();

    if ($etatfacture && $etatfacture->date_entree && $etatfacture->date_entree != '1970-01-01') {
        return date('d/m/Y', strtotime($etatfacture->date_entree));
    } else {
        return '';
    }
})


->addColumn('date_sortie_workflow1', function ($facture) {
    $etatfacture = EtatFacture::where('facture_id', $facture->id)
        ->where('workflow_id', '3') 
        ->first();

    if ($etatfacture && $etatfacture->date_sortie && $etatfacture->date_sortie != '1970-01-01') {
        return date('d/m/Y', strtotime($etatfacture->date_sortie));
    } else {
        return '';
    }
})



->addColumn('date_entrer_workflow2', function ($facture) {
    
    $etatfacture = EtatFacture::where('facture_id', $facture->id)
        ->where('workflow_id', '4') 
        ->first();

    if ($etatfacture && $etatfacture->date_entree && $etatfacture->date_entree != '1970-01-01') {
        return date('d/m/Y', strtotime($etatfacture->date_entree));
    } else {
        return '';
    }
})


->addColumn('date_sortie_workflow2', function ($facture) {
    $etatfacture = EtatFacture::where('facture_id', $facture->id)
        ->where('workflow_id', '4')
        ->first();

    if ($etatfacture && $etatfacture->date_sortie && $etatfacture->date_sortie != '1970-01-01') {
        return date('d/m/Y', strtotime($etatfacture->date_sortie));
    } else {
        return '';
    }
})


->addColumn('date_entrer_workflow3', function ($facture) {
   
    $etatfacture = EtatFacture::where('facture_id', $facture->id)
        ->where('workflow_id', '5') 
        ->first();

    if ($etatfacture && $etatfacture->date_entree && $etatfacture->date_entree != '1970-01-01') {
        return date('d/m/Y', strtotime($etatfacture->date_entree));
    } else {
        return '';
    }
})


->addColumn('date_sortie_workflow3', function ($facture) {
    $etatfacture = EtatFacture::where('facture_id', $facture->id)
        ->where('workflow_id', '5') 
        ->first();

    if ($etatfacture && $etatfacture->date_sortie && $etatfacture->date_sortie != '1970-01-01') {
        return date('d/m/Y', strtotime($etatfacture->date_sortie));
    } else {
        return '';
    }
})



->addColumn('date_entrer_workflow4', function ($facture) {
    $etatfacture = EtatFacture::where('facture_id', $facture->id)
        ->where('workflow_id', '6') 
        ->first();

    if ($etatfacture && $etatfacture->date_entree && $etatfacture->date_entree != '1970-01-01') {
        return date('d/m/Y', strtotime($etatfacture->date_entree));
    } else {
        return '';
    }
})


->addColumn('date_sortie_workflow4', function ($facture) {
    $etatfacture = EtatFacture::where('facture_id', $facture->id)
        ->where('workflow_id', '6') 
        ->first();

    if ($etatfacture && $etatfacture->date_sortie && $etatfacture->date_sortie != '1970-01-01') {
        return date('d/m/Y', strtotime($etatfacture->date_sortie));
    } else {
        return '';
    }
})


->addColumn('date_fin', function ($facture) {
    $etatfacture = EtatFacture::where('facture_id', $facture->id)
        ->where('workflow_id', '2') 
        ->first();

    if ($etatfacture && $etatfacture->date_entree && $etatfacture->date_entree != '1970-01-01') {
        return date('d/m/Y', strtotime($etatfacture->date_entree));
    } else {
        return '';
    }
})
    
    ->toJson();

   
}







    //passer enregitrement a en cour

    
    public function traiter(Request $request)
    {

        $request->validate([
            'id' => 'required|int',
            'selected_date' => ['required', 'date', function ($attribute, $value, $fail) {
                if (strtotime($value) > strtotime(now())) {
                    $fail("La date sélectionnée ne doit pas être supérieure à la date d'aujourd'hui.");
                }
            }],
            'who_update' => 'required|string',
            
           
        ]);

        $id = $request->input('id');
        $whoUpdate = $request->input('who_update');
        $selectedDate = $request->input('selected_date');

        
          
         
        // Trouver la facture par son ID
        $facture = Facture::findOrFail($id);

        // Trouver le workflow avec le numéro d'ordre le plus bas
       
        $workflowEnCours = $facture->etat_workflow ;

        $workflowEnCours_complet = Workflow::findOrFail($workflowEnCours);

       

            $etatfacture_actuels = EtatFacture::where('facture_id', $id)
            ->where('workflow_id', $workflowEnCours)
            ->orderBy('created_at', 'desc')
            ->first();
            

        if ($etatfacture_actuels->date_entree > $selectedDate) {
            return response()->json(['error' => true, 'message' => "Vérifier la date sélectionnée."]);
        }

        if ($facture->date_arriver_facture > $selectedDate) {
            return response()->json(['error' => true, 'message' => "La date d'arrivée de la facture est supérieur à la date sélectionnée."]);
        }
       
        

        // Trouver le workflow avec le numéro d'ordre le plus bas
       
        $workflowEnCours = Workflow::whereNotNull('num_ordre')->orderBy('num_ordre')->firstOrFail();

        // Trouver l'étape de traitement la plus basse du workflow
        $etapeEnCours = EtapeTraitement::where('parent_id', $workflowEnCours->id)
                                        ->orderBy('num_ordre')
                                        ->first();

        $old_workflow =  $facture->etat_workflow;

        // Mettre à jour les états de la facture
      
        $facture->etat_workflow = $workflowEnCours->id;
        
        $facture->etat_traitement = $etapeEnCours->id;

        // Sauvegarder la facture mise à jour
        $facture->save();
       
          //trouver le etat facture actuel

          $etatfacture_actuel = EtatFacture::where('facture_id', $id)
          ->where('workflow_id', $old_workflow)
          ->update(['date_sortie' => $selectedDate]);
        
        

        // Enregistrer l'état de la facture dans la table etat_factures
        $etatFacture = new EtatFacture([
            'facture_id' => $facture->id,
            'workflow_id' => $workflowEnCours->id,
            'etapetraitement_id' => $etapeEnCours->id, 
            'date_entree' => $selectedDate,
            'who_update' => $request->input('who_update'),
        ]);

        // Sauvegarder l'état de la facture
        $etatFacture->save();

        // Retourner à la page précédente avec un message de succès
        return response()->json(['success' => true]);
    }



        // CHRONOLOGIE FACTURES
        public function nouvelleVue(Request $request)
        {
            $factureId = $request->input('facture_id');
            // Récupérer toutes les occurrences d'EtatFacture liées à la facture spécifiée
            $etatsFacture = EtatFacture::where('facture_id', $factureId)->get();
            
            // Récupérer les workflows par type : début, en cours et fin
            $workflowsDebut = Workflow::where('type', 'debut')->get();
            $workflowsEnCours = Workflow::where('type', 'en cours')->get();
            $workflowsFin = Workflow::where('type', 'fin')->get();
        
            // Utilisez les informations comme vous le souhaitez
            $facture = Facture::findOrFail($factureId);
        
            return view('factures.chronologie', compact('facture', 'etatsFacture', 'workflowsDebut', 'workflowsEnCours', 'workflowsFin'));
        }
        

    

    public function edit($id)
    {
        $facture = Facture::findOrFail($id);
        $workflow_all = Workflow::all();
        
        return response()->json(['facture' => $facture, 'workflow_all' => $workflow_all]);
    }


    public function updates(Request $request, $id)
    {
        // Valider les données du formulaire avant de mettre à jour la facture
        $data = $request->validate([
            'fournisseur' => 'required|string',
            'date_facture' => 'required|date',
            'date_arriver_facture' => 'required|date',
            'numero_facture' => 'required|string',
            'devise' => 'required|string|in:XOF,EUR,USD',
            'montant' => 'required|numeric',
            'who_create' => 'required|string',
            'etat_workflow' => 'required|integer',
            'etat_traitement' => 'required|integer',
        ]);

        // Trouver la facture dans la base de données et la mettre à jour
        $facture = Facture::findOrFail($id);
        $facture->update($request->all());

        // Rediriger l'utilisateur vers la liste des factures avec un message de succès
        return redirect()->route('factures.index')->with('success', 'La facture a été mise à jour avec succès.');
    }




    public function update(Request $request)
{
    // Récupérez l'ID du courrier à mettre à jour à partir du formulaire
    $factureId = $request->input('id');

    // Valider les données du formulaire avant la mise à jour dans la base de données
    $data = $request->validate([
        'u_fournisseur' => 'required|string',
        'u_date_facture' => 'required|date',
        'u_date_arriver_facture' => 'required|date',
        'u_numero_facture' => 'required|string',
        'u_devise' => 'required|string|in:XOF,EUR,USD',
        'u_montant' => 'required|numeric',
        'u_etat_workflow' => 'required|integer',
        'etat_traitement' => 'required|integer',
        'who_update' => 'nullable|string',
    ]);

    $facture = Facture::find($factureId);
    $workflow_new = $request->input('u_etat_workflow');
    $workflow_old = $facture->etat_workflow;
   //dd($workflow_new);

    $workflowNew = Workflow::findOrFail($workflow_new);
    $workflowOld = Workflow::findOrFail($workflow_old);
    
    //initialisation de etape traitement
    $etape = $data['etat_traitement'];

    if ($workflowNew->type == 'EN COURS')
    {

        if($workflowOld->type == 'FIN'){


           
                // Récupérez tous les états facture liés à cette facture par ordre décroissant de workflow_id
                $etatsFactureToDelete = EtatFacture::where('facture_id', $factureId)
                ->whereHas('workflow', function ($query) use ($workflowNew) {
                    $query->where('num_ordre', '>', $workflowNew->num_ordre);
                })
                ->get();
               
                    
            
                foreach ($etatsFactureToDelete as $etatFacture) {
                    $etatFacture->delete();
                
                }
                $etatsFactureToDelete2 = EtatFacture::where('facture_id', $factureId)
                ->where('workflow_id', '=', 2)
                ->delete();

            

            $etape = 1 ;
        }
        else{

            if ($workflowNew->num_ordre > $workflowOld->num_ordre) {
                return back()->with('error', "Le nouvel état de workflow ne peut pas être supérieur à l'ancien.");
            }

            else  {
                // Récupérez tous les états facture liés à cette facture par ordre décroissant de workflow_id
                $etatsFactureToDelete = EtatFacture::where('facture_id', $factureId)
                ->whereHas('workflow', function ($query) use ($workflowNew) {
                    $query->where('num_ordre', '>', $workflowNew->num_ordre);
                })
                ->get();
            
                    
            //dd( $etatsFactureToDelete);
                foreach ($etatsFactureToDelete as $etatFacture) {
                    $etatFacture->delete();
                
                }
            }

        }

    }

    if ($workflowNew->type == 'DEBUT')
    {
        $etatsFactureToDelete = EtatFacture::where('facture_id', $factureId)
            ->where('workflow_id', '<>', 1)
            ->orderBy('created_at', 'desc')
            ->get();

                //dd( $etatsFactureToDelete);
                
                foreach ($etatsFactureToDelete as $etatFacture) {
                   
                        $etatFacture->delete();
                     
                    
                }

                $etape = null;
                  
    }    
    
        // Supprimez la date_sortie de l'état facture correspondant
        EtatFacture::where('facture_id', $factureId)
            ->where('workflow_id', $workflow_new)
            ->update(['date_sortie' => null]);
    
            //dd( $facture);
    // Mettez à jour les autres champs normalement
    $facture->update([
        'fournisseur' => $data['u_fournisseur'],
        'date_facture' => $data['u_date_facture'],
        'date_arriver_facture' => $data['u_date_arriver_facture'],
        'numero_facture' => $data['u_numero_facture'],
        'devise' => $data['u_devise'],
        'montant' => $data['u_montant'],
        'etat_workflow' => $data['u_etat_workflow'],
        'etat_traitement' => $data['etat_traitement'],
        'who_update' => $data['who_update'],
    ]);

    return back()->with('success', 'Facture mise à jour avec succès !');
}


    public function destroy($id)
    {

        $etatsFactureToDelete = EtatFacture::where('facture_id', $id)
        ->delete();
        // Trouver la facture dans la base de données et la supprimer
        $facture = Facture::findOrFail($id);
        $facture->delete();

       

           
        // Rediriger l'utilisateur vers la liste des factures avec un message de succès
        return back()->with('success', 'La facture a été supprimée avec succès !');
    }

    // Afficher la page de gestion du workflow et des étapes de traitement
    public function gestionWorkflow()
    {

        $etapetraitements_any = Etapetraitement::orderBy('num_ordre')->get();

        $etapetraitements = Etapetraitement::whereNotNull('num_ordre')
        ->orderBy('num_ordre')
        ->get();

        $workflows_any = Workflow::whereNotNull('num_ordre')->orderBy('num_ordre')->get();
        $workflows_anys = Workflow::where('type', 'EN COURS')->get();

        

        $workflows = Workflow::whereNotNull('num_ordre')
        ->orderBy('num_ordre')
        ->get();

        $montant_autorisation = Configuration::where('name', 'montant_autorisation')
        ->first();
        

        return view('metiers.gestionWorkflow', compact('workflows', 'workflows_any', 'workflows_anys', 'etapetraitements', 'etapetraitements_any','montant_autorisation'));
    }


    


    public function updateWorkflow(Request $request)
        {

            $request->validate([
                'workflow' => 'required|integer',
                'libelle' => 'required|string|max:255',
                'who_update' => 'required|string',
            ]);
        

            $id = $request->input('workflow');
            $libelle = $request->input('libelle');
            $who_update = $request->input('who_update');
            //dd($id);
            $workflow = Workflow::findOrFail($id);
            $workflow->libelle = $libelle;
            $workflow->who_update = $who_update;
            $workflow->save();

            // Rediriger vers la page de gestion des workflows avec un message de succès
            return redirect()->route('metiers.gestionWorkflow')->with('success', 'Workflow mis à jour avec succès.');
        }



        public function createWorkflow(Request $request)
        {

            $request->validate([
             
                'libelle_c' => 'required|string|max:255',
                'who_create_c' => 'required|string',
            ]);



            // Obtenir le plus grand numéro d'ordre existant dans la base de données
            $maxNumOrdre = Workflow::max('num_ordre');

            // Incrémenter le numéro d'ordre pour le nouveau workflow
            $numOrdre = $maxNumOrdre + 1;
           
            $type='EN COURS';

            
            $workflow = new Workflow([
                'who_create' =>  $request->input('who_create_c'),
                'type' => $type, // Définir directement le type ici
                'num_ordre' => $numOrdre,
                'libelle' => $request->input('libelle_c'),
            ]);
    
    
            // Sauvegarder la nouvelle facture
            $workflow->save();
    
        
            // Rediriger vers la page de gestion des workflows avec un message de succès
            return redirect()->route('metiers.gestionWorkflow')->with('success', 'Workflow créer avec succès.');
        }


        public function stateWorkflow(Request $request)
        {

            $request->validate([
                'workflow' => 'required|integer',
                'who_update' => 'required|string',
                'statut' => 'required|in:ACTIF,INACTIF',
            ]);
        

            $id = $request->input('workflow');
            $who_update = $request->input('who_update');
           $statut= $request->input('statut');
            $workflow = Workflow::findOrFail($id);

            // Si le statut est "ACTIF" et le numéro d'ordre est NULL, on met à jour le numéro d'ordre
            if ($statut === 'ACTIF' && is_null($workflow->num_ordre)) {
                $maxNumOrdre = Workflow::max('num_ordre');
                $workflow->num_ordre = $maxNumOrdre + 1;
            }

            // Si le statut est "INACTIF", on met à jour le numéro d'ordre à NULL
            if ($statut === 'INACTIF') {
                $workflow->num_ordre = null;
            }

            $workflow->who_update = $who_update;
            $workflow->save();

            // Rediriger vers la page de gestion des workflows avec un message de succès
            return redirect()->route('metiers.gestionWorkflow')->with('success', 'Workflow mis à jour avec succès.');
        }





    // Créer une nouvelle étape de traitement pour un workflow existant
    public function createEtapetraitement(Request $request)
    {

        $request->validate([
            'workflow' => 'required|integer',
            'libelle_t' => 'required|string',
            'who_create_t' => 'required|string',
        ]);

            /// Rechercher l'ID parent à partir du workflow
        $parent_id = $request->input('workflow');

        // Rechercher le maximum de num_ordre pour le parent_id donné
        $max_num_ordre = EtapeTraitement::where('parent_id', $parent_id)->max('num_ordre');

        // Incrémenter le max_num_ordre pour obtenir le nouveau num_ordre
        $num_ordre = $max_num_ordre + 1;

        $etapeTraitement = new EtapeTraitement([
            'parent_id' => $parent_id,
            'num_ordre' => $num_ordre,
            'libelle' => $request->input('libelle_t'),
            'who_create' => $request->input('who_create_t'),
        ]);

        $etapeTraitement->save();

        return redirect()->route('metiers.gestionWorkflow')->with('success', 'Étape de traitement créée avec succès.');
    }


    public function enregistrerOrdre(Request $request)
    {
        //$workflowsData = $request->input('workflow');

        $data = request()->input('workflow');
        //dd($workflowsData);
        //dd($data);
        // Trier les données en fonction de leur ordre d'arrivée
        if ($data) {
            $order = 1; // Initialisez le compteur d'ordre à 1
            foreach ($data as $item) {
                $workflow = Workflow::find($item['id']);
                $workflow->num_ordre = $order; // Mettre à jour le numéro d'ordre avec la valeur actuelle du compteur
                $workflow->save();
                $order++; // Incrémentez le compteur d'ordre pour le prochain élément
            }
        }
    
        // Rediriger vers la page de gestion du workflow avec un message de succès
        return redirect()->route('metiers.gestionWorkflow')->with('success', 'Les numéros d\'ordre ont été enregistrés avec succès.');
    }


    public function enregistrerOrdretraitement(Request $request)
    {
        //$workflowsData = $request->input('workflow');
        $id = request()->input('workflow_id');
        $data = request()->input('etapetraitement');
        
        // Trier les données en fonction de leur ordre d'arrivée
        if ($data) {
            $order = 1; // Initialisez le compteur d'ordre à 1
            foreach ($data as $item) {
                $etapetraitement = Etapetraitement::where('parent_id', $id)->find($item['id']) ;
                if ($etapetraitement) {
                    $etapetraitement->num_ordre = $order; // Mettre à jour le numéro d'ordre avec la valeur actuelle du compteur
                    $etapetraitement->save();
                    $order++; // Incrémentez le compteur d'ordre pour le prochain élément
                }
                        }
        }
    
        // Rediriger vers la page de gestion du workflow avec un message de succès
        return redirect()->route('metiers.gestionWorkflow')->with('success', 'Les numéros d\'ordre ont été enregistrés avec succès.');
    }


    public function enregistrerConfig(Request $request)
    {
       

        $data = request()->input('montant_autorisation');
        //dd($workflowsData);
        //dd($data);
        // Trier les données en fonction de leur ordre d'arrivée
        if ($data) {

            $config = Configuration::where('name', 'montant_autorisation')
            ->first();
            $config->value = $data;
            $config->save();
           
        }
    
        // Rediriger vers la page de gestion du workflow avec un message de succès
        return redirect()->route('metiers.gestionWorkflow')->with('success', 'Les configuration ont été enregistrés avec succès.');
    }


    public function updateEtapetraitement(Request $request)
    {

        $request->validate([
            'etape' => 'required|integer',
            'libelle_et' => 'required|string|max:255',
            'who_update' => 'required|string',
        ]);
    

        $id = $request->input('etape');
        $libelle = $request->input('libelle_et');
        $who_update = $request->input('who_update');
        //dd($id);
        $Etapetraitements = Etapetraitement::findOrFail($id);
        $Etapetraitements->libelle = $libelle;
        $Etapetraitements->who_update = $who_update;
        $Etapetraitements->save();

        // Rediriger vers la page de gestion des workflows avec un message de succès
        return redirect()->route('metiers.gestionWorkflow')->with('success', 'Etapes mis à jour avec succès.');
    }



    public function stateEtapetraitement(Request $request)
        {

            $request->validate([
                'etape' => 'required|integer',
                'who_update' => 'required|string',
                'statut' => 'required|in:ACTIF,INACTIF',
            ]);
        

            $id = $request->input('etape');
            $who_update = $request->input('who_update');
           $statut= $request->input('statut');
           $Etapetraitement = Etapetraitement::where('id', $id)->first();

           // dd($Etapetraitement);

            // Si le statut est "ACTIF" et le numéro d'ordre est NULL, on met à jour le numéro d'ordre
            if ($statut === 'ACTIF' && is_null($Etapetraitement->num_ordre)) {
                $maxNumOrdre = Etapetraitement::max('num_ordre');
                $Etapetraitement->num_ordre = $maxNumOrdre + 1;
            }

            // Si le statut est "INACTIF" et le numéro d'ordre n'est pas NULL, on met à jour le numéro d'ordre à NULL
            if ($statut === 'INACTIF' && !is_null($Etapetraitement->num_ordre)) {
                $Etapetraitement->num_ordre = null;
            }

            $Etapetraitement->who_update = $who_update;
            $Etapetraitement->save();

            // Rediriger vers la page de gestion des workflows avec un message de succès
            return redirect()->route('metiers.gestionWorkflow')->with('success', 'Workflow mis à jour avec succès.');
        }





        //reporting


        public function reporting(Request $request)
        {
            $workflows_any = Workflow::whereNotNull('num_ordre')->orderBy('num_ordre')->get();
            $workflows_debut = Workflow::where('type', 'DEBUT')->get();
            $workflows_fin = Workflow::where('type', 'FIN')->get();
            $fournisseurs = Facture::pluck('fournisseur')->toArray();
                $fournisseurs = array_map('trim', $fournisseurs); // Supprime les espaces autour de chaque élément
                $fournisseurs = array_unique($fournisseurs);
                $fournisseurs = array_slice($fournisseurs, 0, 1000);

            
            return view('reporting.facture', compact('workflows_any','workflows_debut','workflows_fin','fournisseurs'));

        }



        //reporting table filter


        public function reporting_table_filter(Request $request)
        {
            // Récupérez les paramètres de filtrage depuis la requête
            $start_date = $request->input('start_date');
            $end_date = $request->input('end_date');
            $fournisseur = $request->input('fournisseur');
            $etat_filter = $request->input('etat_filter');
            $statut_etat_filter = $request->input('statut_etat_filter');
            $numero_facture_filter = $request->input('numero_facture_filter');
            $devise_filter = $request->input('devise_filter');
            $montant_min_filter = $request->input('montant_min_filter');
            $montant_max_filter = $request->input('montant_max_filter');
           // dd($statut_etat_filter);
            //dd('Statut:', 'TRAITE', 'Date de début:', $start_date, 'Date de fin:', $end_date, 'fournisseur:', $fournisseur);
            // Initialisez la requête en filtrant les courriers traités
            $facturesTraites = Facture::where('etat_workflow', '>', '0')
            ->when($start_date, function ($query, $start_date) {
                return $query->where('date_arriver_facture', '>=', $start_date);
            })
            ->when($end_date, function ($query, $end_date) {
                return $query->where('date_arriver_facture', '<=', $end_date);
            })
            ->when($fournisseur, function ($query, $fournisseur) {
                return $query->where('fournisseur', 'like', $fournisseur . '%');
            })
            ->when($etat_filter, function ($query, $etat_filter) {
                if ($etat_filter === 'neant') {       

                }else{
                    return $query->where('etat_workflow', $etat_filter);
                }
                
            })
            ->when($numero_facture_filter, function ($query, $numero_facture_filter) {
                return $query->where('numero_facture', 'like', $numero_facture_filter . '%');
            })
            ->when($devise_filter, function ($query, $devise_filter) {
               
                    return $query->where('devise', $devise_filter);
             
                
            })
            ->when($montant_min_filter, function ($query, $montant_min_filter) {
                return $query->where('montant', '>=', $montant_min_filter);
            })

            ->when($montant_max_filter, function ($query, $montant_max_filter) {
                return $query->where('montant', '<=', $montant_max_filter);
            });
            
            


           
           
            
            

           

            
            $workflow = Workflow::whereNotNull('num_ordre')->orderBy('num_ordre')->get();
           
            $workflows = 1 ;
           
            return DataTables::eloquent($facturesTraites)
            


            
        ->addColumn('date_enregistrement', function ($facture) use ($workflows) {
            $etatfacture = EtatFacture::where('facture_id', $facture->id)
                ->where('workflow_id', $workflows) 
                ->first();

            if ($etatfacture && $etatfacture->date_entree && $etatfacture->date_entree != '1970-01-01') {
                return date('d/m/Y', strtotime($etatfacture->date_entree));
            } else {
                return '';
            }
        })

        ->addColumn('date_entrer_workflow1', function ($facture) {
            $etatfacture = EtatFacture::where('facture_id', $facture->id)
                ->where('workflow_id', '3') 
                ->first();

            if ($etatfacture && $etatfacture->date_entree && $etatfacture->date_entree != '1970-01-01') {
                return date('d/m/Y', strtotime($etatfacture->date_entree));
            } else {
                return '';
            }
        })


        ->addColumn('date_sortie_workflow1', function ($facture) {
            $etatfacture = EtatFacture::where('facture_id', $facture->id)
                ->where('workflow_id', '3') 
                ->first();

            if ($etatfacture && $etatfacture->date_sortie && $etatfacture->date_sortie != '1970-01-01') {
                return date('d/m/Y', strtotime($etatfacture->date_sortie));
            } else {
                return '';
            }
        })



        ->addColumn('date_entrer_workflow2', function ($facture) {
            $etatfacture = EtatFacture::where('facture_id', $facture->id)
                ->where('workflow_id', '4') 
                ->first();

            if ($etatfacture && $etatfacture->date_entree && $etatfacture->date_entree != '1970-01-01') {
                return date('d/m/Y', strtotime($etatfacture->date_entree));
            } else {
                return '';
            }
        })


        ->addColumn('date_sortie_workflow2', function ($facture) {
            $etatfacture = EtatFacture::where('facture_id', $facture->id)
                ->where('workflow_id', '4') 
                ->first();

            if ($etatfacture && $etatfacture->date_sortie && $etatfacture->date_sortie != '1970-01-01') {
                return date('d/m/Y', strtotime($etatfacture->date_sortie));
            } else {
                return '';
            }
        })


        ->addColumn('date_entrer_workflow3', function ($facture) {
            $etatfacture = EtatFacture::where('facture_id', $facture->id)
                ->where('workflow_id', '5') 
                ->first();

            if ($etatfacture && $etatfacture->date_entree && $etatfacture->date_entree != '1970-01-01') {
                return date('d/m/Y', strtotime($etatfacture->date_entree));
            } else {
                return '';
            }
        })


        ->addColumn('date_sortie_workflow3', function ($facture) {
            $etatfacture = EtatFacture::where('facture_id', $facture->id)
                ->where('workflow_id', '5') 
                ->first();

            if ($etatfacture && $etatfacture->date_sortie && $etatfacture->date_sortie != '1970-01-01') {
                return date('d/m/Y', strtotime($etatfacture->date_sortie));
            } else {
                return '';
            }
        })



        ->addColumn('date_entrer_workflow4', function ($facture) {
            $etatfacture = EtatFacture::where('facture_id', $facture->id)
                ->where('workflow_id', '6') 
                ->first();

            if ($etatfacture && $etatfacture->date_entree && $etatfacture->date_entree != '1970-01-01') {
                return date('d/m/Y', strtotime($etatfacture->date_entree));
            } else {
                return '';
            }
        })


        ->addColumn('date_sortie_workflow4', function ($facture) {
            $etatfacture = EtatFacture::where('facture_id', $facture->id)
                ->where('workflow_id', '6') 
                ->first();

            if ($etatfacture && $etatfacture->date_sortie && $etatfacture->date_sortie != '1970-01-01') {
                return date('d/m/Y', strtotime($etatfacture->date_sortie));
            } else {
                return '';
            }
        })


        ->addColumn('date_fin', function ($facture) {
            $etatfacture = EtatFacture::where('facture_id', $facture->id)
                ->where('workflow_id', '2') 
                ->first();

            if ($etatfacture && $etatfacture->date_entree && $etatfacture->date_entree != '1970-01-01') {
                return date('d/m/Y', strtotime($etatfacture->date_entree));
            } else {
                return '';
            }
        })
        
        ->toJson();
            
      

        
        }









        //reporting table


                
        public function reporting_table(Request $request)
        {
            $query = Facture::query()
                ->select('id', 'numero_facture', 'fournisseur', 'date_facture', 'date_arriver_facture', 'montant', 'devise', 'etat_workflow', 'updated_at','commentaire')
              
                ->orderBy('updated_at', 'desc')
                ->latest()->limit(250);
            

            

        $workflow = Workflow::whereNotNull('num_ordre')->orderBy('num_ordre')->get();
        $workflows = 1 ;
        return DataTables::eloquent($query)

        ->addColumn('date_enregistrement', function ($facture) use ($workflows) {
            $etatfacture = EtatFacture::where('facture_id', $facture->id)
                ->where('workflow_id', $workflows) 
                ->first();

            if ($etatfacture && $etatfacture->date_entree && $etatfacture->date_entree != '1970-01-01') {
                return date('d/m/Y', strtotime($etatfacture->date_entree));
            } else {
                return '';
            }
        })

        ->addColumn('date_entrer_workflow1', function ($facture) {
            $etatfacture = EtatFacture::where('facture_id', $facture->id)
                ->where('workflow_id', '3') 
                ->first();

            if ($etatfacture && $etatfacture->date_entree && $etatfacture->date_entree != '1970-01-01') {
                return date('d/m/Y', strtotime($etatfacture->date_entree));
            } else {
                return '';
            }
        })


        ->addColumn('date_sortie_workflow1', function ($facture) {
            $etatfacture = EtatFacture::where('facture_id', $facture->id)
                ->where('workflow_id', '3') 
                ->first();

            if ($etatfacture && $etatfacture->date_sortie && $etatfacture->date_sortie != '1970-01-01') {
                return date('d/m/Y', strtotime($etatfacture->date_sortie));
            } else {
                return '';
            }
        })



        ->addColumn('date_entrer_workflow2', function ($facture) {
            $etatfacture = EtatFacture::where('facture_id', $facture->id)
                ->where('workflow_id', '4') 
                ->first();

            if ($etatfacture && $etatfacture->date_entree && $etatfacture->date_entree != '1970-01-01') {
                return date('d/m/Y', strtotime($etatfacture->date_entree));
            } else {
                return '';
            }
        })


        ->addColumn('date_sortie_workflow2', function ($facture) {
            $etatfacture = EtatFacture::where('facture_id', $facture->id)
                ->where('workflow_id', '4')
                ->first();

            if ($etatfacture && $etatfacture->date_sortie && $etatfacture->date_sortie != '1970-01-01') {
                return date('d/m/Y', strtotime($etatfacture->date_sortie));
            } else {
                return '';
            }
        })


        ->addColumn('date_entrer_workflow3', function ($facture) {
            $etatfacture = EtatFacture::where('facture_id', $facture->id)
                ->where('workflow_id', '5')
                ->first();

            if ($etatfacture && $etatfacture->date_entree && $etatfacture->date_entree != '1970-01-01') {
                return date('d/m/Y', strtotime($etatfacture->date_entree));
            } else {
                return '';
            }
        })


        ->addColumn('date_sortie_workflow3', function ($facture) {
            $etatfacture = EtatFacture::where('facture_id', $facture->id)
                ->where('workflow_id', '5') 
                ->first();

            if ($etatfacture && $etatfacture->date_sortie && $etatfacture->date_sortie != '1970-01-01') {
                return date('d/m/Y', strtotime($etatfacture->date_sortie));
            } else {
                return '';
            }
        })



        ->addColumn('date_entrer_workflow4', function ($facture) {
            $etatfacture = EtatFacture::where('facture_id', $facture->id)
                ->where('workflow_id', '6') 
                ->first();

            if ($etatfacture && $etatfacture->date_entree && $etatfacture->date_entree != '1970-01-01') {
                return date('d/m/Y', strtotime($etatfacture->date_entree));
            } else {
                return '';
            }
        })


        ->addColumn('date_sortie_workflow4', function ($facture) {
            $etatfacture = EtatFacture::where('facture_id', $facture->id)
                ->where('workflow_id', '6') 
                ->first();

            if ($etatfacture && $etatfacture->date_sortie && $etatfacture->date_sortie != '1970-01-01') {
                return date('d/m/Y', strtotime($etatfacture->date_sortie));
            } else {
                return '';
            }
        })


        ->addColumn('date_fin', function ($facture) {
            $etatfacture = EtatFacture::where('facture_id', $facture->id)
                ->where('workflow_id', '2') 
                ->first();

            if ($etatfacture && $etatfacture->date_entree && $etatfacture->date_entree != '1970-01-01') {
                return date('d/m/Y', strtotime($etatfacture->date_entree));
            } else {
                return '';
            }
        })
            
            ->toJson();

        }





}
