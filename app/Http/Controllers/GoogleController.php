<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Exception;

class GoogleController extends Controller
{
    /**
     * User ko Google ke authentication page par bhejein.
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Google se user ki information hasil karein aur login karein.
     */
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            // Pehle email se user dhoondhein
            $user = User::where('email', 'like', $googleUser->getEmail())->first();

            if ($user) {
                // Agar user mil gaya hai, to uska google_id update karein
                $user->update([
                    'google_id' => $googleUser->getId(),
                ]);
            } else {
                // Agar is email ka user nahi hai, to naya user banayein
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(),
                    'password' => null,
                ]);
            }

            // === YEH NAYA AUR ZAROORI CHECK HAI ===
            // Login karwane se pehle check karein ke user banned to nahi hai
            if ($user->is_banned) {
                // Agar banned hai, to logout karein (just in case) aur error ke saath wapis bhej dein
                Auth::logout();
                return redirect()->route('login')->withErrors(['login' => 'Your account has been suspended. Please contact support.']);
            }
            // === CHECK KHATAM ===

            // Agar banned nahi hai, to login karwayein
            Auth::login($user);

            return redirect('/dashboard');

        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Something went wrong with Google Login.');
        }
    }
}