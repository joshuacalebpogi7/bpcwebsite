<x-admin-layout>
    <h2>News Records</h2>
    <div>
        <a href="/admin/add-news"><button class="btn btn-primary mb-3"><img
                    src="{{ URL::asset('/images/icon-plus.svg') }}"> Add News</button></a>
    </div>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <p class="card-title">News Table</p>
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table id="example" class="display expandable-table table-hover rounded shadow-sm"
                                    style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Action</th>
                                            <th>Thumbnail</th>
                                            <th>Title</th>
                                            <th>Category</th>
                                            <th>Author</th>
                                            <th>Posted by</th>
                                            <th>Updated by</th>
                                            <th>Date Created</th>
                                            <th>Date Updated</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($news as $news)
                                            <tr>
                                                <th>{{ $news->id }}</th>
                                                {{-- separate row --}}
                                                <td>
                                                    <div class="d-flex flex-column">
                                                        <!-- First Row - Edit Button -->
                                                        <a href="/admin/edit-news/{{ $news->id }}/{{ $news->title }}"
                                                            class="flex-fill">
                                                            <button type="button" class="btn btn-success btn-icon-text"
                                                                style="width: 150px; height: 50px; margin: 5px; ">
                                                                <i class="ti-pencil btn-icon-prepend"></i>
                                                                Edit
                                                            </button>
                                                        </a>

                                                        <!-- Second Row - Delete Button -->
                                                        <form action="/admin/delete-news/{{ $news->id }}"
                                                            method="post" class="deleteNews">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-danger btn-icon-text"
                                                                style="width: 150px; height: 50px; margin: 5px;">
                                                                <i class="ti-trash btn-icon-prepend"></i>
                                                                Delete
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>

                                                <td><img src="{{ $news->thumbnail }}"
                                                        alt="{{ $news->title }}'s thumbnail"
                                                        style="width: 40px; margin: 10px;"></td>
                                                <td>{{ $news->title }}</td>
                                                <td>{{ $news->category }}</td>
                                                <td>{{ $news->updatedBy->username }}</td>
                                                <td>{{ $news->posted_by }}</td>
                                                <td>{{ $news->updatedBy->username }}</td>
                                                <td>{{ $news->created_at }}</td>
                                                <td>{{ $news->updated_at }}</td>
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
