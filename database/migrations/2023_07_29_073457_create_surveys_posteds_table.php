<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use PhpParser\Node\NullableType;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('surveys_posteds', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('surveyTitle')->nullable();
            $table->string('surveyDesc'); //->nullable();
            $table->string('surveyLink')->nullable();
            $table->tinyInteger('active')->default(0);
        });

        Schema::create('survey_questions', function (Blueprint $table) {
            $table->string('surveyID');
            $table->timestamps();
            $table->increments('questionID');
            $table->string('questionNum');
            $table->string('questionType');
            $table->string('questionDesc');
        });

        Schema::create('survey_choices', function (Blueprint $table) {
            $table->string('surveyID');
            $table->timestamps();
            $table->increments('choiceID');
            $table->string('questionNum');
            $table->string('choiceDesc');
        });

        Schema::create('survey_answers', function (Blueprint $table) {
            $table->string('surveyID');
            $table->timestamps();
            $table->string('questionAnswered');
            $table->increments('answerID');
            $table->string('answerDesc');
            $table->string('respondentID');
        });

        /*Schema::create('builtin_survey', function (Blueprint $table) {
            $table->string('surveyID');
            $table->string('questionAnswered');
            $table->increments('answerID');
            $table->string('answerDesc');
            $table->string('respondentID');
            $table->timestamps();
        });*/


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surveys_posteds');
        Schema::dropIfExists('surveys_choices');
        Schema::dropIfExists('surveys_questions');
        Schema::dropIfExists('surveys_answers');
    }
};
