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
        Permission::create(['name' => 'onglet_app']);
        Permission::create(['name' => 'onglet_reportings']);
        



        //CREATION DES ROLES 
        $super_admin = Role::create(['name' => 'super-admin']);
        $super_admin->givePermissionTo(Permission::all());






    }
}
