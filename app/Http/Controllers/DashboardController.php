<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use App\Models\TimeEntry;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Menampilakan dashboard pengguna dengan statistik proyek, tugas, dan entri waktu.
     */
    public function index(Request $request): View
    {
        $user = $request->user();
        
        // Get statistik proyek user
        $totalProjects = $user->projects()->count();
        $activeProjects = $user->projects()->where('status', '!=', 'completed')->count();
        
        // Get statistik entri waktu user
        $totalTimeEntries = $user->timeEntries()->count();
        $totalHoursThisWeek = $user->timeEntries()
            ->where('created_at', '>=', now()->startOfWeek())
            ->sum('duration_minutes') / 60;
            
        // Get statistik tugas user
        $totalTasks = $user->tasks()->count();
        $completedTasks = $user->tasks()->where('status', 'completed')->count();
        $completionRate = $totalTasks > 0 ? round(($completedTasks / $totalTasks) * 100, 1) : 0;
        
        // Get tugas terbaru untuk user
        $recentTasks = $user->tasks()
            ->with(['project'])
            ->latest()
            ->take(5)
            ->get();
            
        // Get entri waktu terbaru untuk user
        $recentTimeEntries = $user->timeEntries()
            ->with(['task.project'])
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', [
            'totalProjects' => $totalProjects,
            'activeProjects' => $activeProjects,
            'totalHoursThisWeek' => $totalHoursThisWeek,
            'totalTasks' => $totalTasks,
            'completedTasks' => $completedTasks,
            'completionRate' => $completionRate,
            'recentTasks' => $recentTasks,
            'recentTimeEntries' => $recentTimeEntries,
        ]);
    }
}