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
            $table->unsignedBigInteger('forumAuthor')->nullable();
            $table->tinyInteger('active')->default(0);
        }); //

        Schema::create('forum_replies', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('parentForum');
            $table->string('replyingTo');
            $table->string('replyBody')->nullable();
            $table->unsignedBigInteger('authorID')->nullable();
            $table->tinyInteger('active')->default(0);
        }); //

        // Insert into the 'forums_posted' table
        DB::table('forums_posted')->insert([
            'forumTitle' => 'YourForumTitle',
            'forumBody' => 'YourForumBody',
            'forumAuthor' => 1,
            // Replace with the author's ID
            'active' => 0,
            // Set the active status as needed (0 for inactive)
        ]);

        // Insert into the 'forum_replies' table
        DB::table('forum_replies')->insert([
            'parentForum' => 'YourParentForum',
            // Replace with the parent forum
            'replyingTo' => 'YourReplyingTo',
            // Replace with the ID of the message being replied to
            'replyBody' => 'YourReplyBody',
            'authorID' => 1,
            // Replace with the author's ID
            'active' => 0,
            // Set the active status as needed (0 for inactive)
        ]);

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
