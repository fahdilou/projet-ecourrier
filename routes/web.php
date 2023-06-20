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

//Roles
Route::resource('roles', RoleController::class);
Route::get('monrole/delete/{id}', [RoleController::class, 'destroy']);
//Utilisateur
Route::resource('users', UserController::class);
Route::get('users/delete/{id}', [UserController::class, 'destroy']);
Route::post('users/update2', [UserController::class, 'update'])->name('users.update2');
Route::get('users/edit/{id}', [UserController::class, 'edit']);
//MOn profil
Route::get('monprofil', [UserController::class, 'myprofil'])->name('myprofil.index');
Route::post('/monprofil/update', [UserController::class, 'myprofil_update'])->name('myprofil.update');
Route::post('/monprofil/changepassword', [UserController::class, 'myprofil_changepassword'])->name('myprofil.changepassword');













});