<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User; // <-- YEH LINE ADD KAREIN

class LoginController extends Controller
{
    // Show Login Page
    public function showForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Step 1: Validate input
        $request->validate([
            'login'    => 'required|string',
            'password' => 'required|string',
        ]);

        $login_type = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';

        // === NAYA BAN CHECK LOGIC ===
        // Step 2: Pehle user ko dhoondein
        $user = User::where($login_type, $request->login)->first();

        // Step 3: Check karein ke user mojood hai aur banned to nahi
        if ($user && $user->is_banned) {
            // Agar user banned hai, to foran error de kar wapas bhej dein
            return back()->withErrors([
                'login' => 'Your account has been suspended. Please contact support.',
            ])->withInput($request->only('login', 'remember'));
        }
        // === END BAN CHECK ===

        // Step 4: Agar user banned nahi, tab login attempt karein
        $credentials = [
            $login_type => $request->login,
            'password'  => $request->password,
        ];

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }

        // Step 5: Agar password ghalat hai ya user mojood nahi
        return back()->withErrors([
            'login' => 'Invalid credentials.',
        ]);
    }

    // Handle Logout
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }

     public function handleGetLogout()
    {
        // Check if a user is currently logged in
        if (Auth::check()) {
            // If they are logged in, just redirect them back to where they were.
            // This prevents them from being logged out by accident.
            return redirect()->back()->with('info', 'To log out, please use the logout button.');
        }

        // If no one is logged in, redirect them to the login page.
        return redirect()->route('login');
    }
}