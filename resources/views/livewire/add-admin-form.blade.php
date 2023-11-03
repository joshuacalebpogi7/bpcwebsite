<div>
    <div wire:loading.delay.longest>
        <div class="screen">
            <div class="loader">
                <div class="dot"></div>
                <div class="dot"></div>
                <div class="dot"></div>
            </div>
        </div>
    </div>
    <form wire:submit.prevent="addAdminConfirmation">
        @csrf

        <div class="card mt-5 mb-5">
            <div class="card-header bg-primary bg-gradient text-white">Add Content Creator
            </div>
            <div class="card-body">
                <div class="row">
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
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="contact_no">Contact No.</label>
                            <input wire:model="contact_no" class="form-control" type="text" placeholder="Contact No."
                                name="contact_no" id="contact_no">
                            <span class="text-danger">
                                @error('contact_no')
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
                <button wire:click.prevent="resetAdminFormConfirmation" class="btn btn-danger">Clear changes</button>
            </div>
        </div>

    </form>
</div>
