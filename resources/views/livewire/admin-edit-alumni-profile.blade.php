<div class="row">
    <div>
        @if (session()->has('accept'))
            <div class="container container-narrow">
                <div class="alert alert-success text-center">
                    {{ session('accept') }}
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

    {{-- @php
            dd($user->first_name);
        @endphp --}}

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
                <button class="btn btn-primary" onclick="document.getElementById('getFile').click()"
                    @if ($edit == false) style="cursor: not-allowed;" disabled readonly @endif>Upload
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
                                    <label for="username">Username/Student No.</label>
                                    <input wire:model="state.username"
                                        class="form-control @error('username') is-invalid @enderror @if ($this->state['username'] !== $this->user->username) is-valid @endif"
                                        type="username" placeholder="Username" name="username" id="username"
                                        @if ($edit == false) style="cursor: not-allowed;" disabled readonly @endif>
                                    @error('username')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input wire:model="state.email"
                                        class="form-control @error('email') is-invalid @enderror @if ($this->state['email'] !== $this->user->email) is-valid @endif"
                                        type="email" placeholder="Email" name="email" id="email"
                                        @if ($edit == false) style="cursor: not-allowed;" disabled readonly @endif>
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    Old Password
                                    @if ($user->default_password)
                                        <span class="alert text-success">{{ $user->default_password }}</span>
                                    @else
                                        <span class="alert text-danger">password has been changed by the
                                            user</span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="new-password">New Password</label>
                                    <input wire:model="new_password"
                                        class="form-control @error('new_password') is-invalid @enderror @if ($new_password) is-valid @endif"
                                        type="text" placeholder="New Password" name="new_password" id="new-password"
                                        @if ($edit == false) style="cursor: not-allowed;" disabled readonly @endif>
                                    @if ($edit == true)
                                        <button class="btn btn-success" wire:click.prevent="generatePassword">Generate
                                            Password</button>
                                    @endif
                                    @error('new_password')
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
        {{-- @php
            dd($email_sent == false);
        @endphp --}}
        <button wire:click.prevent="sendAccDetailsConfirmation"
            class="btn @if ($email_sent == true) btn-success @else btn-info @endif">
            @if ($email_sent == true)
                Resend Email
            @else
                Send Email
            @endif
        </button>
        @if ($edit)
            <button wire:click.prevent="resetRestrictedEditConfirmation" class="btn btn-danger">Cancel</button>
        @else
            <button wire:click.prevent="allowRestrictedEditConfirmation" class="btn btn-warning">Allow edit
                all</button>
        @endif

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
                                        <input wire:model="state.first_name"
                                            class="form-control @error('first_name') is-invalid @enderror"
                                            type="text" placeholder="First name" name="first_name" id="first-name">

                                        @error('first_name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror

                                    </div>
                                </div>


                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="middle-name">Middle name</label>
                                        <input wire:model="state.middle_name"
                                            class="form-control @error('middle_name') is-invalid @enderror"
                                            type="text" placeholder="Middle name" name="middle_name"
                                            id="middle-name">

                                        @error('middle_name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror

                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="last-name">Last name</label>
                                        <input wire:model="state.last_name"
                                            class="form-control @error('last_name') is-invalid @enderror"
                                            type="text" placeholder="Last name" name="last_name" id="last-name">

                                        @error('last_name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror

                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="birthday">Birthday</label>
                                        <input wire:model="state.birthday"
                                            class="form-control @error('birthday') is-invalid @enderror"
                                            type="date" name="birthday" id="birthday">

                                        @error('birthday')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror

                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="civil-status">Civil status</label>
                                        <select wire:model="state.civil_status"
                                            class="form-control @error('civil_status') is-invalid @enderror"
                                            name="civil_status" id="civil-status"
                                            @if ($edit == false) style="cursor: not-allowed;" disabled readonly @endif>
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
                                        <select wire:model="state.gender"
                                            class="form-control @error('gender') is-invalid @enderror" name="gender"
                                            id="gender">
                                            <option value="" selected>--Select Gender--</option>
                                            <option value="male">Male
                                            </option>
                                            <option value="female">
                                                Female
                                            </option>
                                        </select>

                                        @error('gender')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror

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
                                            id="contact-no"
                                            @if ($edit == false) style="cursor: not-allowed;" disabled readonly @endif>
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
                                        <select wire:model="state.course"
                                            class="form-control @error('course') is-invalid @enderror" name="course"
                                            id="course">
                                            <option value="" selected>--Select Course--</option>
                                            @foreach ($courses as $course)
                                                <option value="{{ $course->course }}">{{ $course->description }}
                                                </option>
                                            @endforeach
                                        </select>

                                        @error('course')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror

                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="year-graduated">Year graduated</label>
                                        <input wire:model="state.year_graduated"
                                            class="form-control @error('year_graduated') is-invalid @enderror"
                                            type="text" placeholder="Year graduated" name="year_graduated"
                                            id="year-graduated">

                                        @error('year_graduated')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group">
                                    <label for="address">Full address</label>
                                    <input wire:model="state.address"
                                        class="form-control @error('address') is-invalid @enderror" type="text"
                                        placeholder="Street address, apt, suite, unit, building, floor, barangay, city, province, etc."
                                        name="address" id="address"
                                        @if ($edit == false) style="cursor: not-allowed;" disabled readonly @endif>

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
                                        class="form-control @error('postal_code') is-invalid @enderror"
                                        type="text" placeholder="Postal code" name="postal_code" id="postal-code"
                                        @if ($edit == false) style="cursor: not-allowed;" disabled readonly @endif>

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
                                            name="employment_status" id="employment-status"
                                            @if ($edit == false) style="cursor: not-allowed;" disabled readonly @endif>
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
                                            type="text" placeholder="Job type" name="job_type" id="job-type"
                                            @if ($edit == false) style="cursor: not-allowed;" disabled readonly @endif>

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
                                            id="job-position"
                                            @if ($edit == false) style="cursor: not-allowed;" disabled readonly @endif>

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
                                        id="job-location"
                                        @if ($edit == false) style="cursor: not-allowed;" disabled readonly @endif>

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
                                        id="monthly-salary"
                                        @if ($edit == false) style="cursor: not-allowed;" disabled readonly @endif>

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
                    <button wire:click.prevent="resetProfileConfirmation" class="btn btn-danger">Reset</button>
                </form>
            </div>
        </div>
    </div>
</div>
