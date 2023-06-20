<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //pour lister les utilisateurs
        $users = User::all();
        $roles = Role::all();
        return view('users.index',compact('users','roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function myprofil()
    {
        //modifier mon profil utilisateur
        return view('users.myprofil');
    }

    public function myprofil_update(Request $request){

            //pour mettre a jour mon profil
        $data=$this->validate($request, [
            'user_id' => 'required',
            'poste' => 'required',          
        ]);

        try {
            DB::transaction(function () use ($data) {
                $user = User::find($data['user_id']);
                $user->poste = $data['poste'];
                $user->save();
            });
         
             return back()->with('success', "Votre profil utilisateur a été mis à jour avec succès ! ");
            } catch(\Throwable $ex){
          return back()->with('error', "Échec de l'enregistrement ! " .$ex->getMessage());
        }
    }



    public function myprofil_changepassword(Request $request){

        $data=$this->validate($request, [
            'user_id2' => 'required',
            'password' => 'required|confirmed|min:6',       
        ]);

        try {
            DB::transaction(function () use ($data) {
                
                $user = User::find($data['user_id2']);
                $user->password = Hash::make($data['password']);
                $user->save();

            });
         
             return back()->with('success', "Votre mot de passe a été mis à jour avec succès ! ");
            } catch(\Throwable $ex){
          return back()->with('error', "Échec de l'enregistrement ! " .$ex->getMessage());
      }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //ajouter un utilisateur
    
        $data=$this->validate($request, [
            'email' => 'required|email |unique:users',
            'name' => 'required |unique:users',
            'password' => 'required|min:6 |confirmed',
            'poste' => 'required',
            'type_connexion' => 'required',
            'droit' => 'required',  
            'est_actif' => 'required',  
        ]);

    

        //enregistrement du users
        try {
            DB::transaction(function () use ($data) {

                $data['password']=Hash::make($data['password']);
                $user = User::create($data);
                $user->assignRole($data['droit']);
            });
         
             return back()->with('success', "Utilisateur crée avec succès ! ");
            } catch(\Throwable $ex){
          return back()->with('error', "Échec de l'enregistrement ! " .$ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //renvoyer un json de user
        $data = User::find($id);
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //modifier le user 

        $data=$this->validate($request, [
            'id'=>'required',
            'email' => 'required|email',
            'name' => 'required',
            'password' => 'sometimes|nullable|min:6 |confirmed',
            'poste' => 'required',
            'est_actif' => 'required',
            'droit' => 'required',
            'type_connexion' => 'required',
        ]);

       

        //si le mdp existe il faut le crypter sinon le supprimer
        if (($data['password'])<>null) {
            $data['password']=Hash::make($data['password']);
        } else {
            unset($data['password']);
        }


        //mise à jour du users
        try {
            DB::transaction(function () use ($data) {
                $user= User::find($data['id']);
                $user->update($data);
                $user->syncRoles($data['droit']);
            });
            
                return back()->with('success', "Utilisateur mis à jour avec succès ! ");
            } catch(\Throwable $ex){
            return back()->with('error', "Échec de l'enregistrement ! " .$ex->getMessage());
        }
  

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //supprimer le user
        $utilisateur = User::findOrFail($id);
        $utilisateur->delete();
        return back()->with('success','Utilisateur supprimé !');
    }
}
