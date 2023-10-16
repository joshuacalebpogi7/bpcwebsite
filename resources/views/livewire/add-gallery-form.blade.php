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
        <div class="row">
            <div class="col-md-6">
                <div class="card mb-4 mb-md-0">
                    <div class="card-header">Create Album</div>
                    <div class="card-body">
                        <!-- Album Name input -->
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

                        <!-- Album Description input -->
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
                </div>
            </div>
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header">Upload Photos</div>
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
                        <button type="button" wire:click="resetErrorMessage" class="btn btn-primary"
                            onclick="document.getElementById('getFile').click()">Upload new
                            image</button>
                        @if ($photo)
                        <button wire:click.prevent="resetPhoto" class="btn btn-danger">Cancel</button>
                        <button wire:click.prevent="addPhoto" class="btn btn-success">Save Photo</button>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Display uploaded photos with descriptions -->
        @if ($temporaryPhotos)
        <div class="row">
            @foreach ($temporaryPhotos as $index => $photo)
            <div class="col-12 col-sm-8 col-md-6 col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <img class="card-img-top" src="{{ asset('storage/photos/' . $photo['photo']) }}" alt="pogiii">

                        <div class="card-body">
                            <input wire:model="temporaryPhotos.{{ $index }}.gallery_description" class="form-control"
                                type="text" placeholder="Description"
                                name="temporaryPhotos.{{ $index }}.gallery_description" id="gallery-description"
                                wire:key="{{ $index }}">
                            <span class="text-danger">
                                @error('temporaryPhotos.' . $index . '.gallery_description')
                                <p>{{ $message }}</p>
                                @enderror
                            </span>
                        </div>
                        <button wire:click.prevent="removePhoto({{ $index }})" class="btn btn-primary"
                            type="button">Remove Photo</button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif

        <!-- Submit and Reset buttons -->
        <div class="row">
            <div class="col-md-6">
                <button class="btn btn-primary" type="submit">Add Album</button>
                <button wire:click.prevent="resetAlbumForm" class="btn btn-danger">Reset</button>
            </div>
        </div>
    </form>
</div>