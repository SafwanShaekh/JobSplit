<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use App\Models\Application; // New line to import Application model
use Illuminate\Support\Facades\Auth; // New line to import Auth facade

class JobController extends Controller
{
    /**
     * Show form to create a new job
     */
    public function create()
    {
        return view('jobs.create'); 
        // Ye Blade file abhi banani hai
    }

    /**
     * Store new job in database
     */
    public function store(Request $request)
{
    // Validation of form inputs
    $request->validate([  //  $request->validate Server-side validation. Agar invalid input → automatic error return.
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'category' => 'required|string|max:255',
        'pay' => 'required|numeric',
        'date_time' => 'required|date',
        'duration' => 'required|string|max:255',
        'location' => 'required|string|max:255',
    ]);

    // Create job linked to logged-in user
    Job::create([  //Job::create. Mass assignment ka use karke job database me insert karna.
        'user_id' => auth()->id(), //auth()->id(), //auth()->id(), KO TEMPORARY COMMIT KIA HAI JB LOGIN LAG JAYE TO 1 HATT JAYEGA OR UNCOMMIT HOGA 
        'title' => $request->title,
        'description' => $request->description,
        'category' => $request->category,
        'pay' => $request->pay,
        'date_time' => $request->date_time,
        'duration' => $request->duration,
        'location' => $request->location,
    ]);

    // Redirect back or to jobs list
    return redirect()->route('jobs.index')->with('success', 'Job created successfully!');
}


    /**
     * // Employer – My Jobs
     */
   public function index()
{

        // Latest jobs first, 6 per page
     $jobs = Job::where('user_id', auth()->id())->latest()->paginate(6); //auth()->id() jb login signup ban jaye uske baad 1 ki jaga ye lagega//

    // Pass jobs to the Blade view
    return view('jobs.index', compact('jobs'));
}

//edit wale page pr lekar jayega edit button click pr
public function edit(Job $job)
{
    return view('jobs.edit', compact('job'));
}

//update ka function chalega or update button se data db main update ho jayega after validation
public function update(Request $request, Job $job)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required',
        'category' => 'required|string|max:255',
        'pay' => 'required|numeric',
        'date_time' => 'required|date',
        'duration' => 'required|string|max:255',
        'location' => 'required|string|max:255',
    ]);

    $job->update($request->all());

    return redirect()->route('jobs.index')->with('success', 'Job updated successfully!');
}

//delete ka function chalega
public function destroy(Job $job)
{
    $job->delete();
    return redirect()->route('jobs.index')->with('success', 'Job deleted successfully!');
}

// Worker – Browse All Jobs
public function browse(Request $request)
{
    // --- START: ADD THIS NEW CODE ---
    
    // Get an array of all job IDs the logged-in user has applied to.
    // We use pluck() to get only the 'job_id' column.
    $appliedJobIds = [];
    if (Auth::check()) {
        $appliedJobIds = Application::where('user_id', Auth::id())
                                    ->pluck('job_id')
                                    ->toArray();
    }
    
    // --- END: ADD THIS NEW CODE ---

    $query = Job::query();

    // ... (Your existing search and filter logic remains the same) ...
    if ($request->filled('search')) {
        //...
    }
    // ... all your other filters ...

    $query->where('status', 'open');

    $jobs = $query->latest()->paginate(6)->appends($request->query());

    // Pass the new $appliedJobIds array to the view along with $jobs
    return view('jobs.browse', compact('jobs', 'appliedJobIds')); // <-- UPDATE THIS LINE
}



//JOB DETAILS WALA PAGE KHULEGA
    public function show(Job $job)
    {
        return view('jobs.show', compact('job'));
    }
}
