@extends('layouts.app')

@section('content')

<div class="dashboard_profile scrollbar_custom w-full bg-surface">
    <div class="container h-fit lg:pt-15 lg:pb-30 max-lg:py-12 max-sm:py-8">
        <button id="sidebar-toggle-btn" class="lg:hidden flex items-center gap-2 mb-4 ml-6 font-semibold text-gray-600">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>
                    <span>Menu</span>
                </button>
        <div class="heading flex flex-wrap items-center justify-between gap-4">
            <h4 class="heading4 max-lg:mt-3">My Profile</h4>
            {{-- Note: You will need to create a route for 'profile.edit' later --}}
            <a href="{{ route('profile.edit')}}" class="button-main">Edit Profile</a>
        </div>

        <div class="profile_block overflow-hidden flex max-lg:flex-col-reverse gap-y-10 w-full mt-7.5">
            
        <div class="profile_block w-full mt-7.5">
            <div class="rounded-lg bg-white shadow-sm overflow-hidden">
                
                <div class="banner h-48 bg-gray-200">
                    {{-- Aap yahan user ki cover photo bhi laga sakte hain --}}
                    {{-- <img src="..." alt="Cover Photo" class="w-full h-full object-cover"> --}}
                </div>
        
                <div class="p-6">
                    <div class="flex justify-center -mt-24">
                        <img src="{{ auth()->user()->profile_picture ? asset('storage/' . auth()->user()->profile_picture) : asset('assets/images/avatar/default-avatar.png') }}" 
                             alt="Profile Photo"
                             class="w-32 h-32 rounded-full object-cover border-4 border-white shadow-md">
                    </div>
        
                    <div class="text-center mt-4">
                        <h4 class="text-2xl font-bold">{{ $user->name }}</h4>
                        <div class="flex items-center justify-center gap-2 mt-4">
                            @if ($user->rating_count > 0)
                                {{-- Agar 1 ya us se zyada rating hai to average dikhayein --}}
                                <div class="stars flex items-center">
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= $user->average_rating)
                                            {{-- Full Star --}}
                                            <svg class="w-5 h-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M12,17.27L18.18,21L16.54,13.97L22,9.24L14.81,8.62L12,2L9.19,8.62L2,9.24L7.45,13.97L5.82,21L12,17.27Z"></path></svg>
                                        @elseif ($i - 0.5 <= $user->average_rating)
                                            {{-- Half Star --}}
                                            <svg class="w-5 h-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M12 15.4l-3.76 2.27 1-4.28-3.32-2.88 4.38-.38L12 6.1l1.71 4.04 4.38.38-3.32 2.88 1 4.28L12 15.4zM22 9.24l-7.19-.62L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21 12 17.27 18.18 21l-1.63-7.03L22 9.24zM12 13.4V6.1l1.71 4.04 4.38.38-3.32 2.88 1 4.28L12 15.4z"></path></svg>
                                        @else
                                            {{-- Empty Star --}}
                                            <svg class="w-5 h-5 text-gray-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M12,17.27L18.18,21L16.54,13.97L22,9.24L14.81,8.62L12,2L9.19,8.62L2,9.24L7.45,13.97L5.82,21L12,17.27Z"></path></svg>
                                        @endif
                                    @endfor
                                </div>
                                <strong class="font-semibold">{{ number_format($user->average_rating, 1) }}</strong>
                                <span class="text-secondary">({{ $user->rating_count }} ratings)</span>
                            @else
                                {{-- Agar koi rating nahi hai to 5 khaali stars dikhayein --}}
                                <div class="stars flex items-center">
                                    @for ($i = 1; $i <= 5; $i++)
                                        {{-- Empty Star --}}
                                        <svg class="w-5 h-5 text-gray-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M12,17.27L18.18,21L16.54,13.97L22,9.24L14.81,8.62L12,2L9.19,8.62L2,9.24L7.45,13.97L5.82,21L12,17.27Z"></path></svg>
                                    @endfor
                                </div>
                                <span class="text-secondary">(0 ratings)</span>
                            @endif
                        </div>
                        <div class="desc mt-2">
                            <p class="body2 text-secondary px-4">
                                {{ $user->bio ?? 'No bio has been added yet.' }}
                            </p>
                        </div>
                    </div>
        
                    <hr class="my-8">
        
                    <div>
                        <h5 class="heading5 mb-4 px-2">Info Overview</h5>
                        <ul class="space-y-4">
                            <li class="flex items-center justify-between gap-4 py-2 px-2 rounded-md hover:bg-gray-50">
                                <span class="text-secondary font-semibold">Email:</span>
                                <strong class="text-title text-right">{{ $user->email }}</strong>
                            </li>
                            <li class="flex items-center justify-between gap-4 py-2 px-2 rounded-md hover:bg-gray-50">
                                <span class="text-secondary font-semibold">Address:</span>
                                <strong class="text-title text-right">{{ $user->address ?? 'Not available' }}</strong>
                            </li>
                            <li class="flex items-center justify-between gap-4 py-2 px-2 rounded-md hover:bg-gray-50">
                                <span class="text-secondary font-semibold">Member Since:</span>
                                <strong class="text-title text-right">{{ $user->created_at->format('M d, Y') }}</strong>
                            </li>
                        </ul>
                    </div>
                </div>
        
            </div>
        </div>
        
        </div>
         <div class="location_map p-8 mt-7.5 rounded-lg bg-white shadow-sm">
            <h5 class="heading5">Location Map</h5>
            <div id="map" class="mt-4 rounded-lg"></div>
        </div>
    </div>
</div>

@endsection

{{-- ... @endsection should be right above this ... --}}

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const mapElement = document.getElementById('map');
        const savedAddress = "{{ $user->address ?? 'Karachi, Pakistan' }}";

        // Function to create the map
        function createMap(lat, lon, popupText) {
            // Check if map is already initialized
            if (mapElement && !mapElement._leaflet_id) {
                const map = L.map('map').setView([lat, lon], 15); // Zoomed in a bit more for live location

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                }).addTo(map);

                L.marker([lat, lon]).addTo(map)
                    .bindPopup(popupText).openPopup();
            }
        }

        // Function to show map using a saved address
        function showMapWithAddress() {
            fetch(`https://nominatim.openstreetmap.org/search?q=${encodeURIComponent(savedAddress)}&format=json&limit=1`)
                .then(response => response.json())
                .then(data => {
                    if (data.length > 0) {
                        createMap(data[0].lat, data[0].lon, `<b>Saved Location:</b><br>${savedAddress}`);
                    } else {
                        mapElement.innerHTML = '<p style="text-align:center; padding-top: 20px;">Saved location not found.</p>';
                    }
                });
        }

        // 1. Try to get the user's live location
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                // Success: If user allows location
                function(position) {
                    const lat = position.coords.latitude;
                    const lon = position.coords.longitude;
                    createMap(lat, lon, "<b>Your Current Location</b>");
                },
                // Error: If user denies or location is unavailable
                function(error) {
                    console.warn(`Geolocation error (${error.code}): ${error.message}`);
                    // Fallback to saved address if live location fails
                    showMapWithAddress();
                }
            );
        } else {
            // If browser doesn't support Geolocation, use saved address
            console.log("Geolocation is not supported by this browser.");
            showMapWithAddress();
        }
    });
</script>
@endpush