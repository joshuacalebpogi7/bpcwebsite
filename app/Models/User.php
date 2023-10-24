<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [
        'username',
        'email',
        'user_type',
        'email_verified_at',
        'password',
        'survey_completed',
        'add_info_completed',
        'first_name',
        'middle_name',
        'last_name',
        'birthday',
        'age',
        'civil_status',
        'gender',
        'contact_no',
        'address',
        'postal_code',
        'course',
        'year_graduated',
        'employment_status',
        'job_type',
        'job_position',
        'job_location',
        'monthly_salary',
        'remember_token',
        'avatar',
        'default_password'
    ];




    protected function avatar(): Attribute
    {
        return Attribute::make(get: function ($value) {
            return $value ? '/storage/avatars/' . $value : '/fallback_avatar.png';
        });
    }

    public function jobs()
    {
        return $this->belongsToMany(Jobs::class, 'user_jobs', 'user_id', 'job_id');
    }


    protected $dates = ['email_verified_at', 'birthday'];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}