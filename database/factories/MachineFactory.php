<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;
use App\Models\Machine;
use App\Models\MachineType;
use App\Models\Status;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Machine>
 */
class MachineFactory extends Factory
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
            'serial_number' => strtoupper($faker->bothify('???-####')),
            'type_id' => $faker->numberBetween(1, MachineType::count()),
            'brand' => $faker->word(),
            'model' => $faker->word(),
            'status_id' => $faker->numberBetween(1, Status::count()),
            'current_km' => 0,
            'lifetime_km' => $faker->numberBetween(1000, 100000),

        ];
    }
}
