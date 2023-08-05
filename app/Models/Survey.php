<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    use HasFactory;

    public function surveyQuestions()
    {
        return $this->hasMany(SurveyQuestion::class, 'survey_id');
    }
}