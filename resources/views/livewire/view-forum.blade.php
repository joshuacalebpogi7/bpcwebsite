<div>
    <div class="form-group">
        <hr>
        <h1>{{ $forum_selected->forumTitle }}</h1>
        <h2>{{ $forum_selected->forumBody }}</h2>
        <br>

         @foreach ($forumReplies as $forumReply)
            <div class="reply">
                <table>
                    <tr>
                        <td>Username:</td>
                        <td>{{ $forumReply["replyBody"] }}</td>
                    </tr>
                </table>
            </div>
        @endforeach
    </div>
</div>
