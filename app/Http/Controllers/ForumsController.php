<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\forum_votes;
use App\Models\forums_posted;
use App\Models\forum_replies;

class ForumsController extends Controller
{
    public function viewForum(forums_posted $forum_selected)
    {
        return view('auth.view_forum', [
            'forum_selected' => $forum_selected
        ]);
    }

    public function addForumComment(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'commentBody' => 'required|max:255',
            // Add appropriate validation rules
            'parentForum' => 'required|exists:forums_posted,id',
            // Validate that the forum exists
        ]);

        // Create a new forum comment using the validated data
        // You can replace 'ForumComment' with your actual model name
        $comment = forum_replies::create([
            'replyBody' => $validatedData['commentBody'],
            'parentForum' => $validatedData['parentForum'],
            'replyAuthor' => auth()->user()->id,
            // Add other fields as needed
        ]);

        // Optionally, you can associate the comment with the current user
        // $comment->user_id = auth()->user()->id;

        // Save the comment to the database
        $comment->save();

        // Redirect the user back to the forum or a specific page
        return redirect("/admin/view_forum/{$validatedData['parentForum']}");
    }


    //
    public function deleteForum($forumId)
    {
        // Find the survey to be deleted
        $forum = forums_posted::find($forumId);

        // Check if the survey exists
        if (!$forum) {
            // Optionally, you can handle the case where the survey doesn't exist
            return back()->with('error', 'Forum not found.');
        }

        // Delete related survey questions and choices
        forum_replies::where('parentForum', $forumId)->delete();

        // Delete the survey itself
        $forum->delete();

        // Optionally, you can redirect back to the survey list with a success message
        return back()->with('success', 'Forum deleted successfully.');
    }

    public function addForumVote(Request $request)
    {
        $voteType = $request->input('voteType');
        $parentForum = $request->input('parentForum');
        $parentReply = $request->input('parentReply');
        $voteAuthor = auth()->user()->id;

        // Check if a vote already exists with the same parentForum, parentReply, and voteAuthor
        $existingVote = forum_votes::where([
            'parentForum' => $parentForum,
            'parentReply' => $parentReply,
            'voteAuthor' => $voteAuthor,
        ])->first();

        if ($existingVote) {
            // A vote already exists
            if ($existingVote->voteType === $voteType) {
                // If the vote type is the same, delete the existing vote
                $existingVote->delete();
            } else {
                // If the vote type is different, update the vote type
                $existingVote->voteType = $voteType;
                $existingVote->save();
            }
        } else {
            // If no vote exists, create a new vote
            forum_votes::create([
                'parentForum' => $parentForum,
                'parentReply' => $parentReply,
                'voteType' => $voteType,
                'voteAuthor' => $voteAuthor,
            ]);
        }

        // Redirect or return a response as needed
        return redirect("/admin/view_forum/{$parentForum}");

    }


}

