<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

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
        'user_id' => 1, //auth()->id(), //auth()->id(), KO TEMPORARY COMMIT KIA HAI JB LOGIN LAG JAYE TO 1 HATT JAYEGA OR UNCOMMIT HOGA 
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
     $jobs = Job::where('user_id', 1)->latest()->paginate(6); //auth()->id() jb login signup ban jaye uske baad 1 ki jaga ye lagega//

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
    $query = Job::query();

    // Search by title/description
    if ($request->filled('search')) {
        $query->where(function($q) use ($request) {
            $q->where('title', 'LIKE', "%{$request->search}%")
              ->orWhere('description', 'LIKE', "%{$request->search}%")
              ->orWhere('category', 'LIKE', "%{$request->search}%");

        });
    }

    // Filter by location
    if ($request->filled('location')) {
        $query->where('location', 'LIKE', "%{$request->location}%");
    }

    // Filter by category
    if ($request->filled('category')) {
        $query->where('category', 'LIKE', "%{$request->category}%");
    }

    // Filter by pay range
    if ($request->filled('min_pay')) {
        $query->where('pay', '>=', $request->min_pay);
    }
    if ($request->filled('max_pay')) {
        $query->where('pay', '<=', $request->max_pay);
    }

    // Results with pagination
    $jobs = $query->paginate(6)->appends($request->all());

    return view('jobs.browse', compact('jobs'));
}



//JOB DETAILS WALA PAGE KHULEGA
    public function show(Job $job)
    {
        return view('jobs.show', compact('job'));
    }
}
