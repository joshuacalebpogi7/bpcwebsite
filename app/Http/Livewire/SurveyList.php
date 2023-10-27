<?php

// app/Http/Livewire/SurveyList.php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\surveys_posted; // Import the Survey model

class SurveyList extends Component
{
    public $survey_list;
    public $surveyTitle;
    public $surveyDesc;
    public $surveyLink;
    public $surveyEditorLink;
    public $active;

    public function render()
    {
        // Load the survey list from your database (adjust this query as needed)
        $this->survey_list = surveys_posted::all();
        
        return view('livewire.survey-list'); // Blade view name
    }

}