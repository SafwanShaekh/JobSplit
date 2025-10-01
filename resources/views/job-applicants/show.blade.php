@extends('layouts.app')

@section('content')
<div class="p-6 mt-10">
    <a href="{{ route('job-applicants.index') }}" class="text-blue-600 hover:underline mb-4 inline-block mt-10">&larr; Back to Jobs</a>
    <h4 class="text-3xl font-bold mt-3">Applicants for: <span class="text-gray-700">{{ $job->title }}</span></h4>

    <div class="mt-6 space-y-6">
    @forelse($applications as $application)
        <div class="applicant-card">
            
            {{-- Card Header: Profile Picture, Name, Bid --}}
            <div class="card-header">
                <div class="applicant-info">
                    <img src="{{ $application->user->profile_photo_url }}" alt="Profile Photo" class="applicant-avatar">
                    <div>
                        <strong class="applicant-name">{{ $application->user->name }}</strong>
                        <p class="applicant-bid">Bid: RS. {{ number_format($application->bid_amount) }}</p>
                    </div>
                </div>
                <button onclick="openModal('profileModal-{{ $application->id }}')" class="profile-button">View Profile</button>
            </div>

            {{-- Card Body: Description --}}
            <div class="card-body">
                <p>{{ $application->work_description }}</p>
            </div>

            {{-- Card Footer: Status and Action Buttons --}}
            <div class="card-footer">
                <span class="status-badge status-{{ $application->status }}">{{ ucfirst($application->status) }}</span>
                
                <div class="action-buttons">
                    @if ($application->status == 'approved')
                        @if($application->feedback_exists)
                            <span class="action-tag">Feedback Submitted</span>
                        @else
                            <button type="button" 
                                    class="action-btn btn-feedback open-feedback-modal-btn" 
                                    data-modal-id="feedback-viewer-modal-{{ $application->id }}">
                                <i class="ph ph-star"></i> Feedback
                            </button>
                        @endif
                        <a href="{{ route('chat.with', ['user' => $application->user->id]) }}" class="action-btn btn-chat">
                            <i class="ph ph-chats"></i> Chat
                        </a>
                    @else
                        @if ($job->status != 'completed')
                            <form action="{{ route('job-applicants.approve', ['job' => $job, 'application' => $application]) }}" method="POST" onsubmit="return confirm('Are you sure you want to approve this applicant?');">
                                @csrf
                                <button type="submit" class="action-btn btn-approve">
                                    <i class="ph ph-check-circle"></i> Approve
                                </button>
                            </form>
                        @endif
                    @endif
                </div>
            </div>
        </div>

        @include('job-applicants.partials.profile_modal', ['application' => $application])
        @include('job-applicants.partials.feedback', ['application' => $application])

    @empty
        <div class="bg-white p-6 rounded-lg shadow-md text-center text-gray-500">
            No applications received for this job yet.
        </div>
    @endforelse
</div>
</div>
@endsection

@push('scripts')
<script>
    // This is your original script which will now work correctly
    function openModal(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) {
            const modalItem = modal.querySelector('.modal_item');
            if (modalItem) {
                modalItem.classList.add('open');
            }
        }
    }

    function closeModal(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) {
            const modalItem = modal.querySelector('.modal_item');
            if (modalItem) {
                modalItem.classList.remove('open');
            }
        }
    }
</script> 
@endpush

@push('styles')
    <style>
    .applicant-card {
        background-color: #ffffff;
        border-radius: 12px;
        box-shadow: 0 4px 25px rgba(0, 0, 0, 0.07);
        border: 1px solid #e5e7eb;
        transition: all 0.3s ease;
    }
    .applicant-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.1);
        border-color: #14b8a6;
    }

    .card-header, .card-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 16px 24px;
    }
    .card-body { padding: 0 24px 16px 24px; color: #6b7280; }
    .card-footer { border-top: 1px solid #e5e7eb; }

    .applicant-info { display: flex; align-items: center; gap: 16px; }
    .applicant-avatar { width: 50px; height: 50px; border-radius: 50%; object-fit: cover; }
    .applicant-name { font-size: 1.125rem; font-weight: 600; color: #111827; }
    .applicant-bid { font-size: 0.875rem; color: #16a34a; font-weight: 500; }
    .profile-button { color: #14b8a6; font-weight: 500; background: none; border: none; cursor: pointer; }

    .status-badge {
        padding: 0.3em 0.8em; font-size: 0.75rem; font-weight: 600;
        border-radius: 9999px; text-transform: capitalize;
    }
    .status-pending { background-color: #fef3c7; color: #92400e; }
    .status-approved { background-color: #dcfce7; color: #166534; }
    .status-rejected { background-color: #fee2e2; color: #991b1b; }

    .action-buttons { display: flex; gap: 12px; }
    .action-btn {
        display: inline-flex; align-items: center; gap: 6px; padding: 8px 16px;
        border-radius: 8px; font-weight: 500; text-decoration: none;
        border: 1px solid #d1d5db; background-color: #f9fafb; color: #374151;
        cursor: pointer; transition: all 0.2s ease;
    }
    .action-btn:hover { background-color: #f3f4f6; border-color: #9ca3af; }
    .btn-approve { border-color: #10b981; background-color: #10b981; color: white; }
    .btn-approve:hover { background-color: #059669; }
    .action-tag {
        display: inline-block; padding: 8px 16px; border-radius: 8px;
        background-color: #e5e7eb; color: #4b5563; font-weight: 500;
    }

    /* Dark Mode Overrides */
    body.dark-mode .applicant-card {
        background-color: #1f2937;
        border-color: #374151;
    }
    body.dark-mode .applicant-card:hover { border-color: #14b8a6; }
    body.dark-mode .card-footer { border-top-color: #374151; }
    body.dark-mode .applicant-name { color: #ffffff; }
    body.dark-mode .card-body { color: #9ca3af; }
    body.dark-mode .profile-button { color: #2dd4bf; }
    
    body.dark-mode .status-pending { background-color: rgba(251, 191, 36, 0.2); color: #f59e0b; }
    body.dark-mode .status-approved { background-color: rgba(74, 222, 128, 0.2); color: #4ade80; }
    body.dark-mode .status-rejected { background-color: rgba(248, 113, 113, 0.2); color: #f87171; }

    body.dark-mode .action-btn {
        border-color: #4b5563; background-color: #374151; color: #e5e7eb;
    }
    body.dark-mode .action-btn:hover { background-color: #4b5563; }
    body.dark-mode .btn-approve { border-color: #10b981; background-color: #10b981; color: white; }
    body.dark-mode .btn-approve:hover { background-color: #059669; }
    body.dark-mode .action-tag { background-color: #4b5563; color: #e5e7eb; }
</style>
@endpush