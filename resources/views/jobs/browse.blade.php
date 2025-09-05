@extends('layouts.app')

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

<!-- List jobs -->
<div class="jobs lg:py-20 sm:py-14 py-10">
    <div class="container flex flex-col items-center">
        <div class="filter flex flex-wrap items-center justify-between gap-8 gap-y-3 relative w-full">
            <ul class="list_layout flex items-center gap-1 sm:absolute sm:left-1/2 sm:-translate-x-1/2">
                <li class="xl:hidden">
                    <a href="jobs-default.html" class="layout_link cols_2"></a>
                </li>
                <li class="xl:hidden">
                    <a href="#!" class="layout_link list active"></a>
                </li>
            </ul>
        </div>

        <!-- Filtered Result Count -->
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
        

        <!-- Jobs List -->
        <ul class="list_jobs overflow-hidden w-full md:mt-10 mt-7 rounded-lg bg-white shadow-lg">
            @forelse($jobs as $job)
                <li class="item">
                    <div class="jobs_item -style-list flex flex-wrap items-center justify-between gap-4 sm:px-6 px-5 py-4 border-b border-line bg-white duration-300 hover:bg-background hover:border-transparent">
                        
                        <!-- Title -->
                        <a href="{{ route('jobs.show', $job->id) }}" class="jobs_info flex flex-wrap items-center gap-3">
                            <div>
                                <strong class="jobs_name max-sm:mt-0.5 text-title duration-300 hover:text-primary">
                                    {{ $job->title }}
                                </strong>
                            </div>
                        </a>

                        <!-- Location + Date -->
                        <div class="flex flex-wrap items-center gap-5 gap-y-1">
                            <div class="jobs_address -style-1 text-secondary">
                                <span class="ph ph-map-pin text-lg align-middle"></span>
                                <span class="address caption1 align-middle">{{ $job->location }}</span>
                            </div>
                            <div class="jobs_date text-secondary">
                                <span class="ph ph-calendar-blank text-lg align-middle"></span>
                                <span class="date caption1 align-middle">{{ $job->created_at->diffForHumans() }}</span>
                            </div>
                        </div>

                        <!-- Category + Type -->
                        <div class="jobs_tag flex flex-wrap items-center gap-2">
                            <span class="caption1 tag bg-surface">{{ $job->category }}</span>
                        </div>

                        <!-- Pay + Button -->
                        <div class="flex flex-wrap items-center sm:gap-6 gap-4">
                            <div class="jobs_price">
                                <span class="price text-title">{{ $job->pay }}</span>
                            </div>
                            <a class="button-main -border -small">Apply</a>
                        </div>
                    </div>
                </li>
            @empty
                <li class="item">
                    <div class="p-6 text-center text-secondary">No jobs found.</div>
                </li>
            @endforelse
        </ul>
        <br>
        <br>
        

                <!--Check if any filter/search query exists-->
                @if(request()->hasAny(['search','pay','title','location','category'])) 
                    <div class="mb-4">
                        <a href="{{ route('jobs.browse') }}" 
                           class="bg-gray-200 text-gray-800 px-4 py-2 rounded hover:bg-gray-300">
                           <button class="button-main text-center flex-shrink-0">Back to All Jobs</button>
                        </a>
                    </div>
                @endif

        <!-- Pagination -->
        <ul class="list_pagination menu_tab flex items-center justify-center gap-2 w-full md:mt-10 mt-7">
            @for ($i = 1; $i <= $jobs->lastPage(); $i++)
                <li>
                    <a href="{{ $jobs->url($i) }}"
                       class="tab_btn -fill flex items-center justify-center w-10 h-10 rounded border border-line text-title duration-300 hover:border-black {{ $jobs->currentPage() == $i ? 'active' : '' }}">
                        {{ $i }}
                    </a>
                </li>
            @endfor
            @if($jobs->hasMorePages())
                <li>
                    <a href="{{ $jobs->nextPageUrl() }}"
                       class="tab_btn -fill flex items-center justify-center w-10 h-10 rounded border border-line text-title duration-300 hover:border-black">&gt;</a>
                </li>
            @endif
        </ul>
    </div>
</div>

<!-- Scroll to top -->
<button class="scroll-to-top-btn"><span class="ph-bold ph-caret-up"></span></button>

<!-- filter modal work -->
<div class="modal">
    <div class="sidebar min-[390px]:w-[348px] w-[80vw] h-full bg-white">
        <div class="block_filter full-height py-4 px-6">
        <form action="{{ route('jobs.browse') }}" method="GET">

    <!-- Search Title -->
    <div class="filter_section search">
        <strong class="text-button">Search Title</strong>
        <div class="form_input relative w-full h-12 mt-2">
            <span class="icon_search ph-bold ph-magnifying-glass absolute top-1/2 -translate-y-1/2 left-3 text-xl"></span>
            <input type="text" name="search" value="{{ request('search') }}" 
                   class="input_search w-full h-full pl-10 pr-3 border border-line rounded-lg" 
                   placeholder="Title"/>
        </div>
    </div>

    <!-- Location -->
    <div class="filter_section location mt-6">
        <strong class="text-button">Location</strong>
        <input type="text" name="location" value="{{ request('location') }}" 
               class="w-full h-12 border border-line rounded-lg px-3" placeholder="Enter location"/>
    </div>

    <!-- Category -->
    <div class="filter_section category mt-6">
        <strong class="text-button">Category</strong>
        <input type="text" name="category" value="{{ request('category') }}" 
               class="w-full h-12 border border-line rounded-lg px-3" placeholder="Enter category"/>
    </div>

    <!-- Pay Range -->
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
