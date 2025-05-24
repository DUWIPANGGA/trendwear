<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    public function index(Request $request)
    {
        $query = ActivityLog::with('user')->latest();

        // Filter by date range
        if ($request->has('date_from') && $request->date_from) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->has('date_to') && $request->date_to) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        // Filter by user
        if ($request->has('user_id') && $request->user_id) {
            $query->where('user_id', $request->user_id);
        }

        // Filter by action type
        if ($request->has('action') && $request->action) {
            $query->where('action', $request->action);
        }

        $logs = $query->paginate(20);

        return view('admin.activity-logs.index', [
            'logs' => $logs,
            'users' => \App\Models\User::all(),
            'actions' => ActivityLog::select('action')->distinct()->pluck('action')
        ]);
    }

    public function show(ActivityLog $activityLog)
    {
        return view('admin.activity-logs.show', compact('activityLog'));
    }

    public function destroy(ActivityLog $activityLog)
    {
        $activityLog->delete();

        return redirect()->route('admin.activity-logs.index')
            ->with('success', 'Activity log deleted successfully');
    }

    public function clearOldLogs()
    {
        $cutoffDate = now()->subMonths(3); // Hapus log yang lebih dari 3 bulan
        ActivityLog::where('created_at', '<', $cutoffDate)->delete();

        return back()->with('success', 'Old activity logs cleared successfully');
    }
}