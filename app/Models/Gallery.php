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
        'album_id',
        // 'album_name',
        // 'album_cover',
        'posted_by',
        'updated_by',
    ];

}