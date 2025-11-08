<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use App\Services\AI\TaskBreakdownService;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    /**
     * Menampilkan daftar semua proyek pengguna
     */
    public function index(): View
    {
        $projects = Auth::user()->projects()->with(['tasks'])->get();
        return view('projects.index', compact('projects'));
    }

    /**
     * Menampilkan form untuk membuat proyek baru
     */
    public function create(): View
    {
        return view('projects.create');
    }

    /**
     * Menyimpan proyek baru ke db
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:pending,in progress,completed',
            'start_date' => 'nullable|date',
            'due_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        $project = Project::create([
            'owner_id' => Auth::id(),
            'name' => $request->name,
            'description' => $request->description,
            'status' => $request->status,
            'start_date' => $request->start_date,
            'due_date' => $request->due_date,
        ]);

        // kalau deskripsi ada, buat tugas dari deskripsi proyek menggunakan AI
        if (!empty($request->description)) {
            $taskBreakdownService = new TaskBreakdownService();
            $taskBreakdownService->createTasksFromProject($request->description, $project);
        }

        return redirect()->route('projects.index')
            ->with('success', 'Project created successfully.');
    }

    /**
     * Menampilkan detail proyek tertentu
     */
    public function show(Project $project): View
    {
        $this->authorize('view', $project);
        
        $tasks = $project->tasks()->with(['timeEntries'])->get();
        
        return view('projects.show', compact('project', 'tasks'));
    }

    /**
     * Menampilkan form untuk mengedit resource tertentu
     */
    public function edit(Project $project): View
    {
        $this->authorize('update', $project);
        
        return view('projects.edit', compact('project'));
    }

    /**
     * Update resource tertentu di db
     */
    public function update(Request $request, Project $project): RedirectResponse
    {
        $this->authorize('update', $project);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:pending,in progress,completed',
            'start_date' => 'nullable|date',
            'due_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        $project->update([
            'name' => $request->name,
            'description' => $request->description,
            'status' => $request->status,
            'start_date' => $request->start_date,
            'due_date' => $request->due_date,
        ]);

        return redirect()->route('projects.index')
            ->with('success', 'Project updated successfully.');
    }

    /**
     * Hapus resource tertentu dari db
     */
    public function destroy(Project $project): RedirectResponse
    {
        $this->authorize('delete', $project);
        
        $project->delete();

        return redirect()->route('projects.index')
            ->with('success', 'Project deleted successfully.');
    }
}