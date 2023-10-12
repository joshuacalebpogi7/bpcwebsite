<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Gallery extends Model
{
    use HasFactory;
    protected $fillable = [
        'photo',
        'title',
        'description',
        'gallery_album_id',
        'posted_by',
        'updated_by',
    ];
    protected function photo(): Attribute
    {
        return Attribute::make(get: function ($value) {
            return $value ? '/storage/photos/' . $value : '/fallback_noPhoto.jpg';
        });
    }

    public function album()
    {
        return $this->belongsTo(GalleryAlbum::class, 'gallery_album_id');
    }
}