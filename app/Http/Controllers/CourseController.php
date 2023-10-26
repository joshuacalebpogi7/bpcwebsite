<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CourseController extends Controller
{
    //
    public function deleteCourse(Course $course)
    {
        $course->delete();
        toastr()->success('', 'Course deleted successfully!', [
            "showEasing" => "swing",
            "hideEasing" => "swing",
            "showMethod" => "slideDown",
            "hideMethod" => "slideUp"
        ]);
        return back();
    }

    public function updateCourse(Course $course, Request $request)
    {
        $incomingFields = $request->validate([
            'course' => 'required|unique:course,course',
            'description' => 'required',
        ]);
        if ($course->course !== $incomingFields['course'] || $course->description !== $incomingFields['description']) {
            // Update the existing fields
            $course->course = $incomingFields['title'];
            $course->description = $incomingFields['category'];
            $incomingFields['updated_by'] = auth()->user()->username;
            $course->save();

            toastr()->success('', 'Course updated successfully!', [
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


    public function addCourse(Request $request)
    {

        $incomingFields = $request->validate([
            'course' => 'required|unique:course,course',
            'description' => 'required',
        ]);

        $incomingFields['posted_by'] = auth()->user()->username;
        $incomingFields['updated_by'] = auth()->user()->username;

        // dd($incomingFields);
        Course::create($incomingFields);


        toastr()->success('', 'Course added successfully!', [
            "showEasing" => "swing",
            "hideEasing" => "swing",
            "showMethod" => "slideDown",
            "hideMethod" => "slideUp"
        ]);
        return back();

    }
}
