<div>
    <div class="form-group">
        <p>{{ $forum_selected->forumCategory }}
            {{ $forum_selected->forumTitle }}
            <br>{{ $forum_selected->forumBody }}
        </p>
        <div style = "text-align: right;">
            <p>Posted by:
                @if ($forum_author->first_name !== $forum_author->last_name)
                    {{ $forum_author->first_name }} {{ $forum_author->last_name }}
                @else
                    {{ $forum_author->first_name }}
                @endif
            </p>
        </div>
        <hr>
    </div>
    <div class = "ReplyingToContainer">
        <table>
            <tbody>
                <tr>
                    <td>You're replying to</td>
                </tr>
                <tr>
                    <td>
                        <img class = "forum_profile_picture" src = "{{ $forum_author->avatar }}" alt ="{{ $forum_author->id }}_profile_image">
                        <h4>
                            @if ($author->first_name !== $author->last_name)
                                {{ $author->first_name }} {{ $author->last_name }}
                            @else
                                {{ $author->first_name }}
                            @endif
                        </h4>
                    </td>

                    <td>
                        <h4>
                            {{ $forum_reply_selected->replyBody }}
                        </h4>
                    </td>
                </tr>
            </tbody>
        </table>
        <hr>
        <form>
            <textarea name = "replyBody" style = "resize: none;"
                placeholder="Replying to {{ $author->first_name }} @if ($author->first_name !== $author->last_name) {{ $author->last_name }} @endif"
                required>{{-- </textarea> --}}
            <div style = "text-align: right;">
                <input type = "submit" value = "Post Reply">
            </div>
        </form>

    </div>
</div>
