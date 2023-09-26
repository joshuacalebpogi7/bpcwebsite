<x-admin-layout>
    <h2>Admins list</h2>
    <div>
        <a href="/admin/add-admin"><button class="btn btn-primary mb-3">Add Admin</button></a>
    </div>
    <div>
        <table id="example" class="table table-light table-striped table-hover rounded shadow-sm" style="width:100%">
            <thead>
                <tr>
                    {{-- @if (data - tables)
                    <th>Action</th>
                    @endif --}}
                    <th>Id</th>
                    <th>Action</th>
                    <th>Avatar</th>
                    <th>Student No/Username</th>
                    <th>Email</th>
                    <th>Full Name</th>
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
                                <a href="/admin/edit-alumni/{{ $user->username }}" class="flex-fill">
                                    <button class="btn btn-success me-1 w-100 h-100">View</button>
                                </a>

                                <!-- Second Row - Delete Button -->
                                <form action="/admin/delete-alumni/{{ $user->username }}" method="post"
                                    class="deleteUser">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger mt-1 flex-fill w-100 h-100">Delete</button>
                                </form>
                            </div>
                        </td>

                        {{-- same row --}}

                        {{-- <td>
                            <div class="d-flex align-items-center">
                                <a href="/admin/edit-alumni/{{ $user->username }}" class="flex-fill">
                                    <button class="btn btn-success me-1 w-100 h-100">View</button>
                                </a>
                                <form action="/admin/delete-alumni/{{ $user->username }}" method="post"
                                    class="deleteUser d-flex flex-fill">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger ms-1 w-100 h-100">Delete</button>
                                </form>
                            </div>
                        </td> --}}

                        <td><img src="{{ $user->avatar }}" alt="{{ $user->username }}'s avatar"
                                style="width: 40px; border-radius: 50%; margin: 10px;"></td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->last_name . ', ' . $user->first_name . ' ' . preg_replace('/\B\w+/u', '. ', $user->middle_name) }}
                        </td>
                        <td>{{ $user->course }}</td>
                        <td>{{ $user->year_graduated }}</td>
                        <td>{{ $user->gender }}</td>
                        <td>{{ $user->age }}</td>
                        <td>{{ $user->civil_status }}</td>
                        <td>{{ $user->employment_status }}</td>
                        <td>{{ $user->monthly_salary }}</td>
                        <td>
                            @if (isset($user->email_verified_at))
                                Verified
                                @if (isset($user->default_password))
                                    Activated
                                @endif
                            @else
                                Inactive
                            @endif
                        </td>
                        <td>
                            @if ($user->email_sent == true)
                                Account details already sent
                            @else
                                Account details not yet sent
                            @endif
                        </td>
                        <td>{{ $user->created_at->format('M d, Y h:i A') }}</td>
                        <td>{{ $user->updated_at->format('M d, Y h:i A') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</x-admin-layout>
