<x-admin-layout>
    <h2>Content Creators Records</h2>
    <div>
        <a href="/admin/add-admin"><button class="btn btn-primary mb-3"><img
                    src="{{ URL::asset('/images/icon-plus.svg') }}"> Add Content Creators</button></a>
    </div>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <p class="card-title">Content Creators Table</p>
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table id="example" class="display expandable-table table-hover rounded shadow-sm"
                                    style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Action</th>
                                            <th>Avatar</th>
                                            <th>Role</th>
                                            <th>Username</th>
                                            <th>Email</th>
                                            <th>Full Name</th>
                                            <th>Status</th>
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
                                                        <a href="/admin/edit-admin/{{ $user->username }}"
                                                            class="flex-fill">
                                                            <button type="button" class="btn btn-success btn-icon-text" style="width: 150px; height: 50px; margin: 5px;">
                                                                <i class="ti-pencil btn-icon-prepend"></i>                                                    
                                                                Edit
                                                            </button>
                                                        </a>

                                                        <!-- Second Row - Delete Button -->
                                                        <form action="/admin/delete-admin/{{ $user->username }}"
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
                                                <td>{{ $user->user_type }}</td>
                                                <td>{{ $user->username }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>
                                                    {{ $user->last_name . ', ' . $user->first_name . ' ' . preg_replace('/\B\w+/u', '. ', $user->middle_name) }}
                                                </td>
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
