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
            $table->string('surveyType');
            $table->string('surveyTitle');
            $table->string('authorID')->nullable();
            $table->string('surveyDesc')->nullable();
            $table->string('surveyLink')->nullable();
            $table->string('surveyEditorLink')->nullable();
            $table->tinyInteger('active')->default(0);

            // Uncomment the following lines to add a foreign key constraint
            /*$table->unsignedBigInteger('surveyAuthor')->nullable();
            $table->foreign('surveyAuthor')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');*/
        });

        Schema::create('survey_questions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('parentSurvey');
            /*             $table->foreign('parentSurvey')
                            ->references('id')
                            ->on('surveys_posted')
                            ->onDelete('cascade'); */
            $table->unsignedBigInteger('questionNum');
            //$table->index('questionNum'); // Add this line to create an index on 'questionNum'
            $table->string('questionType');
            $table->string('questionDesc');
        });



        Schema::create('survey_choices', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('choiceNum');
            $table->string('choiceDesc');
            $table->unsignedBigInteger('parentSurvey');
            /*             $table->foreign('parentSurvey')
                            ->references('id')
                            ->on('surveys_posted')
                            ->onDelete('cascade'); */
            $table->unsignedBigInteger('parentQuestion');
            /*
            $table->index('parentQuestion'); // Add this line to create an index on 'parentQuestion'
            $table->foreign('parentQuestion')
                ->references('questionNum')
                ->on('survey_questions')
                ->onDelete('cascade');
                */
        });



        Schema::create('survey_answers', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('answerDesc')->nullable();
            $table->string('choiceID')->nullable();
            $table->unsignedBigInteger('respondentID')->nullable();
            $table->unsignedBigInteger('parentSurvey');
            /*             $table->foreign('parentSurvey')
                            ->references('id')
                            ->on('surveys_posted')
                            ->onDelete('cascade'); */
            $table->unsignedBigInteger('questionAnswered')->nullable();
            $table->tinyInteger('finishedGoogleForms')->nullable();
            /*
            $table->foreign('questionAnswered')
                ->references('questionNum')
                ->on('survey_questions')
                ->onDelete('cascade');
                */
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
