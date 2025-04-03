<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Cache;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
   protected $fillable = [
    'name',
    'email',
    'password',
    'profile_photo',
];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    /**
     * Get the URL for the user's profile photo.
     *
     * @return string
     */
    public function getProfilePhotoUrlAttribute()
    {
        return Cache::remember("user-{$this->id}-profile-photo-url", now()->addHours(12), function () {
            return $this->profile_photo
                ? asset('storage/' . $this->profile_photo)
                : asset('assets/img/profile-img.jpg');
        });
    }

    /**
     * Clear the cached profile photo URL.
     */
    public function clearProfilePhotoCache()
    {
        Cache::forget("user-{$this->id}-profile-photo-url");
    }
}
