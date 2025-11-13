<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use App\Models\TimeEntry;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(Request $request): View
    {
        $user = $request->user();

        $totalProjects = $user->projects()->count();
        $activeProjects = $user->projects()
            ->where('status', '!=', 'completed')
            ->count();

        $totalTimeEntries = $user->timeEntries()->count();
        $totalHoursThisWeek = $user->timeEntries()
            ->where('created_at', '>=', now()->startOfWeek())
            ->sum('duration_minutes') / 60;

        $projectIds = $user->projects()->pluck('projects.id');

        $tasksBaseQuery = Task::whereIn('project_id', $projectIds);

        $totalTasks = (clone $tasksBaseQuery)->count();

        $completedTasks = (clone $tasksBaseQuery)
            ->where('status', 'completed')
            ->count();

        $completionRate = $totalTasks > 0
            ? round(($completedTasks / $totalTasks) * 100, 1)
            : 0;

        $recentTasks = (clone $tasksBaseQuery)
            ->with('project')
            ->latest()
            ->take(5)
            ->get();

        $recentTimeEntries = $user->timeEntries()
            ->with(['task.project'])
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', [
            'totalProjects'       => $totalProjects,
            'activeProjects'      => $activeProjects,
            'totalHoursThisWeek'  => $totalHoursThisWeek,
            'totalTasks'          => $totalTasks,
            'completedTasks'      => $completedTasks,
            'completionRate'      => $completionRate,
            'recentTasks'         => $recentTasks,
            'recentTimeEntries'   => $recentTimeEntries,
        ]);
    }
}
