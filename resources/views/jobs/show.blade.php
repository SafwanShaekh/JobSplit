@extends('layouts.public')

@section('content')
<!-- Breadcrumb -->
<section class="breadcrumb bg-[#F9F2EC] sm:pt-35 pt-30 pb-15">
        <div class="container flex max-lg:flex-col lg:items-center justify-between gap-7 gap-y-4">
            <div class="jobs_info flex flex-wrap sm:gap-8 gap-4 w-full">
                <div class="flex flex-col gap-1">
                    <h4 class="jobs_name heading4 -style-1">{{ $job->title }}</h4>
                    <div class="flex flex-wrap items-center gap-5 gap-y-1.5 mt-1">
                        <div class="jobs_address -style-1 text-secondary">
                            <span class="ph ph-map-pin text-xl"></span>
                            <span class="address align-top">{{ $job->location }}</span>
                        </div>
                        
                    </div>
                    <div class="flex flex-wrap items-center gap-2.5 mt-2">
                        <span class="jobs_tag caption1 tag bg-white whitespace-nowrap">{{ $job->category }}</span>
                    </div>
                </div>
            </div>
    
            <div class="breadcrumb_action flex flex-col max-lg:flex-col-reverse gap-3">
                <div class="flex max-sm:flex-wrap gap-3">
                    <button class="add_wishlist_btn -relative -border w-12">
                        <span class="ph ph-heart text-2xl"></span>
                        <span class="ph-fill ph-heart text-2xl"></span>
                    </button>
                    <button class="btn_open_popup apply_btn button-main whitespace-nowrap" data-type="modal_apply">Apply Now</button>
                </div>
                <div class="flex max-sm:flex-wrap gap-2 job-posted-time-placement">
                    <span class="body2 whitespace-nowrap">
                        {{ \Carbon\Carbon::parse($job->created_at)->diffForHumans() }}
                    </span>
                </div>
                <div class="jobs_price lg:text-right">
                    <span class="price text-title">Rs.{{ $job->pay }}</span>
                </div>
            </div>
        </div>
</section>

<section class="jobs_detail lg:py-20 sm:py-14 py-10">
    <div class="container flex max-lg:flex-col gap-y-10">
        <div class="jobs_info w-full lg:pr-15">
            <div class="overview">
                <h6 class="heading6">Projects Overview</h6>
                <ul class="list_overview grid sm:grid-cols-3 grid-cols-2 gap-6 w-full mt-4">
                    <li class="flex items-center gap-3">
                        <span class="ph ph-calendar-blank flex-shrink-0 text-4xl"></span>
                        <div>
                            <span class="block text-secondary">Date Posted:</span>
                            <strong class="text-button">{{ \Carbon\Carbon::parse($job->date_time)->format('F d, Y') }}</strong>
                        </div>
                    </li>
                    <li class="flex items-center gap-3">
                        <span class="ph ph-map-pin flex-shrink-0 text-4xl"></span>
                        <div>
                            <span class="block text-secondary">Location:</span>
                            <strong class="text-button">{{ $job->location }}</strong>
                        </div>
                    </li>
                    <li class="flex items-center gap-3">
                        <span class="ph ph-hourglass flex-shrink-0 text-4xl"></span>
                        <div>
                            <span class="block text-secondary">Duration:</span>
                            <strong class="text-button">{{ $job->duration }}</strong>
                        </div>
                    </li>
                    <li class="flex items-center gap-3">
                        <span class="ph ph-hourglass flex-shrink-0 text-4xl"></span>
                        <div>
                            <span class="block text-secondary">Description:</span>
                            <strong class="text-button">{{ $job->description }}</strong>
                        </div>
                    </li>
                </ul>
            </div>

                     <div class="description md:mt-10 mt-7">
                        <h6 class="heading6">Closing Content</h6>
                        <p class="mt-3 body2 text-secondary">If you find this opportunity suitable for your skills and availability, don’t miss the chance to apply. Share your proposal and get connected with the job poster today.</p>
                    </div>

            <div class="work md:mt-10 mt-7">
                <h6 class="heading6">Terms Before Apply</h6>
                <ul class="list_work w-full mt-3">
                    <li class="flex body2 text-secondary">
                        <span class="ph-fill ph-dot-outline mt-1 mr-1"></span>
                        <p>Carefully read the job description and requirements.</p>
                    </li>
                    <li class="flex body2 text-secondary">
                        <span class="ph-fill ph-dot-outline mt-1 mr-1"></span>
                        <p>Ensure that your skills and experience match the job needs.</p>
                    </li>
                    <li class="flex body2 text-secondary">
                        <span class="ph-fill ph-dot-outline mt-1 mr-1"></span>
                        <p>Verify the budget, duration, and location mentioned by the poster.</p>
                    </li>
                    <li class="flex body2 text-secondary">
                        <span class="ph-fill ph-dot-outline mt-1 mr-1"></span>
                        <p>Prepare a clear and professional proposal highlighting your expertise.</p>
                    </li>
                    <li class="flex body2 text-secondary">
                        <span class="ph-fill ph-dot-outline mt-1 mr-1"></span>
                        <p>Respect the timelines and commitments once the job is accepted.</p>
                    </li>
                </ul>
            </div>

            <div class="bring md:mt-10 mt-7">
                <h6 class="heading6">What you'll bring:</h6>
                <ul class="list_work w-full mt-3">
                    <li class="flex body2 text-secondary">
                        <span class="ph-fill ph-dot-outline mt-1 mr-1"></span>
                        <p>By applying for jobs here, you can access a variety of opportunities that match your skills and interests. You’ll receive fair compensation, gain valuable experience, and build professional connections while working on diverse projects. The platform ensures a secure and transparent process, giving you the flexibility to choose jobs that suit your schedule and expertise.</p>
                    </li>
                </ul>
            </div>
            
                <div class="images md:mt-10 mt-7">
                    <ul class="list_images grid xl:grid-cols-3 grid-cols-2 sm:gap-5 gap-4 gap-y-5 w-full">
                        <li class="max-xl:col-span-2 flex items-center justify-center relative overflow-hidden rounded-lg">
                            <img src="{{ asset('assets/images/blog/1.webp') }}" alt="blog/1" class="w-full h-full object-cover" />
                        </li>
                        <li class="relative overflow-hidden rounded-lg">
                            <img src="{{ asset('assets/images/blog/2.webp') }}" alt="blog/2" class="w-full h-full object-cover" />
                        </li>
                        <li class="relative overflow-hidden rounded-lg">
                            <img src="{{ asset('assets/images/blog/4.webp') }}" alt="blog/4" class="w-full h-full object-cover" />
                        </li>
                    </ul>
                </div>

        </div>

        <!-- About the Employer Section (Dummy for now) -->
        <div class="jobs_sidebar lg:sticky lg:top-24 flex-shrink-0 lg:w-[380px] w-full h-fit">
            <div class="about overflow-hidden rounded-xl bg-white shadow-md duration-300">
                <div class="flex items-center justify-between px-5 py-4 border-b border-line">
                    <h6 class="heading6">About the Employer</h6>
                </div>
                <div class="employer_info p-5">
                    <!-- {{-- Dummy display for now --}} -->
                    <a href="#" class="flex items-center gap-5 w-full">
                        <div>
                            ye section abhi inject hoga jo bnda employer profile banayega wo ye kam karega
                            <strong class="employers_name heading6">User Info</strong>
                        </div>
                    </a>
                    <div class="industry flex items-center justify-between w-full py-5 border-b border-line">
                        <span class="text-secondary">User Name:</span>
                        <strong class="text-button">-----------</strong>
                    </div>
                    <div class="size flex items-center justify-between w-full py-5 border-b border-line">
                        <span class="text-secondary">Member since:</span>
                        <strong class="text-button">registration date-----</strong>
                    </div>
                    <div class="address flex items-center justify-between w-full py-5 border-b border-line">
                        <span class="text-secondary">Address:</span>
                        <strong class="text-button">City, Country</strong>
                    </div>
                    <a href="#" class="button-main w-full text-center">Send Message</a>
                </div>
            </div>
        </div>

    </div>
</section>

<!-- Scroll to top -->
<button class="scroll-to-top-btn"><span class="ph-bold ph-caret-up"></span></button>
@endsection
