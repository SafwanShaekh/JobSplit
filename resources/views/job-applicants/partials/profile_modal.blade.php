<div id="profileModal-{{ $application->id }}" class="modal">
    <div class="modal_item profile-modal-card">

        <div class="profile-modal-header">
            {{-- Profile Picture --}}
            @if ($application->user->profile_picture)
                <img src="{{ asset('storage/' . $application->user->profile_picture) }}" alt="{{ $application->user->name }}" class="profile-avatar">
            @else
                <img src="https://ui-avatars.com/api/?name={{ urlencode($application->user->name) }}&background=04b2b2&color=fff&size=100" alt="{{ $application->user->name }}" class="profile-avatar">
            @endif

            <h3 class="profile-name">{{ $application->user->name }}</h3>
            <div class="flex items-center justify-center gap-2 mt-4">
                @if ($application->user->rating_count > 0)
                    {{-- Agar 1 ya us se zyada rating hai to average dikhayein --}}
                    <div class="stars flex items-center">
                        @for ($i = 1; $i <= 5; $i++)
                            @if ($i <= $application->user->average_rating)
                                {{-- Full Star --}}
                                <svg class="w-5 h-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M12,17.27L18.18,21L16.54,13.97L22,9.24L14.81,8.62L12,2L9.19,8.62L2,9.24L7.45,13.97L5.82,21L12,17.27Z"></path></svg>
                            @elseif ($i - 0.5 <= $application->user->average_rating)
                                {{-- Half Star --}}
                                <svg class="w-5 h-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M12 15.4l-3.76 2.27 1-4.28-3.32-2.88 4.38-.38L12 6.1l1.71 4.04 4.38.38-3.32 2.88 1 4.28L12 15.4zM22 9.24l-7.19-.62L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21 12 17.27 18.18 21l-1.63-7.03L22 9.24zM12 13.4V6.1l1.71 4.04 4.38.38-3.32 2.88 1 4.28L12 15.4z"></path></svg>
                            @else
                                {{-- Empty Star --}}
                                <svg class="w-5 h-5 text-gray-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M12,17.27L18.18,21L16.54,13.97L22,9.24L14.81,8.62L12,2L9.19,8.62L2,9.24L7.45,13.97L5.82,21L12,17.27Z"></path></svg>
                            @endif
                        @endfor
                    </div>
                    <strong class="font-semibold">{{ number_format($application->user->average_rating, 1) }}</strong>
                    <span class="text-secondary">({{ $application->user->rating_count }} ratings)</span>
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
            <p class="profile-email">{{ $application->user->email }}</p>
        </div>

        {{-- START: New Details Section --}}
        <div class="profile-modal-body">
            @if($application->user->bio)
            <div class="profile-detail-item">
                <strong>About:</strong>
                <p>{{ $application->user->bio }}</p>
            </div>
            @endif

            @if($application->user->phone)
            <div class="profile-detail-item">
                <strong>Contact:</strong>
                <p>{{ $application->user->phone }}</p>
            </div>
            @endif

            <div class="profile-detail-item">
                <strong>Member Since:</strong>
                <p>{{ $application->user->created_at->format('M d, Y') }}</p>
            </div>
        </div>
        {{-- END: New Details Section --}}

        <div class="profile-modal-footer">
            <button onclick="closeModal('profileModal-{{ $application->id }}')" class="btn btn-close">Close</button>
        </div>

    </div>
</div>