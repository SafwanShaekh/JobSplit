<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    // 🔹 Forgot password form show karna
    public function showLinkRequestForm()
    {
        return view('auth.forgot-password');
    }

    // 🔹 Reset link bhejna
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(
            [
                'email' => 'required|email|exists:users,email',
            ],
            [
                'email.required' => 'Email field is required.',
                'email.email' => 'Please enter a valid email address.',
                'email.exists' => 'This email is not registered with us.',
            ]
        );

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with('status', 'Reset link has been sent to your email!')
            : back()->withErrors(['email' => 'Failed to send reset link. Try again later.']);
    }
}
