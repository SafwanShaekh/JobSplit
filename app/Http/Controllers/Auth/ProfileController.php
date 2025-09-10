<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    // Show Profile Page
    public function show()
    {
        $user = auth()->user();
        return view('profile.show', compact('user'));
    }

    // Show Edit Form
    public function edit()
    {
        $user = auth()->user();
        return view('profile.edit', compact('user'));
    }

    // Update Profile Data
   public function update(Request $request)
{
    $user = auth()->user();

    $data = $request->validate([
        'name'   => 'required|string|max:255',
        'email'  => 'required|email|unique:users,email,' . $user->id,
        'phone'  => 'nullable|string|max:20',
        'address'=> 'nullable|string|max:1000',
        'bio'    => 'nullable|string|max:500',
        'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
    ]);

    if ($request->hasFile('profile_picture')) {
        $path = $request->file('profile_picture')->store('profiles', 'public');
        $data['profile_picture'] = $path;
    }

    $user->update($data);

    return redirect()->route('profile.show')->with('success', 'Profile updated successfully!');
}

public function getProfilePictureUrlAttribute()
{
    return $this->profile_picture 
        ? asset('storage/'.$this->profile_picture) 
        : asset('assets/images/default-avatar.png');
}


}
