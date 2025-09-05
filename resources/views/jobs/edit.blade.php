@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Job</h2>

    <form action="{{ route('jobs.update', $job->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Title</label>
            <input type="text" name="title" value="{{ $job->title }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Description</label>
            <textarea name="description" class="form-control" required>{{ $job->description }}</textarea>
        </div>

        <div class="form-group">
            <label>Category</label>
            <input type="text" name="category" value="{{ $job->category }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Pay</label>
            <input type="number" name="pay" value="{{ $job->pay }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Date & Time</label>
            <input type="datetime-local" name="date_time" value="{{ $job->date_time }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Duration</label>
            <input type="text" name="duration" value="{{ $job->duration }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Location</label>
            <input type="text" name="location" value="{{ $job->location }}" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Update Job</button>
    </form>
</div>
@endsection
