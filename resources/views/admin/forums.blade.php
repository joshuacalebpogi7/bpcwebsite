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
    <h2>Forums Records</h2>
    <div>
        <a href="{{ url('admin/new_forum') }}"><button class="btn btn-primary mb-3"><img
                    src="{{ URL::asset('/images/icon-plus.svg') }}"> Add Forum</button></a>
    </div>


    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <p class="card-title">Forums Table</p>
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table id="example" class="display expandable-table table-hover rounded shadow-sm"
                                    style="width:100%">
                                    @if (!$forum_list->isEmpty())
                                        <thead>
                                            <tr>

                                                <th>ID</th>
                                                <th>Actions</th>
                                                <th>Title</th>
                                                <th>Description</th>
                                                <th>Author</th>
                                                <th>Date Created</th>

                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($forum_list as $forum_posted)
                                                <tr>
                                                    <td>{{ $forum_posted->id }}</td>
                                                    <td>
                                                        <div class="d-flex flex-column">
                                                            <a href="{{ route('admin/view_forum', ['forum_selected' => $forum_posted->id]) }}" class="flex-fill"><button
                                                                class="btn btn-light me-1 w-100 h-100 p-1 border mb-1"
                                                                style="width: 150px;">
                                                                <div
                                                                    class="d-flex justify-content-center align-items-center">
                                                                    <img src="{{ URL::asset('/images/icon-view.svg') }}"
                                                                        class="mr-2" alt="View Icon">
                                                                    View
                                                                </div>
                                                            </button>
                                                        </a>
                                                            <a href="{{-- route('edit_forum', ['forum_selected' => $forum_posted->id]) --}}" class="flex-fill"><button
                                                                    class="btn btn-light me-1 w-100 h-100 p-1 border mb-1"
                                                                    style="width: 150px;">
                                                                    <div
                                                                        class="d-flex justify-content-center align-items-center">
                                                                        <img src="{{ URL::asset('/images/icon-edit.svg') }}"
                                                                            class="mr-2" alt="Edit Icon">
                                                                        Edit
                                                                    </div>
                                                                </button>
                                                            </a>
                                                            <button
                                                                class="btn btn-light mt-1 flex-fill w-100 h-100 p-1 border"
                                                                style="width: 150px;"
                                                                onclick="confirmDeleteForum({{ json_encode($forum_posted) }})">
                                                                <div
                                                                    class="d-flex justify-content-center align-items-center">
                                                                    <img src="{{ URL::asset('/images/icon-delete.svg') }}"
                                                                        class="mr-2" alt="Delete Icon">Delete
                                                                </div>
                                                            </button>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        {{ $forum_posted->forumTitle }}
                                                    </td>
                                                    <td>{{ $forum_posted->forumDesc }}</td>
                                                    <td>
                                                        @php
                                                            $author = $authors->firstWhere('id', $forum_posted->forumAuthor);
                                                        @endphp
                                                        {{ $author ? '[ID ' . $author->id . '] ' . $author->first_name . ' ' . $author->last_name : 'Author not found' }}
                                                    </td>

                                                    <td>{{ $forum_posted->created_at }}</td>
                                                </tr>
                                            @endforeach
                                    @endif
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
