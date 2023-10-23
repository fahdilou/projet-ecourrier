<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     //lister les roles utilisateurs
    public function index()
    {
        
        $roles = Role::all();
        return view('roles.index',compact('roles'));
    }


   
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


     //formulaire de création un rôle
    public function create()
    {
        
        $permissions = Permission::all()->chunk(4);

        return view('roles.create',compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     //enregistrer un rôle
    public function store(Request $request)
    {
        
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permissions' => 'required',
        ]);

        $role = Role::create(['name' => $request->input('name')]);
        $role->syncPermissions($request->permissions);

        return redirect()->route('roles.index')
                        ->with('success','Rôle enregistré avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     //afficher un role
    public function show($id)
    {
        //
        $role = Role::find($id);
        $rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
            ->where("role_has_permissions.role_id",$id)
            ->get()->chunk(4);


          

        return view('roles.show',compact('role', 'rolePermissions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     //modifier le rôle
    public function edit($id)
    {
        

        $role = Role::find($id);
        $permissions = Permission::all()->chunk(4);
        $rolePermissions = DB::table("role_has_permissions")
                            ->where("role_has_permissions.role_id",$id)
                            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
                            ->all();

        

        return view('roles.edit',compact('role','permissions', 'rolePermissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     //mettre à jour le rôle
    public function update(Request $request, $id)
    {
        //mettre à jour le rôle

        $this->validate($request, [
            'name' => 'required',
            'permissions' => 'required',
        ]);

        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();

        $role->syncPermissions($request->input('permissions'));

        return redirect()->route('roles.index')
                        ->with('success','Rôle mis à jour avec succès');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     //supprimer le rôle
    public function destroy($id)
    {
        

        Role::find($id)->delete();

        return redirect()->route('roles.index')
                        ->with('success','Rôle supprimé avec succès');
    }
}
