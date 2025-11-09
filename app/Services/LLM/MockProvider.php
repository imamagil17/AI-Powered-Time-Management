<?php

namespace App\Services\LLM;

use App\Services\LLM\LLMProviderInterface;

class MockProvider implements LLMProviderInterface
{
    /**
     * Implementasi mock/sementara
     * 
     * @param string $prompt The input prompt
     * @param array $options Additional options for the request
     * @return string The mock response from the LLM
     */
    public function generate(string $prompt, array $options = []): string
    {
        // Masih implementasi mock/sementara
        // Nanti akan diganti dengan call API ke LLM betulan
        
        // Hasil return masih dummy untuk testing
        // berdasarkan kata kunci dalam prompt
        if (stripos($prompt, 'predict') !== false && stripos($prompt, 'duration') !== false) {
            // respon dummy untuk prediksi durasi
            $words = str_word_count($prompt);
            $estimatedHours = max(0.5, $words * 0.1);
            return json_encode(['prediction' => $estimatedHours, 'unit' => 'hours']);
        } elseif (stripos($prompt, 'breakdown') !== false || stripos($prompt, 'subtasks') !== false) {
            // respon dummy untuk breakdown tugas
            return json_encode([
                'tasks' => [
                    ['title' => 'Step 1', 'description' => 'First step of the task', 'estimated_hours' => 2],
                    ['title' => 'Step 2', 'description' => 'Second step of the task', 'estimated_hours' => 1.5],
                    ['title' => 'Step 3', 'description' => 'Final step of the task', 'estimated_hours' => 3],
                ]
            ]);
        } else {
            return "Mock response for: " . substr($prompt, 0, 50) . "...";
        }
    }
    
    /**
     * Get provider name
     * 
     * @return string The name of the provider
     */
    public function getName(): string
    {
        return 'mock';
    }
}