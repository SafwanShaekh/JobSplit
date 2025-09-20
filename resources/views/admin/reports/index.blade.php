@extends('admin.layouts.app')

@section('content')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap');
    
    /* === THEME VARIABLES === */
    :root {
        /* Light Theme */
        --light-bg: #f4f7fe;
        --light-card-bg: #ffffff;
        --light-text: #2c3e50;
        --light-text-secondary: #7f8c8d;
        --light-border-color: #e0e6ed;

        /* Dark Theme */
        --dark-bg: #161928;
        --dark-card-bg: #20243c;
        --dark-text: #ffffff;
        --dark-text-secondary: #a0aec0;
        --dark-border-color: #2f3349;
        
        /* Accent Colors */
        --gradient-pink: linear-gradient(90deg, #b13ff7, #ff00c3);
        --accent-blue: #5469D4;
    }

    /* === Dynamic Variables based on Theme === */
    html[data-theme='light'] {
        --current-bg: var(--light-bg);
        --current-card-bg: var(--light-card-bg);
        --current-text-primary: var(--light-text);
        --current-text-secondary: var(--light-text-secondary);
        --current-border-color: var(--light-border-color);
    }
    html[data-theme='dark'] {
        --current-bg: var(--dark-bg);
        --current-card-bg: var(--dark-card-bg);
        --current-text-primary: var(--dark-text);
        --current-text-secondary: var(--dark-text-secondary);
        --current-border-color: var(--dark-border-color);
    }
    
    .report-container {
        font-family: 'Poppins', sans-serif;
    }

    /* === Main Card Container (Same as other pages) === */
    .data-container {
        background-color: var(--current-card-bg);
        border: 1px solid var(--current-border-color);
        border-radius: 16px;
        padding: 30px;
        position: relative;
        overflow: hidden;
    }
    .data-container::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 4px;
        background: var(--gradient-pink);
        filter: blur(8px);
    }
    
    .report-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
    }
    .report-header h1 {
        font-weight: 700;
        font-size: 1.8rem;
        color: var(--current-text-primary);
    }
    
    /* Download Button Themed */
    .download-btn {
        background: var(--accent-blue);
        border: none;
        color: #fff;
        padding: 12px 25px;
        border-radius: 50px;
        font-weight: 600;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }
    .download-btn:hover {
        color: #fff;
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(84, 105, 212, 0.3);
    }

    .section-heading {
        font-weight: 600;
        color: var(--current-text-primary);
        margin-bottom: 1.5rem;
        font-size: 1.2rem;
    }
    
    /* Themed Separator */
    .gradient-hr {
        border: 0;
        height: 1px;
        background: linear-gradient(to right, transparent, var(--current-border-color), transparent);
    }

    /* Themed Stat Cards */
    .stat-card {
        background: var(--current-bg); /* Slightly different background to stand out */
        border-radius: 12px;
        padding: 20px;
        border: 1px solid var(--current-border-color);
        box-shadow: none; /* Removed inner shadow for cleaner look */
        display: flex;
        align-items: center;
        gap: 1.5rem;
        transition: transform 0.3s ease;
    }
    .stat-card:hover { transform: translateY(-5px); }
    .stat-card .card-icon {
        width: 50px; height: 50px;
        flex-shrink: 0; border-radius: 12px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.5rem; color: #fff;
    }
    .stat-card h5 {
        color: var(--current-text-secondary);
        font-weight: 600; font-size: 0.9rem; margin: 0;
    }
    .stat-card .stat-number {
        font-size: 2.2rem; font-weight: 700;
        color: var(--current-text-primary);
    }
    
    /* Icon backgrounds */
    .icon-gradient-primary { background: linear-gradient(45deg, #4e73df, #6610f2); }
    .icon-gradient-success { background: linear-gradient(45deg, #1cc88a, #17a673); }
    .icon-gradient-danger { background: linear-gradient(45deg, #e74a3b, #d93025); }
    .icon-gradient-warning { background: linear-gradient(45deg, #f6c23e, #f4b619); }

    /* Entry Animations */
    @keyframes fadeInUp { from { opacity: 0; transform: translateY(30px); } to { opacity: 1; transform: translateY(0); } }
    .fade-in-up { animation: fadeInUp 0.6s ease-out forwards; opacity: 0; }
    .data-container > .row > * { animation-delay: calc(0.1s * var(--animation-order, 0)); }
    .data-container > .report-header { animation-delay: 0s; }
</style>

<div class="report-container">
    <div class="data-container">

        <div class="report-header fade-in-up">
            <h1>Platform Summary Report</h1>
            <a href="{{ route('admin.reports.download') }}" class="btn download-btn"><i class="fas fa-download me-2"></i>Download Report (CSV)</a>
        </div>

        {{-- User Stats --}}
        <div class="row">
            <div class="col-12 fade-in-up" style="--animation-order: 1;"><h4 class="section-heading">User Statistics</h4></div>
            <div class="col-lg-4 col-md-6 mb-4 fade-in-up" style="--animation-order: 2;">
                <div class="stat-card">
                    <div class="card-icon icon-gradient-primary"><i class="fas fa-users"></i></div>
                    <div><h5>Total Users</h5><p class="stat-number">{{ $stats['total_users'] }}</p></div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4 fade-in-up" style="--animation-order: 3;">
                <div class="stat-card">
                    <div class="card-icon icon-gradient-success"><i class="fas fa-user-check"></i></div>
                    <div><h5>Active Users</h5><p class="stat-number">{{ $stats['active_users'] }}</p></div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4 fade-in-up" style="--animation-order: 4;">
                <div class="stat-card">
                    <div class="card-icon icon-gradient-danger"><i class="fas fa-user-slash"></i></div>
                    <div><h5>Banned Users</h5><p class="stat-number">{{ $stats['banned_users'] }}</p></div>
                </div>
            </div>
        </div>

        <hr class="gradient-hr my-4">

        {{-- Job Stats --}}
        <div class="row">
            <div class="col-12 fade-in-up" style="--animation-order: 5;"><h4 class="section-heading">Job Statistics</h4></div>
            <div class="col-lg-4 col-md-6 mb-4 fade-in-up" style="--animation-order: 6;">
                <div class="stat-card">
                    <div class="card-icon icon-gradient-success"><i class="fas fa-briefcase"></i></div>
                    <div><h5>Total Jobs Posted</h5><p class="stat-number">{{ $stats['total_jobs'] }}</p></div>
                </div>
            </div>
        </div>

        <hr class="gradient-hr my-4">

        {{-- Complaint Stats --}}
        <div class="row">
            <div class="col-12 fade-in-up" style="--animation-order: 7;"><h4 class="section-heading">Complaint Statistics</h4></div>
            <div class="col-lg-4 col-md-6 mb-4 fade-in-up" style="--animation-order: 8;">
                <div class="stat-card">
                    <div class="card-icon icon-gradient-primary"><i class="fas fa-comment-dots"></i></div>
                    <div><h5>Total Complaints</h5><p class="stat-number">{{ $stats['total_complaints'] }}</p></div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4 fade-in-up" style="--animation-order: 9;">
                <div class="stat-card">
                    <div class="card-icon icon-gradient-warning"><i class="fas fa-clock"></i></div>
                    <div><h5>Pending Complaints</h5><p class="stat-number">{{ $stats['pending_complaints'] }}</p></div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4 fade-in-up" style="--animation-order: 10;">
                <div class="stat-card">
                    <div class="card-icon icon-gradient-success"><i class="fas fa-check-circle"></i></div>
                    <div><h5>Resolved Complaints</h5><p class="stat-number">{{ $stats['resolved_complaints'] }}</p></div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection