<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
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

class EditAdminProfile extends Component
{
    use WithFileUploads;
    public $user;
    public $avatar;
    public $password;
    public $state = [];
    public $old_password;
    public $new_password;
    public $confirm_password;

    public function mount()
    {
        $this->user = Auth::user();
        $this->state = auth()->user()->withoutRelations()->toArray();
    }

    public function updated($accountSecurityFields)
    {
        if ($this->state['username'] != $this->user->username){
            $this->validateOnly(
                $accountSecurityFields,
                [
                    'state.username' => ['required', 'min:3', 'max:15', Rule::unique('users', 'username')->ignore($this->user->id)],
                ]
            );
        } 
        if($this->old_password || $this->new_password || $this->confirm_password) {
            $this->validateOnly(
                $accountSecurityFields,
                [
                    'old_password' => [
                        function ($attribute, $value, $fail) {
                            if (!Hash::check($value, Auth::user()->password)) {
                                $fail('The old password does not match your current password.');
                            }
                        }
                    ],
                    'new_password' => ['required', 'regex:/^[^\s]+$/', 'min:8',
                        function ($attribute, $value, $fail) {
                            // Get the current user
                            $user = auth()->user();
                
                            // Check if the new password is the same as the current password
                            if (Hash::check($value, $user->password)) {
                                $fail('The new password must be different from your current password.');
                            }
                        },
                    ],
                    'confirm_password' => ['required', 'same:new_password'],
                    'state.username' => ['required', 'min:3', 'max:15', Rule::unique('users', 'username')->ignore($this->user->id)],
                ],
                [
                    'new_password.regex' => 'password can not contain whitespace.'
                ]
            );
        }
    }

    public function resetAccountSecurity()
    {
        $this->resetErrorBag();
        $this->reset('old_password', 'new_password', 'confirm_password');
    }
    public function updateAccountSecurity()
    {
        if (!$this->old_password && !$this->new_password && !$this->confirm_password && $this->state['username'] == $this->user->username) {
            toastr()->warning('', 'No changes has been saved.', [
                "showEasing" => "swing",
                "hideEasing" => "swing",
                "showMethod" => "slideDown",
                "hideMethod" => "slideUp"
            ]);
        }
        if ($this->state['username'] != $this->user->username){
            $this->validate(
                [
                    'state.username' => ['required', 'min:3', 'max:15', Rule::unique('users', 'username')->ignore($this->user->id)],
                ]
            );
            Auth::user()->update([
                'username' => $this->state['username'],
            ]);
            $this->reset('old_password', 'new_password', 'confirm_password');

            toastr()->success('', 'Username updated successfully!', [
                "showEasing" => "swing",
                "hideEasing" => "swing",
                "showMethod" => "slideDown",
                "hideMethod" => "slideUp"
            ]);
        } 
        if($this->old_password || $this->new_password || $this->confirm_password) {
            $this->validate(
                [
                    'old_password' => [
                        function ($attribute, $value, $fail) {
                            if (!Hash::check($value, Auth::user()->password)) {
                                $fail('The old password does not match your current password.');
                            }
                        }
                    ],
                    'new_password' => ['required', 'regex:/^[^\s]+$/', 'min:8',
                        function ($attribute, $value, $fail) {
                            // Get the current user
                            $user = auth()->user();
                
                            // Check if the new password is the same as the current password
                            if (Hash::check($value, $user->password)) {
                                $fail('The new password must be different from your current password.');
                            }
                        },
                    ],
                    'confirm_password' => ['required', 'same:new_password'],
                ],
                [
                    'new_password.regex' => 'password can not contain whitespace.'
                ]
            );

            Auth::user()->update([
                'password' => $this->new_password,
                'default_password' => null,
            ]);
            $this->reset('old_password', 'new_password', 'confirm_password');

            toastr()->success('', 'Password updated successfully!', [
                "showEasing" => "swing",
                "hideEasing" => "swing",
                "showMethod" => "slideDown",
                "hideMethod" => "slideUp"
            ]);
        }
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
    public function updateProfile()
    {
        $this->resetErrorBag();
        if (
            $this->state['civil_status'] !== auth()->user()->civil_status ||
            $this->state['contact_no'] !== auth()->user()->contact_no ||
            $this->state['address'] !== auth()->user()->address ||
            $this->state['postal_code'] !== auth()->user()->postal_code
        ) {
            $birthday = Carbon::createFromFormat('Y-m-d', $this->state['birthday']);
            $age = $birthday->diffInYears(Carbon::now());
            Validator::make($this->state, [
                'civil_status' => ['nullable', Rule::in(['single', 'married', 'separated', 'widowed'])],
                'contact_no' => ['required', 'regex:/^[\+?\d\s]+$/'],
                'address' => ['nullable'],
                'postal_code' => ['nullable'],
                'birthday' => ['required', 'date_format:Y-m-d'],
                'gender' => ['required', Rule::in(['male', 'female'])],
            ])->validate();

            $this->user->update([
                'civil_status' => $this->state['civil_status'],
                'contact_no' => trim($this->state['contact_no']),
                'address' => trim(strip_tags($this->state['address'])),
                'postal_code' => trim(strip_tags($this->state['postal_code'])),
                'first_name' => trim(strip_tags(ucwords($this->state['first_name']))),
                'middle_name' => trim(strip_tags(ucwords($this->state['middle_name']))),
                'last_name' => trim(strip_tags(ucwords($this->state['last_name']))),
                'birthday' => $this->state['birthday'],
                'gender' => $this->state['gender'],
                'age' => $age,
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
        return view('livewire.edit-admin-profile');
    }
}
