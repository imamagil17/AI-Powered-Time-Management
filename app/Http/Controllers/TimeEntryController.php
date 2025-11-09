<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TimeEntry;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class TimeEntryController extends Controller
{
    /**
     * Menampilkan daftar semua entri waktu user
     */
    public function index(): View
    {
        $timeEntries = Auth::user()->timeEntries()
            ->with(['task.project'])
            ->orderBy('start_time', 'desc')
            ->paginate(15);
            
        return view('time-entries.index', compact('timeEntries'));
    }

    /**
     * Menampilkan form untuk membuat entri waktu baru
     */
    public function create(): View
    {
        $tasks = Auth::user()->tasks()->where('status', '!=', 'completed')->get();
        return view('time-entries.create', compact('tasks'));
    }

    /**
     * Menyimpan entri waktu baru ke db
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'task_id' => 'required|exists:tasks,id',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'notes' => 'nullable|string',
        ]);

        // Hitung total durasi dalam menit
        $start = new \DateTime($request->start_time);
        $end = new \DateTime($request->end_time);
        $duration = $end->diff($start)->i + ($end->diff($start)->h * 60);

        TimeEntry::create([
            'user_id' => Auth::id(),
            'task_id' => $request->task_id,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'duration_minutes' => $duration,
            'notes' => $request->notes,
        ]);

        return redirect()->route('time-entries.index')
            ->with('success', 'Time entry created successfully.');
    }

    /**
     * Menampilkan detail entri waktu tertentu
     */
    public function show(TimeEntry $timeEntry): View
    {
        $this->authorize('view', $timeEntry);
        
        return view('time-entries.show', compact('timeEntry'));
    }

    /**
     * Menampilkan form untuk mengedit entri waktu tertentu
     */
    public function edit(TimeEntry $timeEntry): View
    {
        $this->authorize('update', $timeEntry);
        
        $tasks = Auth::user()->tasks;
        
        return view('time-entries.edit', compact('timeEntry', 'tasks'));
    }

    /**
     * Update entri waktu tertentu di db
     */
    public function update(Request $request, TimeEntry $timeEntry): RedirectResponse
    {
        $this->authorize('update', $timeEntry);
        
        $request->validate([
            'task_id' => 'required|exists:tasks,id',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'notes' => 'nullable|string',
        ]);

        // Menghitung total durasi dalam menit
        $start = new \DateTime($request->start_time);
        $end = new \DateTime($request->end_time);
        $duration = $end->diff($start)->i + ($end->diff($start)->h * 60);

        $timeEntry->update([
            'task_id' => $request->task_id,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'duration_minutes' => $duration,
            'notes' => $request->notes,
        ]);

        return redirect()->route('time-entries.index')
            ->with('success', 'Time entry updated successfully.');
    }

    /**
     * Hapus entri waktu tertentu dari db
     */
    public function destroy(TimeEntry $timeEntry): RedirectResponse
    {
        $this->authorize('delete', $timeEntry);
        
        $timeEntry->delete();

        return redirect()->route('time-entries.index')
            ->with('success', 'Time entry deleted successfully.');
    }
}