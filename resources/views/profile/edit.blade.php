@extends('layouts.app')

@section('content')

<div class="dashboard_profile scrollbar_custom w-full bg-surface">
 <form class="container h-fit lg:pt-15 lg:pb-30 max-lg:py-12 max-sm:py-8" 
            action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
          @csrf
    <div class="heading flex flex-wrap items-center justify-between gap-4">
        <h4 class="heading4 max-lg:mt-3">My Profile</h4>
        <button class="button-main" type="submit">Save & Publish</button>
    </div>

    <div class="infomation p-8 mt-7.5 rounded-lg bg-white shadow-sm">
        <h5 class="heading5">Information</h5>
        <div class="grid sm:grid-cols-2 gap-5 mt-5">
    {{-- Profile Photo --}}
    <div class="upload_image col-span-full">
    <label for="profile_picture">Upload Avatar:</label>

    {{-- File Input (Hidden) --}}
    <input type="file" name="profile_picture" id="profile_picture" accept="image/*" class="hidden" onchange="previewImage(event)">

    <div class="flex flex-wrap items-center gap-5 mt-3">
        {{-- Circle Preview Box --}}
        <div class="bg_img flex-shrink-0 relative w-[7.5rem] h-[7.5rem] rounded-full overflow-hidden border border-dashed border-line bg-surface">
            <img id="preview-img"
                 src="{{ $user->profile_picture ? asset('storage/'.$user->profile_picture) : asset('default-avatar.png') }}"
                 class="w-full h-full object-cover">
        </div>

        {{-- Upload Info --}}
        <div>
            <strong class="text-button">Upload Avatar</strong>
            <p class="caption1 text-secondary mt-1">JPG/PNG</p>

            {{-- Styled Upload Button --}}
                    <div class="upload_file flex items-center gap-3 w-[220px] mt-3 px-3 py-2 border border-line rounded">
                        <label for="profile_picture" class="caption2 py-1 px-3 rounded bg-line whitespace-nowrap cursor-pointer">
                            Choose File
                        </label>
                    </div>
                 </div>
                 </div>
                 </div>
            </div>
            </div>

            {{-- Name --}}
            <div class="name">
                <label for="name">Name: <span class="text-red">*</span></label>
                <input name="name" value="{{ $user->name }}" 
                       class="w-full h-12 px-4 mt-2 border-line rounded-lg" 
                       id="name" type="text" placeholder="Enter your name" required />
            </div>

            {{-- Email --}}
            <div class="email_address">
                <label for="email">Email Address: <span class="text-red">*</span></label>
                <input name="email" value="{{ $user->email }}" 
                       class="w-full h-12 px-4 mt-2 border-line rounded-lg" 
                       id="email" type="email" placeholder="Enter your email" required />
            </div>

            {{-- Phone --}}
            <div class="phone_number">
                <label for="phone">Phone Number:</label>
                <input name="phone" value="{{ $user->phone }}" 
                       class="w-full h-12 px-4 mt-2 border-line rounded-lg" 
                       id="phone" type="text" placeholder="Enter your phone" />
            </div>

            {{-- Address --}}
            <div class="address col-span-full">
                <label for="address">Address:</label>
                <input name="address" value="{{ $user->address }}" 
                       class="w-full h-12 px-4 mt-2 border-line rounded-lg" 
                       id="address" type="text" placeholder="Enter your address" />
            </div>

            {{-- Bio --}}
            <div class="bio col-span-full">
                <label for="bio">Bio:</label>
                <textarea name="bio" id="bio" 
                          class="w-full h-24 px-4 mt-2 border-line rounded-lg">{{ $user->bio }}</textarea>
                    </div>
                    </div>
                </div>
 </form>
</div>

@endsection


@push('scripts')
    <!-- {{-- JS Preview --}} -->
<script>
function previewImage(event) {
    const reader = new FileReader();
    reader.onload = function() {
        const output = document.getElementById('preview');
        output.src = reader.result;
        output.classList.remove('hidden'); // agar pehle hidden hai to show kar de
    };
    reader.readAsDataURL(event.target.files[0]);
}
</script>
@endpush