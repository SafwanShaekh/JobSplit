@extends('layouts.app')

@section('content')
<div class="p-6 mt-10">
    <a href="{{ route('job-applicants.index') }}" class="text-blue-600 hover:underline mb-4 inline-block mt-10">&larr; Back to Jobs</a>
    <h4 class="text-3xl font-bold mt-3">Applicants for: <span class="text-gray-700">{{ $job->title }}</span></h4>

    <div class="mt-6">
        @forelse($applications as $application)
            <div class="bg-white p-6 rounded-lg shadow-md mb-4">
                <div class="applicant-info-header">
                    <div>
                        <strong class="text-lg font-bold">{{ $application->user->name }}</strong>
                        <p class="text-gray-600 mt-2">{{ $application->work_description }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-xl font-bold text-green-600">Bid: RS. {{ number_format($application->bid_amount) }}</p>
                        <span class="text-sm ...">
                            {{ $application->status }}
                        </span>
                    </div>
                </div>
                
                <div class="mt-4 pt-4 border-t text-right">
                    {{-- Agar job open hai to approve ka button dikhayein --}}
                    @if($job->status == 'open')
                        <form action="{{ route('job-applicants.approve', ['job' => $job, 'application' => $application]) }}" method="POST" onsubmit="return confirm('Are you sure you want to approve this applicant? This will reject all others and close the job.');">
                            @csrf
                            <button type="submit" class="button-main">Approve Applicant</button>
                        </form>

                      @elseif($application->status == 'approved')
                    <div class="applicant-actions-container">
                        <span style="font-weight: bold; background-color: #2ecc71; color: white; padding: 10px 15px; border-radius: 5px;">
                            Approved
                        </span>
                    
                        <button onclick="openModal('profileModal-{{ $application->id }}')" class="btn btn-profile">Profile</button>
                    
                        @if($application->feedback_exists)
                            <span class="feedback-submitted-tag">Feedback Submitted</span>
                        @else
                            <button onclick="openModal('feedbackModal-{{ $application->id }}')" class="btn btn-feedback">Feedback</button>
                        @endif
                    
                        <a href="{{ route('chat.with', ['user' => $application->user->id]) }}" class="btn btn-chat">Chat</a>
                    </div>
                    
                        {{-- Include the two separate modal files --}}
                        @include('job-applicants.partials.profile_modal', ['application' => $application])
                        @include('job-applicants.partials.feedback', ['application' => $application])
                    @endif

                    {{-- Agar job close hai aur applicant rejected hai to yahan kuch bhi nahi dikhana --}}
                </div>
            </div>
        @empty
            <p class="p-6 text-center text-gray-500 bg-white rounded-lg shadow-md">No applications received for this job yet.</p>
        @endforelse
    </div>
</div>
@endsection

@push('scripts')
<script>
    function openModal(modalId) {
        // Modal ke background div ko dhoondein
        const modal = document.getElementById(modalId);
        if (modal) {
            // Uske andar .modal_item ko dhoond kar 'open' class lagayein
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

    // Bahar click karne se modal band ho, yeh code abhi kaam nahi karega, 
    // isliye hum isko aasan rakhte hain. Close button se band hoga.
</script> 
@endpush

