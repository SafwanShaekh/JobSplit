<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ResetPasswordController extends Controller
{
    // 🔹 Reset password form dikhane ke liye
    public function showResetForm($token)
    {
        return view('auth.reset-password', ['token' => $token]);
    }

    // 🔹 Reset password save karne ke liye
    public function reset(Request $request)
    {
        $request->validate(
            [
                'token' => 'required',
                'email' => 'required|email',
                'password' => 'required|min:8|confirmed',
            ],
            [
                'email.required' => 'Email field is required.',
                'email.email' => 'Please enter a valid email address.',
                'password.required' => 'Password field is required.',
                'password.min' => 'Password must be at least 8 characters.',
                'password.confirmed' => 'Password not match. Please re-enter.',
            ]
        );

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->password = Hash::make($password);
                $user->save();

                // 🔹 Reset ke baad user ko login kar dena
                Auth::login($user);
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('dashboard')->with('status', 'Your password has been reset and you are now logged in!')
            : back()->withErrors(['email' => [__($status)]]);
    }
}
