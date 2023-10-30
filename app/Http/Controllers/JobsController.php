<?php

namespace App\Http\Controllers;

use App\Models\Jobs;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class JobsController extends Controller
{
    public function deleteJobs(Jobs $jobs)
    {
        $jobs->delete();
        toastr()->success('', 'Job deleted successfully!', [
            "showEasing" => "swing",
            "hideEasing" => "swing",
            "showMethod" => "slideDown",
            "hideMethod" => "slideUp"
        ]);
        return back();
    }

    public function updateJobs(Jobs $jobs, Request $request)
    {
        $incomingFields = $request->validate([
            'job_title' => 'required',
            'job_type' => ['required', Rule::in('full-time', 'part-time','freelance')],
            'company' => 'required',
            'description' => 'required',
            'responsibilities' => 'required',
            'requirements' => 'required',
            'location' => 'required',
            'salary' => 'nullable|numeric',
            'status' => ['required', Rule::in('active', 'archived')],
            'link' => ['nullable', 'string', 'url', 'required_if:email,null'],
            'email' => ['nullable', 'email', 'required_if:link,null'],

        ]);

        if ($jobs->salary !== $incomingFields['salary'] || $jobs->location !== $incomingFields['location'] || $jobs->job_type !== $incomingFields['job_type'] || $jobs->job_title !== $incomingFields['job_title'] || $jobs->company !== $incomingFields['company'] || $jobs->status !== $incomingFields['status'] || $jobs->description !== $incomingFields['description'] || $jobs->link !== $incomingFields['link']) {
            // Update the existing fields
            $jobs->job_title = trim(strip_tags(ucwords($incomingFields['job_title'])));
            $jobs->company = trim(ucwords($incomingFields['company']));
            $jobs->location = trim($incomingFields['location']);
            $jobs->salary = trim($incomingFields['salary']);
            $jobs->status = $incomingFields['status'];
            $jobs->description = $incomingFields['description'];
            $jobs->responsibilities = $incomingFields['responsibilities'];
            $jobs->requirements = $incomingFields['requirements'];
            $jobs->link = $incomingFields['link'];
            $jobs->email = $incomingFields['email'];
            $incomingFields['updated_by'] = auth()->user()->id;

            // Save the updated News instance
            $jobs->save();

            toastr()->success('', 'Job updated successfully!', [
                "showEasing" => "swing",
                "hideEasing" => "swing",
                "showMethod" => "slideDown",
                "hideMethod" => "slideUp"
            ]);

            return back();
        } else {
            toastr()->warning('', 'No changes has been saved!', [
                "showEasing" => "swing",
                "hideEasing" => "swing",
                "showMethod" => "slideDown",
                "hideMethod" => "slideUp"
            ]);
            return back();
        }
    }


    public function addJobs(Request $request)
    {

        $incomingFields = $request->validate([
            'job_title' => 'required',
            'job_type' => ['required', Rule::in('full-time', 'part-time','freelance')],
            'company' => 'required',
            'description' => 'required',
            'responsibilities' => 'required',
            'requirements' => 'required',
            'location' => 'required',
            'salary' => 'nullable|numeric',
            'status' => ['required', Rule::in('active', 'archived')],
            'link' => ['nullable', 'string', 'url', 'required_if:email,null'],
            'email' => ['nullable', 'email', 'required_if:link,null'],
        ]);

        $incomingFields['job_title'] = trim(strip_tags(ucwords($incomingFields['job_title'])));
        $incomingFields['company'] = trim(ucwords($incomingFields['company']));
        $incomingFields['salary'] = trim($incomingFields['salary']);
        $incomingFields['location'] = trim($incomingFields['location']);
        $incomingFields['posted_by'] = auth()->user()->username;
        $incomingFields['updated_by'] = auth()->user()->id;

        // dd($incomingFields);
        Jobs::create($incomingFields);


        toastr()->success('', 'Job added successfully!', [
            "showEasing" => "swing",
            "hideEasing" => "swing",
            "showMethod" => "slideDown",
            "hideMethod" => "slideUp"
        ]);
        return back();

    }
}