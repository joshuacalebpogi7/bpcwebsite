<div class="comment-section">
    {{--     <div class="comments-wrp">
        <div class="comment container3">
            @if (auth()->user()->user_type != 'alumni')
                <a href="/admin/view_forum/{{ $forum_reply_selected->id }}">&laquo; Back</a>
            @elseif (auth()->user()->user_type == 'alumni')
                <a href="/view_forum/{{ $forum_reply_selected->id }}">&laquo; Back</a>
            @endif
            <hr>
        </div>
    </div> --}}

    <div class="comments-wrp">
        <div>
            @if (auth()->user()->user_type != 'alumni')
                <a href="/admin/view_forum/{{ $forum_selected->id }}">&laquo; Back</a>
            @elseif (auth()->user()->user_type == 'alumni')
                <a href="/view_forum/{{ $forum_selected->id }}">&laquo; Back</a>
            @endif
        </div>
        {{--         <div class="comment container3">
            <div class="c-user">
                @if (isset($forum_author))
                    <img class="usr-img" src="{{ $forum_author ? $forum_author->avatar : 'Author not found' }}">
                    <small class="usr-name"> {{ $forum_author['first_name'] }} @if ($forum_author['first_name'] != $forum_author['last_name'])
                            {{ $forum_author['last_name'] }}
                        @endif
                        @if (auth()->user()->id === $forum_author->id)
                            (You)
                        @endif
                    </small>
                    <small class="cmnt-at"><i>{{ $forum_selected['created_at']->diffForHumans() }}<br>
                            {{ $forum_selected['created_at']->format('F j, Y g:i A') }}</i></small>
                @endif
            </div>
            <div class = "c-text">
                <small><b>{{ $forum_selected->forumTitle }}</b></small>
                <br>
                <small>{{ $forum_selected->forumBody }}</small>
            </div>
        </div> --}}
        <div class="container3" style = "display: inline-block; padding: 0; margin:0;">
            <small><i>Reply to:
                    @if ($forum_reply_selected->replyingTo == null)
                        {{ $forum_selected->forumTitle }}
                    @elseif ($forum_reply_selected->replyingTo != null)
                        {{ $forum_reply_selected->find($forum_reply_selected->replyingTo)->replyBody }}
                    @endif
                </i></small>
                <hr style = "border: 0.5px solid black;">
        </div>

        <div class="comment container3">
            <div class = "c-score" style = "visibility: hidden;">
            </div>
            <div class="c-user">
                @if (isset($forum_reply_author))
                    <img class="usr-img"
                        src="{{ $forum_reply_author ? $forum_reply_author->avatar : 'Author not found' }}">
                    <small class="usr-name"> {{ $forum_reply_author['first_name'] }} @if ($forum_reply_author['first_name'] != $forum_reply_author['last_name'])
                            {{ $forum_reply_author['last_name'] }}
                        @endif
                        @if (auth()->user()->id === $forum_reply_author->id)
                            (You)
                        @endif
                    </small>
                    <small class="cmnt-at"><i>{{ $forum_reply_selected['created_at']->diffForHumans() }}<br>
                            {{ $forum_reply_selected['created_at']->format('F j, Y g:i A') }}</i></small>
                @endif
            </div>
            <div class = "c-text">
                <small>{{ $forum_reply_selected->replyBody }}</small>
            </div>
            <div class = "c-controls"></div>
        </div>
    </div>

    <div class="reply-input container3">
        <img src="{{ auth()->user()->avatar }}" alt="" class="usr-img">
        @if (auth()->user()->user_type != 'alumni')
            <form wire:submit.prevent = "replyForum">
            @elseif (auth()->user()->user_type == 'alumni')
                <form wire:submit.prevent = "replyForum">
        @endif
        @csrf
        <textarea class="cmnt-input" name = "replyBody" style = "resize: none;"
            placeholder="Replying to {{ $forum_reply_selected->replyBody }}" {{-- placeholder="Replying to {{ $forum_reply_author->first_name }} @if ($forum_reply_author->first_name !== $forum_reply_author->last_name) {{ $forum_reply_author->last_name }} @endif" --}} required
            onkeydown="return event.key != 'Enter';" wire:model = "replyBody"></textarea>

        <button type="submit" class="bu-primary">SEND</button>
        </form>

    </div>
</div>
