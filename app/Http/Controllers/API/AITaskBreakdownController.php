<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Services\AI\TaskBreakdownService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AITaskBreakdownController extends Controller
{
    protected TaskBreakdownService $taskBreakdownService;

    public function __construct(TaskBreakdownService $taskBreakdownService)
    {
        $this->taskBreakdownService = $taskBreakdownService;
    }

    /**
     * membagi tugas proyek menjadi subtugas menggunakan AI
     */
    public function generateSubtasks(Request $request): JsonResponse
    {
        $request->validate([
            'project_description' => 'required|string|max:2000',
            'project_id' => 'nullable|exists:projects,id',
        ]);

        $subtasks = $this->taskBreakdownService->generateSubtasksFromProject(
            $request->project_description,
            $request->project_id ?? 0, //override null dengan 0 kalau proyek tidak ada
            $request->all()
        );

        return response()->json([
            'success' => true,
            'subtasks' => $subtasks,
            'project_description' => $request->project_description
        ]);
    }
}