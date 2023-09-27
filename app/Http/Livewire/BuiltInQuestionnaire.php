<?php

namespace App\Http\Livewire;

// app/Http/Livewire/Questionnaire.php

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Models\surveys_posted;
use App\Models\survey_questions;
use App\Models\survey_choices;

class BuiltInQuestionnaire extends Component
{
    public $surveyTitle;
    public $surveyDesc;
    public $active = false;
    public $questions = [];

    public function updatedSelectedSurveyType($value)
    {
        // Handle changes to the selected survey type here
    }


    public function __construct()
    {
        parent::__construct();

        // Initialize the questions array with an initial question
        $this->questions[] = [
            'questionNum' => count($this->questions) + 1,
            'questionDesc' => '',
            'questionType' => 'text',
            'choices' => [
                [
                    'choiceID' => '',
                    'questionNum' => count($this->questions) + 1,
                    'choiceDesc' => '',
                ],
            ],
        ];
    }

    public function addQuestion()
    {
        $this->questions[] = [
            'questionNum' => count($this->questions) + 1,
            'questionDesc' => '',
            'questionType' => 'text',
            'choices' => [
                [
                    'choiceID' => '',
                    'questionNum' => count($this->questions) + 1,
                    'choiceDesc' => '',
                ],
            ],
        ]; // Default choice type is 'text'
    }


    public function removeQuestion($questionIndex)
    {
        unset($this->questions[$questionIndex]);
        $this->questions = array_values($this->questions);
    }

    public function addChoice($questionIndex)
    {
        $this->questions[$questionIndex]['choices'][] = [
            'choiceID' => '',
            'questionNum' => count($this->questions),
            'choiceDesc' => '',
        ];

    }

    public function removeChoice($questionIndex, $choiceIndex)
    {
        unset($this->questions[$questionIndex]['choices'][$choiceIndex]);
        $this->questions[$questionIndex]['choices'] = array_values($this->questions[$questionIndex]['choices']);
    }

    public function save()
    {
        // Initialize an error message variable
        $errorMessage = '';
    
        // Start a database transaction
        DB::beginTransaction();
    
        try {
            // Create the survey and get its ID
            $questionnaire = surveys_posted::create([
                'surveyTitle' => $this->surveyTitle,
                'surveyDesc' => $this->surveyDesc,
                'active' => $this->active,
            ]);
    
            foreach ($this->questions as $questionData) {
                // Create a new question associated with the survey
                $question = survey_questions::create([
                    'surveyID' => $questionnaire->id,
                    'questionNum' => count($this->questions),
                    'questionDesc' => $questionData['questionDesc'],
                    'questionType' => $questionData['questionType'],
                ]);
    
                foreach ($questionData['choices'] as $choiceData) {
                    // Create choices associated with the question
                    survey_choices::create([
                        'surveyID' => $questionnaire->id,
                        'questionID' => $question->id,
                        'questionNum' => count($this->questions),
                        'choiceDesc' => $choiceData['choiceDesc'],
                    ]);
                }
            }
    
            // Commit the transaction
            DB::commit();
    
            // Reset the form upon successful query
            $this->resetForm();
            
        } catch (\Exception $e) {
            // Rollback the transaction in case of any errors
            DB::rollBack();
    
            // Handle the error, log it, or display a message to the user
            // You can add your error handling logic here
            $errorMessage = 'An error occurred while saving the survey. Please try again.';
        }
    
        // Optionally, you can display the error message if there was an issue
        if (!empty($errorMessage)) {
            // You can use this error message in your Blade template to show an alert to the user.
            // For example: $this->errorMessage = $errorMessage;
        }
    }
    
    private function resetForm()
    {
        $this->surveyTitle = '';
        $this->surveyDesc = '';
        $this->active = false;
        $this->questions = [];
        return redirect()->to('/posted_surveys');
    }
    

    public function render()
    {
        return view('livewire.built-in-questionnaire');
    }
}