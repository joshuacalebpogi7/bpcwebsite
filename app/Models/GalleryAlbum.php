<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GalleryAlbum extends Model
{
    use HasFactory;

    protected $fillable = [
        'album_name',
        'description',
        'album_cover',
        'posted_by',
        'updated_by',
    ];

    protected function thumbnail(): Attribute
    {
        return Attribute::make(get: function ($value) {
            return $value ? '/storage/album_cover/' . $value : '/images/prog-pic.jpg';
        });
    }
}
