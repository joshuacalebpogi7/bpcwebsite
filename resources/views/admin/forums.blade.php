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
        <a href="{{ url('admin/add-forum') }}"><button class="btn btn-primary mb-3"><img
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
                                                <th>Category</th>
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
                                                            <a href="{{ route('admin/view_forum', ['forum_selected' => $forum_posted->id]) }}"
                                                                class="flex-fill">
                                                                <button type="button"
                                                                    class="btn btn-warning btn-icon-text"
                                                                    style="width: 150px; height: 50px; margin: 5px; ">
                                                                    <i class="ti-eye btn-icon-prepend"></i>
                                                                    View
                                                                </button>
                                                            </a>
                                                            <a href="#edit{{-- route('admin/edit_forum', ['forum_selected' => $forum_posted->id]) --}}"
                                                                class="flex-fill">
                                                                <button type="button"
                                                                    class="btn btn-success btn-icon-text"
                                                                    style="width: 150px; height: 50px; margin: 5px; ">
                                                                    <i class="ti-pencil btn-icon-prepend"></i>
                                                                    Edit
                                                                </button>
                                                            </a>
                                                            <button type="button" class="btn btn-danger btn-icon-text"
                                                                style="width: 150px; height: 50px; margin: 5px;"
                                                                onclick="confirmDeleteForum({{ json_encode($forum_posted) }})">
                                                                <i class="ti-trash btn-icon-prepend"></i>
                                                                Delete
                                                            </button>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        {{ $forum_posted->forumTitle }}
                                                    </td>
                                                    <td>
                                                        {{ $forum_posted->forumBody }}
                                                    </td>
                                                    <td>
                                                        {{ $forum_posted->forumCategory }}

                                                    </td>
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
