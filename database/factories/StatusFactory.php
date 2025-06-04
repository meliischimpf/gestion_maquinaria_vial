<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;
use App\Models\Status;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Status>
 */
class StatusFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition(): array
    {


        $faker = Faker::create('es_AR');  

        $validSituations = [
        'Inactivo',
        'Activo',
        'En Espera',
        'En Funcionamiento',
        'En Mantenimiento',
        'Finalizado',
    ];

        return [
            'situation' => $faker->randomElement($validSituations),
        ];
    }
}
