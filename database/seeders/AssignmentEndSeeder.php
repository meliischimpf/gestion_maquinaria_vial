<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AssignmentEndSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $endReasons = [

            // 1. Finalización por Cumplimiento de Tarea, 2. Finalización por Término de Contrato o Plazo, 3. Finalización por Reasignación a Otra Obra, 4. Finalización por Avería Mayor o Fuera de Servicio, 5. Finalización por Insuficiencia o Inadecuación, 6. Finalización por Cierre o Suspensión del Proyecto, 7. Finalización por Venta o Eliminación de Activo

            ['id' => 1, 'name' => 'Cumplimiento de tarea'],
            ['id' => 2, 'name' => 'Término de contrato o plazo'],
            ['id' => 3, 'name' => 'Reasignación a otra obra'],
            ['id' => 4, 'name' => 'Avería mayor o fuera de servicio'],
            ['id' => 5, 'name' => 'Insuficiencia o inadecuación'],
            ['id' => 6, 'name' => 'Cierre o suspensión del proyecto'],
            ['id' => 7, 'name' => 'Venta o eliminación de activo'],
        ];

        DB::table('assignment_ends')->insert($endReasons);
    }
}
