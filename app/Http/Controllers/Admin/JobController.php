<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    /**
     * Tamam jobs ko search aur pagination ke sath dikhayein.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $jobs = Job::query()
            ->when($search, function ($query, $searchTerm) {
                return $query->where('title', 'like', "%{$searchTerm}%")
                             ->orWhere('description', 'like', "%{$searchTerm}%")
                             ->orWhere('location', 'like', "%{$searchTerm}%");
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.jobs.index', compact('jobs'));
    }

    /**
     * Nayi job create karne ka form dikhayein.
     */
    public function create()
    {
        return view('admin.jobs.create');
    }

    /**
     * Nayi job ko database mein store karein.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string|max:255',
            'pay' => 'required|numeric',
            'date_time' => 'required|date',
            'duration' => 'required|string|max:255',
            'location' => 'required|string|max:255',
        ]);

        // Admin ke zariye job create ho rahi hai, isliye user_id null rakha ja sakta hai
        // ya kisi default admin user ki id di ja sakti hai.
        Job::create($request->all());

        return redirect()->route('admin.jobs.index')->with('success', 'Job created successfully!');
    }

    /**
     * Ek makhsoos job ki details dikhayein.
     */
    public function show(Job $job)
    {
        return view('admin.jobs.show', compact('job'));
    }

    /**
     * Job edit karne ka form dikhayein.
     */
    public function edit(Job $job)
    {
        return view('admin.jobs.edit', compact('job'));
    }

    /**
     * Job ko update karein.
     */
    public function update(Request $request, Job $job)
    {
        // Website wale controller jaisi validation yahan add kar di gayi hai
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

        return redirect()->route('admin.jobs.index')->with('success', 'Job updated successfully.');
    }

    /**
     * Job ko delete karein.
     */
    public function destroy(Job $job)
    {
        $job->delete();
        return back()->with('success', 'Job deleted successfully.');
    }

    
}

