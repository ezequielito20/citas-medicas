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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();

            $table->string('names', length: 100);
            $table->string('last_names', length: 100);
            $table->string('ci', length: 9)->unique();
            $table->string('email', length: 100)->unique();
            $table->string('phone', length: 20)->nullable();
            $table->date('birthdate')->nullable();
            $table->string('gender', length: 1)->nullable();
            $table->string('blood_type', length: 20)->nullable();
            $table->string('allergies', length: 190)->nullable();
            $table->string('emergency_contact', length: 100)->nullable();
            $table->string('health_insurance_number', length: 100)->nullable();
            $table->string('observations', length: 190)->nullable();
            $table->string('address', length: 190)->nullable();


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
