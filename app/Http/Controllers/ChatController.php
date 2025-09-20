<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\User;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function startConversation(User $user)
    {
        $senderId = auth()->id();
        $receiverId = $user->id;

        // Check if a conversation already exists between the two users
        $conversation = Conversation::where(function ($query) use ($senderId, $receiverId) {
            $query->where('sender_id', $senderId)->where('receiver_id', $receiverId);
        })->orWhere(function ($query) use ($senderId, $receiverId) {
            $query->where('sender_id', $receiverId)->where('receiver_id', $senderId);
        })->first();

        // If no conversation exists, create a new one
        if (!$conversation) {
            $conversation = Conversation::create([
                'sender_id' => $senderId,
                'receiver_id' => $receiverId,
            ]);
        }

        // Redirect to the main chat page with the conversation ID
        return redirect()->route('chat', ['conversation_id' => $conversation->id]);
    }
}