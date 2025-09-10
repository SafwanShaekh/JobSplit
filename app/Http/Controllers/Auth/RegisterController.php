<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    // Show Register Page
    public function showForm()
    {
        return view('auth.register');
    }

    // Handle Register
    
    
       public function register(Request $request)
{
    $request->validate([
        'name' => 'required',
        'email' => 'nullable|email|unique:users',
        'phone' => 'nullable|string|unique:users',
        'password' => 'required|min:6|confirmed',
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
        'password' => Hash::make($request->password),
    ]);

    Auth::login($user);

        return redirect('/dashboard');
    }
}
