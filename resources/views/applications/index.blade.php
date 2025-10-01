@extends('layouts.app')

@section('content')
<div class="p-6 mt-10">
    <button id="sidebar-toggle-btn" class="lg:hidden flex items-center gap-2 mb-4 ml-6 font-semibold text-gray-600">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="3" y1="12" x2="21" y2="12"></line>
                    <line x1="3" y1="6" x2="21" y2="6"></line>
                    <line x1="3" y1="18" x2="21" y2="18"></line>
                </svg>
                <span>Menu</span>
            </button>
    <h4 class="text-3xl font-bold mt-10">My Applied Jobs</h4>
    <p class="text-gray-600 mb-6">Here are all the jobs you've applied for and the status of your applications.</p>

    <div class="bg-white rounded-lg shadow-md mt-5">
        @forelse($applications as $application)
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-center p-6 border-b">
                
                {{-- Job Details --}}
                <div class="md:col-span-2">
                    <strong class="text-lg font-bold text-gray-800">{{ $application->job->title }}</strong>
                    <div class="text-sm text-gray-500 mt-1">
                        <span>{{ $application->job->location }}</span> |
                        <span>Pay: RS. {{ number_format($application->job->pay) }}</span> |
                        <span>My Bid: RS. {{ number_format($application->bid_amount) }}</span>
                    </div>
                </div>

                {{-- Application Status --}}
                {{-- Application Status and Actions --}}
                <div class="text-left md:text-right">
                    @if($application->status == 'approved')
                        {{-- If approved, show status and chat button side-by-side --}}
                        <div class="flex items-center justify-start md:justify-end gap-3">
                            <span class="text-sm font-semibold capitalize py-2 px-4 rounded-lg bg-green-100 text-green-700">
                                Status: {{ $application->status }}
                            </span>
                            <a href="{{ route('chat.with', ['user' => $application->job->user->id]) }}" class="btn btn-chat">Chat</a>
                        </div>
                    @else
                        {{-- Otherwise, just show the status --}}
                        <span class="text-sm font-semibold capitalize py-2 px-4 rounded-lg 
                            @if($application->status == 'rejected') 
                                bg-red-100 text-red-700 
                            @else 
                                bg-yellow-100 text-yellow-700 
                            @endif">
                            Status: {{ $application->status }}
                        </span>
                    @endif
                </div>

            </div>
        @empty
            <p class="p-6 text-center text-gray-500">You have not applied to any jobs yet.</p>
        @endforelse
    </div>

    {{-- Pagination Links --}}
    <div class="mt-6">
        {{ $applications->links() }}
    </div>
</div>
@endsection