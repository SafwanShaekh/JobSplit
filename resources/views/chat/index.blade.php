@extends('layouts.app')

@section('content')

    {{-- Yahan hum apna Livewire component call kar rahe hain --}}
    <livewire:chat />

@endsection

@push('scripts')
<script>
    document.addEventListener('livewire:initialized', () => {
        
        Livewire.on('scroll-to-bottom', () => {
            const messageArea = document.getElementById('message-area');
            if (messageArea) {
                setTimeout(() => { messageArea.scrollTop = messageArea.scrollHeight; }, 50);
            }
        });

        const handleInteraction = (event) => {
            const conversationButton = event.target.closest('.conversation-button');
            if (conversationButton) {
                // 👇 THE FIX IS RIGHT HERE
                event.preventDefault();
                event.stopPropagation();

                const conversationId = conversationButton.dataset.conversationId;
                const componentRoot = document.getElementById('chat-component-root');
                if (componentRoot) {
                    const component = Livewire.first(componentRoot);
                    component.call('viewConversation', conversationId);
                }
                return;
            }

            const locationButton = event.target.closest('#share-location-btn');
            if (locationButton) {
                // 👇 AND ALSO HERE FOR THE LOCATION BUTTON
                event.preventDefault();
                event.stopPropagation();
                
                if (!navigator.geolocation) {
                    return alert('Geolocation is not supported by your browser.');
                }
                navigator.geolocation.getCurrentPosition(
                    (position) => Livewire.dispatch('sendLocation', { 
                        latitude: position.coords.latitude, 
                        longitude: position.coords.longitude 
                    }),
                    () => alert('Unable to retrieve your location. Please allow location access.')
                );
            }
        };

        const isTouchDevice = 'ontouchstart' in window || navigator.maxTouchPoints > 0;

        if (isTouchDevice) {
            document.body.addEventListener('touchend', handleInteraction);
        } else {
            document.body.addEventListener('click', handleInteraction);
        }
    });
</script>
@endpush