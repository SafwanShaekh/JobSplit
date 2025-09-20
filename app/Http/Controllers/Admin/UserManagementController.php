<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserManagementController extends Controller
{
    /**
     * Display a paginated and searchable list of all users.
     */
    public function index(Request $request)
    {
        // Search query ko request se hasil karein
        $search = $request->input('search');

        // Query banayein aur search term ki buniyad par filter karein
        $users = User::query()
            ->when($search, function ($query, $searchTerm) {
                // Naam ya email se search karein
                return $query->where('name', 'like', "%{$searchTerm}%")
                             ->orWhere('email', 'like', "%{$searchTerm}%");
            })
            ->latest()
            ->paginate(10)
            ->withQueryString(); // Yeh search query ko pagination links ke sath jor deta hai

        return view('admin.users.index', compact('users'));
    }

    /**
     * Approve a user.
     */
  public function toggleBan(User $user)
{
    // User ka ban status ulta kar dein (banned hai to unbanned, unbanned hai to banned)
    $user->is_banned = !$user->is_banned;
    $message = '';

    if ($user->is_banned) {
        // Agar ab user ban ho gaya hai
        $user->just_unbanned = false; // Reset flag
        $message = 'User has been banned successfully.';
    } else {
        // Agar ab user unban ho gaya hai
        $user->just_unbanned = true; // Set flag taake user ko login par message dikhe
        $message = 'User has been unbanned successfully.';
    }

    $user->save();

    return redirect()->route('admin.users.index')->with('success', $message);
}

    /**
     * Delete a user.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return back()->with('success', 'User deleted successfully.');
    }
}

