<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Jobs extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_title',
        'job_type',
        'description',
        'company',
        'location',
        'salary',
        'link',
        'status',
        'posted_by',
        'updated_by',
    ];


    public function users()
    {
        return $this->belongsToMany(User::class, 'user_jobs', 'job_id', 'user_id');
    }
    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}