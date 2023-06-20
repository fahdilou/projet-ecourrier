<?php

namespace App\Http\Controllers;

use App\Models\Aller;
use App\Models\TrBlSynchro;
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

    
        


        return view('home');
    }




    //afficher les indicateurs 
    public function getstatus(){

        $nb_blattente = TrBlSynchro::all()->count();

        $totalaffected = Aller::where('statut',0)->get()->count();

        $nb_encours = Aller::where('statut','1')->get()->count();

        $nb_closed = Aller::where('statut','2')                    
                    ->whereMonth('created_at', '=', now()->month)
                    ->whereYear('created_at', '=', now()->year)
                    ->count();

     

        $data = array(
            "nb_blattente" =>$nb_blattente,
            "nb_encours" =>$nb_encours,
            "nb_closed" => $nb_closed,
            "totalaffected" =>$totalaffected
        );


        return response()->json($data);
    }
}
