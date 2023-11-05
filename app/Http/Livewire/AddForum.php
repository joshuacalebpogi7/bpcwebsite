<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Models\forums_posted;
use App\Models\forum_replies;
use App\Models\Logs;

class AddForum extends Component
{
    public $user;
    public $forumTitle;
    public $forumBody;
    public $forumCategory = "General Discussion";
    public $active = false;

    public function __construct()
    {
        $this->user = auth()->user();
    }

    public function createForumPost()
    {
        // Start a database transaction
        DB::beginTransaction();

        try {
            // Create the survey and get its ID
            $new_forum = forums_posted::create([
                'forumTitle' => $this->forumTitle,
                'forumBody' => $this->forumBody,
                'forumCategory' => $this->forumCategory,
                'forumAuthor' => $this->user->id,
                'forumUpdateAuthor' => $this->user->id,
                'active' => $this->active,
            ]);

            if ($new_forum) {
                $log_forum = Logs::create([
                    'log_author' => $this->user->id,
                    'logged_first_name' => $this->user->first_name,
                    'logged_last_name' => $this->user->last_name,
                    'loggedBody' => "Created " . $new_forum->forumTitle . " forum"
                ]);
            }

            // Commit the transaction upon successful query
            DB::commit();

            // Reset the form upon successful query
            $this->resetForm();

        } catch (\Exception $e) {
            dd($e); // Rollback the transaction in case of any errors
            DB::rollback();

            // Handle the error, log it, or display a message to the user
            // You can add your error handling logic here
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

    public function render()
    {
        return view('livewire.add-forum');
    }
}
