{{-- <hr class="mt-0 mb-4"> --}}
{{-- the line of code above is causing the livewire to bug --}}

<div class="row">
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
    </div>
    <div class="col-xl-4">
        <!-- Profile picture card-->
        <div class="card mb-4 mb-xl-0">
            <div class="card-header">Profile Picture</div>
            <div class="card-body text-center">
                <!-- Profile picture image-->
                @if ($avatar)
                    <img class="img-account-profile rounded-circle mb-2" src="{{ $avatar->temporaryUrl() }}"
                        alt="">
                @else
                    <img class="img-account-profile rounded-circle mb-2" src="{{ $user->avatar }}" alt="">
                @endif

                <!-- Profile picture help block-->
                <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>
                <!-- Profile picture upload button-->

                <input id="getFile" name="avatar" type="file" wire:model="avatar" hidden>
                @error('avatar')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <button class="btn btn-primary" onclick="document.getElementById('getFile').click()">Upload
                    new
                    image</button>
                @if ($avatar)
                    <button wire:click="resetAvatar" class="btn btn-danger">Cancel</button>
                    <button wire:click="updateAvatar" class="btn btn-success">Save</button>
                @endif

            </div>
        </div>

        <!-- Profile picture card-->
        <div class="card mb-4 mb-xl-0">
            <div class="card-header">Account Security</div>
            <div class="card-body">
                <form wire:submit.prevent="updateAccountSecurity">
                    @csrf
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input wire:model="state.email" class="form-control" type="email"
                                        placeholder="Email" name="email" id="email" style="cursor: not-allowed;"
                                        disabled readonly>
                                    <span class="text-danger">
                                        @error('email')
                                            <p>{{ $message }}</p>
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group">
                                    <label for="username">Username/Student No.</label>
                                    <input wire:model="state.username" class="form-control" type="text"
                                        placeholder="Username" name="username" id="username"
                                        style="cursor: not-allowed;" disabled readonly>
                                    <span class="text-danger">
                                        @error('username')
                                            <p>{{ $message }}</p>
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group">
                                    <label for="old-password">Old Password</label>
                                    <input wire:model="old_password"
                                        class="form-control @error('old_password') is-invalid @enderror @if ($old_password) is-valid @endif"
                                        type="password" placeholder="Old Password" name="old_password"
                                        id="old-password">

                                    @error('old_password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                </div>

                                <div class="form-group">
                                    <label for="new-password">New Password</label>
                                    <input wire:model="new_password"
                                        class="form-control @error('new_password') is-invalid @enderror @if ($new_password) is-valid @endif"
                                        type="password" placeholder="New Password" name="new_password"
                                        id="new-password">

                                    @error('new_password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                </div>

                                <div class="form-group">
                                    <label for="confirm-password">Confirm Password</label>
                                    <input wire:model="confirm_password"
                                        class="form-control @error('confirm_password') is-invalid @enderror @if ($confirm_password) is-valid @endif"
                                        type="password" placeholder="Confirm Password" name="confirm_password"
                                        id="confirm-password">

                                    @error('confirm_password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                </div>

                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary" type="submit">Save changes</button>
                    <button wire:click.prevent="resetAccountSecurity" class="btn btn-danger">Reset</button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-xl-8">
        <!-- Account details card-->
        <div class="card mb-4">
            <div class="card-header">Account Details</div>
            <div class="card-body">
                <form wire:submit.prevent="updateProfile">
                    @csrf
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="first-name">First name</label>
                                        <input wire:model="state.first_name" class="form-control" type="text"
                                            placeholder="First name" name="first_name" id="first-name"
                                            style="cursor: not-allowed;" disabled readonly>
                                        {{-- @php
                                            dd($this->state['first_name']);
                                        @endphp --}}
                                        <span class="text-danger">
                                            @error('state.first_name')
                                                <p>{{ $message }}</p>
                                            @enderror
                                        </span>
                                    </div>
                                </div>


                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="middle-name">Middle name</label>
                                        <input wire:model="state.middle_name" class="form-control" type="text"
                                            placeholder="Middle name" name="middle_name" id="middle-name"
                                            style="cursor: not-allowed;" disabled readonly>
                                        <span class="text-danger">
                                            @error('state.middle_name')
                                                <p>{{ $message }}</p>
                                            @enderror
                                        </span>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="last-name">Last name</label>
                                        <input wire:model="state.last_name" class="form-control" type="text"
                                            placeholder="Last name" name="last_name" id="last-name"
                                            style="cursor: not-allowed;" disabled readonly>
                                        <span class="text-danger">
                                            @error('state.last_name')
                                                <p>{{ $message }}</p>
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="birthday">Birthday</label>
                                        <input wire:model="state.birthday" class="form-control" type="date"
                                            name="birthday" id="birthday" style="cursor: not-allowed;" disabled
                                            readonly>
                                        <span class="text-danger">
                                            @error('state.birthday')
                                                <p>{{ $message }}</p>
                                            @enderror
                                        </span>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="civil-status">Civil status</label>
                                        <select wire:model="state.civil_status"
                                            class="form-control @error('civil_status') is-invalid @enderror"
                                            name="civil_status" id="civil-status">
                                            <option value="" selected>--Select Civil Status--</option>
                                            <option value="single">
                                                Single</option>
                                            <option value="married">
                                                Married</option>
                                            <option value="separated">
                                                Separated</option>
                                            <option value="widowed">
                                                Widowed</option>
                                        </select>
                                        @error('civil_status')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="gender">Gender</label>
                                        <select wire:model="state.gender" class="form-control" name="gender"
                                            id="gender" style="cursor: not-allowed;" disabled readonly>
                                            <option value="" selected>--Select Gender--</option>
                                            <option value="male">Male
                                            </option>
                                            <option value="female">
                                                Female
                                            </option>
                                        </select>
                                        <span class="text-danger">
                                            @error('state.gender')
                                                <p>{{ $message }}</p>
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="contact-no">Contact number</label>
                                        <input wire:model="state.contact_no"
                                            class="form-control @error('contact_no') is-invalid @enderror"
                                            type="text" placeholder="Contact number" name="contact_no"
                                            id="contact-no">
                                        @error('contact_no')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="course">Course</label>
                                        <select wire:model="state.course" class="form-control" name="course"
                                            id="course" style="cursor: not-allowed;" disabled readonly>
                                            <option value="" selected>--Select Course--</option>
                                            @foreach ($courses as $course)
                                                <option value="{{ $course->course }}">{{ $course->description }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger">
                                            @error('state.course')
                                                <p>{{ $message }}</p>
                                            @enderror
                                        </span>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="year-graduated">Year graduated</label>
                                        <input wire:model="state.year_graduated" class="form-control" type="text"
                                            placeholder="Year graduated" name="year_graduated" id="year-graduated"
                                            disabled readonly>
                                        <span class="text-danger" style="cursor: not-allowed;">
                                            @error('state.year_graduated')
                                                <p>{{ $message }}</p>
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group">
                                    <label for="address">Full address</label>
                                    <input wire:model="state.address"
                                        class="form-control @error('address') is-invalid @enderror" type="text"
                                        placeholder="Street address, apt, suite, unit, building, floor, barangay, city, province, etc."
                                        name="address" id="address">

                                    @error('address')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <label for="postal-code">Postal code</label>
                                    <input wire:model="state.postal_code"
                                        class="form-control @error('postal_code') is-invalid @enderror" type="text"
                                        placeholder="Postal code" name="postal_code" id="postal-code">

                                    @error('postal_code')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="employment-status">Employment status</label>
                                        <select wire:model="state.employment_status"
                                            class="form-control @error('employment_status') is-invalid @enderror"
                                            name="employment_status" id="employment-status">
                                            <option value="" selected>--Select Employment Status--
                                            </option>
                                            <option value="unemployed">
                                                Unemployed
                                            </option>
                                            <option value="employed">
                                                Employed
                                            </option>
                                            <option value="self-employed">
                                                Self-employed</option>
                                        </select>

                                        @error('employment_status')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror

                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="job-type">Job type</label>
                                        <input wire:model="state.job_type"
                                            {{ isset($state['employment_status']) && in_array($state['employment_status'], ['unemployed', '']) ? 'disabled' : '' }}
                                            class="form-control @error('job_type') is-invalid @enderror"
                                            type="text" placeholder="Job type" name="job_type" id="job-type">

                                        @error('job_type')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror

                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="job-position">Job position</label>
                                        <input wire:model="state.job_position"
                                            {{ isset($state['employment_status']) && in_array($state['employment_status'], ['unemployed', 'self-employed', '']) ? 'disabled' : '' }}
                                            class="form-control @error('job_position') is-invalid @enderror"
                                            type="text" placeholder="Job position" name="job_position"
                                            id="job-position">

                                        @error('job_position')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror

                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group">
                                    <label for="job-location">Job location</label>
                                    <input wire:model="state.job_location"
                                        {{ isset($state['employment_status']) && in_array($state['employment_status'], ['unemployed', 'self-employed', '']) ? 'disabled' : '' }}
                                        class="form-control @error('job_location') is-invalid @enderror"
                                        type="text" placeholder="Job location" name="job_location"
                                        id="job-location">

                                    @error('job_location')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group">
                                    <label for="monthly-salary">Monthly salary</label>
                                    <input wire:model="state.monthly_salary"
                                        {{ isset($state['employment_status']) && in_array($state['employment_status'], ['unemployed', 'self-employed', '']) ? 'disabled' : '' }}
                                        class="form-control @error('monthly_salary') is-invalid @enderror"
                                        type="text" placeholder="Monthly salary" name="monthly_salary"
                                        id="monthly-salary">

                                    @error('monthly_salary')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                </div>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary" type="submit">Save changes</button>
                    <button wire:click.prevent="resetProfile" class="btn btn-danger">Reset</button>
                </form>
            </div>
        </div>
    </div>
</div>
