<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="{{ asset('assets/bootstrap.min.css') }}">
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register - FreelanHub</title>
    <link rel="stylesheet" href="{{ asset('dist/output-tailwind.css')}}" />
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center">

    <!-- Fixed Box -->
     <div class="bg-white rounded-2xl shadow-md hover:shadow-2xl transition duration-300 flex items-center justify-center"
     style="width: 500px; height: 650px; margin: 100px 50px">

    <div class="w-full max-w-md p-8">
        <!-- Heading -->
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-8">Sign Up</h2>

        <!-- Register Form -->
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Full Name -->
            <div class="mb-5">
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Name*</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}"
                    class="w-full rounded-lg px-4 py-3 text-lg focus:ring-2 focus:ring-[#00b3ad] focus:outline-none border-0 bg-gray-100"
                    placeholder="Enter your name*" required>
            </div>

            <!-- Email -->
            <div class="mb-5">
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email*</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}"
                    class="w-full rounded-lg px-4 py-3 text-lg focus:ring-2 focus:ring-[#00b3ad] focus:outline-none border-0 bg-gray-100"
                    placeholder="Enter email*" required>
            </div>

            <!-- Phone -->
            <div class="mb-5">
                <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Phone Number*</label>
                <input id="phone" type="text" name="phone" value="{{ old('phone') }}"
                    class="w-full rounded-lg px-4 py-3 text-lg focus:ring-2 focus:ring-[#00b3ad] focus:outline-none border-0 bg-gray-100"
                    placeholder="Enter phone number*" required>
            </div>

            <!-- Password -->
            <div class="mb-5">
                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password*</label>
                <input id="password" type="password" name="password"
                    class="w-full rounded-lg px-4 py-3 text-lg focus:ring-2 focus:ring-[#00b3ad] focus:outline-none border-0 bg-gray-100"
                    placeholder="Enter password*" required>
            </div>

            <!-- Confirm Password -->
            <div class="mb-6">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Confirm Password*</label>
                <input id="password_confirmation" type="password" name="password_confirmation"
                    class="w-full rounded-lg px-4 py-3 text-lg focus:ring-2 focus:ring-[#00b3ad] focus:outline-none border-0 bg-gray-100"
                    placeholder="Confirm password*" required>
            </div>

            <!-- Submit Button -->
            <div class="mt-6">
                <button class="bg-primary text-white font-semibold py-4 px-6 rounded-lg w-full text-lg hover:bg-primary/90 transition duration-300" type="submit">
                    Create Account
                </button>
            </div>
        </form>

        <!-- Already Registered -->
        <div class="flex items-center justify-center gap-2 mt-6 text-sm">
            <span class="text-gray-600">Already have an account?</span>
            <a class="text-primary font-medium hover:underline" href="{{ route('login') }}">Login</a>
        </div>
    </div>
</div>


</body>
</html>
