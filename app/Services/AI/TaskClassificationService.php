<?php

namespace App\Services\AI;

use App\Models\Task;

class TaskClassificationService
{
    /**
     * Klasifikasikan tugas berdasarkan deskripsi menggunakan AI
     * 
     * @param string $taskDescription Description of the task
     * @return array Classification results
     */
    public function classifyTask(string $taskDescription): array
    {
        $description = strtolower($taskDescription);
        
        // Task type classification
        $type = $this->determineTaskType($description);
        
        // Priority prediction
        $priority = $this->predictPriority($description);
        
        // Category prediction
        $category = $this->determineCategory($description);
        
        return [
            'type' => $type,
            'priority' => $priority,
            'category' => $category,
        ];
    }
    
    /**
     * Menentukan tipe tugas berdasarkan deskripsi
     * 
     * @param string $description Lowercase task description
     * @return string Task type
     */
    private function determineTaskType(string $description): string
    {
        $developmentKeywords = ['code', 'develop', 'program', 'function', 'api', 'database', 'backend', 'frontend', 'software', 'script', 'algorithm', 'feature'];
        $designKeywords = ['design', 'ui', 'ux', 'interface', 'wireframe', 'mockup', 'prototype', 'visual', 'layout', 'graphic', 'logo', 'branding'];
        $researchKeywords = ['research', 'study', 'analyze', 'investigate', 'document', 'report', 'survey', 'data', 'market', 'competitor'];
        $meetingKeywords = ['meeting', 'call', 'discuss', 'review', 'sync', 'brainstorm', 'planning', 'retro'];
        $administrativeKeywords = ['email', 'admin', 'organize', 'schedule', 'coordinate', 'prepare', 'update', 'maintain', 'document'];
        
        $counts = [
            'development' => 0,
            'design' => 0,
            'research' => 0,
            'meeting' => 0,
            'administrative' => 0,
        ];
        
        foreach ($developmentKeywords as $keyword) {
            if (strpos($description, $keyword) !== false) {
                $counts['development']++;
            }
        }
        
        foreach ($designKeywords as $keyword) {
            if (strpos($description, $keyword) !== false) {
                $counts['design']++;
            }
        }
        
        foreach ($researchKeywords as $keyword) {
            if (strpos($description, $keyword) !== false) {
                $counts['research']++;
            }
        }
        
        foreach ($meetingKeywords as $keyword) {
            if (strpos($description, $keyword) !== false) {
                $counts['meeting']++;
            }
        }
        
        foreach ($administrativeKeywords as $keyword) {
            if (strpos($description, $keyword) !== false) {
                $counts['administrative']++;
            }
        }
        
        // Mengembalikan tipe dengan hitungan tertinggi
        $maxType = array_keys($counts, max($counts))[0];
        return $maxType !== 0 ? $maxType : 'development';
    }
    
    /**
     * Prediksi prioritas tugas berdasarkan deskripsi
     * 
     * @param string $description Lowercase task description
     * @return string Priority level (high/medium/low)
     */
    private function predictPriority(string $description): string
    {
        $highPriorityKeywords = ['urgent', 'asap', 'critical', 'immediate', 'important', 'deadline', 'client', 'security', 'bug', 'crucial', 'essential'];
        $mediumPriorityKeywords = ['normal', 'standard', 'regular', 'routine', 'should', 'could', 'nice to have', 'eventually'];
        $lowPriorityKeywords = ['low', 'later', 'eventually', 'optional', 'if time permits', 'backlog'];
        
        $highCount = 0;
        $mediumCount = 0;
        $lowCount = 0;
        
        foreach ($highPriorityKeywords as $keyword) {
            if (strpos($description, $keyword) !== false) {
                $highCount++;
            }
        }
        
        foreach ($mediumPriorityKeywords as $keyword) {
            if (strpos($description, $keyword) !== false) {
                $mediumCount++;
            }
        }
        
        foreach ($lowPriorityKeywords as $keyword) {
            if (strpos($description, $keyword) !== false) {
                $lowCount++;
            }
        }
        
        // Menentukan prioritas berdasarkan keyword yang ditemukan
        if ($highCount > $mediumCount && $highCount > $lowCount) {
            return 'high';
        } elseif ($mediumCount > $lowCount) {
            return 'medium';
        } else {
            // Default ke medium kalau tidak ada keyword prioritas yang jelas
            return $lowCount > 0 ? 'low' : 'medium';
        }
    }
    
    /**
     * Menentukan kategori tugas berdasarkan deskripsi
     * 
     * @param string $description Lowercase task description
     * @return string Task category
     */
    private function determineCategory(string $description): string
    {
        // Masih menggunakan logika tipe tugas untuk kategori
        // tapi bisa dikembangkan lebih lanjut dengan kategori granular
        return $this->determineTaskType($description);
    }
    
    /**
     * klasifikasikan model tugas dan kembalikan atribut yang diperbarui
     * 
     * @param Task $task Task model to classify
     * @return array Updated task attributes after classification
     */
    public function classifyTaskModel(Task $task): array
    {
        $classification = $this->classifyTask($task->description ?? $task->title);
        
        $updates = [];
        if (!$task->type) { // Assuming we add a 'type' field to tasks
            $updates['type'] = $classification['type'];
        }
        
        if (!$task->priority) {
            $updates['priority'] = $classification['priority'];
        }
        
        // masih mau saya tambahkan kategori juga atau field lain
        $updates['category'] = $classification['category'];
        
        return $updates;
    }
}