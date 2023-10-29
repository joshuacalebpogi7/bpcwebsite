<div>
    <div class="form-group">
        <hr>
        <h1>Title: {{ $forum_selected->forumTitle }}</h1>
        <table class="forum-table">
            <tr>
                                <td class="narrow-cell">Posted by
                    <br>[Picture]
                    <br>
                    @if ($forum_selected->authorID == $forumBody->authorID)
                        (OP)
                    @endif Name
                </td>
                <td class="wide-cell">{{ $forumBody->replyBody }}
                    <br><button class = "reply-button" type = "button">Reply</button>
                </td>

{{--                 @foreach ($forumReplies as $forumReply)
                    <div class="reply">
                        <table>
                            <tr>
                                <td>Username:</td>
                                <td>{{ $forumReply['replyBody'] }}<br><button class = "reply-button"
                                        type = "button">Reply</button></td>
                            </tr>
                        </table>
                    </div>
                @endforeach --}}
            </tr>
        </table>
        <br>

        {{--  @foreach ($forumReplies as $forumReply)
            <div class="reply">
                <table>
                    <tr>
                        <td>Username:</td>
                        <td>{{ $forumReply["replyBody"] }}</td>
                    </tr>
                </table>
            </div>
        @endforeach --}}
    </div>
</div>
