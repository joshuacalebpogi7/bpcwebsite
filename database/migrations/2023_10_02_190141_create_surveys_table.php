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
            $table->string('surveyType');
            $table->string('surveyTitle');
            $table->string('surveyDesc')->nullable();
            $table->string('surveyLink')->nullable();
            $table->string('surveyEditorLink')->nullable();
            $table->tinyInteger('active')->default(1);
            $table->tinyInteger('forFirstTimers')->default(0);
        });

        Schema::create('survey_questions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('parentSurvey');
            $table->unsignedBigInteger('questionNum');
            $table->string('questionType');
            $table->string('questionDesc');
        });



        Schema::create('survey_choices', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('choiceNum');
            $table->string('choiceDesc');
            $table->unsignedBigInteger('parentSurvey');
            $table->unsignedBigInteger('parentQuestion');
        });



        Schema::create('survey_answers', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('answerDesc')->nullable();
            $table->string('choiceID')->nullable();
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

        DB::table('surveys_posted')->insert([
            'surveyAuthor' => 1,
            // Replace with the author's ID
            'surveyType' => 'built_in',
            'surveyTitle' => 'YourSurveyTitle',
            'surveyDesc' => 'YourSurveyDescription',
            // Add other fields with dummy values
        ]);

        DB::table('survey_questions')->insert([
            'parentSurvey' => 1,
            // Assuming 1 is the ID of the survey
            'questionNum' => 1,
            'questionType' => 'dropdown',
            'questionDesc' => 'YourQuestionDescription',
            // Add other fields with dummy values
        ]);

        DB::table('survey_choices')->insert([
            'choiceNum' => 1,
            'choiceDesc' => 'ChoiceDescription',
            'parentSurvey' => 1,
            // Assuming 1 is the ID of the survey
            'parentQuestion' => 1,
            // Assuming 1 is the ID of the question
            // Add other fields with dummy values
        ]);

        DB::table('survey_answers')->insert([
            'answerDesc' => 'AnswerDescription',
            'choiceID' => 1,
            // Assuming 1 is the ID of the choice
            'respondentID' => 1,
            // Assuming 1 is the ID of the respondent
            'parentSurvey' => 1,
            // Assuming 1 is the ID of the survey
            'questionAnswered' => 1,
            // Assuming 1 is the ID of the question answered
            'finishedGoogleForms' => 1,
            // Add your value for this field
        ]);

        DB::table('finished_surveys')->insert([
            'parentSurvey' => 1,
            // Assuming 1 is the ID of the survey
            'respondentID' => 1,
            // Assuming 1 is the ID of the respondent
        ]);

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
