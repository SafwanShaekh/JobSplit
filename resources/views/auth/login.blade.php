<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login - FreelanHub</title>
    
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

        /* This CSS is the same as the register page for consistency */
        :root {
            --freelanhub-blue: #2c5282; --freelanhub-light-blue: #3182ce;
            --freelanhub-dark: #1a202c; --freelanhub-gray-text: #718096;
            --freelanhub-border: #e2e8f0;
            --freelanhub-gradient: linear-gradient(90deg, #2dd4bf, #06b6d4);
        }
        body { background-color: #f7fafc; overflow-x: hidden; }
        .auth-container { min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 40px 20px; }
        .auth-content { background-color: white; border-radius: 20px; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25); padding: 40px; max-width: 1100px; width: 100%; display: grid; grid-template-columns: 1fr 1.1fr; gap: 40px; overflow: hidden; animation: fadeInScale 0.8s ease-out forwards; }
        @media (max-width: 1024px) { .auth-content { grid-template-columns: 1fr; } }
        .auth-illustration { text-align: center; padding: 20px; display: flex; flex-direction: column; justify-content: center; }
        .auth-illustration img { max-width: 100%; height: auto; border-radius: 12px; animation: floatImage 4s ease-in-out infinite alternate; }
        .auth-illustration h2 { font-size: 1.8rem; font-weight: 700; color: var(--freelanhub-dark); margin-top: 25px; line-height: 1.3; }
        .auth-illustration p { color: var(--freelanhub-gray-text); margin-top: 10px; }
        .auth-form-wrapper h3 { font-size: 2rem; font-weight: 700; }
        .form-group input { border: 1px solid var(--freelanhub-border); border-radius: 8px; padding: 12px 18px; transition: all 0.2s ease-in-out; background-color: #fdfdff; width: 100%; }
        .form-group input:focus { border-color: var(--freelanhub-light-blue); box-shadow: 0 0 0 3px rgba(49, 130, 206, 0.2); }
        .button-main { background: var(--freelanhub-gradient); padding: 15px 25px; border-radius: 10px; font-weight: 600; font-size: 1.1rem; transition: all 0.3s ease; box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15); display: flex; align-items: center; justify-content: center; }
        .button-main:hover { opacity: 0.9; transform: translateY(-2px); box-shadow: 0 12px 25px rgba(0, 0, 0, 0.2); }

        /* Enhancement Styles */
        .password-wrapper { position: relative; }
        .password-toggle-icon { position: absolute; top: 50%; right: 15px; transform: translateY(-50%); cursor: pointer; color: #a0aec0; }
        .button-main.loading { cursor: not-allowed; opacity: 0.8; }
        .button-main .spinner { display: none; width: 20px; height: 20px; border: 3px solid rgba(255,255,255,0.3); border-top-color: #fff; border-radius: 50%; animation: spin 1s linear infinite; }
        .button-main.loading .spinner { display: inline-block; }
        .button-main.loading .button-text { display: none; }
        @keyframes spin { to { transform: rotate(360deg); } }
        .social-login a { border: 1px solid var(--freelanhub-border); border-radius: 8px; transition: all 0.2s ease; }
        .social-login a:hover { border-color: var(--freelanhub-light-blue); background-color: #f7fafc; }
        .social-login img { height: 20px; width: 20px; }
        @keyframes fadeInScale { from { opacity: 0; transform: scale(0.98) translateY(10px); } to { opacity: 1; transform: scale(1) translateY(0); } }
        @keyframes floatImage { 0% { transform: translateY(0px); } 50% { transform: translateY(-20px); } 100% { transform: translateY(0px); } }
    </style>
</head>
<body>

    <header class="header-auth bg-white shadow-sm sticky w-full top-0 z-50">
        <div class="container mx-auto px-4">
            <div class="header_inner flex items-center justify-between h-16">
                <a href="{{ url('/') }}"><img src="{{ asset('assets/images/JobSplit logo.png') }}" alt="logo" class="logo" /></a>
                <div class="text-sm">
                    <span class="text-gray-600">Don't have an account?</span>
                    <a class="text-primary font-medium hover:underline ml-1" href="{{ route('register') }}">Sign Up</a>
                </div>
            </div>
        </div>
    </header>

    <div class="auth-container">
        <div class="auth-content">
            <div class="auth-illustration max-lg:hidden">
                <img src="https://images.unsplash.com/photo-1521791136064-7986c2920216?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1169&q=80" alt="Illustration of people collaborating" />
                <h2 class="mt-8">Welcome Back to the Hub of Jobs</h2>
                <p>Log in to manage your pending works by connecting with professionals, and find your next opportunity.</p>
            </div>

            <div class="auth-form-wrapper">
                <h3 class="mb-2">Welcome Back!</h3>
                <p class="text-secondary text-lg mb-8">Please enter your details to log in.</p>
                
                @error('login')
                    <div class="mb-4 p-4 bg-red-100 border-l-4 border-red-500 text-red-700">
                        <p>{{ $message }}</p>
                    </div>
                @enderror

                <form id="login-form" method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf
                    <div class="form-group">
                        <label for="login" class="block text-sm font-semibold text-gray-700 mb-2">Email or Phone*</label>
                        <input id="login" type="text" name="login" value="{{ old('login') }}" placeholder="Enter your email or phone" required>
                    </div>

                    <div class="form-group">
                        <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">Password*</label>
                        <div class="password-wrapper">
                            <input id="password" type="password" name="password" placeholder="Enter your password" required>
                            <i class="ph ph-eye-slash password-toggle-icon"></i>
                        </div>
                    </div>
                    
                    <div class="flex items-center justify-between text-sm">
                        <label for="remember" class="flex items-center text-gray-600 cursor-pointer">
                            <input id="remember" type="checkbox" name="remember" class="rounded text-primary focus:ring-primary"/>
                            <span class="ml-2">Remember me</span>
                        </label>
                        <a href="{{ route('password.request') }}" class="text-primary hover:underline font-medium">Forgot Password?</a>
                    </div>

                    <div>
                        <button id="submit-button" class="button-main w-full mt-3" type="submit">
                            <span class="button-text">Log In</span>
                            <span class="spinner"></span>
                        </button>
                    </div>

                    <div class="relative text-center py-4">
                        <span class="px-4 bg-white text-gray-500 text-sm">or log in with</span>
                        <div class="absolute top-1/2 left-0 w-full h-px bg-gray-300 -z-10"></div>
                    </div>

                    <div class="grid sm:grid-cols-3 gap-3 social-login">
                        <a href="{{ route('auth.google') }}" class="py-2 flex items-center justify-center gap-2"><img src="https://upload.wikimedia.org/wikipedia/commons/c/c1/Google_%22G%22_logo.svg" alt="Google Logo"><strong>Google</strong></a>
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

        // --- Form Submission Loading State ---
        const loginForm = document.getElementById('login-form');
        const submitButton = document.getElementById('submit-button');
        if(loginForm && submitButton) {
            loginForm.addEventListener('submit', function() {
                submitButton.classList.add('loading');
                submitButton.disabled = true;
            });
        }
    });
    </script>
</body>
</html>