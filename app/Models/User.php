<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

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
        'phone',
        'password',
        'address',
        'bio',
        'profile_picture',
        'is_banned',
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
            'is_banned' => 'boolean', // Yeh add karna behtar hai
        ];
    }

    // === YEH FUNCTION ADD KIYA GAYA HAI ===
    /**
     * Get all of the complaints for the User.
     */
    public function complaints()
    {
        return $this->hasMany(Complaint::class);
    }
    // === END NEW FUNCTION ===

    // Add this to your User.php model
    // public function conversations()
    // {
    //     return $this->belongsToMany(Conversation::class);
    // }
}