<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Province;
use Illuminate\Support\Facades\DB;


class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // id name postal_code

        $provinces = [
            ['id' => 1, 'name' => 'Buenos Aires', 'postal_code' => 'B'],
            ['id' => 2, 'name' => 'Catamarca', 'postal_code' => 'K'],
            ['id' => 3, 'name' => 'Chaco', 'postal_code' => 'H'],
            ['id' => 4, 'name' => 'Chubut', 'postal_code' => 'U'],
            ['id' => 5, 'name' => 'Córdoba', 'postal_code' => 'X'],
            ['id' => 6, 'name' => 'Corrientes', 'postal_code' => 'W'],
            ['id' => 7, 'name' => 'Entre Ríos', 'postal_code' => 'E'],
            ['id' => 8, 'name' => 'Formosa', 'postal_code' => 'P'],
            ['id' => 9, 'name' => 'Jujuy', 'postal_code' => 'Y'],
            ['id' => 10, 'name' => 'La Pampa', 'postal_code' => 'L'],
            ['id' => 11, 'name' => 'La Rioja', 'postal_code' => 'F'],
            ['id' => 12, 'name' => 'Mendoza', 'postal_code' => 'M'],
            ['id' => 13, 'name' => 'Misiones', 'postal_code' => 'N'],
            ['id' => 14, 'name' => 'Neuquén', 'postal_code' => 'Q'],
            ['id' => 15, 'name' => 'Río Negro', 'postal_code' => 'R'],
            ['id' => 16, 'name' => 'Salta', 'postal_code' => 'A'],
            ['id' => 17, 'name' => 'San Juan', 'postal_code' => 'J'],
            ['id' => 18, 'name' => 'San Luis', 'postal_code' => 'D'],
            ['id' => 19, 'name' => 'Santa Cruz', 'postal_code' => 'Z'],
            ['id' => 20, 'name' => 'Santa Fe', 'postal_code' => 'S'],
            ['id' => 21, 'name' => 'Santiago del Estero', 'postal_code' => 'G'],
            ['id' => 22, 'name' => 'Tierra del Fuego, Antártida e Islas del Atlántico Sur', 'postal_code' => 'V'],
            ['id' => 23, 'name' => 'Tucumán', 'postal_code' => 'T'],
            ['id' => 24, 'name' => 'Ciudad Autónoma de Buenos Aires', 'postal_code' => 'C'],
        ];

        DB::table('provinces')->insert($provinces);
    }
}
