<?php

namespace App\Http\Livewire;

use Exception;
use Carbon\Carbon;
use App\Models\User;
use Livewire\Component;
use App\Mail\MailNotify;
use App\Models\UserType;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Mail;

class AddAdminForm extends Component
{
    //add role
    // public $role;
    // public $description;

    //add Admin
    public $username;
    public $user_type;
    public $first_name;
    public $middle_name;
    public $last_name;
    public $gender;
    public $birthday;
    public $email;
    public $password;

    //role reference
    public $roles;

    //show roles
    public $showRoles = false;
    public $roleIdToUpdate;
    public $roleName;
    public $roleDescription;
    public $role_id;

    protected $listeners = ['adminConfirmed' => 'addAdmin', 'roleAdded' => 'updateRoles', 'deleteRoleConfirmed' => 'deleteRole', 'resetAdminFormConfirmed' => 'resetAdminForm'];

    public function mount()
    {
        $this->updateRoles();
    }
    //rerender roles
    public function updateRoles()
    {
        // Fetch the updated list of roles
        $this->roles = UserType::where('user_type', '!=', 'alumni')->get();
    }

    public function updateRole()
    {
        $this->resetErrorBag();
        $role = UserType::findOrFail($this->roleIdToUpdate);
        if ($this->roleDescription != $role->description) { 
            $this->validate([
                // 'roleName' => ['required'],
                'roleDescription' => ['required'],
            ]);
            $role->update([
                // 'user_type' => strtolower($this->roleName),
                'description' => $this->roleDescription,
            ]);

            $this->updateRoles();
            $this->cancelEdit();
            // toastr()->success('Role updated successfully!');
            toastr()->success('Role description updated successfully!');
        } else{
            toastr()->warning('No changes to be saved!');
        }
        
    }

    public function deleteRole()
    {
        $roleId = $this->role_id;
        $this->resetErrorBag();
        // Find the role by ID
        $role = UserType::findOrFail($roleId);


        if ($role) {
            // Delete the role
            $role->delete();
            $this->dispatchBrowserEvent('role-deleted');
        } else {
            $this->dispatchBrowserEvent('role-error');
        }

        // Refresh the roles list after deletion
        $this->roles = UserType::all();
    }

    public function deleteConfirmation($roleId)
    {
        $this->role_id = $roleId;
        $this->dispatchBrowserEvent('show-role-delete-confirmation');
    }

    public function cancelEdit()
    {
        $this->roleIdToUpdate = null;
        $this->roleName = null;
        $this->roleDescription = null;
    }

    public function editRole($roleId)
    {
        $role = UserType::findOrFail($roleId);

        if ($role) {
            $this->roleIdToUpdate = $role->id;
            // $this->roleName = $role->user_type;
            $this->roleDescription = $role->description;
        }
    }

    public function toggleShowRoles()
    {
        $this->showRoles = !$this->showRoles;
        $this->cancelEdit();
    }

    public function resetroleForm()
    {
        $this->reset(['role', 'description']);
    }

    public function addRole()
    {
        $this->resetErrorBag();
        $this->validate([
            'role' => ['required', 'unique:user_types,user_type'],
            'description' => ['required', 'max:255']
        ]);

        UserType::create([
            'user_type' => strtolower($this->role),
            'description' => $this->description,
        ]);

        $this->resetroleForm(); // Clear the input fields after adding the role

        toastr()->success('role added successfully!');
        // $this->dispatchBrowserEvent('role-success'); //showing success popup
        $this->emit('roleAdded');
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
            'student_no' => ['required', 'min:3', 'max:15', 'regex:/^[^\s]+$/', Rule::unique('users', 'username')],
            'email' => ['required', 'email', 'regex:/^[^\s]+$/', Rule::unique('users', 'email')],
            'password' => ['required', 'regex:/^[^\s]+$/', 'min:8'],
            'first_name' => ['required'],
            'last_name' => ['required'],
            'birthday' => ['required', 'date_format:Y-m-d'],
            'gender' => ['required', Rule::in(['male', 'female'])],
            'course_alumni' => ['required', Rule::exists('courses', 'course')],
            'year_graduated' => ['required', 'numeric'],
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
            'user_type' => ['required', Rule::in(['admin', 'content creator'])],
        ]);

        if ($this->birthday) {
            $birthday = Carbon::createFromFormat('Y-m-d', $this->birthday);
            $age = $birthday->diffInYears(Carbon::now());
        }

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
                // Log::error('Email sending failed: ' . $e->getMessage());
                // dd($e);
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
