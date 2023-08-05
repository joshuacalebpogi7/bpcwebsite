<x-admin-layout>
    <h2>News</h2>
    <div>
        <a href="/admin/add-news"><button class="btn btn-primary mb-3">Add News</button></a>
    </div>
    <div>
        <table id="example" class="table table-light table-striped table-hover rounded shadow-sm" style="width:100%">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Action</th>
                    <th>Thumbnail</th>
                    <th>Title</th>
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
                                <a href="/admin/edit-news/{{ $news->id }}/{{ $news->title }}" class="flex-fill">
                                    <button class="btn btn-success me-1 w-100 h-100">View</button>
                                </a>

                                <!-- Second Row - Delete Button -->
                                <form action="/admin/delete-news/{{ $news->id }}" method="post" class="deleteNews">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger mt-1 flex-fill w-100 h-100">Delete</button>
                                </form>
                            </div>
                        </td>

                        <td><img src="{{ $news->thumbnail }}" alt="{{ $news->title }}'s thumbnail"
                                style="width: 40px; margin: 10px;"></td>
                        <td>{{ $news->title }}</td>
                        <td>{{ $news->author }}</td>
                        <td>{{ $news->posted_by }}</td>
                        <td>{{ $news->updated_by }}</td>
                        <td>{{ $news->created_at }}</td>
                        <td>{{ $news->updated_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</x-admin-layout>
