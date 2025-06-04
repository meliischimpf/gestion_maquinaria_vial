<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;
use App\Models\MachineType;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Machine_type>
 */
class MachineTypeFactory extends Factory
{


    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    
     public function definition(): array
    {

        $faker = Faker::create('es_AR');  
        
        $machineTypes = [
            'Excavadora', 'Retroexcavadora', 'Motoniveladora', 'Pala Cargadora', 'Compactadora',
            'Aplanadora', 'Dumper', 'Grúa Móvil', 'Bulldozer', 'Perforadora',
        ];

        return [
            'name' => $faker->randomElement($machineTypes),
            'function' => $faker->text(),
        ];


        
    }
}