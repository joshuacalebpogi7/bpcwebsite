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

    <form wire:submit.prevent="addRoles">
        @csrf

        <div class="card mb-2 mt-3">
            <div class="card-header bg-primary bg-gradient text-white">Add Roles
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="form-group">
                        <label for="role">Role</label>
                        <input wire:model="role" class="form-control" type="text" placeholder="Role" name="role"
                            id="role">
                        <span class="text-danger">
                            @error('role')
                                <p>{{ $message }}</p>
                            @enderror
                        </span>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group">
                        <label for="description">Description</label>
                        <input wire:model="description" class="form-control" name="description" id="description"
                            type="text" placeholder="Role Description">
                        {{-- <textarea wire:model="description" class="form-control" name="description" id="description" cols="30"
                            rows="10"></textarea> --}}
                        <span class="text-danger">
                            @error('description')
                                <p>{{ $message }}</p>
                            @enderror
                        </span>
                    </div>
                </div>
                <button class="btn btn-primary" type="submit">Add Role</button>
                <button wire:click.prevent="resetRoleForm" class="btn btn-danger">Reset</button>
            </div>
        </div>
    </form>



    @if (!$showRoles)
        <button class="btn btn-success" wire:click.prevent="toggleShowRoles">Show Roles</button>
    @else
        <button class="btn btn-danger" wire:click.prevent="toggleShowRoles">Hide Roles</button>
    @endif

    @if ($showRoles)
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
                    @foreach ($user_types as $user_type)
                        @if ($user_typeIdToUpdate === $user_type->id)
                            <!-- Edit form -->
                            <tr>
                                <td>
                                    <button class="btn btn-success" wire:click="updateRole">Save</button>
                                    <button class="btn btn-danger" wire:click="cancelEdit">Cancel</button>
                                </td>
                                <td>{{ $user_type->id }}</td>
                                <td>
                                    <div class="form-group">
                                        <input class="form-control" wire:model="roleName" type="text">
                                    </div>
                                </td>
                                <td>
                                    <input class="form-control" wire:model="roleDescription" type="text">
                                </td>
                            </tr>
                        @else
                            <!-- Display table row -->
                            <tr>
                                <td>
                                    <button class="btn btn-primary"
                                        wire:click="editRole({{ $user_type->id }})">Edit</button>

                                    <button class="btn btn-danger"
                                        wire:click="deleteConfirmation({{ $user_type->id }})">Delete</button>
                                </td>
                                <td>{{ $user_type->id }}</td>
                                <td>{{ $user_type->user_type }}</td>
                                <td>{{ $user_type->description }}</td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    <form wire:submit.prevent="addAdmin">
        @csrf

        <div class="card mt-5 mb-5">
            <div class="card-header bg-primary bg-gradient text-white">Add Admin
            </div>
            <div class="card-body">
                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="user-type">Admin Role</label>
                            <select wire:model="user_type" class="form-control" name="user_type" id="user-type">
                                <option value="" selected>--Select Role--
                                </option>
                                @foreach ($user_types as $user_type)
                                    <option value="{{ $user_type->id }}">
                                        {{ $user_type->user_type }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger">
                                @error('user_type')
                                    <p>{{ $message }}</p>
                                @enderror
                            </span>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input wire:model="username" class="form-control" type="text" placeholder="Username"
                                name="username" id="username">
                            <span class="text-danger">
                                @error('username')
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
