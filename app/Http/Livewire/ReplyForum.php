<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Models\forums_posted;
use App\Models\forum_replies;
use App\Models\User;

class ReplyForum extends Component
{

    public $user;
    public $forum_author;
    public $forum_selected;
    public $forum_reply_selected;
    public $forum_reply_author;
    public $replyBody;
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
        $this->forum_reply_author = User::where('id', $this->forum_reply_selected->replyAuthor)->first();
    }

    public function replyForum()
    {
        DB::beginTransaction();

        try {
            forum_replies::create([
                'parentForum' => $this->forum_selected->id,
                'replyingTo' => $this->forum_reply_selected->id,
                'replyBody' => $this->replyBody,
                'replyAuthor' => auth()->user()->id,
                'active' => true,
            ]);
            DB::commit();
            $this->resetForm();
        } catch (\Exception $e) {
            DB::rollback();
        }
    }

    private function resetForm()
    {
        $this->replyBody = '';
        if (auth()->user()->user_type != "alumni") {
            return redirect("/admin/view_forum/{$this->forum_selected->id}");
        } elseif (auth()->user()->user_type == "alumni") {
            return redirect("/view_forum/{$this->forum_selected->id}");
        }


    }

    public function render(forums_posted $forum_selected, forum_replies $forum_reply_selected)
    {
        return view('livewire.reply-forum', ['forum_reply_selected' => $forum_reply_selected, 'forum_selected' => $forum_selected]);
    }
}
