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
    
    /* === CARD DESIGN (Same as Users Page) === */
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
    
    /* Job specific text styles */
    .job-title { font-weight: 600; color: var(--current-text-primary); margin-bottom: 2px; }
    .job-company, .job-location { font-size: 0.9rem; color: var(--current-text-secondary); }
    
    .action-buttons .btn { border-radius: 50%; width: 35px; height: 35px; display: inline-flex; align-items: center; justify-content: center; padding: 0; }
    
    .pagination-info {
        color: var(--current-text-secondary);
        font-size: 0.9rem;
    }

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
        <h1>Posted Jobs</h1>
        <form action="{{ route('admin.jobs.index') }}" method="GET" class="search-form d-flex gap-2">
            <input type="text" name="search" class="form-control" placeholder="Search jobs..." value="{{ request('search') }}">
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
                    <th>Job Details</th>
                    <th>Description</th>
                    <th>Category</th>
                    <th>Pay</th>
                    <th>Created</th>
                    <th>Duration</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($jobs as $job)
                <tr>
                    <td>
                        <div class="job-title">{{ $job->title }}</div>
                        <div class="job-company">{{ $job->company ?? 'N/A' }}</div>
                        <div class="job-location">
                            <i class="fas fa-map-marker-alt me-1 text-secondary"></i>{{ $job->location ?? 'N/A' }}
                        </div>
                    </td>
                    <td>{{ Str::limit($job->description, 50) }}</td>
                    <td>{{ $job->category ?? 'N/A' }}</td>
                    <td>{{ $job->pay ?? 'N/A' }}</td>
                    <td>{{ $job->created_at->format('d M Y') }}</td>
                    <td>{{ $job->duration ?? 'N/A' }}</td>
                    <td class="text-end action-buttons">
                        <a href="{{ route('admin.jobs.show', $job) }}" class="btn btn-outline-info btn-sm" title="View Job"><i class="fas fa-eye"></i></a>
                        <a href="{{ route('admin.jobs.edit', $job) }}" class="btn btn-outline-primary btn-sm" title="Edit Job"><i class="fas fa-pencil-alt"></i></a>
                        
                        <button type="button" class="btn btn-outline-danger btn-sm delete-btn" 
                                data-bs-toggle="modal" 
                                data-bs-target="#deleteJobModal"
                                data-action="{{ route('admin.jobs.destroy', $job) }}"
                                title="Delete Job">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </td>
                </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-4 text-muted">No jobs found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <div class="d-flex justify-content-between align-items-center mt-4">
        <div class="pagination-info">
            Showing {{ $jobs->firstItem() }} to {{ $jobs->lastItem() }} of {{ $jobs->total() }} entries
        </div>
        <div>
            {{ $jobs->links() }}
        </div>
    </div>
</div>

{{-- Delete Confirmation Modal --}}
<div class="modal fade" id="deleteJobModal" tabindex="-1" aria-labelledby="deleteJobModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteJobModalLabel">Confirm Deletion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this job? This action cannot be undone.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form id="deleteJobForm" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Yes, Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- JavaScript for Modal --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    const deleteJobModal = document.getElementById('deleteJobModal');
    if(deleteJobModal) {
        deleteJobModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const actionUrl = button.getAttribute('data-action');
            const deleteForm = document.getElementById('deleteJobForm');
            deleteForm.setAttribute('action', actionUrl);
        });
    }
});
</script>

@endsection