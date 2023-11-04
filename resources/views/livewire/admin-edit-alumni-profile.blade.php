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

    <div wire:loading.delay.longest>
        <div class="screen">
            <div class="loader">
                <div class="scene">
                    <span class="cloud cloud--small"></span>
                    <svg xmlns="http://www.w3.org/2000/svg" id="plane" class="plane" viewBox="0 0 104 47" x="0"
                        y="0" width="104" height="47" background-color="#ffffff00">
                        <g id="avion">
                            <path
                                d="M20 36C25 38 69 43 80 40 92 38 106 33 104 21 103 13 95 13 90 9 85 5 79 2 76 1 70-1 65 0 60 2 57 3 25 14 23 13 21 12 12 2 9 3 5 4 1 5 1 6 2 7 15 34 20 36Z"
                                fill="#0085b2" />
                            <path d="M23 36C28 37 69 43 80 40 88 38 98 34 102 29 82 32 22 36 23 36Z" stroke="#ffffff00"
                                stroke-width="1" fill="#14647f" />
                            <path d="M42 39C48 40 60 40 67 40 71 32 72 26 72 26L44 29C44 29 44 35 42 39Z"
                                stroke="#ffffff00" stroke-width="1" fill="#0c3b4d" />
                            <path d="M7 16C7 16 9 20 10 22 13 27 16 13 16 13L7 16Z" stroke="#ffffff00" stroke-width="1"
                                fill="#0c3b4d" />
                            <path d="M40 29C40 29 41 34 34 42 27 51 48 46 58 39 74 28 72 25 72 25L40 29Z"
                                stroke="#ffffff00" stroke-width="1" fill="#006e96" />
                            <path d="M5 14C5 14 6 15 3 19 1 22 10 20 13 17 19 11 17 11 17 11L5 14Z" stroke="#ffffff00"
                                stroke-width="1" fill="#006e96" />
                            <path d="M90 10C88 8 83 4 80 3 78 3 68 7 68 8 70 12 80 8 90 10Z" stroke="#ffffff00"
                                stroke-width="1" fill="#0c3b4d" />
                            <path d="M89 9C87 7 82 3 79 2 77 2 67 6 67 7 69 11 79 7 89 9Z" stroke="#ffffff00"
                                stroke-width="1" fill="#afe2ff" />
                        </g>
                    </svg>
                    <span class="cloud cloud--medium"></span>
                    <span class="cloud cloud--large"></span>
                </div>
            </div>
        </div>
    </div>
    {{-- @php
    dd($user->first_name);
    @endphp --}}

    <div class="col-xl-4">
        <!-- Profile picture card-->
        <div class="card mb-4 mb-xl-0"
            style="margin-bottom: 20px!important; margin-top: 10px;
        background: rgba(198, 218, 191, 0.67);
        border-radius: 16px;
        box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
        backdrop-filter: blur(14.1px);
        -webkit-backdrop-filter: blur(14.1px);
        border: 1px solid rgba(198, 218, 191, 0.3);">
            <div class="card-header">Profile Picture</div>
            <div class="card-body text-center">
                <!-- Profile picture image-->
                @if ($avatar)
                    <img class="img-account-profile rounded-circle mb-2" src="{{ $avatar->temporaryUrl() }}"
                        alt="" style="max-width: 100%; max-height: 250px; overflow: hidden; margin: 0 auto;">
                @else
                    <img class="img-account-profile rounded-circle mb-2" src="{{ $user->avatar }}" alt=""
                        style="max-width: 100%; max-height: 250px; overflow: hidden; margin: 0 auto;">
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
        <div class="card mb-4 mb-xl-0"
            style="
        background: rgba(198, 218, 191, 0.67);
        border-radius: 16px;
        box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
        backdrop-filter: blur(14.1px);
        -webkit-backdrop-filter: blur(14.1px);
        border: 1px solid rgba(198, 218, 191, 0.3);">
            <div class="card-header">Account Security</div>
            <div class="card-body">
                <form wire:submit.prevent="updateAccountSecurity">
                    @csrf
                    <div class="card"
                        style="
                    background: rgba(136, 212, 152, 0.66);
                    border-radius: 16px;
                    box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
                    backdrop-filter: blur(14.4px);
                    -webkit-backdrop-filter: blur(14.4px);
                    border: 1px solid rgba(136, 212, 152, 0.3);">
                        <div class="card-body">
                            <div class="row" style="flex-direction: column;">
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
                                        type="text" placeholder="New Password" name="new_password"
                                        id="new-password"
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
                    <button class="btn btn-primary" type="submit" style="margin: 10px;">Save changes</button>
                    <button wire:click.prevent="resetAccountSecurity" class="btn btn-danger">Clear changes</button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-xl-8">
        {{-- @php
        dd($email_sent == false);
        @endphp --}}
        <button wire:click.prevent="sendAccDetailsConfirmation"
            class="btn @if ($email_sent == true && !$email_verified) btn-success @elseif($email_verified)  @else btn-info @endif"
            @if ($email_verified) disabled @endif>
            @if ($email_sent == true && !$email_verified)
                Resend Email
            @elseif($email_verified)
                Verified <i class="fa-solid fa-circle-check" style="color: #1eaaf1;"></i>
            @else
                Send Email
            @endif
        </button>
        @if ($edit)
            <button wire:click.prevent="resetRestrictedEditConfirmation" class="btn btn-danger">Cancel</button>
        @else
            <button wire:click.prevent="allowRestrictedEditConfirmation" class="btn btn-warning"
                style="margin: 10px;">Allow edit
                all</button>
        @endif

        <!-- Account details card-->
        <div class="card mb-4"
            style="
        background: rgba(198, 218, 191, 0.67);
        border-radius: 16px;
        box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
        backdrop-filter: blur(14.1px);
        -webkit-backdrop-filter: blur(14.1px);
        border: 1px solid rgba(198, 218, 191, 0.3);">
            <div class="card-header">Account Details</div>
            <div class="card-body">
                <form wire:submit.prevent="updateProfile">
                    @csrf
                    <div class="card"
                        style="
                    background: rgba(136, 212, 152, 0.66);
                    border-radius: 16px;
                    box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
                    backdrop-filter: blur(14.4px);
                    -webkit-backdrop-filter: blur(14.4px);
                    border: 1px solid rgba(136, 212, 152, 0.3);">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="first-name">First name</label>
                                        <input wire:model="state.first_name"
                                            class="form-control @error('first_name') is-invalid @enderror"
                                            type="text" placeholder="First name" name="first_name"
                                            id="first-name">

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
                                <div class="col-md-3">
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
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="age">Age</label>
                                        <input wire:model="state.age"
                                            class="form-control @error('age') is-invalid @enderror" type="text"
                                            placeholder="Age" name="age" id="age" disabled readonly>
                                    </div>
                                </div>

                                <div class="col-md-3">
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
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="address">Full address</label>
                                        <input wire:model="state.address"
                                            class="form-control @error('address') is-invalid @enderror"
                                            type="text"
                                            placeholder="Street address, apt, suite, unit, building, floor, barangay, city, province, etc."
                                            name="address" id="address"
                                            @if ($edit == false) style="cursor: not-allowed;"
                                        disabled readonly @endif>

                                        @error('address')
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
                                        <label for="postal-code">Postal code</label>
                                        <input wire:model="state.postal_code"
                                            class="form-control @error('postal_code') is-invalid @enderror"
                                            type="text" placeholder="Postal code" name="postal_code"
                                            id="postal-code"
                                            @if ($edit == false) style="cursor: not-allowed;" disabled readonly @endif>

                                        @error('postal_code')
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
                                            {{ isset($state['employment_status']) && in_array($state['employment_status'], ['unemployed', ''])
                                                ? 'disabled'
                                                : '' }}
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
                                            {{ isset($state['employment_status']) &&
                                            in_array($state['employment_status'], ['unemployed', 'self-employed', ''])
                                                ? 'disabled'
                                                : '' }}
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
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="job-location">Job location</label>
                                        <input wire:model="state.job_location"
                                            {{ isset($state['employment_status']) &&
                                            in_array($state['employment_status'], ['unemployed', 'self-employed', ''])
                                                ? 'disabled'
                                                : '' }}
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
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="monthly-salary">Monthly salary</label>
                                        <input wire:model="state.monthly_salary"
                                            {{ isset($state['employment_status']) &&
                                            in_array($state['employment_status'], ['unemployed', 'self-employed', ''])
                                                ? 'disabled'
                                                : '' }}
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
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="category">Job Category</label>
                                        <select wire:model="state.category"
                                            class="form-control @error('category') is-invalid @enderror"
                                            name="category" id="category"
                                            {{ isset($state['employment_status']) && in_array($state['employment_status'], ['unemployed', '']) ? 'disabled' : '' }}@if ($edit == false) style="cursor: not-allowed;" disabled readonly @endif>
                                            <option value="" selected>--Job Category--</option>
                                            <option value="Sales and Marketing">
                                                Sales and Marketing
                                            </option>
                                            <option value="Customer Service">
                                                Customer Service
                                            </option>
                                            <option value="Human Resources">
                                                Human Resources</option>
                                            <option value="Accounting and Finance">
                                                Accounting and Finance</option>
                                            <option value="Engineering">
                                                Engineering</option>
                                            <option value="Information Technology (IT)">
                                                Information Technology (IT)</option>
                                            <option value="Research and Development">
                                                Research and Development</option>
                                            <option value="Management">
                                                Management</option>
                                            <option value="Healthcare and Medical">
                                                Healthcare and Medical</option>
                                            <option value="Legal">
                                                Legal</option>
                                            <option value="Teaching and Education">
                                                Teaching and Education</option>
                                            <option value="Design and Creative">
                                                Design and Creative</option>
                                            <option value="Manufacturing and Production">
                                                Manufacturing and Production</option>
                                            <option value="Operations">
                                                Operations</option>
                                            <option value="Customer Support">
                                                Customer Support</option>
                                            <option value="Administration">
                                                Administration</option>
                                        </select>
                                        <span class="text-danger">
                                            @error('category')
                                                <p>{{ $message }}</p>
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary" type="submit" style="margin: 10px">Save changes</button>
                    <button wire:click.prevent="resetProfileConfirmation" class="btn btn-danger">Clear
                        changes</button>
                </form>
            </div>
        </div>
    </div>
</div>
