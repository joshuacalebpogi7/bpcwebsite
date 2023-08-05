<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Events extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'event_start',
        'event_end',
        'link',
        'posted_by',
        'updated_by',
        'thumbnail'
    ];
    protected function thumbnail(): Attribute
    {
        return Attribute::make(get: function ($value) {
            return $value ? '/storage/events-thumbnail/' . $value : '/images/bpc_building2.jpg';
        });
    }
}