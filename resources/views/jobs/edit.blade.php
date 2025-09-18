@extends('layouts.app')

@section('content')
<div class="dashboard_project scrollbar_custom w-full bg-surface">
    <div class="p-6">
        <form action="{{ route('jobs.update', $job->id) }}" method="POST" class="container h-fit">
            @csrf
            @method('PUT')

            <div class="flex flex-wrap items-center justify-between gap-4">
                <h4 class="heading4 max-lg:mt-3" style="font-size: 40px; color: #1b4cecff;">Edit Job</h4>
                <div class="flex gap-4">
                    <a href="{{ route('jobs.index') }}" class="button-secondary mt-3"><b> Cancel</b></a>
                    <button class="button-main heading4" type="submit">Update Job</button>
                </div>
            </div>

            <div class="infomation p-8 mt-7.5 rounded-lg bg-white shadow-md">
                <h5 class="heading5">Information</h5>
                <div class="form grid sm:grid-cols-2 gap-5 mt-5">
                    
                    <div class="title">
                        <label for="title">Title: <span class="text-red-500">*</span></label>
                        <input name="title" id="title" type="text"
                               class="w-full h-12 px-4 mt-2 border-line rounded-lg"
                               placeholder="Title..." value="{{ old('title', $job->title) }}" required />
                    </div>

                    <div class="description">
                        <label for="description">Description: <span class="text-red-500">*</span></label>
                        <input name="description" id="description" type="text"
                                  class="w-full h-12 px-4 mt-2 border-line rounded-lg"
                                  placeholder="Description..." value="{{ old('description', $job->description) }}" required/>
                    </div>

                    <div class="categories">
                        <label for="category">Categories: <span class="text-red-500">*</span></label>
                        <input name="category" id="category" type="text"
                               class="w-full h-12 px-4 mt-2 border-line rounded-lg"
                               placeholder="Category..." value="{{ old('category', $job->category) }}" required />
                    </div>

                    <div class="pay">
                        <label for="pay">Budget <span class="text-red-500">*</span></label>
                        <input name="pay" id="pay" type="number" step="0.01"
                               class="w-full h-12 px-4 mt-2 border-line rounded-lg uppercase"
                               placeholder="RS." value="{{ old('pay', $job->pay) }}" required />
                    </div>

                    <div class="location">
                        <label for="location">Location/Address <span class="text-red-500">*</span></label>
                        <input name="location" id="location" type="text"
                               class="w-full h-12 px-4 mt-2 border-line rounded-lg uppercase"
                               placeholder="Location..." value="{{ old('location', $job->location) }}" required />
                    </div>

                    <div class="created">
                        <label for="date_time">Created <span class="text-red-500">*</span></label><br>
                        <input name="date_time" id="date_time" type="datetime-local"
                               class="w-full h-12 px-4 mt-2 border-line rounded-lg uppercase"
                               value="{{ old('date_time', $job->date_time) }}" required />
                    </div>

                    <div class="duration">
                        <label for="duration">Duration: <span class="text-red-500">*</span></label>
                        <input name="duration" id="duration" type="text"
                               class="w-full h-12 px-4 mt-2 border-line rounded-lg uppercase"
                               placeholder="Type job duration" value="{{ old('duration', $job->duration) }}" required />
                    </div>

                </div>
            </div>
        </form>
    </div>
</div>
@endsection