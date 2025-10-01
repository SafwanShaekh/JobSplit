<?php

namespace App\Http\Controllers\Admin; // <--- NAYA PATA

use App\Http\Controllers\Controller; // Yeh line add karna na bhoolein
// ... baaki use statements

// ... baaki code

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(route('admin.dashboard'));
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
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
        return redirect()->route('admin.login');
    }
}