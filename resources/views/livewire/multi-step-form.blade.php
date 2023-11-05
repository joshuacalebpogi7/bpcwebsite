<div>
    <form wire:submit.prevent="submitAdditionalInfo">
        @csrf

        {{-- STEP 1 --}}

        @if ($currentStep == 1)
            <div class="step-one">
                <div class="card">
                    <div class="card-header text-white" style="background: #00a56f">STEP 1/4 - Personal Details</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="civil-status">Civil status</label>
                                    <select wire:model="civil_status"
                                        class="form-control @error('civil_status') is-invalid @enderror"
                                        name="civil_status" id="civil-status">
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
                                    <input wire:model="contact_no"
                                        class="form-control @error('contact_no') is-invalid @enderror" type="text"
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
                                <input wire:model="address" class="form-control @error('address') is-invalid @enderror"
                                    type="text"
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
                                <input wire:model="postal_code"
                                    class="form-control @error('postal_code') is-invalid @enderror" type="text"
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
                    <div class="card-header text-white" style="background: #00a56f">STEP 2/4 - Career Details</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="employment-status">Employment status</label>
                                    <select wire:model="employment_status"
                                        class="form-control @error('employment_status') is-invalid @enderror"
                                        name="employment_status" id="employment-status">
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
                                    <label for="job-type">Job Type</label>
                                    <select wire:model="job_type"
                                        {{ in_array($employment_status, ['unemployed', '']) ? 'disabled' : '' }}
                                        class="form-control @error('job_type') is-invalid @enderror" name="job_type"
                                        id="job-type">
                                        <option value="" selected>--Select Job Type--
                                        </option>
                                        <option value="full-time"
                                            {{ old('job_type') == 'full-time' ? 'selected' : '' }}>
                                            Full Time
                                        </option>
                                        <option value="part-time"
                                            {{ old('job_type') == 'part-time' ? 'selected' : '' }}>
                                            Part Time
                                        </option>
                                        <option value="freelance"
                                            {{ old('job_type') == 'freelance' ? 'selected' : '' }}>
                                            Freelance
                                        </option>
                                    </select>
                                    <span class="text-danger">
                                        @error('job_type')
                                            <p>{{ $message }}</p>
                                        @enderror
                                    </span>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="job-title">Job Title</label>
                                    <input wire:model="job_title"
                                        {{ in_array($employment_status, ['unemployed', '']) ? 'disabled' : '' }}
                                        class="form-control @error('job_title') is-invalid @enderror" type="text"
                                        placeholder="Job Title @if (in_array($employment_status, ['self-employed'])) eg. writer, developer @endif"
                                        name="job_title" id="job-title">
                                    <span class="text-danger">
                                        @error('job_title')
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
                                    class="form-control @error('job_location') is-invalid @enderror" type="text"
                                    placeholder="Job location" name="job_location" id="job-location">
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
                                        class="form-control @error('monthly_salary') is-invalid @enderror"
                                        type="text" placeholder="Monthly salary" name="monthly_salary"
                                        id="monthly-salary">
                                    <span class="text-danger">
                                        @error('monthly_salary')
                                            <p>{{ $message }}</p>
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="category">Job Category</label>
                                    <select wire:model="category"
                                        class="form-control @error('category') is-invalid @enderror" name="category"
                                        id="category"
                                        {{ in_array($employment_status, ['unemployed', '']) ? 'disabled' : '' }}>
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
                                            Design and Creative</option>
                                        <option value="Manufacturing and Production">
                                            Manufacturing and Production</option>
                                        <option value="Operations">
                                            Operations</option>
                                        <option value="Customer Support">
                                            Customer Support</option>
                                        <option value="Administration">
                                            Administration</option>
                                    </select>
                                    <span class="text-danger">
                                        @error('category')
                                            <p>{{ $message }}</p>
                                        @enderror
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        {{-- STEP 3 --}}

        @if ($currentStep == 3)
            <div class="step-three">
                <div class="card">
                    <div class="card-header text-white" style="background: #00a56f">STEP 3/4 - Change Your Password</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group">
                                <label for="new-password">New Password</label>
                                <input wire:model="new_password"
                                    class="form-control @error('new_password') is-invalid @enderror" type="password"
                                    placeholder="New Password" name="new_password" id="new-password">
                                <span class="text-danger">
                                    @error('new_password')
                                        <p>{{ $message }}</p>
                                    @enderror
                                </span>
                            </div>

                            <div class="form-group">
                                <label for="confirm-password">Confirm Password</label>
                                <input wire:model="confirm_password"
                                    class="form-control @error('confirm_password') is-invalid @enderror"
                                    type="password" placeholder="Confirm Password" name="confirm_password"
                                    id="confirm-password">
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
                    <div class="card-header text-white" style="background: #00a56f">STEP 4/4 - Add Avatar</div>
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
                                <input wire:model="avatar" class="form-control @error('avatar') is-invalid @enderror"
                                    type="file" name="avatar" id="avatar">
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

<div class="svg1">
    <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
        <path fill="#C4E8C2"
            d="M29.6,-49.1C39.2,-45.8,48.4,-39.5,53.5,-30.8C58.5,-22.2,59.5,-11.1,59.2,-0.1C59,10.8,57.5,21.6,55.7,35.9C53.9,50.2,51.7,68,42.4,77.4C33,86.9,16.5,87.9,3.9,81.1C-8.7,74.3,-17.4,59.7,-26.4,50.1C-35.4,40.5,-44.7,35.8,-56.8,28.3C-69,20.8,-83.9,10.4,-87.5,-2C-91,-14.5,-83.1,-29,-73.3,-40.5C-63.5,-52.1,-51.8,-60.8,-39.3,-62.3C-26.7,-63.9,-13.4,-58.3,-1.7,-55.5C10,-52.6,20.1,-52.3,29.6,-49.1Z"
            transform="translate(100 100)" />
    </svg>
</div>

<div class="svg2">
    <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
        <path fill="#67D199"
            d="M48.8,-47.3C63.7,-33.9,76.5,-16.9,76.8,0.3C77.1,17.5,64.7,34.9,49.8,45.6C34.9,56.2,17.5,60,-2.5,62.5C-22.4,65,-44.8,66.1,-58.4,55.5C-72,44.8,-76.8,22.4,-73.9,2.9C-70.9,-16.5,-60.2,-33,-46.6,-46.5C-33,-60,-16.5,-70.5,0.2,-70.7C16.9,-70.9,33.9,-60.8,48.8,-47.3Z"
            transform="translate(100 100)" />
    </svg>
</div>