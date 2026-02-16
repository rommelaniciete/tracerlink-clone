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
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('student_number', 50)->unique();
            $table->string('first_name', 100);
            $table->string('middle_initial', 1)->nullable();
            $table->string('last_name', 100);
            $table->string('contact_number', 20);
            $table->string('email')->unique();
            $table->string('address', 1000);
            $table->string('program_taken', 150);
            $table->unsignedSmallInteger('year_batch_graduated');
            $table->string('employment_status', 30);
            $table->string('sector_of_employment', 30);
            $table->string('company_name')->nullable();
            $table->string('work_location')->nullable();
            $table->unsignedTinyInteger('overall_rating');
            $table->boolean('data_privacy_consent');
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
