{{-- <div>
    <div class="form-group">
        <hr>
        <h4>{{ $forum_selected->forumCategory }}</h4><br>
        <h2>{{ $forum_selected->forumTitle }}</h2><br>
        <h4>{{ $forum_selected->forumBody }} </h4>
        <hr>

        @foreach ($forumReplies as $forumReply)
            @if ($forumReply['replyingTo'] == null)
                <div class="reply">
                    <p>Comments</p>
                    <hr>
                    <table>
                        <tr>
                            <td>
                                @php
                                    $author = $authors->firstWhere('id', $forumReply->replyAuthor);
                                @endphp
                                <img height = "100" width = "100" class = "forum-avatar"
                                    src="{{ $author ? $author->avatar : 'Author not found' }}">
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
            @endif
            @if ($forumReply['replyingTo'] > 0)
                <div class="reply-within-a-reply">
                    @php
                        $author = $authors->firstWhere('id', $forumReply->replyAuthor);
                        $comment = $forumReply->firstWhere('id', $forumReply->replyingTo);
                    @endphp
                    <p>Replies to comments</p>
                    <hr>
                    <p>Replying to: {{ $comment->replyBody }}</p>
                    <br>
                    <table>
                        <tr>
                            <td>
                                <img height = "100" width = "100" class = "forum-avatar"
                                    src="{{ $author ? $author->avatar : 'Author not found' }}">
                                <br>
                                {{ $author ? ($author->first_name !== $author->last_name ? $author->first_name . ' ' . $author->last_name : $author->first_name) : 'Author not found' }}
                            </td>

                            <td>
                                {{ $forumReply['replyBody'] }}
                                <div class = "forum-reply-button" style = "text-align: right;">
                                    <a
                                        href="{{ route('admin/reply_forum', ['forum_reply_selected' => $forumReply->id]) }}">Reply</a>
                                </div>
                            </td>

                        </tr>
                    </table>
                </div>
            @endif
        @endforeach
    </div>
</div>
 --}}

<style>
    .reply {
        margin-left: 20px;
        /* Adjust the amount of indentation as needed */
    }

    .reply-within-a-reply {
        margin-left: 40px;
        /* Increase the indentation for replies within replies */
    }
</style>

<div>
    <div class="form-group">
        <hr>
        <h4>{{ $forum_selected->forumCategory }}</h4><br>
        <h2>{{ $forum_selected->forumTitle }}</h2><br>
        <h4>{{ $forum_selected->forumBody }}</h4>
        <hr>

        @foreach ($forumReplies as $forumReply)
            @if ($forumReply['replyingTo'] == null)
                <div class="reply">
                    <hr>
                    <table>
                        <tr>
                            <td>
                                @php
                                    $author = $authors->firstWhere('id', $forumReply->replyAuthor);
                                @endphp
                                <img height="100" width="100" class="forum-avatar"
                                    src="{{ $author ? $author->avatar : 'Author not found' }}">
                                <br>
                                {{ $author ? ($author->first_name !== $author->last_name ? $author->first_name . ' ' . $author->last_name : $author->first_name) : 'Author not found' }}
                            </td>

                            <td>{{ $forumReply['replyBody'] }}
                                <div class="forum-reply-button" style="text-align: right;">
                                    <a
                                        href="{{ route('admin/reply_forum', ['forum_reply_selected' => $forumReply->id]) }}">Reply</a>
                                </div>
                            </td>
                        </tr>
                    </table>
                    <hr>

                    {{-- Display replies to this comment --}}
                    @foreach ($forumReplies as $replyToComment)
                        @if ($replyToComment['replyingTo'] == $forumReply->id)
                            <div class="reply-within-a-reply">
                                @php
                                    $replyAuthor = $authors->firstWhere('id', $replyToComment->replyAuthor);
                                @endphp
                                <hr>
                                <p>Replying to: {{ $forumReply['replyBody'] }}</p>
                                <br>
                                <table>
                                    <tr>
                                        <td>
                                            <img height="100" width="100" class="forum-avatar"
                                                src="{{ $replyAuthor ? $replyAuthor->avatar : 'Author not found' }}">
                                            <br>
                                            {{ $replyAuthor ? ($replyAuthor->first_name !== $replyAuthor->last_name ? $replyAuthor->first_name . ' ' . $replyAuthor->last_name : $replyAuthor->first_name) : 'Author not found' }}
                                        </td>

                                        <td>{{ $replyToComment['replyBody'] }}
                                            <div class="forum-reply-button" style="text-align: right;">
                                                <a
                                                    href="{{ route('admin/reply_forum', ['forum_reply_selected' => $replyToComment->id]) }}">Reply</a>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                                <hr>

                                {{-- Display replies within replies --}}
                                @foreach ($forumReplies as $replyWithinReply)
                                    @if ($replyWithinReply['replyingTo'] == $replyToComment->id)
                                        <div class="reply-within-a-reply">
                                            @php
                                                $replyWithinReplyAuthor = $authors->firstWhere('id', $replyWithinReply->replyAuthor);
                                            @endphp
                                            <hr>
                                            <p>Replying to: {{ $replyToComment['replyBody'] }}</p>
                                            <br>
                                            <table>
                                                <tr>
                                                    <td>
                                                        <img height="100" width="100" class="forum-avatar"
                                                            src="{{ $replyWithinReplyAuthor ? $replyWithinReplyAuthor->avatar : 'Author not found' }}">
                                                        <br>
                                                        {{ $replyWithinReplyAuthor ? ($replyWithinReplyAuthor->first_name !== $replyWithinReplyAuthor->last_name ? $replyWithinReplyAuthor->first_name . ' ' . $replyWithinReplyAuthor->last_name : $replyWithinReplyAuthor->first_name) : 'Author not found' }}
                                                    </td>

                                                    <td>{{ $replyWithinReply['replyBody'] }}
                                                        <div class="forum-reply-button" style="text-align: right;">
                                                            <a
                                                                href="{{ route('admin/reply_forum', ['forum_reply_selected' => $replyWithinReply->id]) }}">Reply</a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                            <hr>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        @endif
                    @endforeach
                </div>
            @endif
        @endforeach
    </div>
</div>
