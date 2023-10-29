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
        //INSERT ADMIN CREDENTIALS
        DB::table('users')->insert([
            'username' => 'admin',
            'email' => 'bulpolcol@gmail.com',
            'user_type' => 'admin',
            'email_verified_at' => now(),
            'email_sent' => true,
            'password' => Hash::make('admin'),
            'survey_completed' => true,
            'add_info_completed' => true,
            'first_name' => 'admin',
            'middle_name' => 'admin',
            'last_name' => 'admin',
            'birthday' => null,
            'age' => null,
            'civil_status' => null,
            'gender' => null,
            'contact_no' => null,
            'address' => null,
            'postal_code' => null,
            'course' => null,
            'year_graduated' => null,
            'employment_status' => null,
            'job_type' => null,
            'job_position' => null,
            'job_location' => null,
            'monthly_salary' => null,
            'default_password' => null,
            'created_at' => now(),
            'updated_at' => now(),
            // Add more columns and values as needed
        ]);
        //INSERT ADMIN CREDENTIALS

        //INSERT ALUMNI CREDENTIALS (To be removed upon deployment)
        DB::table('users')->insert([
            'username' => 'alumni',
            'email' => 'alumni@gmail.com',
            'user_type' => 'alumni',
            'email_verified_at' => now(),
            'email_sent' => true,
            'password' => Hash::make('alumni'),
            'survey_completed' => true,
            'add_info_completed' => true,
            'first_name' => 'alumni',
            'middle_name' => 'alumni',
            'last_name' => 'alumni',
            'birthday' => null,
            'age' => null,
            'civil_status' => null,
            'gender' => null,
            'contact_no' => null,
            'address' => null,
            'postal_code' => null,
            'course' => null,
            'year_graduated' => null,
            'employment_status' => null,
            'job_type' => null,
            'job_position' => null,
            'job_location' => null,
            'monthly_salary' => null,
            'default_password' => null,
            'created_at' => now(),
            'updated_at' => now(),
            // Add more columns and values as needed
        ]);
        //INSERT ALUMNI CREDENTIALS (To be removed upon deployment)

        //INSERT ALUMNI CREDENTIALS (To be removed upon deployment)
        DB::table('users')->insert([
            'username' => 'content_creator',
            'email' => 'content_creator@gmail.com',
            'user_type' => 'content creator',
            'email_verified_at' => now(),
            'email_sent' => true,
            'password' => Hash::make('content_creator'),
            'survey_completed' => true,
            'add_info_completed' => true,
            'first_name' => 'content',
            'middle_name' => 'c',
            'last_name' => 'creator',
            'birthday' => null,
            'age' => null,
            'civil_status' => null,
            'gender' => null,
            'contact_no' => null,
            'address' => null,
            'postal_code' => null,
            'course' => null,
            'year_graduated' => null,
            'employment_status' => null,
            'job_type' => null,
            'job_position' => null,
            'job_location' => null,
            'monthly_salary' => null,
            'default_password' => null,
            'created_at' => now(),
            'updated_at' => now(),
            // Add more columns and values as needed
        ]);
        //INSERT ALUMNI CREDENTIALS (To be removed upon deployment)
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};