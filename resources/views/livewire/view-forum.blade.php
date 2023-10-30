<div>
    <div class="form-group">
        <hr>
        <h2>{{ $forum_selected->forumTitle }}</h2><br><h4>{{ $forum_selected->forumBody }}</h4>
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
