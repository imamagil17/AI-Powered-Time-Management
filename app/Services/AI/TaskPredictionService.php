<?php

namespace App\Services\AI;

use App\Models\Task;

class TaskPredictionService
{
    /**
     * Prediksi durasi tugas berdasarkan deskripsi menggunakan AI dan beberapa faktor basic
     * 
     * @param string $taskDescription Description of the task
     * @param int|null $projectId Project ID if available
     * @param string|null $taskType Type of task
     * @return float Predicted hours for the task
     */
    public function predictTaskDuration(string $taskDescription, ?int $projectId = null, ?string $taskType = null): float
    {
        // sama juga ini masih contoh implementasi
        // aslinya harusnya pake model LLM
        // untuk analisis deskripsi tugas dan prediksi durasi yang lebih akurat
        
        // basic prediksi berdasarkan panjang deskripsi
        $descriptionLength = strlen($taskDescription);
        $wordCount = str_word_count($taskDescription);
        
        // basic prediksi berdasarkan kumlah kata (masih  heuristic)
        $predictedHours = max(0.5, $wordCount * 0.1);
        
        // ubah berdasarkan konteks proyek kalau ada
        if ($projectId) {
            // logic nya bisa disini
        }
        
        // Ubah berdasarkan tipe tugas kalau ada
        if ($taskType) {
            switch ($taskType) {
                case 'development':
                    $predictedHours *= 1.2;
                    break;
                case 'design':
                    $predictedHours *= 1.0;
                    break;
                case 'research':
                    $predictedHours *= 1.5;
                    break;
                default:
                    $predictedHours *= 1.0;
            }
        }
        
        return round($predictedHours, 2);
    }
    
    /**
     * Update task model dengan prediksi durasi AI ke db
     * 
     * @param Task $task The task model instance
     * @param string|null $taskDescription Description to use for prediction
     * @return void
     */
    public function updateTaskPrediction(Task $task, ?string $taskDescription = null): void
    {
        $description = $taskDescription ?? $task->description;
        $prediction = $this->predictTaskDuration(
            $description, 
            $task->project_id, 
            $task->priority // pakai priority sebagai tipe tugas dulu sementara
        );
        
        $task->update([
            'ai_predicted_hours' => $prediction
        ]);
    }
}