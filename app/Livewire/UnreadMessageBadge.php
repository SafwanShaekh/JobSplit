<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Conversation;
use App\Models\Message;
use Livewire\Attributes\On;
use App\Models\User;
use App\livewire\Chat;


class UnreadMessageBadge extends Component
{
    public $count = 0; // Initialize with a default value

    public function render()
    {
        // We calculate the count on every render (triggered by the poll)
        if (auth()->check()) {
            $this->count = auth()->user()->getUnreadMessagesCountAttribute();
        }
        
        return view('livewire.unread-message-badge');
    }
}