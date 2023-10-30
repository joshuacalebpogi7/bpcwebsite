<x-admin-layout>
    <div>

        <form action="/admin/add-jobs" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="card mb-2 mt-3">
                <div class="card-header bg-primary bg-gradient text-white">Add Jobs
                </div>
                <div class="card-body">
                    <div class="row">

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="job-title">Job Title</label>
                                <input class="form-control @error('job_title') is-invalid @enderror" type="text"
                                    placeholder="Job title" name="job_title" id="job-title"
                                    value="{{ old('job_title') }}">
                                @error('job_title')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="job-type">Job Type</label>
                                <select wire:model="job_type"
                                    class="form-control @error('job_type') is-invalid @enderror" name="job_type"
                                    id="job-type">
                                    <option value="" selected>--Select Job Type--
                                    </option>
                                    <option value="full-time" {{ old('job_type') == 'full-time' ? 'selected' : '' }}>
                                        Full Time
                                    </option>
                                    <option value="part-time" {{ old('job_type') == 'part-time' ? 'selected' : '' }}>
                                        Part Time
                                    </option>
                                    <option value="freelance" {{ old('job_type') == 'freelance' ? 'selected' : '' }}>
                                        Freelance
                                    </option>
                                </select>

                                @error('job_type')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="category">Job Category</label>
                                <select wire:model="category"
                                    class="form-control @error('category') is-invalid @enderror" name="category"
                                    id="category">
                                    <option value="" selected>--Select Job Category--
                                    </option>
                                    <option value="Sales and Marketing"
                                        {{ old('category') == 'Sales and Marketing' ? 'selected' : '' }}>
                                        Sales and Marketing
                                    </option>
                                    <option value="Customer Service"
                                        {{ old('category') == 'Customer Service' ? 'selected' : '' }}>
                                        Customer Service
                                    </option>
                                    <option value="Human Resources"
                                        {{ old('category') == 'Human Resources' ? 'selected' : '' }}>
                                        Human Resources</option>
                                    <option value="Accounting and Finance"
                                        {{ old('category') == 'Accounting and Finance' ? 'selected' : '' }}>
                                        Accounting and Finance</option>
                                    <option value="Engineering"
                                        {{ old('category') == 'Engineering' ? 'selected' : '' }}>
                                        Engineering</option>
                                    <option value="Information Technology (IT)"
                                        {{ old('category') == 'Information Technology (IT)' ? 'selected' : '' }}>
                                        Information Technology (IT)</option>
                                    <option value="Research and Development"
                                        {{ old('category') == 'Research and Development' ? 'selected' : '' }}>
                                        Research and Development</option>
                                    <option value="Management" {{ old('category') == 'Management' ? 'selected' : '' }}>
                                        Management</option>
                                    <option value="Healthcare and Medical"
                                        {{ old('category') == 'Healthcare and Medical' ? 'selected' : '' }}>
                                        Healthcare and Medical</option>
                                    <option value="Legal" {{ old('category') == 'Legal' ? 'selected' : '' }}>
                                        Legal</option>
                                    <option value="Teaching and Education"
                                        {{ old('category') == 'eaching and Education' ? 'selected' : '' }}>
                                        Teaching and Education</option>
                                    <option value="Design and Creative"
                                        {{ old('category') == 'Design and Creative' ? 'selected' : '' }}>
                                        HDesign and Creative</option>
                                    <option value="Manufacturing and Production"
                                        {{ old('category') == 'Manufacturing and Production' ? 'selected' : '' }}>
                                        Manufacturing and Production</option>
                                    <option value="Operations" {{ old('category') == 'Operations' ? 'selected' : '' }}>
                                        Operations</option>
                                    <option value="Customer Support"
                                        {{ old('category') == 'Customer Support' ? 'selected' : '' }}>
                                        Customer Support</option>
                                    <option value="Administration"
                                        {{ old('category') == 'Administration' ? 'selected' : '' }}>
                                        Administration</option>
                                </select>

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
                                    placeholder="Salary" name="salary" id="salary" value="{{ old('salary') }}">
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
                                    placeholder="Company" name="company" id="company" value="{{ old('company') }}">
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
                                    value="{{ old('location') }}">
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
                                    <option value="">--Select Status--
                                    </option>
                                    <option value="active" {{ old('status') == 'active' ? 'selected' : '' }} selected>
                                        Active
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
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="responsibilities">Responsibilities</label>
                                <textarea class="form-control @error('responsibilities') is-invalid @enderror" name="responsibilities"
                                    id="responsibilities" cols="30" rows="10">{{ old('responsibilities', '<ul>1st Responsibility</ul><ul>2nd Responsibility</ul><ul>3rd Responsibility</ul>') }}</textarea>

                                @error('responsibilities')
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
                                <label for="requirements">Requirements</label>
                                <textarea class="form-control @error('requirements') is-invalid @enderror" name="requirements" id="requirements"
                                    cols="30" rows="10">{{ old('requirements', '<ul>1st Requirement</ul><ul>2nd Requirement</ul><ul>3rd Requirement</ul>') }}</textarea>

                                @error('requirements')
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
                                <label for="link">Website Link (Optional)</label>
                                <input class="form-control @error('link') is-invalid @enderror" name="link"
                                    id="link" type="text" placeholder="Job Company Website Link"
                                    value="{{ old('link') }}">


                                @error('link')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input class="form-control @error('email') is-invalid @enderror" name="email"
                                    id="email" type="text" placeholder="Job Company Email"
                                    value="{{ old('email') }}">


                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary">Add Job</button>
                    <button type="reset" class="btn btn-danger">Clear changes</button>
                </div>
            </div>
        </form>
    </div>

</x-admin-layout>
