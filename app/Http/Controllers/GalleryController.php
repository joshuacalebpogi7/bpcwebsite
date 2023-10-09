<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function deletePhoto(Gallery $gallery){
        $gallery->delete();
        // toastr()->success('', 'Event deleted successfully!', [
        //     "showEasing" => "swing",
        //     "hideEasing" => "swing",
        //     "showMethod" => "slideDown",
        //     "hideMethod" => "slideUp"
        // ]);
        return back();
    }
}
