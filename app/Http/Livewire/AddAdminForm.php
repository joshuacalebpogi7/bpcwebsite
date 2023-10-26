<?php

namespace App\Http\Livewire;

use Exception;
use Carbon\Carbon;
use App\Models\User;
use Livewire\Component;
use App\Mail\MailNotify;
use App\Models\UserType;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class AddAdminForm extends Component
{
    //add role
    // public $role;
    // public $description;

    //add Admin
    public $user_type;
    public $username;
    public $first_name;
    public $middle_name;
    public $last_name;
    public $gender;
    public $birthday;
    public $contact_no;
    public $email;
    public $password;


    protected $listeners = ['adminConfirmed' => 'addAdmin', 'resetAdminFormConfirmed' => 'resetAdminForm'];

    public function mount()
    {
        
    }

    public function resetAdminFormConfirmation()
    {
        if (
            !empty($this->username) ||
            !empty($this->email) ||
            !empty($this->password) ||
            !empty($this->first_name) ||
            !empty($this->middle_name) ||
            !empty($this->last_name) ||
            !empty($this->birthday) ||
            !empty($this->gender) ||
            !empty($this->contact_no) ||
            !empty($this->user_type)
        ) {
            $this->dispatchBrowserEvent('show-reset-admin-form-confirmation');
        }
    }
    public function resetAdminForm()
    {
        if (
            !empty($this->username) ||
            !empty($this->email) ||
            !empty($this->password) ||
            !empty($this->first_name) ||
            !empty($this->middle_name) ||
            !empty($this->last_name) ||
            !empty($this->birthday) ||
            !empty($this->gender) ||
            !empty($this->contact_no) ||
            !empty($this->user_type)
        ) {
            $this->reset([
                'username',
                'email',
                'password',
                'first_name',
                'middle_name',
                'last_name',
                'birthday',
                'gender',
                'contact_no',
                'user_type',
            ]);
        }
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
        $this->password = $generatedPassword;
    }

    public function addAdminConfirmation()
    {
        $validate = $this->validate([
            'username' => ['required', 'min:3', 'max:15', 'regex:/^[^\s]+$/', Rule::unique('users', 'username')],
            'email' => ['required', 'email', 'regex:/^[^\s]+$/', Rule::unique('users', 'email')],
            'password' => ['required', 'regex:/^[^\s]+$/', 'min:8'],
            'first_name' => ['required'],
            'last_name' => ['required'],
            'birthday' => ['required', 'date_format:Y-m-d'],
            'gender' => ['required', Rule::in(['male', 'female'])],
            'contact_no' => ['required'],
        ]);
        if ($validate) {
            $this->dispatchBrowserEvent('show-add-admin-confirmation');
        }
        
    }

    public function addAdmin()
    {
        $this->resetErrorBag();

        $this->validate([
            'username' => ['required', 'min:3', 'max:15', 'regex:/^[^\s]+$/', Rule::unique('users', 'username')],
            'email' => ['required', 'email', 'regex:/^[^\s]+$/', Rule::unique('users', 'email')],
            'password' => ['required', 'regex:/^[^\s]+$/', 'min:8'],
            'first_name' => ['required'],
            'middle_name' => ['nullable'],
            'last_name' => ['required'],
            'birthday' => ['required', 'date_format:Y-m-d'],
            'gender' => ['required', Rule::in(['male', 'female'])],
            'contact_no' => ['required'],
        ]);

        if ($this->birthday) {
            $birthday = Carbon::createFromFormat('Y-m-d', $this->birthday);
            $age = $birthday->diffInYears(Carbon::now());
        }
        $this->user_type = 'content creator';

        $user = User::create([
            'username' => $this->username,
            'email' => $this->email,
            'password' => $this->password,
            'first_name' => trim(strip_tags(ucwords($this->first_name))),
            'middle_name' => trim(strip_tags(ucwords($this->middle_name))),
            'last_name' => trim(strip_tags(ucwords($this->last_name))),
            'birthday' => $this->birthday,
            'gender' => $this->gender,
            'user_type' => $this->user_type,
            "age" => $age,
            'default_password' => $this->password,
            'contact_no' => $this->contact_no,
        ]);

        if($user){
            $data = [
            "subject" => "Your BPC Alumni Portal Account Details",
            "username" => $user->username,
            "password" => $user->default_password,
            ];
            // MailNotify class that is extend from Mailable class.
            try {
                Mail::to($user->email)->send(new MailNotify($data));
    
                $user->email_sent = true;
                $user->save();
    
                $this->dispatchBrowserEvent('admin-added');

                $this->resetAdminForm();

                toastr()->success('Admin added successfully!');

    
            } catch (Exception $e) {
                Log::error('Email sending failed: ' . $e->getMessage());
                dd($e);
                toastr()->error('Something went wrong, please try again later.', 'Error!', [
                    "showEasing" => "swing",
                    "hideEasing" => "swing",
                    "showMethod" => "slideDown",
                    "hideMethod" => "slideUp"
                ]);
            }
        }

    }

    public function render()
    {
        return view('livewire.add-admin-form');
    }
}
