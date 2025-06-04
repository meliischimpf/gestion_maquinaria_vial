<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Parameter>
 */
class ParameterFactory extends Factory
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

            $parameters = [
            'km_for_maintenance',
            ]
            
        ];

        return [
            'name' => $faker->randomElement($parameters),
            'value' => $this->faker->numberBetween(1000, 100000),
            'description' => $this->faker->sentence(),

        ];
    }
}
