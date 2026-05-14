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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id('appointment_id');
            $table->foreignId('patient_id')->constrained('patients', 'id')->onDelete('cascade');
            $table->foreignId('doctor_id')->constrained('doctors', 'id')->onDelete('cascade');
            $table->foreignId('schedule_id')->constrained('doctor_schedules', 'id')->onDelete('cascade');
            $table->date('appointment_date');
            $table->time('appointment_time');
            $table->enum('status', ['confirm', 'pending', 'cancelled', 'completed']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
