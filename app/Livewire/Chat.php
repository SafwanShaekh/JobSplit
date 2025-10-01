<?php

namespace App\Livewire;

use App\Models\Conversation;
use App\Models\Message;
use Livewire\Component;
use Livewire\Attributes\On;

class Chat extends Component
{
    public $conversations;
    public $selectedConversation;
    public $newMessage;
    public $mobileView = 'list';

    public function mount()
    {
        $this->conversations = Conversation::where('sender_id', auth()->id())
                                          ->orWhere('receiver_id', auth()->id())
                                          ->orderBy('updated_at', 'desc')
                                          ->get();
    }

    public function viewConversation($conversationId)
    {
        $this->selectedConversation = Conversation::findOrFail($conversationId);
        
        Message::where('conversation_id', $this->selectedConversation->id)
                ->where('user_id', '!=', auth()->id())
                ->update(['is_read' => true]);

        $this->mobileView = 'chat';
        $this->dispatch('scroll-to-bottom');
    }

    public function showListView()
    {
        $this->mobileView = 'list';
    }
    
    public function sendMessage()
    {
        if (empty($this->newMessage) || !$this->selectedConversation) {
            return;
        }

        Message::create([
            'conversation_id' => $this->selectedConversation->id,
            'user_id' => auth()->id(),
            'body' => $this->newMessage,
        ]);
        
        $this->selectedConversation->touch();
        $this->newMessage = '';
        $this->conversations = Conversation::where('sender_id', auth()->id())
                                          ->orWhere('receiver_id', auth()->id())
                                          ->orderBy('updated_at', 'desc')
                                          ->get();
        $this->dispatch('scroll-to-bottom');
    }

    #[On('sendLocation')]
    public function sendLocation($latitude, $longitude)
    {
        if ($this->selectedConversation) {
            $url = "https://maps.google.com/?q={$latitude},{$longitude}";
            Message::create([
                'conversation_id' => $this->selectedConversation->id,
                'user_id' => auth()->id(),
                'body' => $url,
            ]);
            $this->selectedConversation->touch();
            $this->conversations = Conversation::where('sender_id', auth()->id())
                                              ->orWhere('receiver_id', auth()->id())
                                              ->orderBy('updated_at', 'desc')
                                              ->get();
            $this->dispatch('scroll-to-bottom');
        }
    }

    public function render()
    {
        $messages = [];
        if ($this->selectedConversation) {
            $messages = Message::where('conversation_id', $this->selectedConversation->id)
                ->get()
                ->groupBy(function ($message) {
                    return $message->created_at->format('F j, Y');
                });
        }
        
        return view('livewire.chat', [
            'messages' => $messages
        ]);
    }
}