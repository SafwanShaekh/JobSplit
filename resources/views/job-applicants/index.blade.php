@extends('layouts.app')

@section('content')
<div class="p-6 mt-10">
    <button id="sidebar-toggle-btn" class="lg:hidden flex items-center gap-2 mb-4 ml-6 font-semibold text-gray-600">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="3" y1="12" x2="21" y2="12"></line>
                    <line x1="3" y1="6" x2="21" y2="6"></line>
                    <line x1="3" y1="18" x2="21" y2="18"></line>
                </svg>
                <span>Menu</span>
            </button>
    <h4 class="text-3xl font-bold mt-10">Job Applicants</h4>
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mt-5">
    @forelse($jobs as $job)
        <a href="{{ route('job-applicants.show', $job) }}" class="card-enhanced-accent">
            
            {{-- Extra vertical line animation ke liye --}}
            <span class="accent-line-vertical"></span>

            <div class="card-content">
                <div class="card-header">
                    <img class="logo" src="{{ $job->user->profile_photo_url }}" alt="{{ $job->user->name }} logo">
                    <div class="applicant-count">
                        <p class="count">{{ $job->applications_count }}</p>
                        <p class="label">Applicants</p>
                    </div>
                </div>
                <h3 class="title">{{ $job->title }}</h3>
                <div class="meta">
                    <span><i class="ph ph-map-pin"></i> {{ $job->location }}</span>
                    <span><i class="ph ph-calendar-blank"></i> {{ $job->created_at->format('M d, Y') }}</span>
                </div>
            </div>

            {{-- Yeh naya 'View Details' wala hissa hai --}}
            <div class="view-prompt">
                <span>View Details</span>
                <i class="ph ph-arrow-right"></i>
            </div>
        </a>
    @empty
        <p class="lg:col-span-3 text-center text-gray-500">You have not posted any jobs yet.</p>
    @endforelse
</div>

{{-- Pagination Links --}}
<div class="mt-8">
    {{ $jobs->links() }}
</div>
</div>
@endsection

@push('styles')
<style>
    /* Main Card Container */
    .card-enhanced-accent {
        position: relative;
        /* Naya, behtar dark background */
        background-color: #ffffffff;
        background-image: radial-gradient(circle at 20% 20%, rgba(20, 184, 166, 0.15) 0%, transparent 30%);
        padding: 25px;
        border-radius: 16px;
        text-decoration: none;
        overflow: hidden;
        border: 1px solid rgba(255, 255, 255, 0.1);
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }
    .card-enhanced-accent:hover {
        border-color: rgba(20, 184, 166, 0.5);
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
    }
    .card-enhanced-accent .card-content {
        position: relative;
        z-index: 2;
    }

    /* Horizontal Accent Lines */
    .card-enhanced-accent::before,
    .card-enhanced-accent::after {
        content: '';
        position: absolute;
        height: 2px;
        width: 0;
        background: linear-gradient(90deg, transparent, #14b8a6, transparent);
        transition: width 0.5s ease-out;
    }
    .card-enhanced-accent::before { top: 0; left: 50%; transform: translateX(-50%); }
    .card-enhanced-accent::after { bottom: 0; right: 50%; transform: translateX(50%); }

    .card-enhanced-accent:hover::before,
    .card-enhanced-accent:hover::after {
        width: 100%;
    }

    /* Nayi Vertical Accent Line */
    .accent-line-vertical {
        position: absolute;
        top: 25px;
        left: 25px;
        width: 2px;
        height: 0;
        background: linear-gradient(0deg, transparent, #14b8a6, #34d399);
        transition: height 0.4s ease-out;
        transition-delay: 0.2s; /* Thori der baad shuru ho */
    }
    .card-enhanced-accent:hover .accent-line-vertical {
        height: calc(100% - 50px);
    }

    /* Baqi content ki styling */
    .card-header { display: flex; justify-content: space-between; align-items: flex-start; }
    .card-header .logo { width: 50px; height: 50px; border-radius: 50%; margin-left:12px; object-fit: cover; }
    .applicant-count { text-align: right; color: black; }
    .applicant-count .count { font-size: 1.5rem; font-weight: 700; line-height: 1; }
    .applicant-count .label { font-size: 0.7rem; opacity: 0.7; }

    .title { font-size: 1.2rem; font-weight: 600; color: black; margin-top: 20px; margin-left:10px; line-height: 1.4; }
    .meta { display: flex; flex-direction: column; gap: 8px; font-size: 0.9rem; color: #646c79ff; margin-top: 15px; margin-left:10px; }
    .meta span { display: flex; align-items: center; gap: 8px; }

    /* Naya View Details wala prompt */
    .view-prompt {
        position: absolute;
        bottom: 25px;
        right: 25px;
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 0.875rem;
        font-weight: 500;
        color: #14b8a6;
        opacity: 0;
        transform: translateY(10px);
        transition: all 0.4s ease;
        transition-delay: 0.1s;
    }
    .card-enhanced-accent:hover .view-prompt {
        opacity: 1;
        transform: translateY(0);
    }
</style>
@endpush