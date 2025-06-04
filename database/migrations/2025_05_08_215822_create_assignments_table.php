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
        Schema::create('assignments', function (Blueprint $table) { // id, start_date, end_date, end_reason, km_traveled, machine_id, work_id
            $table->id();
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->foreignId('assignmentEnd_id')->nullable()->constrained('assignment_ends')->onDelete('set null');
            $table->integer('km_traveled')->nullable();
            $table->foreignId('machine_id')->constrained('machines')->onDelete('cascade');
            $table->foreignId('work_id')->constrained('works')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assignments');
    }
};
