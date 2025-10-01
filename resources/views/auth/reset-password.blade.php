<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="FreelanHub - Job Board & Freelance Marketplace" />
    <title>FreelanHub - Reset Password</title>
    <link rel="shortcut icon" href="{{ asset('assets/images/fav.png') }}" type="image/x-icon" />
    <link rel="stylesheet" href="{{ asset('assets/css/swiper-bundle.min.css')}}" />
    <link rel="stylesheet" href="{{ asset('assets/css/leaflet.css')}}" />
    <link rel="stylesheet" href="{{ asset('assets/css/slick.css')}}" />
    <link rel="stylesheet" href="{{ asset('assets/css/style.css')}}" />
    <link rel="stylesheet" href="{{ asset('dist/output-tailwind.css')}}" />
    <link rel="stylesheet" href="{{ asset('dist/output-scss.css')}}" />
</head>

<body>
<section class="lg:py-20 sm:py-14 py-10 bg-gray-50 dark:bg-gray-900 min-h-screen flex items-center justify-center">
    <div class="container flex items-center justify-center">
        <div class="content sm:w-[448px] w-full bg-white dark:bg-gray-800 shadow-lg rounded-2xl p-8">
            
            <!-- Correct Heading -->
            <h3 class="heading3 text-center text-2xl font-semibold text-gray-800 dark:text-gray-100">Reset Password</h3>

            <!-- Form -->
            <form class="form mt-6" method="POST" action="{{ route('password.update') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">

                <!-- Email -->
                <div class="form-group">
                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email*</label>
                    <input id="email" 
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        class="form-control w-full mt-2 border border-gray-300 dark:border-gray-600 px-4 h-[50px] rounded-lg focus:ring-2 focus:ring-primary focus:outline-none dark:bg-gray-700 dark:text-white"
                         placeholder="Enter email"   required  />
                    @error('email')
                        <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Password -->
                <div class="form-group mt-6">
                    <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Password*</label>
                    <input id="password"
                        type="password" 
                        name="password"
                        class="form-control w-full mt-2 border border-gray-300 dark:border-gray-600 px-4 h-[50px] rounded-lg focus:ring-2 focus:ring-primary focus:outline-none dark:bg-gray-700 dark:text-white"
                        placeholder="Enter password"
                        required />
                    @error('password')
                        <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Password Confirmation -->
                <div class="form-group mt-6">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Confirm Password*</label>
                    <input id="password_confirmation"
                        type="password" 
                        name="password_confirmation"
                        class="form-control w-full mt-2 border border-gray-300 dark:border-gray-600 px-4 h-[50px] rounded-lg focus:ring-2 focus:ring-primary focus:outline-none dark:bg-gray-700 dark:text-white"
                        placeholder="Re-enter password"
                        required />
                    @if ($errors->has('password_confirmation'))
                        <span class="text-red-500 text-xs mt-1">{{ $errors->first('password_confirmation') }}</span>
                    @endif
                </div>

                  <div class="flex items-center justify-between mt-6 text-sm">
                    <div class="flex items-center gap-2">
                        <input id="checkbox" type="checkbox" name="remember" class="rounded text-primary dark:bg-gray-700"/>
                        <label for="checkbox" class="text-gray-600 dark:text-gray-300">Remember me</label>
                    </div>
                </div>
                <!-- Submit Button -->
                <div class="mt-6">
                    <button type="submit" class="bg-primary text-white font-semibold py-3 px-6 rounded-lg w-full hover:bg-primary/90 transition duration-300">
                        Reset Password
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>

<script src="{{ asset('assets/js/jquery.min.js')}}"></script>
<script src="{{ asset('assets/js/phosphor-icons.js')}}"></script>
<script src="{{ asset('assets/js/slick.min.js')}}"></script>
<script src="{{ asset('assets/js/leaflet.js')}}"></script>
<script src="{{ asset('assets/js/swiper-bundle.min.js')}}"></script>
<script src="{{ asset('assets/js/main.js')}}"></script>
</body>
</html>
