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
    public $forum_votes;
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
        $this->forum_votes = forum_votes::all();
    }

    public function upvoteComment($commentId)
    {
        $user = auth()->user();
        $forumVote = forum_votes::where('parentForum', $this->forum_selected->id)
            ->where('parentReply', $commentId)
            ->where('voteAuthor', $user->id)
            ->first();

        if ($forumVote) {
            // If the user has already upvoted, delete the upvote
            $forumVote->delete();
        } else {
            // If the user hasn't upvoted, create an upvote record
            forum_votes::create([
                'parentForum' => $this->forum_selected->id,
                'parentReply' => $commentId,
                'voteType' => 'upvote',
                'voteAuthor' => $user->id,
                'active' => true,
            ]);
        }
        $this->updateVoteStatus($commentId, $user->id);
    }

    public function downvoteComment($commentId)
    {
        $user = auth()->user();
        $forumVote = forum_votes::where('parentForum', $this->forum_selected->id)
            ->where('parentReply', $commentId)
            ->where('voteAuthor', $user->id)
            ->first();

        if ($forumVote) {
            // If the user has already voted, toggle between upvote and downvote
            if ($forumVote->voteType === 'upvote') {
                $forumVote->update(['voteType' => 'downvote']);
            } else {
                $forumVote->delete();
            }
        } else {
            // If the user hasn't downvoted, create a downvote record
            forum_votes::create([
                'parentForum' => $this->forum_selected->id,
                'parentReply' => $commentId,
                'voteType' => 'downvote',
                'voteAuthor' => $user->id,
                'active' => true,
            ]);
        }
        $this->updateVoteStatus($commentId, $user->id);
    }

    private function updateVoteStatus($commentId, $userId)
    {
        $forumReplies = forum_replies::all();
        $comment = $forumReplies->firstWhere('id', $commentId);

        if ($comment) {
            $comment->hasUpvoted = forum_votes::where('parentForum', $this->forum_selected->id)
                ->where('parentReply', $commentId)
                ->where('voteType', 'upvote')
                ->where('voteAuthor', $userId)
                ->exists();

            $comment->hasDownvoted = forum_votes::where('parentForum', $this->forum_selected->id)
                ->where('parentReply', $commentId)
                ->where('voteType', 'downvote')
                ->where('voteAuthor', $userId)
                ->exists();
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
