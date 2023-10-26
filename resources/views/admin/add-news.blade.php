<x-admin-manage-layout>
    <div>
        <form action="/admin/add-news" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="card mb-4 mb-xl-0">
                <div class="card-header">News Thumbnail</div>
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
                        onclick="event.preventDefault(); document.getElementById('getFile').click()">Upload News
                        Thumbnail</button>

                    <button class="btn btn-danger" id="cancelButton" style="display: none"
                        onclick="event.preventDefault(); cancelUpload()">Cancel</button>

                </div>
            </div>

            <div class="card mb-2 mt-3">
                <div class="card-header bg-primary bg-gradient text-white">Add News
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
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
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="author">Author</label>
                                <input class="form-control @error('author') is-invalid @enderror" type="text"
                                    placeholder="News author" name="author" id="author" value="{{ old('author') }}">

                                @error('author')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="category">Category</label>
                                <select class="form-control" name="category" id="category">
                                    <option value="" selected>--Select Category--
                                    </option>
                                    <option value="All">All</option>
                                    <option value="Campus">Campus</option>
                                    <option value="Programs">Programs</option>
                                </select>
                                <span class="text-danger">
                                    @error('category')
                                        <p>{{ $message }}</p>
                                    @enderror
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="myeditorinstance"
                                cols="30" rows="10">{{ old('description', '**delete this text**<br> - feel free to format your text. <br> - no need to change font size or family. <br> - you can add emoticons if you want. <br> - every paragraph will be automatically indented so no need to indent it yourself.') }}</textarea>

                            @error('description')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>
                    </div>

                    <button class="btn btn-primary">Add News</button>
                    <button type="reset" class="btn btn-danger">Reset</button>
                </div>
            </div>
        </form>
    </div>

</x-admin-manage-layout>
