<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use App\Services\AI\TaskPredictionService;
use App\Services\AI\TaskClassificationService;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Menampilkan daftar semua tugas user
     */
    public function index(): View
    {
        // Menagambil task milik user yang sedang login beserta relasi projectnya
        $tasks = Auth::user()->tasks()->with(['project'])->get();
        return view('tasks.index', compact('tasks'));
    }

    /**
     * Menampilkan form untuk membuat resource baru
     */
    public function create(Request $request): View
    {
        $project = null;
        if ($request->has('project_id')) {
            $project = Project::find($request->project_id);
        }
        
        $projects = Auth::user()->projects;
        
        return view('tasks.create', compact('projects', 'project'));
    }

    /**
     * Simpan resource baru ke db
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'project_id' => 'required|exists:projects,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:todo,in progress,completed',
            'priority' => 'nullable|in:low,medium,high',
            'due_date' => 'nullable|date',
            'estimated_hours' => 'nullable|numeric|min:0.1',
        ]);

        $task = Task::create([
            'project_id' => $request->project_id,
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'priority' => $request->priority ?? 'medium',
            'due_date' => $request->due_date,
            'estimated_hours' => $request->estimated_hours,
        ]);

        // Ai Untuk memprediksi durasi tugas jika deskripsi disediakan
        if (!empty($task->description)) {
            $predictionService = new TaskPredictionService();
            $predictionService->updateTaskPrediction($task);
        }

        // Ai Untuk mengklasifikasikan tugas
        $classificationService = new TaskClassificationService();
        $classification = $classificationService->classifyTaskModel($task);
        
        if (!empty($classification)) {
            $task->update($classification);
        }

        return redirect()->route('projects.show', ['project' => $request->project_id])
            ->with('success', 'Task created successfully.');
    }

    /**
     * Menampilkan detail resource tertentu
     */
    public function show(Task $task): View
    {
        $this->authorize('view', $task);
        
        return view('tasks.show', compact('task'));
    }

    /**
     * Menampilkan form untuk mengedit resource tertentu
     */
    public function edit(Task $task): View
    {
        $this->authorize('update', $task);
        
        $projects = Auth::user()->projects;
        
        return view('tasks.edit', compact('task', 'projects'));
    }

    /**
     * Update resource tertentu di db
     */
    public function update(Request $request, Task $task): RedirectResponse
    {
        $this->authorize('update', $task);
        
        $request->validate([
            'project_id' => 'required|exists:projects,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:todo,in progress,completed',
            'priority' => 'nullable|in:low,medium,high',
            'due_date' => 'nullable|date',
            'estimated_hours' => 'nullable|numeric|min:0.1',
        ]);

        $task->update([
            'project_id' => $request->project_id,
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'priority' => $request->priority,
            'due_date' => $request->due_date,
            'estimated_hours' => $request->estimated_hours,
        ]);

        // Ai Untuk memprediksi durasi tugas jika ada deskripsi
        if (!empty($task->description)) {
            $predictionService = new TaskPredictionService();
            $predictionService->updateTaskPrediction($task);
        }

        return redirect()->route('projects.show', ['project' => $request->project_id])
            ->with('success', 'Task updated successfully.');
    }

    /**
     * Menghapus resource tertentu dari db
     */
    public function destroy(Task $task): RedirectResponse
    {
        $this->authorize('delete', $task);
        
        $projectId = $task->project_id;
        $task->delete();

        return redirect()->route('projects.show', ['project' => $projectId])
            ->with('success', 'Task deleted successfully.');
    }
}