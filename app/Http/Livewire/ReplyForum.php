<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\forums_posted;
use App\Models\forum_replies;
use App\Models\User;

class ReplyForum extends Component
{

    public $user;
    public $author;
    public $forum_author;
    public $forum_selected;
    public $forum_reply_selected;
    public $forumReplies = [];
    public $active;

    public function __construct()
    {
        $this->user = auth()->user();
    }
    public function mount($forum_reply_selected)
    {
        // Set the record instance
        $this->forum_selected = forums_posted::where('id', $this->forum_reply_selected->parentForum)->first();
        $this->forum_author = User::where('id', $this->forum_selected->forumAuthor)->first();
        $this->forum_reply_selected = $forum_reply_selected;
        $this->author = User::where('id', $this->forum_reply_selected->replyAuthor)->first();
    }

    public function replyForum()
    {
    }

    public function render(forum_replies $forum_reply_selected)
    {
        return view('livewire.reply-forum', ['forum_reply_selected' => $forum_reply_selected]);
    }
}
