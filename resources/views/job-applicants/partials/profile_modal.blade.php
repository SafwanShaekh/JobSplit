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