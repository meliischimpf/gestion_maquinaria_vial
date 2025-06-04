<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\assignmentEnd>
 */
class AssignmentEndFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = Faker::create('es_AR');

        $endReasons = [ 
            ['id' => 1, 'name' => 'Finalización planificada'],
            ['id' => 2, 'name' => 'Falta de presupuesto'],
            ['id' => 3, 'name' => 'Cambio de gestión gubernamental'],
            ['id' => 4, 'name' => 'Problemas técnicos o ambientales'],
            ['id' => 5, 'name' => 'Conflictos legales o administrativos'],
            ['id' => 6, 'name' => 'Desastres naturales o emergencias'],
            ['id' => 7, 'name' => 'Reevaluación de necesidades'],
        ];

        return [
            'reason' => $faker->randomElement(array_column($endReasons, 'name')),
            'reason_id' => $faker->randomElement(array_column($endReasons, 'id')),
        ];

    }
}
