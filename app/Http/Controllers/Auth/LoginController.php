<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Show Login Page
    public function showForm()
    {
        return view('auth.login');
    }
public function login(Request $request)
{
    $request->validate([
        'login'    => 'required|string',   // 👈 ab sirf string validate karenge, email ki condition hata do
        'password' => 'required|string',
    ]);

    $login_type = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';

    $credentials = [
        $login_type => $request->login,
        'password'  => $request->password,
    ];

    if (Auth::attempt($credentials, $request->filled('remember'))) {
        $request->session()->regenerate();
        return redirect()->intended('dashboard');
    }

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
}
