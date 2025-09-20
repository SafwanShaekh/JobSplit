@extends('layouts.app')

@section('content')
<div class="p-6">
    {{-- Page Header --}}
    <div class="flex items-center justify-between gap-4">
        <h4 class="heading4">File a New Complaint</h4>
    </div>

    {{-- Form Card --}}
    <div class="p-8 mt-7.5 rounded-lg bg-white shadow-md">
        <h5 class="heading5 border-b border-line pb-4">Complaint Details</h5>

        {{-- Show General Errors --}}
        @if ($errors->any())
            <div class="mt-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('complaints.store') }}" method="POST" class="mt-5">
            @csrf
            
            {{-- Subject Field --}}
            <div class="mb-5">
                <label for="subject" class="text-secondary font-semibold">Subject <span class="text-red-500">*</span></label>
                <input 
                    type="text" 
                    id="subject" 
                    name="subject" 
                    class="w-full h-12 px-4 mt-2 border border-line rounded-lg focus:ring-blue-500 focus:border-blue-500"
                    value="{{ old('subject') }}" 
                    placeholder="e.g., Issue with a job posting"
                    required
                >
                @error('subject')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            {{-- Message Field --}}
            <div class="mb-5">
                <label for="message" class="text-secondary font-semibold">Describe your issue in detail <span class="text-red-500">*</span></label>
                <textarea 
                    id="message" 
                    name="message" 
                    rows="6"
                    class="w-full p-4 mt-2 border border-line rounded-lg focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Please provide as much detail as possible..."
                    required
                >{{ old('message') }}</textarea>
                @error('message')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Action Buttons --}}
            <div class="flex items-center gap-4 mt-5">
                <button type="submit" class="button-main">Submit Complaint</button>
                <a href="{{ route('complaints.index') }}" class="button-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection