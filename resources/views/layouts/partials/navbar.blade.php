<header id="header" class="header -style-white relative">
    <div class="header_inner absolute flex items-center justify-between top-0 left-0 right-0 z-[1] w-full sm:h-20 h-16 min-[1600px]:px-15 lg:px-9 px-4 border-b border-line">
        
        <div class="left flex items-center gap-15 h-full max-[1600px]:gap-6">
            <h1>
                <a href="{{ url('/') }}">
                    {{-- Assuming you have an assets folder in public --}}
                    <img src="{{ asset('assets/images/logo.png') }}" alt="logo" class="logo-black md:h-[42px] h-8 w-auto" />
                </a>
            </h1>

            <div class="navigator h-full max-lg:hidden">
                <ul class="list flex items-center gap-8 h-full">
                    <li>
                        {{-- Note: Replace '#' with your actual route names --}}
                        <a href="{{ route('jobs.browse') }}" class="flex items-center gap-1 h-full text-title relative duration-300">Browse Jobs</a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center gap-1 h-full text-title relative duration-300">About Us</a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center gap-1 h-full text-title relative duration-300">Contact</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="list_action flex items-center gap-5">

            <div class="notification_block relative max-sm:hidden">
                <button class="relative block">
                    <span class="ph ph-bell text-2xl block"></span>
                    <span class="absolute -top-0.5 right-0.5 w-2 h-2 bg-primary rounded-full"></span>
                </button>
                <div class="notification_submenu absolute w-[400px] p-5 top-[3.25rem] right-0 bg-white rounded-xl shadow-lg">
                    <h6 class="heading6 pb-3">Notifications</h6>
                    <ul class="list_notification w-full">
                        <li class="notification_item w-full py-3 border-t border-line duration-300 hover:bg-background">
                            <a href="#!" class="flex gap-3 w-full">
                                <span class="ic_noti flex flex-shrink-0 items-center justify-center w-8 h-8 rounded-full bg-surface">
                                    <span class="ph-fill ph-bell text-lg text-secondary"></span>
                                </span>
                                <div class="notification_detail">
                                    <p class="notification_desc text-secondary">John Smith applied for your job <span class="text-black">UI Designer</span>.</p>
                                    <span class="notification_time caption2 text-placehover">25 mins ago</span>
                                </div>
                            </a>
                        </li>
                        {{-- Add more notification items here --}}
                    </ul>
                </div>
            </div>
    
            <div class="user_block relative max-sm:hidden">
                        <button class="user_infor flex items-center gap-2 text-white">               
                       <img src="{{ auth()->user()->profile_picture 
                        ? asset('storage/'.auth()->user()->profile_picture) 
                        : asset('default-avatar.png') }}" 
                           width="60" height="60" style="border-radius:50%;object-fit:cover;" alt="Profile Photo"
                             width="60" height="60"
                             style="border-radius:50%; object-fit:cover;"  class="user_avatar flex-shrink-0 w-9 h-9 rounded-full">
                             <strong class="user_name text-title"></strong>
                              <strong class="user_name text-title">{{ Auth::user()->name }}</strong>

                             <span class="ph ph-caret-down"></span>
                        </button>
                        <ul class="list_action_user absolute w-[240px] p-3 top-14 right-0 bg-white rounded-lg">
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
            
            <button class="humburger_btn lg:hidden">
                <span class="ph-bold ph-list text-2xl block"></span>
            </button>
        </div>
    </div>

    <header id="header" class="header -style-white relative">
    </header>

<div class="menu_mobile">
    <button class="menu_mobile_close">
        <span class="ph-bold ph-x"></span>
    </button>
    <div class="nav_mobile_content">
        <a href="{{ url('/') }}" class="logo">
            <img src="{{ asset('assets/images/logo.png') }}" alt="logo" style="height: 32px;" />
        </a>

        <ul class="nav_mobile_list">
            <li><a href="{{ route('jobs.browse') }}">Browse Jobs</a></li>
            <li><a href="#">About Us</a></li>
            <li><a href="#">Contact</a></li>
        </ul>

        <hr class="mobile-menu-divider">

        <ul class="nav_mobile_list">
            <li class="has-dropdown">
                <a href="#" class="mobile-dropdown-toggle">
                    Notifications
                    <span class="ph ph-caret-down"></span>
                </a>
                <div class="mobile-dropdown-content">
                    <h6 class="heading6 p-3">Notifications</h6>
                    <ul class="list_notification w-full">
                        <li class="notification_item w-full p-3 border-t border-line">
                            <a href="#!" class="flex gap-3 w-full">
                                <div class="notification_detail">
                                    <p class="notification_desc text-secondary">John Smith applied for your job <span class="text-black">UI Designer</span>.</p>
                                    <span class="notification_time caption2 text-placehover">25 mins ago</span>
                                </div>
                            </a>
                        </li>
                        {{-- Add more notification items here --}}
                    </ul>
                </div>
            </li>

            <li class="has-dropdown">
                <a href="#" class="mobile-dropdown-toggle">
                    <div class="flex items-center gap-2">
                        <img src="{{ asset('assets/images/avatar/IMG-1.webp') }}" alt="Profile Photo" class="w-8 h-8 rounded-full object-cover">
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
        </ul>
    </div>
</div>
</header>

@push('scripts')

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // --- Main Menu Toggle Logic (Same as before) ---
        const hamburgerButton = document.querySelector('.humburger_btn');
        const mobileMenu = document.querySelector('.menu_mobile');
        const closeButton = document.querySelector('.menu_mobile_close');

        if (hamburgerButton && mobileMenu) {
            hamburgerButton.addEventListener('click', function() {
                mobileMenu.classList.add('active');
            });
        }

        if (closeButton && mobileMenu) {
            closeButton.addEventListener('click', function() {
                mobileMenu.classList.remove('active');
            });
        }

        // --- NEW: Dropdown Toggle Logic for inside the mobile menu ---
        const dropdownToggles = document.querySelectorAll('.mobile-dropdown-toggle');

        dropdownToggles.forEach(toggle => {
            toggle.addEventListener('click', function(event) {
                event.preventDefault(); // Prevents link from navigating
                const dropdownContent = this.nextElementSibling;
                
                if (dropdownContent) {
                    dropdownContent.classList.toggle('open');
                }
            });
        });
    });
</script>
    
@endpush