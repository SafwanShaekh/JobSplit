@extends('admin.layouts.app')

@section('content')

@push('styles')
<style>
    /* Theme variables from your dashboard */
    :root {
        --text-primary: #9f9fa1ff;
        --text-secondary: #b3b1b1ff;
        --accent-gradient: linear-gradient(90deg, #00c3ff, #ff00c3);
        --glass-bg: rgba(18, 20, 36, 0.6);
        --glass-border: rgba(255, 255, 255, 0.1);
        --accent-color: #F80087;
    }
    .reports-container {
        color: var(--text-primary);
        padding-top: 2rem;
    }
    .reports-container h1 {
        color: var(--text-primary);
        font-weight: 700;
    }
    .reports-container .lead {
        color: var(--text-secondary);
        max-width: 600px;
        margin-bottom: 3rem;
    }

    .report-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 2rem;
    }
    
    .report-card {
        background: var(--glass-bg);
        border: 1px solid var(--glass-border);
        border-radius: 20px;
        padding: 2.5rem 2rem;
        text-align: center;
        display: flex;
        flex-direction: column;
        align-items: center;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .report-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.4);
    }
    .report-icon {
        font-size: 3.5rem;
        margin-bottom: 1.5rem;
        background: var(--accent-gradient);
        -webkit-background-clip: text;
        background-clip: text;
        -webkit-text-fill-color: transparent;
        color: transparent;
    }
    .report-title {
        font-size: 1.5rem;
        font-weight: 600;
        color: var(--text-primary);
        margin-bottom: 0.5rem;
    }
    .report-description {
        color: var(--text-secondary);
        flex-grow: 1; 
        margin-bottom: 2rem;
    }
    .download-button {
        display: inline-block;
        width: 100%;
        padding: 0.8rem 1.5rem;
        background: transparent;
        border: 1px solid var(--accent-color);
        color: var(--accent-color);
        font-weight: 600;
        border-radius: 8px;
        text-decoration: none;
        transition: all 0.2s ease;
    }
    .download-button:hover {
        background-color: var(--accent-color);
        color: #fff;
        box-shadow: 0 0 20px var(--accent-color);
    }

    /* === RESPONSIVE FIX FOR ICONS & TEXT === */
    @media (max-width: 768px) {
        .report-icon {
            font-size: 2.5rem; /* Make icon smaller on mobile */
            margin-bottom: 1rem;
        }
        .report-title {
            font-size: 1.2rem; /* Make title smaller on mobile */
        }
        .report-card {
            padding: 2rem 1.5rem; /* Adjust padding on mobile */
        }
    }
    /* === END FIX === */

</style>
@endpush

<div class="container-fluid reports-container">
    <div class="text-center">
        <h1>Platform Summary Reports</h1>
        <p class="lead mx-auto">
            Generate and download detailed CSV reports for key platform metrics. Each report provides a complete snapshot of the selected data.
        </p>
    </div>
    
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="report-grid">
        <div class="report-card">
            <i class="fas fa-users report-icon"></i>
            <h2 class="report-title">User Statistics</h2>
            <p class="report-description">Download a complete list of all registered users, including their names, emails, and status (Active/Banned).</p>
            <a href="{{ route('admin.reports.download', ['type' => 'users']) }}" class="download-button">Download Users Report</a>
        </div>

        <div class="report-card">
            <i class="fas fa-briefcase report-icon"></i>
            <h2 class="report-title">Job Statistics</h2>
            <p class="report-description">Download a report of all jobs posted on the platform, including titles, categories, locations, and pay.</p>
            <a href="{{ route('admin.reports.download', ['type' => 'jobs']) }}" class="download-button">Download Jobs Report</a>
        </div>

        <div class="report-card">
            <i class="fas fa-bell report-icon"></i>
            <h2 class="report-title">Complaints Data</h2>
            <p class="report-description">Download a full history of all user complaints, detailing the subject, message, and current status (Pending/Resolved).</p>
            <a href="{{ route('admin.reports.download', ['type' => 'complaints']) }}" class="download-button">Download Complaints Report</a>
        </div>
    </div>
</div>
@endsection