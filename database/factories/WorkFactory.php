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
            
            'name' => function() use ($faker) {
                $types = [
                    'Autopista', 'Ruta Nacional', 'Ruta Provincial', 'Puente', 'Túnel',
                    'Represa', 'Edificio', 'Barrio Cerrado', 'Planta Industrial', 'Aeropuerto',
                    'Puerto', 'Tren', 'Subterráneo', 'Gasoducto', 'Oleoducto',
                    'Parque Eólico', 'Planta Solar', 'Hospital', 'Escuela', 'Estadio'
                ];
                
                $locations = [
                    'Norte', 'Sur', 'Este', 'Oeste', 'Central', 'Buenos Aires', 'Córdoba',
                    'Santa Fe', 'Mendoza', 'Tucumán', 'Entre Ríos', 'Salta', 'Misiones',
                    'Chaco', 'Corrientes', 'Santiago del Estero', 'San Juan', 'Jujuy',
                    'Río Negro', 'Neuquén', 'Formosa', 'Chubut', 'San Luis', 'Catamarca',
                    'La Rioja', 'La Pampa', 'Santa Cruz', 'Tierra del Fuego'
                ];
                
                $prefixes = ['Nuevo', 'Ampliación', 'Mejora', 'Reparación', 'Modernización'];
                
                $type = $faker->randomElement($types);
                $location = $faker->randomElement($locations);
                $prefix = $faker->optional(0.3)->randomElement($prefixes);
                
                return trim(($prefix ? $prefix . ' ' : '') . $type . ' ' . $location . ' ' . $faker->optional(0.2)->numberBetween(1, 10));
            },
            'province_id' => $faker->numberBetween(1, Province::count()),
            'start_date' => $faker->dateTimeBetween('-1 year', 'now'),
            'end_date_planned' => $faker->dateTimeBetween('now', '+1 year'),
            'end_date_real' => $faker->dateTimeBetween('now', '+1 year'),
            'description' => $faker->sentence(),

        ];
    }
}
