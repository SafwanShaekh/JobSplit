@extends('layouts.app')

@section('content')

{{-- This new container adds the padding around all the content --}}
<div class="p-6">
    <button id="sidebar-toggle-btn" class="lg:hidden flex items-center gap-2 mb-4 ml-6 font-semibold text-gray-600">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <line x1="3" y1="12" x2="21" y2="12"></line>
            <line x1="3" y1="6" x2="21" y2="6"></line>
            <line x1="3" y1="18" x2="21" y2="18"></line>
        </svg>
        <span>Menu</span>
    </button>
    <div class="flex flex-wrap items-center justify-between gap-4">
        <h4 class="heading4" style="font-size: 40px; color: #000000ff;">My Jobs</h4>
    </div>

    <div class="mt-7.5 rounded-lg bg-white shadow-md">
        <div class="list_category flex items-center h-20 p-6 border-b border-line">
            <h1 class="font-bold">POSTED JOBS</h1>
        </div>

        <div class="list overflow-x-auto w-full p-5 rounded-xl">
            <table class="w-full min-w-[1200px]"> {{-- Increased min-width for new column --}}
                <thead class="border-b border-line">
                    <tr>
                        <th class="px-5 py-4 text-left text-sm font-bold uppercase text-secondary whitespace-nowrap">My jobs</th>
                        <th class="px-5 py-4 text-left text-sm font-bold uppercase text-secondary whitespace-nowrap">Description</th>
                        <th class="px-5 py-4 text-left text-sm font-bold uppercase text-secondary whitespace-nowrap">Category</th>
                        <th class="px-5 py-4 text-left text-sm font-bold uppercase text-secondary whitespace-nowrap">Pay</th>
                        <th class="px-5 py-4 text-left text-sm font-bold uppercase text-secondary whitespace-nowrap">Created</th>
                        <th class="px-5 py-4 text-left text-sm font-bold uppercase text-secondary whitespace-nowrap">Duration</th>
                        <th class="px-5 py-4 text-left text-sm font-bold uppercase text-secondary whitespace-nowrap">Address/Area</th>
                        
                        <th class="px-5 py-4 text-left text-sm font-bold uppercase text-secondary whitespace-nowrap">Status</th>

                        <th class="px-5 py-4 text-right text-sm font-bold uppercase text-secondary whitespace-nowrap">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($jobs as $job)
                        <tr class="item duration-300 hover:bg-background">
                            <th scope="row" class="p-5 text-left align-top">
                                <strong class="title -style-1 heading6 duration-300">{{ $job->title }}</strong>
                                <div class="address flex items-center gap-2 mt-1 text-secondary">
                                    <span class="ph ph-map-pin text-xl"></span>
                                    <span class="employers_address font-normal">{{ $job->location }}</span>
                                </div>
                            </th>
                            <td class="p-5 align-top">{{ Str::limit($job->description, 50) }}</td>
                            <td class="p-5 align-top">{{ $job->category }}</td>
                            <td class="p-5 whitespace-nowrap align-top">{{ $job->pay }}</td>
                            <td class="p-5 whitespace-nowrap align-top">{{ $job->created_at->format('d M Y') }}</td>
                            <td class="p-5 whitespace-nowrap align-top">{{ $job->duration }}</td>
                            <td class="p-5 whitespace-nowrap align-top">{{ $job->location }}</td>
                            
                            <td class="p-5 align-top">
                                @if ($job->status == 'completed')
                                    <span class="text-sm font-semibold capitalize py-2 px-4 rounded-lg bg-green-100 text-green-700">
                                        Completed
                                    </span>
                                @else
                                    <form action="{{ route('jobs.updateStatus', $job) }}" method="POST" onsubmit="return confirmStatusChange(this);">
                                        @csrf
                                        @method('PATCH')
                                        <div class="flex items-center gap-2">
                                            <select name="status" class="form-select rounded-md border-gray-300 shadow-sm text-sm" style="min-width: 150px;">
                                                <option value="open"    @if($job->status == 'open') selected @endif>Open</option>
                                                <option value="closed"  @if($job->status == 'closed') selected @endif>Closed</option>
                                                <option value="completed">Mark as Completed</option>
                                            </select>
                                            <button type="submit" class="button-main -small" style="padding: 8px 16px; font-size: 14px;">Save</button>
                                        </div>
                                    </form>
                                @endif
                            </td>

                            <td class="p-5 align-top">
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
                            <td colspan="9" class="p-5 text-center text-secondary">No jobs available</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="flex flex-wrap items-center justify-between gap-4 p-6 border-t border-line">
            <p class="text-secondary whitespace-nowrap">
                Showing {{ $jobs->firstItem() }} to {{ $jobs->lastItem() }} of {{ $jobs->total() }} entries
            </p>
            @if(view()->exists('vendor.pagination.simple-tailwind'))
                {{ $jobs->links('vendor.pagination.simple-tailwind') }}
            @else
                {{ $jobs->links() }}
            @endif
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function confirmStatusChange(form) {
        const statusDropdown = form.querySelector('select[name="status"]');
        if (statusDropdown.value === 'completed') {
            const confirmation = confirm('Marking the job as "completed" means your work is done and you can\'t reopen this job again.\n\nFor further work, post a new job.\n\nAre you sure you want to continue?');
            return confirmation;
        }
        return true;
    }
</script>
@endpush