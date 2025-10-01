@extends('admin.layouts.app')

@section('content')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');
    
    :root {
        --font-main: 'Poppins', sans-serif;
        --bg-color: #0A0A10;
        --text-primary: #EAEBFF;
        --text-secondary: #8C92B5;
        --glow-color: #00A2FF;
        --accent-color: #F80087;
        --border-color: rgba(0, 162, 255, 0.2);
        --card-bg: rgba(18, 22, 41, 0.5);
    }

    body {
        background-color: var(--bg-color);
        font-family: var(--font-main);
    }
    
    /* Grid Background (No Changes) */
    .profile-container::before {
        content: ''; position: fixed; inset: 0; z-index: -2;
        background-image: 
            linear-gradient(to right, rgba(0, 162, 255, 0.1) 1px, transparent 1px),
            linear-gradient(to bottom, rgba(0, 162, 255, 0.1) 1px, transparent 1px);
        background-size: 40px 40px;
    }

    /* === LAYOUT FIX: Replaced Flexbox with a more robust CSS Grid === */
    .profile-layout {
        display: grid;
        grid-template-columns: 1fr auto 1fr; /* 3 columns: flexible, auto-sized, flexible */
        gap: 2rem;
        align-items: center;
        width: 100%;
        max-width: 1600px;
        margin: 2rem auto;
        padding: 1rem;
    }
    
    .info-panel {
        background: var(--card-bg);
        backdrop-filter: blur(15px);
        border: 1px solid var(--border-color);
        border-radius: 16px;
        padding: 30px;
        height: 100%;
    }
    
    .neural-core {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        min-width: 250px; /* Prevents avatar from being squished */
    }

    /* === RESPONSIVE FIX === */
    @media (max-width: 1200px) {
        .profile-layout {
            grid-template-columns: 1fr; /* On smaller screens, stack to a single column */
        }
        .neural-core {
            order: -1; /* Make the avatar appear on top on smaller screens */
            margin-bottom: 2rem;
        }
    }
    /* === END FIX === */


    .info-panel h4 {
        color: var(--text-primary); font-weight: 600;
        border-bottom: 1px solid var(--border-color);
        padding-bottom: 1rem; margin-bottom: 1.5rem;
    }

    .avatar-wrapper {
        position: relative; width: 150px; height: 150px;
        margin-bottom: 1.5rem;
    }
    .profile-avatar {
        width: 100%; height: 100%; border-radius: 50%; object-fit: cover;
        box-shadow: 0 0 20px var(--glow-color), 0 0 40px var(--glow-color);
    }
    .ring {
        position: absolute; inset: -15px; border-radius: 50%;
        border: 2px solid transparent; animation: rotate 20s linear infinite;
    }
    .ring-1 { border-top-color: var(--glow-color); border-bottom-color: var(--glow-color); animation-duration: 10s; }
    .ring-2 { border-left-color: var(--accent-color); border-right-color: var(--accent-color); animation-direction: reverse; animation-duration: 15s; inset: -25px; }
    .ring-3 { border: 1px dashed var(--text-secondary); animation-duration: 30s; inset: -40px; }
    @keyframes rotate { from { transform: rotate(0deg); } to { transform: rotate(360deg); } }

    .profile-name { font-size: 1.8rem; font-weight: 700; color: var(--text-primary); text-align: center; }
    .profile-email { font-size: 1rem; color: var(--text-secondary); text-align: center; }

    /* Form Styles (No Changes) */
    .form-group { position: relative; margin-bottom: 1.5rem; }
    .form-label { color: var(--text-secondary); }
    .form-control {
        background: transparent !important; color: var(--text-primary) !important;
        border: none !important; border-bottom: 1px solid var(--border-color) !important;
        border-radius: 0; padding: 0.5rem 0;
    }
    .form-control:focus { box-shadow: none !important; border-bottom-color: var(--glow-color) !important; }
    
    .btn-primary {
        background: transparent; border: 1px solid var(--accent-color);
        color: var(--accent-color); padding: 0.6rem 2rem; font-weight: 600;
        border-radius: 5px; transition: all 0.2s ease;
    }
    .btn-primary:hover {
        background-color: var(--accent-color); color: #fff;
        box-shadow: 0 0 20px var(--accent-color);
    }
</style>


<div class="profile-container">
    <div class="profile-layout">
        
        {{-- Panel: Profile Settings --}}
        <div class="info-panel">
            <h4><i class="fas fa-user-edit fa-fw me-2"></i>Profile Settings</h4>
            @if (session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
            
            <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $admin->name) }}">
                </div>
                <div class="form-group">
                    <label class="form-label">Email Address</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', $admin->email) }}">
                </div>
                <div class="form-group">
                    <label class="form-label">Profile Picture</label>
                    <input type="file" name="avatar" class="form-control">
                </div>
                <div class="d-flex justify-content-end mt-4">
                    <button type="submit" class="btn btn-primary">Update Profile</button>
                </div>
            </form>
        </div>

        {{-- Center: Neural Core (Avatar) --}}
        <div class="neural-core">
            <div class="avatar-wrapper">
                <div class="ring ring-1"></div>
                <div class="ring ring-2"></div>
                <div class="ring ring-3"></div>
                @if($admin->avatar)
                    <img src="{{ Storage::url($admin->avatar) }}" alt="Avatar" class="profile-avatar">
                @else
                    <div class="profile-avatar d-flex align-items-center justify-content-center fs-1 bg-secondary text-white">{{ strtoupper(substr($admin->name, 0, 1)) }}</div>
                @endif
            </div>
            <h1 class="profile-name">{{ $admin->name }}</h1>
            <p class="profile-email">{{ $admin->email }}</p>
        </div>

        {{-- Panel: Change Password --}}
        <div class="info-panel password-panel">
            <h4><i class="fas fa-key fa-fw me-2"></i>Change Password</h4>
            @if (session('password_success')) <div class="alert alert-success">{{ session('password_success') }}</div> @endif
             @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('admin.profile.password') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label class="form-label">Current Password</label>
                    <input type="password" name="current_password" class="form-control" required>
                </div>
                <div class="form-group">
                    <label class="form-label">New Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Confirm New Password</label>
                    <input type="password" name="password_confirmation" class="form-control" required>
                </div>
                <div class="d-flex justify-content-end mt-4">
                    <button type="submit" class="btn btn-primary">Change Password</button>
                </div>
            </form>
        </div>
        
    </div>
</div>

{{-- This script for the 3D tilt effect does not need changes --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    const layout = document.querySelector('.profile-layout');
    if(layout) {
        document.body.addEventListener('mousemove', (e) => {
            if (window.innerWidth > 991) { // Only apply tilt effect on larger screens
                const x = (e.clientX / window.innerWidth - 0.5) * 2;
                const y = (e.clientY / window.innerHeight - 0.5) * 2;
                layout.style.transform = perspective(3000px) rotateX(${-y * 4}deg) rotateY(${x * 4}deg) scale(0.9);
            } else {
                layout.style.transform = 'none'; // Reset transform on mobile
            }
        });
    }
});
</script>

@endsection