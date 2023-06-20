<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SoucheSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('souches')->insert([

            [
       
                'last_souche' => 'ENTREE-01/23-0',
                'prefix' => 'ENTREE',
                'type' => 'Ticket_entrer',
               
    
            ],

            [
       
                'last_souche' => 'SORTIE-01/23-0',
                'prefix' => 'SORTIE',
                'type' => 'Ticket_sortie',
               
    
            ]

           
        ]);
    }
}
