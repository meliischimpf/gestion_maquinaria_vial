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
        Schema::create('machines', function (Blueprint $table) { //serial_number machine_type_id brand model status_id current_km lifetime_km
            $table->id();
            $table->string('serial_number')->unique();
            $table->foreignId('type_id')->constrained('machine_types')->onDelete('cascade');
            $table->string('brand');
            $table->string('model');
            $table->foreignId('status_id')->constrained('statuses')->onDelete('cascade');
            $table->integer('current_km');
            $table->integer('lifetime_km');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('machines');
    }
};
