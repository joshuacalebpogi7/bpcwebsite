<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class NewsController extends Controller
{
    public function deleteNews(News $news)
    {
        $news->delete();
        toastr()->success('', 'News deleted successfully!', [
            "showEasing" => "swing",
            "hideEasing" => "swing",
            "showMethod" => "slideDown",
            "hideMethod" => "slideUp"
        ]);
        return back();
    }

    public function updateNews(News $news, Request $request)
    {

        $incomingFields = $request->validate([
            'title' => 'required',
            'author' => 'string',
            'category' => 'required',
            'description' => 'required',
            'thumbnail' => 'nullable|image|max:5000',
        ]);

        if ($news->title !== $incomingFields['title'] || $news->author !== $incomingFields['author'] || $news->category !== $incomingFields['category'] || $news->description !== $incomingFields['description'] || $request->hasFile('thumbnail')) {
            // Update the existing fields
            $news->title = trim(strip_tags(ucwords($incomingFields['title'])));
            $news->author = trim(strip_tags(ucwords($incomingFields['author'])));
            $news->category = trim(strip_tags(ucwords(strtoupper($incomingFields['category']))));
            $news->description = $incomingFields['description'];
            $news->updated_by = auth()->user()->id;

            // Handle the thumbnail if provided
            if ($request->hasFile('thumbnail')) {
                $thumbnail_name = $incomingFields['title'] . uniqid() . '.jpg';
                $imgData = Image::make($request->file('thumbnail'))->encode('jpg');
                Storage::put('public/news-thumbnail/' . $thumbnail_name, $imgData);
                $news->thumbnail = $thumbnail_name;
            }

            // Save the updated News instance
            $news->save();

            toastr()->success('', 'News updated successfully!', [
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


    public function addNews(Request $request)
    {

        $incomingFields = $request->validate([
            'title' => 'required',
            'author' => 'string',
            'description' => 'required',
            'category' => 'required',
            'thumbnail' => 'nullable|image|max:5000',
        ]);


        if ($request->hasFile('thumbnail')) {
            $thumbnail_name = $incomingFields['title'] . uniqid() . '.jpg';
            $imgData = Image::make($request->file('thumbnail'))->encode('jpg');
            Storage::put('public/news-thumbnail/' . $thumbnail_name, $imgData);
            $incomingFields['thumbnail'] = $thumbnail_name;
        }

        $incomingFields['title'] = trim(strip_tags(ucwords($incomingFields['title'])));
        $incomingFields['author'] = trim(strip_tags(ucwords($incomingFields['author'])));
        $incomingFields['category'] = trim(strip_tags(ucwords(strtoupper($incomingFields['category']))));

        $incomingFields['posted_by'] = auth()->user()->id;
        $incomingFields['updated_by'] = auth()->user()->id;

        // dd($incomingFields);
        News::create($incomingFields);


        toastr()->success('', 'News added successfully!', [
            "showEasing" => "swing",
            "hideEasing" => "swing",
            "showMethod" => "slideDown",
            "hideMethod" => "slideUp"
        ]);
        return back();

    }
}