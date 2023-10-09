<x-admin-layout>
    <h2>Gallery</h2>
    <div>
        <a href="/admin/add-gallery"><button class="btn btn-primary mb-3">Add Gallery</button></a>
    </div>
    <div>
        <table id="example" class="table table-light table-striped table-hover rounded shadow-sm" style="width:100%">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Action</th>
                    <th>Thumbnail</th>
                    <th>Title</th>
                    <th>Album</th>
                    <th>Album Cover</th>
                    <th>Posted by</th>
                    <th>Created at</th>
                    <th>Updated at</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($gallery as $galleryItem)
                <tr>
                    <th>{{ $galleryItem->id }}</th>
                    {{-- separate row --}}
                    <td>
                        <div class="d-flex flex-column">
                            <!-- First Row - Edit Button -->
                            <a href="/admin/edit-photo/{{ $galleryItem->id }}/{{ $galleryItem->title }}"
                                class="flex-fill">
                                <button class="btn btn-success me-1 w-100 h-100">View</button>
                            </a>

                            <!-- Second Row - Delete Button -->
                            <form action="/admin/delete-photo/{{ $galleryItem->id }}" method="post"
                                class="deleteEvents">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger mt-1 flex-fill w-100 h-100">Delete</button>
                            </form>
                        </div>
                    </td>

                    <td><img src="{{ $galleryItem->photo }}" alt="{{ $galleryItem->title }}'s thumbnail"
                            style="width: 40px; margin: 10px;"></td>
                    <td>{{ $galleryItem->title }}</td>
                    <td>{{ $galleryItem->album->album_name }}</td>
                    <td><img src="{{ $galleryItem->album->album_cover }}"
                            alt="{{ $galleryItem->album->album_name }}'s thumbnail" style="width: 40px; margin: 10px;">
                    </td>
                    <td>{{ $galleryItem->updated_by }}</td>
                    <td>{{ $galleryItem->created_at }}</td>
                    <td>{{ $galleryItem->updated_at }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</x-admin-layout>