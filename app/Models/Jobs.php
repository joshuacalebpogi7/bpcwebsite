<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Jobs extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'job_title',
        'description',
        'company',
        'location',
        'salary',
        'link',
        'status',
        'posted_by',
        'updated_by',
        'image'
    ];

    protected function image(): Attribute
    {
        return Attribute::make(get: function ($value) {
            return $value ? '/storage/jobs-image/' . $value : '/images/bpc_building2.jpg';
        });
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_jobs', 'job_id', 'user_id');
    }
}