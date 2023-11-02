<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class forum_votes extends Model
{
    use HasFactory;

    protected $fillable = [
        "parentForum",
        "parentReply",
        "voteType",
        "voteAuthor",
        "active",
    ];
}
