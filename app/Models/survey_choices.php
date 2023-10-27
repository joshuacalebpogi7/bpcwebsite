<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class survey_choices extends Model
{
    use HasFactory;

    protected $fillable = [
        'parentSurvey',
        'parentQuestion',
        'choiceNum',
        'choiceDesc'
    ];

    public function survey_question()
    {
        return $this->belongsTo(survey_questions::class, 'parentQuestion', 'questionNum');
    }
}
