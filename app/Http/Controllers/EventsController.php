<?php

namespace App\Http\Controllers;

use App\Models\Events;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class EventsController extends Controller
{
    public function deleteEvents(Events $events)
    {
        $events->delete();
        toastr()->success('', 'Event deleted successfully!', [
            "showEasing" => "swing",
            "hideEasing" => "swing",
            "showMethod" => "slideDown",
            "hideMethod" => "slideUp"
        ]);
        return back();
    }

    public function updateEvents(Events $events, Request $request)
    {
        $incomingFields = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'category' => 'required',
            'event_start' => 'required|date',
            'event_end' => 'required|date|after:event_start',
            'thumbnail' => 'nullable|image|max:5000',
            'link' => ['nullable', 'string', 'url'],
        ]);
        // dd(date('Y-m-d H:i:s', strtotime($events->event_start)) !== date('Y-m-d H:i:s', strtotime(($incomingFields['event_start']))));
        if ($events->title !== $incomingFields['title'] || $events->category !== $incomingFields['category'] || $events->description !== $incomingFields['description'] || date('Y-m-d H:i:s', strtotime($events->event_start)) !== date('Y-m-d H:i:s', strtotime($incomingFields['event_start'])) || date('Y-m-d H:i:s', strtotime($events->event_end)) !== date('Y-m-d H:i:s', strtotime($incomingFields['event_end'])) || $request->hasFile('thumbnail') || $events->link !== $incomingFields['link']) {
            // Update the existing fields
            $events->title = trim(strip_tags(ucwords($incomingFields['title'])));
            $events->category = trim(strip_tags(ucwords(strtoupper($incomingFields['category']))));
            $events->description = $incomingFields['description'];
            $events->event_start = $incomingFields['event_start'];
            $events->event_end = $incomingFields['event_end'];
            $events->link = $incomingFields['link'];
            $incomingFields['updated_by'] = auth()->user()->username;

            // Handle the thumbnail if provided
            if ($request->hasFile('thumbnail')) {
                $thumbnail_name = $incomingFields['title'] . uniqid() . '.jpg';
                $imgData = Image::make($request->file('thumbnail'))->encode('jpg');
                Storage::put('public/events-thumbnail/' . $thumbnail_name, $imgData);
                $events->thumbnail = $thumbnail_name;
            }

            // Save the updated News instance
            $events->save();

            toastr()->success('', 'Event updated successfully!', [
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


    public function addEvents(Request $request)
    {

        $incomingFields = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'category' => 'required',
            'event_start' => 'required|date|after:now',
            'event_end' => 'required|date|after:event_start',
            'thumbnail' => 'nullable|image|max:5000',
            'link' => ['nullable', 'string', 'url'],
        ]);

        // will not encode the image to jpg
        // $thumbnail_name = $incomingFields['title'] . uniqid() . '.' . $request->file('thumbnail')->getClientOriginalExtension();
        // $imgData = Image::make($request->file('thumbnail'));
        // Storage::put('public/events-thumbnail/' . $thumbnail_name, $imgData);

        if ($request->hasFile('thumbnail')) {
            $thumbnail_name = $incomingFields['title'] . uniqid() . '.jpg';
            $imgData = Image::make($request->file('thumbnail'))->encode('jpg');
            Storage::put('public/events-thumbnail/' . $thumbnail_name, $imgData);
            $incomingFields['thumbnail'] = $thumbnail_name;
        }

        $incomingFields['title'] = trim(strip_tags(ucwords($incomingFields['title'])));
        $incomingFields['category'] = trim(strip_tags(ucwords(strtoupper($incomingFields['category']))));
        $incomingFields['posted_by'] = auth()->user()->username;
        $incomingFields['updated_by'] = auth()->user()->username;

        // dd($incomingFields);
        Events::create($incomingFields);


        toastr()->success('', 'Event added successfully!', [
            "showEasing" => "swing",
            "hideEasing" => "swing",
            "showMethod" => "slideDown",
            "hideMethod" => "slideUp"
        ]);
        return back();

    }
}