<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class survey_questions extends Model
{
    use HasFactory;
    protected $fillable = [
        'parentSurvey',
        //'questionID',
        'questionNum',
        'questionType',
        'questionDesc'
    ];

    public function survey_posted()
    {
        return $this->belongsTo(surveys_posted::class, 'parentSurvey', 'id');
    }

    public function survey_choices()
    {
        return $this->hasMany(survey_choices::class, 'parentQuestion', 'questionNum');
    }
}