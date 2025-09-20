<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ComplaintController extends Controller
{
    // User ki purani complaints dikhayein
    public function index()
    {
        $complaints = Auth::user()->complaints()->latest()->paginate(10);
        return view('complaints.index', compact('complaints'));
    }

    // Complaint submit karne ka form dikhayein
    public function create()
    {
        return view('complaints.create');
    }

    // Complaint ko database mein save karein
    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'message' => 'required|string|min:20',
        ]);

        Auth::user()->complaints()->create([
            'subject' => $request->subject,
            'message' => $request->message,
        ]);

        return redirect()->route('complaints.index')->with('success', 'Your complaint has been submitted!');
    }
}