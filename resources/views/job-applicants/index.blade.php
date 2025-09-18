@extends('layouts.app')

@section('content')
<div class="p-6 mt-10">
    <h4 class="text-3xl font-bold mt-10">Job Applicants</h4>
    <div class="bg-white rounded-lg shadow-md mt-5">
        @forelse($jobs as $job)
            <div class="flex flex-wrap items-center justify-between p-6 border-b">
                <div>
                    <strong class="text-lg font-bold text-gray-800">{{ $job->title }}</strong>
                    <div class="text-sm text-gray-500 mt-1">
                        <span>{{ $job->location }}</span> |
                        <span>Created: {{ $job->created_at->format('M d, Y') }}</span> |
                        <span class="font-semibold {{ $job->status === 'open' ? 'text-green-600' : 'text-blue-600' }}">{{ ucfirst($job->status) }}</span>
                    </div>
                </div>
                <div>
                    <a href="{{ route('job-applicants.show', $job) }}" class="button-main">
                        View Applicants ({{ $job->applications_count }})
                    </a>
                </div>
            </div>
        @empty
            <p class="p-6 text-center text-gray-500">You have not posted any jobs yet.</p>
        @endforelse
    </div>
    <div class="mt-6">
        {{ $jobs->links() }}
    </div>
</div>
@endsection