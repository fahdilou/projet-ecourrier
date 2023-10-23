<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        //ONGLET
        Permission::create(['name' => 'onglet_parametres']);

        

        // USERS
        Permission::create(['name' => 'users_control']);

        //ROLES ET PERMISSIONS
        Permission::create(['name' => 'roles_control']);


        Permission::create(['name' => 'onglet_metier']);

        Permission::create(['name' => 'onglet_reporting']);
   
        Permission::create(['name' => 'onglet_courrier']);
        Permission::create(['name' => 'onglet_courrier_create']);
        Permission::create(['name' => 'onglet_courrier_suivi']);
        Permission::create(['name' => 'onglet_courrier_traite']);
        Permission::create(['name' => 'courrier_traitement']);
        Permission::create(['name' => 'courrier_edition']);
        Permission::create(['name' => 'courrier_delete']);
        Permission::create(['name' => 'onglet_courrier_suivi_enregistrer']);
        Permission::create(['name' => 'onglet_courrier_suivi_encour']);
        Permission::create(['name' => 'onglet_courrier_suivi_traite']);


        Permission::create(['name' => 'onglet_facture']);
        Permission::create(['name' => 'onglet_facture_create']);
        Permission::create(['name' => 'onglet_facture_suivi']);
        Permission::create(['name' => 'onglet_facture_traite']);
        Permission::create(['name' => 'facture_traitement']);
        Permission::create(['name' => 'facture_edit']);
        Permission::create(['name' => 'facture_delete']);
        Permission::create(['name' => 'onglet_facture_suivi_enregistrer']);
        Permission::create(['name' => 'onglet_facture_suivi_encour']);
        Permission::create(['name' => 'onglet_facture_suivi_traite']);
        
        
        



        //CREATION DES ROLES 
        $super_admin = Role::create(['name' => 'super-admin']);
        $super_admin->givePermissionTo(Permission::all());






    }
}
