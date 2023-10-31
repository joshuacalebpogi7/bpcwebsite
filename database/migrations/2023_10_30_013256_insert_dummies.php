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
        /* INSERT USERS VALUES */
        //INSERT ADMIN CREDENTIALS
        DB::table('users')->insert([
            'username' => 'admin',
            'email' => 'bulpolcol@gmail.com',
            'user_type' => 'admin',
            'email_verified_at' => now(),
            'email_sent' => true,
            'password' => Hash::make('admin123'),
            'survey_completed' => true,
            'add_info_completed' => true,
            'first_name' => 'admin',
            'middle_name' => 'admin',
            'last_name' => 'admin',
            'birthday' => null,
            'age' => null,
            'civil_status' => null,
            'gender' => 'male',
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
            'password' => Hash::make('alumni123'),
            'survey_completed' => true,
            'add_info_completed' => true,
            'first_name' => 'alumni',
            'middle_name' => 'alumni',
            'last_name' => 'alumni',
            'birthday' => null,
            'age' => null,
            'civil_status' => null,
            'gender' => 'null',
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
            'password' => Hash::make('content_creator123'),
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
        /* INSERT USERS VALUES */

        /* INSERT SURVEY VALUES */
        DB::table('surveys_posted')->insert([
            'surveyAuthor' => 1,
            'surveyUpdateAuthor' => 1,
            'created_at' => now(),
            'updated_at' => now(),
            // Replace with the author's ID
            'surveyType' => 'built_in',
            'surveyTitle' => 'YourSurveyTitle',
            'surveyDesc' => 'YourSurveyDescription',
            // Add other fields with dummy values
        ]);

        DB::table('survey_questions')->insert([
            'parentSurvey' => 1,
            'created_at' => now(),
            'updated_at' => now(),
            // Assuming 1 is the ID of the survey
            'questionNum' => 1,
            'questionType' => 'dropdown',
            'questionDesc' => 'YourQuestionDescription',
            // Add other fields with dummy values
        ]);

        DB::table('survey_choices')->insert([
            'choiceNum' => 1,
            'created_at' => now(),
            'updated_at' => now(),
            'choiceDesc' => 'ChoiceDescription',
            'parentSurvey' => 1,
            // Assuming 1 is the ID of the survey
            'parentQuestion' => 1,
            // Assuming 1 is the ID of the question
            // Add other fields with dummy values
        ]);

        DB::table('survey_answers')->insert([
            'created_at' => now(),
            'updated_at' => now(),
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
        /* INSERT SURVEY VALUES */

        /* INSERT FORUM VALUES */
        DB::table('forums_posted')->insert([
            'forumTitle' => 'YourForumTitle',
            'forumBody' => 'YourForumBody',
            'forumCategory' => 'YourForumCategory',
            'forumAuthor' => 1,
            'forumUpdateAuthor' => 1,
            // Replace with the author's ID
            'active' => 1,
            // Set the active status as needed (0 for inactive)
        ]);

        // Insert into the 'forum_replies' table
        DB::table('forum_replies')->insert([
            'parentForum' => 1,
            // Replace with the parent forum
            'replyingTo' => null,
            // Replace with the ID of the message being replied to
            'replyBody' => 'This is the first reply',
            'replyAuthor' => 1,
            // Replace with the author's ID
            'active' => 1,
            // Set the active status as needed (0 for inactive)
        ]);

        DB::table('forum_replies')->insert([
            'parentForum' => 1,
            // Replace with the parent forum
            'replyingTo' => null,
            // Replace with the ID of the message being replied to
            'replyBody' => 'Nice forum bro',
            'replyAuthor' => 2,
            // Replace with the author's ID
            'active' => 1,
            // Set the active status as needed (0 for inactive)
        ]);
        /* INSERT FORUM VALUES */
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
