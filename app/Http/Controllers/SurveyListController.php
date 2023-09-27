<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\surveys_posted;
use App\Models\selected_survey;

use Illuminate\Http\Request as Request1;
use Illuminate\Http\Request as Request2;


class SurveyListController extends Controller
{
    //List Surveys
    public function list_survey(Request1 $request)
    {
        return view('posted_surveys', ['survey_list' => surveys_posted::all()]);
    }

    public function admin_survey(Request1 $request)
    {
        return view('admin_survey', ['survey_details' => selected_survey::all()]);
    }

    public function admin_survey_selected($id)
    {
        $selected_survey = surveys_posted::find($id);
    }


    public function hybridSurveyRequest(Request2 $request2)
    {
        // Check conditions or data to determine the action
        if ($request2->has('type') && $request2->input('type') === 'built_in') {
            
            $newsurveys_posted = new surveys_posted;
            /*
            $current_date = Carbon::now('utc')->toDateTimeString();
            $created_at = $current_date;
            $updated_at = $current_date;
            $newsurveys_posted->created_at = $created_at;
            */
            
            $newsurveys_posted->surveyTitle = $request2->surveyTitleInput;
            $newsurveys_posted->surveyDesc = $request2->surveyDescInput;
            $newsurveys_posted->save();
            $inserted_id = $newsurveys_posted->id;
    
            //SPECIFIC TABLE INSERT
            /*
            DB::table('surveys_posteds')->insert([
                //'id' => $request->id()
                'surveyTitle' => $request->surveyTitleInput,
                'surveyDesc' => $request->surveyDescInput,
                'created_at' => $created_at,
            ]);
            */
    
            //$last_id = DB::getPdo()->lastInsertId();
            
            foreach($request2->surveyQuestionInput as $questionInput){
               foreach($request2->surveyQuestionType as $questionType)
               {
                 DB::table('survey_questions')->insert([
                     'surveyID' => $inserted_id,
                     'questionDesc' => $questionInput,
                     'questionType' => $questionType
                 ]);
            }
            
        }
            return redirect('posted_surveys');
        } 
        
        if ($request2->has('type') && $request2->input('type') === 'google_forms') {

            $newsurveys_posted = new surveys_posted;
            /*
            $current_date = Carbon::now('utc')->toDateTimeString();
            $created_at = $current_date;
            $updated_at = $current_date;
            $newsurveys_posted->created_at = $created_at;
            */
            
            $newsurveys_posted->surveyTitle = $request2->surveyTitleInput;
            $newsurveys_posted->surveyDesc = $request2->surveyDescInput;
            $newsurveys_posted->surveyLink = $request2->surveyLinkInput;
            $newsurveys_posted->save();
            $inserted_id = $newsurveys_posted->id;

            return redirect('posted_surveys');

        }
        
        // Redirect or return a response based on the action
        // Your code here
    }

    }
