<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Models\surveys_posted;
use App\Models\survey_questions;
use App\Models\survey_choices;

class NewSurvey extends Component
{
    public $surveyType = '';
    public $surveyTitle;
    public $surveyDesc;
    public $surveyLink;
    public $surveyEditorLink;
    public $active = false;
    public $questions = [];


    public function __construct()
    {
        parent::__construct();

        // Initialize the questions array with an initial question
        $this->questions[] = [
            'questionNum' => 1,
            'questionDesc' => '',
            'questionType' => 'text',
            'choices' => [
                [
                    'choiceNum' => 1,
                    'questionNum' => 1,
                    'choiceDesc' => '',
                ],
            ],
        ];
    }

    public function addQuestion()
    {
        $questionNum = count($this->questions) + 1;
        $this->questions[] = [
            'questionNum' => $questionNum,
            'questionDesc' => '',
            'questionType' => 'text',
            'choices' => [
                [
                    'choiceNum' => 1,
                    'questionNum' => $questionNum,
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
        $questionNum = $this->questions[$questionIndex]['questionNum'];
        $choiceNum = count($this->questions[$questionIndex]['choices']) + 1;
        
        $this->questions[$questionIndex]['choices'][] = [
            'questionNum' => $questionNum,
            'choiceNum' => $choiceNum, // Add choiceNum here
            'choiceDesc' => '',
        ];
    }
    

    public function removeChoice($questionIndex, $choiceIndex)
    {
        unset($this->questions[$questionIndex]['choices'][$choiceIndex]);
        $this->questions[$questionIndex]['choices'] = array_values($this->questions[$questionIndex]['choices']);
    }

    public function saveBuiltIn()
{
    // Start a database transaction
    //DB::beginTransaction();

    //try {
        // Create the survey and get its ID
        $questionnaire = surveys_posted::create([
            'surveyType' => 'built_in',
            'surveyTitle' => $this->surveyTitle,
            'authorID' => auth()->user()->id,
            'surveyDesc' => $this->surveyDesc,
            'active' => $this->active,
        ]);

        if (!$questionnaire) {
            throw new \Exception('Failed to create the survey.');
        }

        foreach ($this->questions as $questionData) {
            // Create a new question associated with the survey
            $question = survey_questions::create([
                'parentSurvey' => $questionnaire->id,
                'questionNum' => $questionData['questionNum'],
                'questionDesc' => $questionData['questionDesc'],
                'questionType' => $questionData['questionType'],
            ]);

            if (!$question) {
                throw new \Exception('Failed to create a question.');
            }

            foreach ($questionData['choices'] as $choiceData) {
                // Create choices associated with the question
                $choice = survey_choices::create([
                    'parentSurvey' => $questionnaire->id,
                    'parentQuestion' => $question->id,
                    'choiceNum' => $choiceData['choiceNum'],
                    'choiceDesc' => $choiceData['choiceDesc'],
                ]);

                if (!$choice) {
                    throw new \Exception('Failed to create a choice.');
                }
            }
        }

        // Commit the transaction upon successful query
        DB::commit();

        // Reset the form upon successful query
        $this->resetForm();
    //}
    /*
    catch (\Exception $e) {
        // Rollback the transaction in case of any errors
        DB::rollback();

        // Handle the error, log it, or display a message to the user
        // You can add your error handling logic here
    }
    */
}


    private function resetForm()
    {
        $this->surveyTitle = '';
        $this->surveyDesc = '';
        $this->active = false;
        $this->questions = [];
        return redirect()->to('admin/surveys');
    }

    public function saveGForm()
    {
        // Initialize an error message variable
        $errorMessage = '';
    
        // Start a database transaction
        DB::beginTransaction();
    
        try {
            // Create the survey and get its ID
            $questionnaire = surveys_posted::create([
                'surveyType' => 'google_forms',
                'surveyTitle' => $this->surveyTitle,
                'surveyDesc' => $this->surveyDesc,
                'surveyLink' => $this->surveyLink,
                'surveyEditorLink' => $this->surveyEditorLink,
                'active' => $this->active,
            ]);
    
            // Commit the transaction
            DB::commit();
    
            // Reset the form upon successful query
            $this->resetGForm();
            
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

    private function resetGForm()
    {
        $this->surveyTitle = '';
        $this->surveyDesc = '';
        $this->surveyLink = '';
        $this->surveyEditorLink = '';
        $this->active = false;
        return redirect()->to('admin/surveys');
    }

    public function render()
    {
        return view('livewire.new-survey');
    }
}
