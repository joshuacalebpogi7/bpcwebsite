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
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string('image')->nullable();
            $table->string('title');
            $table->string('job_title');
            $table->longText('description');
            $table->string('company');
            $table->string('location');
            $table->string('salary');
            $table->string('link')->nullable();
            $table->string('status')->default('hiring');
            $table->string('posted_by');
            $table->string('updated_by');
            $table->timestamps();
        });
    }

    // public function up(): void
    // {
    //     Schema::create('jobs', function (Blueprint $table) {
    //         $table->id();
    //         $table->string('image')->nullable();
    //         $table->string('title');
    //         $table->string('job_title');
    //         $table->longText('description');
    //         $table->string('employment_status');
    //         $table->string('company');
    //         $table->string('company_address');
    //         $table->string('applicants');
    //         $table->string('link')->nullable();
    //         $table->string('status')->default('active');
    //         $table->string('posted_by');
    //         $table->string('updated_by');
    //         $table->timestamps();
    //     });
    //     Schema::create('accepted_jobs', function (Blueprint $table) {
    //         $table->id();
    //         $table->foreignId('job_id');
    //         $table->foreignId('user_id');
    //         $table->timestamps();
    //     });
    // }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};