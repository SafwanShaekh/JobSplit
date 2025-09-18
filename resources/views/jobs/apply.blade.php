@extends('layouts.public')

@section('content')

<div class="p-6 mt-10">
    <form action="{{ route('jobs.apply.store', $job->id) }}" method="POST">
        @csrf

        <div class="mt-10">
            <h4 class="text-3xl font-bold text-gray-800">Apply for: {{ $job->title }}</h4>
            <p class="mt-1 text-gray-500">at {{ $job->location }}</p>
        </div>

        <div class="bg-white p-8 rounded-lg shadow-md">
            
            <div class="grid grid-cols-1 gap-8">
                
                <div>
                    <label for="bid_amount" class="block text-sm font-medium text-gray-700">Your Bid Amount <span class="text-red-500">*</span></label>
                    <div class="relative mt-1">
                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                            <span class="text-gray-500 sm:text-sm">RS.</span>
                        </div>
                        <input type="number" name="bid_amount" id="bid_amount" value="{{ old('bid_amount') }}"
                               class="block w-full rounded-md border-gray-300 shadow-sm pl-10 h-12" 
                               placeholder="2500" required>
                    </div>
                    @error('bid_amount')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="work_description" class="block text-sm font-medium text-gray-700">Describe Your Approach <span class="text-red-500">*</span></label>
                    <textarea name="work_description" id="work_description" rows="6"
                              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" 
                              placeholder="Explain why you are the best fit for this job..." required>{{ old('work_description') }}</textarea>
                    @error('work_description')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

            </div>

            <div class="flex justify-end gap-4 mt-8 pt-6 border-t border-gray-200">
                <a href="{{ route('jobs.browse') }}" class="button-secondary mt-3"><b> Cancel </b></a>
                <button type="submit" class="button-main">Submit Application</button>
            </div>
        </div>
    </form>
</div>

@endsection