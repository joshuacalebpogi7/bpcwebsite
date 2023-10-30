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
        Schema::create('forums_posted', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('forumTitle');
            $table->string('forumBody')->nullable();
            $table->string('forumCategory')->nullable();
            $table->unsignedBigInteger('forumAuthor')->nullable();
            $table->unsignedBigInteger('forumUpdateAuthor')->nullable();
            $table->tinyInteger('active')->default(0);
        }); //

        Schema::create('forum_replies', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('parentForum');
            $table->unsignedBigInteger('replyingTo');
            $table->string('replyBody')->nullable();
            $table->unsignedBigInteger('replyAuthor')->nullable();
            $table->tinyInteger('active')->default(0);
        }); //
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop the tables if they exist
        Schema::dropIfExists('forums_posted');
        Schema::dropIfExists('forum_replies');
    }
};
