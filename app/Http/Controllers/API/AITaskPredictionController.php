<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\Project;
use App\Services\AI\TaskPredictionService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AITaskPredictionController extends Controller
{
    protected TaskPredictionService $taskPredictionService;

    public function __construct(TaskPredictionService $taskPredictionService)
    {
        $this->taskPredictionService = $taskPredictionService;
    }

    /**
     * prediksi durasi tugas dengan AI
     */
    public function predictTaskDuration(Request $request): JsonResponse
    {
        $request->validate([
            'description' => 'required|string|max:1000',
            'project_id' => 'nullable|exists:projects,id',
            'task_type' => 'nullable|string|max:255',
        ]);

        $prediction = $this->taskPredictionService->predictTaskDuration(
            $request->description,
            $request->project_id,
            $request->task_type
        );

        return response()->json([
            'success' => true,
            'predicted_hours' => $prediction,
            'description' => $request->description
        ]);
    }
}