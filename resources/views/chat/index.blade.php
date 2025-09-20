@extends('layouts.app')

@section('content')

    {{-- Yahan hum apna Livewire component call kar rahe hain --}}
    <livewire:chat />

@endsection

@push('scripts')
<script>
    document.addEventListener('livewire:initialized', () => {
        
        // --- This is the scroll functionality (no changes here) ---
        Livewire.on('scroll-to-bottom', (event) => {
            const messageArea = document.getElementById('message-area');
            if (messageArea) {
                messageArea.scrollTop = messageArea.scrollHeight;
            }
        });

        // =========================================================
        // == NEW & IMPROVED LOCATION BUTTON SCRIPT (EVENT DELEGATION) ==
        // =========================================================
        document.body.addEventListener('click', function(event) {
            // Check if the element that was clicked is our location button
            const locationButton = event.target.closest('#share-location-btn');

            // If it is our button, run the geolocation logic
            if (locationButton) {
                if (!navigator.geolocation) {
                    alert('Geolocation is not supported by your browser.');
                    return;
                }

                navigator.geolocation.getCurrentPosition((position) => {
                    const latitude = position.coords.latitude;
                    const longitude = position.coords.longitude;
                    
                    // Dispatch event to Livewire component
                    Livewire.dispatch('sendLocation', { latitude: latitude, longitude: longitude });

                }, () => {
                    alert('Unable to retrieve your location. Please allow location access.');
                });
            }
        });
        // ===========================================
    });
</script>
@endpush