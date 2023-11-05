<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\surveys_posted;
use App\Models\survey_questions;
use App\Models\survey_choices;
use App\Models\survey_answers;

class ViewSurvey extends Component
{

    public $user;
    public $surveyType = '';
    public $surveyTitle;
    public $surveyDesc;
    public $surveyLink;
    public $surveyEditorLink;
    public $active;
    public $forFirstTimers;
    public $survey_questions;
    public $survey_choices;
    public $survey_answers;

    public function __construct()
    {
        $this->user = auth()->user();
    }

    public function mount($survey_selected)
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
        $this->forFirstTimers = $survey_selected->forFirstTimers;
        $this->survey_questions = survey_questions::where('parentSurvey', $this->survey_selected->id)->get();
        $this->survey_answers = survey_answers::where('parentSurvey', $this->survey_selected->id)->get();

    }

    public function render(surveys_posted $survey_selected, survey_questions $survey_questions, survey_choices $survey_choices, survey_answers $survey_answers)
    {
        return view('livewire.view-survey', ['survey_selected' => $survey_selected, 'survey_questions' => $survey_questions, 'survey_choices' => $survey_choices, 'survey_answers' => $survey_answers]);
    }
}
