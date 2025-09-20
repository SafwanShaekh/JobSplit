<div class="menu_dashboard overflow-hidden flex-shrink-0 min-[320px]:w-[280px] w-[80vw] h-full bg-white relative z-[2] max-lg:hidden">
    <button class="sidebar-close-btn lg:hidden">
        <span class="ph-bold ph-x"></span>
    </button>
    <div class="inner scrollbar_custom max-h-full py-6 px-3">
        <div class="area">
            <span class="px-6 text-xs font-semibold text-secondary uppercase">Overviews</span>
            <ul class="list_link flex flex-col gap-2 mt-2">
                <li>
                    <a href="{{ route('dashboard') }}" class="link flex items-center gap-3 w-full py-3 px-6 rounded-lg duration-300 hover:bg-background">
                        <span class="ph-duotone ph-squares-four text-2xl text-secondary"></span>
                        <strong class="text-title">Dashboard</strong>
                    </a>
                </li>
                <li>
                    <a href="#" class="link flex items-center gap-3 w-full py-3 px-6 rounded-lg duration-300 hover:bg-background">
                        <span class="ph-duotone ph-chats text-2xl text-secondary"></span>
                        <strong class="text-title">Messages</strong>
                    </a>
                </li>
            </ul>
        </div>
        <div class="area mt-6">
            <span class="px-6 text-xs font-semibold text-secondary uppercase">Management</span>
            <ul class="list_link flex flex-col gap-2 mt-2">
                <li>
                    <a href="{{ route('job-applicants.index') }}" class="link flex items-center gap-3 w-full py-3 px-6 rounded-lg duration-300 hover:bg-background">
                        <span class="ph-duotone ph-notepad text-2xl text-secondary"></span>
                        <strong class="text-title">Job Applicants</strong>
                    </a>
                </li>
                <li>
                    <a href="{{ route('jobs.index') }}" class="link flex items-center gap-3 w-full py-3 px-6 rounded-lg duration-300 hover:bg-background">
                        <span class="ph-duotone ph-briefcase text-2xl text-secondary"></span>
                        <strong class="text-title">My Jobs</strong>
                    </a>
                </li>
                <li>
                    <a href="{{ route('jobs.create') }}" class="link flex items-center gap-3 w-full py-3 px-6 rounded-lg duration-300 hover:bg-background">
                        <span class="ph-duotone ph-file-arrow-up text-2xl text-secondary"></span>
                        <strong class="text-title">Submit Job</strong>
                    </a>
                </li>
                <li>
                    <a href="{{ route('applications.index') }}" class="link flex items-center gap-3 w-full py-3 px-6 rounded-lg duration-300 hover:bg-background">
                        <span class="ph-duotone ph-file-arrow-up text-2xl text-secondary"></span>
                        <strong class="text-title">Applied Jobs</strong>
                    </a>
                </li>
            </ul>
        </div>

         <div class="area mt-6">
            <span class="px-6 text-xs font-semibold text-secondary uppercase">Support</span>
            <ul class="list_link flex flex-col gap-2 mt-2">
                <li>
                    <a href="{{ route('complaints.index') }}" class="link flex items-center gap-3 w-full py-3 px-6 rounded-lg duration-300 hover:bg-background">
                        <span class="ph-duotone ph-chats-circle text-2xl text-secondary"></span>
                        <strong class="text-title">My Complaints</strong>
                    </a>
                </li>
                <li>
                    <a href="{{ route('complaints.create') }}" class="link flex items-center gap-3 w-full py-3 px-6 rounded-lg duration-300 hover:bg-background">
                        <span class="ph-duotone ph-plus-circle text-2xl text-secondary"></span>
                        <strong class="text-title">File a Complaint</strong>
                    </a>
                </li>
            </ul>
        </div>

        <div class="area mt-6">
            <span class="px-6 text-xs font-semibold text-secondary uppercase">User</span>
            <ul class="list_link flex flex-col gap-2 mt-2">
                <li>
                    <a href="{{ route('profile.show')}}" class="link flex items-center gap-3 w-full py-3 px-6 rounded-lg duration-300 hover:bg-background">
                        <span class="ph-duotone ph-user-circle text-2xl text-secondary"></span>
                        <strong class="text-title">My Profile</strong>
                    </a>
                </li>
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

{{-- Note: Is file mein JavaScript pehle se mojood thi, usay nahi chheda gaya --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // ... aapka purana script ...
    });
</script>