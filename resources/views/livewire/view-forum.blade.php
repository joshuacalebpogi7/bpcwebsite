<div>
    <div class="form-group">
        <hr>
        <h4>{{ $forum_selected->forumCategory }}</h4><br>
        <h2>{{ $forum_selected->forumTitle }}</h2><br>
        <h4>{{ $forum_selected->forumBody }} </h4>
        <hr>

        @foreach ($forumReplies as $forumReply)
            <div class="reply">
                <table>
                    <tr>
                        <td>
                            @php
                                $author = $authors->firstWhere('id', $forumReply->replyAuthor);
                            @endphp
                            <img class = "forum-avatar" src="{{ $author ? $author->avatar : 'Author not found' }}">
                            <br>
                            {{ $author ? ($author->first_name !== $author->last_name ? $author->first_name . ' ' . $author->last_name : $author->first_name) : 'Author not found' }}
                        </td>

                        <td>{{ $forumReply['replyBody'] }}
                            <div class = "forum-reply-button" style = "text-align: right;">
                                <a
                                    href="{{ route('admin/reply_forum', ['forum_reply_selected' => $forumReply->id]) }}">Reply</a>
                            </div>
                        </td>

                    </tr>
                </table>
                <hr>
            </div>
        @endforeach
    </div>
</div>
