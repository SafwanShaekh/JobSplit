@extends('layouts.public')

@section('content')



<section class="breadcrumb">
    <div class="breadcrumb_inner relative sm:mt-20 mt-16 py-15">
        <div class="breadcrumb_bg absolute top-0 left-0 w-full h-full">
            <img src="{{ asset('assets/images/service/career-banner-1.jpg') }}" alt="breadcrumb_job" class="w-full h-full object-cover" />
        </div>
        <div class="container relative h-full">
            <div class="breadcrumb_content flex flex-col items-start justify-center lg:w-[778px] md:w-5/6 w-full h-full">
                <h3 class="heading3 text-white mt-2 animate animate_top" style="--i: 2">Jobs List</h3>
                <div class="form_search z-[1] w-full mt-5 animate animate_top" style="--i: 3">
                   <form action="{{ route('jobs.browse') }}" method="GET" class="form_inner flex justify-between max-sm:flex-wrap gap-3 gap-y-4 relative w-full p-2 rounded-lg bg-white">
                        <div class="form_input relative w-full">
                            <span class="icon_search ph-bold ph-magnifying-glass absolute top-1/2 -translate-y-1/2 left-2 text-xl"></span>
                            <input type="text" class="input_search w-full h-full pl-10" placeholder="Search Here" name="search" value="{{ request('search') }}" />
                        </div>  
                        <button type="submit" class="button-main text-center flex-shrink-0">Search</button>
                        <button id="filter_btn" type="button"  class="filter_btn button-main text-center flex-shrink-0">
                            <span class="ph ph-sliders-horizontal text-xl"></span>
                            <span>Filters</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Is section se replace karna shuru karein --}}
<div class="jobs lg:py-20 sm:py-14 py-10 bg-gray-50">
    <div class="container flex flex-col items-center">
        <div class="filter flex flex-wrap items-center justify-between gap-8 gap-y-3 relative w-full">
        </div>

        <div class="list_filtered flex flex-wrap items-center gap-3 w-full mt-5">
            <span class="quantity pr-3 border-r border-line">{{ $jobs->total() }} Results</span>
            <div class="list flex flex-wrap items-center gap-3"></div>
            @if(request()->has('search') || request()->has('category'))
                <a href="{{ route('jobs.browse') }}" class="clear_all_btn inline-flex items-center gap-1 py-1 px-2 border border-red text-red rounded-full duration-300 hover:bg-red hover:text-white">
                    <span class="ph ph-x text-sm"></span>
                    <span class="caption1">Clear All</span>
                </a>
            @endif
        </div>

{{-- Naya Job Cards ka Grid Yahan Se Shuru Ho Raha Hai (Custom CSS ke saath) --}}
<div class="job-grid-container">
    @forelse($jobs as $job)
        <div class="job-card">
            
            <div class="job-card__content">
                <div class="job-card__header">
                    <div class="job-card__company-info">
                        <div class="job-card__logo">
                            <img  class="job-card__logo-img" src="{{ $job->user->profile_photo_url }}" alt="">
                        </div>
                        <div>
                            <h3 class="job-card__title">
                                <a href="{{ route('jobs.show', $job->id) }}">{{ $job->title }}</a>
                            </h3>
                            <p class="job-card__company">{{ $job->user->name ?? 'Company Name' }}</p>
                        </div>
                    </div>
                    <span class="job-card__category">{{ $job->category }}</span>
                </div>

                <div class="job-card__meta">
                    <div class="meta-item">
                        <i class="ph ph-map-pin"></i>
                        <span>{{ $job->location }}</span>
                    </div>
                    
                    <div class="meta-item">
                        <i class="ph ph-calendar-blank"></i>
                        <span>{{ $job->created_at->diffForHumans() }}</span>
                    </div>
                    <div class="meta-item">
                        <i class="ph ph-clock"></i>
                        <span>{{ $job->duration }}</span>
                    </div>
                </div>

                <div class="job-card__salary">
                    <p>{{ $job->pay }}</p>
                </div>
            </div>

            <div class="job-card__actions">
                 @auth
                    @if(Auth::id() != $job->user_id)
                        @if ($job->status == 'open')
                            @if(in_array($job->id, $appliedJobIds))
                                <span class="btn btn--applied">Already Applied</span>
                            @else
                                <a href="{{ route('jobs.apply.create', $job->id) }}" class="btn btn--apply">Apply Now</a>
                            @endif
                        @elseif ($job->status == 'closed')
                            <button class="btn btn--closed" disabled>Hiring Closed</button>
                        @endif
                    @endif
                 @endauth
                 @guest
                    <a href="{{ route('login') }}" class="btn btn--apply">Login to Apply</a>
                 @endguest
            </div>
        </div>
    @empty
            {{-- Yeh naya, conditional empty message hai --}}
        <div class="no-jobs-found" style="grid-column: 1 / -1;">
            @if(!empty($searchedCategory))
                {{-- Agar category search ki thi aur job nahi mili --}}
                <p>Jobs are not available for <strong>"{{ $searchedCategory }}"</strong> at this moment.</p>
            @else
                {{-- Agar koi aur search thi aur job nahi mili --}}
                <p>No jobs found matching your criteria.</p>
            @endif
        </div>
    @endforelse
</div>
        
        <br><br>

        @if(request()->hasAny(['search','pay','title','location','category']))
            <div class="mb-4">
                <a href="{{ route('jobs.browse') }}"
                    class="bg-gray-200 text-gray-800 px-4 py-2 rounded hover:bg-gray-300">
                    <button class="button-main text-center flex-shrink-0">Back to All Jobs</button>
                </a>
            </div>
        @endif

        {{-- Pagination bilkul wesi hi hai --}}
        <ul class="list_pagination menu_tab flex items-center justify-center gap-2 w-full md:mt-10 mt-7">
            @for ($i = 1; $i <= $jobs->lastPage(); $i++)
                <li>
                    <a href="{{ $jobs->url($i) }}"
                        class="tab_btn -fill flex items-center justify-center w-10 h-10 rounded-lg border border-line text-title duration-300 hover:border-black hover:bg-white {{ $jobs->currentPage() == $i ? 'active bg-gray-800 text-white border-gray-800' : 'bg-gray-100' }}">
                        {{ $i }}
                    </a>
                </li>
            @endfor
            @if($jobs->hasMorePages())
                <li>
                    <a href="{{ $jobs->nextPageUrl() }}"
                        class="tab_btn -fill flex items-center justify-center w-10 h-10 rounded-lg border border-line text-title duration-300 hover:border-black hover:bg-white bg-gray-100">&gt;</a>
                </li>
            @endif
        </ul>
    </div>
</div>
{{-- Is section tak poora replace karein --}}

<button class="scroll-to-top-btn"><span class="ph-bold ph-caret-up"></span></button>

<div class="modal">
    <div class="sidebar min-[390px]:w-[348px] w-[80vw] h-full bg-white">
        <div class="block_filter full-height py-4 px-6">
        <form action="{{ route('jobs.browse') }}" method="GET">

    <div class="filter_section search">
        <strong class="text-button">Search Title</strong>
        <div class="form_input relative w-full h-12 mt-2">
            <span class="icon_search ph-bold ph-magnifying-glass absolute top-1/2 -translate-y-1/2 left-3 text-xl"></span>
            <input type="text" name="search" value="{{ request('search') }}" 
                   class="input_search w-full h-full pl-10 pr-3 border border-line rounded-lg" 
                   placeholder="Title"/>
        </div>
    </div>

    <div class="filter_section location mt-6">
        <strong class="text-button">Address/Area</strong>
        <input type="text" name="location" value="{{ request('location') }}" 
               class="w-full h-12 border border-line rounded-lg px-3" placeholder="Enter location"/>
    </div>

    <div class="filter_section category mt-6">
        <strong class="text-button">Category</strong>
        <input type="text" name="category" value="{{ request('category') }}" 
               class="w-full h-12 border border-line rounded-lg px-3" placeholder="Enter category"/>
    </div>

    <div class="filter_section filter_price mt-6">
        <strong class="text-button">Pay</strong>
        <div class="flex gap-3 mt-2">
            <input type="number" name="min_pay" value="{{ request('min_pay') }}" 
                   class="w-32 h-10 border border-line rounded-lg px-3" placeholder="Min"/>
            <input type="number" name="max_pay" value="{{ request('max_pay') }}" 
                   class="w-32 h-10 border border-line rounded-lg px-3" placeholder="Max"/>
        </div>
    </div>

    <button type="submit" class="button-main w-full mt-6 text-center">Find Jobs</button>
        </form>
        </div>
    </div>
</div>

@endsection

@push('styles')
    <style>
        .button-closed {
            background-color: #e90d0dff; /* Gray background */
            color: #fcfdffff; /* Dark gray text */
            font-weight: 600;
            padding: 8px 16px;
            border-radius: 8px;
            border: none;
            cursor: not-allowed; /* Indicate that the button is disabled */
        }
        .button-apply {
            background-color: #14b8a6; /* Teal color */
            color: white;
            font-weight: 600;
            padding: 10px 24px;
            border-radius: 8px;
            transition: background-color 0.3s;
        }
        .button-apply:hover {
            background-color: #0d9488; /* Darker Teal */
        }

        .button-hiring-closed {
            background-color: #f3f4f6; /* Lighter Gray background */
            color: #6b7280; /* Darker gray text */
            font-weight: 600;
            padding: 10px 24px;
            border-radius: 8px;
            cursor: not-allowed;
        }

        /* Pagination active state ke liye behtar style */
        .list_pagination .active {
             background-color: #1f2937; /* Dark Gray */
             color: white;
             border-color: #1f2937;
        }

        /* Grid Container */
    .job-grid-container {
        width: 100%;
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 32px;
        margin-top: 40px;
    }

    /* Main Job Card */
    .job-card {
        background-color: #ffffff;
        padding: 24px;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        /* border: 1px solid #f0f0f0; */
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        /* transition: transform 0.3s ease, box-shadow 0.3s ease; */
       border: 3px solid #e0f2f2; /* Default halka sa border */
    transition: all 0.3s ease;
}

/* Step 2: Hover par solid border dein aur glow animation shuru karein */
.job-card:hover {
    transform: translateY(-5px);

    border: 3px solid;
    border-color: #14b8a6; /* Solid Teal Green Border */
    animation: border-glow 1.5s infinite alternate; /* Glow animation apply karein */
}

/* Step 3: Glow ki animation banayein */
@keyframes border-glow {
  from {
    /* Shuru mein halka sa glow */
    box-shadow: 0 0 5px rgba(20, 184, 166, 0.5), 
                0 0 10px rgba(20, 184, 166, 0.3);
  }
  to {
    /* Aakhir mein tez glow */
    box-shadow: 0 0 20px rgba(20, 184, 166, 0.8), 
                0 0 30px rgba(20, 184, 166, 0.6);
  }
}

    .job-card__header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 16px;
    }
    
    .job-card__logo-img {
        width: 100%;
        height: 100%;
        object-fit: cover; /* Tasveer ko distort hone se bachata hai */
        border-radius: inherit; /* Apne parent div (job-card__logo) jaisa hi border-radius le lega */
    }
    
    .job-card__company-info {
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .job-card__logo {
        width: 48px;
        height: 48px;
        border-radius: 8px;
        background-color: #ef4444; /* Red */
        color: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        font-weight: 700;
        flex-shrink: 0;
    }

    .job-card__title a {
        font-size: 18px;
        font-weight: 700;
        color: #1a202c;
        text-decoration: none;
        transition: color 0.3s ease;
    }
    .job-card__title a:hover {
        color: #14b8a6; /* Teal */
    }
    .job-card__company {
        font-size: 14px;
        color: #718096;
        margin-top: 2px;
    }

    .job-card__category {
        background-color: #f5f3ff;
        color: #4338ca; /* Purple */
        font-size: 12px;
        font-weight: 600;
        padding: 4px 12px;
        border-radius: 9999px;
        white-space: nowrap;
    }

    .job-card__meta {
        margin-top: 20px;
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        font-size: 14px;
        color: #0d0f11ff;
        
    }
    .meta-item {
        display: flex;
        align-items: center;
        gap: 6px;
    }
    
    .job-card__salary {
        margin-top: 20px;
        font-size: 22px;
        font-weight: 700;
        color: #16a34a; /* Green */
    }

    .job-card__actions {
        margin-top: 24px;
    }
    
    /* Buttons */
    .btn {
        display: block;
        width: 100%;
        text-align: center;
        font-weight: 600;
        padding: 12px;
        border-radius: 8px;
        text-decoration: none;
        border: none;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }
    .btn--apply {
        background-color: #14b8a6; /* Teal */
        color: #ffffff;
    }
    .btn--apply:hover {
        background-color: #0d9488; /* Darker Teal */
    }
    .btn--applied {
        background-color: #e5e7eb;
        color: #374151;
        cursor: not-allowed;
    }
    .btn--closed {
        background-color: #f3f4f6;
        color: #6b7280;
        cursor: not-allowed;
    }
    
    .no-jobs-found {
        grid-column: 1 / -1;
        padding: 24px;
        text-align: center;
        color: #718096;
        background-color: #ffffff;
        border-radius: 8px;
    }
    </style>
@endpush