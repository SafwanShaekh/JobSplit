@extends('admin.layouts.app')

@section('content')

{{-- Naye design ke liye custom CSS jo Dark/Light mode ke sath kaam karegi --}}
<style>
    .edit-job-container {
        max-width: 900px; /* Container ko thora bara kiya hai takeh 2 columns fit ho jayein */
        margin: auto;
    }
    .form-container {
        background-color: var(--card-color);
        border-radius: 12px;
        padding: 30px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        border: 1px solid var(--border-color);
    }
    .form-container h1 {
        font-weight: 600;
        font-size: 1.8rem;
        color: var(--text-color);
        margin-bottom: 2rem;
        border-bottom: 1px solid var(--border-color);
        padding-bottom: 1rem;
    }
    .form-label {
        font-weight: 500;
        color: var(--text-muted-color, #858796); /* Using theme variable */
        margin-bottom: 0.5rem;
    }
    .form-control, .form-select {
        background-color: var(--bg-color, #f8f9fc); /* Using theme variable */
        color: var(--text-color);
        border-color: var(--border-color);
        padding: 0.75rem 1rem;
        height: calc(1.5em + 1.5rem + 2px); /* Consistent height */
    }
    .form-control:focus, .form-select:focus {
        background-color: var(--bg-color);
        color: var(--text-color);
        border-color: #4e73df;
        box-shadow: 0 0 0 0.25rem rgba(78, 115, 223, 0.25);
    }
    .form-control::placeholder {
        color: #a0a0a0;
    }
    /* Required field asterisk */
    .form-label .text-danger {
        font-weight: bold;
    }
</style>

<div class="edit-job-container">
    <div class="form-container">
        <h1>Edit Job</h1>

        <form action="{{ route('admin.jobs.update', $job->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Website jaisa 2-column layout --}}
            <div class="row">
                {{-- Job Title --}}
                <div class="col-md-6 mb-3">
                    <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $job->title) }}" required>
                </div>

                {{-- Company --}}
                <div class="col-md-6 mb-3">
                    <label for="company" class="form-label">Company Name</label>
                    <input type="text" class="form-control" id="company" name="company" value="{{ old('company', $job->company) }}">
                </div>

                {{-- Category --}}
                <div class="col-md-6 mb-3">
                    <label for="category" class="form-label">Category <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="category" name="category" placeholder="e.g., Web Development" value="{{ old('category', $job->category) }}" required>
                </div>

                {{-- Pay/Budget --}}
                <div class="col-md-6 mb-3">
                    <label for="pay" class="form-label">Budget (Rs.) <span class="text-danger">*</span></label>
                    <input type="number" class="form-control" id="pay" name="pay" placeholder="e.g., 50000" value="{{ old('pay', $job->pay) }}" step="1" required>
                </div>
                
                {{-- Location --}}
                <div class="col-md-6 mb-3">
                    <label for="location" class="form-label">Location <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="location" name="location" placeholder="e.g., Karachi, Pakistan" value="{{ old('location', $job->location) }}" required>
                </div>

                {{-- Duration --}}
                <div class="col-md-6 mb-3">
                    <label for="duration" class="form-label">Duration <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="duration" name="duration" placeholder="e.g., 3 Months" value="{{ old('duration', $job->duration) }}" required>
                </div>
                
                {{-- Created Date --}}
                {{-- Note: 'datetime-local' needs value in 'Y-m-d\TH:i' format --}}
                <div class="col-md-6 mb-3">
                    <label for="date_time" class="form-label">Created Date <span class="text-danger">*</span></label>
                    <input type="datetime-local" class="form-control" id="date_time" name="date_time" value="{{ old('date_time', \Carbon\Carbon::parse($job->date_time)->format('Y-m-d\TH:i')) }}" required>
                </div>
                
                {{-- Description (full width) --}}
                <div class="col-12 mb-3">
                    <label for="description" class="form-label">Job Description <span class="text-danger">*</span></label>
                    <textarea class="form-control" id="description" name="description" rows="6" required>{{ old('description', $job->description) }}</textarea>
                </div>
            </div>

            <div class="d-flex justify-content-end gap-2 mt-4">
                <a href="{{ route('admin.jobs.show', $job->id) }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Update Job</button>
            </div>
        </form>
    </div>
</div>

@endsection