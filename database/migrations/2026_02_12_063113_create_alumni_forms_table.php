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
        Schema::create('alumni_forms', function (Blueprint $table) {
            $table->id();
            $table->string('student_number');
            $table->string('first_name');
            $table->string('middle_initial')->nullable();
            $table->string('last_name');
            $table->string('contact_number');
            $table->string('email')->unique();
            $table->text('address')->nullable();

            // Academic Information
            $table->string('program_taken');
            $table->string('year_batch');

            // Employment Information
            $table->string('employment_status')->nullable();
            $table->string('employment_sector')->nullable();
            $table->string('company_name')->nullable();
            $table->string('work_location')->nullable();

            // Feedback
            $table->tinyInteger('rating')->nullable(); // 1-5

            // Consent
            $table->boolean('consent')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alumni_forms');
    }
};
