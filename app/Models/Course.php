<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [

        'course',
        'description'
    ];
    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}