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
        Schema::create('works', function (Blueprint $table) {// id, name, province_id, start_date, end_date
            $table->id();
            $table->string('name');
            $table->string('description'); 
            $table->foreignId('province_id')->constrained('provinces')->onDelete('cascade');
            $table->date('start_date');
            $table->date('end_date_planned');
            $table->date('end_date_real')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('works');
    }
};
