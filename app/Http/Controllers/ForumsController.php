<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\forums_posted;
use App\Models\forum_replies;
class ForumsController extends Controller
{
    public function viewForum(forums_posted $forum_selected)
    {
        return view ('auth.view_forum', [
            'forum_selected' => $forum_selected
        ]);
    }
    //
    public function deleteForum($forumId)
    {
        // Find the survey to be deleted
        $forum = forums_posted::find($forumId);

        // Check if the survey exists
        if (!$forum) {
            // Optionally, you can handle the case where the survey doesn't exist
            return redirect()->back()->with('error', 'Forum not found.');
        }

        // Delete related survey questions and choices
        forum_replies::where('parentForum', $forumId)->delete();

        // Delete the survey itself
        $forum->delete();

        // Optionally, you can redirect back to the survey list with a success message
        return redirect()->route('posted_forums')->with('success', 'Forum deleted successfully.');
    }
}
