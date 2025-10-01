<div id="chat-component-root" class="chat-container view-{{ $mobileView }}" wire:poll.keep-alive.2s>

    <div class="conversation-list">
        <div class="header">
            <button id="sidebar-toggle-btn" class="lg:hidden flex items-center gap-2 mb-4 ml-6 font-semibold text-gray-600">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="3" y1="12" x2="21" y2="12"></line>
                    <line x1="3" y1="6" x2="21" y2="6"></line>
                    <line x1="3" y1="18" x2="21" y2="18"></line>
                </svg>
                <span>Menu</span>
            </button>
            <h2>Message</h2>
        </div>
        <div class="search-container">
            <input type="text" placeholder="Search Users" class="search-box">
            <i class="search-icon">🔍</i> </div>
        <ul class="users-list">
            @forelse($conversations as $conversation)
 {{-- Replace the conversation list item with this --}}

<li wire:key="{{ $conversation->id }}" class="{{ $selectedConversation && $selectedConversation->id == $conversation->id ? 'active' : '' }}">
    
    {{-- We removed wire:click and added a class and a data-attribute --}}
    <button type="button" 
            class="conversation-button w-full flex items-center text-left p-4" 
            data-conversation-id="{{ $conversation->id }}">
        
        <img src="{{ $conversation->getReceiver()->profile_photo_url }}" alt="avatar" class="avatar flex-shrink-0">
        <div class="user-info flex-grow">
            <p class="name">{{ $conversation->getReceiver()->name }}</p>
            <p class="last-message">{{ Str::limit($conversation->messages->last()?->body, 20) }}</p>
        </div>
        <div class="time-details flex-shrink-0">
            <span>{{ $conversation->messages->last()?->created_at->format('h:i A') }}</span>
            @if($conversation->unreadMessagesCount() > 0)
                <span class="unread-dot"></span>
            @endif
        </div>
    </button>
</li>
            @empty
                <li>No conversations found.</li>
            @endforelse
        </ul>
    </div>

    <div class="chat-window">
        @if($selectedConversation)
            <div class="header">
                <span class="back-button" wire:click="showListView">&larr;</span>
                    <img src="{{ $selectedConversation->getReceiver()->profile_photo_url }}" alt="avatar" class="avatar">                <div class="user-info">
                    <p class="name">{{ $selectedConversation->getReceiver()->name }}</p>
                    <p class="location">Karachi, PK</p> </div>
            </div>

            <div class="messages" id="message-area">
                @if($messages)
                    @foreach($messages as $date => $dailyMessages)
                        <div class="date-separator">{{ \Carbon\Carbon::parse($date)->isToday() ? 'Today' : $date }}</div>
                        @foreach($dailyMessages as $message)
                            <div class="message-container {{ $message->user_id == auth()->id() ? 'sent' : 'received' }}">
                                <div class="message-bubble">
                                    @if(Str::startsWith($message->body, 'https://maps.google.com'))
                                        <a href="{{ $message->body }}" target="_blank" style="color: inherit; text-decoration: underline;">
                                            📍 My Current Location
                                        </a>
                                    @else
                                        {{ $message->body }}
                                    @endif
                                </div>
                                <span class="message-time">{{ $message->created_at->format('h:i A') }}</span>
                            </div>
                        @endforeach
                    @endforeach
                @endif
            </div>

            <form wire:submit.prevent="sendMessage" class="message-form">
                <button type="button" id="share-location-btn" title="Share Current Location" style="background: transparent; border: none; margin-right: 10px; cursor: pointer; padding: 0;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#888" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                </button>
                <input wire:model.defer="newMessage" type="text" placeholder="Type your message..." autocomplete="off">
                <button type="submit">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg>
                </button>
            </form>
        @else
            <div class="placeholder">
                <p>Select a conversation to start chatting.</p>
            </div>
        @endif
    </div>
</div>