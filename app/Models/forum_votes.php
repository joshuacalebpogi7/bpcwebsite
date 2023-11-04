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

    public function forum()
    {
        return $this->belongsTo(forums_posted::class, 'parentForum', 'id');
    }

    public function replies()
    {
        return $this->belongsTo(forum_replies::class, 'parentReply', 'id');
    }

}
