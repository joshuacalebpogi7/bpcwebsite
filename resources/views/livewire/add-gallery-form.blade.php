<div>
    @if (session()->has('success'))
    <div class="container container-narrow">
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    </div>
    @endif

    @if (session()->has('reject'))
    <div class="container container-narrow">
        <div class="alert alert-danger text-center">
            {{ session('reject') }}
        </div>
    </div>
    @endif

    <form wire:submit.prevent="addAlbum">
        @csrf

        <div class="card mb-2 mt-3">
            <div class="card-header bg-primary bg-gradient text-white">Add Album
            </div>
            <div class="card mb-4 mb-xl-0">
                <div class="card-header">Album Cover</div>
                <div class="card-body text-center">
                    <!-- Profile picture image-->
                    @if ($album_cover)
                    <img class="img-account-profile rounded-circle mb-2" src="{{ $album_cover->temporaryUrl() }}"
                        alt="">
                    @else
                    <img class="img-account-profile rounded-circle mb-2" src="{{ $galleryAlbum->album_cover }}" alt="">
                    @endif

                    <!-- Profile picture help block-->
                    <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>
                    <!-- Profile picture upload button-->

                    <input id="getFile" name="album_cover" type="file" wire:model="album_cover" hidden>
                    @error('album_cover')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <button class="btn btn-primary" onclick="document.getElementById('getFile').click()">Upload
                        new
                        image</button>
                    @if ($album_cover)
                    <button wire:click.ignore="resetAlbumCover" class="btn btn-danger">Cancel</button>
                    <button wire:click.ignore="updateAlbumCover" class="btn btn-success">Save</button>
                    @endif

                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="form-group">
                        <label for="album-name">Album Name</label>
                        <input wire:model="album_name" class="form-control" type="text" placeholder="Album Name"
                            name="album_name" id="album-name">
                        <span class="text-danger">
                            @error('album_name')
                            <p>{{ $message }}</p>
                            @enderror
                        </span>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group">
                        <label for="description">Description</label>
                        <input wire:model="description" class="form-control" name="description" id="description"
                            type="text" placeholder="Full Course Name">

                        <span class="text-danger">
                            @error('description')
                            <p>{{ $message }}</p>
                            @enderror
                        </span>
                    </div>
                </div>
                <button class="btn btn-primary" type="submit">Add Album</button>
                <button wire:click.prevent="resetAlbumForm" class="btn btn-danger">Reset</button>
            </div>
        </div>
    </form>



    @if (!$showAlbums)
    <button class="btn btn-success" wire:click.prevent="toggleShowAlbums">Show Albums</button>
    @else
    <button class="btn btn-danger" wire:click.prevent="toggleShowAlbums">Hide Albums</button>
    @endif

    @if ($showAlbums)
    <h2>Course List</h2>
    <div>
        <table class="table table-dark table-striped table-hover rounded shadow-lg">
            <thead>
                <tr>
                    <th>Action</th>
                    <th>Id</th>
                    <th>Album Name</th>
                    <th>Album Description</th>
                </tr>
            </thead>
            <!-- Table body -->
            <tbody>
                @foreach ($galleryAlbum as $album)
                @if ($albumIdToUpdate === $album->id)
                <!-- Edit form -->
                <tr>
                    <td>
                        <button class="btn btn-success" wire:click="updateAlbum">Save</button>
                        <button class="btn btn-danger" wire:click="cancelEdit">Cancel</button>
                    </td>
                    <td>{{ $album->id }}</td>
                    <td>
                        <div class="form-group">
                            <input class="form-control" wire:model="albumName" type="text">
                        </div>
                    </td>
                    <td>
                        <input class="form-control" wire:model="albumDescription" type="text">
                    </td>
                </tr>
                @else
                <!-- Display table row -->
                <tr>
                    <td>
                        <button class="btn btn-primary" wire:click="editAlbum({{ $album->id }})">Edit</button>

                        <button class="btn btn-danger" wire:click="deleteConfirmation({{ $album->id }})">Delete</button>
                    </td>
                    <td>{{ $album->id }}</td>
                    <td>{{ $album->name }}</td>
                    <td>{{ $album->description }}</td>
                </tr>
                @endif
                @endforeach
            </tbody>
        </table>
    </div>
    @endif

    <form wire:submit.prevent="addPhoto">
        @csrf

        <div class="card mt-5 mb-5">
            <div class="card-header bg-primary bg-gradient text-white">Add Photos
            </div>
            <div class="card-body">
                <div class="card mb-4 mb-xl-0">
                    <div class="card-header">Photo</div>
                    <div class="card-body text-center">
                        <!-- Profile picture image-->
                        @if ($photo)
                        <img class="img-account-profile rounded-circle mb-2" src="{{ $photo->temporaryUrl() }}" alt="">
                        @else
                        <img class="img-account-profile rounded-circle mb-2" src="{{ $gallery->photo }}" alt="">
                        @endif

                        <!-- Profile picture help block-->
                        <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>
                        <!-- Profile picture upload button-->

                        <input id="getFile" name="photo" type="file" wire:model="photo" hidden>
                        @error('photo')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <button class="btn btn-primary" onclick="document.getElementById('getFile').click()">Upload
                            new
                            image</button>
                        @if ($photo)
                        <button wire:click="resetPhoto" class="btn btn-danger">Cancel</button>
                        <button wire:click="updatePhoto" class="btn btn-success">Save</button>
                        @endif

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input wire:model="title" class="form-control" type="text" placeholder="Title" name="title"
                                id="title">
                            <span class="text-danger">
                                @error('title')
                                <p>{{ $message }}</p>
                                @enderror
                            </span>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="description">Description</label>
                            <input wire:model="description" class="form-control" type="text" placeholder="Description"
                                name="description" id="description">
                            <span class="text-danger">
                                @error('description')
                                <p>{{ $message }}</p>
                                @enderror
                            </span>
                        </div>
                    </div>
                </div>

                <button class="btn btn-primary" type="submit">Add</button>
                <button wire:click.prevent="resetAlumniFormConfirmation" class="btn btn-danger">Reset</button>
            </div>
        </div>

    </form>
</div>