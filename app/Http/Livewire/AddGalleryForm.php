<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Gallery; // Change this to match your Gallery Photo model
use App\Models\GalleryAlbum; // Change this to match your Gallery Album model

class AddGalleryForm extends Component // Change the class name accordingly
{
    // Properties for gallery form
    use WithFileUploads;
    public $title;
    public $selectedAlbum; // Add this property for the selected album
    public $photo;
    public $gallery_description;

    // Properties for album form
    public $album_name;
    public $description;
    public $album_cover;

    // Other properties as needed
    public $galleryAlbum;
    public $showAlbums = false;
    public $gallery;

    // Constructor to fetch albums
    public function mount()
    {
        $this->albums = GalleryAlbum::all();
        $this->galleryalbum = GalleryAlbum::find(1);
        $this->gallery = Gallery::find(1);
    }

    public function resetAlbumCover()
    {
        $this->album_cover = null; // Reset the file input
    }

    public function toggleShowAlbums()
{
    $this->showAlbums = !$this->showAlbums;
}

    // Method to add a photo
    public function addPhoto()
    {
        $this->resetErrorBag();
        $this->validate([
            'title' => ['required'],
            'selectedAlbum' => ['required', 'exists:gallery_albums,id'], // Validate selected album
            'photo' => ['required', 'image', 'max:5120'], // Example validation for photo
            // Add validation rules for other fields as needed
            'gallery_description' => ['required'],
            
        ]);

        // Save the uploaded photo
        $photoName = time() . '-' . $this->photo->getClientOriginalName();
        $photoPath = $this->photo->storeAs('photos', $photoName, 'public');

        // Create the photo record with the selected album ID
        if ($photoPath) {
        Gallery::create([
            'title' => $this->title,
            'gallery_album_id' => $this->selectedAlbum,
            'photo' => $photoName,
            // Add other photo-related fields as needed
            'description' => $this->gallery_description,
            'posted_by' => Auth::user()->username,
            'updated_by' => Auth::user()->username,
        ]);
        // Reset the form
        $this->resetAddPhotoFormConfirmation();
    }
}
    public function resetPhoto()
{
    $this->photo = null; // Reset the photo property to null
}

public function resetAddPhotoFormConfirmation()
{
    // Your reset logic here
    $this->reset([
        'title',
        'selectedAlbum', // Validate selected album
        'photo', // Example validation for photo
        'gallery_description'
    ]);
}


    // Method to add an album
    public function addAlbum()
    {
        $this->resetErrorBag();
        $this->validate([
            'album_name' => ['required'],
            'description' => ['required'],
            // Add other album-related validation rules as needed
        ]);

        // Save the album cover (if needed)
        $albumCoverName  = time() . '-' . $this->album_cover->getClientOriginalName();
        $albumCoverPath = $this->album_cover->storeAs('album_covers', $albumCoverName, 'public');

        // Create the album record
        if ($albumCoverPath) {
        GalleryAlbum::create([
            'album_name' => $this->album_name,
            'description' => $this->description,
            'album_cover' => $albumCoverName, // Set the album cover path
            // Add other album-related fields as needed
            'posted_by' => Auth::user()->username,
            'updated_by' => Auth::user()->username,
        ]);

        // Reset the form
        $this->resetAlbumForm();
    }
}

    public function resetAlbumForm()
{
    // Reset the form fields and any other necessary data
    $this->reset([
        'album_name',
        'description',
        'album_cover',
    ]);
}


    // Other methods and functionality as needed

    public function render(Gallery $gallery, GalleryAlbum $galleryalbum)
    {
        $this->albums = GalleryAlbum::all();
        return view('livewire.add-gallery-form', ['gallery' => $gallery, 'albums' => $galleryalbum]); // Change the view name accordingly
    }
}
