<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Models\forums_posted;
use App\Models\forum_replies;

class NewForum extends Component
{
    public $user;
    public $forumTitle;
    public $forumBody;
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
                'active' => $this->active,
            ]);

            // Commit the transaction upon successful query
            DB::commit();

            // Reset the form upon successful query
            $this->resetForm();
        } catch (\Exception $e) {
            // Rollback the transaction in case of any errors
            DB::rollback();

            // Handle the error, log it, or display a message to the user
            // You can add your error handling logic here
        }

    }


    private function resetForm()
    {
        $this->forumTitle = '';
        $this->forumBody = '';
        $this->active = false;
        return redirect()->to('/posted_forums');

    }

    public function render()
    {
        return view('livewire.new-forum');
    }
}
