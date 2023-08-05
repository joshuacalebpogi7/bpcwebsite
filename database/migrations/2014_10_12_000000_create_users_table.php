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
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('avatar')->nullable();
            $table->string('user_type')->default('alumni');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('email_sent')->default(false);
            $table->string('password');
            $table->boolean('survey_completed')->default(false);
            $table->boolean('add_info_completed')->default(false);
            $table->string('first_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
            $table->date('birthday')->nullable();
            $table->string('age')->nullable();
            $table->string('civil_status')->nullable();
            $table->string('gender')->nullable();
            $table->string('contact_no')->nullable();
            $table->longText('address')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('course')->nullable();
            $table->string('year_graduated')->nullable();
            $table->string('employment_status')->nullable();
            $table->string('job_type')->nullable();
            $table->string('job_position')->nullable();
            $table->string('job_location')->nullable();
            $table->string('monthly_salary')->nullable();
            $table->string('default_password')->nullable();
            $table->rememberToken();
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