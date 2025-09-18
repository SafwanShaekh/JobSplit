<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
    /**
     * Show the form to apply for a specific job.
     */
    public function create(Job $job)
    {
        return view('jobs.apply', compact('job'));
    }

    /**
     * Store the new application in the database.
     */
    public function store(Request $request, Job $job)
    {
        $validatedData = $request->validate([
            'bid_amount' => 'required|numeric|min:1',
            'work_description' => 'required|string|min:20',
        ]);

        Application::create([
            'job_id' => $job->id,
            'user_id' => Auth::id(), // Logged-in user's ID
            'bid_amount' => $validatedData['bid_amount'],
            'work_description' => $validatedData['work_description'],
        ]);

        return redirect()->route('jobs.browse')->with('success', 'You have successfully applied for the job!');
    }

    // ya function user ko dekhya ga ka usny kis job pa apply kiya ha or uska status kya ha
    public function index()
    {
        // Logged-in user ki ID hasil karein
        $userId = Auth::id();

        // Sirf is user ki applications nikalen
        // 'with('job')' se hum application ke saath job ki details bhi manga rahe hain (Eager Loading)
        // 'latest()' se sab se nayi application pehle ayegi
        $applications = Application::where('user_id', $userId)
                                    ->with('job') 
                                    ->latest()
                                    ->paginate(10); // Page pe 10 results dikhayein

        // Data ko view file mein bhejein
        return view('applications.index', compact('applications'));
    }

}