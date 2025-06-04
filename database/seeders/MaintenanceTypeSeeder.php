<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MaintenanceTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {  //mantenimientos rutinarios
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

        DB::table('maintenance_types')->insert($maintenances);
    }
}
