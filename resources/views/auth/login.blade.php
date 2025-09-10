<!DOCTYPE html>
<html lang="en">
    
<!-- Mirrored from freelanhub.vercel.app/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 17 Aug 2025 10:58:15 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
<head>
    <link rel="stylesheet" href="{{ asset('assets/bootstrap.min.css') }}">
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="description" content="FreelanHub - Job Board & Freelance Marketplace" />
        <title>FreelanHub - Job Board & Freelance Marketplace</title>
        <link rel="shortcut icon" href="/public/assets/images/fav.png" type="image/x-icon" />
        <link rel="stylesheet" href="{{ asset('assets/css/swiper-bundle.min.css')}}" />
        <link rel="stylesheet" href="{{ asset('assets/css/leaflet.css')}}" />
        <link rel="stylesheet" href="{{ asset('assets/css/slick.css')}}" />
        <link rel="stylesheet" href="{{ asset('assets/css/style.css')}}" />
        <link rel="stylesheet" href="{{ asset('dist/output-tailwind.css')}}" />
        <link rel="stylesheet" href="{{ asset('dist/output-scss.css')}}" />
    </head>


    <body>
      

        <!-- Form Login -->
<section class="lg:py-20 sm:py-14 py-10 bg-gray-50 dark:bg-gray-900 min-h-screen flex items-center justify-center">
    <div class="container flex items-center justify-center">
        <div class="content sm:w-[448px] w-full bg-white dark:bg-gray-800 shadow-lg rounded-2xl p-8">
            
            <!-- Heading -->
            <h3 class="heading3 text-center text-2xl font-semibold text-gray-800 dark:text-gray-100">Log In</h3>

            <!-- Form -->
            <form class="form mt-6" method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email / Phone -->
                <div class="form-group">
                    <label for="username" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email or Phone*</label>
                    <input id="username" 
                        type="text"
                        name="login"
                        value="{{ old('login') }}"
                        class="form-control w-full mt-2 border border-gray-300 dark:border-gray-600 px-4 h-[50px] rounded-lg focus:ring-2 focus:ring-primary focus:outline-none dark:bg-gray-700 dark:text-white"
                        placeholder="Enter email or phone number"
                        required autofocus/>
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
                </div>

                <!-- Remember + Forgot -->
                <div class="flex items-center justify-between mt-6 text-sm">
                    <div class="flex items-center gap-2">
                        <input id="checkbox" type="checkbox" name="remember" class="rounded text-primary dark:bg-gray-700"/>
                        <label for="checkbox" class="text-gray-600 dark:text-gray-300">Remember me</label>
                    </div>
                    <a class="text-primary hover:underline" href="#">Forgot password?</a>
                </div>

                <!-- Login Button -->
                <div class="mt-6">
                    <button class="bg-primary text-white font-semibold py-3 px-6 rounded-lg w-full hover:bg-primary/90 transition duration-300" type="submit">
                        Login
                    </button>
                </div>

                <!-- Register Redirect -->
                <div class="flex items-center justify-center gap-2 mt-6 text-sm">
                    <span class="text-gray-600 dark:text-gray-300">Not registered yet?</span>
                    <a class="text-primary font-medium hover:underline" href="{{ route('register') }}">Sign Up</a>
                </div>

                <!-- OR Divider -->
                <div class="relative text-center py-6">
                    <span class="px-4 bg-white dark:bg-gray-800 text-gray-500 dark:text-gray-400">or sign in with</span>
                    <div class="absolute top-1/2 left-0 w-full h-px bg-gray-300 dark:bg-gray-600 -z-10"></div>
                </div>

                <!-- Social Login -->
                <div class="grid sm:grid-cols-3 gap-3">
                    <a class="bg-gray-100 dark:bg-gray-700 h-12 flex items-center justify-center gap-3 rounded-lg border border-gray-300 dark:border-gray-600 hover:bg-black hover:text-white transition" href="#!">
                        <span class="ph-fill ph-facebook-logo text-[#3B5998] text-2xl"></span>
                        <strong class="text-sm">Facebook</strong>
                    </a>
                    <a class="bg-gray-100 dark:bg-gray-700 h-12 flex items-center justify-center gap-3 rounded-lg border border-gray-300 dark:border-gray-600 hover:bg-black hover:text-white transition" href="#!">
                        <span class="ph ph-google-logo text-[#FF4B26] text-2xl"></span>
                        <strong class="text-sm">Google</strong>
                    </a>
                    <a class="bg-gray-100 dark:bg-gray-700 h-12 flex items-center justify-center gap-3 rounded-lg border border-gray-300 dark:border-gray-600 hover:bg-black hover:text-white transition" href="#!">
                        <span class="ph ph-x-logo text-2xl"></span>
                        <strong class="text-sm">Twitter</strong>
                    </a>
                </div>
            </form>
        </div>
    </div>
</section>



        <!-- Menu mobile -->
        <div class="menu_mobile">
            <button class="menu_mobile_close flex items-center justify-center absolute top-5 left-5 w-8 h-8 rounded-full bg-surface">
                <span class="ph-bold ph-x"></span>
            </button>
            <div class="heading flex items-center justify-center mt-5">
                <a href="index-2.html" class="logo">
                    <img src="assets/images/logo.png" alt="logo" class="h-8" />
                </a>
            </div>
            <form class="form-search relative mt-4 mx-5">
                <button class="absolute left-3 top-1/2 -translate-y-1/2 cursor-pointer">
                    <i class="ph ph-magnifying-glass text-xl block"></i>
                </button>
                <input type="text" placeholder="What are you looking for?" class="h-12 rounded-lg border border-line text-sm w-full pl-10 pr-4" required />
            </form>
            <div class="mt-4">
                <ul class="nav_mobile">
                    <li class="nav_item py-2">
                        <a href="#!" class="text-xl font-semibold flex items-center justify-between">
                            Homepages
                            <span class="text-right">
                                <i class="ph ph-caret-right text-xl"></i>
                            </span>
                        </a>
                        <div class="sub_nav_mobile">
                            <button class="back_btn flex items-center gap-3">
                                <i class="ph ph-caret-left text-xl"></i>
                                Back
                            </button>
                            <div class="list-nav-item w-full pt-2 pb-6">
                                <ul>
                                    <li class="nav_item">
                                        <a href="index-2.html" class="inline-block text-xl font-semibold py-2 capitalize"> Home Freelancer 01 </a>
                                    </li>
                                    <li class="nav_item">
                                        <a href="freelancer2.html" class="inline-block text-xl font-semibold py-2 capitalize"> Home Freelancer 02 </a>
                                    </li>
                                    <li class="nav_item">
                                        <a href="freelancer3.html" class="inline-block text-xl font-semibold py-2 capitalize"> Home Freelancer 03 </a>
                                    </li>
                                    <li class="nav_item">
                                        <a href="freelancer4.html" class="inline-block text-xl font-semibold py-2 capitalize"> Home Freelancer 04 </a>
                                    </li>
                                    <li class="nav_item">
                                        <a href="freelancer5.html" class="inline-block text-xl font-semibold py-2 capitalize"> Home Freelancer 05 </a>
                                    </li>
                                    <li class="nav_item">
                                        <a href="freelancer6.html" class="inline-block text-xl font-semibold py-2 capitalize"> Home Freelancer 06 </a>
                                    </li>
                                    <li class="nav_item">
                                        <a href="freelancer7.html" class="inline-block text-xl font-semibold py-2 capitalize"> Home Freelancer 07 </a>
                                    </li>
                                    <li class="nav_item">
                                        <a href="freelancer8.html" class="inline-block text-xl font-semibold py-2 capitalize"> Home Freelancer 08 </a>
                                    </li>
                                    <li class="nav_item">
                                        <a href="jobs9.html" class="inline-block text-xl font-semibold py-2 capitalize"> Home Jobs 09 </a>
                                    </li>
                                    <li class="nav_item">
                                        <a href="jobs10.html" class="inline-block text-xl font-semibold py-2 capitalize"> Home Jobs 10 </a>
                                    </li>
                                    <li class="nav_item">
                                        <a href="jobs11.html" class="inline-block text-xl font-semibold py-2 capitalize"> Home Jobs 11 </a>
                                    </li>
                                    <li class="nav_item">
                                        <a href="jobs12.html" class="inline-block text-xl font-semibold py-2 capitalize"> Home Jobs 12 </a>
                                    </li>
                                    <li class="nav_item">
                                        <a href="rtl13.html" class="inline-block text-xl font-semibold py-2 capitalize"> Home RTL 13 </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li class="nav_item py-2">
                        <a href="#!" class="text-xl font-semibold flex items-center justify-between">
                            For Candidates
                            <span class="text-right">
                                <i class="ph ph-caret-right text-xl"></i>
                            </span>
                        </a>
                        <div class="sub_nav_mobile">
                            <button class="back_btn flex items-center gap-3">
                                <i class="ph ph-caret-left text-xl"></i>
                                Back
                            </button>
                            <div class="list-nav-item w-full pt-2 pb-6">
                                <ul>
                                    <li class="nav_item">
                                        <a href="#!" class="link flex items-center justify-between w-full py-2 text-xl font-semibold capitalize">
                                            Browse jobs
                                            <span class="text-right">
                                                <i class="ph ph-caret-right text-xl"></i>
                                            </span>
                                        </a>
                                        <div class="sub_nav_mobile2">
                                            <button class="back_btn flex items-center gap-3">
                                                <i class="ph ph-caret-left text-xl"></i>
                                                Back
                                            </button>
                                            <div class="list-nav-item w-full pt-2 pb-6">
                                                <ul>
                                                    <li class="nav_item">
                                                        <a href="jobs-default.html" class="inline-block text-xl font-semibold py-2 capitalize"> jobs default </a>
                                                    </li>
                                                    <li class="nav_item">
                                                        <a href="jobs-grid.html" class="inline-block text-xl font-semibold py-2 capitalize"> jobs grid </a>
                                                    </li>
                                                    <li class="nav_item">
                                                        <a href="jobs-list.html" class="inline-block text-xl font-semibold py-2 capitalize"> jobs list </a>
                                                    </li>
                                                    <li class="nav_item">
                                                        <a href="jobs-top-map.html" class="inline-block text-xl font-semibold py-2 capitalize"> jobs top map </a>
                                                    </li>
                                                    <li class="nav_item">
                                                        <a href="jobs-half-map-grid1.html" class="inline-block text-xl font-semibold py-2 capitalize"> jobs half map grid 1 </a>
                                                    </li>
                                                    <li class="nav_item">
                                                        <a href="jobs-half-map-grid2.html" class="inline-block text-xl font-semibold py-2 capitalize"> jobs half map grid 2 </a>
                                                    </li>
                                                    <li class="nav_item">
                                                        <a href="jobs-fullwidth.html" class="inline-block text-xl font-semibold py-2 capitalize"> jobs fullwidth </a>
                                                    </li>
                                                    <li class="nav_item">
                                                        <a href="jobs-detail1.html" class="inline-block text-xl font-semibold py-2 capitalize"> jobs detail 1 </a>
                                                    </li>
                                                    <li class="nav_item">
                                                        <a href="jobs-detail2.html" class="inline-block text-xl font-semibold py-2 capitalize"> jobs detail 2 </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="nav_item">
                                        <a href="#!" class="link flex items-center justify-between w-full py-2 text-xl font-semibold capitalize">
                                            Browse Projects
                                            <span class="text-right">
                                                <i class="ph ph-caret-right text-xl"></i>
                                            </span>
                                        </a>
                                        <div class="sub_nav_mobile2">
                                            <button class="back_btn flex items-center gap-3">
                                                <i class="ph ph-caret-left text-xl"></i>
                                                Back
                                            </button>
                                            <div class="list-nav-item w-full pt-2 pb-6">
                                                <ul>
                                                    <li class="nav_item">
                                                        <a href="project-default.html" class="inline-block text-xl font-semibold py-2 capitalize"> project default </a>
                                                    </li>
                                                    <li class="nav_item">
                                                        <a href="project-grid-3col.html" class="inline-block text-xl font-semibold py-2 capitalize"> project grid 3 columns </a>
                                                    </li>
                                                    <li class="nav_item">
                                                        <a href="project-list.html" class="inline-block text-xl font-semibold py-2 capitalize"> project list </a>
                                                    </li>
                                                    <li class="nav_item">
                                                        <a href="project-top-map-grid.html" class="inline-block text-xl font-semibold py-2 capitalize"> project top map grid </a>
                                                    </li>
                                                    <li class="nav_item">
                                                        <a href="project-top-map-list.html" class="inline-block text-xl font-semibold py-2 capitalize"> project top map list </a>
                                                    </li>
                                                    <li class="nav_item">
                                                        <a href="project-half-map-grid.html" class="inline-block text-xl font-semibold py-2 capitalize"> project half map grid </a>
                                                    </li>
                                                    <li class="nav_item">
                                                        <a href="project-half-map-list.html" class="inline-block text-xl font-semibold py-2 capitalize"> project half map list </a>
                                                    </li>
                                                    <li class="nav_item">
                                                        <a href="project-fullwidth.html" class="inline-block text-xl font-semibold py-2 capitalize"> project fullwidth </a>
                                                    </li>
                                                    <li class="nav_item">
                                                        <a href="project-detail1.html" class="inline-block text-xl font-semibold py-2 capitalize"> project detail 1 </a>
                                                    </li>
                                                    <li class="nav_item">
                                                        <a href="project-detail2.html" class="inline-block text-xl font-semibold py-2 capitalize"> project detail 2 </a>
                                                    </li>
                                                    <li class="nav_item">
                                                        <a href="project-detail3.html" class="inline-block text-xl font-semibold py-2 capitalize"> project detail 3 </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="nav_item">
                                        <a href="#!" class="link flex items-center justify-between w-full py-2 text-xl font-semibold capitalize">
                                            Browse Employer
                                            <span class="text-right">
                                                <i class="ph ph-caret-right text-xl"></i>
                                            </span>
                                        </a>
                                        <div class="sub_nav_mobile2">
                                            <button class="back_btn flex items-center gap-3">
                                                <i class="ph ph-caret-left text-xl"></i>
                                                Back
                                            </button>
                                            <div class="list-nav-item w-full pt-2 pb-6">
                                                <ul>
                                                    <li class="nav_item">
                                                        <a href="employers-default.html" class="inline-block text-xl font-semibold py-2 capitalize"> employers default </a>
                                                    </li>
                                                    <li class="nav_item">
                                                        <a href="employers-grid.html" class="inline-block text-xl font-semibold py-2 capitalize"> employers grid </a>
                                                    </li>
                                                    <li class="nav_item">
                                                        <a href="employers-list.html" class="inline-block text-xl font-semibold py-2 capitalize"> employers list </a>
                                                    </li>
                                                    <li class="nav_item">
                                                        <a href="employers-sidebar-grid-3cols.html" class="inline-block text-xl font-semibold py-2 capitalize"> employers sidebar grid 3 cols </a>
                                                    </li>
                                                    <li class="nav_item">
                                                        <a href="employers-sidebar-grid-2cols.html" class="inline-block text-xl font-semibold py-2 capitalize"> employers sidebar grid 2 cols </a>
                                                    </li>
                                                    <li class="nav_item">
                                                        <a href="employers-sidebar-list.html" class="inline-block text-xl font-semibold py-2 capitalize"> employers sidebar list </a>
                                                    </li>
                                                    <li class="nav_item">
                                                        <a href="employers-top-map-grid.html" class="inline-block text-xl font-semibold py-2 capitalize"> employers top map grid </a>
                                                    </li>
                                                    <li class="nav_item">
                                                        <a href="employers-top-map-list.html" class="inline-block text-xl font-semibold py-2 capitalize"> employers top map list </a>
                                                    </li>
                                                    <li class="nav_item">
                                                        <a href="employers-half-map-grid.html" class="inline-block text-xl font-semibold py-2 capitalize"> employers half map grid </a>
                                                    </li>
                                                    <li class="nav_item">
                                                        <a href="employers-half-map-list.html" class="inline-block text-xl font-semibold py-2 capitalize"> employers half map list </a>
                                                    </li>
                                                    <li class="nav_item">
                                                        <a href="employers-fullwidth.html" class="inline-block text-xl font-semibold py-2 capitalize"> employers fullwidth </a>
                                                    </li>
                                                    <li class="nav_item">
                                                        <a href="employers-detail1.html" class="inline-block text-xl font-semibold py-2 capitalize"> employers detail 1 </a>
                                                    </li>
                                                    <li class="nav_item">
                                                        <a href="employers-detail2.html" class="inline-block text-xl font-semibold py-2 capitalize"> employers detail 2 </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="nav_item">
                                        <a href="become-seller.html" class="link flex items-center justify-between w-full py-2 text-xl font-semibold capitalize"> Become a seller </a>
                                    </li>
                                    <li class="nav_item">
                                        <a href="candidates-dashboard.html" class="link flex items-center justify-between w-full py-2 text-xl font-semibold capitalize"> Candidates Dashboard </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li class="nav_item py-2">
                        <a href="#!" class="text-xl font-semibold flex items-center justify-between">
                            For Employers
                            <span class="text-right">
                                <i class="ph ph-caret-right text-xl"></i>
                            </span>
                        </a>
                        <div class="sub_nav_mobile">
                            <button class="back_btn flex items-center gap-3">
                                <i class="ph ph-caret-left text-xl"></i>
                                Back
                            </button>
                            <div class="list-nav-item w-full pt-2 pb-6">
                                <ul>
                                    <li class="nav_item">
                                        <a href="#!" class="link flex items-center justify-between w-full py-2 text-xl font-semibold capitalize">
                                            Browse services
                                            <span class="text-right">
                                                <i class="ph ph-caret-right text-xl"></i>
                                            </span>
                                        </a>
                                        <div class="sub_nav_mobile2">
                                            <button class="back_btn flex items-center gap-3">
                                                <i class="ph ph-caret-left text-xl"></i>
                                                Back
                                            </button>
                                            <div class="list-nav-item w-full pt-2 pb-6">
                                                <ul>
                                                    <li class="nav_item">
                                                        <a href="services-default.html" class="inline-block text-xl font-semibold py-2 capitalize"> services default </a>
                                                    </li>
                                                    <li class="nav_item">
                                                        <a href="services-grid.html" class="inline-block text-xl font-semibold py-2 capitalize"> services grid </a>
                                                    </li>
                                                    <li class="nav_item">
                                                        <a href="services-list.html" class="inline-block text-xl font-semibold py-2 capitalize"> services list </a>
                                                    </li>
                                                    <li class="nav_item">
                                                        <a href="services-sidebar-grid-3cols.html" class="inline-block text-xl font-semibold py-2 capitalize"> services sidebar grid 3 cols </a>
                                                    </li>
                                                    <li class="nav_item">
                                                        <a href="services-sidebar-grid-2cols.html" class="inline-block text-xl font-semibold py-2 capitalize"> services sidebar grid 2 cols </a>
                                                    </li>
                                                    <li class="nav_item">
                                                        <a href="services-sidebar-list.html" class="inline-block text-xl font-semibold py-2 capitalize"> services sidebar list </a>
                                                    </li>
                                                    <li class="nav_item">
                                                        <a href="services-fullwidth-grid-5cols.html" class="inline-block text-xl font-semibold py-2 capitalize"> services fullwidth grid 5 cols </a>
                                                    </li>
                                                    <li class="nav_item">
                                                        <a href="services-fullwidth-grid-4cols.html" class="inline-block text-xl font-semibold py-2 capitalize"> services fullwidth grid 4 cols </a>
                                                    </li>
                                                    <li class="nav_item">
                                                        <a href="services-fullwidth-list.html" class="inline-block text-xl font-semibold py-2 capitalize"> services fullwidth list </a>
                                                    </li>
                                                    <li class="nav_item">
                                                        <a href="services-detail1.html" class="inline-block text-xl font-semibold py-2 capitalize"> services detail 1 </a>
                                                    </li>
                                                    <li class="nav_item">
                                                        <a href="services-detail2.html" class="inline-block text-xl font-semibold py-2 capitalize"> services detail 2 </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="nav_item">
                                        <a href="#!" class="link flex items-center justify-between w-full py-2 text-xl font-semibold capitalize">
                                            Browse candidates
                                            <span class="text-right">
                                                <i class="ph ph-caret-right text-xl"></i>
                                            </span>
                                        </a>
                                        <div class="sub_nav_mobile2">
                                            <button class="back_btn flex items-center gap-3">
                                                <i class="ph ph-caret-left text-xl"></i>
                                                Back
                                            </button>
                                            <div class="list-nav-item w-full pt-2 pb-6">
                                                <ul>
                                                    <li class="nav_item">
                                                        <a href="candidates-default.html" class="inline-block text-xl font-semibold py-2 capitalize"> candidates default </a>
                                                    </li>
                                                    <li class="nav_item">
                                                        <a href="candidates-grid.html" class="inline-block text-xl font-semibold py-2 capitalize"> candidates grid </a>
                                                    </li>
                                                    <li class="nav_item">
                                                        <a href="candidates-list.html" class="inline-block text-xl font-semibold py-2 capitalize"> candidates list </a>
                                                    </li>
                                                    <li class="nav_item">
                                                        <a href="candidates-sidebar-grid.html" class="inline-block text-xl font-semibold py-2 capitalize"> candidates sidebar grid </a>
                                                    </li>
                                                    <li class="nav_item">
                                                        <a href="candidates-sidebar-list.html" class="inline-block text-xl font-semibold py-2 capitalize"> candidates sidebar list </a>
                                                    </li>
                                                    <li class="nav_item">
                                                        <a href="candidates-top-map-grid.html" class="inline-block text-xl font-semibold py-2 capitalize"> candidates top map grid </a>
                                                    </li>
                                                    <li class="nav_item">
                                                        <a href="candidates-top-map-list.html" class="inline-block text-xl font-semibold py-2 capitalize"> candidates top map list </a>
                                                    </li>
                                                    <li class="nav_item">
                                                        <a href="candidates-half-map-grid.html" class="inline-block text-xl font-semibold py-2 capitalize"> candidates half map grid </a>
                                                    </li>
                                                    <li class="nav_item">
                                                        <a href="candidates-half-map-list.html" class="inline-block text-xl font-semibold py-2 capitalize"> candidates half map list </a>
                                                    </li>
                                                    <li class="nav_item">
                                                        <a href="candidates-fullwidth-grid.html" class="inline-block text-xl font-semibold py-2 capitalize"> candidates fullwidth grid </a>
                                                    </li>
                                                    <li class="nav_item">
                                                        <a href="candidates-fullwidth-list.html" class="inline-block text-xl font-semibold py-2 capitalize"> candidates fullwidth list </a>
                                                    </li>
                                                    <li class="nav_item">
                                                        <a href="candidates-detail1.html" class="inline-block text-xl font-semibold py-2 capitalize"> candidates detail 1 </a>
                                                    </li>
                                                    <li class="nav_item">
                                                        <a href="candidates-detail2.html" class="inline-block text-xl font-semibold py-2 capitalize"> candidates detail 2 </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="nav_item">
                                        <a href="become-buyer.html" class="link flex items-center justify-between w-full py-2 text-xl font-semibold capitalize"> Become a buyer </a>
                                    </li>
                                    <li class="nav_item">
                                        <a href="employers-dashboard.html" class="link flex items-center justify-between w-full py-2 text-xl font-semibold capitalize"> employer Dashboard </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li class="nav_item py-2">
                        <a href="#!" class="text-xl font-semibold flex items-center justify-between">
                            Blogs
                            <span class="text-right">
                                <i class="ph ph-caret-right text-xl"></i>
                            </span>
                        </a>
                        <div class="sub_nav_mobile">
                            <button class="back_btn flex items-center gap-3">
                                <i class="ph ph-caret-left text-xl"></i>
                                Back
                            </button>
                            <div class="list-nav-item w-full pt-2 pb-6">
                                <ul>
                                    <li class="nav_item">
                                        <a href="blog-default.html" class="inline-block text-xl font-semibold py-2 capitalize"> Blog default </a>
                                    </li>
                                    <li class="nav_item">
                                        <a href="blog-grid.html" class="inline-block text-xl font-semibold py-2 capitalize"> Blog grid </a>
                                    </li>
                                    <li class="nav_item">
                                        <a href="blog-list.html" class="inline-block text-xl font-semibold py-2 capitalize"> Blog list </a>
                                    </li>
                                    <li class="nav_item">
                                        <a href="blog-detail1.html" class="inline-block text-xl font-semibold py-2 capitalize"> Blog detail 1 </a>
                                    </li>
                                    <li class="nav_item">
                                        <a href="blog-detail2.html" class="inline-block text-xl font-semibold py-2 capitalize"> Blog detail 2 </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li class="nav_item py-2">
                        <a href="#!" class="text-xl font-semibold flex items-center justify-between">
                            Pages
                            <span class="text-right">
                                <i class="ph ph-caret-right text-xl"></i>
                            </span>
                        </a>
                        <div class="sub_nav_mobile">
                            <button class="back_btn flex items-center gap-3">
                                <i class="ph ph-caret-left text-xl"></i>
                                Back
                            </button>
                            <div class="list-nav-item w-full pt-2 pb-6">
                                <ul>
                                    <li class="nav_item">
                                        <a href="about1.html" class="inline-block text-xl font-semibold py-2 capitalize"> About Us 1 </a>
                                    </li>
                                    <li class="nav_item">
                                        <a href="about2.html" class="inline-block text-xl font-semibold py-2 capitalize"> About Us 2 </a>
                                    </li>
                                    <li class="nav_item">
                                        <a href="pricing.html" class="inline-block text-xl font-semibold py-2 capitalize"> Pricing Plan </a>
                                    </li>
                                    <li class="nav_item">
                                        <a href="contact1.html" class="inline-block text-xl font-semibold py-2 capitalize"> Contact Us 1 </a>
                                    </li>
                                    <li class="nav_item">
                                        <a href="contact2.html" class="inline-block text-xl font-semibold py-2 capitalize"> Contact Us 2 </a>
                                    </li>
                                    <li class="nav_item">
                                        <a href="faqs.html" class="inline-block text-xl font-semibold py-2 capitalize"> Faqs </a>
                                    </li>
                                    <li class="nav_item">
                                        <a href="term-of-use.html" class="inline-block text-xl font-semibold py-2 capitalize"> Terms of use </a>
                                    </li>
                                    <li class="nav_item">
                                        <a href="error-404.html" class="inline-block text-xl font-semibold py-2 capitalize"> Error 404 </a>
                                    </li>
                                    <li class="nav_item">
                                        <a href="login.html" class="inline-block text-xl font-semibold py-2 capitalize active"> Login </a>
                                    </li>
                                    <li class="nav_item">
                                        <a href="register.html" class="inline-block text-xl font-semibold py-2 capitalize"> Register </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

        <script src="{{ asset('assets/js/jquery.min.js')}}"></script>
        <script src="{{ asset('assets/js/phosphor-icons.js')}}"></script>
        <script src="{{ asset('assets/js/slick.min.js')}}"></script>
        <script src="{{ asset('assets/js/leaflet.js')}}"></script>
        <script src="{{ asset('assets/js/swiper-bundle.min.js')}}"></script>
        <script src="{{ asset('assets/js/main.js')}}"></script>
    </body>

<!-- Mirrored from freelanhub.vercel.app/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 17 Aug 2025 10:58:15 GMT -->
</html>
