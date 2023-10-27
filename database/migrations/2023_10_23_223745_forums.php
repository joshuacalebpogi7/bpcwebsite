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
        Schema::create('forums_posted', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('forumTitle');
            $table->string('forumBody')->nullable();
            $table->string('forumAuthor')->nullable();
            $table->tinyInteger('active')->default(0);

            // Uncomment the following lines to add a foreign key constraint
            /*$table->unsignedBigInteger('surveyAuthor')->nullable();
            $table->foreign('surveyAuthor')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');*/
        }); //

        Schema::create('forum_replies', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('parentForum');
            $table->string('replyingTo');
            $table->string('replyBody')->nullable();
            $table->string('authorID')->nullable();
            $table->tinyInteger('active')->default(0);

            // Uncomment the following lines to add a foreign key constraint
            /*$table->unsignedBigInteger('surveyAuthor')->nullable();
            $table->foreign('surveyAuthor')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');*/
        }); //
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
