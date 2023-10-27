<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class forum_replies extends Model
{
    use HasFactory;

    protected $fillable = [
        "parentForum",
        "replyingTo",
        "replyBody",
        "authorID",
        "active",
    ];
}
