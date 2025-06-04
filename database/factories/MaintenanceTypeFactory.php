<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MaintenanceType>
 */
class MaintenanceTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = Faker::create('es_AR');

        $maintenances = [ 
            ['id' => 1, 'name' => 'Cambio de aceite'],
            ['id' => 2, 'name' => 'Cambio de filtros'],
            ['id' => 3, 'name' => 'Relleno líquidos'], 
            ['id' => 4, 'name' => 'Reemplazo de bujías'],
            ['id' => 5, 'name' => 'Reemplazo de correas y cadenas'],
            ['id' => 6, 'name' => 'Reemplazo de neumáticos'],
            ['id' => 7, 'name' => 'Reemplazo de baterías'],
            ['id' => 8, 'name' => 'Reemplazo de componentes eléctricos'],
            ['id' => 9, 'name' => 'Reemplazo de componentes hidráulicos'],
            ['id' => 10, 'name' => 'Reemplazo de componentes mecánicos'],
        ];

        return [
            'name' => $faker->randomElement(array_column($maintenances, 'name')),
            'maintenance_id' => $faker->randomElement(array_column($maintenances, 'id')),
        ];
    }
}
