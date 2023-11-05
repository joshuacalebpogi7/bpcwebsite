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

        Schema::create('surveys_posted', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('surveyAuthor')->nullable();
            $table->unsignedBigInteger('surveyUpdateAuthor')->nullable();
            $table->longtext('surveyType');
            $table->longtext('surveyTitle');
            $table->longtext('surveyDesc')->nullable();
            $table->longtext('surveyLink')->nullable();
            $table->longtext('surveyEditorLink')->nullable();
            $table->tinyInteger('active')->default(1);
            $table->tinyInteger('forFirstTimers')->default(0);
        });

        Schema::create('survey_questions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('parentSurvey');
            $table->unsignedBigInteger('questionNum');
            $table->longtext('questionType');
            $table->longtext('questionDesc');
        });



        Schema::create('survey_choices', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('choiceNum');
            $table->longtext('choiceDesc');
            $table->unsignedBigInteger('parentSurvey');
            $table->unsignedBigInteger('parentQuestion');
        });



        Schema::create('survey_answers', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->longtext('answerDesc')->nullable();
            $table->longtext('choiceID')->nullable();
            $table->unsignedBigInteger('respondentID')->nullable();
            $table->unsignedBigInteger('parentSurvey');
            $table->unsignedBigInteger('questionAnswered')->nullable();
            $table->tinyInteger('finishedGoogleForms')->nullable();
        });

        Schema::create('finished_surveys', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('parentSurvey');
            $table->unsignedBigInteger('respondentID')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('finished_surveys');
        Schema::dropIfExists('survey_answers');
        Schema::dropIfExists('survey_choices');
        Schema::dropIfExists('survey_questions');
        Schema::dropIfExists('surveys_posted');
    }
};
