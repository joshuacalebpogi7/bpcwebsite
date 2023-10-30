<!-- resources/views/livewire/forum-list.blade.php -->

<script>
    function confirmDeleteForum(forumData) {
        if (confirm('Are you sure you want to delete "' + forumData.forumTitle + '"?')) {
            // If the user confirms, redirect to the delete route
            window.location.href = "/delete_forum/" + forumData.id;
        }
    }
</script>



<div class="card">
    <div class="header2">
        <div class="content">
            <span class="title">Forums</span>
            <hr class="solid" style="border-top: 3px solid #9f9d9d">
            @if (!$forum_list->isEmpty())
                @php
                    $allForumsInactive = true;
                @endphp

                @foreach ($forum_list as $forum_posted)
                    {{-- @if ($forum_posted['active'] > 0) --}}
                        @php
                            $allForumsInactive = false;
                        @endphp
                        <div class="card_notification">
                            <div class="notification">
                                <div class="notiglow"></div>
                                <div class="notiborderglow"></div>
                                <div class="notititle">Forum #{{ $forum_posted->id }}:
                                    {{ $forum_posted->forumTitle }}</div>

                                {{-- <div class="notibody">{{ $forum_posted->surveyDesc }}</div> --}}
                                <a class="start_survey"
                                    href="{{ route('view_forum', ['forum_selected' => $forum_posted->id]) }}">START</a>
                            </div>
                        </div>
                    {{-- @endif --}}
                @endforeach

                @if ($allForumsInactive)
                    <p>No forum posts available.</p>
                @endif
            @else
                <p>No forum posts available.</p>
            @endif

        </div>
    </div>
</div>
