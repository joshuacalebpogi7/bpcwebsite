<style>
    .reply {
        margin-left: 20px;
        /* Adjust the amount of indentation as needed */
    }

    .reply-within-a-reply {
        margin-left: 40px;
        /* Increase the indentation for replies within replies */
    }

    .reply-within-a-reply-within-a-reply {
        margin-left: 60px;
        /* Increase the indentation for replies within replies */
    }

    .reply-within-a-reply-within-a-reply-within-a-reply {
        margin-left: 80px;
        /* Increase the indentation for replies within replies */
    }

    table {
        width: 100%;
    }

/*     td {
        border: 1px solid black;
    } */
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
                            <td></td>
                            <td style = "width: 20%; text-align: center;">
                                <i>{{ $forumReply['created_at']->format('F j, Y g:i a') }}</i>
                            </td>
                        </tr>
                        <tr>
                            <td class = "upvote-downvote-area" style = "width: 5%; text-align: center;">
                                <form {{-- wire:submit.prevent="upvoteComment" --}}>
                                    <input type = "submit" value = "&#8593;">
                                </form>
                                <br>
                                <form {{-- wire:submit.prevent="downvoteComment" --}}>
                                    <input type = "submit" value = "&#8595;">
                                </form>
                            </td>
                            <td style = "width: 20%; text-align: center;">
                                @php
                                    $forumReplyAuthor = $authors->firstWhere('id', $forumReply->replyAuthor);
                                    $isOp = $forumReplyAuthor && $forumReplyAuthor->id === $forum_selected->forumAuthor;
                                @endphp
                                <img height="100" width="100" class="forum-avatar"
                                    src="{{ $forumReplyAuthor ? $forumReplyAuthor->avatar : 'Author not found' }}">
                                <br>
                                {{ $forumReplyAuthor ? ($forumReplyAuthor->first_name !== $forumReplyAuthor->last_name ? ' ' . $forumReplyAuthor->first_name . ' ' . $forumReplyAuthor->last_name : ' ' . $forumReplyAuthor->first_name) : 'Author not found' }}
                                @if ($isOp)
                                    <br>
                                    [OP]
                                @endif
                            </td>



                            <td>
                                {{ $forumReply['replyBody'] }}
                                <div class="forum-reply-button" style="text-align: right;">
                                    <a
                                        href="{{ route('admin/reply_forum', ['forum_reply_selected' => $forumReply->id]) }}">Reply</a>
                                </div>
                            </td>
                        </tr>
                    </table>
                    <hr>

                    {{-- Display replies to this comment --}}
                    @foreach ($forumReplies as $forumReplyReply)
                        @if ($forumReplyReply['replyingTo'] == $forumReply->id)
                            <div class="reply-within-a-reply">
                                @php
                                    $forumReplyReplyAuthor = $authors->firstWhere('id', $forumReplyReply->replyAuthor);
                                    $isReplyReplyOp = $forumReplyReplyAuthor && $forumReplyReplyAuthor->id === $forum_selected->forumAuthor;
                                @endphp
                                <hr>
                                <p>Replying to: {{ $forumReply['replyBody'] }}</p>
                                <br>
                                <table>
                                    <tr>
                                        <td></td>
                                        <td style = "width: 20%; text-align: center;">
                                            <i>{{ $forumReplyReply['created_at']->format('F j, Y g:i a') }}</i>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class = "upvote-downvote-area" style = "width: 5%; text-align: center;">
                                            <form {{-- wire:submit.prevent="upvoteComment" --}}>
                                                <input type = "submit" value = "&#8593;">
                                            </form>
                                            <br>
                                            <form {{-- wire:submit.prevent="downvoteComment" --}}>
                                                <input type = "submit" value = "&#8595;">
                                            </form>
                                        </td>
                                        <td style = "width: 20%; text-align: center;">
                                            <img height="100" width="100" class="forum-avatar"
                                                src="{{ $forumReplyReplyAuthor ? $forumReplyReplyAuthor->avatar : 'Author not found' }}">
                                            <br>
                                            {{ $forumReplyReplyAuthor ? ($forumReplyReplyAuthor->first_name !== $forumReplyReplyAuthor->last_name ? $forumReplyReplyAuthor->first_name . ' ' . $forumReplyReplyAuthor->last_name : $forumReplyReplyAuthor->first_name) : 'Author not found' }}
                                            @if ($isReplyReplyOp)
                                                <br>
                                                [OP]
                                            @endif
                                        </td>

                                        <td>{{ $forumReplyReply['replyBody'] }}
                                            <div class="forum-reply-button" style="text-align: right;">
                                                <a
                                                    href="{{ route('admin/reply_forum', ['forum_reply_selected' => $forumReplyReply->id]) }}">Reply</a>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                                <hr>

                                {{-- Display replies within replies --}}
                                @foreach ($forumReplies as $forumReplyReplyReply)
                                    @if ($forumReplyReplyReply['replyingTo'] == $forumReplyReply->id)
                                        <div class="reply-within-a-reply-within-a-reply">
                                            @php
                                                $forumReplyReplyReplyAuthor = $authors->firstWhere('id', $forumReplyReplyReply->replyAuthor);
                                                $isReplyReplyReplyOp = $forumReplyReplyReplyAuthor && $forumReplyReplyReplyAuthor->id === $forum_selected->forumAuthor;
                                            @endphp
                                            <hr>
                                            <p>Replying to: {{ $forumReplyReply['replyBody'] }}</p>
                                            <br>
                                            <table>
                                                <tr>
                                                    <td></td>
                                                    <td style = "width: 20%; text-align: center;">
                                                        <i>{{ $forumReplyReplyReply['created_at']->format('F j, Y g:i a') }}</i>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class = "upvote-downvote-area"
                                                        style = "width: 5%; text-align: center;">
                                                        <form {{-- wire:submit.prevent="upvoteComment" --}}>
                                                            <input type = "submit" value = "&#8593;">
                                                        </form>
                                                        <br>
                                                        <form {{-- wire:submit.prevent="downvoteComment" --}}>
                                                            <input type = "submit" value = "&#8595;">
                                                        </form>
                                                    </td>
                                                    <td style = "width: 20%; text-align: center;">
                                                        <img height="100" width="100" class="forum-avatar"
                                                            src="{{ $forumReplyReplyReplyAuthor ? $forumReplyReplyReplyAuthor->avatar : 'Author not found' }}">
                                                        <br>
                                                        {{ $forumReplyReplyReplyAuthor ? ($forumReplyReplyReplyAuthor->first_name !== $forumReplyReplyReplyAuthor->last_name ? $forumReplyReplyReplyAuthor->first_name . ' ' . $forumReplyReplyReplyAuthor->last_name : $forumReplyReplyReplyAuthor->first_name) : 'Author not found' }}
                                                        @if ($isReplyReplyReplyOp)
                                                            <br>
                                                            [OP]
                                                        @endif
                                                    </td>

                                                    <td>{{ $forumReplyReplyReply['replyBody'] }}
                                                        <div class="forum-reply-button" style="text-align: right;">
                                                            {{--                                                             <a
                                                                href="{{ route('admin/reply_forum', ['forum_reply_selected' => $forumReplyReplyReply->id]) }}">Reply</a> --}}
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
        <hr>
        <form wire:submit.prevent = "commentForum">
            <input style = "width: 100%;" type = "text" placeholder="Replying to post: {{ $forumTitle }}" required
                onkeydown="return event.key != 'Enter';" wire:model = "commentBody">{{-- </textarea> --}}
            <div style = "text-align: right;">
                <input type = "submit" value = "Post Comment">
            </div>
            @dump($commentBody)
        </form>
    </div>
</div>
