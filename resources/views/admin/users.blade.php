<x-admin-layout>
    <h2>Alumni Records</h2>
    <div style="display: flex; justify-content: space-between; align-items: center;">
        <a href="/admin/add-alumni">
            <button class="btn btn-primary">
                <img src="{{ URL::asset('/images/icon-plus.svg') }}"> Add Alumni
            </button>
        </a>
        <form action="/import" method="post" enctype="multipart/form-data">
            @csrf
            <div style="display: flex; align-items: center;">
                <input class="form-control @error('excel_file') is-invalid @enderror" name="excel_file" type="file">
                @error('excel_file')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
                <button class="btn btn-primary" style="margin: 10px"> Import</button>
            </div>
        </form>
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
                                                            <button type="button" class="btn btn-success btn-icon-text" style="width: 150px; height: 50px; margin: 5px; ">
                                                                <i class="ti-pencil btn-icon-prepend"></i>                                                    
                                                                Edit
                                                            </button>
                                                        </a>

                                                        <!-- Second Row - Delete Button -->
                                                        <form action="/admin/delete-alumni/{{ $user->username }}"
                                                            method="post" class="deleteUser">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" class="btn btn-danger btn-icon-text" style="width: 150px; height: 50px; margin: 5px;">
                                                                <i class="ti-trash btn-icon-prepend"></i>                                                    
                                                                Delete
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
                                                <td>{{ \Carbon\Carbon::parse($user->birthday)->format('M d, Y') }}
                                                </td>
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
