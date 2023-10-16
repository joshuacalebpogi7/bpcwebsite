<?php

namespace App\Http\Livewire;

use App\Models\Gallery;
use Livewire\Component;
use App\Models\GalleryAlbum;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EditGalleryForm extends Component
{
    use WithFileUploads;

    public $album;
    public $gallery;

    public $stateAlbum = [];
    public $statePhotos = [];


    public $album_name;
    public $description;
    public $album_cover;
    public $title;
    public $selectedAlbum;
    public $photo;
    public $gallery_description;
    public $photos = [];
    public $temporaryPhotos = []; 

    public $index;
    protected $listeners = ['deleteTemporaryPhotos' => 'deleteTemporaryPhotos', 'confirmRemovePhoto' => 'confirmRemove']; //need listeners when emitting livewire

    public function mount($album, $gallery)
    {
        $this->reDisplay();
        $this->stateAlbum = $album->withoutRelations()->toArray();
        $this->gallery = Gallery::where('gallery_album_id', $album->id)->get();
        $this->statePhotos = Gallery::where('gallery_album_id', $album->id)->get()->toArray();

    }

    public function reDisplay() {
        
        $this->gallery = Gallery::where('gallery_album_id', $this->album->id)->get();
        $this->statePhotos = Gallery::where('gallery_album_id', $this->album->id)->get()->toArray();

    }
    public function removePhotoConfirmation($index) {
        $this->index = $index;
        $this->dispatchBrowserEvent('confirm-remove-photo');
    }
    public function confirmRemove(){

        $this->removePhoto($this->index);
    }
    public function removePhoto($index) {

        if (isset($this->temporaryPhotos[$index])) {
            $photo = $this->temporaryPhotos[$index]['photo'];

            $photoPath = public_path('storage/photos/' . $photo);
            
            if (file_exists($photoPath)) {
                unlink($photoPath); // Delete the file
            }
            // Removing a new temporary photo
            unset($this->temporaryPhotos[$index]);
            // Reindex the temporary photos array to remove gaps
            $this->temporaryPhotos = array_values($this->temporaryPhotos);
        }
        elseif (isset($this->gallery[$index])) {
            $photo = $this->gallery[$index];
            $photoPath = public_path('storage/photos/' . basename($photo->photo));
            if ($photo->exists) {

                if (file_exists($photoPath)) { 
                    if(basename($this->album->album_cover) == basename($photo->photo)){

                        if (file_exists(public_path($this->album->album_cover))) {
                            Storage::delete(str_replace("/storage/", "public/", $this->album->album_cover));
                            Storage::delete(str_replace("/storage/", "public/", basename($photo->photo)));
                            $photo->delete();

                            $gallery = Gallery::where('gallery_album_id', $this->album->id)->get();

                            if ($gallery->count() > 0) {
                                $newCover = $gallery[0]->photo;
                                if (file_exists(public_path($newCover))){
                                
                                $sourcePath = public_path('storage/photos/' . basename($newCover));
                                $destinationPath = public_path('storage/album_covers/' . basename($newCover));

                                copy($sourcePath, $destinationPath);

                                $this->album->update([
                                    'album_cover' => basename($newCover),
                                ]);
                                toastr()->warning('Album cover was changed automatically', 'Success!');
                            }
                            } else {
                                // Set the album cover to null if there are no more photos
                                $this->album->update([
                                    'album_cover' => null,
                                ]);
                                toastr()->warning('Default cover has been set', 'Warning!');
                            }
                        }else {
                        toastr()->error('File does not exists', 'Error!');
                        }
                    }
                unlink($photoPath); // Delete the file
                // Remove the photo at the specified index and reindex the collection
                $this->gallery = $this->gallery->except($index)->values();
                }


                unset($this->gallery[$index]);
                $photo->delete();
                toast()->success('Photo removed successfully', 'Success!');
            }
        
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

    public function setAlbumCover($index)
{
    if(isset($this->temporaryPhotos[$index])) {
        // Get the selected photo
        $photo = $this->temporaryPhotos[$index];
        $oldCover = $this->album->album_cover;
        $sourcePath = public_path('storage/photos/' . basename($photo['photo']));
        $destinationPath = public_path('storage/album_covers/' . basename($photo['photo']));

        if ((file_exists($sourcePath) && $this->album->album_cover != '/storage/album_covers/' . $photo['photo']) || $oldCover != '/fallback_noPhoto.jpg') {
            copy($sourcePath, $destinationPath);
            Storage::delete(str_replace("/storage/", "public/", $oldCover));
            $this->album->update(['album_cover' => basename($photo['photo'])]);
            $this->editAlbum();
            toastr()->success('Album cover set successfully!', 'Success!');
        }
    }
    else if (isset($this->gallery[$index])) {
        // Get the selected photo
        $photo = $this->gallery[$index];
        $oldCover = $this->album->album_cover;
        $sourcePath = public_path('storage/photos/' . basename($photo->photo));
        $destinationPath = public_path('storage/album_covers/' . basename($photo->photo));

        if ((file_exists($sourcePath) && $this->album->album_cover != '/storage/album_covers/' . $photo['photo']) || $oldCover != '/fallback_noPhoto.jpg') {
            copy($sourcePath, $destinationPath);
            Storage::delete(str_replace("/storage/", "public/", $oldCover));
            $this->album->update(['album_cover' => basename($photo->photo)]);
            $this->editAlbum();
            // Optionally, you can add a success message here
            toastr()->success('Album cover set successfully!', 'Success!');
        }
    }
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
            'title',
            'selectedAlbum',
            'photo',
            'gallery_description',
        ]);
    }

    public function editAlbum()
    {
        $this->resetErrorBag();

        $this->validate([
            'stateAlbum.album_name' => ['string', 'nullable'],
            'stateAlbum.description' => ['string', 'nullable'],
        ]);

        // Create the Gallery Album
        $this->album->update([
            'album_name' => $this->stateAlbum['album_name'],
            'description' => $this->stateAlbum['description'],
            'updated_by' => Auth::user()->username,
        ]);

        if (isset($this->statePhotos)) {
            foreach ($this->gallery as $index => $photo) {
                $description = $this->statePhotos[$index]['description'];

                // Assuming you have an 'id' attribute in your Gallery model.
                $galleryPhoto = Gallery::find($photo['id']);

                if ($galleryPhoto) {
                    $galleryPhoto->update([
                        'description' => $description,
                    ]);
                }
            }
        }

        // Check if there are temporary photos
        if (!empty($this->temporaryPhotos)) {
            // Create an array to store the IDs of the new photos
            $newPhotoIds = [];

            // Create a new photo record for each temporary photo
            foreach ($this->temporaryPhotos as $index => $tempPhoto) {
                $newPhoto = Gallery::create([
                    'gallery_album_id' => $this->album->id,
                    'photo' => $tempPhoto['photo'], // Store only the filename
                    'description' => $tempPhoto['gallery_description'] ?? null,
                    'posted_by' => Auth::user()->username,
                    'updated_by' => Auth::user()->username,
                ]);

                // Store the ID of the new photo
                $newPhotoIds[] = $newPhoto->id;
            }
            
            // Check if there are existing gallery photos
            if (($this->gallery->count() > 0 && empty($this->album->album_cover))) {
                
                // Set the album cover as the first photo in the existing gallery photos
                $this->album->update([
                    'album_cover' => $this->gallery[0]->photo,
                ]);
            } elseif (empty($this->album->album_cover) && !empty($newPhotoIds)) {
                // Set the album cover as the first photo in the list of new photos
                $this->album->update([
                    'album_cover' => Gallery::find($newPhotoIds[0])->photo,
                ]);
            }

            toastr()->success('Photos added successfully!', 'Success!');

            // Clear temporary photos
            $this->temporaryPhotos = [];
        }

        // Reset the form
        $this->resetAlbumForm();
        $this->reDisplay();
        toastr()->success('Album edited successfully!', 'Success!');
    }

    public function resetAlbumForm()
    {
        $this->deleteTemporaryPhotos();
        $this->resetPhoto();
        $this->reset([
            'album_name',
            'description',
        ]);
    }

    public function resetErrorMessage()
    {
        $this->resetErrorBag();
    }
    public function render()
    {
        return view('livewire.edit-gallery-form');
    }
}
