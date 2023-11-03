<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Models\forums_posted;
use App\Models\forum_replies;
use App\Models\forum_votes;
use App\Models\User;

class ViewForum extends Component
{
    public $user;
    public $authors;
    public $forum_selected;
    public $forumTitle;
    public $forumBody;
    public $forumAuthorId;
    public $forumAuthor;
    public $replyBody;
    public $commentBody;
    public $forumCategory;
    public $forumReplies = [];
    public $forum_replies = [];
    public $forumVotes;
    public $active;

    public function __construct()
    {
        $this->user = auth()->user();
    }
    public function mount($forum_selected)
    {
        // Set the record instance
        $this->forum_selected = $forum_selected;

        // You can directly access the properties of $forum_selected
        $this->forumTitle = $forum_selected->forumTitle;
        $this->forumBody = $forum_selected->forumBody;
        $this->forumCategory = $forum_selected->forumCategory; // Assuming you want to load the category
        $this->forumAuthorId = $forum_selected->forumAuthor;
        $this->forumAuthor = User::where('id', $this->forumAuthorId)->first();

        // Retrieve the forum replies
        $replies = forum_replies::where('parentForum', $this->forum_selected->id)->get();
        $this->forumReplies = $replies;

        // Retrieve the authors of forum replies
        $authorIds = $replies->pluck('replyAuthor');
        $this->authors = User::whereIn('id', $authorIds)->get();
        //$forumReplies = forum_replies::all();

        foreach ($this->forumReplies as $forumReply) {
            $forumReply->upvoteCount = forum_votes::where('parentReply', $forumReply->id)
                ->where('voteType', 'upvote')
                ->count();

            $forumReply->downvoteCount = forum_votes::where('parentReply', $forumReply->id)
                ->where('voteType', 'downvote')
                ->count();
        }
    }

    private function resetForm()
    {
        $this->replyBody = '';
        return redirect("/admin/view_forum/{$this->forum_selected->id}");


    }

    /*     public function render(forums_posted $forum_selected, forum_replies $forumReplies)
        {
            $this->forumReplies = forum_replies::all();
            return view('livewire.view-forum', ['forum_selected' => $forum_selected, 'forumReplies' => $forumReplies]);
        } */

    public function render()
    {
        $forumReplies = forum_replies::all();
        $forum_selected = forums_posted::all();
        return view('livewire.view-forum')
            ->with('forumReplies', $forumReplies)
            ->with('forum_selected', $forum_selected);
    }
}
