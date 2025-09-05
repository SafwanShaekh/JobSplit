@extends('layouts.app')

@section('content')
<div class="dashboard_project scrollbar_custom w-full bg-surface">
    <form action="{{ route('jobs.store') }}" method="POST" class="container h-fit lg:pt-15 lg:pb-30 max-lg:py-12 max-sm:py-8">
        @csrf
        <div class="flex flex-wrap items-center justify-between gap-4">
            <h4 class="heading4  max-lg:mt-3"style="font-size: 40px; color: #1b4cecff;">Submit Job</h4>
            <button class="button-main heading4" type="submit">Save & Publish</button>
        </div>

        <div class="infomation p-8 mt-7.5 rounded-lg bg-white">
            <h5 class="heading5">Information</h5>
            <div class="form grid sm:grid-cols-2 gap-5 mt-5">
                
                <!-- Job Title -->
                <div class="title">
                    <label for="title">Title: <span class="text-red">*</span></label>
                    <input name="title" id="title" type="text"
                           class="w-full h-12 px-4 mt-2 border-line rounded-lg"
                           placeholder="Title..." value="{{ old('title') }}" required />
                </div>

                <!-- Job Description -->
                <div class="description">
                    <label for="description">Description: <span class="text-red">*</span></label>
                    <input name="description" id="description"
                              class="w-full h-12 px-4 mt-2 border-line rounded-lg"
                              placeholder="Description..." value="{{ old('description') }}" required/>
                </div>

                <!-- Job Category -->
                <div class="categories">
                    <label for="category">Categories: <span class="text-red">*</span></label>
                    <input name="category" id="category" type="text"
                           class="w-full h-12 px-4 mt-2 border-line rounded-lg"
                           placeholder="Category..." value="{{ old('category') }}" required />
                </div>

                <!-- Pay -->
                <div class="pay">
                    <label for="pay">Budget <span class="text-red">*</span></label>
                    <input name="pay" id="pay" type="number" step="0.01"
                           class="w-full h-12 px-4 mt-2 border-line rounded-lg uppercase"
                           placeholder="RS." value="{{ old('pay') }}" required />
                </div>

                <!-- Location -->
                <div class="location">
                    <label for="location">Location/Address <span class="text-red">*</span></label>
                    <input name="location" id="location" type="text"
                           class="w-full h-12 px-4 mt-2 border-line rounded-lg uppercase"
                           placeholder="Location..." value="{{ old('location') }}" required />
                </div>

                <!-- Date/Time -->
                <div class="created">
                    <label for="date_time">Created <span class="text-red">*</span></label><br>
                    <input name="date_time" id="date_time" type="datetime-local"
                           class="form-control w-full h-12 px-4 mt-2 border-line rounded-lg uppercase"
                           value="{{ old('date_time') }}" required />
                </div>

                <!-- Duration -->
                <div class="duration">
                    <label for="duration">Duration: <span class="text-red">*</span></label>
                    <input name="duration" id="duration" type="text"
                           class="w-full h-12 px-4 mt-2 border-line rounded-lg uppercase"
                           placeholder="Type job duration" value="{{ old('duration') }}" required />
                </div>

            </div>
        </div>
    </form>
</div>
@endsection
