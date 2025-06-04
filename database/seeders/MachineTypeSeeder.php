<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MachineType;
use Illuminate\Support\Facades\DB;

class MachineTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $machineTypes = [
            [
                'name' => 'Excavadora',
                'function' => 'Excavación de zanjas, fosas y movimientos de tierra.',
            ],
            [
                'name' => 'Retroexcavadora',
                'function' => 'Excavación y carga de materiales, zanjeo.',
            ],
            [
                'name' => 'Motoniveladora',
                'function' => 'Nivelación y perfilado de terrenos, construcción y mantenimiento de caminos.',
            ],
            [
                'name' => 'Pala Cargadora',
                'function' => 'Carga y transporte de materiales a granel (arena, grava, tierra).',
            ],
            [
                'name' => 'Compactadora',
                'function' => 'Compactación de suelos, asfalto y otros materiales.',
            ],
            [
                'name' => 'Aplanadora',
                'function' => 'Alisado y compactación de superficies, especialmente asfalto.',
            ],
            [
                'name' => 'Dumper',
                'function' => 'Transporte de grandes volúmenes de material en obras.',
            ],
            [
                'name' => 'Grúa Móvil',
                'function' => 'Elevación y movimiento de cargas pesadas en diferentes puntos de la obra.',
            ],
            [
                'name' => 'Bulldozer',
                'function' => 'Movimiento de grandes cantidades de tierra, desmonte y nivelación de terrenos.',
            ],
            [
                'name' => 'Perforadora',
                'function' => 'Realización de perforaciones en roca y suelo para diversas aplicaciones.',
            ],
            
        ];

        DB::table('machine_types')->insert($machineTypes);
    }
}
