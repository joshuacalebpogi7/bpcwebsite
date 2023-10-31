<?php

namespace App\Http\Livewire;

use App\Models\Course;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class EditProfile extends Component
{
    use WithFileUploads;
    public $user;
    public $avatar;
    public $password;
    public $state = [];
    public $courses;
    public $old_password;
    public $new_password;
    public $confirm_password;

    public function mount()
    {
        $this->user = Auth::user();
        $this->state = auth()->user()->withoutRelations()->toArray();
        $this->courses = Course::all();

    }

    public function updated($accountSecurityFields)
    {
        $this->validateOnly(
            $accountSecurityFields,
            [

                'old_password' => [
                    'required',
                    function ($attribute, $value, $fail) {
                        if (!Hash::check($value, Auth::user()->password)) {
                            $fail('The old password does not match your current password.');
                        }
                    }
                ],
                'new_password' => ['required', 'regex:/^[^\s]+$/', 'min:8', 'different:old_password'],
                'confirm_password' => ['required', 'same:new_password'],
            ],
            [
                'new_password.regex' => 'password can not contain whitespace.'
            ]
        );
    }

    public function resetAccountSecurity()
    {
        $this->resetErrorBag();
        $this->reset('old_password', 'new_password', 'confirm_password');
    }
    public function updateAccountSecurity()
    {
        $this->validate(
            [

                'old_password' => [
                    'required',
                    function ($attribute, $value, $fail) {
                        if (!Hash::check($value, Auth::user()->password)) {
                            $fail('The old password does not match your current password.');
                        }
                    }
                ],
                'new_password' => ['required', 'regex:/^[^\s]+$/', 'min:8', 'different:old_password'],
                'confirm_password' => ['required', 'same:new_password'],
            ],
            [
                'new_password.regex' => 'password can not contain whitespace.'
            ]
        );

        Auth::user()->update([
            'password' => $this->new_password,
            'default_password' => null
        ]);
        $this->reset('old_password', 'new_password', 'confirm_password');

        toastr()->success('', 'Password updated successfully!', [
            "showEasing" => "swing",
            "hideEasing" => "swing",
            "showMethod" => "slideDown",
            "hideMethod" => "slideUp"
        ]);
    }

    public function resetProfile()
    {
        $this->resetErrorBag();
        if ($this->state !== auth()->user()->withoutRelations()->toArray()) {
            $this->state = auth()->user()->withoutRelations()->toArray();

        }
    }
    public function resetAvatar()
    {
        $this->resetErrorBag();
        $this->reset('avatar');
        $this->deleteLockFile();
    }

    public function updateAvatar()
    {
        $this->resetErrorBag();
        $this->validate([
            'avatar' => ['required', 'image', 'max:5000']
        ]);

        $avatar_name = $this->user->username . '-' . time() . '-' . $this->avatar->getClientOriginalName();
        $imgData = Image::make($this->avatar)->encode('jpg');
        Storage::put('public/avatars/' . $avatar_name, $imgData);

        $oldAvatar = $this->user->avatar;
        $this->user->avatar = $avatar_name;
        $this->user->save();

        if ($oldAvatar != '/fallback_avatar.png') {
            Storage::delete(str_replace("/storage/", "public/", $oldAvatar));
        }

        toastr()->success('', 'Avatar updated successfully!', [
            "showEasing" => "swing",
            "hideEasing" => "swing",
            "showMethod" => "slideDown",
            "hideMethod" => "slideUp"
        ]);

        $this->avatar = null;
        $this->deleteLockFile();
    }

    public function updatedStateEmploymentStatus($value)
    {
        $this->resetErrorBag();
        if ($value === 'unemployed') {
            $this->state['job_type'] = null;
            $this->state['job_title'] = null;
            $this->state['category'] = null;
            $this->state['job_location'] = null;
            $this->state['monthly_salary'] = null;
        } elseif ($value === 'self-employed') {
            $this->state['job_type'] = $this->user->job_type;
            $this->state['job_title'] = $this->user->job_title;
            $this->state['category'] = $this->user->category;
            $this->state['job_location'] = null;
            $this->state['monthly_salary'] = null;
        } elseif ($value === '') {
            $this->state['job_type'] = null;
            $this->state['category'] = null;
            $this->state['job_title'] = null;
            $this->state['job_location'] = null;
            $this->state['monthly_salary'] = null;
        } else {
            $this->state['job_type'] = $this->user->job_type;
            $this->state['job_title'] = $this->user->job_title;
            $this->state['category'] = $this->user->category;
            $this->state['job_location'] = $this->user->job_location;
            $this->state['monthly_salary'] = $this->user->monthly_salary;
        }
    }
    public function updateProfile()
    {
        $profileUpdated = false;
        // dd(ucwords($this->state['job_type']));
        $this->resetErrorBag();
        if (
            $this->state['civil_status'] !== auth()->user()->civil_status ||
            $this->state['contact_no'] !== auth()->user()->contact_no ||
            $this->state['address'] !== auth()->user()->address ||
            $this->state['postal_code'] !== auth()->user()->postal_code ||
            $this->state['employment_status'] !== auth()->user()->employment_status ||
            $this->state['job_type'] !== auth()->user()->job_type ||
            $this->state['job_title'] !== auth()->user()->job_title ||
            $this->state['category'] !== auth()->user()->category ||
            $this->state['job_location'] !== auth()->user()->job_location ||
            $this->state['monthly_salary'] !== auth()->user()->monthly_salary
        ) {

            Validator::make($this->state, [
                'civil_status' => ['required', Rule::in(['single', 'married', 'separated', 'widowed'])],
                'contact_no' => ['required', 'regex:/^[\+?\d\s]+$/'],
                'address' => ['required'],
                'postal_code' => ['required'],
                'employment_status' => ['required', Rule::in(['unemployed', 'employed', 'self-employed'])],
                'job_type' => ['required_if:employment_status,employed,self-employed'],
                'job_title' => ['required_if:employment_status,employed,self-employed'],
                'category' => ['required_if:employment_status,employed,self-employed'],
                'job_location' => ['required_if:employment_status,employed'],
                'monthly_salary' => ['required_if:employment_status,employed', 'nullable', 'numeric'],
            ])->validate();

            $this->user->update([
                'civil_status' => $this->state['civil_status'],
                'contact_no' => trim($this->state['contact_no']),
                'address' => trim(strip_tags($this->state['address'])),
                'postal_code' => trim(strip_tags($this->state['postal_code'])),
                'employment_status' => $this->state['employment_status'],
                'job_type' => $this->state['job_type'],
                'job_title' => trim(strip_tags(ucwords($this->state['job_title']))),
                'category' => $this->state['category'],
                'job_location' => trim(strip_tags($this->state['job_location'])),
                'monthly_salary' => trim($this->state['monthly_salary']),
            ]);

            toastr()->success('', 'Profile updated successfully!', [
                "showEasing" => "swing",
                "hideEasing" => "swing",
                "showMethod" => "slideDown",
                "hideMethod" => "slideUp"
            ]);

        } else {
            toastr()->warning('', 'No changes has been saved!', [
                'progressBar' => false,
                "timeOut" => "2000",
                "showEasing" => "swing",
                "hideEasing" => "swing",
                "showMethod" => "slideDown",
                "hideMethod" => "slideUp"
            ]);
            $this->resetProfile();
        }
    }

    //lock files
    protected function deleteLockFile()
    {
        $lockFilePath = storage_path("app/livewire-tmp/{$this->user->username}.lock");

        if (file_exists($lockFilePath)) {
            unlink($lockFilePath);
        }
    }

    protected function cleanupOldUploads()
    {
        $lockFilePath = storage_path("app/livewire-tmp/{$this->user->username}.lock");

        if (!file_exists($lockFilePath)) {
            $lockFile = fopen($lockFilePath, 'w');

            if (flock($lockFile, LOCK_EX | LOCK_NB)) {
                try {
                    $storage = Storage::disk('local');

                    foreach ($storage->allFiles('livewire-tmp') as $filePathname) {
                        if (!$storage->exists($filePathname)) {
                            continue;
                        }

                        $yesterdaysStamp = now()->subSeconds(10)->timestamp;

                        if ($yesterdaysStamp > $storage->lastModified($filePathname)) {
                            $storage->delete($filePathname);
                        }
                    }
                } finally {
                    flock($lockFile, LOCK_UN);
                    fclose($lockFile);
                }
            } else {
                fclose($lockFile);
            }
        }
    }

    public function render()
    {
        return view('livewire.edit-profile');
    }
}