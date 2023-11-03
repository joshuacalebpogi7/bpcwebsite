<div>
    {{-- @php
        dd($isSubmitting);
    @endphp --}}
    <div wire:loading.delay.longest>
        <div class="screen">
            <div class="loader">
                <div class="dot"></div>
                <div class="dot"></div>
                <div class="dot"></div>
            </div>
        </div>
    </div>

    <form wire:submit.prevent="addAlumniConfirmation">
        @csrf

        <div class="card mt-5 mb-5">
            <div class="card-header bg-primary bg-gradient text-white">Add Alumni
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="student-no">Student Number</label>
                            <input wire:model="student_no" class="form-control" type="text" placeholder="Student No."
                                name="student_no" id="student-no">
                            <span class="text-danger">
                                @error('student_no')
                                    <p>{{ $message }}</p>
                                @enderror
                            </span>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="course">Course</label>
                            <select wire:model="course_alumni" class="form-control" name="course" id="course">
                                <option value="" selected>--Select Course--
                                </option>
                                @foreach ($courses as $course)
                                    <option value="{{ $course->course }}">
                                        {{ $course->description }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger">
                                @error('course_alumni')
                                    <p>{{ $message }}</p>
                                @enderror
                            </span>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="year-graduated">Year Graduated</label>
                            <input wire:model="year_graduated" class="form-control" type="text"
                                placeholder="Year Graduated" name="year_graduated" id="year-graduated">
                            <span class="text-danger">
                                @error('year_graduated')
                                    <p>{{ $message }}</p>
                                @enderror
                            </span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="first-name">First name</label>
                            <input wire:model="first_name" class="form-control" type="text" placeholder="First name"
                                name="first_name" id="first-name">
                            <span class="text-danger">
                                @error('first_name')
                                    <p>{{ $message }}</p>
                                @enderror
                            </span>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="middle-name">Middle name</label>
                            <input wire:model="middle_name" class="form-control" type="text"
                                placeholder="Middle name" name="middle_name" id="middle-name">
                            <span class="text-danger">
                                @error('middle_name')
                                    <p>{{ $message }}</p>
                                @enderror
                            </span>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="last-name">Last name</label>
                            <input wire:model="last_name" class="form-control" type="text" placeholder="Last name"
                                name="last_name" id="last-name">
                            <span class="text-danger">
                                @error('last_name')
                                    <p>{{ $message }}</p>
                                @enderror
                            </span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="contact_no">Contact No</label>
                            <input wire:model="contact_no" class="form-control" type="text" placeholder="Contact No"
                                name="contact_no" id="contact_no">
                            <span class="text-danger">
                                @error('contact_no')
                                    <p>{{ $message }}</p>
                                @enderror
                            </span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="gender">Gender</label>
                            <select wire:model="gender" class="form-control" name="gender" id="gender">
                                <option value="" selected>--Select Gender--
                                </option>
                                <option value="male">Male
                                </option>
                                <option value="female">
                                    Female
                                </option>
                            </select>
                            <span class="text-danger">
                                @error('gender')
                                    <p>{{ $message }}</p>
                                @enderror
                            </span>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="birthday">Birthday</label>
                            <input wire:model="birthday" class="form-control" type="date" placeholder="Birthday"
                                name="birthday" id="birthday">
                            <span class="text-danger">
                                @error('birthday')
                                    <p>{{ $message }}</p>
                                @enderror
                            </span>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input wire:model="email" class="form-control" type="email" placeholder="Email"
                                name="email" id="email">
                            <span class="text-danger">
                                @error('email')
                                    <p>{{ $message }}</p>
                                @enderror
                            </span>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input wire:model="password" class="form-control" type="text" placeholder="Password"
                                name="password" id="password">
                            <button class="btn btn-success" wire:click.prevent="generatePassword" style="margin: 10px;">Generate
                                Password</button>
                            <span class="text-danger">
                                @error('password')
                                    <p>{{ $message }}</p>
                                @enderror
                            </span>
                        </div>
                    </div>

                </div>
                <button class="btn btn-primary" type="submit">Add</button>
                <button wire:click.prevent="resetAlumniFormConfirmation" class="btn btn-danger">Clear changes</button>
            </div>
        </div>

    </form>

</div>
