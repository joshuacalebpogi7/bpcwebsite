<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\forums_posted;
use App\Models\forum_replies;
use App\Models\User;

class ReplyForum extends Component
{

    public $user;
    public $authors;
    public $forum_selected;
    public $forumTitle;
    public $forumBody;
    public $forumCategory;
    public $forumReplies = [];
    public $active;

    public function __construct()
    {
        $this->user = auth()->user();
    }
    public function mount($forum_selected)
    {
        $this->loadForumData($forum_selected);
    }

    public function updatedForumSelected($newValue)
    {
        $this->loadForumData($newValue);
    }

    private function loadForumData($forum_selected)
    {
        // Set the record instance
        $this->forum_selected = $forum_selected;

        // You can directly access the properties of $forum_selected
        $this->forumTitle = $forum_selected->forumTitle;
        $this->forumBody = $forum_selected->forumBody;
        $this->forumCategory = $forum_selected->forumCategory; // Assuming you want to load the category

        // Retrieve the forum replies
        $replies = forum_replies::where('parentForum', $this->forum_selected->id)->get();
        $this->forumReplies = $replies;

        // Retrieve the authors of forum replies
        $authorIds = $replies->pluck('replyAuthor');
        $this->authors = User::whereIn('id', $authorIds)->get();
    }


    public function replyForum()
    {
    }

    public function render(forum_replies $forum_reply_selected)
    {
        return view('livewire.reply-forum', ['forum_reply_selected' => $forum_reply_selected]);
    }
}
