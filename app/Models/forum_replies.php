<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\forum_votes;

class forum_replies extends Model
{
    use HasFactory;

    protected $fillable = [
        "parentForum",
        "replyingTo",
        "replyBody",
        "replyAuthor",
        "votes",
        "active",
    ];

    // ForumReplies.php
public function votes()
{
    return $this->hasMany(forum_votes::class, 'parentReply');
}

public function forum()
{
    return $this->belongsTo(forums_posted::class, 'parentForum', 'id');
}
}
