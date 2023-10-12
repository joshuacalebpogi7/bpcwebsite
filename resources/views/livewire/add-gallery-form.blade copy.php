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
            <div class="card-header bg-primary bg-gradient text-white">Add Album</div>
            <div class="card mb-4 mb-xl-0">
                <div class="card-header">Album Cover</div>
                <div class="card-body text-center">
                    <!-- Album cover image -->
                    @if ($album_cover)
                    <img class="img-account-profile rounded-circle mb-2" src="{{ $album_cover->temporaryUrl() }}"
                        alt="">
                    @endif

                    <!-- Album cover help block -->
                    <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>

                    <!-- Album cover upload button -->
                    <input id="getFileAlbum" name="album_cover" type="file" wire:model="album_cover" hidden>
                    @error('album_cover')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <button class="btn btn-primary" onclick="document.getElementById('getFileAlbum').click()">Upload new
                        image</button>
                    @if ($album_cover)
                    <button wire:click.ignore="resetAlbumCover" class="btn btn-danger">Cancel</button>
                    <button wire:click.ignore="updateAlbumCover" class="btn btn-success">Save</button>
                    @endif
                </div>
            </div>
            <div class="card-body">
                <!-- Album Name input -->
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

                <!-- Album Description input -->
                <div class="row">
                    <div class="form-group">
                        <label for="description">Description</label>
                        <input wire:model="description" class="form-control" name="description" id="description"
                            type="text" placeholder="Description">
                        <span class="text-danger">
                            @error('description')
                            <p>{{ $message }}</p>
                            @enderror
                        </span>
                    </div>
                </div>

                <!-- Submit and Reset buttons -->
                <button class="btn btn-primary" type="submit">Add Album</button>
                <button wire:click.prevent="resetAlbumForm" class="btn btn-danger">Reset</button>
            </div>
        </div>
    </form>

    <!-- Show/Hide Albums button -->
    @if (!$showAlbums)
    <button class="btn btn-success" wire:click.prevent="toggleShowAlbums">Show Albums</button>
    @else
    <button class="btn btn-danger" wire:click.prevent="toggleShowAlbums">Hide Albums</button>
    @endif

    <!-- Album List -->
    @if ($showAlbums)
    <h2>Album List</h2>
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
            <tbody>
                @foreach ($albums as $album)
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

    <!-- Add Photo Form -->
    <form wire:submit.prevent="addPhoto">
        @csrf
        <div class="card mt-5 mb-5">
            <div class="card-header bg-primary bg-gradient text-white">Add Photos</div>
            <div class="card-body">
                <!-- Photo upload form elements -->
                <!-- Photo image -->
                <div class="card mb-4 mb-xl-0">
                    <div class="card-header">Photo</div>
                    <div class="card-body text-center">
                        @if ($photo)
                        <img class="img-account-profile rounded-circle mb-2" src="{{ $photo->temporaryUrl() }}" alt="">
                        @endif

                        <!-- Photo help block -->
                        <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>

                        <!-- Photo upload button -->
                        <input id="getFile" name="photo" type="file" wire:model="photo" hidden>
                        @error('photo')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <button class="btn btn-primary" onclick="document.getElementById('getFile').click()">Upload new
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

                    <!-- Album select -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="pic-album">Album</label>
                            <select wire:model="selectedAlbum" class="form-control" name="pic_album" id="pic-album">
                                <option value="" selected>--Select Album--</option>
                                @foreach ($albums as $album)
                                <option value="{{ $album->id }}">{{ $album->album_name }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger">
                                @error('selectedAlbum')
                                <p>{{ $message }}</p>
                                @enderror
                            </span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group">
                        <label for="gallery-description">Description</label>
                        <input wire:model="gallery_description" class="form-control" type="text"
                            placeholder="Description" name="gallery_description" id="gallery-description">

                        <span class="text-danger">
                            @error('gallery_description')
                            <p>{{ $message }}</p>
                            @enderror
                        </span>

                    </div>
                </div>


                <button class="btn btn-primary" type="submit">Add</button>
                <button wire:click.prevent="resetAlumniFormConfirmation" class="btn btn-danger">Reset</button>
            </div>
        </div>
    </form>
</div>