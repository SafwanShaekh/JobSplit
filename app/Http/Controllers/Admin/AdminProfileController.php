<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage; // File system ke liye isay add karein
use Illuminate\Validation\ValidationException;

class AdminProfileController extends Controller
{
    public function index()
    {
        $admin = Auth::guard('admin')->user();
        // FIX: View ka naam aapki file ke mutabiq 'admin.profile' kar diya gaya hai
        return view('admin.profile', compact('admin')); 
    }

    public function update(Request $request)
    {
        $admin = Auth::guard('admin')->user();

        // Validation rules mein 'avatar' add kiya gaya hai
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins,email,' . $admin->id,
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048' // Picture ke liye validation
        ]);

        // Name aur email ko update karein
        $admin->name = $request->name;
        $admin->email = $request->email;

        // Agar form mein nayi picture upload ki gayi hai
        if ($request->hasFile('avatar')) {
            
            // Step 1: Purani picture ko delete karein (agar mojood hai)
            if ($admin->avatar) {
                Storage::disk('public')->delete($admin->avatar);
            }

            // Step 2: Nayi picture ko 'public/avatars' folder mein store karein
            $path = $request->file('avatar')->store('avatars', 'public');

            // Step 3: Database mein picture ka naya path save karein
            $admin->avatar = $path;
        }

        // Tamam tabdeeliyon ko save karein
        $admin->save();

        return back()->with('success', 'Profile updated successfully.');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'string'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $admin = Auth::guard('admin')->user();

        if (!Hash::check($request->current_password, $admin->password)) {
            throw ValidationException::withMessages([
                'current_password' => ['The provided password does not match your current password.'],
            ]);
        }

        $admin->update([
            'password' => Hash::make($request->password),
        ]);

        return back()->with('success', 'Password updated successfully.');
    }
}

