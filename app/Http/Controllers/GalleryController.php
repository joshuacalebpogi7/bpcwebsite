<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\GalleryAlbum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function deleteAlbum(GalleryAlbum $galleryAlbum){
        $photos = Gallery::where('gallery_album_id', $galleryAlbum->id)->get();

        // Delete the photos in the photos folder
    foreach ($photos as $photo) {
        $photoPath = str_replace("/storage/", "public/", $photo->photo);
        if (Storage::exists($photoPath)) { //use storage facade not file_exists because public/photos/$photo is not real path. we use storage link so we can link to public.
            Storage::delete($photoPath);
        }
    }

    $albumCoverPath = str_replace("/storage/", "public/", $galleryAlbum->album_cover);
    if (Storage::exists($albumCoverPath) || $galleryAlbum->album_cover != "/fallback_noPhoto.jpg") {
        Storage::delete($albumCoverPath); // Delete the file
    }
        $galleryAlbum->delete();
        toastr()->success('', 'Album deleted successfully!', [
            "showEasing" => "swing",
            "hideEasing" => "swing",
            "showMethod" => "slideDown",
            "hideMethod" => "slideUp"
        ]);
        return back();
    }
}
