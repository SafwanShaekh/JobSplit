<div class="menu_dashboard overflow-hidden flex-shrink-0 w-[280px] h-full bg-white relative z-[2] max-lg:hidden">
    <div class="inner scrollbar_custom max-h-full py-6 px-3">
        <div class="area">
            <span class="px-6 text-xs font-semibold text-secondary uppercase">Overviews</span>
            <ul class="list_link flex flex-col gap-2 mt-2">
                <li><a href="{{ route('dashboard') }}" class="link flex items-center gap-3 w-full py-3 px-6 rounded-lg duration-300 hover:bg-background"><span class="ph-duotone ph-squares-four text-2xl text-secondary"></span><strong class="text-title">Dashboard</strong></a></li>
                <li><a href="{{ route('chat') }}" class="link flex items-center gap-3 w-full py-3 px-6 rounded-lg duration-300 hover:bg-background"><span class="ph-duotone ph-chats text-2xl text-secondary"></span><strong class="text-title">Messages</strong></a></li>
            </ul>
        </div>
        <div class="area mt-6">
            <span class="px-6 text-xs font-semibold text-secondary uppercase">Management</span>
            <ul class="list_link flex flex-col gap-2 mt-2">
                <li><a href="{{ route('job-applicants.index') }}" class="link flex items-center gap-3 w-full py-3 px-6 rounded-lg duration-300 hover:bg-background"><span class="ph-duotone ph-notepad text-2xl text-secondary"></span><strong class="text-title">Job Applicants</strong></a></li>
                <li><a href="{{ route('jobs.index') }}" class="link flex items-center gap-3 w-full py-3 px-6 rounded-lg duration-300 hover:bg-background"><span class="ph-duotone ph-briefcase text-2xl text-secondary"></span><strong class="text-title">My Jobs</strong></a></li>
                <li><a href="{{ route('jobs.create') }}" class="link flex items-center gap-3 w-full py-3 px-6 rounded-lg duration-300 hover:bg-background"><span class="ph-duotone ph-file-arrow-up text-2xl text-secondary"></span><strong class="text-title">Submit Job</strong></a></li>
                <li><a href="{{ route('applications.index') }}" class="link flex items-center gap-3 w-full py-3 px-6 rounded-lg duration-300 hover:bg-background"><span class="ph-duotone ph-file-arrow-up text-2xl text-secondary"></span><strong class="text-title">Applied Jobs</strong></a></li>
            </ul>
        </div>
        <div class="area mt-6">
            <span class="px-6 text-xs font-semibold text-secondary uppercase">User</span>
            <ul class="list_link flex flex-col gap-2 mt-2">
                <li><a href="{{ route('profile.show')}}" class="link flex items-center gap-3 w-full py-3 px-6 rounded-lg duration-300 hover:bg-background"><span class="ph-duotone ph-user-circle text-2xl text-secondary"></span><strong class="text-title">My Profile</strong></a></li>
                <li>
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
    </div>
</div>


<div class="lg:hidden">
    <div id="sidebar-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-30 hidden"></div>

    <div id="dashboard-sidebar" class="menu_dashboard overflow-hidden w-[80vw] max-w-[280px] h-full bg-white fixed top-0 left-0">
        <div class="inner scrollbar_custom max-h-full py-6 px-3">
            <button id="sidebar-close-btn" class="absolute top-4 right-4">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
            </button>
            <div class="area mt-8">
                {{-- Mobile menu links are the same as desktop --}}
                <span class="px-6 text-xs font-semibold text-secondary uppercase">Overviews</span>
                <ul class="list_link flex flex-col gap-2 mt-2">
                    <li><a href="{{ route('dashboard') }}" class="link flex items-center gap-3 w-full py-3 px-6 rounded-lg duration-300 hover:bg-background"><span class="ph-duotone ph-squares-four text-2xl text-secondary"></span><strong class="text-title">Dashboard</strong></a></li>
                    <li><a href="{{ route('chat') }}" class="link flex items-center gap-3 w-full py-3 px-6 rounded-lg duration-300 hover:bg-background"><span class="ph-duotone ph-chats text-2xl text-secondary"></span><strong class="text-title">Messages</strong></a></li>
                </ul>
            </div>
            <div class="area mt-6">
                 <span class="px-6 text-xs font-semibold text-secondary uppercase">Management</span>
                 <ul class="list_link flex flex-col gap-2 mt-2">
                    <li><a href="{{ route('job-applicants.index') }}" class="link flex items-center gap-3 w-full py-3 px-6 rounded-lg duration-300 hover:bg-background"><span class="ph-duotone ph-notepad text-2xl text-secondary"></span><strong class="text-title">Job Applicants</strong></a></li>
                    <li><a href="{{ route('jobs.index') }}" class="link flex items-center gap-3 w-full py-3 px-6 rounded-lg duration-300 hover:bg-background"><span class="ph-duotone ph-briefcase text-2xl text-secondary"></span><strong class="text-title">My Jobs</strong></a></li>
                    <li><a href="{{ route('jobs.create') }}" class="link flex items-center gap-3 w-full py-3 px-6 rounded-lg duration-300 hover:bg-background"><span class="ph-duotone ph-file-arrow-up text-2xl text-secondary"></span><strong class="text-title">Submit Job</strong></a></li>
                    <li><a href="{{ route('applications.index') }}" class="link flex items-center gap-3 w-full py-3 px-6 rounded-lg duration-300 hover:bg-background"><span class="ph-duotone ph-file-arrow-up text-2xl text-secondary"></span><strong class="text-title">Applied Jobs</strong></a></li>
                </ul>
            </div>
            <div class="area mt-6">
                <span class="px-6 text-xs font-semibold text-secondary uppercase">User</span>
                <ul class="list_link flex flex-col gap-2 mt-2">
                    <li><a href="{{ route('profile.show')}}" class="link flex items-center gap-3 w-full py-3 px-6 rounded-lg duration-300 hover:bg-background"><span class="ph-duotone ph-user-circle text-2xl text-secondary"></span><strong class="text-title">My Profile</strong></a></li>
                    <li>
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
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sidebar = document.getElementById('dashboard-sidebar');
        const overlay = document.getElementById('sidebar-overlay');
        const openBtn = document.getElementById('sidebar-toggle-btn');
        const closeBtn = document.getElementById('sidebar-close-btn');
        
        const openSidebar = () => {
            if (sidebar && overlay) {
                sidebar.classList.add('active');
                overlay.classList.remove('hidden');
                document.body.classList.add('sidebar-is-open');
            }
        };

        const closeSidebar = () => {
            if (sidebar && overlay) {
                sidebar.classList.remove('active');
                overlay.classList.add('hidden');
                document.body.classList.remove('sidebar-is-open');
            }
        };

        if (openBtn) openBtn.addEventListener('click', openSidebar);
        if (closeBtn) closeBtn.addEventListener('click', closeSidebar);
        if (overlay) overlay.addEventListener('click', closeSidebar);
    });
</script>