<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Workflow;
use App\Models\Etapetraitement;

class WorkflowSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       // Création du workflow de type "Début"
       Workflow::create([
        'num_ordre' => null, // Null car c'est un workflow sans numéro d'ordre
        'type' => 'DEBUT',
        'libelle' => 'DEBUT',
        'who_create' => 'SYSTEM',
    ]);

    // Création du workflow de type "Fin"
    Workflow::create([
        'num_ordre' => null, // Null car c'est un workflow sans numéro d'ordre
        'type' => 'FIN',
        'libelle' => 'FIN',
        'who_create' => 'SYSTEM',
    ]);

    // Création du workflow de type "encours"
    Workflow::create([
        'num_ordre' => 1, // Null car c'est un workflow sans numéro d'ordre
        'type' => 'EN COURS',
        'libelle' => 'DCAG',
        'who_create' => 'SYSTEM',
    ]);

    Etapetraitement::create([
        'num_ordre' => 1, // Null car c'est un workflow sans numéro d'ordre
        'parent_id' => 3,
        'libelle' => '1',
        'who_create' => 'SYSTEM',
    ]);

    // Création du workflow de type "Fin"
    Workflow::create([
        'num_ordre' => 2, // Null car c'est un workflow sans numéro d'ordre
        'type' => 'EN COURS',
        'libelle' => 'CONTROL',
        'who_create' => 'SYSTEM',
    ]);

    Etapetraitement::create([
        'num_ordre' => 1, // Null car c'est un workflow sans numéro d'ordre
        'parent_id' => 4,
        'libelle' => '1',
        'who_create' => 'SYSTEM',
    ]);

    // Création du workflow de type "Fin"
    Workflow::create([
        'num_ordre' => 3, // Null car c'est un workflow sans numéro d'ordre
        'type' => 'EN COURS',
        'libelle' => 'AUDIT',
        'who_create' => 'SYSTEM',
    ]);


    Etapetraitement::create([
        'num_ordre' => 1, // Null car c'est un workflow sans numéro d'ordre
        'parent_id' => 5,
        'libelle' => '1',
        'who_create' => 'SYSTEM',
    ]);

    // Création du workflow de type "Fin"
    Workflow::create([
        'num_ordre' => 4, // Null car c'est un workflow sans numéro d'ordre
        'type' => 'EN COURS',
        'libelle' => 'KIRENE',
        'who_create' => 'SYSTEM',
    ]);

    Etapetraitement::create([
        'num_ordre' => 1, // Null car c'est un workflow sans numéro d'ordre
        'parent_id' => 6,
        'libelle' => '1',
        'who_create' => 'SYSTEM',
    ]);

    }
}
