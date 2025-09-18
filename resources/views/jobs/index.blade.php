@extends('layouts.app')

@section('content')

{{-- This new container adds the padding around all the content --}}
<div class="p-6">
    <div class="flex flex-wrap items-center justify-between gap-4">
        <h4 class="heading4" style="font-size: 40px; color: #1b4cecff;">My Jobs</h4>
        <!-- <a href="{{ route('jobs.create') }}" class="button-main heading4">Submit new Job</a> -->
    </div>

    <div class="mt-7.5 rounded-lg bg-white shadow-md">
        <div class="list_category flex items-center h-20 p-6 border-b border-line">
            <h1 class="font-bold">POSTED JOBS</h1>
        </div>

        <div class="list overflow-x-auto w-full p-5 rounded-xl">
            <table class="w-full min-w-[1000px]">
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
                            <th scope="row" class="p-5 text-left">
                                <strong class="title -style-1 heading6 duration-300">{{ $job->title }}</strong>
                                <div class="address flex items-center gap-2 mt-1 text-secondary">
                                    <span class="ph ph-map-pin text-xl"></span>
                                    <span class="employers_address font-normal">{{ $job->location }}</span>
                                </div>
                            </th>
                            <td class="p-5">{{ Str::limit($job->description, 50) }}</td>
                            <td class="p-5">{{ $job->category }}</td>
                            <td class="p-5 whitespace-nowrap">{{ $job->pay }}</td>
                            <td class="p-5 whitespace-nowrap">{{ $job->created_at->format('d M Y') }}</td>
                            <td class="p-5 whitespace-nowrap">{{ $job->duration }}</td>
                            <td class="p-5 whitespace-nowrap">{{ $job->location }}</td>
                            <td class="p-5">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('jobs.edit', $job->id) }}" class="btn_action flex items-center justify-center relative w-10 h-10 rounded border border-line">
                                        <span class="ph ph-pencil-simple-line text-xl"></span>
                                    </a>
                                    <form action="{{ route('jobs.destroy', $job->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn_action flex items-center justify-center relative w-10 h-10 rounded border border-line">
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
        
        <div class="flex flex-wrap items-center justify-between gap-4 p-6 border-t border-line">
            <p class="text-secondary whitespace-nowrap">
                Showing {{ $jobs->firstItem() }} to {{ $jobs->lastItem() }} of {{ $jobs->total() }} entries
            </p>
            {{-- This checks if you have a custom pagination view, otherwise uses Laravel's default --}}
            @if(view()->exists('vendor.pagination.simple-tailwind'))
                {{ $jobs->links('vendor.pagination.simple-tailwind') }}
            @else
                {{ $jobs->links() }}
            @endif
        </div>
    </div>
</div>

@endsection