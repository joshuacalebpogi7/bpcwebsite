<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Models\forums_posted;
use App\Models\forum_replies;
use App\Models\User;

class EditForum extends Component
{

    public $user;
    public $author;
    public $forum_author;
    public $forum_selected;
    public $forum_reply_selected;
    public $replyBody;
    public $forumReplies = [];
    public $active;

    public function __construct()
    {
        $this->user = auth()->user();
    }
    public function mount($forum_selected)
    {
        $this->forum_selected = $forum_selected;

        // You can directly access the properties of $forum_selected
        $this->forumTitle = $forum_selected->forumTitle;
        $this->forumBody = $forum_selected->forumBody;
        $this->forumCategory = $forum_selected->forumCategory; // Assuming you want to load the category
    }

    public function editForumPost()
    {
        DB::beginTransaction();

        try {
            $this->forum_selected->update([
                'forumTitle' => $this->forumTitle,
                'forumBody' => $this->forumBody,
                'forumCategory' => $this->forumCategory,
                'forumUpdateAuthor' => $this->user->id,
                'active' => $this->active,
            ]);
            DB::commit();
            $this->resetForm();
        } catch (\Exception $e) {
            DB::rollback();
        }
    }

    private function resetForm()
    {
        $this->forumTitle = '';
        $this->forumBody = '';
        $this->forumCategory = '';
        $this->active = false;
        if ($this->user->user_type != "alumni") {
            return redirect('admin/forums');
        } elseif ($this->user->user_type == "alumni") {
            return redirect('forums');
        }

    }

    public function render(forums_posted $forum_selected)
    {
        return view('livewire.edit-forum', ['forum_selected' => $forum_selected]);
    }
}
