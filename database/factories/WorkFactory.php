<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;
use App\Models\Province;
use App\Models\Status;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Work>
 */
class WorkFactory extends Factory
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
            
            'name' => $faker->word(),
            'province_id' => $faker->numberBetween(1, Province::count()),
            'start_date' => $faker->dateTimeBetween('-1 year', 'now'),
            'end_date_planned' => $faker->dateTimeBetween('now', '+1 year'),
            'end_date_real' => $faker->dateTimeBetween('now', '+1 year'),
            'description' => $faker->sentence(),

        ];
    }
}
