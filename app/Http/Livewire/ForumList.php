<?php

// app/Http/Livewire/SurveyList.php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\forums_posted; // Import the Forum model
use App\Models\forum_replies; // Import the Forum model
use App\Models\forum_votes; // Import the Forum model

class ForumList extends Component
{
    public $user;
    public $users;
    public $forum_list;
    public $forum_replies;
    public $forum_votes;
    public $forumTitle;
    public $forumBody;
    public $popularDiscussion;
    public $popularCategories;
    public $active;

    public function __construct()
    {
        $this->user = auth()->user();
    }

    public function render()
    {
        // Load the survey list from your database (adjust this query as needed)
        $this->forum_list = forums_posted::all();
        $this->forum_replies = forum_replies::all();
        $this->forum_votes = forum_votes::all();
        $this->users = User::all();
        //$authors = User::all(); // Retrieve the list of authors

        $this->popularDiscussion = forums_posted::withCount('replies')
            ->orderBy('replies_count', 'desc')
            ->limit(4)
            ->get();

            $this->popularCategories = forums_posted::select('forumCategory')
            ->selectRaw('COUNT(*) as discussions_count')
            ->groupBy('forumCategory')
            ->orderByDesc('discussions_count')
            ->limit(4)
            ->get();


        return view('livewire.forum-list'); // Pass the authors variable to the view
    }


}