<div>
    <form wire:submit.prevent="submitAdditionalInfo">
        @csrf

        {{-- STEP 1 --}}

        @if ($currentStep == 1)
            <div class="step-one">
                <div class="card">
                    <div class="card-header bg-secondary text-white">STEP 1/4 - Personal Details</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="civil-status">Civil status</label>
                                    <select wire:model="civil_status" class="form-control" name="civil_status"
                                        id="civil-status">
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
                                    <span class="text-danger">
                                        @error('civil_status')
                                            <p>{{ $message }}</p>
                                        @enderror
                                    </span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="contact-no">Contact number</label>
                                    <input wire:model="contact_no" class="form-control" type="text"
                                        placeholder="Contact number" name="contact_no" id="contact-no">
                                    <span class="text-danger">
                                        @error('contact_no')
                                            <p>{{ $message }}</p>
                                        @enderror
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label for="address">Full address</label>
                                <input wire:model="address" class="form-control" type="text"
                                    placeholder="Street address, apt, suite, unit, building, floor, barangay, city, province, etc."
                                    name="address" id="address">
                                <span class="text-danger">
                                    @error('address')
                                        <p>{{ $message }}</p>
                                    @enderror
                                </span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label for="postal-code">Postal code</label>
                                <input wire:model="postal_code" class="form-control" type="text"
                                    placeholder="Postal code" name="postal_code" id="postal-code">
                                <span class="text-danger">
                                    @error('postal_code')
                                        <p>{{ $message }}</p>
                                    @enderror
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        {{-- STEP 2 --}}

        @if ($currentStep == 2)
            <div class="step-two">
                <div class="card">
                    <div class="card-header bg-secondary text-white">STEP 2/4 - Career Details</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="employment-status">Employment status</label>
                                    <select wire:model="employment_status" class="form-control" name="employment_status"
                                        id="employment-status">
                                        <option value="" selected>--Select Employment Status--</option>
                                        <option value="unemployed">
                                            Unemployed
                                        </option>
                                        <option value="employed">
                                            Employed
                                        </option>
                                        <option value="self-employed">
                                            Self-employed</option>
                                    </select>
                                    <span class="text-danger">
                                        @error('employment_status')
                                            <p>{{ $message }}</p>
                                        @enderror
                                    </span>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="job-type">Job type</label>
                                    <input wire:model="job_type"
                                        {{ in_array($employment_status, ['unemployed', '']) ? 'disabled' : '' }}
                                        class="form-control" type="text" placeholder="Job type" name="job_type"
                                        id="job-type">
                                    <span class="text-danger">
                                        @error('job_type')
                                            <p>{{ $message }}</p>
                                        @enderror
                                    </span>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="job-position">Job position</label>
                                    <input wire:model="job_position"
                                        {{ in_array($employment_status, ['unemployed', 'self-employed', '']) ? 'disabled' : '' }}
                                        class="form-control" type="text" placeholder="Job position"
                                        name="job_position" id="job-position">
                                    <span class="text-danger">
                                        @error('job_position')
                                            <p>{{ $message }}</p>
                                        @enderror
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group">
                                <label for="job-location">Job location</label>
                                <input wire:model="job_location"
                                    {{ in_array($employment_status, ['unemployed', 'self-employed', '']) ? 'disabled' : '' }}
                                    class="form-control" type="text" placeholder="Job location" name="job_location"
                                    id="job-location">
                                <span class="text-danger">
                                    @error('job_location')
                                        <p>{{ $message }}</p>
                                    @enderror
                                </span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="monthly-salary">Monthly salary</label>
                                    <input wire:model="monthly_salary"
                                        {{ in_array($employment_status, ['unemployed', 'self-employed', '']) ? 'disabled' : '' }}
                                        class="form-control" type="text" placeholder="Monthly salary"
                                        name="monthly_salary" id="monthly-salary">
                                    <span class="text-danger">
                                        @error('monthly_salary')
                                            <p>{{ $message }}</p>
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            {{-- <div class="col-md-6">
                                <div class="form-group">
                                    <label for="category">Job Category</label>
                                    <select wire:model="category" class="form-control" name="category"
                                        id="category">
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
                                            HDesign and Creative</option>
                                        <option value="Manufacturing and Production">
                                            Manufacturing and Production</option>
                                        <option value="Operations">
                                            Operations</option>
                                        <option value="Customer Support">
                                            Customer Support</option>
                                        <option value="Administration">
                                            Administration</option>
                                    </select>
                                    @error('category')
                                        <p>{{ $message }}</p>
                                    @enderror
                                    </span>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        @endif
        {{-- STEP 3 --}}

        @if ($currentStep == 3)
            <div class="step-three">
                <div class="card">
                    <div class="card-header bg-secondary text-white">STEP 3/4 - Change Your Password</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group">
                                <label for="new-password">New Password</label>
                                <input wire:model="new_password" class="form-control" type="password"
                                    placeholder="New Password" name="new_password" id="new-password">
                                <span class="text-danger">
                                    @error('new_password')
                                        <p>{{ $message }}</p>
                                    @enderror
                                </span>
                            </div>

                            <div class="form-group">
                                <label for="confirm-password">Confirm Password</label>
                                <input wire:model="confirm_password" class="form-control" type="password"
                                    placeholder="Confirm Password" name="confirm_password" id="confirm-password">
                                <span class="text-danger">
                                    @error('confirm_password')
                                        <p>{{ $message }}</p>
                                    @enderror
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        {{-- STEP 4 --}}

        @if ($currentStep == 4)
            <div class="step-four">
                <div class="card">
                    <div class="card-header bg-secondary text-white">STEP 4/4 - Add Avatar</div>
                    <div class="card-body">
                        <div class="image-area mt-4">
                            @if ($avatar)
                                Preview:
                                <img id="imageResult" src="{{ $avatar->temporaryUrl() }}" alt="avatar-image"
                                    class="img-fluid rounded shadow-sm mx-auto d-block"
                                    style="width: auto; height: 250px;">
                            @endif
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label for="avatar">Avatar</label>
                                <input wire:model="avatar" class="form-control" type="file" name="avatar"
                                    id="avatar">
                                <span class="text-danger">
                                    @error('avatar')
                                        <p>{{ $message }}</p>
                                    @enderror
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        @endif

        <div class="action-buttons d-flex justify-content-between pt-2 pb-2">

            @if ($currentStep == 1)
                <div></div>
            @endif

            @if ($currentStep == 2 || $currentStep == 3 || $currentStep == 4)
                <button type="button" class="btn btn-md btn-secondary" wire:click="decreaseStep()">Back</button>
            @endif

            @if ($currentStep == 1 || $currentStep == 2 || $currentStep == 3)
                <button type="button" class="btn btn-md btn-success" wire:click="increaseStep()">Next</button>
            @endif

            @if ($currentStep == 4)
                <button type="submit" class="btn btn-md btn-primary">Submit</button>
            @endif

        </div>
    </form>
</div>
