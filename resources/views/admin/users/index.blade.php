@extends('admin.layouts.app')

@section('content')

{{-- Naye design ke liye custom CSS jo Dark/Light mode ke sath kaam karegi --}}
<style>
    /* === THEME VARIABLES (from your layout) === */
    :root {
        --bg-dark: #161928;
        --card-dark: #20243c;
        --text-primary-dark: #ffffff;
        --text-secondary-dark: #a0aec0;
        --border-color-dark: rgba(255, 255, 255, 0.1);
        --gradient-pink: linear-gradient(90deg, #b13ff7, #ff00c3);
        --accent-blue: #5469D4;

        /* Light Theme variables for form consistency */
        --light-bg: #f4f7fe; /* Your layout's light-page-bg */
        --light-card-bg: #ffffff;
        --light-text: #2c3e50;
        --light-border-color: #e0e6ed;
    }

    /* Override based on active theme */
    html[data-theme='light'] {
        --current-bg: var(--light-bg);
        --current-card-bg: var(--light-card-bg);
        --current-text-primary: var(--light-text);
        --current-text-secondary: #7f8c8d;
        --current-border-color: var(--light-border-color);
    }
    html[data-theme='dark'] {
        --current-bg: var(--bg-dark);
        --current-card-bg: var(--card-dark);
        --current-text-primary: var(--text-primary-dark);
        --current-text-secondary: var(--text-secondary-dark);
        --current-border-color: var(--border-color-dark);
    }
    
    .users-container {
        background-color: var(--current-card-bg);
        border: 1px solid var(--current-border-color);
        border-radius: 16px;
        padding: 25px;
        position: relative;
        overflow: hidden;
    }
    .users-container::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 4px;
        background: var(--gradient-pink);
        filter: blur(8px);
    }
    
    .table-header {
        display: flex; flex-wrap: wrap; justify-content: space-between;
        align-items: center; gap: 1rem; margin-bottom: 1.5rem;
    }
    .table-header h1 {
        font-weight: 600; font-size: 1.8rem;
        color: var(--current-text-primary); margin: 0;
    }
    
    .search-form .form-control {
        background-color: var(--current-bg) !important; color: var(--current-text-primary) !important;
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

    .table {
        color: var(--current-text-primary); border-color: var(--current-border-color);
        margin-bottom: 0;
    }
    .table thead th {
        border: 0; text-transform: uppercase; font-size: 0.8rem;
        color: var(--current-text-secondary); padding-top: 0; padding-bottom: 1rem;
    }
    .table tbody tr {
        border-bottom: 1px solid var(--current-border-color);
        transition: background-color 0.2s ease;
    }
    .table tbody tr:last-child { border-bottom: 0; }
    .table td, .table th { border-top: none; }

    .user-info { display: flex; align-items: center; gap: 1rem; }
    .user-avatar {
        width: 40px; height: 40px; border-radius: 50%;
        background-color: var(--accent-blue); color: #fff; display: flex; align-items: center;
        justify-content: center; font-weight: 600; text-transform: uppercase;
    }
    .user-avatar.avatar-banned { background-color: #e74a3b; }

    .status-badge {
        padding: 0.35em 0.65em; font-size: .75em; font-weight: 700;
        border-radius: 0.375rem;
    }
    .status-active { background-color: rgba(28, 200, 138, 0.2); color: #1cc88a; }
    .status-banned { background-color: rgba(231, 74, 59, 0.2); color: #e74a3b; }
    
    .action-buttons .btn {
        border-radius: 50%; width: 35px; height: 35px;
        display: inline-flex; align-items: center; justify-content: center;
        padding: 0;
    }
    
    /* ... Baqi CSS pehle jaisa hi hai ... */

</style>

<div class="users-container">

    <div class="table-header">
        <h1>User Management</h1>
        <form action="{{ route('admin.users.index') }}" method="GET" class="search-form d-flex gap-2">
            <input type="text" name="search" class="form-control" placeholder="Search by name or email..." value="{{ request('search') }}">
            <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
        </form>
    </div>
    
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table align-middle">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Status</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                <tr>
                    <td>
                        <div class="user-info">
                            {{-- YAHAN CHANGE KIYA GAYA HAI --}}
                            <div class="user-avatar {{ $user->is_banned ? 'avatar-banned' : '' }}">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                            <div>
                                <div class="fw-bold">{{ $user->name }}</div>
                                <div class="text-muted" style="color: var(--current-text-secondary) !important;">{{ $user->email }}</div>
                            </div>
                        </div>
                    </td>
                    <td>
                        {{-- YAHAN CHANGE KIYA GAYA HAI --}}
                        @if ($user->is_banned)
                            <span class="status-badge status-banned">Banned</span>
                        @else
                            <span class="status-badge status-active">Active</span>
                        @endif
                    </td>
                    
                    {{-- === YAHAN POORA ACTIONS WALA HISSA UPDATE KIYA GAYA HAI === --}}
                    <td class="text-end action-buttons">
                        <form action="{{ route('admin.users.toggle-ban', $user) }}" method="POST" class="d-inline">
                            @csrf
                            @if ($user->is_banned)
                                {{-- Agar user banned hai, to UNBAN ka button dikhayein --}}
                                <button type="submit" class="btn btn-outline-success btn-sm" title="Unban User">
                                    <i class="fas fa-check-circle"></i>
                                </button>
                            @else
                                {{-- Agar user active hai, to BAN ka button dikhayein --}}
                                <button type="submit" class="btn btn-outline-danger btn-sm" title="Ban User">
                                    <i class="fas fa-user-slash"></i>
                                </button>
                            @endif
                        </form>
                        
                        <button type="button" class="btn btn-outline-danger btn-sm delete-btn" 
                                data-bs-toggle="modal" 
                                data-bs-target="#deleteUserModal"
                                data-action="{{ route('admin.users.destroy', $user) }}"
                                title="Delete User">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </td>
                    {{-- === END UPDATE === --}}
                </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center py-4 text-muted">No users found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <div class="d-flex justify-content-end mt-4">
        {{ $users->appends(request()->query())->links() }}
    </div>
</div>

{{-- === DELETE CONFIRMATION MODAL === --}}
<div class="modal fade" id="deleteUserModal" tabindex="-1" aria-labelledby="deleteUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: var(--card-color); color: var(--text-color);">
            <div class="modal-header" style="border-bottom-color: var(--border-color);">
                <h5 class="modal-title" id="deleteUserModalLabel">Confirm Deletion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to permanently delete this user? This action cannot be undone.
            </div>
            <div class="modal-footer" style="border-top-color: var(--border-color);">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                
                {{-- Form for deletion --}}
                <form id="deleteUserForm" method="POST" action="">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Yes, Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const deleteUserModal = document.getElementById('deleteUserModal');
    
    // Jab modal khulne wala ho, to yeh event trigger hota hai
    deleteUserModal.addEventListener('show.bs.modal', function (event) {
        
        // Button dhoondein jisne modal ko khola
        const button = event.relatedTarget;
        
        // Button ke 'data-action' attribute se URL hasil karein
        const actionUrl = button.getAttribute('data-action');
        
        // Modal ke andar wala form dhoondein
        const deleteForm = deleteUserModal.querySelector('#deleteUserForm');
        
        // Form ka 'action' us URL par set kar dein
        deleteForm.setAttribute('action', actionUrl);
    });
});
</script>

@endsection