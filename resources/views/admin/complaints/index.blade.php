@extends('admin.layouts.app')

@section('content')

{{-- Naye design ke liye custom CSS jo Dark/Light mode ke sath kaam karegi --}}
<style>
    /* === THEME VARIABLES (from your layout) === */
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
    
    /* === CARD DESIGN (Same as other pages) === */
    .data-container {
        background-color: var(--current-card-bg);
        border: 1px solid var(--current-border-color);
        border-radius: 16px;
        padding: 25px;
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
    
    /* === TABLE HEADER === */
    .table-header {
        display: flex; flex-wrap: wrap; justify-content: space-between;
        align-items: center; gap: 1rem; margin-bottom: 1.5rem;
    }
    .table-header h1 {
        font-weight: 600; font-size: 1.8rem;
        color: var(--current-text-primary);
        margin: 0;
    }

    /* === SEARCH FORM === */
    .search-form .form-control {
        background-color: var(--current-bg) !important;
        color: var(--current-text-primary) !important;
        border: 1px solid var(--current-border-color) !important;
        min-width: 250px; padding: 0.75rem 1rem; border-radius: 0.5rem;
    }
    .search-form .form-control::placeholder { color: var(--current-text-secondary); }
    .search-form .form-control:focus {
        border-color: var(--accent-blue) !important;
        box-shadow: 0 0 0 0.25rem rgba(84, 105, 212, 0.25);
    }
    .search-form .btn-primary {
        background-color: var(--accent-blue); border-color: var(--accent-blue);
        color: #fff; border-radius: 0.5rem; padding: 0.75rem 1rem;
    }
    .search-form .btn-primary:hover { background-color: #435bb7; border-color: #435bb7; }

    /* === MODERN TABLE STYLING === */
    .table { color: var(--current-text-primary); border-color: var(--current-border-color); margin-bottom: 0; }
    .table thead th { border: 0; text-transform: uppercase; font-size: 0.8rem; color: var(--current-text-secondary); padding-top: 0; padding-bottom: 1rem; }
    .table tbody tr { border-bottom: 1px solid var(--current-border-color); transition: background-color 0.2s ease; }
    .table tbody tr:last-child { border-bottom: 0; }
    html[data-theme='dark'] .table tbody tr:hover { background-color: rgba(255, 255, 255, 0.03); }
    html[data-theme='light'] .table tbody tr:hover { background-color: rgba(0, 0, 0, 0.03); }
    .table td, .table th { border-top: none; vertical-align: middle; }
    
    .user-info { display: flex; align-items: center; gap: 1rem; }
    .user-avatar { width: 40px; height: 40px; border-radius: 50%; background-color: var(--accent-blue); color: #fff; display: flex; align-items: center; justify-content: center; font-weight: 600; text-transform: uppercase; }
    
    .complaint-message {
        max-width: 400px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        color: var(--current-text-secondary);
    }
    
    /* === STATUS BADGES === */
    .status-badge {
        padding: 0.35em 0.65em; font-size: .75em;
        font-weight: 700; border-radius: 0.375rem; text-transform: capitalize;
    }
    .status-resolved { background-color: rgba(28, 200, 138, 0.2); color: #1cc88a; }
    .status-pending { background-color: rgba(246, 194, 62, 0.2); color: #f6c23e; }

    /* === PAGINATION STYLING === */
    .pagination .page-link { background-color: transparent; border-color: var(--current-border-color); color: var(--current-text-secondary); margin: 0 2px; border-radius: 0.375rem; }
    .pagination .page-link:hover { background-color: var(--accent-blue); color: #fff; border-color: var(--accent-blue); }
    .pagination .page-item.active .page-link { background-color: var(--accent-blue); color: #fff; border-color: var(--accent-blue); }
    .pagination .page-item.disabled .page-link { color: #6c757d; border-color: var(--current-border-color); }

    /* Custom Modal */
    .modal-content { background-color: var(--current-card-bg); color: var(--current-text-primary); border: 1px solid var(--current-border-color); }
    .modal-header, .modal-footer { border-color: var(--current-border-color); }
    .btn-close { filter: brightness(0) invert(1); }
    html[data-theme='light'] .btn-close { filter: none; }
</style>

<div class="data-container">

    <div class="table-header">
        <h1>Complaints Management</h1>
        <form action="{{ route('admin.complaints.index') }}" method="GET" class="search-form d-flex gap-2">
            <input type="text" name="search" class="form-control" placeholder="Search by user or message..." value="{{ request('search') }}">
            <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
        </form>
    </div>
    
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Complaint Message</th>
                    <th>Status</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($complaints as $complaint)
                <tr>
                    <td>
                        <div class="user-info">
                            <div class="user-avatar">
                                {{ strtoupper(substr($complaint->user->name ?? 'N', 0, 1)) }}
                            </div>
                            <div>
                                <div class="fw-bold">{{ $complaint->user->name ?? 'N/A' }}</div>
                                <div class="text-muted">{{ $complaint->user->email ?? 'User deleted' }}</div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="complaint-message" title="{{ $complaint->message }}">
                            {{ $complaint->message }}
                        </div>
                    </td>
                    <td>
                        <span class="status-badge status-{{ $complaint->status }}">{{ $complaint->status }}</span>
                    </td>
                    <td class="text-end">
                        @if ($complaint->status == 'pending')
                            <form action="{{ route('admin.complaints.resolve', $complaint) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm">
                                    <i class="fas fa-check-circle me-1"></i> Mark as Resolved
                                </button>
                            </form>
                        @else
                            <span class="text-muted fst-italic">Resolved</span>
                        @endif
                    </td>
                </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center py-4 text-muted">No complaints found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <div class="d-flex justify-content-end mt-4">
        {{ $complaints->appends(request()->query())->links() }}
    </div>
</div>

@endsection