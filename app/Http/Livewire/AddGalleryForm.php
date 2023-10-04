<?php

namespace App\Http\Livewire;

use App\Models\Gallery;
use Livewire\Component;

class AddGalleryForm extends Component
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

    protected $listeners = ['courseAdded' => 'updateCourses', 'deleteCourseConfirmed' => 'deleteCourse', 'resetAlumniFormConfirmed' => 'resetAlumniForm'];

    public function mount()
    {
        $this->updateCourses();
    }

    public function editCourse($courseId)
    {
        $gallery = Gallery::findOrFail($courseId);

        if ($course) {
            $this->courseIdToUpdate = $course->id;
            $this->courseName = $course->course;
            $this->courseDescription = $course->description;
        }
    }

    public function updateCourse()
    {
        $this->resetErrorBag();
        $this->validate([
            'courseName' => ['required'],
            'courseDescription' => ['required'],
        ]);

        $course = Course::findOrFail($this->courseIdToUpdate);
        $course->update([
            'course' => $this->courseName,
            'description' => $this->courseDescription,
        ]);

        $this->updateCourses();
        $this->cancelEdit();
        session()->flash('success', 'Course successfully updated.');
    }

    public function cancelEdit()
    {
        $this->courseIdToUpdate = null;
        $this->courseName = null;
        $this->courseDescription = null;
    }

    public function toggleShowCourses()
    {
        $this->showCourses = !$this->showCourses;
        $this->cancelEdit();
    }

    public function updateCourses()
    {
        // Fetch the updated list of courses
        $this->courses = Course::all();
    }

    public function deleteConfirmation($courseId)
    {
        $this->course_id = $courseId;
        $this->dispatchBrowserEvent('show-course-delete-confirmation');
    }
    public function deleteCourse()
    {
        $courseId = $this->course_id;
        $this->resetErrorBag();
        // Find the course by ID
        $course = Course::findOrFail($courseId);


        if ($course) {
            // Delete the course
            $course->delete();
            $this->dispatchBrowserEvent('course-deleted');
        } else {
            $this->dispatchBrowserEvent('course-error');
        }

        // Refresh the courses list after deletion
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
                'year_graduated',
            ]);
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
            // 'middle_name' => ['required'],
            'last_name' => ['required'],
            'birthday' => ['required', 'date_format:Y-m-d'],
            'gender' => ['required', Rule::in(['male', 'female'])],
            'course_alumni' => ['required', Rule::exists('courses', 'course')],
            'year_graduated' => ['required', 'numeric'],
        ]);

        User::create([
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
        ]);

        $this->resetAlumniForm();

        session()->flash('success', 'Alumni successfully added.');
    }

    public function resetCourseForm()
    {
        $this->reset(['course', 'description']);
    }

    public function addCourse()
    {
        $this->resetErrorBag();
        $this->validate([
            'course' => ['required'],
            'description' => ['required', 'max:255']
        ]);

        Course::create([
            'course' => $this->course,
            'description' => $this->description,
        ]);

        $this->resetCourseForm(); // Clear the input fields after adding the course
        $this->dispatchBrowserEvent('course-success');
        $this->emit('courseAdded');
    }
    public function render()
    {
        return view('livewire.add-gallery-form');
    }
}
