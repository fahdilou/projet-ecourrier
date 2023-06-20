<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::where('name','super-admin')->first();
        $user = User::create([
            'name' => 'Admin User',
            'email' => 'admin@admin.com',
            'poste' => 'Administrateur',
            'password' => Hash::make('P@ssw0rd'),
            'droit'=>$role->name,
        ]);

        $user->assignRole('super-admin');
        
    }
}
