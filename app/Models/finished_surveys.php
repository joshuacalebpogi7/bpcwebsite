<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class finished_surveys extends Model
{
    protected $table = 'finished_surveys'; // Specify the table name
    use HasFactory;
    protected $fillable = [
        "parentSurvey",
        "respondentID",
    ];
}
