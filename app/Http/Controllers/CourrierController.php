<?php


namespace App\Http\Controllers;
use Illuminate\Support\Facades\Date;


use Illuminate\Http\Request;
use App\Models\Courrier;
use App\Models\Facture;
use DataTables;
class CourrierController extends Controller
{
    public function index()
    {
        $courriers = Courrier::all();
        return view('courriers.index', compact('courriers'));
    }

    public function create()
    {
        $courriersjours = Courrier::where('statut', 'ENREGISTREMENT')
        ->whereDate('created_at', Date::today()) 
        ->orderBy('updated_at', 'desc')
        ->get();
        $affectations = Courrier::pluck('affectation')->unique()->toArray();
        $fournisseurs = Facture::pluck('fournisseur')->unique()->toArray();
    
        return view('courriers.create', compact('courriersjours','affectations','fournisseurs'));
        
    }

    public function store(Request $request)
    {
        // Valider les données 
        $data = $request->validate([
            'date_arriver' => 'required|date|before_or_equal:today',
            'expediteur' => 'required|string',
            'motif' => 'required|string',
            'affectation' => ($request->input('statut') === 'EN COURS DE TRAITEMENT' || $request->input('statut') === 'TRAITE') ? 'required|string' : 'nullable|string',
            'date_debut_traitement' => 'nullable|date',
            'date_fin_traitement' => 'nullable|date',
            'observation' => 'nullable|string',
            'statut' => 'ENREGISTREMENT',
            'who_create' => 'required|string',
            'who_update' => 'nullable|string',
        ],
        [
            'date_arriver.before_or_equal' => 'La date d\'arrivée doit être inférieure ou égale à la date du jour.',
        ]);

       
        

        Courrier::create($data);

        return redirect()->route('courriers.create')->with('success', 'Le courrier a été enregistré avec succès.');
    }



    
      
public function create_table(Request $request)
{
    $query = Courrier::query()
        ->where('statut', 'ENREGISTREMENT')
        ->whereDate('created_at', Date::today()) 
        ->orderBy('updated_at', 'desc')
        ->latest()->limit(100);

      
        /

return DataTables::eloquent($query)

    ->toJson();

}



   
public function enregistrement_table(Request $request)
{
    $query = Courrier::query()
        ->where('statut', 'ENREGISTREMENT')
        ->orderBy('updated_at', 'desc')
        ->latest()->limit(1000);

      
        

return DataTables::eloquent($query)

    ->toJson();

}



public function enCours_table(Request $request)
{
    $query = Courrier::query()
        ->where('statut', 'EN COURS DE TRAITEMENT')
        ->orderBy('updated_at', 'desc')
        ->latest()->limit(1000);


      
       
return DataTables::eloquent($query)

    ->toJson();

}



public function traiter_table(Request $request)
{
    $query = Courrier::query()
        ->where('statut', 'TRAITE')
        ->orderBy('updated_at', 'desc')
        ->latest()->limit(200);

      
        

return DataTables::eloquent($query)

    ->toJson();

}




public function traite_table(Request $request)
{
    $query = Courrier::query()
        ->where('statut', 'TRAITE')
        ->orderBy('updated_at', 'desc')
        ->latest()->limit(1000);

      
        

return DataTables::eloquent($query)

    ->toJson();

}




    public function edit($id)
    {
        $courrier = Courrier::findOrFail($id);
        return response()->json($courrier);
    }

    public function updates(Request $request, Courrier $courrier)
    {
        // Valider les données 
        $data = $request->validate([
            'date_arriver' => 'required|date',
            'expediteur' => 'required|string',
            'motif' => 'required|string',
            'affectation' => ($request->input('statut') === 'EN COURS DE TRAITEMENT') ? 'required|string' : 'nullable|string',
            'date_debut_traitement' => ($request->input('statut') === 'EN COURS DE TRAITEMENT' || $request->input('statut') === 'TRAITE') ? 'required|date' : 'nullable|date',
            'date_fin_traitement' => ($request->input('statut') === 'TRAITE' && !empty($request->input('date_debut_traitement'))) ? 'required|date' : 'nullable|date',
            'observation' => 'nullable|string',
            'statut' => 'required|string|in:ENREGISTREMENT,EN COURS DE TRAITEMENT,TRAITE',
           
            'who_update' => 'nullable|string',
        ]);

        $statut = $request->input('statut');
        $ancienStatut = $courrier->statut; 
        

        if ($statut === 'TRAITE' && $ancienStatut === 'ENREGISTREMENT') {
            return back()->with('error', "Vérifier le statut ! ");  
        } elseif ($statut === 'ENREGISTREMENT' && $ancienStatut === 'EN COURS DE TRAITEMENT') {
            return back()->with('error', "Vérifier le statut ! ");
        } elseif ($statut === 'ENREGISTREMENT' && $ancienStatut === 'TRAITE' || $statut === 'EN COURS DE TRAITEMENT' && $ancienStatut === 'TRAITE') {
            return back()->with('error', "Vérifier le statut ! ");
        } 

       

        $courrier->update($data);

       
        return back()->with('success', "Courrier mis à jour avec succès ! ");    
    }

    public function update(Request $request)
{
    // Récupérez l'ID du courrier 
    $courrierId = $request->input('id');

    // Valider les données 
    $data = $request->validate([
        'date_arriver' => 'required|date',
        'expediteur' => 'required|string',
        'motif' => 'required|string',
        'affectation' => ($request->input('statut') === 'EN COURS DE TRAITEMENT' || $request->input('statut') === 'TRAITE') ? 'required|string' : 'nullable|string',
        'date_debut_traitement' => ($request->input('statut') === 'EN COURS DE TRAITEMENT' || $request->input('statut') === 'TRAITE') ? 'required|date' : 'nullable|date',
        'date_fin_traitement' => ($request->input('statut') === 'TRAITE' && !empty($request->input('date_debut_traitement'))) ? 'required|date' : 'nullable|date',
        'observation' => 'nullable|string',
        'statut' => 'required|string|in:ENREGISTREMENT,EN COURS DE TRAITEMENT,TRAITE',
        'who_update' => 'nullable|string',
    ]);

    $courrier = Courrier::find($courrierId);
    $statut = $request->input('statut');
    $ancienStatut = $courrier->statut; 
    

    if ($statut === 'TRAITE' && $ancienStatut === 'ENREGISTREMENT') {
        return back()->with('error', "Vérifier le statut ! ");  
    } elseif ($statut === 'ENREGISTREMENT' && $ancienStatut === 'EN COURS DE TRAITEMENT') {
        return back()->with('error', "Vérifier le statut ! ");
    } elseif ($statut === 'ENREGISTREMENT' && $ancienStatut === 'TRAITE' || $statut === 'EN COURS DE TRAITEMENT' && $ancienStatut === 'TRAITE') {
        return back()->with('error', "Vérifier le statut ! ");
    } 


    // Mettre à jour
  
    if (!$courrier) {
        // Gérer le cas où le courrier n'est pas trouvé
        return back()->with('error', 'Courrier non trouvé.');
    }

    $courrier->update($data);

    return back()->with('success', 'Courrier mis à jour avec succès !');
}


    public function destroys(Courrier $courrier)
    {
        $courrier->delete();

        return redirect()->route('courriers.index')->with('success', 'Le courrier a été supprimé avec succès.');
    }

    public function enCours()
    {
        $courriersEnCours = Courrier::where('statut', 'EN COURS DE TRAITEMENT')->orderby('updated_at', 'desc')->get();
        $courriersEnregistrement = Courrier::where('statut', 'ENREGISTREMENT')->orderby('updated_at', 'desc')->get();
       $courriersTraites = Courrier::where('statut', 'TRAITE')->orderby('updated_at', 'desc')->latest()->limit(200)->get();

        return view('courriers.enCours', compact('courriersEnCours', 'courriersEnregistrement', 'courriersTraites'));
    }


    public function traite(Request $request)
{
    $start_date = $request->input('start_date');
    $end_date = $request->input('end_date');
    $affectation_filter = $request->input('affectation_filter');

    // Vérifier si le formulaire de filtrage a été soumis
    if ($request->filled('start_date') || $request->filled('end_date') || $request->filled('affectation_filter')) {
       
        $courriersTraites = Courrier::where('statut', 'TRAITE')
            ->when($start_date, function ($query, $start_date) {
                return $query->where('date_arriver', '>=', $start_date);
            })
            ->when($end_date, function ($query, $end_date) {
                return $query->where('date_arriver', '<=', $end_date);
            })
            ->when($affectation_filter, function ($query, $affectation_filter) {
                return $query->where('affectation', $affectation_filter);
            })
            ->get();
    } else {
        
        $courriersTraites = Courrier::where('statut', 'TRAITE')->orderby('updated_at', 'desc')->latest()->limit(200)->get();
    }

    // Récupérer toutes les affectations pour la liste déroulante de filtrage par affectation
    $affectations = Courrier::whereNotNull('affectation')->pluck('affectation')->unique();

    return view('courriers.traite', compact('courriersTraites', 'affectations', 'start_date', 'end_date', 'affectation_filter'  ));
}

public function traite_table_filter(Request $request)
{
    
    $start_date = $request->input('start_date');
    $end_date = $request->input('end_date');
    $affectation_filter = $request->input('affectation_filter');
   

    $courriersTraites = Courrier::where('statut', 'TRAITE')
        ->when($start_date, function ($query, $start_date) {
            return $query->where('date_arriver', '>=', $start_date);
        })
        ->when($end_date, function ($query, $end_date) {
            return $query->where('date_arriver', '<=', $end_date);
        })
        ->when($affectation_filter, function ($query, $affectation_filter) {
            return $query->where('affectation', $affectation_filter);
        });

        


    $results = $courriersTraites->get();
   
    return response()->json($results);
}




    public function filtrerTraite(Request $request)
    {
        return redirect()->route('courriers.traite', $request->except('_token'));
    }
    
    public function destroy($id)
    {
        

        Courrier::find($id)->delete();

        return back()->with('success','Courrier supprimé avec succès');
    }




    public function reporting(Request $request)
    {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $affectation_filter = $request->input('affectation_filter');
    
        // Vérifier si le formulaire de filtrage a été soumis
        if ($request->filled('start_date') || $request->filled('end_date') || $request->filled('affectation_filter')) {
            
            $courriersTraites = Courrier::where('statut', 'TRAITE')
                ->when($start_date, function ($query, $start_date) {
                    return $query->where('date_arriver', '>=', $start_date);
                })
                ->when($end_date, function ($query, $end_date) {
                    return $query->where('date_arriver', '<=', $end_date);
                })
                ->when($affectation_filter, function ($query, $affectation_filter) {
                    return $query->where('affectation', $affectation_filter);
                })
                ->get();
        } else {
         
            $courriersTraites = Courrier::where('statut', 'TRAITE')->orderby('updated_at', 'desc')->latest()->limit(200)->get();
        }
    
        
        $affectations = Courrier::whereNotNull('affectation')->pluck('affectation')->unique();
    
        return view('reporting.courrier', compact('courriersTraites', 'affectations', 'start_date', 'end_date', 'affectation_filter'  ));
    }
    



    public function reporting_table(Request $request)
    {
        $query = Courrier::query()
           
            ->orderBy('updated_at', 'desc')
            ->latest()->limit(250);

        

    return DataTables::eloquent($query)

        ->toJson();

    }






    public function reporting_table_filter(Request $request)
    {
        
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $affectation_filter = $request->input('affectation_filter');
        $expediteur_filter = $request->input('expediteur_filter');
        $motif_filter = $request->input('motif_filter');
        $statut_filter = $request->input('statut_filter');
        
    
        $courriersTraites = Courrier::when($start_date, function ($query, $start_date) {
            return $query->where('date_arriver', '>=', $start_date);
        })
        ->when($end_date, function ($query, $end_date) {
            return $query->where('date_arriver', '<=', $end_date);
        })
        ->when($affectation_filter, function ($query, $affectation_filter) {
            return $query->where('affectation', $affectation_filter);
        })
        ->when($expediteur_filter, function ($query, $expediteur_filter) {
            return $query->where('expediteur', 'like', $expediteur_filter . '%');
        })
        ->when($motif_filter, function ($query, $motif_filter) {
            return $query->where('motif', 'like', $motif_filter . '%');
        })
        ->when($statut_filter, function ($query, $statut_filter) {
            return $query->where('statut', $statut_filter);
        });
        

            

       
        $results = $courriersTraites->get();
       
        return response()->json($results);
    }



    

    
}
