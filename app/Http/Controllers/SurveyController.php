<?php

namespace App\Http\Controllers;

use App\Models\survey_answers;
use Illuminate\Http\Request;
use App\Models\surveys_posted;
use App\Models\survey_questions;
use App\Models\survey_choices;

class SurveyController extends Controller
{
    public function fetchSurveyToBeEdited(surveys_posted $survey_selected)
    {
        return view('admin.edit_survey', [
            'survey_selected' => $survey_selected
        ]);
    }


    public function fetchSurveyToBeAnswered(surveys_posted $survey_selected, /*survey_questions $survey_questions, survey_choices $survey_choices*/)
    {
        return view('auth.answer_survey', [
            'survey_selected' => $survey_selected,
            /*'survey_questions' => $survey_questions,
            'survey_choices' => $survey_choices*/

        ]);
    }


    /*
    public function fetchSurveyToBeDeleted(surveys_posted $survey_selected)
    {
        return view ('delete_survey', ['survey_selected' => $survey_selected]);
    }
    */
    public function deleteSurvey($surveyId)
    {
        // Find the survey to be deleted
        $survey = surveys_posted::find($surveyId);

        // Check if the survey exists
        if (!$survey) {
            // Optionally, you can handle the case where the survey doesn't exist
            return back()->with('error', 'Survey not found.');
        }

        // Delete related survey questions and choices
        survey_questions::where('parentSurvey', $surveyId)->delete();
        survey_choices::where('parentSurvey', $surveyId)->delete();

        // Delete the survey itself
        $survey->delete();

        // Optionally, you can redirect back to the survey list with a success message
        return back()->with('success', 'Survey deleted successfully.');
    }

    public function deleteAnswer($respondentID)
    {
        // Find the answers to be deleted
        $answers = survey_answers::where('respondentID', $respondentID)->get();

        // Check if the survey exists
        if (!$answers) {
            // Optionally, you can handle the case where the survey doesn't exist
            return back()->with('error', 'Survey not found.');
        }

        // Delete the answer itself
        foreach ($answers as $answer) {
            $answer->delete();
        }
        // Optionally, you can redirect back to the survey list with a success message
        return back()->with('success', 'Survey deleted successfully.');
    }
}
