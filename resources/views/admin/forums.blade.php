<x-admin-layout>
    @push('scripts')
    <script>
        function confirmDeleteForum(forumData) {
            if (confirm('Are you sure you want to delete "' + forumData.forumTitle + '"?')) {
                // If the user confirms, redirect to the delete route
                window.location.href = "/delete_forum/" + forumData.id;
            }
        }
    </script>
    @endpush
    <h2>Forum Records</h2>
    <div>
        <a href="{{ url('new_forum') }}"><button class="btn btn-primary mb-3"><img
                    src="{{ URL::asset('/images/icon-plus.svg') }}"> Add Forum</button></a>
    </div>


    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <p class="card-title">Forum Table</p>
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table id="example" class="display expandable-table table-hover rounded shadow-sm"
                                style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Title</th>
                                            <th>Body</th>
                                            <th>Date Created</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                        <tbody>
                                        @foreach ($forum_list as $forum_posted)
                                                <tr>
                                                    <td>{{ $forum_posted->id }}</td>
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
                                                                href="{{-- route('edit_survey', ['survey_selected' => $survey_posted->id]) --}}"><button
                                                                    class = "survey_action">
                                                                    <img
                                                                        src="{{ URL::asset('/images/icon-edit.svg') }}"></button></a>
                                                            <br>
                                                            <button class = "survey_action"
                                                                onclick="confirmDeleteForum({{ json_encode($forum_posted) }})"><img
                                                                    src="{{ URL::asset('/images/icon-delete.svg') }}"></button>
                                                        </div>
                                                    </td>
                                                </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-admin-layout>
