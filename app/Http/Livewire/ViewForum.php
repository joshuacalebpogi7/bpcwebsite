<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\forums_posted;
use App\Models\forum_replies;

class ViewForum extends Component
{
    public $user;
    public $forum_selected;
    public $forumTitle;
    public $forumBody;
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

        // You can directly access the properties of $survey_selected
        $this->forumTitle = $forum_selected->forumTitle;
        $this->forumBody = $forum_selected->forumBody;
        $this->active = $forum_selected->active;
        $replies = forum_replies::where('parentForum', $this->forum_selected->id)->get();
        $this->forumReplies = $replies;
    }

    public function replyForum()
    {
    }

    public function render(forums_posted $forum_selected)
    {
        return view('livewire.view-forum', ['forum_selected' => $forum_selected]);
    }
}
