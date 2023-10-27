<div>
    <style>
        .forum-table {
            border-collapse: collapse;
            width: 100%;
        }

        .forum-table th,
        .forum-table td {
            border: 1px solid #dddddd;
            padding: 8px;
        }

        .forum-table th {
            background-color: #f2f2f2;
        }

        .narrow-cell {
            width: 20%;
            
            text-align: center;
            /* Adjust the width as needed */
        }

        .wide-cell {
            width: 80%;
            
            text-align: left;
            /* Adjust the width as needed */
        }

        .reply-button {
            float: right;
        }
    </style>
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
            </tr>
        </table>
        <br>
        {{-- @foreach ($forumReplies as $forumReply)
            <div class="reply">
                <table>
                    <tr>
                        <td>Username:</td>
                        <td>{{ $forumReply["replyBody"] }}</td>
                    </tr>
                </table>
            </div>
        @endforeach
 --}}
    </div>
</div>
