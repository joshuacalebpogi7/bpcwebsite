<?php

namespace App\Http\Livewire;

use Exception;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Course;
use Livewire\Component;
use App\Mail\MailNotify;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;

class AddAlumniForm extends Component
{
    //add course
    public $course;
    public $description;

    //add alumni
    public $student_no;
    public $course_alumni;
    public $year_graduated;
    public $first_name;
    public $middle_name;
    public $last_name;
    public $contact_no;
    public $gender;
    public $birthday;
    public $email;
    public $password;

    //course reference
    public $courses;

    //show courses
    public $showCourses = false;
    public $courseIdToUpdate;
    public $courseName;
    public $courseDescription;
    public $course_id;

    public $isSubmitting = false;

    protected $listeners = ['alumniConfirmed' => 'addAlumni', 'courseAdded' => 'updateCourses', 'deleteCourseConfirmed' => 'deleteCourse', 'resetAlumniFormConfirmed' => 'resetAlumniForm'];

    public function mount()
    {
        $this->updateCourses();
    }

    public function updateCourses()
    {
        // Fetch the updated list of courses
        $this->courses = Course::all();
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
    public function resetAlumniFormConfirmation()
    {
        if (
            !empty($this->student_no) ||
            !empty($this->email) ||
            !empty($this->password) ||
            !empty($this->first_name) ||
            !empty($this->middle_name) ||
            !empty($this->last_name) ||
            !empty($this->birthday) ||
            !empty($this->gender) ||
            !empty($this->course_alumni) ||
            !empty($this->year_graduated)
        ) {
            $this->dispatchBrowserEvent('show-reset-alumni-form-confirmation');
        }
    }
    public function resetAlumniForm()
    {
        if (
            !empty($this->student_no) ||
            !empty($this->email) ||
            !empty($this->password) ||
            !empty($this->first_name) ||
            !empty($this->middle_name) ||
            !empty($this->last_name) ||
            !empty($this->birthday) ||
            !empty($this->gender) ||
            !empty($this->course_alumni) ||
            !empty($this->contact_no) ||
            !empty($this->year_graduated)
        ) {
            $this->reset([
                'student_no',
                'email',
                'password',
                'first_name',
                'middle_name',
                'last_name',
                'birthday',
                'gender',
                'course_alumni',
                'contact_no',
                'year_graduated',
            ]);
        }
    }

    public function addAlumniConfirmation()
    {
        $validate = $this->validate([
            'student_no' => ['required', 'min:3', 'max:15', 'regex:/^[^\s]+$/', Rule::unique('users', 'username')],
            'email' => ['required', 'email', 'regex:/^[^\s]+$/', Rule::unique('users', 'email')],
            'password' => ['required', 'regex:/^[^\s]+$/', 'min:8'],
            'first_name' => ['required'],
            'last_name' => ['required'],
            'contact_no' => ['required'],
            'birthday' => ['required', 'date_format:Y-m-d'],
            'gender' => ['required', Rule::in(['male', 'female'])],
            'course_alumni' => ['required', Rule::exists('courses', 'course')],
            'year_graduated' => ['required', 'numeric'],
        ]);
        if ($validate) {
            $this->dispatchBrowserEvent('show-add-alumni-confirmation');
        }
        
    }

    public function addAlumni()
    {

    $this->resetErrorBag();

        if ($this->birthday) {
            $birthday = Carbon::createFromFormat('Y-m-d', $this->birthday);
            $age = $birthday->diffInYears(Carbon::now());
        }
        $this->validate([
            'student_no' => ['required', 'min:3', 'max:15', 'regex:/^[^\s]+$/', Rule::unique('users', 'username')],
            'email' => ['required', 'email', 'regex:/^[^\s]+$/', Rule::unique('users', 'email')],
            'password' => ['required', 'regex:/^[^\s]+$/', 'min:8'],
            'first_name' => ['required'],
            'last_name' => ['required'],
            'contact_no' => ['required'],
            'birthday' => ['required', 'date_format:Y-m-d'],
            'gender' => ['required', Rule::in(['male', 'female'])],
            'course_alumni' => ['required', Rule::exists('courses', 'course')],
            'year_graduated' => ['required', 'numeric'],
        ]);


        $user = User::create([
            'username' => $this->student_no,
            'email' => $this->email,
            'password' => $this->password,
            'first_name' => trim(strip_tags(ucwords($this->first_name))),
            'middle_name' => trim(strip_tags(ucwords($this->middle_name))),
            'last_name' => trim(strip_tags(ucwords($this->last_name))),
            'birthday' => $this->birthday,
            'gender' => $this->gender,
            'course' => $this->course_alumni,
            'year_graduated' => $this->year_graduated,
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
    
                $this->dispatchBrowserEvent('alumni-added');

                $this->resetAlumniForm();

                toastr()->success('Alumni added successfully!');
    
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
        return view('livewire.add-alumni-form');
    }
}