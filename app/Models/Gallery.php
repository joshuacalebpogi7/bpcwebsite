<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Gallery extends Model
{
    use HasFactory;
    protected $fillable = [
        'album_name',
        'title',
        'description',
        'album_cover',
        'photo',
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