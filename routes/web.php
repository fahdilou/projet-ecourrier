<?php

use App\Http\Controllers\ConfirmationController;
use App\Http\Controllers\ConsultationController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CustomAuthentification;
use App\Http\Controllers\DemandeController;
use App\Http\Controllers\CourrierController;
use App\Http\Controllers\FactureController;
use App\Http\Controllers\ImportController;
use App\Models\Consultation;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::fallback(function () {
    return view('404');
});


Route::get('/', function () {
    return view('auth.login');
});

Route::get('/login', function () {
    return view('auth.login');
})->name('login');


Route::get('/blank', function () {
    return view('blank');
})->name('blank');

//Authentification
Route::post('/login', [CustomAuthentification::class, 'authentification'])->name('login.authentification');
Route::post('/logout', [CustomAuthentification::class, 'logout'])->name('logout');



Route::middleware(['auth'])->group(function () {
//Acceuil
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/import', [App\Http\Controllers\ImportController::class, 'index'])->name('import');
Route::post('/import', [App\Http\Controllers\ImportController::class, 'importfacture']);

Route::get('/import_courrier', [App\Http\Controllers\ImportController::class, 'index_courrier'])->name('import_courrier');
Route::post('/import_courrier', [App\Http\Controllers\ImportController::class, 'importcourrier']);


//Roles
Route::resource('roles', RoleController::class);
Route::get('monrole/delete/{id}', [RoleController::class, 'destroy']);
Route::get('roles/edit/{id}', [UserController::class, 'edit']);
//Utilisateur
Route::resource('users', UserController::class);
Route::get('users/delete/{id}', [UserController::class, 'destroy']);
Route::post('users/update2', [UserController::class, 'update'])->name('users.update2');
Route::get('users/edit/{id}', [UserController::class, 'edit']);


//MOn profil
Route::get('monprofil', [UserController::class, 'myprofil'])->name('myprofil.index');
Route::post('/monprofil/update', [UserController::class, 'myprofil_update'])->name('myprofil.update');
Route::post('/monprofil/changepassword', [UserController::class, 'myprofil_changepassword'])->name('myprofil.changepassword');

Route::get('monprofil/test', [UserController::class, 'test'])->name('users.test');





// courrier

Route::get('/courriers', [CourrierController::class, 'index'])->name('courriers.index');

Route::get('/courriers/create', [CourrierController::class, 'create'])->name('courriers.create');
Route::get('/courriers/create-table', [CourrierController::class, 'create_table'])->name('courriers.create-table');

Route::post('/courriers', [CourrierController::class, 'store'])->name('courriers.store');
Route::get('/courriers/en-cours', [CourrierController::class, 'enCours'])->name('courriers.enCours');
Route::get('/courriers/enregistrement-table', [CourrierController::class, 'enregistrement_table'])->name('courriers.enregistrement-table');
Route::get('/courriers/en-cours-table', [CourrierController::class, 'encours_table'])->name('courriers.encours-table');
Route::get('/courriers/traiter-table', [CourrierController::class, 'traiter_table'])->name('courriers.traiter-table');

Route::get('/courriers/traite', [CourrierController::class, 'traite'])->name('courriers.traite');
Route::post('/courriers/traite', [CourrierController::class, 'filtrertraite'])->name('courriers.filtrerTraite');
Route::get('/courriers/traite-table', [CourrierController::class, 'traite_table'])->name('courriers.traite-table');
Route::get('/courriers/traite-table-filter', [CourrierController::class, 'traite_table_filter'])->name('courriers.traite-table-filter');

// Route pour récupérer les données du courrier à éditer
Route::get('/courrier/edit/{id}', [CourrierController::class, 'edit'])->name('courrier.edit');
// Route pour mettre à jour les données du courrier
Route::put('/courrier/update', [CourrierController::class, 'update'])->name('courrier.update');

Route::get('courriers/delete/{id}', [CourrierController::class, 'destroy']);





// Facture

Route::get('/factures', [FactureController::class, 'index'])->name('factures.index');

Route::get('/factures/create', [FactureController::class, 'create'])->name('factures.create');
Route::get('/factures/create-table', [FactureController::class, 'create_table'])->name('factures.create-table');

Route::post('/factures', [FactureController::class, 'store'])->name('factures.store');

Route::get('/factures/en-cours', [FactureController::class, 'enCours'])->name('factures.enCours');
Route::get('/factures/enregistrement-table', [FactureController::class, 'enregistrement_table'])->name('factures.enregistrement-table');
Route::get('/factures/en-cours-table', [FactureController::class, 'encours_table'])->name('factures.encours-table');
Route::get('/factures/traiter-table', [FactureController::class, 'traiter_table'])->name('factures.traiter-table');

Route::post('/factures/traiter', [FactureController::class, 'traiter'])->name('factures.traiter');
Route::get('/obtenir-etapes/{workflow_id}', [FactureController::class, 'obtenirEtapes'])->name('obtenir.etapes');
Route::post('/factures/traiter-etapes', [FactureController::class, 'traiter_etapes'])->name('factures.traiter_etapes');
Route::post('/factures/traiter-etapes-sortie', [FactureController::class, 'traiter_etapes_sortie'])->name('factures.traiter_etapes_sortie');
Route::post('/factures/traiter-etapes-banque', [FactureController::class, 'traiter_etapes_banque'])->name('factures.traiter_etapes_banque');
Route::get('/facture/chronologie', [FactureController::class, 'nouvelleVue'])->name('factures.chronologie');
Route::get('/facture/edit/{id}', [FactureController::class, 'edit'])->name('facture.edit');
Route::put('/facture/update', [FactureController::class, 'update'])->name('facture.update');
Route::get('factures/delete/{id}', [FactureController::class, 'destroy']);

Route::get('/factures/traite', [FactureController::class, 'traite'])->name('factures.traite');
Route::post('/factures/traite', [FactureController::class, 'filtrertraite'])->name('facture.filtrerTraite');
Route::get('/factures/traite-table', [FactureController::class, 'traite_table'])->name('factures.traite-table');
Route::get('/factures/traite-table-filter', [FactureController::class, 'traite_table_filter'])->name('factures.traite-table-filter');



// Menu metier

Route::get('/metiers/gestionWorkflow', [FactureController::class, 'gestionWorkflow'])->name('metiers.gestionWorkflow');
Route::post('/metiers/createWorkflow', [FactureController::class, 'createWorkflow'])->name('metiers.createWorkflow');
Route::put('/metiers/updateWorkflow', [FactureController::class, 'updateWorkflow'])->name('metiers.updateWorkflow');
Route::put('/metiers/stateWorkflow', [FactureController::class, 'stateWorkflow'])->name('metiers.stateWorkflow');
Route::post('/metiers/enregistrer-ordre', [FactureController::class, 'enregistrerOrdre'])->name('metiers.enregistrer-ordre');
Route::post('/metiers/enregistrer-config', [FactureController::class, 'enregistrerConfig'])->name('metiers.enregistrer-config');


Route::post('/metiers/createEtapetraitement', [FactureController::class, 'createEtapetraitement'])->name('metiers.createEtapetraitement');
Route::post('/metiers/enregistrer-ordre-traitement', [FactureController::class, 'enregistrerOrdretraitement'])->name('metiers.enregistrer-ordre-traitement');
Route::put('/metiers/updateEtapetraitement', [FactureController::class, 'updateEtapetraitement'])->name('metiers.updateEtapetraitement');
Route::put('/metiers/stateEtapetraitement', [FactureController::class, 'stateEtapetraitement'])->name('metiers.stateEtapetraitement');




// Reporting
Route::get('/reporting/facture', [FactureController::class, 'reporting'])->name('reporting.facture');
Route::post('/reporting/facture', [FactureController::class, 'reporting_filtrer'])->name('reporting.facture-filtrer');
Route::get('/reporting/facture-table', [FactureController::class, 'reporting_table'])->name('reporting.facture-table');
Route::get('/reporting/facture-table-filter', [FactureController::class, 'reporting_table_filter'])->name('reporting.facture-table-filter');


Route::get('/reporting/courrier', [CourrierController::class, 'reporting'])->name('reporting.courrier');
Route::post('/reporting/courrier', [CourrierController::class, 'reporting_filtrer'])->name('reporting.courrier-filtrer');
Route::get('/reporting/courrier-table', [CourrierController::class, 'reporting_table'])->name('reporting.courrier-table');
Route::get('/reporting/courrier-table-filter', [CourrierController::class, 'reporting_table_filter'])->name('reporting.courrier-table-filter');




});