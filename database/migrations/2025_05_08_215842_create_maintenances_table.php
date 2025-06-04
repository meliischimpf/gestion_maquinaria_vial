<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('maintenances', function (Blueprint $table) { //id, realization_date, current_km, description, id_machine
            $table->id();
            $table->date('realization_date');
            $table->foreignId('machine_id')->constrained('machines')->onDelete('cascade');
            $table->unsignedInteger('km_at_maintenance');
            $table->foreignId('maintenanceType_id')->constrained('maintenance_types')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maintenances');
    }
};
