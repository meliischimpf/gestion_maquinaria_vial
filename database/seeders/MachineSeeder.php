<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Machine;
use App\Models\MachineType;
use App\Models\Status;

class MachineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // id serial_number (eg: ABC123) machine_type_id brand model status_id current_province current_km lifetime_km
        
        Machine::factory()
        ->count(10)
        ->create();

    }
}
