<!DOCTYPE html>
{{-- HTML tag mein data-theme se hum Dark/Light mode control karenge --}}
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    
    {{-- CSS Links --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" rel="stylesheet">

    {{-- Naye design aur Dark Mode ke liye Custom CSS --}}
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');

        :root {
            --light-bg: #f8f9fc;
            --light-card-bg: #ffffff;
            --light-text: #2c3e50;
            --light-sidebar-bg: #4e73df;
            --light-sidebar-text: rgba(255, 255, 255, 0.8);
            --light-sidebar-text-hover: #ffffff;
            --light-border-color: #e3e6f0;
            --primary-color: #4e73df;

            --dark-bg: #16171c;
            --dark-card-bg: #21232a;
            --dark-text: #e0e0e0;
            --dark-sidebar-bg: #111827; 
            --dark-sidebar-text: #a0aec0;
            --dark-sidebar-text-hover: #ffffff;
            --dark-border-color: #2c2f38;

            --badge-bg-start: #dc3545;
            --badge-bg-end: #ff7f50;
            --badge-text-color: #ffffff;
            --badge-shadow-color: rgba(220, 53, 69, 0.6);
        }

        html[data-theme='light'] {
            --bg-color: var(--light-bg);
            --card-color: var(--light-card-bg);
            --text-color: var(--light-text);
            --sidebar-bg: var(--light-sidebar-bg);
            --sidebar-text: var(--light-sidebar-text);
            --sidebar-text-hover: var(--light-sidebar-text-hover);
            --border-color: var(--light-border-color);
        }

        html[data-theme='dark'] {
            --bg-color: var(--dark-bg);
            --card-color: var(--dark-card-bg);
            --text-color: var(--dark-text);
            --sidebar-bg: var(--dark-sidebar-bg);
            --sidebar-text: var(--dark-sidebar-text);
            --sidebar-text-hover: var(--dark-sidebar-text-hover);
            --border-color: var(--dark-border-color);
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--bg-color);
            color: var(--text-color);
            transition: background-color 0.3s ease, color 0.3s ease;
            overflow-x: hidden;
        }
        
        /* === SIDEBAR TOGGLE MECHANISM === */
        #wrapper {
            display: flex;
            transition: all 0.4s ease;
        }
        #sidebar-wrapper {
            min-width: 250px;
            max-width: 250px;
            transition: margin 0.4s ease;
        }
        #page-content-wrapper {
            flex-grow: 1;
            width: calc(100% - 250px);
            transition: width 0.4s ease;
        }
        #wrapper.toggled #sidebar-wrapper {
            margin-left: -250px;
        }
        #wrapper.toggled #page-content-wrapper {
            width: 100%;
        }
        
        /* Sidebar ki behtar styling */
        .sidebar-heading {
            color: #ffffff !important;
            font-size: 1.2rem;
            font-weight: 700 !important;
            padding: 1rem 1.25rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            text-align: center;
        }
        html[data-theme='dark'] .sidebar-heading {
            color: var(--sidebar-text-hover) !important;
            border-bottom: 1px solid var(--border-color);
        }
        #sidebar-wrapper {
            background-color: var(--sidebar-bg) !important;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        #sidebar-wrapper .list-group-item {
            background-color: transparent !important;
            color: var(--sidebar-text) !important;
            border: 0;
            border-left: 4px solid transparent;
            padding: 1rem 1.25rem;
            font-weight: 500;
            transition: all 0.2s ease;
        }
        #sidebar-wrapper .list-group-item:hover, #sidebar-wrapper .list-group-item.active {
            background-color: rgba(0, 0, 0, 0.1) !important;
            border-left: 4px solid var(--sidebar-text-hover);
            color: var(--sidebar-text-hover) !important;
        }
        
        /* Top Navbar ki styling */
        #page-content-wrapper .navbar {
            background-color: var(--card-color) !important;
            border-bottom: 1px solid var(--border-color) !important;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }
        
        .header-btn {
            background-color: transparent;
            border: 1px solid var(--border-color);
            color: var(--text-color);
            width: 38px; height: 38px; border-radius: 50%;
            display: inline-flex; justify-content: center; align-items: center;
            margin-left: 10px; cursor: pointer; transition: all 0.2s ease;
        }
        .header-btn:hover {
            background-color: var(--primary-color);
            color: #fff;
            border-color: var(--primary-color);
        }
        
        #sidebar-wrapper form {
            padding: 0.75rem 1.25rem;
        }
        #sidebar-wrapper .logout-btn {
            width: 100%;
            background-color: rgba(220, 53, 69, 0.1);
            color: #dc3545;
            border: 1px solid rgba(220, 53, 69, 0.2);
            font-weight: 500;
        }
        #sidebar-wrapper .logout-btn:hover {
            background-color: #dc3545;
            color: #fff;
        }

        /* COMPLAINTS NOTIFICATION BADGE KI STYLING */
        @keyframes pulse-red {
            0%, 100% {
                transform: scale(0.95);
                box-shadow: 0 0 0 0 var(--badge-shadow-color);
            }
            70% {
                transform: scale(1.1);
                box-shadow: 0 0 0 10px rgba(220, 53, 69, 0);
            }
        }
        #complaints-badge {
            background: linear-gradient(45deg, var(--badge-bg-start), var(--badge-bg-end)) !important;
            color: var(--badge-text-color) !important;
            font-weight: 600;
            padding: .35em .65em;
            border-radius: 50rem;
            min-width: 25px;
            text-align: center;
            line-height: 1;
            box-shadow: 0 4px 10px var(--badge-shadow-color);
            animation: pulse-red 2s infinite cubic-bezier(0.66, 0, 0, 1);
        }
    </style>
    @stack('styles')
</head>
<body>
    <div id="wrapper">
        <div id="sidebar-wrapper">
            <div class="sidebar-heading">ADMIN PANEL</div>
            <div class="list-group list-group-flush">
                <a href="{{ route('admin.dashboard') }}" class="list-group-item"><i class="fas fa-tachometer-alt fa-fw me-2"></i>Dashboard</a>
                <a href="{{ route('admin.users.index') }}" class="list-group-item"><i class="fas fa-users fa-fw me-2"></i>Users</a>
                <a href="{{ route('admin.jobs.index') }}" class="list-group-item"><i class="fas fa-briefcase fa-fw me-2"></i>Jobs</a>
                <a href="{{ route('admin.complaints.index') }}" class="list-group-item d-flex justify-content-between align-items-center">
                    <div><i class="fas fa-bell fa-fw me-2"></i>Complaints</div>
                    <span class="badge" id="complaints-badge" style="display: none;">0</span>
                </a>
                <a href="{{ route('admin.profile') }}" class="list-group-item"><i class="fas fa-user-circle fa-fw me-2"></i>Profile</a>
                <a href="{{ route('admin.reports.index') }}" class="list-group-item"><i class="fas fa-file-alt fa-fw me-2"></i>Reports</a>
            </div>
            <div class="mt-auto"> <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-sm logout-btn"><i class="fas fa-sign-out-alt fa-fw me-2"></i>Logout</button>
                </form>
            </div>
        </div>

        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg">
                <div class="container-fluid">
                    <button class="btn btn-sm header-btn" id="menu-toggle" title="Toggle Menu"><i class="fas fa-bars"></i></button>
                    <div class="ms-auto d-flex align-items-center">
                        <button class="header-btn" id="theme-toggle" title="Toggle Theme"><i class="fas fa-moon"></i></button>
                        <button class="header-btn" id="fullscreen-toggle" title="Toggle Fullscreen"><i class="fas fa-expand"></i></button>
                    </div>
                </div>
            </nav>
            <main class="container-fluid p-4">
                @yield('content')
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // URL ko is tarah se define karna sab se behtar hai
        const complaintsCountUrl = '{{ url("admin/complaints/count") }}';
        
        document.addEventListener('DOMContentLoaded', function() {
            // Hamburger menu
            document.getElementById("menu-toggle").addEventListener("click", e => {
                e.preventDefault();
                document.getElementById("wrapper").classList.toggle("toggled");
            });

            // Complaints count fetch karna
            function fetchComplaintsCount() {
                fetch(complaintsCountUrl)
                .then(response => response.ok ? response.json() : Promise.reject('Network response was not ok.'))
                .then(data => {
                    const badge = document.getElementById('complaints-badge');
                    if(badge) {
                        badge.textContent = data.count;
                        badge.style.display = data.count > 0 ? 'inline-block' : 'none';
                    }
                }).catch(error => console.error('Error fetching complaints:', error));
            }
            fetchComplaintsCount();
            setInterval(fetchComplaintsCount, 30000); // Har 30 second baad check karega

            // --- THEME TOGGLE SCRIPT ---
            const themeToggle = document.getElementById('theme-toggle');
            const htmlEl = document.documentElement;
            const currentTheme = localStorage.getItem('theme') || 'light';
            
            function applyTheme(theme) {
                htmlEl.setAttribute('data-theme', theme);
                if (themeToggle) {
                    themeToggle.querySelector('i').className = theme === 'dark' ? 'fas fa-sun' : 'fas fa-moon';
                }
                // Chart ko batane ke liye custom event
                window.dispatchEvent(new Event('themeChanged'));
            }

            applyTheme(currentTheme);

            if (themeToggle) {
                themeToggle.addEventListener('click', () => {
                    const newTheme = htmlEl.getAttribute('data-theme') === 'dark' ? 'light' : 'dark';
                    localStorage.setItem('theme', newTheme);
                    applyTheme(newTheme);
                });
            }
            
            // --- FULLSCREEN TOGGLE SCRIPT ---
            const fullscreenToggle = document.getElementById('fullscreen-toggle');
            if (fullscreenToggle) {
                fullscreenToggle.addEventListener('click', () => {
                    if (!document.fullscreenElement) {
                        document.documentElement.requestFullscreen().catch(err => console.error(`Error attempting to enable full-screen mode: ${err.message} (${err.name})`));
                    } else {
                        document.exitFullscreen();
                    }
                });
                
                document.addEventListener('fullscreenchange', () => {
                    const icon = fullscreenToggle.querySelector('i');
                    icon.className = document.fullscreenElement ? 'fas fa-compress' : 'fas fa-expand';
                });
            }
        });
    </script>
    @stack('scripts')
</body>
</html>