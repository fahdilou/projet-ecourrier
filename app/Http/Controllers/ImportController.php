<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\FacturesImport;
use App\Imports\CourriersImport;
use App\Models\Facture;
use App\Models\Courrier;

class ImportController extends Controller
{
    public function index()
    {
        return view('import');
    }

    public function importfacture(Request $request)
    {
        $request->validate([
            'excel_file' => 'required|mimes:xls,xlsx',
        ]);

        $file = $request->file('excel_file');

        try {
            // Lecture du fichier Excel
            $import = new FacturesImport;
            Excel::import($import, $file);

            return redirect()->back()->with('success', 'Les données ont été importées avec succès.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Une erreur s\'est produite lors de l\'importation du fichier Excel : ' . $e->getMessage());
        }
    }


    public function index_courrier()
    {
        return view('import_courrier');
    }

    public function importcourrier(Request $request)
    {
        $request->validate([
            'excel_file' => 'required|mimes:xls,xlsx',
        ]);

        $file = $request->file('excel_file');

       
            // Lecture du fichier Excel
            $import = new CourriersImport;
            Excel::import($import, $file);

            return redirect()->back()->with('success', 'Les données ont été importées avec succès.');
       
    }
}
