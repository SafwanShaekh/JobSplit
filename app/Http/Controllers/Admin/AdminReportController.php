<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Job;
use App\Models\Complaint;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminReportController extends Controller
{
    /**
     * Report page dikhayein
     */
    public function index()
    {
        // Tamam zaroori data database se hasil karein
        $stats = [
            'total_users' => User::count(),
            'active_users' => User::where('is_active', true)->count(),
            'banned_users' => User::where('is_active', false)->count(),
            'total_jobs' => Job::count(),
            'total_complaints' => Complaint::count(),
            'pending_complaints' => Complaint::where('status', 'pending')->count(),
            'resolved_complaints' => Complaint::where('status', 'resolved')->count(),
        ];

        return view('admin.reports.index', compact('stats'));
    }

    /**
     * Report ko CSV format mein download karein
     */
    public function download()
    {
        $stats = [
            'Total Users' => User::count(),
            'Active Users' => User::where('is_active', true)->count(),
            'Banned Users' => User::where('is_active', false)->count(),
            'Total Jobs' => Job::count(),
            'Total Complaints' => Complaint::count(),
            'Pending Complaints' => Complaint::where('status', 'pending')->count(),
            'Resolved Complaints' => Complaint::where('status', 'resolved')->count(),
        ];

        $fileName = 'admin_report_' . Carbon::now()->format('Y_m_d') . '.csv';
        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $callback = function() use ($stats) {
            $file = fopen('php://output', 'w');
            
            // CSV ke headers
            fputcsv($file, ['Metric', 'Value']);

            // Data ki har row ko CSV mein daalein
            foreach ($stats as $key => $value) {
                fputcsv($file, [$key, $value]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
