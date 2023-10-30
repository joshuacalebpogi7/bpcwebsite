<x-admin-layout :jobs="$jobs">
    <div>
        <form action="/admin/update-jobs/{{ $jobs->id }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

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
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="job-type">Job Type</label>
                                <input class="form-control @error('job_type') is-invalid @enderror" type="text"
                                    placeholder="Job Type" name="job_type" id="job-type"
                                    value="{{ old('job_type', $jobs->job_type) }}">

                                @error('job_type')
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
                        <div class="col-md-12">
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
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="link">Link (Optional)</label>
                                <input class="form-control @error('link') is-invalid @enderror" name="link"
                                    id="link" type="text" placeholder="Job link"
                                    value="{{ old('link', $jobs->link) }}">


                                @error('link')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary">Update Job</button>
                    <button type="reset" class="btn btn-danger">Clear changes</button>
                </div>
            </div>
        </form>
    </div>

</x-admin-layout>
