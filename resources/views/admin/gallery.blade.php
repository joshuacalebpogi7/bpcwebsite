<x-admin-layout>
    <h2>Gallery Records</h2>
    <div>
        <a href="/admin/add-gallery"><button class="btn btn-primary mb-3"><img
                    src="{{ URL::asset('/images/icon-plus.svg') }}"> Add Gallery</button></a>
    </div>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <p class="card-title">Album Table</p>
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table id="example"
                                    class="table table-light table-striped table-hover rounded shadow-sm"
                                    style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Action</th>
                                            <th>Album Cover</th>
                                            <th>Album Name</th>
                                            <th>Photos</th>
                                            <th>Posted by</th>
                                            <th>Created at</th>
                                            <th>Updated at</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($galleryAlbum as $album)
                                            <tr>
                                                <th>{{ $album->id }}</th>
                                                {{-- separate row --}}
                                                <td>
                                                    <div class="d-flex flex-column">
                                                        <!-- First Row - Edit Button -->
                                                        <a href="/admin/edit-album/{{ $album->id }}/{{ $album->album_name }}"
                                                            class="flex-fill">
                                                            <button
                                                                class="btn btn-success me-1 w-100 h-100">View</button>
                                                        </a>

                                                        <!-- Second Row - Delete Button -->
                                                        <form action="/admin/delete-album/{{ $album->id }}"
                                                            method="post" class="deleteAlbum">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button
                                                                class="btn btn-danger mt-1 flex-fill w-100 h-100">Delete</button>
                                                        </form>
                                                    </div>
                                                </td>

                                                <td><img src="{{ $album->album_cover }}"
                                                        alt="{{ $album->album_name }}'s thumbnail"
                                                        style="width: 40px; margin: 10px;"></td>
                                                <td>{{ $album->album_name }}</td>
                                                {{-- <td>{{ $photos->where('gallery_album_id', $album->id)->count() }}</td> --}}
                                                <td>{{ $album->pictures->count() }}</td>
                                                <td>{{ $album->updated_by }}</td>
                                                <td>{{ $album->created_at }}</td>
                                                <td>{{ $album->updated_at }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

</x-admin-layout>
