@extends('layouts.app')

@section('content')

<div class="dashboard_profile scrollbar_custom w-full bg-surface">
    <div class="container h-fit lg:pt-15 lg:pb-30 max-lg:py-12 max-sm:py-8">
       <button id="sidebar-toggle-btn" class="lg:hidden flex items-center gap-2 mb-4 ml-6 font-semibold text-gray-600">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="3" y1="12" x2="21" y2="12"></line>
                    <line x1="3" y1="6" x2="21" y2="6"></line>
                    <line x1="3" y1="18" x2="21" y2="18"></line>
                </svg>
                <span>Menu</span>
            </button>
        <div class="heading flex flex-wrap items-center justify-between gap-4">
            <h4 class="heading4 max-lg:mt-3">My Profile</h4>
            {{-- Note: You will need to create a route for 'profile.edit' later --}}
            <a href="{{ route('profile.edit')}}" class="button-main">Edit Profile</a>
        </div>

     {{-- Naya Floating Glass Card Layout --}}
<div class="profile-page-container mt-5">

    {{-- 1. Profile Header Card --}}
    <div class="glass-card profile-header-card">
        <img src="{{ Auth::user()->profile_photo_url }}" alt="Profile Photo" class="profile-avatar">
        <div class="header-text">
            <h4 class="profile-name">{{ $user->name }}</h4>
            <p class="profile-email">{{ $user->email }}</p>
            <div class="sidebar-ratings">
                @if ($user->rating_count > 0)
                    <div class="stars">
                        @for ($i = 1; $i <= 5; $i++)
                            @if ($i <= $user->average_rating) <i class="ph-fill ph-star"></i>
                            @elseif ($i - 0.5 <= $user->average_rating) <i class="ph-fill ph-star-half"></i>
                            @else <i class="ph ph-star"></i>
                            @endif
                        @endfor
                    </div>
                    <div class="rating-text">
                        <strong>{{ number_format($user->average_rating, 1) }}</strong>
                        <span>({{ $user->rating_count }} ratings)</span>
                    </div>
                @else
                    <div class="stars">
                        @for ($i = 1; $i <= 5; $i++) <i class="ph ph-star"></i> @endfor
                    </div>
                    <div class="rating-text">(0 ratings)</div>
                @endif
            </div>
        </div>
    </div>

    {{-- 2. Bio Card --}}
    <div class="glass-card">
        <h5 class="card-title">About Me</h5>
        <p class="bio-text">{{ $user->bio ?? 'No bio has been added yet.' }}</p>
    </div>

    {{-- 3. Info Overview Cards (Grid) --}}
    <div class="info-grid-glass">
        <div class="glass-card info-item">
            <i class="ph ph-map-pin"></i>
            <div>
                <span>Address</span>
                <strong>{{ $user->address ?? 'Not available' }}</strong>
            </div>
        </div>
        <div class="glass-card info-item">
            <i class="ph ph-calendar"></i>
            <div>
                <span>Member Since</span>
                <strong>{{ $user->created_at->format('M d, Y') }}</strong>
            </div>
        </div>
        <div class="glass-card info-item">
            <i class="ph ph-phone"></i>
            <div>
                <span>Phone</span>
                <strong>{{ $user->phone ?? 'Not available' }}</strong>
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

@push('styles')
<style>
    /* Page ka naya background */
    .dashboard_profile.bg-surface {
        background-color: #f0f2f5;
        background-image: radial-gradient(circle at top left, #e0e6f7, transparent 50%), 
                          radial-gradient(circle at bottom right, #f7e0e0, transparent 50%);
    }

    .profile-page-container {
        display: flex;
        flex-direction: column;
        gap: 24px;
    }

    /* Asal Glass Card ki Styling */
    .glass-card {
        background: rgba(255, 255, 255, 0.4);
        backdrop-filter: blur(15px);
        -webkit-backdrop-filter: blur(15px);
        border-radius: 16px;
        border: 1px solid rgba(255, 255, 255, 0.2);
        box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.1);
        padding: 24px;
    }

    /* Profile Header Card */
    .profile-header-card {
        display: flex;
        align-items: center;
        gap: 24px;
    }
    .profile-avatar {
        width: 100px; height: 100px; border-radius: 50%; object-fit: cover;
        border: 3px solid white; flex-shrink: 0;
    }
    .profile-name { font-size: 1.75rem; font-weight: 600; color: #111827; }
    .profile-email { font-size: 1rem; color: #6b7280; }
    .sidebar-ratings { margin-top: 12px; display: flex; align-items: center; gap: 8px; }
    .sidebar-ratings .stars { font-size: 1.1rem; color: #d1d5db; }
    .sidebar-ratings .stars .ph-fill { color: #facc15; }
    .rating-text { font-size: 0.9rem; color: #6b7280; }
    .rating-text strong { color: #111827; }

    /* Bio aur Info Card Titles */
    .card-title {
        font-size: 1.1rem; font-weight: 600; color: #111827;
        margin-bottom: 12px; padding-bottom: 12px;
        border-bottom: 1px solid rgba(0,0,0,0.05);
    }
    .bio-text { color: #6b7280; }

    /* Info Grid */
    .info-grid-glass { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 24px; }
    .info-item { display: flex; align-items: center; gap: 16px; }
    .info-item i { font-size: 1.75rem; color: #14b8a6; }
    .info-item span { font-size: 0.875rem; color: #6b7280; }
    .info-item strong { font-size: 1rem; color: #111827; font-weight: 500; }

    /* --- DARK MODE STYLES --- */
    body.dark-mode .dashboard_profile.bg-surface {
        background-color: #0d1117;
        background-image: radial-gradient(circle at top left, rgba(20, 184, 166, 0.1), transparent 40%), 
                          radial-gradient(circle at bottom right, rgba(84, 105, 212, 0.1), transparent 40%);
    }
    body.dark-mode .glass-card {
        background: rgba(22, 27, 39, 0.5);
        border-color: rgba(255, 255, 255, 0.1);
        box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.2);
    }
    body.dark-mode .profile-avatar { border-color: #e5e7eb; }
    body.dark-mode .profile-name,
    body.dark-mode .rating-text strong,
    body.dark-mode .card-title,
    body.dark-mode .info-item strong {
        color: #ffffff;
    }
    body.dark-mode .profile-email,
    body.dark-mode .rating-text,
    body.dark-mode .bio-text,
    body.dark-mode .info-item span {
        color: #9ca3af;
    }
    body.dark-mode .card-title { border-color: rgba(255,255,255,0.1); }
    body.dark-mode .sidebar-ratings .stars { color: #4b5563; }
</style>
@endpush


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