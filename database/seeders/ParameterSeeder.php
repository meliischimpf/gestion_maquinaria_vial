<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Parameter;
use Illuminate\Support\Facades\DB;

class ParameterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $parameters = [
            ['id' => 1, 'name' => 'km_per_maintenance', 'value' => 50000, 'description' => 'Kilometros para el mantenimiento'],
            ['id' => 2, 'name' => 'km_for_sale', 'value' => 500000, 'description' => 'Kilometros para el venta de máquina'],
        ];

        DB::table('parameters')->insert($parameters);
    }
}
