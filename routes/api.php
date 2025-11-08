<?php

use App\Http\Controllers\API\AITaskPredictionController;
use App\Http\Controllers\API\AITaskBreakdownController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    // AI Task Prediction routes
    Route::post('/ai/task-prediction', [AITaskPredictionController::class, 'predictTaskDuration'])
        ->name('api.ai.task-prediction');
    
    // AI Task Breakdown routes
    Route::post('/ai/task-breakdown', [AITaskBreakdownController::class, 'generateSubtasks'])
        ->name('api.ai.task-breakdown');
});