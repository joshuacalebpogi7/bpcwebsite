<!-- resources/views/livewire/forum-list.blade.php -->

<script>
    function confirmDeleteForum(forumData) {
        if (confirm('Are you sure you want to delete "' + forumData.forumTitle + '"?')) {
            // If the user confirms, redirect to the delete route
            window.location.href = "/delete_forum/" + forumData.id;
        }
    }
</script>



<div>
    <div class="card">
        <div class="header2">
            <div class="content">
                <h1 class ="title">Forums</h1>
                {{-- ALUMNI --}}
                @if (auth()->user()->user_type === 'alumni')
                    @if (!$forum_list->isEmpty())
                        <p class="message">Forum</p>
                        @php
                            $allForumsInactive = true;
                        @endphp

                        @foreach ($forum_list as $forum_posted)
                            @if ($forum_posted['active'] > 0)
                                @php
                                    $allForumsInactive = false;
                                @endphp

                                <div class="card_notification">
                                    <div class="notification">
                                        <div class="notiglow"></div>
                                        <div class="notiborderglow"></div>
                                        <div class="notititle">Forum #{{ $forum_posted->id }}:
                                            {{ $forum_posted->forumTitle }}</div>

                                        {{-- <div class="notibody">{{ $survey_posted->surveyDesc }}</div> --}}
                                        <a class="start_survey"
                                            href="{{ route('view_forum', ['forum_selected' => $forum_posted->id]) }}">START</a>
                                    </div>
                                </div>
                            @endif
                        @endforeach

                        @if ($allForumsInactive)
                            <p>No forum posts available.</p>
                        @endif
                    @else
                        <p>No forum posts available.</p>
                    @endif
                    {{-- ALUMNI --}}
                    {{-- ADMIN --}}
                @elseif (auth()->user()->user_type === 'admin' || auth()->user()->user_type === 'content creator')
                    <a class = "message" href="{{ url('new_forum') }}"><button class = "survey_action new_survey"><img
                                src="{{ URL::asset('/images/icon-plus.svg') }}"> New Post</button></a>
                    @if (!$forum_list->isEmpty())
                        <table>
                            <tbody>
                                <tr>
                                    <th>#</th>
                                    <th></th>
                                    <th>Title</th>
                                    <th>Body</th>
                                    <th>Date Created</th>
                                    <th>Actions</th>
                                </tr>

                                @foreach ($forum_list as $forum_posted)
                                        <tr>
                                            <td>{{ $forum_posted->id }}</td>
                                            <td><img src="{{ URL::asset('/images/xls_icon.png') }}" alt="xls file icon"
                                                    height="25" width="25"></td>
                                            <td>
                                                <a
                                                    href="{{ route('view_forum', ['forum_selected' => $forum_posted->id]) }}">
                                                    {{ $forum_posted->forumTitle }}
                                                </a>
                                            </td>
                                            <td>{{ $forum_posted->forumBody }}</td>
                                            <td>{{ $forum_posted->created_at }}</td>
                                            <td>
                                                <div>
                                                    <a
                                                        href=" #{{-- route('edit_forum', ['forum_selected' => $forum_posted->id]) --}}"><button>Edit</button></a>
                                                    <button
                                                        onclick="confirmDeleteForum({{ json_encode($forum_posted) }})">Delete</button>
                                                </div>
                                            </td>
                                        </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p>No forum posts available.</p>
                    @endif
                @endif
                {{-- ADMIN --}}

            </div>
        </div>
    </div>
</div>
