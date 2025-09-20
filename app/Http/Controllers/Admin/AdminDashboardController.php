<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Job;
use App\Models\Complaint;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // --- Total Counts ---
        $totalUsers = User::count();
        $totalJobs = Job::count();
        
        // === YAHAN FIX KIYA GAYA HAI ===
        // 'is_active' ki jagah 'is_banned' ka istemal kiya gaya hai
        $activeUsers = User::where('is_banned', false)->count(); // Active woh hain jo banned nahi
        $bannedUsers = User::where('is_banned', true)->count();  // Banned woh hain jahan flag true hai
        // === END FIX ===

        // --- Recent Activity Lists ---
        $latestUsers = User::latest()->take(3)->get();
        $latestJobs = Job::latest()->take(3)->get();
        $latestComplaints = Complaint::with('user')->latest()->take(3)->get();

        // --- Charts Data ---
        $complaintsStats = [
            Complaint::where('status', 'pending')->count(),
            Complaint::where('status', 'resolved')->count(),
        ];

        $userStats = User::select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('count(*) as count')
            )
            ->where('created_at', '>=', Carbon::now()->subDays(7))
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get();

        $userChartLabels = $userStats->pluck('date')->map(function ($date) {
            return Carbon::parse($date)->format('D, M j');
        });
        $userChartData = $userStats->pluck('count');

        // --- Pass all data to the view ---
        return view('admin.dashboard', compact(
            'totalUsers', 'totalJobs', 'activeUsers', 'bannedUsers',
            'latestUsers', 'latestJobs', 'latestComplaints', 'complaintsStats',
            'userChartLabels', 'userChartData'
        ));
    }
}