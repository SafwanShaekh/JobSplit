<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    // To get the other user in the conversation
    public function getReceiver()
    {
        if ($this->sender_id === auth()->id()) {
            return User::find($this->receiver_id);
        } else {
            return User::find($this->sender_id);
        }
    }

    public function unreadMessagesCount()
    {
        // This will count messages in this conversation
        // that are not read AND were not sent by the logged-in user.
        return $this->messages()
                    ->where('is_read', false)
                    ->where('user_id', '!=', auth()->id())
                    ->count();
    }
}