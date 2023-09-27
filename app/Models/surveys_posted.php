<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class surveys_posted extends Model
{
    use HasFactory;

    protected $fillable = [
        //'surveyID',
        'surveyTitle',
        'surveyDesc',
        'active'
    ];
}