<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Models\forums_posted;
use App\Models\forum_replies;
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
    public $commentBody;
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
        $this->forumAuthorId = $forum_selected->forumAuthor;
        $this->forumAuthor = User::where('id', $this->forumAuthorId)->first();

        // Retrieve the forum replies
        $replies = forum_replies::where('parentForum', $this->forum_selected->id)->get();
        $this->forumReplies = $replies;

        // Retrieve the authors of forum replies
        $authorIds = $replies->pluck('replyAuthor');
        $this->authors = User::whereIn('id', $authorIds)->get();
    }


    public function commentForum()
    {
        /* DB::beginTransaction();

        try { */
        dd($this->replyBody);
        forum_replies::create([
            'parentForum' => $this->forum_selected->id,
            'replyingTo' => null,
            'replyBody' => $this->commentBody,
            'replyAuthor' => auth()->user()->id,
            'active' => true,
        ]);
        // DB::commit();
        //$this->resetForm();
        /* 
} catch (\Exception $e) {
DB::rollback();
} */
    }

    private function resetForm()
    {
        $this->commentBody = '';
        return redirect("/admin/view_forum/{$this->forum_selected->id}");


    }

    public function render(forums_posted $forum_selected)
    {
        return view('livewire.view-forum', ['forum_selected' => $forum_selected]);
    }
}
