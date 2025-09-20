@extends('layouts.app')

@section('content')
<div class="p-6">
    {{-- Page Header --}}
    <div class="flex flex-wrap items-center justify-between gap-4">
        <h4 class="heading4">My Complaints</h4>
        <a href="{{ route('complaints.create') }}" class="button-main">File a New Complaint</a>
    </div>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="mt-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    {{-- Complaints Table Card --}}
    <div class="mt-7.5 rounded-lg bg-white shadow-md">
        
        <div class="list overflow-x-auto w-full">
            <table class="w-full min-w-[600px]">
                {{-- Table Head --}}
                <thead class="border-b border-line">
                    <tr>
                        <th class="px-5 py-4 text-left text-sm font-bold uppercase text-secondary whitespace-nowrap">Subject</th>
                        <th class="px-5 py-4 text-left text-sm font-bold uppercase text-secondary whitespace-nowrap">Status</th>
                        <th class="px-5 py-4 text-left text-sm font-bold uppercase text-secondary whitespace-nowrap">Submitted On</th>
                    </tr>
                </thead>

                {{-- Table Body --}}
                <tbody>
                    @forelse($complaints as $complaint)
                        <tr class="duration-300 hover:bg-background border-b border-line last:border-0">
                            <td class="p-5 font-semibold text-title">{{ $complaint->subject }}</td>
                            <td class="p-5">
                                @if($complaint->status == 'resolved')
                                    <span class="px-2 py-1 text-xs font-semibold text-green-800 bg-green-100 rounded-full">Resolved</span>
                                @else
                                    <span class="px-2 py-1 text-xs font-semibold text-yellow-800 bg-yellow-100 rounded-full">Pending</span>
                                @endif
                            </td>
                            <td class="p-5 text-secondary">{{ $complaint->created_at->format('F d, Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="p-5 text-center text-secondary">You have not submitted any complaints yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination Footer --}}
        @if ($complaints->hasPages())
            <div class="flex flex-wrap items-center justify-between gap-4 p-6 border-t border-line">
                <p class="text-secondary whitespace-nowrap">
                    Showing {{ $complaints->firstItem() }} to {{ $complaints->lastItem() }} of {{ $complaints->total() }} entries
                </p>
                {{ $complaints->links() }} {{-- Make sure you have a Tailwind pagination view --}}
            </div>
        @endif

    </div>
</div>
@endsection