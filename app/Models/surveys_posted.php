<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class surveys_posted extends Model
{
    use HasFactory;

    protected $table = 'surveys_posted'; // Specify the table name

    protected $fillable = [
        'surveyType',
        'surveyTitle',
        'surveyDesc',
        'surveyLink',
        'surveyEditorLink',
        'active'
    ];

    public function survey_questions()
    {
        return $this->hasMany(survey_questions::class, 'parentSurvey', 'id');
    }
}