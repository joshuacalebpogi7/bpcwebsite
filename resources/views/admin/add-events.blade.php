<x-admin-layout>
    <div>
        <form action="/admin/add-events" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="card mb-4 mb-xl-0">
                <div class="card-header">Event's Thumbnail</div>
                <div class="card-body text-center">


                    <img class="rounded img-fluid" id="img-preview" src="{{ old('thumbnail') }}" alt="">

                    <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>

                    <input id="getFile" class="form-control @error('thumbnail') is-invalid @enderror" name="thumbnail"
                        type="file" onchange="loadFile(event)" hidden>

                    @error('thumbnail')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                    <button class="btn btn-primary"
                        onclick="event.preventDefault(); document.getElementById('getFile').click()">Upload Event's
                        Thumbnail</button>

                    <button class="btn btn-danger" id="cancelButton" style="display: none"
                        onclick="event.preventDefault(); cancelUpload()">Cancel</button>

                </div>
            </div>

            <div class="card mb-2 mt-3">
                <div class="card-header bg-primary bg-gradient text-white">Add Event
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input class="form-control @error('title') is-invalid @enderror" type="text"
                                    placeholder="News title" name="title" id="title" value="{{ old('title') }}">

                                @error('title')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="category">Category</label>
                                <select class="form-control" name="category" id="category">
                                    <option value="" selected>--Select Category--
                                    </option>
                                    <option value="Campus" {{ old('category') == 'Campus' ? 'selected' : '' }}>Campus
                                    </option>
                                    <option value="Programs" {{ old('category') == 'Programs' ? 'selected' : '' }}>
                                        Programs
                                    </option>
                                </select>

                                @error('category')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="myeditorinstance"
                                    cols="30" rows="10">{{ old('description') }}</textarea>

                                @error('description')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="event-start">Event Start</label>
                                <input class="form-control @error('event_start') is-invalid @enderror"
                                    type="datetime-local" placeholder="Event Start" name="event_start" id="event_start"
                                    value="{{ old('event_start') }}">
                                @error('event_start')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="event-end">Event End</label>
                                <input class="form-control @error('event_end') is-invalid @enderror"
                                    type="datetime-local" placeholder="Event End" name="event_end" id="event_end"
                                    value="{{ old('event_end') }}">
                                @error('event_end')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <button class="btn btn-primary">Add Event</button>
                    <button type="reset" class="btn btn-danger">Reset</button>
                </div>
            </div>
        </form>
    </div>

</x-admin-layout>
