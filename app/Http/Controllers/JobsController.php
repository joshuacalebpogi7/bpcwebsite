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
        toastr()->success('', 'Event deleted successfully!', [
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
            'title' => 'required',
            'job_title' => 'required',
            'company' => 'required',
            'description' => 'required',
            'location' => 'required',
            'salary' => 'required|numeric',
            'status' => ['required', Rule::in('active', 'archived')],
            'link' => ['nullable', 'string', 'url'],
            'image' => 'nullable|image|max:5000',

        ]);

        if (isset($jobs->image) || $jobs->salary !== $incomingFields['salary'] || $jobs->location !== $incomingFields['location'] || $jobs->title !== $incomingFields['title'] || $jobs->job_title !== $incomingFields['job_title'] || $jobs->company !== $incomingFields['company'] || $jobs->status !== $incomingFields['status'] || $jobs->description !== $incomingFields['description'] || $jobs->link !== $incomingFields['link']) {
            // Update the existing fields
            $jobs->title = trim(strip_tags(ucwords($incomingFields['title'])));
            $jobs->job_title = trim(strip_tags(ucwords($incomingFields['job_title'])));
            $jobs->company = trim(ucwords($incomingFields['company']));
            $jobs->location = trim($incomingFields['location']);
            $jobs->salary = $incomingFields['salary'];
            $jobs->status = $incomingFields['status'];
            $jobs->description = $incomingFields['description'];
            $jobs->link = $incomingFields['link'];
            $incomingFields['updated_by'] = auth()->user()->username;

            // Handle the image if provided
            if ($request->hasFile('image')) {
                $image_name = $incomingFields['title'] . uniqid() . '.jpg';
                $imgData = Image::make($request->file('image'))->encode('jpg');
                Storage::put('public/jobs-image/' . $image_name, $imgData);
                $jobs->image = $image_name;
            }

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
            'title' => 'required',
            'job_title' => 'required',
            'company' => 'required',
            'description' => 'required',
            'location' => 'required',
            'salary' => 'required|numeric',
            'status' => ['required', Rule::in('active', 'archived')],
            'link' => ['nullable', 'string', 'url'],
            'image' => 'nullable|image|max:5000',
        ]);

        if ($request->hasFile('image')) {
            $image_name = $incomingFields['title'] . uniqid() . '.jpg';
            $imgData = Image::make($request->file('image'))->encode('jpg');
            Storage::put('public/jobs-image/' . $image_name, $imgData);
            $incomingFields['image'] = $image_name;
        }

        $incomingFields['title'] = trim(strip_tags(ucwords($incomingFields['title'])));
        $incomingFields['job_title'] = trim(strip_tags(ucwords($incomingFields['job_title'])));
        $incomingFields['company'] = trim(ucwords($incomingFields['company']));
        $incomingFields['posted_by'] = auth()->user()->username;
        $incomingFields['updated_by'] = auth()->user()->username;

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