<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jobsplit  @yield('title')</title>

    <!-- Bootstrap CSS CDN -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> -->
    <link rel="shortcut icon" href="{{ asset('assets/images/fav.png') }}" type="image/x-icon" />
        <link rel="stylesheet" href="{{ asset('assets/css/swiper-bundle.min.css')}}" />
        <link rel="stylesheet" href="{{ asset('assets/css/leaflet.css')}}" />
        <link rel="stylesheet" href="{{ asset('assets/css/slick.css')}}" />
        <!-- <link rel="stylesheet" href="{{ asset('assets/css/apexcharts.css')}}" /> -->
        <link rel="stylesheet" href="{{ asset('assets/css/style.css')}}" />
        <link rel="stylesheet" href="{{ asset('dist/output-tailwind.css')}}" />
        <link rel="stylesheet" href="{{ asset('dist/output-scss.css')}}"/>
    <!-- Optional: Custom CSS -->
        <!-- <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}" /> -->
</head>
<body>

<!-- Navbar -->


<!-- Main Content -->
<div>
    <!-- Flash messages -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @yield('content')
</div>

<!-- Bootstrap JS CDN -->
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> -->
        <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
        <script src="{{ asset('assets/js/phosphor-icons.js') }}"></script>
        <script src="{{ asset('assets/js/slick.min.js') }}"></script>
        <script src="{{ asset('assets/js/leaflet.js') }}"></script>
        <script src="{{ asset('assets/js/swiper-bundle.min.js') }}"></script>
        <!-- <script src="{{ asset('assets/css/apexcharts.css') }}"></script> -->
        <script src="{{ asset('assets/js/main.js')  }}"></script>

</body>
</html>
