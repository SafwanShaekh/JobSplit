<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    // Admin panel mein saare messages dikhane ke liye
   public function index()
{
    // Debugging code hata dein, aur is line ko wapis le ayein
    \App\Models\ContactMessage::where('is_read', false)->update(['is_read' => true]);

    $messages = \App\Models\ContactMessage::latest()->paginate(10);
    return view('admin.contact.index', compact('messages'));
}

    // Contact form se data save karne ke liye
    public function store(Request $request)
    {
        // Form validation
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // Data ko database mein save karein
        ContactMessage::create($request->all());

        // Success message ke saath wapis redirect karein
        return back()->with('success', 'Your message has been sent successfully!');
    }

    public function countUnread()
    {
        $count = \App\Models\ContactMessage::where('is_read', false)->count();
        return response()->json(['count' => $count]);
    }
}