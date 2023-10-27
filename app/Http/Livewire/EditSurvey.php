<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\surveys_posted;
use App\Models\survey_questions;
use App\Models\survey_choices;
use Illuminate\Support\Facades\DB;


class EditSurvey extends Component
{
    public $survey_selected;
    public $surveyType;
    public $surveyTitle;
    public $surveyDesc;
    public $surveyLink;
    public $surveyEditorLink;
    public $active;
    public $all_surveys = [];
    public $questions = [];

    public function mount($survey_selected)
{
    //$this->refreshView = $refreshView;
    $this->loadSurveyData($survey_selected);
}

public function updatedSurveySelected($newValue)
{
    $this->loadSurveyData($newValue);
}

private function loadSurveyData($survey_selected)
{
    // Set the record instance
    $this->survey_selected = $survey_selected;

    // You can directly access the properties of $survey_selected
    $this->surveyTitle = $survey_selected->surveyTitle;
    $this->surveyDesc = $survey_selected->surveyDesc;
    $this->surveyType = $survey_selected->surveyType;
    $this->surveyLink = $survey_selected->surveyLink;
    $this->surveyEditorLink = $survey_selected->surveyEditorLink;
    $this->active = $survey_selected->active;

    // Load questions based on surveyID if the surveyType is 'built_in'
    if ($this->surveyType === 'built_in') {
        $questions = survey_questions::where('parentSurvey', $this->survey_selected->id)->get();

        // Loop through questions and load choices for each question
        foreach ($questions as $question) {
            $choices = survey_choices::where('parentSurvey', $this->survey_selected->id)
                ->where('parentQuestion', $question->id)
                ->get();

            // Add choices to the question
            $question->choices = $choices;

            // Add the question to the $questions array
            $this->questions[] = [
                'questionID' => $question->id,
                'questionNum' => $question->questionNum,
                'questionType' => $question->questionType,
                'questionDesc' => $question->questionDesc,
                'choices' => $choices->toArray(),
            ];
        }
    } elseif ($this->surveyType === 'google_forms') {
        // Handle Google Forms case if needed
    }
}

public function updateBuiltIn()
{
    // Validate the form data
    $this->validate([
        'surveyTitle' => 'required|string',
        // Add validation rules for other fields as needed
    ]);

    // Update the surveys_posted record
    $this->survey_selected->update([
        'surveyTitle' => $this->surveyTitle,
        'surveyDesc' => $this->surveyDesc,
        'active' => $this->active,
    ]);

    // Update or create survey_questions and survey_choices
    foreach ($this->questions as $questionData) {
        // Update or create the question based on parentSurvey and questionNum
        $question = survey_questions::updateOrCreate(
            [
                'parentSurvey' => $this->survey_selected->id,
                'questionNum' => $questionData['questionNum'],
            ],
            [
                'questionDesc' => $questionData['questionDesc'],
                'questionType' => $questionData['questionType'],
            ]
        );
        // Update or create choices for the question
        foreach ($questionData['choices'] as $choiceData) {
            survey_choices::updateOrCreate(
                [
                    'parentSurvey' => $this->survey_selected->id,
                    'parentQuestion' => $questionData["questionID"],
                    'choiceNum' => $choiceData['choiceNum'],
                ],
                [
                    'choiceDesc' => $choiceData['choiceDesc'],
                ]
            );
        }
    }
    // Redirect or display a success message
    session()->flash('message', 'Survey updated successfully.');
    return redirect()->route('survey'); // Replace with the appropriate route name
}



    public function updateGoogleForms()
    {
        // Handle form submission for 'google_forms' survey type
        // Update the database with the updated survey data
        // Redirect or display a success message
        // Validate the form data (you can add validation rules as needed)
        $this->validate([
            'surveyTitle' => 'required|string',
            // Add validation rules for other fields as needed
        ]);

        // Update the surveys_posted record
        $this->survey_selected->update([
            'surveyTitle' => $this->surveyTitle,
            'surveyDesc' => $this->surveyDesc,
            'surveyLink' => $this->surveyLink,
            'surveyEditorLink' => $this->surveyEditorLink,
            'active' => $this->active,
        ]);

        // Redirect or display a success message
        session()->flash('message', 'Survey updated successfully.');
        return redirect()->route('survey'); // Replace with the appropriate route name
    }



    public function render(surveys_posted $survey_selected)
    {
        return view('livewire.edit-survey', ['survey_selected' => $survey_selected]);
    }
}