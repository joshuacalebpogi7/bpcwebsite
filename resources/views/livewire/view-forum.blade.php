@push('scripts')
    <script>
        function confirmDeleteForum(forumData) {
            if (confirm('Are you sure you want to delete "' + forumData.forumTitle + '"?')) {
                // If the user confirms, redirect to the delete route
                window.location.href = "/delete_forum/" + forumData.id;
            }
        }

        function confirmDeleteComment(commentData) {
            if (confirm('Are you sure you want to delete "' + commentData.replyBody + '"?')) {
                // If the user confirms, redirect to the delete route
                window.location.href = "/delete_comment/" + commentData.id;
            }
        }
    </script>
@endpush
{{-- <style>
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

    /* td {
        border: 1px solid black;
    } */
</style> --}}
<div class="svg1">
    <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
        <path fill="#C4E8C2"
            d="M29.6,-49.1C39.2,-45.8,48.4,-39.5,53.5,-30.8C58.5,-22.2,59.5,-11.1,59.2,-0.1C59,10.8,57.5,21.6,55.7,35.9C53.9,50.2,51.7,68,42.4,77.4C33,86.9,16.5,87.9,3.9,81.1C-8.7,74.3,-17.4,59.7,-26.4,50.1C-35.4,40.5,-44.7,35.8,-56.8,28.3C-69,20.8,-83.9,10.4,-87.5,-2C-91,-14.5,-83.1,-29,-73.3,-40.5C-63.5,-52.1,-51.8,-60.8,-39.3,-62.3C-26.7,-63.9,-13.4,-58.3,-1.7,-55.5C10,-52.6,20.1,-52.3,29.6,-49.1Z"
            transform="translate(100 100)" />
    </svg>
</div>

<div class="svg2">
    <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
        <path fill="#67D199"
            d="M48.8,-47.3C63.7,-33.9,76.5,-16.9,76.8,0.3C77.1,17.5,64.7,34.9,49.8,45.6C34.9,56.2,17.5,60,-2.5,62.5C-22.4,65,-44.8,66.1,-58.4,55.5C-72,44.8,-76.8,22.4,-73.9,2.9C-70.9,-16.5,-60.2,-33,-46.6,-46.5C-33,-60,-16.5,-70.5,0.2,-70.7C16.9,-70.9,33.9,-60.8,48.8,-47.3Z"
            transform="translate(100 100)" />
    </svg>
</div>
<div>

    <div class="tab">
        <a href="{{ url('forums') }}"><button class="cta">
                <span class="span">BACK</span>
                <span class="second">
                    <svg width="50px" height="20px" viewBox="0 0 66 43" version="1.1"
                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                        <g id="arrow" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <path class="one"
                                d="M40.1543933,3.89485454 L43.9763149,0.139296592 C44.1708311,-0.0518420739 44.4826329,-0.0518571125 44.6771675,0.139262789 L65.6916134,20.7848311 C66.0855801,21.1718824 66.0911863,21.8050225 65.704135,22.1989893 C65.7000188,22.2031791 65.6958657,22.2073326 65.6916762,22.2114492 L44.677098,42.8607841 C44.4825957,43.0519059 44.1708242,43.0519358 43.9762853,42.8608513 L40.1545186,39.1069479 C39.9575152,38.9134427 39.9546793,38.5968729 40.1481845,38.3998695 C40.1502893,38.3977268 40.1524132,38.395603 40.1545562,38.3934985 L56.9937789,21.8567812 C57.1908028,21.6632968 57.193672,21.3467273 57.0001876,21.1497035 C56.9980647,21.1475418 56.9959223,21.1453995 56.9937605,21.1432767 L40.1545208,4.60825197 C39.9574869,4.41477773 39.9546013,4.09820839 40.1480756,3.90117456 C40.1501626,3.89904911 40.1522686,3.89694235 40.1543933,3.89485454 Z"
                                fill="#FFFFFF"></path>
                            <path class="two"
                                d="M20.1543933,3.89485454 L23.9763149,0.139296592 C24.1708311,-0.0518420739 24.4826329,-0.0518571125 24.6771675,0.139262789 L45.6916134,20.7848311 C46.0855801,21.1718824 46.0911863,21.8050225 45.704135,22.1989893 C45.7000188,22.2031791 45.6958657,22.2073326 45.6916762,22.2114492 L24.677098,42.8607841 C24.4825957,43.0519059 24.1708242,43.0519358 23.9762853,42.8608513 L20.1545186,39.1069479 C19.9575152,38.9134427 19.9546793,38.5968729 20.1481845,38.3998695 C20.1502893,38.3977268 20.1524132,38.395603 20.1545562,38.3934985 L36.9937789,21.8567812 C37.1908028,21.6632968 37.193672,21.3467273 37.0001876,21.1497035 C36.9980647,21.1475418 36.9959223,21.1453995 36.9937605,21.1432767 L20.1545208,4.60825197 C19.9574869,4.41477773 19.9546013,4.09820839 20.1480756,3.90117456 C20.1501626,3.89904911 20.1522686,3.89694235 20.1543933,3.89485454 Z"
                                fill="#FFFFFF"></path>
                            <path class="three"
                                d="M0.154393339,3.89485454 L3.97631488,0.139296592 C4.17083111,-0.0518420739 4.48263286,-0.0518571125 4.67716753,0.139262789 L25.6916134,20.7848311 C26.0855801,21.1718824 26.0911863,21.8050225 25.704135,22.1989893 C25.7000188,22.2031791 25.6958657,22.2073326 25.6916762,22.2114492 L4.67709797,42.8607841 C4.48259567,43.0519059 4.17082418,43.0519358 3.97628526,42.8608513 L0.154518591,39.1069479 C-0.0424848215,38.9134427 -0.0453206733,38.5968729 0.148184538,38.3998695 C0.150289256,38.3977268 0.152413239,38.395603 0.154556228,38.3934985 L16.9937789,21.8567812 C17.1908028,21.6632968 17.193672,21.3467273 17.0001876,21.1497035 C16.9980647,21.1475418 16.9959223,21.1453995 16.9937605,21.1432767 L0.15452076,4.60825197 C-0.0425130651,4.41477773 -0.0453986756,4.09820839 0.148075568,3.90117456 C0.150162624,3.89904911 0.152268631,3.89694235 0.154393339,3.89485454 Z"
                                fill="#FFFFFF"></path>
                        </g>
                    </svg>
                </span>
            </button></a>
    </div>

    <template class="reply-input-template">
        <div class="reply-input container">
            <img src="{{ auth()->user()->avatar }}" alt="" class="usr-img">
            <textarea class="cmnt-input" placeholder="Add a comment..."></textarea>
            <button class="bu-primary">SEND</button>
        </div>
    </template>

    <template class="comment-template">
        <div class="comment-wrp">
            <div class="comment container3">
                <div class="c-score">
                    <img src="images/icon-plus.svg" alt="plus" class="score-control score-plus">
                    <p class="score-number">5</p>
                    <img src="images/icon-minus.svg" alt="minus" class="score-control score-minus">
                </div>
                <div class="c-controls">
                    <a class="delete"><img src="images/icon-delete.svg" alt="" class="control-icon">Delete</a>
                    <a class="edit"><img src="images/icon-edit.svg" alt="" class="control-icon">Edit</a>
                    <a class="reply"><img src="images/icon-reply.svg" alt="" class="control-icon">Reply</a>
                </div>
                <div class="c-user">
                    <img src="images/avatars/image-maxblagun.webp" alt="" class="usr-img">
                    <p class="usr-name">maxblagun</p>
                    <p class="cmnt-at">2 weeks ago</p>
                </div>
                <p class="c-text">
                    <span class="reply-to"></span>
                    <span class="c-body"></span>
                </p>
            </div><!--comment-->
            <div class="replies comments-wrp">
            </div><!--replies-->
        </div>
    </template>



    <main>
        <div class="comment-section">
            <div class="comments-wrp">
                <div class="comment container3">
                    @if ($forum_selected->forumAuthor === auth()->user()->id || auth()->user()->user_type != 'alumni')
                        <div class = "c-controls">
                            <button type="button" class="delete"
                                onclick="confirmDeleteForum({{ json_encode($forum_selected) }})">
                                <img src="{{ asset('/images/icon-delete.svg') }}" alt=""
                                    class="control-icon">Delete
                            </button>
                        </div>
                    @endif
                    <div class="c-user">
                        <h3>Posted by</h3>
                        @if (isset($forumAuthor))
                            <img class="usr-img" src="{{ $forumAuthor ? $forumAuthor->avatar : 'Author not found' }}">
                            <p class="usr-name"> {{ $forumAuthor['first_name'] }} @if ($forumAuthor['first_name'] != $forumAuthor['last_name'])
                                    {{ $forumAuthor['last_name'] }}
                                @endif
                                @if (auth()->user()->id === $forumAuthor->id)
                                    (You)
                                @endif
                            </p>
                            <p class="cmnt-at">{{ $forum_selected['created_at']->diffForHumans() }}</p>
                        @endif
                    </div>
                    <div class = "c-text">
                        <h2>{{ $forum_selected->forumTitle }}</h2>
                        <p>{{ $forum_selected->forumBody }}</p>
                    </div>
                </div>
            </div>
            @foreach ($forumReplies as $forumFirstReply)
                @if ($forumFirstReply['replyingTo'] == null)
                    <div class="comments-wrp">
                        <div class="comment container3">
                            <div class="c-score">
                                @if (auth()->user()->user_type != 'alumni')
                                    <form action="/admin/add-forum-vote" method="post">
                                    @elseif (auth()->user()->user_type == 'alumni')
                                        <form action="/auth/add-forum-vote" method="post">
                                @endif
                                @csrf
                                <input type = "hidden" name = "voteType" value = "upvote">
                                <input type = "hidden" name = "parentForum" value = "{{ $forum_selected->id }}">
                                <input type = "hidden" name = "parentReply" value = "{{ $forumFirstReply->id }}">
                                <button type="submit">
                                    <img src="{{ asset('images/icon-plus.svg') }}" alt="plus"
                                        class="score-control score-plus"></button>
                                </form>
                                <p class="score-number">
                                    {{ $forumFirstReply->upvoteCount - $forumFirstReply->downvoteCount }}
                                </p>
                                @if (auth()->user()->user_type != 'alumni')
                                    <form action="/admin/add-forum-vote" method="post">
                                    @elseif (auth()->user()->user_type == 'alumni')
                                        <form action="/auth/add-forum-vote" method="post">
                                @endif
                                @csrf
                                <input type = "hidden" name = "voteType" value = "downvote">
                                <input type = "hidden" name = "parentForum" value = "{{ $forum_selected->id }}">
                                <input type = "hidden" name = "parentReply" value = "{{ $forumFirstReply->id }}">
                                <button type="submit">
                                    <img src="{{ asset('images/icon-minus.svg') }}" alt="minus"
                                        class="score-control score-minus">
                                </button>
                                </form>
                            </div>
                            <div class="c-controls">
                                @if ($forumFirstReply->replyAuthor === auth()->user()->id || auth()->user()->user_type != 'alumni')
                                    <button class="delete"
                                        onclick="confirmDeleteComment({{ json_encode($forumFirstReply) }})">
                                        <img src="{{ URL::asset('/images/icon-delete.svg') }}" alt=""
                                            class="control-icon">Delete</button>
                                    <button class="edit"><img src="{{ URL::asset('/images/icon-edit.svg') }}"
                                            alt="" class="control-icon">Edit</button>
                                @endif
                                @if (auth()->user()->user_type != 'alumni')
                                    <a href="{{ route('admin/reply_forum', ['forum_reply_selected' => $forumFirstReply->id]) }}"
                                        class="reply"><img src="images/icon-reply.svg" alt=""
                                            class="control-icon">Reply</a>
                                @elseif (auth()->user()->user_type == 'alumni')
                                    <a href="{{ route('reply_forum', ['forum_reply_selected' => $forumFirstReply->id]) }}"
                                        class="reply"><img src="images/icon-reply.svg" alt=""
                                            class="control-icon">Reply</a>
                                @endif
                            </div>
                            <div class="c-user">
                                @php
                                    $forumFirstReplyAuthor = $authors->firstWhere('id', $forumFirstReply->replyAuthor);
                                    $isFirstReplyOp = $forumFirstReplyAuthor && $forumFirstReplyAuthor->id === $forum_selected->forumAuthor;
                                    $isFirstReplyUser = $forumFirstReplyAuthor && $forumFirstReplyAuthor->id === auth()->user()->id;
                                @endphp
                                <img src="{{ $forumFirstReplyAuthor ? $forumFirstReplyAuthor->avatar : 'Author not found' }}"
                                    alt="" class="usr-img">
                                <p class="usr-name">
                                    {{ $forumFirstReplyAuthor ? ($forumFirstReplyAuthor->first_name !== $forumFirstReplyAuthor->last_name ? ' ' . $forumFirstReplyAuthor->first_name . ' ' . $forumFirstReplyAuthor->last_name : ' ' . $forumFirstReplyAuthor->first_name) : 'Author not found' }}
                                    @if ($isFirstReplyUser)
                                        (You)
                                    @endif
                                    @if ($isFirstReplyOp)
                                        [OP]
                                    @endif
                                </p>
                                <p class="cmnt-at">{{ $forumFirstReply['created_at']->diffForHumans() }}</p>
                            </div>
                            <p class="c-text">
                                <span class="reply-to"></span>
                                <span class="c-body">{{ $forumFirstReply['replyBody'] }}</span>
                            </p>
                        </div><!--comment-->
                        <div class="replies comments-wrp">

                            @foreach ($forumReplies as $forumSecondReply)
                                @if ($forumSecondReply['replyingTo'] == $forumFirstReply->id)
                                    @php
                                        $forumSecondReplyAuthor = $authors->firstWhere('id', $forumSecondReply->replyAuthor);
                                        $isSecondReplyOp = $forumSecondReplyAuthor && $forumSecondReplyAuthor->id === $forum_selected->forumAuthor;
                                        $isSecondReplyUser = $forumSecondReplyAuthor && $forumSecondReplyAuthor->id === auth()->user()->id;
                                    @endphp
                                    <div class="comment container3">
                                        <div class="c-score">
                                            @if (auth()->user()->user_type != 'alumni')
                                                <form action="/admin/add-forum-vote" method="post">
                                                @elseif (auth()->user()->user_type == 'alumni')
                                                    <form action="/auth/add-forum-vote" method="post">
                                            @endif
                                            @csrf
                                            <input type = "hidden" name = "voteType" value = "upvote">
                                            <input type = "hidden" name = "parentForum"
                                                value = "{{ $forum_selected->id }}">
                                            <input type = "hidden" name = "parentReply"
                                                value = "{{ $forumSecondReply->id }}">
                                            <button type="submit">
                                                <img src="{{ asset('images/icon-plus.svg') }}" alt="plus"
                                                    class="score-control score-plus"></button>
                                            </form>
                                            <p class="score-number">
                                                {{ $forumSecondReply->upvoteCount - $forumSecondReply->downvoteCount }}
                                            </p>
                                            @if (auth()->user()->user_type != 'alumni')
                                                <form action="/admin/add-forum-vote" method="post">
                                                @elseif (auth()->user()->user_type == 'alumni')
                                                    <form action="/auth/add-forum-vote" method="post">
                                            @endif
                                            @csrf
                                            <input type = "hidden" name = "voteType" value = "downvote">
                                            <input type = "hidden" name = "parentForum"
                                                value = "{{ $forum_selected->id }}">
                                            <input type = "hidden" name = "parentReply"
                                                value = "{{ $forumSecondReply->id }}">
                                            <button type="submit">
                                                <img src="{{ asset('images/icon-minus.svg') }}" alt="minus"
                                                    class="score-control score-minus">
                                            </button>
                                            </form>
                                        </div>
                                        <div class="c-controls">
                                            @if ($forumSecondReply->replyAuthor === auth()->user()->id || auth()->user()->user_type != 'alumni')
                                                <button class="delete"
                                                    onclick="confirmDeleteComment({{ json_encode($forumSecondReply) }})">
                                                    <img src="{{ URL::asset('/images/icon-delete.svg') }}"
                                                        alt="" class="control-icon">Delete</button>
                                                <button class="edit"><img
                                                        src="{{ URL::asset('/images/icon-edit.svg') }}"
                                                        alt="" class="control-icon">Edit</button>
                                            @endif
                                            @if (auth()->user()->user_type != 'alumni')
                                                <a href="{{ route('admin/reply_forum', ['forum_reply_selected' => $forumSecondReply->id]) }}"
                                                    class="reply"><img src="images/icon-reply.svg" alt=""
                                                        class="control-icon">Reply</a>
                                            @elseif (auth()->user()->user_type == 'alumni')
                                                <a href="{{ route('reply_forum', ['forum_reply_selected' => $forumSecondReply->id]) }}"
                                                    class="reply"><img src="images/icon-reply.svg" alt=""
                                                        class="control-icon">Reply</a>
                                            @endif
                                        </div>
                                        <div class="c-user">
                                            <img src="{{ $forumSecondReplyAuthor ? $forumSecondReplyAuthor->avatar : 'Author not found' }}"
                                                alt="" class="usr-img">
                                            <p class="usr-name">
                                                {{ $forumSecondReplyAuthor ? ($forumSecondReplyAuthor->first_name !== $forumSecondReplyAuthor->last_name ? ' ' . $forumSecondReplyAuthor->first_name . ' ' . $forumSecondReplyAuthor->last_name : ' ' . $forumSecondReplyAuthor->first_name) : 'Author not found' }}
                                                @if ($isSecondReplyUser)
                                                    (You)
                                                @endif
                                                @if ($isSecondReplyOp)
                                                    [OP]
                                                @endif
                                            </p>
                                            <p class="cmnt-at">{{ $forumSecondReply['created_at']->diffForHumans() }}
                                            </p>
                                        </div>
                                        <p class="c-text">
                                            <span class="reply-to">{{ $forumFirstReply['replyBody'] }}</span>
                                            <span class="c-body">{{ $forumSecondReply['replyBody'] }}</span>
                                        </p>
                                    </div><!--comment-->
                                    <div class="replies comments-wrp">
                                        @foreach ($forumReplies as $forumThirdReply)
                                            @if ($forumThirdReply['replyingTo'] == $forumSecondReply->id)
                                                @php
                                                    $forumThirdReplyAuthor = $authors->firstWhere('id', $forumThirdReply->replyAuthor);
                                                    $isThirdReplyOp = $forumThirdReplyAuthor && $forumThirdReplyAuthor->id === $forum_selected->forumAuthor;
                                                    $isThirdReplyUser = $forumThirdReplyAuthor && $forumThirdReplyAuthor->id === auth()->user()->id;
                                                @endphp
                                                <div class="comment container3">
                                                    <div class="c-score">
                                                        @if (auth()->user()->user_type != 'alumni')
                                                            <form action="/admin/add-forum-vote" method="post">
                                                            @elseif (auth()->user()->user_type == 'alumni')
                                                                <form action="/auth/add-forum-vote" method="post">
                                                        @endif
                                                        @csrf
                                                        <input type = "hidden" name = "voteType" value = "upvote">
                                                        <input type = "hidden" name = "parentForum"
                                                            value = "{{ $forum_selected->id }}">
                                                        <input type = "hidden" name = "parentReply"
                                                            value = "{{ $forumThirdReply->id }}">
                                                        <button type="submit">
                                                            <img src="{{ asset('images/icon-plus.svg') }}"
                                                                alt="plus"
                                                                class="score-control score-plus"></button>
                                                        </form>
                                                        <p class="score-number">
                                                            {{ $forumThirdReply->upvoteCount - $forumThirdReply->downvoteCount }}
                                                        </p>
                                                        @if (auth()->user()->user_type != 'alumni')
                                                            <form action="/admin/add-forum-vote" method="post">
                                                            @elseif (auth()->user()->user_type == 'alumni')
                                                                <form action="/auth/add-forum-vote" method="post">
                                                        @endif
                                                        @csrf
                                                        <input type = "hidden" name = "voteType" value = "downvote">
                                                        <input type = "hidden" name = "parentForum"
                                                            value = "{{ $forum_selected->id }}">
                                                        <input type = "hidden" name = "parentReply"
                                                            value = "{{ $forumThirdReply->id }}">
                                                        <button type="submit">
                                                            <img src="{{ asset('images/icon-minus.svg') }}"
                                                                alt="minus" class="score-control score-minus">
                                                        </button>
                                                        </form>
                                                    </div>
                                                    <div class="c-controls">
                                                        @if ($forumThirdReply->replyAuthor === auth()->user()->id || auth()->user()->user_type != 'alumni')
                                                            <button class="delete"
                                                                onclick="confirmDeleteComment({{ json_encode($forumThirdReply) }})">
                                                                <img src="{{ URL::asset('/images/icon-delete.svg') }}"
                                                                    alt=""
                                                                    class="control-icon">Delete</button>
                                                            <button class="edit"><img
                                                                    src="{{ URL::asset('/images/icon-edit.svg') }}"
                                                                    alt="" class="control-icon">Edit</button>
                                                        @endif
                                                        @if (auth()->user()->user_type != 'alumni')
                                                            <a href="{{ route('admin/reply_forum', ['forum_reply_selected' => $forumThirdReply->id]) }}"
                                                                class="reply"><img src="images/icon-reply.svg"
                                                                    alt="" class="control-icon">Reply</a>
                                                        @elseif (auth()->user()->user_type == 'alumni')
                                                            <a href="{{ route('reply_forum', ['forum_reply_selected' => $forumThirdReply->id]) }}"
                                                                class="reply"><img src="images/icon-reply.svg"
                                                                    alt="" class="control-icon">Reply</a>
                                                        @endif
                                                    </div>
                                                    <div class="c-user">
                                                        <img src="{{ $forumThirdReplyAuthor ? $forumThirdReplyAuthor->avatar : 'Author not found' }}"
                                                            alt="" class="usr-img">
                                                        <p class="usr-name">
                                                            {{ $forumThirdReplyAuthor ? ($forumThirdReplyAuthor->first_name !== $forumThirdReplyAuthor->last_name ? ' ' . $forumThirdReplyAuthor->first_name . ' ' . $forumThirdReplyAuthor->last_name : ' ' . $forumThirdReplyAuthor->first_name) : 'Author not found' }}
                                                            @if ($isThirdReplyUser)
                                                                (You)
                                                            @endif
                                                            @if ($isThirdReplyOp)
                                                                [OP]
                                                            @endif
                                                        </p>
                                                        <p class="cmnt-at">
                                                            {{ $forumThirdReply['created_at']->diffForHumans() }}
                                                        </p>
                                                    </div>
                                                    <p class="c-text">
                                                        <span
                                                            class="reply-to">{{ $forumSecondReply['replyBody'] }}</span>
                                                        <span
                                                            class="c-body">{{ $forumThirdReply['replyBody'] }}</span>
                                                    </p>
                                                </div><!--comment-->
                                                <div class="replies comments-wrp">
                                                    @foreach ($forumReplies as $forumFourthReply)
                                                    @if ($forumFourthReply['replyingTo'] == $forumThirdReply->id)
                                                        @php
                                                            $forumFourthReplyAuthor = $authors->firstWhere('id', $forumFourthReply->replyAuthor);
                                                            $isFourthReplyOp = $forumFourthReplyAuthor && $forumFourthReplyAuthor->id === $forum_selected->forumAuthor;
                                                            $isFourthReplyUser = $forumFourthReplyAuthor && $forumFourthReplyAuthor->id === auth()->user()->id;
                                                        @endphp
                                                        <div class="comment container3">
                                                            <div class="c-score">
                                                                @if (auth()->user()->user_type != 'alumni')
                                                                    <form action="/admin/add-forum-vote" method="post">
                                                                    @elseif (auth()->user()->user_type == 'alumni')
                                                                        <form action="/auth/add-forum-vote" method="post">
                                                                @endif
                                                                @csrf
                                                                <input type = "hidden" name = "voteType" value = "upvote">
                                                                <input type = "hidden" name = "parentForum"
                                                                    value = "{{ $forum_selected->id }}">
                                                                <input type = "hidden" name = "parentReply"
                                                                    value = "{{ $forumFourthReply->id }}">
                                                                <button type="submit">
                                                                    <img src="{{ asset('images/icon-plus.svg') }}"
                                                                        alt="plus"
                                                                        class="score-control score-plus"></button>
                                                                </form>
                                                                <p class="score-number">
                                                                    {{ $forumFourthReply->upvoteCount - $forumFourthReply->downvoteCount }}
                                                                </p>
                                                                @if (auth()->user()->user_type != 'alumni')
                                                                    <form action="/admin/add-forum-vote" method="post">
                                                                    @elseif (auth()->user()->user_type == 'alumni')
                                                                        <form action="/auth/add-forum-vote" method="post">
                                                                @endif
                                                                @csrf
                                                                <input type = "hidden" name = "voteType" value = "downvote">
                                                                <input type = "hidden" name = "parentForum"
                                                                    value = "{{ $forum_selected->id }}">
                                                                <input type = "hidden" name = "parentReply"
                                                                    value = "{{ $forumFourthReply->id }}">
                                                                <button type="submit">
                                                                    <img src="{{ asset('images/icon-minus.svg') }}"
                                                                        alt="minus" class="score-control score-minus">
                                                                </button>
                                                                </form>
                                                            </div>
                                                            <div class="c-controls">
                                                                @if ($forumFourthReply->replyAuthor === auth()->user()->id || auth()->user()->user_type != 'alumni')
                                                                    <button class="delete"
                                                                        onclick="confirmDeleteComment({{ json_encode($forumFourthReply) }})">
                                                                        <img src="{{ URL::asset('/images/icon-delete.svg') }}"
                                                                            alt=""
                                                                            class="control-icon">Delete</button>
                                                                    <button class="edit"><img
                                                                            src="{{ URL::asset('/images/icon-edit.svg') }}"
                                                                            alt="" class="control-icon">Edit</button>
                                                                @endif
                                                            </div>
                                                            <div class="c-user">
                                                                <img src="{{ $forumFourthReplyAuthor ? $forumFourthReplyAuthor->avatar : 'Author not found' }}"
                                                                    alt="" class="usr-img">
                                                                <p class="usr-name">
                                                                    {{ $forumFourthReplyAuthor ? ($forumFourthReplyAuthor->first_name !== $forumFourthReplyAuthor->last_name ? ' ' . $forumFourthReplyAuthor->first_name . ' ' . $forumFourthReplyAuthor->last_name : ' ' . $forumFourthReplyAuthor->first_name) : 'Author not found' }}
                                                                    @if ($isFourthReplyUser)
                                                                        (You)
                                                                    @endif
                                                                    @if ($isFourthReplyOp)
                                                                        [OP]
                                                                    @endif
                                                                </p>
                                                                <p class="cmnt-at">
                                                                    {{ $forumFourthReply['created_at']->diffForHumans() }}
                                                                </p>
                                                            </div>
                                                            <p class="c-text">
                                                                <span
                                                                    class="reply-to">{{ $forumThirdReply['replyBody'] }}</span>
                                                                <span
                                                                    class="c-body">{{ $forumFourthReply['replyBody'] }}</span>
                                                            </p>
                                                        </div><!--comment-->
                                                    @endif
                                                @endforeach
                                                </div><!--replies-->
                                            @endif
                                        @endforeach
                                    </div><!--replies-->
                                @endif
                            @endforeach
                        </div><!--replies-->
                    </div> <!--commentS wrapper-->
                @endif
            @endforeach

            <div class="comments-wrp">
                <div class="comment container3">
                    <div class="c-score">
                        <img src="images/icon-plus.svg" alt="plus" class="score-control score-plus">
                        <p class="score-number">5</p>
                        <img src="images/icon-minus.svg" alt="minus" class="score-control score-minus">
                    </div>
                    <div class="c-controls">
                        <a class="delete"><img src="images/icon-delete.svg" alt=""
                                class="control-icon">Delete</a>
                        <a class="edit"><img src="images/icon-edit.svg" alt=""
                                class="control-icon">Edit</a>
                        <a class="reply"><img src="images/icon-reply.svg" alt=""
                                class="control-icon">Reply</a>
                    </div>
                    <div class="c-user">
                        <img src="images/avatars/image-maxblagun.webp" alt="" class="usr-img">
                        <p class="usr-name">maxblagun</p>
                        <p class="cmnt-at">2 weeks ago</p>
                    </div>
                    <p class="c-text">
                        <span class="reply-to"></span>
                        <span class="c-body"></span>
                    </p>
                </div><!--comment-->
                <div class="replies comments-wrp">
                </div><!--replies-->
            </div> <!--commentS wrapper-->
            <div class="reply-input container3">
                <img src="{{ auth()->user()->avatar }}" alt="" class="usr-img">
                @if (auth()->user()->user_type != 'alumni')
                    <form action="/admin/add-forum-comment" method="post">
                    @elseif (auth()->user()->user_type == 'alumni')
                        <form action="/auth/add-forum-comment" method="post">
                @endif
                @csrf
                @method('POST')
                <textarea class="cmnt-input" name="commentBody" placeholder="Replying to post: {{ $forumTitle }}" required
                    onkeydown="return event.key != 'Enter';"></textarea>
                <input type = "hidden" name = "parentForum" value = "{{ $forum_selected->id }}">

                <button type="submit" class="bu-primary">Post Comment</button>
                </form>

            </div> <!--reply input-->
        </div> <!--comment sectio-->

        <div class="modal-wrp invisible">
            <div class="modal container3">
                <h3>Delete comment</h3>
                <p>Are you sure you want to delete this comment? This will remove the comment and cant be undone</p>
                <button class="yes">YES,DELETE</button>
                <button class="no">NO,CANCEL</button>
            </div>
        </div>
    </main>
</div>
