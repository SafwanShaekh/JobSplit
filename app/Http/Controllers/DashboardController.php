<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; // <-- IMPORTANT: Add this line at the top
use App\Models\Job; // <-- Make sure to import your Job model
use App\Models\Application; // <-- Make sure to import your JobApplication model
use Carbon\Carbon; // <-- And this one for date handling


class DashboardController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Get the currently authenticated user
        $user = Auth::user();

        // 1. Count the total jobs posted by this user
        $jobsPostedCount = Job::where('user_id', $user->id)->count();

        // 2. Count the applications SUBMITTED BY this user that are approved
        $appliedJobsCount = Application::where('user_id', $user->id)
                                             ->where('status', 'approved')
                                             ->count();

        // 3. Count the applicants FOR JOBS POSTED BY this user that are approved
        // This query finds applications that belong to jobs owned by the user.
        $totalApplicantsCount = Application::whereHas('job', function ($query) use ($user) {
                                                $query->where('user_id', $user->id);
                                            })
                                            ->where('status', 'approved')
                                            ->count();

        // Pass the counts to the dashboard view
        return view('dashboard', [
            'jobsPostedCount' => $jobsPostedCount,
            'appliedJobsCount' => $appliedJobsCount,
            'totalApplicantsCount' => $totalApplicantsCount,
        ]);
    }
    //      * Get data for the dashboard chart.
    //  */
    public function getChartData(Request $request)
    {
        $user = Auth::user();
        $period = $request->input('period', 'year'); // Default to 'year'

        $query = Application::where('user_id', $user->id)
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as count'))
            ->groupBy('date');

        $labels = [];
        $data = [];

        if ($period === 'year') {
            $startDate = Carbon::now()->subYear();
            $query->where('created_at', '>=', $startDate);
            
            // Process yearly data by month
            $results = $query->get()->groupBy(function($item) {
                return Carbon::parse($item->date)->format('M');
            })->map(function ($group) {
                return $group->sum('count');
            });

            for ($i = 11; $i >= 0; $i--) {
                $month = Carbon::now()->subMonths($i);
                $monthKey = $month->format('M');
                $labels[] = $monthKey;
                $data[] = $results[$monthKey] ?? 0;
            }

        } elseif ($period === 'month') {
            $startDate = Carbon::now()->subMonth();
            $query->where('created_at', '>=', $startDate);
            $results = $query->get()->keyBy('date');

            for ($i = 29; $i >= 0; $i--) {
                $date = Carbon::now()->subDays($i);
                $dateKey = $date->format('Y-m-d');
                $labels[] = $date->format('d M');
                $data[] = $results[$dateKey]->count ?? 0;
            }

        } else { // Week
            $startDate = Carbon::now()->subWeek();
            $query->where('created_at', '>=', $startDate);
            $results = $query->get()->keyBy('date');

            for ($i = 6; $i >= 0; $i--) {
                $date = Carbon::now()->subDays($i);
                $dateKey = $date->format('Y-m-d');
                $labels[] = $date->format('D'); // Day of the week e.g., "Mon"
                $data[] = $results[$dateKey]->count ?? 0;
            }
        }

        return response()->json([
            'labels' => $labels,
            'data' => $data,
        ]);
    }
}