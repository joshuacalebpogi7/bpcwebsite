<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logs extends Model
{
    use HasFactory;

    protected $fillable = [
        "log_author",
        "logged_first_name",
        "logged_last_name",
        "loggedBody",
    ];
}
