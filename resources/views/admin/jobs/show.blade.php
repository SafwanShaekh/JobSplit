@extends('admin.layouts.app')

@section('content')

{{-- Naye design ke liye custom CSS jo Dark/Light mode ke sath kaam karegi --}}
<style>
    :root {
        /* In variables ko aapki app.blade.php se liya gaya hai */
        --primary-color: #4e73df;
        --card-color: var(--current-card-bg, #fff);
        --text-color: var(--current-text-primary, #2c3e50);
        --text-muted-color: var(--current-text-secondary, #7f8c8d);
        --border-color: var(--current-border-color, #e0e6ed);
        --background-color: var(--current-bg, #f4f7fe);
    }
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
    }
    .page-header h1 {
        font-weight: 600;
        font-size: 1.8rem;
        color: var(--text-color);
    }
    
    /* Job ki maloomat ke liye naya card design */
    .job-details-card {
        background-color: var(--card-color);
        border-radius: 12px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        border: 1px solid var(--border-color);
        overflow: hidden; /* Banner ke design ke liye zaroori */
    }
    
    /* Job ka banner/header */
    .job-banner {
        background: linear-gradient(45deg, #4e73df, #6f42c1);
        padding: 40px 30px;
        color: #fff;
    }
    .job-banner h1 {
        font-weight: 700;
        font-size: 2.2rem;
        margin: 0;
    }
    .job-banner p {
        font-size: 1.2rem;
        opacity: 0.8;
        margin-bottom: 0;
    }
    
    /* Content area */
    .job-content-wrapper {
        padding: 30px;
    }

    /* Section heading */
    .section-title {
        font-weight: 600;
        font-size: 1.4rem;
        color: var(--text-color);
        margin-bottom: 1.5rem;
        padding-bottom: 0.5rem;
        border-bottom: 2px solid var(--primary-color);
        display: inline-block;
    }

    .job-description-text {
        line-height: 1.8;
        font-size: 1rem;
        color: var(--text-color);
    }

    /* === NAYA "PROJECT OVERVIEW" SECTION (WEBSITE KI TARZ PAR) === */
    .job-info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2.5rem;
        padding: 1.5rem;
        background-color: var(--background-color);
        border-radius: 8px;
        border: 1px solid var(--border-color);
    }
    .info-item {
        display: flex;
        align-items: center;
        gap: 1rem;
    }
    .info-item .icon {
        font-size: 1.8rem;
        color: var(--primary-color);
        width: 40px;
        text-align: center;
        flex-shrink: 0;
    }
    .info-item .info-content .label {
        font-size: 0.9rem;
        color: var(--text-muted-color);
        display: block;
        margin-bottom: 2px;
    }
    .info-item .info-content .value {
        font-size: 1rem;
        font-weight: 500;
        color: var(--text-color);
    }

</style>

<div class="container-fluid">
    {{-- Page ka main header buttons ke sath --}}
    <div class="page-header">
        <h1>Job Details</h1>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.jobs.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left me-1"></i> Back to List</a>
            <a href="{{ route('admin.jobs.edit', $job) }}" class="btn btn-primary"><i class="fas fa-pencil-alt me-1"></i> Edit Job</a>
        </div>
    </div>

    {{-- Job ki maloomat ke liye naya card design --}}
    <div class="job-details-card">
        <div class="job-banner">
            <h1>{{ $job->title }}</h1>
            <p>{{ $job->company ?? 'Company Not Available' }}</p>
        </div>

        <div class="job-content-wrapper">
            
            {{-- === WEBSITE KI TARZ PAR NAYA OVERVIEW SECTION === --}}
            <h4 class="section-title">Project Overview</h4>
            <div class="job-info-grid">
                
                <div class="info-item">
                    <div class="icon"><i class="fas fa-calendar-alt"></i></div>
                    <div class="info-content">
                        <span class="label">Date Posted</span>
                        <span class="value">{{ $job->created_at->format('F d, Y') }}</span>
                    </div>
                </div>

                <div class="info-item">
                     <div class="icon"><i class="fas fa-map-marker-alt"></i></div>
                     <div class="info-content">
                        <span class="label">Location</span>
                        <span class="value">{{ $job->location ?? 'Not specified' }}</span>
                    </div>
                </div>

                 <div class="info-item">
                     <div class="icon"><i class="fas fa-clock"></i></div>
                     <div class="info-content">
                        <span class="label">Duration</span>
                        <span class="value">{{ $job->duration ?? 'Not specified' }}</span>
                    </div>
                </div>
                
                <div class="info-item">
                    <div class="icon"><i class="fas fa-money-bill-wave"></i></div>
                    <div class="info-content">
                        <span class="label">Pay</span>
                        <span class="value">Rs. {{ isset($job->pay) ? number_format($job->pay) : 'Not specified' }}</span>
                    </div>
                </div>

                <div class="info-item">
                    <div class="icon"><i class="fas fa-tags"></i></div>
                    <div class="info-content">
                        <span class="label">Category</span>
                        <span class="value">{{ $job->category ?? 'Not specified' }}</span>
                    </div>
                </div>

                 <div class="info-item">
                     <div class="icon"><i class="fas fa-id-card"></i></div>
                     <div class="info-content">
                        <span class="label">Job ID</span>
                        <span class="value">{{ $job->id }}</span>
                    </div>
                </div>
            </div>

            {{-- === JOB DESCRIPTION SECTION === --}}
            <div>
                <h4 class="section-title">Job Description</h4>
                <div class="job-description-text">
                    {!! nl2br(e($job->description)) !!}
                </div>
            </div>

        </div>
    </div>
</div>

@endsection