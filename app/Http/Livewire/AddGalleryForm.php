<?php

namespace App\Http\Livewire;

use App\Models\Gallery;
use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\GalleryAlbum;
use Livewire\WithFileUploads;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class AddGalleryForm extends Component
{
    use WithFileUploads;
 
    public $description;
    public $album_cover;
    public $photo;
    //gallery model
    public $gallery;
    //gallery album model
    public $galleryAlbum;
    public $showAlbums = false;
    public $albumIdToUpdate;
    public $album_name;
    public $albumName;
    public $albumDescription;
    public $album_id;

    // protected $listeners = ['courseAdded' => 'updateCourses', 'deleteCourseConfirmed' => 'deleteCourse', 'resetAlumniFormConfirmed' => 'resetAlumniForm'];

    public function mount()
    {
        $this->updateAlbums();
    }
    public function editAlbum($albumId)
    {
        $album = GalleryAlbum::findOrFail($albumId);

        if ($album) {
            $this->albumIdToUpdate = $album->id;
            $this->albumName = $album->album_name; // Updated property name
            $this->albumDescription = $album->description; // Updated property name
            // You may also want to update $this->album_cover if you want to edit the album cover.
        }
    }
    public function updateAlbum()
    {
        $this->resetErrorBag();
        $this->validate([
            'albumName' => ['required'],
            'albumDescription' => ['required'],
        ]);

        $album = GalleryAlbum::findOrFail($this->albumIdToUpdate);
        $album->update([
            'album_name' => $this->albumName,
            'description' => $this->albumDescription,
        ]);

        $this->updateAlbums();
        $this->cancelEdit();
        session()->flash('success', 'Album successfully updated.');
    }
    public function cancelEdit()
    {
        $this->courseIdToUpdate = null;
        $this->courseName = null;
        $this->courseDescription = null;
    }
    public function toggleShowAlbums()
    {
        $this->showAlbums = !$this->showAlbums;
        $this->cancelEdit();
    }
    public function updateAlbums()
    {
        // Fetch the updated list of courses
        $this->galleryAlbum = GalleryAlbum::all();
    }
    public function deleteConfirmation($albumId)
    {
        $this->album_id = $albumId;
        $this->dispatchBrowserEvent('show-album-delete-confirmation');
    }
    public function deleteCourse()
    {
        $albumId = $this->album_id;
        $this->resetErrorBag();
        // Find the course by ID
        $album = GalleryAlbum::findOrFail($albumId);


        if ($album) {
            // Delete the course
            $album->delete();
            $this->dispatchBrowserEvent('album-deleted');
        } else {
            $this->dispatchBrowserEvent('album-error');
        }
        // Refresh the courses list after deletion
        $this->albums = GalleryAlbum::all();
    }

    public function resetAlbumForm()
    {
        $this->reset(['album_name', 'album_cover', 'description']);
    }

    public function addAlbum()
{
    $this->resetErrorBag();
    $this->validate([
        'album_name' => ['required'],
        'description' => ['required', 'max:255'],
        'album_cover' => ['required', 'image', 'max:5000']
    ]);

    // Generate a unique name for the new album cover
    $album_cover_name = Str::uuid() . '.' . $this->album_cover->getClientOriginalExtension();

    // Store the new album cover
    $imgData = Image::make($this->album_cover)->encode('jpg');
    $upload_album_cover = Storage::put('public/album-covers/' . $album_cover_name, $imgData);

    // Create a new album record in the database
    GalleryAlbum::create([
        'album_name' => $this->album_name,
        'description' => $this->description,
        'album_cover' => $album_cover_name,
    ]);

    // Reset form fields and show success message
    $this->resetGalleryForm();
    toastr()->success('', 'Album added successfully!', [
        "showEasing" => "swing",
        "hideEasing" => "swing",
        "showMethod" => "slideDown",
        "hideMethod" => "slideUp"
    ]);

    // Emit events if necessary
    $this->dispatchBrowserEvent('gallery-success');
    $this->emit('galleryAdded');
}


    
    public function render()
    {
        return view('livewire.add-gallery-form');
    }
}
