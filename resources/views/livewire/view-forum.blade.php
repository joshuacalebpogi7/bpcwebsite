<div>
    <div class="form-group">
        <hr>
        <h4>{{ $forum_selected->forumCategory }}</h4><br>
        <h2>{{ $forum_selected->forumTitle }}</h2><br>
        <h4>{{ $forum_selected->forumBody }} </h4>
        <br>

        @foreach ($forumReplies as $forumReply)
            <div class="reply">
                <table>
                    <tr>
                        <td>
                            @php
                                $author = $authors->firstWhere('id', $forumReply->replyAuthor);
                            @endphp
                            <img src="{{ $author ? $author->avatar : 'Author not found' }}" class="sidebar__perfil">
                            <br>
                            {{ $author ? ($author->first_name !== $author->last_name ? $author->first_name . ' ' . $author->last_name : $author->first_name) : 'Author not found' }}
                        </td>

                        <td>{{ $forumReply['replyBody'] }}
                            <a
                                href="{{ route('admin/reply_forum', ['forum_reply_selected' => $forumReply->id]) }}">Reply</a>
                        </td>

                    </tr>
                </table>
            </div>
        @endforeach
    </div>
</div>
