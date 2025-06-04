<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Status;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // id situation
        $statuses = [
            ['situation' => 'En Funcionamiento'],
            ['situation' => 'En Espera'],
            ['situation' => 'En Mantenimiento'],
            ['situation' => 'Dado de Baja'],
        ];

        DB::table('statuses')->insert($statuses);

    }
}
