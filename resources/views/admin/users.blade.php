<x-admin-layout>
    <h2>Alumni Records</h2>
    <div>
        <a href="/admin/add-alumni"><button class="btn btn-primary mb-3"><img
                    src="{{ URL::asset('/images/icon-plus.svg') }}"> Add Alumni</button></a>
    </div>


    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <p class="card-title">Alumni Table</p>
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table id="userstable"
                                    class="display expandable-table users-table table-hover rounded shadow-sm"
                                    style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Action</th>
                                            <th>Avatar</th>
                                            <th>Student No/Username</th>
                                            <th>Email</th>
                                            <th>Full Name</th>
                                            <th>Course</th>
                                            <th>Year Graduated</th>
                                            <th>Birthday</th>
                                            <th>Age</th>
                                            <th>Gender</th>
                                            <th>Contact No</th>
                                            <th>Status</th>
                                            <th>Civil Status</th>
                                            <th>Address</th>
                                            <th>Employment Status</th>
                                            <th>Job Type</th>
                                            <th>Job Position</th>
                                            <th>Job Location</th>
                                            <th>Monthly Salary</th>
                                            <th>Date added</th>
                                            <th>Date updated</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                            <tr>
                                                <th>{{ $user->id }}</th>
                                                {{-- separate row --}}
                                                <td>
                                                    <div class="d-flex flex-column">
                                                        <!-- First Row - Edit Button -->
                                                        <a href="/admin/edit-alumni/{{ $user->username }}"
                                                            class="flex-fill">
                                                            <button
                                                                class="btn btn-light me-1 w-100 h-100 p-1 border mb-1">
                                                                <div
                                                                    class="d-flex justify-content-center align-items-center">
                                                                    <img src="{{ URL::asset('/images/icon-edit.svg') }}"
                                                                        class="mr-2" alt="Edit Icon">
                                                                    Edit
                                                                </div>
                                                            </button>
                                                        </a>

                                                        <!-- Second Row - Delete Button -->
                                                        <form action="/admin/delete-alumni/{{ $user->username }}"
                                                            method="post" class="deleteUser">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button
                                                                class="btn btn-light mt-1 flex-fill w-100 h-100 p-1 border">
                                                                <div
                                                                    class="d-flex justify-content-center align-items-center">
                                                                    <img src="{{ URL::asset('/images/icon-delete.svg') }}"
                                                                        class="mr-2" alt="Delete Icon">Delete
                                                                </div>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>

                                                <td><img src="{{ $user->avatar }}" alt="{{ $user->username }}'s avatar"
                                                        style="width: 40px; border-radius: 50%; margin: 10px;"></td>
                                                <td>{{ $user->username }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->last_name . ', ' . $user->first_name . ' ' . preg_replace('/\B\w+/u', '. ', $user->middle_name) }}
                                                </td>
                                                <td>{{ $user->course }}</td>
                                                <td>{{ $user->year_graduated }}</td>
                                                <td>{{ $user->birthday }}</td>
                                                <td>{{ $user->age }}</td>
                                                <td>{{ $user->gender }}</td>
                                                <td>{{ $user->contact_no }}</td>
                                                <td>
                                                    @if ($user->email_sent == true)
                                                        Account details already sent
                                                    @else
                                                        Account details not yet sent
                                                    @endif
                                                    @if (isset($user->email_verified_at) && isset($user->default_password))
                                                        <strong>Verified</strong>
                                                    @elseif (isset($user->email_verified_at) && !isset($user->default_password))
                                                        <strong>Activated</strong>
                                                    @else
                                                        <strong>Inactive</strong>
                                                    @endif
                                                </td>
                                                <td>{{ $user->civil_status }}</td>
                                                <td>{{ $user->address }}</td>
                                                <td>{{ $user->employment_status }}</td>
                                                <td>{{ $user->job_type }}</td>
                                                <td>{{ $user->job_position }}</td>
                                                <td>{{ $user->job_location }}</td>
                                                <td>{{ $user->monthly_salary }}</td>
                                                <td>{{ $user->created_at->format('M d, Y h:i A') }}</td>
                                                <td>{{ $user->updated_at->format('M d, Y h:i A') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-admin-layout>
