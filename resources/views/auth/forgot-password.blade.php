<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="FreelanHub - Job Board & Freelance Marketplace" />
    <title>FreelanHub - Forgot Password</title>
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
        <div class="content sm:w-[448px] w-full bg-white dark:bg-gray-800 shadow-lg rounded-2xl p-8 relative">

            <!-- Back Arrow -->
            <div class="absolute top-4 left-4">
                <a href="{{ route('login') }}" class="text-gray-600 hover:text-blue-600 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                    </svg>
                    <span class="text-base font-medium">Back</span>
                </a>
            </div>

            <!-- Heading -->
            <h3 class="text-center text-2xl font-semibold text-gray-800 dark:text-gray-100">Forgot Password</h3>

            <!-- Form -->
            <form class="mt-6" method="POST" action="{{ route('password.email') }}">
                @csrf

                <!-- Email -->
                <div class="form-group">
                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email*</label>
                    <input id="email"
                           type="text"
                           name="email"
                           value="{{ old('email') }}"
                           class="w-full mt-2 border border-gray-300 dark:border-gray-600 px-4 h-[50px] rounded-lg focus:ring-2 focus:ring-primary focus:outline-none dark:bg-gray-700 dark:text-white"
                           placeholder="Enter your email"
                           required autofocus />
                </div>

                  
                 <!-- Success Message -->
               @if (session('status'))
               <div class="mt-4 p-3 text-sm text-black bg-green border border-black rounded-lg">
                   {{ session('status') }}
               </div>
           @endif

           <!-- Error Message -->
           @if ($errors->any())
               <div class="mt-4 p-3 text-sm text-white bg-red border border-red rounded-lg">
                   {{ $errors->first() }}
               </div>
           @endif



            <!-- {{ session('status') }}
             {{ $errors }} -->



                <!-- Button -->
                <div class="mt-6">
                    <button type="submit"
                            class="bg-primary text-white font-semibold py-3 px-6 rounded-lg w-full hover:bg-primary/90 transition duration-300">
                        Send Link
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
