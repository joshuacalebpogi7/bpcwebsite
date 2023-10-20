<div>
    {{-- @php
        dd($isSubmitting);
    @endphp --}}
    <div wire:loading.delay>
        <div class="screen">
            <div class="loader">
                <div class="dot"></div>
                <div class="dot"></div>
                <div class="dot"></div>
            </div>
        </div>
    </div>



    <form wire:submit.prevent="addCourse">
        @csrf

        <div class="card mb-2 mt-3">
            <div class="card-header bg-primary bg-gradient text-white">Add Course
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="form-group">
                        <label for="course">Course</label>
                        <input wire:model="course" class="form-control" type="text"
                            placeholder="Course Name Abbreviation" name="course" id="course">
                        <span class="text-danger">
                            @error('course')
                                <p>{{ $message }}</p>
                            @enderror
                        </span>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group">
                        <label for="description">Description</label>
                        <input wire:model="description" class="form-control" name="description" id="description"
                            type="text" placeholder="Full Course Name">
                        {{-- <textarea wire:model="description" class="form-control" name="description" id="description" cols="30"
                            rows="10"></textarea> --}}
                        <span class="text-danger">
                            @error('description')
                                <p>{{ $message }}</p>
                            @enderror
                        </span>
                    </div>
                </div>
                <button class="btn btn-primary" type="submit">Add Course</button>
                <button wire:click.prevent="resetCourseForm" class="btn btn-danger">Reset</button>
            </div>
        </div>
    </form>



    @if (!$showCourses)
        <button class="btn btn-success" wire:click.prevent="toggleShowCourses">Show Courses</button>
    @else
        <button class="btn btn-danger" wire:click.prevent="toggleShowCourses">Hide Courses</button>
    @endif

    @if ($showCourses)
        <h2>Course List</h2>
        <div>
            <table class="table table-dark table-striped table-hover rounded shadow-lg">
                <thead>
                    <tr>
                        <th>Action</th>
                        <th>Id</th>
                        <th>Course Name|Abbreviation</th>
                        <th>Course Description|Full Name</th>
                    </tr>
                </thead>
                <!-- Table body -->
                <tbody>
                    @foreach ($courses as $course)
                        @if ($courseIdToUpdate === $course->id)
                            <!-- Edit form -->
                            <tr>
                                <td>
                                    <button class="btn btn-success" wire:click="updateCourse">Save</button>
                                    <button class="btn btn-danger" wire:click="cancelEdit">Cancel</button>
                                </td>
                                <td>{{ $course->id }}</td>
                                <td>
                                    <div class="form-group">
                                        <input class="form-control" wire:model="courseName" type="text">
                                    </div>
                                </td>
                                <td>
                                    <input class="form-control" wire:model="courseDescription" type="text">
                                </td>
                            </tr>
                        @else
                            <!-- Display table row -->
                            <tr>
                                <td>
                                    <button class="btn btn-primary"
                                        wire:click="editCourse({{ $course->id }})">Edit</button>

                                    <button class="btn btn-danger"
                                        wire:click="deleteConfirmation({{ $course->id }})">Delete</button>
                                </td>
                                <td>{{ $course->id }}</td>
                                <td>{{ $course->course }}</td>
                                <td>{{ $course->description }}</td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

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
                            <input wire:model="last_name" class="form-control" type="text"
                                placeholder="Last name" name="last_name" id="last-name">
                            <span class="text-danger">
                                @error('last_name')
                                    <p>{{ $message }}</p>
                                @enderror
                            </span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
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

                    <div class="col-md-6">
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
                            <button class="btn btn-success" wire:click.prevent="generatePassword">Generate
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
                <button wire:click.prevent="resetAlumniFormConfirmation" class="btn btn-danger">Reset</button>
            </div>
        </div>

    </form>

</div>
