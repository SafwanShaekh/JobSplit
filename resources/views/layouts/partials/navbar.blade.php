<header id="header" class="header -style-white relative">
    {{-- === FIX: Navbar layout ab 3 columns (left, center, right) ka hai === --}}
    <div class="header_inner absolute flex items-center justify-between top-0 left-0 right-0 z-[1] w-full sm:h-20 h-16 min-[1600px]:px-15 lg:px-9 px-4 border-b border-line">
        
        {{-- Left Column: Logo --}}
        <div class="logo">
            <h1>
                <a href="{{ url('/') }}">
                    <img src="{{ asset('assets/images/JobSplit logo.png ') }}" alt="logo"  />
                </a>
            </h1>
        </div>

    <style>
      
    </style>

        {{-- Center Column: Navigation Links --}}
        <div class="navigator h-full max-lg:hidden">
            <ul class="list flex items-center gap-8 h-full">
                {{-- === NEW: Home link add kar diya gaya hai === --}}
                <li>
                    <a href="{{ route('home') }}" class="flex items-center gap-1 h-full text-title relative duration-300">Home</a>
                </li>
                <li>
                    <a href="{{ route('jobs.browse') }}" class="flex items-center gap-1 h-full text-title relative duration-300">Browse Jobs</a>
                </li>
                <li>
                    <a href="{{ route('about') }}" class="flex items-center gap-1 h-full text-title relative duration-300">About Us</a>
                </li>
                <li>
                    <a href="{{ route('contact_us') }}" class="flex items-center gap-1 h-full text-title relative duration-300">Contact</a>
                </li>
            </ul>
        </div>

        {{-- Right Column: User Actions --}}
        <div class="list_action flex items-center justify-end gap-5">

        {{-- Dark Mode Toggle Switch --}}
<div class="theme-switch-wrapper">
    <label class="theme-switch" for="theme-toggle">
        <input type="checkbox" id="theme-toggle" />
        <div class="slider round"></div>
    </label>
</div>

           @auth
            {{-- === START: AUTHENTICATED USER SECTION === --}}
            <div class="notification_icon relative mt-2">
                
                {{-- Bell Icon (Button) --}}
                <div id="notification-bell" class="relative cursor-pointer p-2">
                    <i class="ph ph-bell text-2xl text-secondary"></i>
                    @if(Auth::user()->unreadNotifications->count() > 0)
                        <span id="notification-badge" class="notification-pulse-badge">
                            {{ Auth::user()->unreadNotifications->count() }}
                        </span>
                    @endif
                </div>

                {{-- Dropdown (Sirf Desktop par dikhega) --}}
                <div class="notification_list dropdown-menu-list lg:flex absolute top-full right-0 mt-2 rounded-lg bg-white shadow-lg flex-col">
                    <div class="p-4 border-b border-line">
                        <h6 class="heading6">Notifications</h6>
                    </div>
                    <div class="flex-grow overflow-y-auto">
                        @forelse(Auth::user()->notifications()->take(3)->get() as $notification)
                            <div class="item p-3 border-b border-line flex items-start gap-3 {{ is_null($notification->read_at) ? 'bg-blue-50' : 'bg-white' }}">
                                @if(is_null($notification->read_at))
                                    <div class="w-2 h-2 bg-blue-500 rounded-full mt-2 flex-shrink-0"></div>
                                @else
                                    <div class="w-2 h-2 flex-shrink-0"></div>
                                @endif
                                <div>
                                    <p class="text-sm text-secondary">{{ $notification->data['message'] }}</p>
                                    <span class="text-xs text-gray-400 mt-1 block">{{ $notification->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        @empty
                            <div class="item p-4 text-center text-secondary">
                                <p>You have no notifications yet.</p>
                            </div>
                        @endforelse
                    </div>
                    <div class="p-2 border-t border-line text-center">
                        <button id="view-all-notifications-btn" class="text-sm text-primary hover:underline">View All Notifications</button>
                    </div>
                </div>
            </div>
    
            <div class="user_block relative max-sm:hidden">
                <button class="user_infor flex items-center gap-2">               
                    <img src="{{ Auth::user()->profile_photo_url }}" 
                         alt="Profile Photo"
                         style="border-radius:50%; object-fit:cover;"  class="user_avatar flex-shrink-0 w-9 h-9">
                     <strong class="user_name text-title">{{ Auth::user()->name }}</strong>
                     <span class="ph ph-caret-down"></span>
                </button>
                <ul class="list_action_user absolute w-[240px] p-3 top-14 right-0 bg-white rounded-lg shadow-lg">
                    <li class="action_item">
                        <a href="{{ route('dashboard')}}" class="link flex items-center gap-3 w-full py-3 px-6 rounded-lg duration-300 hover:bg-background">
                            <span class="ph ph-squares-four text-2xl text-secondary"></span>
                            <strong class="text-title">Dashboard</strong>
                        </a>
                    </li>
                    <li class="action_item">
                        <a href="{{ route('profile.show')}}" class="link flex items-center gap-3 w-full py-3 px-6 rounded-lg duration-300 hover:bg-background">
                            <span class="ph ph-user-circle text-2xl text-secondary"></span>
                            <strong class="text-title">My Profile</strong>
                        </a>
                    </li>
                    <li class="action_item">
                        <form action="{{ route('logout') }}" method="POST">
                           @csrf
                           <button type="submit" class="link flex items-center gap-3 w-full py-3 px-6 rounded-lg duration-300 hover:bg-background text-left">
                                <span class="ph ph-sign-out text-2xl text-secondary"></span>
                                <strong class="text-title">Log Out</strong>
                           </button>
                        </form>
                    </li>
                </ul>
            </div>
            @else
            {{-- Guest user buttons for desktop --}}
            <div class="list_icon flex items-center gap-3 max-lg:hidden">
                <a href="{{ route('login') }}" class="flex items-center gap-1 text-title duration-300 hover:text-primary">
                    <span class="ph-bold ph-user"></span>
                    <span>Login</span>
                </a>
                <a href="{{ route('register') }}" class="button-main -small">
                    <span>Sign up</span>
                </a>
            </div>
            @endauth
            
            <button class="humburger_btn lg:hidden">
                <span class="ph-bold ph-list text-2xl block"></span>
            </button>
        </div>
    </div>
</header>

{{-- Mobile Menu HTML --}}
<div class="menu_mobile">
    <button class="menu_mobile_close">
        <span class="ph-bold ph-x"></span>
    </button>
    <div class="nav_mobile_content">
        <a href="{{ url('/') }}" class="logo">
             <img src="{{ asset('assets/images/JobSplit logo.png') }}" alt="logo" class="mobile-logo" />
        </a>
        <ul class="nav_mobile_list">
            <li><a href="{{ route('home') }}">Home</a></li>
            <li><a href="{{ route('jobs.browse') }}">Browse Jobs</a></li>
            <li><a href="#">About Us</a></li>
            <li><a href="#">Contact</a></li>
            
            <hr class="mobile-menu-divider">

            @auth
                <li class="has-dropdown">
                    <a href="#" class="mobile-dropdown-toggle">
                        <div class="flex items-center gap-2">
                            <img src="{{ Auth::user()->profile_photo_url }}" alt="Profile Photo" class="w-8 h-8 rounded-full object-cover">
                            <span>{{ Auth::user()->name }}</span>
                        </div>
                        <span class="ph ph-caret-down"></span>
                    </a>
                    <div class="mobile-dropdown-content">
                        <a href="{{ route('dashboard') }}" class="mobile-dropdown-link">Dashboard</a>
                        <a href="{{ route('profile.show') }}" class="mobile-dropdown-link">My Profile</a>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="mobile-dropdown-link w-full text-left">Log Out</button>
                        </form>
                    </div>
                </li>
            @else
                <li><a href="{{ route('login') }}">Login</a></li>
                <li><a href="{{ route('register') }}">Register</a></li>
            @endauth
        </ul>
    </div>
</div>


{{-- Nayi modal file ko yahan include karein --}}
@include('layouts.partials.notifications-modal')


{{-- Custom CSS sirf Badge, Pulse, aur Desktop Dropdowns ke liye --}}
<style>
    .notification_list {
        width: 420px;
    }
    .list_action_user, .notification_list {
        display: none;
    }
    .list_action_user.active {
        display: block !important;
    }
    .notification_list.active {
        display: flex !important;
    }

    .notification-pulse-badge {
        position: absolute;
        top: -8.2rem;
        right: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        min-width: 18px;
        height: 18px;
        padding: 0 5px;
        font-size: 10px;
        font-weight: 700;
        color: white;
        background-color: #ef4444;
        border-radius: 9999px;
        border: 2px solid white;
        animation: pulse-animation 2s infinite;
    }

    @keyframes pulse-animation {
        0% { box-shadow: 0 0 0 0 rgba(239, 68, 68, 0.7); }
        70% { box-shadow: 0 0 0 8px rgba(239, 68, 68, 0); }
        100% { box-shadow: 0 0 0 0 rgba(239, 68, 68, 0); }
    }

    /* === CSS for Mobile Profile Dropdown === */

     .logo {
            width: 100%;
            max-width: 500px; /* Adjust as needed */
            height: 90%;
            max-height: 500px; /* Adjust as needed */
            object-fit: contain; /* Maintain aspect ratio */
            display: flex;
            align-items: center;
            margin-left: -60px; /* Adjust as needed */
            margin-right: -15%; /* Adjust as needed */
            margin-top: 5px; /* Adjust as needed */
            justify-content: flex-start; /* Align to the left */

            background: none; /* Or your navbar's background color */
            /* Optional: a subtle bottom border */
        }
        @media (max-width: 760px) {
            .logo{
                height: 60%;
            }
            .notification-pulse-badge {
                /* Aap in values ko adjust kar ke perfect position set kar sakte hain */
                top: -9.4rem; 
                right: 0rem;
            }

        }
        @media (min-width: 640px) and (max-width: 767px) {
            /* Aapki CSS is block ke andar ayegi */
            .notification-pulse-badge {
                top: -8.9rem;
                right: 0rem;
            }
        }
        @media (min-width: 769px) and (max-width: 1023px) {
            /* Aapki CSS is block ke andar ayegi */
            .notification-pulse-badge {
                top: -8.9rem;
                right: 0rem;
            }
        }


    .nav_mobile_content .mobile-logo {
        align-items: center !important;
        margin-left: 70px !important; 
        margin-top: -20px !important;
        margin-bottom: -30px !important;  
    }

    .mobile-dropdown-content {
        display: none;
        padding-left: 20px;
        background-color: #f9f9f9;
        border-radius: 5px;
        margin-top: 10px;
    }
    .mobile-dropdown-content.open {
        display: block;
    }
    .mobile-dropdown-link {
        display: block;
        padding: 10px 0;
        color: #333;
        text-decoration: none;
        font-size: 16px;
        border-bottom: 1px solid #e5e7eb;
    }
    .mobile-dropdown-link:last-child {
        border-bottom: none;
    }
</style>


{{-- === FINAL GUARANTEED FIX: Improved JavaScript Logic === --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    
    // --- Hamburger Menu Logic (Runs for Everyone) ---
    const hamburgerBtn = document.querySelector('.humburger_btn');
    const mobileMenu = document.querySelector('.menu_mobile');
    const closeMobileMenuBtn = mobileMenu ? mobileMenu.querySelector('.menu_mobile_close') : null;

    if (hamburgerBtn && mobileMenu && closeMobileMenuBtn) {
        hamburgerBtn.addEventListener('click', () => {
            mobileMenu.classList.add('active');
        });
        closeMobileMenuBtn.addEventListener('click', () => {
            mobileMenu.classList.remove('active');
        });
    }

    // --- Authenticated User Logic (Only runs if elements exist) ---
    const userBlock = document.querySelector('.user_block');
    if(userBlock) {
        const userDropdown = userBlock.querySelector('.list_action_user');
        const notificationBell = document.getElementById('notification-bell');
        const notificationList = document.querySelector('.notification_list');
        const notificationBadge = document.getElementById('notification-badge');
        const allNotificationsModal = document.getElementById('notifications-viewer-modal');
        const mobileDropdownToggles = document.querySelectorAll('.mobile-dropdown-toggle');
        
        function markNotificationsAsRead() {
            if (notificationBadge) {
                setTimeout(() => {
                    fetch('{{ route("notifications.markAsRead") }}', {
                        method: 'GET',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        }
                    }).then(response => {
                        if (response.ok) { notificationBadge.style.display = 'none'; }
                    }).catch(error => console.error('Error:', error));
                }, 2000);
            }
        }

        // Mobile Profile Dropdown Toggle
        mobileDropdownToggles.forEach(toggle => {
            toggle.addEventListener('click', function(event) {
                event.preventDefault();
                const dropdownContent = this.nextElementSibling;
                if (dropdownContent) { dropdownContent.classList.toggle('open'); }
            });
        });
    
        // Notification Bell Click
        if (notificationBell) {
            notificationBell.addEventListener('click', function(event) {
                event.stopPropagation();
                if (userDropdown) userDropdown.classList.remove('active');

                if (window.innerWidth < 1024) { // Mobile
                    if(allNotificationsModal) {
                        allNotificationsModal.classList.add('visible');
                        markNotificationsAsRead();
                    }
                } else { // Desktop
                    notificationList.classList.toggle('active');
                    if (notificationList.classList.contains('active')) {
                        markNotificationsAsRead();
                    }
                }
            });
        }

        // User Profile Block Click
        userBlock.addEventListener('click', function(event) {
            event.stopPropagation();
            if (notificationList) notificationList.classList.remove('active');
            if (userDropdown) userDropdown.classList.toggle('active');
        });

        // Universal "Click Outside" Listener for logged-in users
        window.addEventListener('click', function(event) {
            if (notificationList && notificationList.classList.contains('active')) {
                 if (!notificationBell.contains(event.target)) {
                    notificationList.classList.remove('active');
                }
            }
            if (userDropdown && userDropdown.classList.contains('active')) {
                 if (!userBlock.contains(event.target)) {
                    userDropdown.classList.remove('active');
                }
            }
        });
    }
});
</script>


 