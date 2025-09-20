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
        overflow: hidden; /* Prevent scrollbars */
    }
    * { cursor: default; }

    /* === DIGITAL VOID & GRID BACKGROUND === */
    .profile-container::before {
        content: ''; position: fixed; inset: 0; z-index: -2;
        background-image: 
            linear-gradient(to right, rgba(0, 162, 255, 0.1) 1px, transparent 1px),
            linear-gradient(to bottom, rgba(0, 162, 255, 0.1) 1px, transparent 1px);
        background-size: 40px 40px;
        animation: panGrid 10s linear infinite;
    }
    @keyframes panGrid {
        from { background-position: 0 0; }
        to { background-position: 40px 40px; }
    }

    /* === FLOATING ISLAND (Main Container) === */
    .floating-island {
        position: relative;
        width: 90%;
        max-width: 1200px;
        margin: 5vh auto;
        padding: 40px;
        background: radial-gradient(circle at 50% 50%, rgba(18,22,41,0.7) 0%, transparent 70%);
        transform-style: preserve-3d;
        transition: transform 0.4s ease-out;
    }

    /* === CENTRAL NEURAL CORE (Avatar) === */
    .neural-core {
        position: relative;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        transform: translateZ(20px);
    }
    .avatar-wrapper {
        position: relative;
        width: 150px;
        height: 150px;
        margin-bottom: 1.5rem;
    }
    .profile-avatar {
        width: 100%; height: 100%;
        border-radius: 50%;
        object-fit: cover;
        box-shadow: 0 0 20px var(--glow-color), 0 0 40px var(--glow-color);
    }
    /* Animated Rings */
    .ring {
        position: absolute;
        inset: -15px;
        border-radius: 50%;
        border: 2px solid transparent;
        animation: rotate 20s linear infinite;
    }
    .ring-1 { border-top-color: var(--glow-color); border-bottom-color: var(--glow-color); animation-duration: 10s; }
    .ring-2 { border-left-color: var(--accent-color); border-right-color: var(--accent-color); animation-direction: reverse; animation-duration: 15s; inset: -25px; }
    .ring-3 { border: 1px dashed var(--text-secondary); animation-duration: 30s; inset: -40px; }
    @keyframes rotate { from { transform: rotate(0deg); } to { transform: rotate(360deg); } }

    .profile-name { font-size: 1.8rem; font-weight: 700; color: var(--text-primary); }
    .profile-email { font-size: 1rem; color: var(--text-secondary); }

    /* === INFORMATION PANELS (Forms) === */
    .info-panel {
        background: var(--card-bg);
        backdrop-filter: blur(15px);
        border: 1px solid var(--border-color);
        border-radius: 16px;
        padding: 30px;
        height: 100%;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .info-panel:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.3);
    }
    .info-panel h4 {
        color: var(--text-primary);
        font-weight: 600;
        border-bottom: 1px solid var(--border-color);
        padding-bottom: 1rem;
        margin-bottom: 1.5rem;
    }

    /* Modern Minimalist Forms */
    .form-group { position: relative; margin-bottom: 1.5rem; }
    .form-control {
        background: transparent !important;
        color: var(--text-primary) !important;
        border: none !important;
        border-bottom: 1px solid var(--border-color) !important;
        border-radius: 0;
        padding: 0.5rem 0;
    }
    .form-control:focus {
        box-shadow: none !important;
        border-bottom-color: var(--glow-color) !important;
    }
    .btn-primary {
        background: transparent;
        border: 1px solid var(--accent-color);
        color: var(--accent-color);
        padding: 0.6rem 2rem;
        font-weight: 600;
        border-radius: 5px;
        transition: all 0.2s ease;
    }
    .btn-primary:hover {
        background-color: var(--accent-color);
        color: #fff;
        box-shadow: 0 0 20px var(--accent-color);
    }

    /* === HUD ELEMENTS === */
    .hud {
        position: fixed;
        color: var(--text-secondary);
        font-family: 'Courier New', Courier, monospace;
        font-size: 0.8rem;
        opacity: 0.7;
        pointer-events: none;
    }
    .hud-top-left { top: 20px; left: 20px; }
    .hud-bottom-right { bottom: 20px; right: 20px; text-align: right; }
</style>


<div class="profile-container">
    <div class="floating-island">
        <div class="row align-items-center">
            {{-- Left Panel: Profile Settings --}}
            <div class="col-lg-5">
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
            </div>

            {{-- Center: Neural Core --}}
            <div class="col-lg-2 text-center">
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
            </div>

            {{-- Right Panel: Change Password --}}
            <div class="col-lg-5">
                <div class="info-panel">
                    <h4><i class="fas fa-key fa-fw me-2"></i>Change Password</h4>
                    @if (session('password_success')) <div class="alert alert-success">{{ session('password_success') }}</div> @endif
                    <form action="{{ route('admin.profile.password') }}" method="POST">
                        @csrf
                        <div class="form-group"><label class="form-label">Current Password</label><input type="password" name="current_password" class="form-control" required></div>
                        <div class="form-group"><label class="form-label">New Password</label><input type="password" name="password" class="form-control" required></div>
                        <div class="form-group"><label class="form-label">Confirm New Password</label><input type="password" name="password_confirmation" class="form-control" required></div>
                        <div class="d-flex justify-content-end mt-4">
                            <button type="submit" class="btn btn-primary">Change Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // --- 3D Tilt Effect for Floating Island --- //
    const island = document.querySelector('.floating-island');
    if(island) {
        document.body.addEventListener('mousemove', (e) => {
            const x = (e.clientX / window.innerWidth - 0.5) * 2;
            const y = (e.clientY / window.innerHeight - 0.5) * 2;
            island.style.transform = `rotateX(${-y * 5}deg) rotateY(${x * 5}deg)`;
        });
    }

    // --- HUD Clock --- //
    const clockEl = document.getElementById('hud-clock');
    function updateClock() {
        if (clockEl) {
            const now = new Date();
            clockEl.textContent = now.toLocaleTimeString('en-US', { hour12: false });
        }
    }
    setInterval(updateClock, 1000);
    updateClock();
});
</script>

@endsection