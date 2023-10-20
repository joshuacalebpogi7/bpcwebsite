<?php

namespace App\Http\Livewire;

use Exception;
use Carbon\Carbon;
use App\Models\User;
use Livewire\Component;
use App\Mail\MailNotify;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Mail;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminEditAdminProfile extends Component
{
    use WithFileUploads;
    public $user;
    public $avatar;
    public $birthday;
    public $state = [];
    public $old_password;
    public $new_password;
    public $old_email;
    public $email;
    public $email_sent;
    public $email_verified;
    public $edit = false;

    protected $listeners = ['sendAccDetailsConfirmed' => 'sendAccDetails', 'resetRestrictedEditConfirmed' => 'toggleAllowEditAll', 'allowRestrictedEditConfirmed' => 'toggleAllowEditAll', 'resetProfileConfirmed' => 'resetProfile'];
    public function mount($user)
    {
        $this->user = User::find($user->id);
        $this->state = $user->withoutRelations()->toArray();
        $this->email_sent = $this->user->email_sent;
        $this->email_verified = $this->user->email_verified_at;
        // dd($this->user->id);
    }

    public function emailStatus()
    {
        $this->email_sent = $this->user->email_sent;
        $this->email_verified = $this->user->email_verified_at;
    }

    public function sendAccDetailsConfirmation()
    {
        $this->dispatchBrowserEvent('show-send-acc-details-confirmation');
    }

    public function sendAccDetails()
    {
        $data = [
            "subject" => "Your BPC Alumni Portal Account Details",
            "username" => $this->user->username,
            "password" => $this->user->default_password,
        ];
        // MailNotify class that is extend from Mailable class.
        try {
            Mail::to($this->user->email)->send(new MailNotify($data));

            $this->user->email_sent = true;
            $this->user->save();

            $this->dispatchBrowserEvent('email-success');

        } catch (Exception $e) {
            // Log::error('Email sending failed: ' . $e->getMessage());
            // dd($e);
            toastr()->error('Something went wrong, please try again later.', 'Error!', [
                "showEasing" => "swing",
                "hideEasing" => "swing",
                "showMethod" => "slideDown",
                "hideMethod" => "slideUp"
            ]);
        }
        $this->emailStatus();
    }

    public function generatePassword()
    {
        // List of characters to be used in the random password
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_+';

        // Get the total number of characters in the list
        $numCharacters = strlen($characters);

        // Initialize an empty password string
        $generatedPassword = '';

        // Generate random characters to build the password
        for ($i = 0; $i < 12; $i++) {
            $randomIndex = rand(0, $numCharacters - 1);
            $generatedPassword .= $characters[$randomIndex];
        }

        // Update the $password property with the generated password
        $this->new_password = $generatedPassword;
    }

    public function allowRestrictedEditConfirmation()
    {
        $this->dispatchBrowserEvent('show-allow-restricted-edit-confirmation');
    }

    public function resetRestrictedEditConfirmation()
    {
        $this->dispatchBrowserEvent('show-reset-restricted-edit-confirmation');
    }

    public function resetRestrictedEdit()
    {
        $this->state['civil_status'] = $this->user->civil_status;
        $this->state['contact_no'] = $this->user->contact_no;
        $this->state['address'] = $this->user->address;
        $this->state['postal_code'] = $this->user->postal_code;
        $this->state['username'] = $this->user->username;
        $this->reset('avatar');
        $this->resetAccountSecurity();
    }

    public function toggleAllowEditAll()
    {
        if ($this->edit === false) {
            $this->edit = true;
        } else {
            $this->edit = false;
            $this->resetErrorBag();
            $this->resetRestrictedEdit();
        }

    }
    public function updated($accountSecurityFields)
    {
        if ($this->edit) {

            if ($this->user->default_password) {
                $this->old_password = $this->user->default_password;
            }

            $this->old_email = $this->user->email;


            Validator::make($this->state, [
                'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($this->user->id)],
                'username' => ['required', 'min:3', 'max:15', Rule::unique('users', 'username')->ignore($this->user->id)],
            ])->validate();

            $this->validateOnly(
                $accountSecurityFields,
                [
                    'new_password' => ['required', 'regex:/^[^\s]+$/', 'min:8', 'different:old_password'],
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
        $this->reset('new_password');
        $this->state['email'] = $this->user->email;
        $this->state['username'] = $this->user->username;
    }

    public function updateAccountSecurity()
    {
        if ($this->edit) {
            Validator::make($this->state, [
                'email' => ['required', 'email', 'regex:/^[^\s]+$/', Rule::unique('users', 'email')->ignore($this->user->id)],
                'username' => ['required', 'min:3', 'max:15', 'regex:/^[^\s]+$/', Rule::unique('users', 'username')->ignore($this->user->id)],
            ])->validate();
            $this->validate(
                [
                    'new_password' => ['required', 'regex:/^[^\s]+$/', 'min:8', 'different:old_password'],
                ],
                [
                    'new_password.regex' => 'password can not contain whitespace.'
                ]
            );

            $this->user->update([
                'password' => $this->new_password,
                'default_password' => $this->new_password,
                'email' => trim(strip_tags($this->state['email'])),
                'username' => trim(strip_tags($this->state['username']))
            ]);
            $this->resetAccountSecurity();

            toastr()->success('', 'Password updated successfully!', [
                "showEasing" => "swing",
                "hideEasing" => "swing",
                "showMethod" => "slideDown",
                "hideMethod" => "slideUp"
            ]);
        }
    }

    public function resetProfileConfirmation()
    {
        if (
            $this->state['civil_status'] !== $this->user->civil_status ||
            $this->state['contact_no'] !== $this->user->contact_no ||
            $this->state['address'] !== $this->user->address ||
            $this->state['postal_code'] !== $this->user->postal_code ||
            $this->state['first_name'] !== $this->user->first_name ||
            $this->state['middle_name'] !== $this->user->middle_name ||
            $this->state['last_name'] !== $this->user->last_name ||
            $this->state['birthday'] !== $this->user->birthday ||
            $this->state['gender'] !== $this->user->gender
        ) {
            $this->dispatchBrowserEvent('show-reset-profile-confirmation');
        }
    }

    public function resetProfile()
    {
        $this->resetErrorBag();
        if (
            $this->state['civil_status'] !== $this->user->civil_status ||
            $this->state['contact_no'] !== $this->user->contact_no ||
            $this->state['address'] !== $this->user->address ||
            $this->state['postal_code'] !== $this->user->postal_code ||
            $this->state['first_name'] !== $this->user->first_name ||
            $this->state['middle_name'] !== $this->user->middle_name ||
            $this->state['last_name'] !== $this->user->last_name ||
            $this->state['birthday'] !== $this->user->birthday ||
            $this->state['gender'] !== $this->user->gender
        ) {
            $this->state['civil_status'] = $this->user->civil_status;
            $this->state['contact_no'] = $this->user->contact_no;
            $this->state['address'] = $this->user->address;
            $this->state['postal_code'] = $this->user->postal_code;
            $this->state['first_name'] = $this->user->first_name;
            $this->state['middle_name'] = $this->user->middle_name;
            $this->state['last_name'] = $this->user->last_name;
            $this->state['birthday'] = $this->user->birthday;
            $this->state['gender'] = $this->user->gender;
            $this->state['age'] = $this->user->age;
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
        if ($this->edit) {
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

    }

    public function updateProfile()
    {
        $this->resetErrorBag();
        if (
            $this->state['civil_status'] !== $this->user->civil_status ||
            $this->state['contact_no'] !== $this->user->contact_no ||
            $this->state['address'] !== $this->user->address ||
            $this->state['postal_code'] !== $this->user->postal_code ||
            $this->state['first_name'] !== $this->user->first_name ||
            $this->state['middle_name'] !== $this->user->middle_name ||
            $this->state['last_name'] !== $this->user->last_name ||
            $this->state['birthday'] !== $this->user->birthday ||
            $this->state['gender'] !== $this->user->gender
        ) {
            $birthday = Carbon::createFromFormat('Y-m-d', $this->state['birthday']);
            $age = $birthday->diffInYears(Carbon::now());

            if ($this->edit) {
                Validator::make($this->state, [
                    'civil_status' => ['nullable', Rule::in(['single', 'married', 'separated', 'widowed'])],
                    'contact_no' => ['nullable', 'regex:/^[\+?\d\s]+$/'],
                    'first_name' => ['required'],
                    'middle_name' => ['required'],
                    'last_name' => ['required'],
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
            }

            toastr()->success('', 'Profile updated successfully!', [
                "showEasing" => "swing",
                "hideEasing" => "swing",
                "showMethod" => "slideDown",
                "hideMethod" => "slideUp"
            ]);

            $this->resetProfile();

        } else {
            toastr()->warning('', 'No changes has been saved!', [
                'progressBar' => false,
                "timeOut" => "2000",
                "showEasing" => "swing",
                "hideEasing" => "swing",
                "showMethod" => "slideDown",
                "hideMethod" => "slideUp"
            ]);

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
        return view('livewire.admin-edit-admin-profile');
    }
}
