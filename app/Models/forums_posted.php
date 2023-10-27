<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class forums_posted extends Model
{
    protected $table = 'forums_posted'; // Specify the table name
    use HasFactory;
    protected $fillable = [
        "forumTitle",
        "forumBody",
        "forumAuthor",
        "active",
    ];

    // forums_posted.php (forums_posted model)
    public function replies()
    {
        return $this->hasMany(forum_replies::class, 'parentForum', 'id');
    }

}
