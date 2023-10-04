<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class News extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author',
        'category',
        'description',
        'link',
        'posted_by',
        'updated_by',
        'thumbnail',
    ];

    protected function thumbnail(): Attribute
    {
        return Attribute::make(get: function ($value) {
            return $value ? '/storage/news-thumbnail/' . $value : '/images/news.png';
        });
    }
}