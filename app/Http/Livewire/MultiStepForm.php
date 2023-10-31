<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class MultiStepForm extends Component
{
    use WithFileUploads;

    public $user;
    public $contact_no;
    public $civil_status;
    public $address;
    public $postal_code;
    public $employment_status;
    public $category;
    public $job_type;
    public $job_title;
    public $job_location;
    public $monthly_salary;
    public $new_password;
    public $confirm_password;
    public $avatar;

    public $totalSteps;
    public $currentStep;
    public $isDisabled = false;


    public function mount()
    {
        $this->currentStep = 1;
        $this->totalSteps = 4;
        $this->user = Auth::user();
    }

    public function updatedEmploymentStatus($value)
    {
        if ($value === 'unemployed') {
            $this->reset([
                'job_type',
                'category',
                'job_title',
                'job_location',
                'monthly_salary',
            ]);
        } elseif ($value === 'self-employed') {
            $this->reset([
                'job_location',
                'monthly_salary',
            ]);
        } elseif ($value === '') {
            $this->reset([
                'job_type',
                'category',
                'job_title',
                'job_location',
                'monthly_salary',
            ]);
        }
    }
    public function increaseStep()
    {
        $this->resetErrorBag();
        $this->validateData();
        $this->currentStep++;
        if ($this->currentStep > $this->totalSteps) {
            $this->currentStep = $this->totalSteps;
        }
    }

    public function decreaseStep()
    {
        $this->resetErrorBag();
        $this->currentStep--;
        if ($this->currentStep < 1) {
            $this->currentStep = 1;
        }
    }

    public function validateData()
    {
        if ($this->currentStep == 1) {
            $this->validate([
                'contact_no' => ['required', 'regex:/^[\+?\d\s]+$/'],
                'civil_status' => ['required', Rule::in(['single', 'married', 'separated', 'widowed'])],
                'address' => ['required'],
                'postal_code' => ['required'],
            ]);
        } elseif ($this->currentStep == 2) {
            $this->validate([
                'employment_status' => ['required', Rule::in(['unemployed', 'employed', 'self-employed'])],
                'category' => ['required_if:employment_status,employed,self-employed'],
                'job_type' => ['required_if:employment_status,employed,self-employed'],
                'job_title' => ['required_if:employment_status,employed,self-employed'],
                'job_location' => ['required_if:employment_status,employed'],
                'monthly_salary' => ['required_if:employment_status,employed', 'nullable', 'numeric'],
            ]);
        } elseif ($this->currentStep == 3) {
            $this->validate([
                'new_password' => ['required', 'regex:/^[^\s]+$/', 'min:8', 'different:old_password'],
                'confirm_password' => ['required', 'same:new_password'],
            ]);
        }
    }
    public function submitAdditionalInfo()
    {
        $this->resetErrorBag();
        if ($this->currentStep == 4) {
            $this->validate([
                'avatar' => ['required', 'image', 'max:5000']
            ]);
        }

        $avatar_name = $this->user->username . '-' . time() . '-' . $this->avatar->getClientOriginalName();
        $imgData = Image::make($this->avatar)->encode('jpg');
        $upload_avatar = Storage::put('public/avatars/' . $avatar_name, $imgData);

        if ($upload_avatar) {
            $oldAvatar = $this->user->avatar;
            $this->user->update([
                "contact_no" => $this->contact_no,
                "civil_status" => $this->civil_status,
                "address" => trim(strip_tags($this->address)),
                "postal_code" => $this->postal_code,
                "employment_status" => $this->employment_status,
                "category" => $this->category,
                "job_type" => $this->job_type,
                "job_title" => trim(strip_tags(ucwords($this->job_title))),
                "job_location" => trim(strip_tags($this->job_location)),
                "monthly_salary" => $this->monthly_salary,
                "add_info_completed" => true,
                "avatar" => $avatar_name,
                "password" => $this->confirm_password,
                'default_password' => null
            ]);

            if ($oldAvatar != '/fallback_avatar.png') {
                Storage::delete(str_replace("/storage/", "public/", $oldAvatar));
            }
            $this->deleteLockFile();

            return redirect('/survey')->with('info', 'Congrats please complete this survey!');
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

    // protected function cleanupOldUploads()
    // {

    //     $storage = Storage::disk('local');

    //     foreach ($storage->allFiles('livewire-tmp') as $filePathname) {
    //         // On busy websites, this cleanup code can run in multiple threads causing part of the output
    //         // of allFiles() to have already been deleted by another thread.
    //         if (!$storage->exists($filePathname))
    //             continue;

    //         $yesterdaysStamp = now()->subSeconds(10)->timestamp;

    //         if ($yesterdaysStamp > $storage->lastModified($filePathname)) {
    //             $storage->delete($filePathname);
    //         }
    //     }
    // }

    public function render()
    {
        return view('livewire.multi-step-form');
    }
}