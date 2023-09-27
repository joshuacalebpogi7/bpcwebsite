<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class survey_questions extends Model
{
    use HasFactory;
    protected $fillable = [
        'surveyID',
        'questionID',
        'questionNum',
        'questionType',
        'questionDesc'
    ];

}