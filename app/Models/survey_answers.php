<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class survey_answers extends Model
{
    use HasFactory;

    protected $fillable = [
        "answerDesc",
        "choiceID",
        "respondentID",
        "parentSurvey",
        "questionAnswered",

    ];
}
