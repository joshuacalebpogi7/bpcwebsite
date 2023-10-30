<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use App\Models\Gallery;
use App\Models\GalleryAlbum;

class AddGalleryForm extends Component
{
    use WithFileUploads;

    public $album_name;
    public $album_cover;
    public $title;
    public $photo;
    public $temporaryPhotos = []; 

    protected $listeners = ['deleteTemporaryPhotos' => 'deleteTemporaryPhotos']; //need listeners when emitting livewire

    public function removePhoto($index)
    {
        if (isset($this->temporaryPhotos[$index])) {
            $photoPath = public_path('storage/photos/' . $this->temporaryPhotos[$index]['photo']);
            if (file_exists($photoPath)) {
                unlink($photoPath); // Delete the file
            }
            // Remove the photo at the specified index
            unset($this->temporaryPhotos[$index]);
            // Reindex the array to remove gaps
            $this->temporaryPhotos = array_values($this->temporaryPhotos);
        }
    }


    public function deleteTemporaryPhotos()
    {
        foreach ($this->temporaryPhotos as $tempPhoto) {
            $photoPath = public_path('storage/photos/' . $tempPhoto['photo']);
            if (file_exists($photoPath)) {
                unlink($photoPath); // Delete the file
            }
        }
        // Reset the temporary photos array
        $this->temporaryPhotos = [];
    }


    public function addPhoto()
    {
    
        $this->resetErrorBag();

        // Validate that a file is present and it's an image (you can add more rules)
        $this->validate([
            'photo' => ['required', 'image', 'max:5120'], // Validate file upload
        ]);
        
        // Check if a file has been uploaded
        if ($this->photo) {
            // Save the uploaded photo
            $photoName = time() . '-' . $this->photo->getClientOriginalName();
            $photoPath = $this->photo->storeAs('photos', $photoName, 'public');

            if ($photoPath) {
                $this->temporaryPhotos[] = [
                    'photo' => $photoName,
                ];
                $this->resetAddPhotoFormConfirmation();
            }
        } else {
            // Handle the case where no file was uploaded
            $this->addError('photo', 'Please select a photo to upload.');
        }
    }


    public function deleteAlbumCovers()
    {
            $photoPath = public_path('storage/album_cover/' . $this->galleryAlbum->album_cover);
            if (file_exists($photoPath)) {
                unlink($photoPath); // Delete the file
            }
    }


    public function resetPhoto()
    {
        $this->photo = null;
    }

    public function resetAddPhotoFormConfirmation()
    {
        $this->reset([
            'photo',
        ]);
    }

    public function addAlbum()
    {
        $this->resetErrorBag();
        
        $this->validate([
            'album_name' => ['required'],
        ]);
        
        // Create the Gallery Album
        $galleryAlbum = GalleryAlbum::create([
            'album_name' => $this->album_name,
            'posted_by' => Auth::user()->username,
            'updated_by' => Auth::user()->id,
        ]);
        
        // Retrieve the ID of the newly created Album
        $albumId = $galleryAlbum->id;
        
        $firstPhoto = null; // Initialize a variable to store the first photo
        
        if (!empty($this->temporaryPhotos)) {
            foreach ($this->temporaryPhotos as $index => $tempPhoto) {
                $photos = Gallery::create([
                    'gallery_album_id' => $albumId,
                    'photo' => $tempPhoto['photo'], // Store only the filename
                    'posted_by' => Auth::user()->username,
                    'updated_by' => Auth::user()->id,
                ]);
                
                // Set the first photo as the album cover
                if ($index === 0) {
                    $firstPhoto = $photos;
                }
            }
            
            // If a first photo exists, set it as the album cover
            if ($firstPhoto) {
                $albumName = basename($firstPhoto->photo);

                $sourcePath = public_path('storage/photos/' . $albumName);
                $destinationPath = public_path('storage/album_covers/' . $albumName);
                
                $destinationPath = public_path('storage/album_covers');

                // Check if the destination folder exists, and create it if it doesn't
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0755, true);
                }

                if (file_exists($sourcePath)) {
                    if (copy($sourcePath, $destinationPath . '/' . $albumName)) {
                        // File was successfully copied, update the album cover
                        $galleryAlbum->update([
                            'album_cover' => $albumName, // Set the album cover as the first photo name
                        ]);
                    } else {
                        // Handle the case where copying the file failed
                        return redirect('/admin/gallery')->with('error', 'Failed to set album cover.');
                    }
                } else {
                    // Handle the case where the source file does not exist
                    return redirect('/admin/gallery')->with('error', 'Source file not found.');
                }
        }
            // Clear temporary photos
            $this->temporaryPhotos = [];
        }
        
        // Reset the form
        $this->resetAlbumForm();
        return redirect('/admin/gallery')->with('success', 'Album added successfully!');
        // toastr()->success('Album added successfully!', 'Success!');
    }

    public function resetAlbumForm()
    {
        $this->deleteTemporaryPhotos();
        $this->resetPhoto();
        $this->reset([
            'album_name',
        ]);
    }

    public function resetErrorMessage()
    {
        $this->resetErrorBag();
    }

    public function render()
    {
        return view('livewire.add-gallery-form');
    }
}
