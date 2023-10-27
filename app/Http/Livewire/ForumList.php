<?php

// app/Http/Livewire/SurveyList.php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\forums_posted; // Import the Survey model

class ForumList extends Component
{
    public $forum_list;
    public $forumTitle;
    public $forumBody;
    public $active;

    public function render()
    {
        // Load the survey list from your database (adjust this query as needed)
        $this->forum_list = forums_posted::all();

        return view('livewire.forum-list'); // Blade view name
    }

}