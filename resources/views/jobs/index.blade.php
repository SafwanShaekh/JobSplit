@extends('layouts.app')

@section('content')
<div class="flex flex-wrap items-center justify-between gap-4">
    <h4 class="heading4 max-lg:mt-3" style="font-size: 40px; color: #1b4cecff;">My Jobs</h4>
    <a href="{{ route('jobs.create') }}" class="button-main heading4">Submit new Job</a>
</div>

<div class="mt-7.5 rounded-lg bg-white">
    <div class="list_category flex items-center h-20 p-6 border-b border-line">
        <div class="menu_tab overflow-unset max-w-none">
            <ul class="menu flex gap-7" role="tablist">
                <li class="indicator absolute bottom-0 h-0.5 bg-primary rounded-full duration-300"></li>
                <li class="tab_item" role="presentation">
                    <h1 class="font-bold ">POSTED JOBS</h1>
                </li>
            </ul>
        </div>
    </div>

    <div id="posted_jobs01" class="tab_list active" role="tabpanel" aria-labelledby="posted_jobs_tab01" aria-hidden="false">
        <div class="list overflow-x-auto w-full p-5 rounded-xl">
            <table class="w-full max-[1400px]:w-[1200px] max-md:w-[1000px]">
                <thead class="border-b border-line">
                    <tr>
                        <th class="px-5 py-4 text-left text-sm font-bold uppercase text-secondary whitespace-nowrap">My jobs</th>
                        <th class="px-5 py-4 text-left text-sm font-bold uppercase text-secondary whitespace-nowrap">Description</th>
                        <th class="px-5 py-4 text-left text-sm font-bold uppercase text-secondary whitespace-nowrap">Category</th>
                        <th class="px-5 py-4 text-left text-sm font-bold uppercase text-secondary whitespace-nowrap">Pay</th>
                        <th class="px-5 py-4 text-left text-sm font-bold uppercase text-secondary whitespace-nowrap">Created</th>
                        <th class="px-5 py-4 text-left text-sm font-bold uppercase text-secondary whitespace-nowrap">Duration</th>
                        <th class="px-5 py-4 text-left text-sm font-bold uppercase text-secondary whitespace-nowrap">Location</th>
                        <th class="px-5 py-4 text-right text-sm font-bold uppercase text-secondary whitespace-nowrap">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($jobs as $job)
                        <tr class="item duration-300 hover:bg-background">
                            <!-- Job Title -->
                            <th scope="row" class="p-5 text-left">
                               
                                    <strong class="title -style-1 heading6 duration-300">
                                        {{ $job->title }}
                                    </strong>
                                    <div class="address flex items-center gap-2 mt-1 text-secondary">
                                        <span class="ph ph-map-pin text-xl"></span>
                                        <span class="employers_address font-normal">{{ $job->location }}</span>
                                    </div>
                    
                            </th>

                            <!-- Description -->
                            <td class="p-5">
                                {{ Str::limit($job->description, 80) }}
                            </td>

                            <!-- Category -->
                            <td class="p-5">
                                <span class="tag bg-opacity-10 bg-success text-success text-button">
                                    {{ $job->category }}
                                </span>
                            </td>

                            <!-- Pay -->
                            <td class="p-5 whitespace-nowrap">{{ $job->pay }}</td>

                            <!-- Created -->
                            <td class="p-5 whitespace-nowrap">{{ $job->created_at->format('d M Y') }}</td>

                            <!-- Duration -->
                            <td class="p-5 whitespace-nowrap">{{ $job->duration }}</td>

                            <!-- Location -->
                            <td class="p-5 whitespace-nowrap">{{ $job->location }}</td>

                            <!-- Actions -->
                            <td class="p-5">
                                <div class="flex justify-end gap-2">
                                    <!-- Edit -->
                                    <a href="{{ route('jobs.edit', $job->id) }}"
                                       class="btn_action btn_edit_job flex items-center justify-center relative w-10 h-10 rounded border border-line duration-300 hover:bg-primary hover:text-white">
                                        <span class="ph ph-pencil-simple-line text-xl"></span>
                                    </a>

                                    <!-- Delete -->
                                    <form action="{{ route('jobs.destroy', $job->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            onclick="return confirm('Are you sure you want to delete this job?')"
                                            class="btn_action flex items-center justify-center relative w-10 h-10 rounded border border-line duration-300 hover:bg-primary hover:text-white">
                                            <span class="ph ph-trash text-xl"></span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="p-5 text-center text-secondary">No jobs available</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    <!-- Pagination -->
    <div class="flex flex-wrap items-center justify-between gap-4 p-6 border-t border-line">
        <ul class="list_pagination menu_tab flex items-center justify-center gap-2">
        {{-- Previous Button --}}
        @if($jobs->onFirstPage())
            <li>
                <span class="tab_btn -fill flex items-center justify-center w-10 h-10 rounded border border-line text-gray-400 cursor-not-allowed">&lt;</span>
            </li>
        @else
            <li>
                <a href="{{ $jobs->previousPageUrl() }}" 
                   class="tab_btn -fill flex items-center justify-center w-10 h-10 rounded border border-line text-title duration-300 hover:border-black">&lt;</a>
            </li>
        @endif

        {{-- Page Numbers --}}
        @for ($i = 1; $i <= $jobs->lastPage(); $i++)
            <li>
                <a href="{{ $jobs->url($i) }}"
                   class="tab_btn -fill flex items-center justify-center w-10 h-10 rounded border border-line text-title duration-300 hover:border-black {{ $jobs->currentPage() == $i ? 'active' : '' }}">
                    {{ $i }}
                </a>
            </li>
        @endfor

        {{-- Next Button --}}
        @if($jobs->hasMorePages())
            <li>
                <a href="{{ $jobs->nextPageUrl() }}"
                   class="tab_btn -fill flex items-center justify-center w-10 h-10 rounded border border-line text-title duration-300 hover:border-black">&gt;</a>
            </li>
        @else
            <li>
                <span class="tab_btn -fill flex items-center justify-center w-10 h-10 rounded border border-line text-gray-400 cursor-not-allowed">&gt;</span>
            </li>
        @endif
        </ul>

    {{-- Entries Info --}}
     <p class="text-secondary whitespace-nowrap">
        Showing {{ $jobs->firstItem() }} to {{ $jobs->lastItem() }} of {{ $jobs->total() }} entries
     </p>
    </div>
</div>
@endsection
