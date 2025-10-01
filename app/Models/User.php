<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Message;

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
        'google_id',
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
    public function conversations()
    {
        return $this->hasMany(Conversation::class, 'sender_id')->orWhere('receiver_id', $this->id);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    // NAYA AUR BEHTAR CODE ✅
    public function getProfilePhotoUrlAttribute()
    {
        // Agar profile_picture NULL hai to default avatar dikhayein
        if (!$this->profile_picture) {
            return 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&background=random';
        }
    
        // Check karein ke kya profile_picture ek poora URL hai (Google se)
        if (str_starts_with($this->profile_picture, 'http')) {
            return $this->profile_picture; // Agar URL hai to usay direct return kar dein
        }
    
        // Warna, yeh local storage se file hai
        return asset('storage/' . $this->profile_picture);
    }
    //  * Get all the feedback received by the user as a worker.
    //  */
    public function feedbackReceived()
    {
        return $this->hasMany(Feedback::class, 'worker_id');
    }
    /**
     * Accessor to get the total number of ratings.
     * Use as: $user->rating_count
     */
    public function getRatingCountAttribute()
    {
        // We use whereNotNull to only count feedback that has a rating.
        return $this->feedbackReceived()->whereNotNull('rating')->count();
    }

    /**
     * Accessor to calculate the average rating.
     * Use as: $user->average_rating
     */
    public function getAverageRatingAttribute()
    {
        // We round the average to one decimal place (e.g., 4.5)
        return round($this->feedbackReceived()->whereNotNull('rating')->avg('rating'), 1);
    }

    //   * Get all of the complaints for the User.
    //  */
    public function complaints()
    {
        return $this->hasMany(Complaint::class);
    }

    public function jobs()
    {
        return $this->hasMany(Job::class);
    }
     public function applications()
    {
        return $this->hasMany(Application::class);
    }

    public function getUnreadMessagesCountAttribute()
    {
        // Get all conversation IDs where this user is a participant
        $conversationIds = $this->conversations()->pluck('id');

        // Count messages in those conversations that are unread and not sent by this user
        return Message::whereIn('conversation_id', $conversationIds)
                      ->where('user_id', '!=', $this->id)
                      ->where('is_read', false)
                      ->count();
    }
}

