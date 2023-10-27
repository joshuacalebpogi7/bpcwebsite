<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\surveys_posted;
use App\Models\survey_questions;
use App\Models\survey_choices;
use App\Models\survey_answers;
use App\Models\finished_surveys;
use Illuminate\Support\Facades\DB;

class AnswerSurvey extends Component
{
    public $survey_selected;
    public $surveyType;
    public $surveyTitle;
    public $surveyDesc;
    public $surveyLink;
    public $surveyEditorLink;
    public $active;
    public $questions = [];
    public $answers = [];
    public $insertQuestions = [];


    public $questionsToBeDeleted = [];

    public $choicesToBeDeleted = [];

    public function mount($survey_selected)
    {
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
                    'id' => $question->id,
                    'questionNum' => $question->questionNum,
                    'questionType' => $question->questionType,
                    'questionDesc' => $question->questionDesc,
                    'choices' => $choices->toArray(),
                ];

                /*                 $questionsArray = $this->questions->map(function ($question) {
                                    $questionArray = $question->toArray(); // Convert the question to an array
                                    $questionArray['choices'] = $question->choices->toArray(); // Convert choices to an array
                                    return $questionArray;
                                })->toArray(); */

            }
        } elseif ($this->surveyType === 'google_forms') {
            // Handle Google Forms case if needed
        }
    }

    public function answerBuiltIn()
    {
        foreach ($this->questions as $question) {
            foreach ($question["answers"] as $answerIndex => $answer) {
                if ($question["questionType"] === "text") {
                    $choices = survey_choices::where('parentSurvey', $this->survey_selected->id)
                        ->where('parentQuestion', $question["id"])
                        ->get();

                    $textChoiceID = null;

                    // Assuming you want to associate choiceID with the index of answers
                    if (isset($choices[$answerIndex])) {
                        $textChoiceID = $choices[$answerIndex]->id;
                    }

                    survey_answers::create([
                        'answerDesc' => $answer['answerDesc'],
                        'choiceID' => $textChoiceID,
                        'respondentID' => auth()->user()->id,
                        'parentSurvey' => $this->survey_selected->id,
                        'questionAnswered' => $question["id"],
                    ]);
                } elseif ($question["questionType"] === "radio") {
                    $choiceData = survey_choices::where('id', $answer['choiceID'])->first();
                    $choiceDesc = $choiceData["choiceDesc"];
                    $current_answer = survey_answers::create([
                        'answerDesc' => $choiceDesc,
                        'choiceID' => $answer["choiceID"],
                        'respondentID' => auth()->user()->id,
                        'parentSurvey' => $this->survey_selected->id,
                        'questionAnswered' => $question["id"],
                    ]);
                } elseif ($question["questionType"] === "checkbox") {
                    $choiceData = survey_choices::where('id', $answer['choiceID'])->first();
                    $choiceDesc = $choiceData["choiceDesc"];
                    $current_answer = survey_answers::create([
                        'answerDesc' => $choiceDesc,
                        'choiceID' => $answer["choiceID"],
                        'respondentID' => auth()->user()->id,
                        'parentSurvey' => $this->survey_selected->id,
                        'questionAnswered' => $question["id"],
                    ]);
                }
            }
        }
        finished_surveys::create([
            "parentSurvey" => $this->survey_selected->id,
            'respondentID' => auth()->user()->id,
        ]);
        $user = auth()->user();
        $user->survey_completed = true;
        $user->save();
        $this->resetForm();
    }


    private function resetForm()
    {
        $this->answers = [];
        return redirect()->to('/');
    }

    public function answerGoogleForms()
    {
        survey_answers::create([
            'answerDesc' => "Google Forms Confirm",
            'choiceID' => null,
            'respondentID' => auth()->user()->id,
            'parentSurvey' => $this->survey_selected->id,
            'questionAnswered' => null,
        ]);
    }



    public function render(surveys_posted $survey_selected)
    {
        return view('livewire.answer-survey', ['survey_selected' => $survey_selected]);
    }
}