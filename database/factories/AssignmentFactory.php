<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;
use App\Models\Assignment;
use App\Models\AssignmentEnd;
use App\Models\Machine;
use App\Models\Work;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Assignment>
 */
class AssignmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = Faker::create('es_AR'); 

        return [
            
            'start_date' => $faker->dateTimeBetween('-1 year', 'now'),
            'end_date' => $faker->dateTimeBetween('now', '+1 year'),
            'assignmentEnd_id' => $faker->numberBetween(1, AssignmentEnd::count()),
            'km_traveled' => $faker->numberBetween(1000, 100000),
            'machine_id' => $faker->numberBetween(1, Machine::count()),
            'work_id' => $faker->numberBetween(1, Work::count()),

        ];
    }
}
