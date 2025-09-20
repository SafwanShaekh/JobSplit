<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function store(Request $request, Application $application)
    {   
        // Security: Sirf job ka malik he feedback de sakta hai
        if (auth()->id() !== $application->job->user_id) {
            abort(403, 'Unauthorized Action');
        }

        // --- START: New Duplicate Check ---
        // Check karein ke is application ke liye pehle se feedback to nahi hai
        $existingFeedback = Feedback::where('application_id', $application->id)->exists();
        if ($existingFeedback) {
            return redirect()->back()->with('error', 'Feedback has already been submitted for this applicant.');
        }
        // --- END: New Duplicate Check ---

        // Validation
        $validated = $request->validate([
            'q1' => 'required|in:yes,no',
            'q2' => 'required|in:yes,no',
            'q3' => 'required|in:yes,no',
            'q4' => 'required|in:yes,no',
            'q5' => 'required|in:yes,no',
            'rating' => 'nullable|integer|between:1,5', // <-- 1. ADDED VALIDATION FOR RATING
        ]);

        // Feedback ko database mein save karein
        Feedback::create([
            'application_id' => $application->id,
            'job_id' => $application->job_id,
            'employer_id' => auth()->id(),
            'worker_id' => $application->user_id,
            'q1_punctual' => $validated['q1'] === 'yes',
            'q2_satisfactory' => $validated['q2'] === 'yes',
            'q3_professional' => $validated['q3'] === 'yes',
            'q4_hire_again' => $validated['q4'] === 'yes',
            'q5_fair_price' => $validated['q5'] === 'yes',
            'rating' => $validated['rating'] ?? null, // <-- 2. ADDED RATING TO BE SAVED
        ]);

        return redirect()->back()->with('success', 'Feedback submitted successfully!');
    }
}