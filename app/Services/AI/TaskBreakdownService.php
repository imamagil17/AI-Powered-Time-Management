<?php

namespace App\Services\AI;

use App\Models\Project;
use App\Models\Task;

class TaskBreakdownService
{
    /**
     * Generate subtasks berdasaran deskripsi proyek menggunakan AI
     * 
     * @param string $projectDescription Description of the project
     * @param int $projectId Project ID to associate tasks with
     * @param array $context Additional context for the breakdown
     * @return array Array of task data
     */
    public function generateSubtasksFromProject(string $projectDescription, int $projectId, array $context = []): array
    {
        // Ini masih  contoh implementasi
        // Masih perlu integrasi dengan model LLM (Gemini, grok dll)
        // untuk menghasilkan subtasks yang lebih akurat
        
        // Sekarang masih generate contoh return buat testing
        // berdasarkan kata kunci dalam deskripsi proyek
        
        $tasks = [];
        
        if (stripos($projectDescription, 'web') !== false || 
            stripos($projectDescription, 'application') !== false ||
            stripos($projectDescription, 'app') !== false) {
            
            $tasks = [
                [
                    'title' => 'Requirements Analysis',
                    'description' => 'Analyze the requirements for the ' . substr($projectDescription, 0, 50) . '...',
                    'priority' => 'high',
                    'estimated_hours' => 8,
                    'status' => 'todo',
                ],
                [
                    'title' => 'System Design',
                    'description' => 'Design the architecture and system components for ' . substr($projectDescription, 0, 50) . '...',
                    'priority' => 'high',
                    'estimated_hours' => 12,
                    'status' => 'todo',
                ],
                [
                    'title' => 'Development',
                    'description' => 'Develop the core features for ' . substr($projectDescription, 0, 50) . '...',
                    'priority' => 'high',
                    'estimated_hours' => 40,
                    'status' => 'todo',
                ],
                [
                    'title' => 'Testing',
                    'description' => 'Test all features and functionality for ' . substr($projectDescription, 0, 50) . '...',
                    'priority' => 'medium',
                    'estimated_hours' => 16,
                    'status' => 'todo',
                ],
                [
                    'title' => 'Deployment',
                    'description' => 'Deploy the ' . substr($projectDescription, 0, 50) . ' to production',
                    'priority' => 'medium',
                    'estimated_hours' => 4,
                    'status' => 'todo',
                ]
            ];
        } else {
            // Default contoh tasks
            $tasks = [
                [
                    'title' => 'Research and Planning',
                    'description' => 'Research and plan the ' . substr($projectDescription, 0, 50) . ' project',
                    'priority' => 'high',
                    'estimated_hours' => 10,
                    'status' => 'todo',
                ],
                [
                    'title' => 'Initial Implementation',
                    'description' => 'Implement the initial version of ' . substr($projectDescription, 0, 50) . '...',
                    'priority' => 'high',
                    'estimated_hours' => 20,
                    'status' => 'todo',
                ],
                [
                    'title' => 'Review and Refinement',
                    'description' => 'Review and refine ' . substr($projectDescription, 0, 50) . ' based on feedback',
                    'priority' => 'medium',
                    'estimated_hours' => 10,
                    'status' => 'todo',
                ]
            ];
        }
        
        // prediksi ai untuk setiap task
        foreach ($tasks as &$task) {
            $predictionService = new TaskPredictionService();
            $predictedHours = $predictionService->predictTaskDuration(
                $task['description'],
                $projectId,
                $task['priority']
            );
            
            $task['ai_predicted_hours'] = $predictedHours;
        }
        
        return $tasks;
    }
    
    /**
     * Buat task dari deskripsi proyek menggunakan AI
     * 
     * @param string $projectDescription Description of the project
     * @param Project $project Project model instance
     * @return array Array of created Task models
     */
    public function createTasksFromProject(string $projectDescription, Project $project): array
    {
        $taskData = $this->generateSubtasksFromProject($projectDescription, $project->id);
        $tasks = [];
        
        foreach ($taskData as $taskDatum) {
            $tasks[] = $project->tasks()->create($taskDatum);
        }
        
        return $tasks;
    }
}