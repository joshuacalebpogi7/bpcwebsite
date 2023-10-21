<x-admin-manage-layout :jobs="$jobs">
    <div>
        <form action="/admin/update-jobs/{{ $jobs->id }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card mb-4 mb-xl-0">
                <div class="card-header">Job's Thumbnail</div>
                <div class="card-body text-center">


                    <img class="rounded img-fluid" id="img-preview" src="{{ $jobs->image }}" alt=""
                        data-prev-src="{{ $jobs->image }}">

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
                        Thumbnail</button>

                    <button class="btn btn-danger" id="cancelButton" style="display: none"
                        onclick="event.preventDefault(); cancelUpload()">Cancel</button>

                </div>
            </div>

            {{-- @php
                dd($events->thumbnail);
            @endphp --}}
            <div class="card mb-2 mt-3">
                <div class="card-header bg-primary bg-gradient text-white">Edit Jobs
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input class="form-control @error('title') is-invalid @enderror" type="text"
                                    placeholder="Title" name="title" id="title"
                                    value="{{ old('title', $jobs->title) }}">

                                @error('title')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="job-title">Job Title</label>
                                <input class="form-control @error('job_title') is-invalid @enderror" type="text"
                                    placeholder="Job title" name="job_title" id="job-title"
                                    value="{{ old('job_title', $jobs->job_title) }}">
                                @error('job_title')
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
                                <label for="salary">Salary</label>
                                <input class="form-control @error('salary') is-invalid @enderror" type="text"
                                    placeholder="Salary" name="salary" id="salary"
                                    value="{{ old('salary', $jobs->salary) }}">
                                @error('salary')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="company">Company</label>
                                <input class="form-control @error('company') is-invalid @enderror" type="text"
                                    placeholder="Company" name="company" id="company"
                                    value="{{ old('company', $jobs->company) }}">
                                @error('company')
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
                                <label for="location">Location</label>
                                <input class="form-control @error('location') is-invalid @enderror" type="text"
                                    placeholder="Location" name="location" id="location"
                                    value="{{ old('location', $jobs->location) }}">
                                @error('location')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select wire:model="status" class="form-control @error('status') is-invalid @enderror"
                                    name="status" id="status">
                                    <option value="" selected>--Select Status--
                                    </option>
                                    <option value="active"
                                        {{ old('status', $jobs->status) == 'active' ? 'selected' : '' }}>Active
                                    </option>
                                    <option value="archived"
                                        {{ old('status', $jobs->status) == 'archived' ? 'selected' : '' }}>
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
                    </div>

                    <div class="row">
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="myeditorinstance"
                                cols="30" rows="10">{{ old('description', $jobs->description) }}</textarea>

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
                                id="link" type="text" placeholder="News link"
                                value="{{ old('link', $jobs->link) }}">


                            @error('link')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>
                    </div>
                    <button class="btn btn-primary">Update Job</button>
                    <button type="reset" class="btn btn-danger">Reset</button>
                </div>
            </div>
        </form>
    </div>

</x-admin-manage-layout>
