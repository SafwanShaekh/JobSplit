<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class JobApplicantsController extends Controller
{
    /**
     * Show the list of the user's jobs with applicant counts.
     */
    public function index()
    {
        $jobs = Job::where('user_id', Auth::id())
                    ->withCount('applications') // Efficiently counts applicants
                    ->latest()
                    ->paginate(10);

        return view('job-applicants.index', compact('jobs'));
    }

    /**
     * Show all applicants for a specific job.
     */
   // JobApplicantsController.php ke andar
        public function show(Job $job)
    {
        // Security Check
        if (auth()->id() !== $job->user_id) {
            abort(403, 'Unauthorized Action');
        }

        // Applications ke saath user aur feedback ka status bhi get karein
        $applications = $job->applications()
                            ->with('user')
                            ->withExists('feedback') // <-- Yeh Zaroori Line Hai
                            ->get();

        return view('job-applicants.show', compact('job', 'applications'));
    }

    /**
     * Approve an applicant, reject others, and mark the job as completed.
     */
       public function approve(Job $job, Application $application)
    {
        // Security Check
        if (Auth::id() !== $job->user_id) {
            abort(403, 'Unauthorized Action');
        }
    
        // Database Transaction: Yeh ensure karega ke saare steps ek saath hon
        DB::transaction(function () use ($job, $application) {
            
            // 1. Selected application ka status 'approved' karein
            $application->update(['status' => 'approved']);
        
            // 2. Is job ki baaqi saari applications ka status 'rejected' karein
            $job->applications()->where('id', '!=', $application->id)->update(['status' => 'rejected']);
        
            // 3. Job ka status 'completed' karein
            $job->update(['status' => 'completed']);
        
        });
    
        return redirect()->route('job-applicants.show', $job)->with('success', 'Applicant approved successfully! The job is now closed.');
    }
}