<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;
use App\Models\Machine;
use App\Models\MaintenanceType;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Maintenance>
 */
class MaintenanceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = \App\Models\Maintenance::class;


    public function definition(): array
    {
        $faker = Faker::create('es_AR'); 

        return [
            
            'machine_id' => $faker->numberBetween(1, Machine::count()),
            'km_at_maintenance' => $faker->numberBetween(50000,55000),
            'maintenanceType_id' => $faker->numberBetween(1, MaintenanceType::count()),
            'realization_date' => $faker->dateTimeBetween('-1 year', 'now'),
            
        ];
    }
}
