<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use App\Notifications\ComplaintInProgressNotification;
use App\Notifications\ComplaintResolvedNotification; // Ise add karein
use Illuminate\Http\Request;
use Carbon\Carbon; // Ise add karein

class ComplaintController extends Controller
{
    /**
     * Display a paginated and searchable list of all complaints.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $complaints = Complaint::with('user')
            ->when($search, function ($query, $searchTerm) {
                return $query->where('subject', 'like', "%{$searchTerm}%") // Ab subject se search karega
                             ->orWhere('message', 'like', "%{$searchTerm}%")
                             ->orWhereHas('user', function ($q) use ($searchTerm) {
                                 $q->where('name', 'like', "%{$searchTerm}%");
                             });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.complaints.index', compact('complaints'));
    }

    public function markAsInProgress(Complaint $complaint)
    {
        $complaint->status = 'in progress';
        $complaint->save();

        // User ko 'in progress' ki notification bhejें
        $complaint->user->notify(new ComplaintInProgressNotification($complaint));

        return back()->with('success', 'Complaint marked as In Progress and user notified.');
    }

    /**
     * Mark a complaint as resolved and notify the user.
     */
    public function resolve(Complaint $complaint)
    {
        $complaint->status = 'resolved';
        $complaint->resolved_at = Carbon::now(); // Resolve hone ka time save karein
        $complaint->save();

        // User ko notification bhejें
        $complaint->user->notify(new ComplaintResolvedNotification($complaint));

        return back()->with('success', 'Complaint marked as resolved and user notified.');
    }
    
    /**
     * Get the count of pending complaints for the sidebar badge.
     */
    public function count()
    {
        $count = Complaint::where('status', 'pending')->count();
        return response()->json(['count' => $count]);
    }
}