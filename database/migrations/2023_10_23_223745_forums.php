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
            $table->longtext('forumTitle');
            $table->longtext('forumBody')->nullable();
            $table->longtext('forumCategory')->nullable();
            $table->unsignedBigInteger('replyCount')->nullable();
            $table->unsignedBigInteger('forumAuthor')->nullable();
            $table->unsignedBigInteger('forumUpdateAuthor')->nullable();
            $table->unsignedBigInteger('votes')->nullable();
            $table->tinyInteger('active')->default(0);
        }); //

        Schema::create('forum_replies', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('parentForum');
            $table->unsignedBigInteger('replyingTo')->nullable();
            $table->longtext('replyBody')->nullable();
            $table->unsignedBigInteger('replyAuthor')->nullable();
            $table->unsignedBigInteger('votes')->nullable();
            $table->tinyInteger('active')->default(0);
        }); //

        Schema::create('forum_votes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('parentForum');
            $table->unsignedBigInteger('parentReply')->nullable();
            $table->longtext('voteType')->nullable();
            $table->unsignedBigInteger('voteAuthor')->nullable();
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
        Schema::dropIfExists('forum_votes');
    }
};
