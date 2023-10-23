<?php
// database/factories/CourrierFactory.php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;
use App\Models\Courrier;

class CourrierFactory extends Factory
{
    protected $model = Courrier::class;

    public function definition()
    {
        return [
            'date_arriver' => $this->faker->date,
            'expediteur' => $this->faker->name,
            'motif' => $this->faker->sentence,
            'affectation' => $this->faker->optional()->sentence,
            'date_debut_traitement' => $this->faker->optional()->date,
            'date_fin_traitement' => $this->faker->optional()->date,
            'observation' => $this->faker->optional()->text,
            'statut' => $this->faker->randomElement(['ENREGISTREMENT', 'EN COURS DE TRAITEMENT', 'TRAITE']),
            'who_create' => $this->faker->name,
            'who_update' => $this->faker->optional()->name,
        ];
    }
}
