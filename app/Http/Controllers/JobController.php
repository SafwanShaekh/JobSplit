<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// We no longer need the AuthorizesRequests trait
// use Illuminate\Foundation\Auth\Access\AuthorizesRequests; 

class JobController extends Controller
{
    // The 'use AuthorizesRequests;' line has been removed.

    /**
     * Display jobs posted by the authenticated user in their dashboard.
     */
    public function index()
    {
        $jobs = Auth::user()->jobs()->latest()->paginate(10);
        return view('jobs.index', compact('jobs'));
    }

    /**
     * Display a paginated list of all open jobs with search and filtering for everyone.
     */
    public function browse(Request $request)
    {
        // Start with a base query
        $query = Job::with('user')->latest();

        $query->where('status', '!=', 'completed');

        // ** YEH NAYI LOGIC HAI **
        if ($request->filled('category')) {
            // Agar category search ki hai, to sirf us category ki jobs dikhayein (status koi bhi ho)
            $query->where('category', $request->category);
        } else {
            // Agar koi category nahi hai, to by default sirf 'open' jobs dikhayein
            // $query->where('status', 'open');
        }

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }
        // ... more filter logic ...

        $appliedJobIds = [];
        if (Auth::check()) {
            $appliedJobIds = Application::where('user_id', Auth::id())
                                         ->pluck('job_id')
                                         ->toArray();
        }

        $jobs = $query->paginate(9)->withQueryString();

        // ** YEH NAYI LINE HAI **
        // Category ka naam view ko bhejein taake custom message dikha sakein
        $searchedCategory = $request->category;

        // ** compact() MEIN NAYA VARIABLE ADD KIYA GAYA HAI **
        return view('jobs.browse', compact('jobs', 'appliedJobIds', 'searchedCategory'));
    }

    /**
     * Show the form to create a new job.
     */
    public function create()
    {
        return view('jobs.create');
    }

    /**
     * Store a new job in the database.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255', 'description' => 'required|string',
            'category' => 'required|string|max:255', 'pay' => 'required|numeric',
            'date_time' => 'required|date', 'duration' => 'required|string|max:255',
            'location' => 'required|string|max:255',
        ]);
        Auth::user()->jobs()->create($validatedData);
        return redirect()->route('jobs.index')->with('success', 'Job created successfully!');
    }

    /**
     * Display the details of a specific job.
     */
     public function show(Job $job)
    {
        $appliedJobIds = []; // Pehle aek khali array banayein

        // Check karein ke user logged-in hai ya nahi
        if (Auth::check()) {
            // Agar logged-in hai, to uski applications se job_id nikal lein
            $appliedJobIds = Auth::user()
                                ->applications()
                                ->pluck('job_id')
                                ->toArray();
        }

        // $job aur $appliedJobIds, dono variables ko view mein pass karein
        return view('jobs.show', [
            'job' => $job,
            'appliedJobIds' => $appliedJobIds
        ]);
    }

    /**
     * Show the form for editing the specified job.
     */
    public function edit(Job $job)
    {
        // == NEW: Manual Authorization Check ==
        if (auth()->id() !== $job->user_id) {
            abort(403, 'This action is unauthorized.');
        }

        return view('jobs.edit', compact('job'));
    }

    /**
     * Update the specified job in the database.
     */
    public function update(Request $request, Job $job)
    {
        // == NEW: Manual Authorization Check ==
        if (auth()->id() !== $job->user_id) {
            abort(403, 'This action is unauthorized.');
        }

        $validatedData = $request->validate([
            'title' => 'required|string|max:255', 'description' => 'required',
            'category' => 'required|string|max:255', 'pay' => 'required|numeric',
            'date_time' => 'required|date', 'duration' => 'required|string|max:255',
            'location' => 'required|string|max:255',
        ]);
        $job->update($validatedData);
        return redirect()->route('jobs.index')->with('success', 'Job updated successfully!');
    }

    /**
     * Remove the specified job from the database.
     */
    public function destroy(Job $job)
    {
        // == REPLACED authorize() with Manual Check ==
        if (auth()->id() !== $job->user_id) {
            abort(403, 'This action is unauthorized.');
        }

        $job->delete();
        return redirect()->route('jobs.index')->with('success', 'Job deleted successfully!');
    }
    
    /**
     * Update the status of a job.
     */
    // in app/Http/Controllers/JobController.php

public function updateStatus(Request $request, Job $job)
{
    // Authorization check
    if (auth()->id() !== $job->user_id) {
        abort(403, 'This action is unauthorized.');
    }

    // Validation
    $validated = $request->validate([
        'status' => 'required|in:open,closed,completed',
    ]);

    // If a job is being re-opened from 'closed' to 'open'...
    if ($job->status === 'closed' && $validated['status'] === 'open') {
        
        // THIS IS THE FIX:
        // Only reset the status for applicants who were 'rejected'.
        // This will leave the 'approved' applicant untouched.
        $job->applications()->where('status', 'rejected')->update(['status' => 'pending']);
    }

    // Update the job status
    $job->update(['status' => $validated['status']]);

    return redirect()->route('jobs.index')->with('success', 'Job status has been updated successfully!');
}
}