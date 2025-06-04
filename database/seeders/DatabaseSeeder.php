<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        
        $this->call([
            ParameterSeeder::class,
            AssignmentEndSeeder::class,
            MaintenanceTypeSeeder::class,
            MachineTypeSeeder::class,
            ProvinceSeeder::class,
            StatusSeeder::class,


            // Datos para Test
            
            //MachineSeeder::class,
            //MaintenanceSeeder::class,
            //WorkSeeder::class,
            //AssignmentSeeder::class,
            //UserSeeder::class,
         ]);
    }
}
