<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register - FreelanHub: Join the Future of Freelancing</title>
    
    {{-- Main CSS & Tailwind --}}
    <link rel="shortcut icon" href="{{ asset('assets/images/fav.png') }}" type="image/x-icon" />
    <link rel="stylesheet" href="{{ asset('assets/css/swiper-bundle.min.css')}}" />
    <link rel="stylesheet" href="{{ asset('assets/css/leaflet.css')}}" />
    <link rel="stylesheet" href="{{ asset('assets/css/slick.css')}}" />
    <link rel="stylesheet" href="{{ asset('assets/css/style.css')}}" />
    <link rel="stylesheet" href="{{ asset('dist/output-tailwind.css')}}" />
    <link rel="stylesheet" href="{{ asset('dist/output-scss.css')}}" />

    {{-- Phosphor Icons --}}
    <script src="https://unpkg.com/@phosphor-icons/web@2.0.3/dist/phosphor.js"></script>

    <style>
        .logo {
            width: 100%;
            max-width: 500px; /* Adjust as needed */
            height: 90%;
            max-height: 500px; /* Adjust as needed */
            object-fit: contain; /* Maintain aspect ratio */
            display: flex;
            align-items: center;
            margin-left: -60px; /* Adjust as needed */
            margin-right: -15%; /* Adjust as needed */
            margin-top: 5px; /* Adjust as needed */
            justify-content: flex-start; /* Align to the left */

            background: none; /* Or your navbar's background color */
            /* Optional: a subtle bottom border */
        }
        @media (max-width: 760px) {
            .logo{
                height: 60%;
            }
        }

        /* Previous custom styles remain the same */
        :root {
            --freelanhub-blue: #2c5282; 
            --freelanhub-light-blue: #3182ce;
            --freelanhub-dark: #1a202c; 
            --freelanhub-gray-text: #718096;
            --freelanhub-border: #e2e8f0;
            /* FIX 2: Updated the color gradient to match your theme's teal color */
            --freelanhub-gradient: linear-gradient(90deg, #2dd4bf, #06b6d4);
        }
        body { background-color: #f7fafc; overflow-x: hidden; }
        .register-container { min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 40px 20px; }
        .register-content { background-color: white; border-radius: 20px; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25); padding: 40px; max-width: 1100px; width: 100%; display: grid; grid-template-columns: 1fr 1.1fr; gap: 40px; overflow: hidden; }
        @media (max-width: 1024px) { .register-content { grid-template-columns: 1fr; } }
        .register-illustration { text-align: center; padding: 20px; display: flex; flex-direction: column; justify-content: center; }
        .register-illustration img { max-width: 100%; height: auto; border-radius: 12px; animation: floatImage 4s ease-in-out infinite alternate; }
        .register-illustration h2 { font-size: 1.8rem; font-weight: 700; color: var(--freelanhub-dark); margin-top: 25px; line-height: 1.3; }
        .register-illustration p { color: var(--freelanhub-gray-text); margin-top: 10px; }
        .register-form-wrapper h3 { font-size: 2rem; font-weight: 700; }
        .form-group input { border: 1px solid var(--freelanhub-border); border-radius: 8px; padding: 12px 18px; transition: all 0.2s ease-in-out; background-color: #fdfdff; width: 100%; }
        .form-group input:focus { border-color: var(--freelanhub-light-blue); box-shadow: 0 0 0 3px rgba(49, 130, 206, 0.2); }
        .button-main { background: var(--freelanhub-gradient); padding: 15px 25px; border-radius: 10px; font-weight: 600; font-size: 1.1rem; transition: all 0.3s ease; box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15); display: flex; align-items: center; justify-content: center; }
        .button-main:hover { opacity: 0.9; transform: translateY(-2px); box-shadow: 0 12px 25px rgba(0, 0, 0, 0.2); }

        /* Enhancement Styles */
        .form-group { opacity: 0; transform: translateY(20px); animation: fadeInUp 0.5s ease-out forwards; animation-delay: var(--delay, 0s); }
        @keyframes fadeInUp { to { opacity: 1; transform: translateY(0); } }
        .password-wrapper { position: relative; }
        .password-toggle-icon { position: absolute; top: 50%; right: 15px; transform: translateY(-50%); cursor: pointer; color: #a0aec0; }
        .strength-meter { height: 5px; width: 100%; background: #e2e8f0; border-radius: 5px; margin-top: 8px; }
        .strength-meter-fill { height: 100%; width: 0%; background: #ef4444; border-radius: 5px; transition: width 0.3s ease, background-color 0.3s ease; }
        .strength-meter-fill.weak { width: 33%; background-color: #ef4444; }
        .strength-meter-fill.medium { width: 66%; background-color: #f59e0b; }
        .strength-meter-fill.strong { width: 100%; background-color: #22c55e; }
        .button-main.loading { cursor: not-allowed; opacity: 0.8; }
        .button-main .spinner { display: none; width: 20px; height: 20px; border: 3px solid rgba(255,255,255,0.3); border-top-color: #fff; border-radius: 50%; animation: spin 1s linear infinite; }
        .button-main.loading .spinner { display: inline-block; }
        .button-main.loading .button-text { display: none; }
        @keyframes spin { to { transform: rotate(360deg); } }
        .social-login a { border: 1px solid var(--freelanhub-border); border-radius: 8px; transition: all 0.2s ease; }
        .social-login a:hover { border-color: var(--freelanhub-light-blue); background-color: #f7fafc; }
        .social-login img { height: 20px; width: 20px; }
        @keyframes floatImage { 0% { transform: translateY(0px); } 50% { transform: translateY(-20px); } 100% { transform: translateY(0px); } }
    </style>
</head>
<body>

   <header class="header-auth bg-white shadow-sm sticky w-full top-0 z-50">
        <div class="container mx-auto px-4">
            <div class="header_inner flex items-center justify-between h-16">
                    <a href="{{ url('/') }}"><img src="{{ asset('assets/images/JobSplit logo.png') }}" alt="logo" class="logo" /></a>                <div class="text-sm">
                    <span class="text-gray-600">Already have an account?</span>
                    <a class="text-primary font-medium hover:underline ml-1" href="{{ route('login') }}">Login</a>
                </div>
            </div>
        </div>
    </header>

    <div class="register-container mt-0">
        <div class="register-content">
            <div class="register-illustration max-lg:hidden">
                <img src="https://images.unsplash.com/photo-1519389950473-47ba0277781c?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80" alt="Illustration of freelancers collaborating" />
                <h2 class="mt-8">Unlock Your Ease. Find Your Next Job.</h2>
                <p>Join JobSplit and connect with a local network of clients and talented professionals.</p>
            </div>

            <div class="register-form-wrapper">
                <h3 class="mb-2">Sign Up for JobSplit</h3>
                <p class="text-secondary text-lg mb-8">It's free and takes less than a minute.</p>
                
                @if ($errors->any())
                    <div class="mb-5 p-4 bg-red-100 border-l-4 border-red-500 text-red-700">
                        <ul class="list-disc list-inside text-sm">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
                    </div>
                @endif

                <form id="register-form" method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="form-group mb-5" style="--delay: 0.1s;">
                        <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Full Name*</label>
                        <input id="name" type="text" name="name" value="{{ old('name') }}" placeholder="e.g., John Doe" required>
                    </div>

                    <div class="form-group mb-5" style="--delay: 0.2s;">
                        <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Email Address*</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="e.g., john.doe@example.com" required>
                    </div>

                    <div class="form-group mb-5" style="--delay: 0.3s;">
                        <label for="phone" class="block text-sm font-semibold text-gray-700 mb-2">Phone Number*</label>
                        <input id="phone" type="text" name="phone" value="{{ old('phone') }}" placeholder="e.g., +1 234 567 8900" required>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 mb-5">
                        <div class="form-group" style="--delay: 0.4s;">
                            <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">Password*</label>
                            <div class="password-wrapper">
                                <input id="password" type="password" name="password" placeholder="Create a strong password" required>
                                <i class="ph ph-eye-slash password-toggle-icon"></i>
                            </div>
                            <div class="strength-meter"><div id="password-strength-fill" class="strength-meter-fill"></div></div>
                        </div>
                        <div class="form-group" style="--delay: 0.5s;">
                            <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">Confirm Password*</label>
                             <div class="password-wrapper">
                                <input id="password_confirmation" type="password" name="password_confirmation" placeholder="Re-enter password" required>
                                <i class="ph ph-eye-slash password-toggle-icon"></i>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group flex items-center text-sm mb-6" style="--delay: 0.6s;">
                        <input id="terms" type="checkbox" name="terms" class="h-4 w-4 rounded text-primary focus:ring-primary" required/>
                        <label for="terms" class="ml-2 text-gray-600">I agree to the <a href="#" class="text-primary hover:underline font-medium">Terms and Conditions</a></label>
                    </div>

                    <div class="form-group" style="--delay: 0.7s;">
                        <button id="submit-button" class="button-main w-full" type="submit">
                            <span class="button-text">Create My Account</span>
                            <span class="spinner"></span>
                        </button>
                    </div>

                    
                </form>
            </div>
        </div>
    </div>
    
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // --- Password Toggle Visibility ---
        document.querySelectorAll('.password-toggle-icon').forEach(icon => {
            icon.addEventListener('click', function() {
                const input = this.parentElement.querySelector('input');
                const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
                input.setAttribute('type', type);
                this.classList.toggle('ph-eye');
                this.classList.toggle('ph-eye-slash');
            });
        });

        // --- Password Strength Meter ---
        const passwordInput = document.getElementById('password');
        const strengthFill = document.getElementById('password-strength-fill');
        if (passwordInput && strengthFill) {
            passwordInput.addEventListener('input', function() {
                const val = this.value;
                let strength = 0;
                if (val.length >= 8) strength++; // Min length
                if (val.match(/[A-Z]/)) strength++; // Uppercase
                if (val.match(/[0-9]/)) strength++; // Numbers
                if (val.match(/[^A-Za-z0-9]/)) strength++; // Symbols
                
                strengthFill.className = 'strength-meter-fill'; // Reset
                if (val.length > 0) {
                    if (strength <= 2) strengthFill.classList.add('weak');
                    else if (strength === 3) strengthFill.classList.add('medium');
                    else if (strength >= 4) strengthFill.classList.add('strong');
                }
            });
        }

        // --- Form Submission Loading State ---
        const registerForm = document.getElementById('register-form');
        const submitButton = document.getElementById('submit-button');
        if(registerForm && submitButton) {
            registerForm.addEventListener('submit', function() {
                submitButton.classList.add('loading');
                submitButton.disabled = true;
            });
        }
    });
    </script>
</body>
</html>