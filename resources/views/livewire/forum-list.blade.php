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
    <h1>Forums</h1>
    <a href="{{ url('new_forum') }}">Create a discussion</a>
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
                        <td><img src="{{ URL::asset('/images/xls_icon.png') }}" alt="xls file icon" height="25"
                                width="25"></td>
                        <td>
                            <a href="{{ route('view_forum', ['forum_selected' => $forum_posted->id]) }}">
                                {{ $forum_posted->forumTitle }}
                            </a>
                        </td>
                        <td>{{ $forum_posted->forumBody }}</td>
                        <td>{{ $forum_posted->created_at }}</td>
                        <td>
                            <div> {{-- Three dots --}}
                                <a
                                    href="{{-- route('edit_forum', ['forum_selected' => $forum_posted->id]) --}}"><button>Edit</button></a>
                                    <button onclick="confirmDeleteForum({{ json_encode($forum_posted) }})">Delete</button>
                            </div>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    @else
        <p>No forum posts available.</p>
    @endif
</div>
