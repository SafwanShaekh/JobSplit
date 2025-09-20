<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'body' => 'encrypted', // <-- This is the magic line!
    ];

    public function conversation()
    {
        return $this->belongsTo(Conversation::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    // in app/Models/Message.php

public function getRenderableBodyAttribute()
{
    // Check if the message body is a Google Maps link
    if (str_starts_with($this->body, 'http://googleusercontent.com/maps.google.com/6')) {
        // If it is, return a full HTML anchor tag
        return '<a href="' . e($this->body) . '" target="_blank" style="color: inherit; text-decoration: underline;">📍 My Current Location</a>';
    }

    // Otherwise, just return the plain text message
    return e($this->body);
}
}