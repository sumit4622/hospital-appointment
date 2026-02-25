<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username', 20);
            $table->string('full_name', 100);
            $table->date('date_of_birth');
            $table->string('gender');
            $table->string('phone_number')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('role', ['patient', 'doctor', 'admin'])->default('patient');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
