<?php

namespace App\Services\AI;

use App\Models\Task;

class SuggestionGeneratorService
{
    /**
     * Generate saran tugas tertentu berdasarkan data tugas
     * 
     * @param Task $task The task to generate suggestions for
     * @return array Suggestions for the task
     */
    public function generateTaskSuggestions(Task $task): array
    {
        $suggestions = [];
        
        // Saran berdasarkan perbedaan antara perkiraan dan prediksi AI
        if ($task->estimated_hours && $task->ai_predicted_hours) {
            $diff = abs($task->estimated_hours - $task->ai_predicted_hours);
            $diffPercentage = ($task->estimated_hours > 0) ? ($diff / $task->estimated_hours) * 100 : 0;
            
            if ($diffPercentage > 30) {
                if ($task->ai_predicted_hours > $task->estimated_hours) {
                    $suggestions[] = "The AI predicts this task will take longer than your estimate ({$task->estimated_hours}h vs AI: {$task->ai_predicted_hours}h). Consider adding extra buffer time.";
                } else {
                    $suggestions[] = "The AI predicts this task will take less time than your estimate ({$task->estimated_hours}h vs AI: {$task->ai_predicted_hours}h). You might be overestimating the effort required.";
                }
            }
        }
        
        // Saran berdasarkan prioritas tugas
        if (!$task->priority) {
            $suggestions[] = "Consider setting a priority level for this task to help with planning and time management.";
        }
        
        // Saran berdasarkan deadline tugas
        if ($task->due_date) {
            $daysUntilDue = $task->due_date->diffInDays(now());
            
            if ($daysUntilDue < 3 && $task->status === 'todo') {
                $suggestions[] = "This task is due in $daysUntilDue days and is still pending. Consider starting on it soon.";
            } elseif ($daysUntilDue < 0) {
                $suggestions[] = "This task was due " . abs($daysUntilDue) . " days ago. Prioritize completing it as soon as possible.";
            }
        }
        
        // Saran umum berdasarkan karakteristik tugas
        $description = strtolower($task->description ?? '');
        $title = strtolower($task->title);
        
        if (strpos($description, 'research') !== false || strpos($title, 'research') !== false) {
            $suggestions[] = "For research tasks, consider setting specific goals and time limits to avoid going down rabbit holes.";
        }
        
        if (strpos($description, 'review') !== false || strpos($title, 'review') !== false) {
            $suggestions[] = "For review tasks, consider creating a checklist to ensure consistent and thorough reviews.";
        }
        
        return $suggestions;
    }
    
    /**
     * Generate Saran umum untuk meningkatkan produktivitas pengguna
     * 
     * @param int $userId User ID to generate suggestions for
     * @return array General productivity suggestions
     */
    public function generateGeneralSuggestions(int $userId): array
    {
        // ini masih implementasi contoh
        // Masih perlu dikembangkan supaya analisis data user lebih detail
        
        return [
            "Take regular breaks to maintain focus and prevent burnout.",
            "Try the Pomodoro Technique: work for 25 minutes, then take a 5-minute break.",
            "Organize your tasks by priority - tackle the most important ones first.",
            "Track your time to identify where your day actually goes.",
            "Plan your next day the evening before to start with clear goals."
        ];
    }
}