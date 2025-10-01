<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>FreelanHub</title>
    {{-- Yahan aapki saari CSS files aayengi --}}
       <link rel="shortcut icon" href="{{ asset('assets/images/fav.png') }}" type="image/x-icon" />
        <link rel="stylesheet" href="{{ asset('assets/css/swiper-bundle.min.css')}}" />
        <link rel="stylesheet" href="{{ asset('assets/css/leaflet.css')}}" />
        <link rel="stylesheet" href="{{ asset('assets/css/slick.css')}}" />
        <!-- <link rel="stylesheet" href="{{ asset('assets/css/apexcharts.css')}}" /> -->
        <link rel="stylesheet" href="{{ asset('assets/css/style.css')}}" />
        <link rel="stylesheet" href="{{ asset('dist/output-tailwind.css')}}" />
        <link rel="stylesheet" href="{{ asset('dist/output-scss.css')}}"/>

          <link rel="shortcut icon" href="https://placeholder-image-service.onrender.com/image/32x32?prompt=freelanhub teal logo icon modern freelance platform&id=9211d244-69e6-4778-a6c4-00c7dd3ea933&customer_id=cus_T2zBMa6uv7QqX7" type="image/x-icon">
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">


    <!-- Optional: Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css')}}" />
    @stack('styles')

    <style>
        /* --- 1. TOGGLE SWITCH KI STYLING --- */
.theme-switch-wrapper {
    display: flex;
    align-items: center;
}
.theme-switch {
    position: relative;
    display: inline-block;
    width: 50px;
    height: 26px;
}
.theme-switch input {
    opacity: 0;
    width: 0;
    height: 0;
}
.slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ccc;
    transition: .4s;
}
.slider.round {
    border-radius: 34px;
}
.slider::before {
    position: absolute;
    content: "";
    height: 18px;
    width: 18px;
    left: 4px;
    bottom: 4px;
    background-color: white;
    transition: .4s;
    border-radius: 50%;
}
input:checked + .slider {
    background-color: #14b8a6; /* Teal Green */
}
input:checked + .slider::before {
    transform: translateX(24px);
}

/* --- 2. PURI WEBSITE KE LIYE DARK THEME STYLES --- */

/* Default (Light Mode) Colors */
body {
    background-color: #ffffff;
    color: #333333;
    transition: background-color 0.3s ease, color 0.3s ease;
}

/* Dark Mode Colors */
body.dark-mode {
    background-color: #121212; /* Dark background */
    color: #e0e0e0; /* Light text */
}

/* Headings ka color dark mode mein */
body.dark-mode h1,
body.dark-mode h2,
body.dark-mode h3,
body.dark-mode h4 {
    color: #ffffff;
}

/* Links ka color dark mode mein */
body.dark-mode a {
    color: #14b8a6; /* Teal Green */
}

/* Aapke custom cards (step-card, info-card, job-card) ke liye dark mode styles */
body.dark-mode .step-card,
body.dark-mode .info-card,
body.dark-mode .job-card {
    background: #1e1e1e;
    border-color: #2c2c2c; /* Agar border hai to */
    box-shadow: 0 5px 15px rgba(0,0,0,.2);
}

body.dark-mode .step-card p,
body.dark-mode .info-card p,
body.dark-mode .job-card p {
    color: #a0a0a0; /* Secondary text ka color */
}

/* --- HOMEPAGE KE LIYE MUKAMMAL DARK THEME STYLES --- */

/* === Body aur General Text === */
body.dark-mode {
    background-color: #111827; /* Dark Blue-Gray Background */
    color: #cbd5e1; /* Light Gray Text */
}

body.dark-mode h1,
body.dark-mode h2,
body.dark-mode h3,
body.dark-mode h4,
body.dark-mode .hero-title,
body.dark-mode .section-title {
    color: #ffffff; /* White Headings */
}

body.dark-mode .hero-subtitle,
body.dark-mode .section-subtitle,
body.dark-mode .category-count,
body.dark-mode .testimonial-card p,
body.dark-mode .blog-card p {
    color: #94a3b8; /* Lighter secondary text */
}

/* === Hero Section & Search Box === */
body.dark-mode .hero {
    background: #111827;
}

body.dark-mode .search-box {
    background: #1f2937; /* Darker box background */
    box-shadow: 0 5px 20px rgba(0,0,0,.2);
}

body.dark-mode .search-input,
body.dark-mode .search-select {
    background: #374151; /* Dark input fields */
    color: #ffffff;
    border: 1px solid #4b5563;
}
body.dark-mode .search-select {
    background: #374151;
}

/* === Categories Section === */
body.dark-mode .categories {
    background: #1f2937;
}

body.dark-mode .category-card {
    background: #111827;
    border: 1px solid #374151;
    box-shadow: 0 5px 15px rgba(0,0,0,.2);
}

/* === How it Works Section === */
body.dark-mode .how-it-works {
    background: #111827;
}

body.dark-mode .step-card {
    background: #1f2937; /* Original dark background */
    box-shadow: 0 5px 15px rgba(0,0,0,.2); /* Original shadow */
}

body.dark-mode .step-card h3,
body.dark-mode .step-card p {
    color: #cbd5e1;
}

/* === Job Cards Section === */
body.dark-mode .job-card {
    background-color: #1f2937;
    border-color: #374151; /* Default border color in dark mode */
}

body.dark-mode .job-card:hover {
    border-color: #14b8a6; /* Hover par teal border wese hi rahega */
}

body.dark-mode .job-card__title a {
    color: #ffffff;
}
body.dark-mode .job-card__company {
    color: #94a3b8;
}
body.dark-mode .job-card__meta {
    color: #cbd5e1;
}
body.dark-mode .job-card__category {
    background-color: #3730a3; /* Darker Purple */
    color: #e0e7ff;
}

/* === Companies Section === */
body.dark-mode .companies {
    background: #1f2937;
}
body.dark-mode .company-logos img {
    filter: invert(1) brightness(1.5); /* Logos ko white jaisa look dega */
    opacity: 0.6;
}
body.dark-mode .company-logos img:hover {
    opacity: 1;
}

/* === Testimonials & Blog === */
body.dark-mode .testimonials {
    background: #111827;
}
body.dark-mode .testimonial-card {
    background: #1f2937;
    box-shadow: 0 5px 15px rgba(0,0,0,.2);
}

body.dark-mode .blog {
    background: #1f2937;
}
body.dark-mode .blog-card {
    background: #111827;
    box-shadow: 0 5px 20px rgba(0,0,0,.2);
}

/* === Parallax Section === */
body.dark-mode .categories-parallax {
    background: #111827;
}
body.dark-mode .parallax-item .content-box {
    background: rgba(17, 24, 39, 0.85); /* Dark transparent background */
    backdrop-filter: blur(8px);
    -webkit-backdrop-filter: blur(8px);
}
body.dark-mode .content-box h3 {
    color: #ffffff;
}
body.dark-mode .content-box p {
    color: #cbd5e1;
}
/* Buttons ka text color dark mode mein theek karein */
body.dark-mode .search-btn,
body.dark-mode .view-all-btn,
body.dark-mode .cta button {
    color: #ffffff; /* Text ko hamesha white rakhein */
}

/* CTA button ka background bhi dark mode ke hisab se adjust karein */
body.dark-mode .cta button {
    background-color: #1f2937; /* Dark background */
    border: 1px solid var(--primary); /* Teal border */
}

body.dark-mode .cta button:hover {
    background-color: var(--primary); /* Hover par teal background */
}
/* Job Card ke button ka text color dark mode mein theek karein */
body.dark-mode .btn--apply {
    color: #ffffff;
}

/* --- ABOUT US PAGE KE LIYE MUKAMMAL DARK THEME STYLES --- */

/* === General Elements === */
body.dark-mode {
    background-color: #111827; /* Dark Blue-Gray Background */
    color: #cbd5e1; /* Light Gray Text */
}

body.dark-mode h1,
body.dark-mode h2,
body.dark-mode h3,
body.dark-mode h4,
body.dark-mode .page-header h1,
body.dark-mode .section-title {
    color: #ffffff; /* White Headings */
}

body.dark-mode p,
body.dark-mode .page-header p,
body.dark-mode .section-subtitle {
    color: #94a3b8; /* Lighter secondary text */
}

/* === Header / Navbar === */
body.dark-mode header {
    background: #1f2937;
    box-shadow: 0 2px 20px rgba(0,0,0,0.2);
}
body.dark-mode nav ul li a {
    color: #cbd5e1;
}
body.dark-mode .btn-login {
    background: #374151;
    color: #ffffff;
    border-color: #4b5563;
}
body.dark-mode .mobile-menu-toggle {
    color: #ffffff;
}
body.dark-mode nav { /* For mobile menu */
    background: #1f2937;
}


/* === Page Header === */
body.dark-mode .page-header {
    background: linear-gradient(45deg, #111827, #1e293b);
}

/* === Mission Section === */
body.dark-mode .mission-image img {
    box-shadow: 0 15px 40px rgba(0,0,0,0.3);
}

/* === Why Us & Values Section === */
body.dark-mode .why-us,
body.dark-mode .values {
    background: #1f2937;
}
body.dark-mode .feature-card {
    background: #111827;
    border: 1px solid #374151;
    box-shadow: 0 5px 20px rgba(0,0,0,0.2);
}

/* === Stats Section === */
body.dark-mode .stats {
    background: #000000; /* Darker background for stats */
}

/* === Team Section === */
body.dark-mode .team-member {
    background: #1f2937;
    box-shadow: 0 10px 30px rgba(0,0,0,0.25);
}
body.dark-mode .team-info {
    border-top: 1px solid #374151;
}

/* === CTA Section === */
/* CTA section ki styling pehle se aisi hai jo dark mode par achi lagegi, 
   lekin behtari ke liye button ko thora change kar sakte hain. */
body.dark-mode .cta .btn-cta {
    background: #111827;
    color: #ffffff;
}
body.dark-mode .cta .btn-cta:hover {
    background: #000000;
}

/* --- CONTACT US PAGE KE LIYE MUKAMMAL DARK THEME STYLES --- */

/* === General Elements === */
body.dark-mode {
    background-color: #111827; /* Dark Blue-Gray Background */
    color: #cbd5e1; /* Light Gray Text */
}

body.dark-mode h1,
body.dark-mode h2,
body.dark-mode h3,
body.dark-mode h4,
body.dark-mode .page-header h1,
body.dark-mode .section-title {
    color: #ffffff; /* White Headings */
}

body.dark-mode p,
body.dark-mode .page-header p,
body.dark-mode .section-subtitle {
    color: #94a3b8; /* Lighter secondary text */
}

/* === Header / Navbar === */
body.dark-mode header {
    background: #1f2937;
    box-shadow: 0 2px 20px rgba(0,0,0,0.2);
}
body.dark-mode nav ul li a {
    color: #cbd5e1;
}
body.dark-mode .btn-login {
    background: #374151;
    color: #ffffff;
    border-color: #4b5563;
}
body.dark-mode .mobile-menu-toggle {
    color: #ffffff;
}
body.dark-mode nav { /* For mobile menu */
    background: #1f2937;
}

/* === Page Header === */
body.dark-mode .page-header {
    background: linear-gradient(45deg, #111827, #1e293b);
}

/* === Info Cards Section === */
/* Note: Aapke info-card ki base styling dark mode par bhi achi lagegi 
   kyunke uska background pehle se light hai. Hum sirf wrapper ko adjust kareinge. */

body.dark-mode .info-card {
    background: #1f2937; /* Card ka background dark karein */
    box-shadow: 0 5px 20px rgba(0,0,0,0.2);
}

body.dark-mode .info-card-animation-wrapper {
    box-shadow: 0 0 10px rgba(20, 184, 166, 0.5); /* Glow ko dark mode mein behtar karein */
}


/* === Contact Form Section === */
body.dark-mode .contact-form {
    background: #1f2937;
    box-shadow: 0 10px 40px rgba(0,0,0,0.3);
}

body.dark-mode .input-field {
    background-color: #374151;
    border-color: #4b5563;
    color: #ffffff;
}

body.dark-mode .input-field::placeholder {
    color: #9ca3af;
}

body.dark-mode .input-field:focus {
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(0, 181, 173, 0.3);
}

/* === Map Section === */
body.dark-mode .map-container {
    box-shadow: 0 10px 40px rgba(0,0,0,0.3);
}

body.dark-mode .map-container iframe {
    /* Google Maps par dark mode apply karne ke liye invert filter istemal karein */
    filter: invert(100%) hue-rotate(180deg) brightness(95%) contrast(90%);
}
/* --- JOB VIEW PAGE KE LIYE DARK THEME STYLES --- */

/* === Breadcrumb Section (Top header part) === */
body.dark-mode .breadcrumb.bg-\[\#F9F2EC\] {
    background-color: #1a2233 !important; /* Darker background */
}
body.dark-mode .jobs_name,
body.dark-mode .price.text-title {
    color: #ffffff;
}
body.dark-mode .jobs_address,
body.dark-mode .text-secondary {
    color: #94a3b8;
}
body.dark-mode .jobs_tag.bg-white {
    background-color: #374151;
    color: #e5e7eb;
}

/* === Job Detail Section === */
body.dark-mode .jobs_detail {
    /* Yeh by default body ka dark color le lega */
}
body.dark-mode .heading6 {
    color: #ffffff;
}
body.dark-mode .list_overview .text-secondary {
    color: #94a3b8;
}
body.dark-mode .list_overview .text-button {
    color: #e5e7eb;
}
body.dark-mode .ph { /* Phosphor icons */
    color: #94a3b8;
}

/* === Sidebar "About Employer" Card === */
body.dark-mode .jobs_sidebar .bg-white {
    background-color: #1f2937 !important;
    box-shadow: 0 5px 15px rgba(0,0,0,0.2) !important;
}
body.dark-mode .jobs_sidebar .border-line {
    border-color: #374151 !important;
}
body.dark-mode .jobs_sidebar .heading6,
body.dark-mode .jobs_sidebar .text-button {
    color: #ffffff;
}
body.dark-mode .jobs_sidebar .text-secondary {
    color: #94a3b8;
}

/* === "Already Applied" Button === */
body.dark-mode .bg-gray-400 {
    background-color: #4b5563 !important;
    color: #d1d5db !important;
}

body.dark-mode .button-main {
    color: #ffffff !important; /* Button ke text ko zabardasti white karein */
}
    </style>
</head>
<body>
    {{-- Navbar ko yahan include karein --}}
    @include('layouts.partials.navbar')

    {{-- Page ka content yahan show hoga --}}
    <main>
       <div>
    <!-- Flash messages -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
        </div>
    </main>

    @include('layouts.partials.footer')

    {{-- Yahan aapki saari JavaScript files aayengi --}}
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
        <script src="{{ asset('assets/js/phosphor-icons.js') }}"></script>
        <script src="{{ asset('assets/js/slick.min.js') }}"></script>
        <script src="{{ asset('assets/js/leaflet.js') }}"></script>
        <script src="{{ asset('assets/js/swiper-bundle.min.js') }}"></script>
        <!-- <script src="{{ asset('assets/css/apexcharts.css') }}"></script> -->
        <script src="{{ asset('assets/js/main.js')  }}"></script>
        @stack('scripts')

        <script>
    (function() {
        const toggleSwitch = document.getElementById('theme-toggle');
        const currentTheme = localStorage.getItem('theme');

        // 1. Page load par saved theme apply karein
        if (currentTheme) {
            if (currentTheme === 'dark') {
                document.body.classList.add('dark-mode');
                if (toggleSwitch) {
                    toggleSwitch.checked = true;
                }
            }
        }

        // 2. Switch par click karne par theme change karein
        if (toggleSwitch) {
            toggleSwitch.addEventListener('change', function(e) {
                if (e.target.checked) {
                    document.body.classList.add('dark-mode');
                    localStorage.setItem('theme', 'dark'); // Choice save karein
                } else {
                    document.body.classList.remove('dark-mode');
                    localStorage.setItem('theme', 'light'); // Choice save karein
                }
            });
        }
    })();
</script>

</body>
</html>