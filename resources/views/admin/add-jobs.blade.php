<x-admin-manage-layout>
    <div>

        <form action="/admin/add-jobs" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="card mb-4 mb-xl-0">
                <div class="card-header">Add Image(Optional)</div>
                <div class="card-body text-center">


                    <img class="rounded img-fluid" id="img-preview" src="{{ old('image') }}" alt="">

                    <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>

                    <input id="getFile" class="form-control @error('image') is-invalid @enderror" name="image"
                        type="file" onchange="loadFile(event)" hidden>

                    @error('image')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                    <button class="btn btn-primary"
                        onclick="event.preventDefault(); document.getElementById('getFile').click()">Upload Job's
                        Image</button>

                    <button class="btn btn-danger" id="cancelButton" style="display: none"
                        onclick="event.preventDefault(); cancelUpload()">Cancel</button>

                </div>
            </div>

            <div class="card mb-2 mt-3">
                <div class="card-header bg-primary bg-gradient text-white">Add Jobs
                </div>
                <div class="card-body">
                    <div class="row">
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

                    <div class="row">
                        <div class="form-group">
                            <label for="job-title">Job Title</label>
                            <input class="form-control @error('job_title') is-invalid @enderror" type="text"
                                placeholder="Job title" name="job_title" id="job-title" value="{{ old('job_title') }}">
                            @error('job_title')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group">
                            <label for="company">Company</label>
                            <input class="form-control @error('company') is-invalid @enderror" type="text"
                                placeholder="Company" name="company" id="company" value="{{ old('company') }}">
                            @error('company')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="status">Status</label>
                            <select wire:model="status" class="form-control @error('status') is-invalid @enderror"
                                name="status" id="status">
                                <option value="" selected>--Select Status--
                                </option>
                                <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active
                                </option>
                                <option value="archived" {{ old('status') == 'archived' ? 'selected' : '' }}>
                                    Archived
                                </option>
                            </select>

                            @error('status')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

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

                    <div class="row">
                        <div class="form-group">
                            <label for="link">Link (Optional)</label>
                            <input class="form-control @error('link') is-invalid @enderror" name="link"
                                id="link" type="text" placeholder="News link" value="{{ old('link') }}">


                            @error('link')
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
