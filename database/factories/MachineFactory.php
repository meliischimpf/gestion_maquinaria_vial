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
            'brand' => $faker->randomElement([
                'Caterpillar', 'Komatsu', 'Volvo', 'Hitachi', 'Liebherr',
                'JCB', 'Doosan', 'Case', 'New Holland', 'John Deere',
                'Hyundai', 'Kobelco', 'Sany', 'XCMG', 'Terex'
            ]),
            'model' => function(array $attributes) use ($faker) {
                $brand = $attributes['brand'];
                $models = [
                    'Caterpillar' => ['D6', 'D8', '320', '336', '349', '950', '980'],
                    'Komatsu' => ['PC200', 'PC300', 'PC400', 'D65', 'D85'],
                    'Volvo' => ['EC220', 'EC300', 'EC480', 'L120', 'L150'],
                    'Hitachi' => ['ZX200', 'ZX350', 'ZX470', 'ZX870'],
                    'Liebherr' => ['R 920', 'R 956', 'R 9800', 'PR 776'],
                    'JCB' => ['3CX', '4CX', 'JS130', 'JS200', 'JS330'],
                    'Doosan' => ['DX140', 'DX225', 'DX300', 'DX530'],
                    'Case' => ['580', '850', '1150', '1650'],
                    'New Holland' => ['C245', 'C305', 'E140', 'E215'],
                    'John Deere' => ['310', '350', '470', '670'],
                    'Hyundai' => ['R210', 'R320', 'R520', 'R800'],
                    'Kobelco' => ['SK140', 'SK210', 'SK350', 'SK500'],
                    'Sany' => ['SY16', 'SY35', 'SY75', 'SY215'],
                    'XCMG' => ['XE60', 'XE150', 'XE215', 'XE370'],
                    'Terex' => ['TC62', 'TC125', 'TC280', 'TC360']
                ];

                return $faker->randomElement($models[$brand] ?? ['Standard']);
            },
            'status_id' => $faker->numberBetween(1, Status::count()),
            'current_km' => 0,
            'lifetime_km' => $faker->numberBetween(1000, 100000),

        ];
    }
}
