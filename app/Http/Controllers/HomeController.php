<?php

namespace App\Http\Controllers;

use App\Models\Job; // Job model ko import karna na bhoolein
use Illuminate\Http\Request;

class HomeController extends Controller
{
     public function index()
    {
        // Database se 6 sab se nayi 'open' jobs fetch karein
        $latestJobs = Job::where('status', 'open')
                         ->with('user')
                         ->latest()
                         ->take(6)
                         ->get();

        // Jobs table se unique categories nikal lein
        $categories = Job::select('category')
                         ->whereNotNull('category')
                         ->distinct()
                         ->pluck('category');

        // latestJobs aur categories, dono ko view mein pass karein
        return view('home', [
            'latestJobs' => $latestJobs,
            'categories' => $categories // Yeh line error fix karegi
        ]);
    }
}