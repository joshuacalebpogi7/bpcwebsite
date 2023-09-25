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

    <form wire:submit.prevent="addAdmin">
        @csrf

        <div class="card mt-5 mb-5">
            <div class="card-header bg-primary bg-gradient text-white">Add Admin
            </div>
            <div class="card-body">
                <div class="row">

                    <div class="col-md-4">
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

                    <div class="col-md-4">
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

                <button class="btn btn-primary" type="submit">Add</button>
                <button wire:click.prevent="resetAlumniFormConfirmation" class="btn btn-danger">Reset</button>
            </div>
        </div>

    </form>
</div>
