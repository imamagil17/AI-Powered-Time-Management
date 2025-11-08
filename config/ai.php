<?php

return [
    /*
    |--------------------------------------------------------------------------
    | AI Service Configuration
    |--------------------------------------------------------------------------
    |
    | This configuration file defines the settings for AI services in the
    | AI-Powered Time Management System. You can configure different LLM
    | providers and their settings here.
    |
    */

    'default_provider' => env('LLM_PROVIDER', 'mock'),
    
    'providers' => [
        'mock' => [
            'driver' => 'mock',
        ],
        
        'openai' => [
            'driver' => 'openai',
            'api_key' => env('OPENAI_API_KEY'),
            'model' => env('LLM_MODEL', 'gpt-4-turbo'),
        ],
        
        'anthropic' => [
            'driver' => 'anthropic',
            'api_key' => env('ANTHROPIC_API_KEY'),
            'model' => env('LLM_MODEL', 'claude-3-opus-20240229'),
        ],
        
        'ollama' => [
            'driver' => 'ollama',
            'base_url' => env('OLLAMA_BASE_URL', 'http://localhost:11434'),
            'model' => env('LLM_MODEL', 'llama3'),
        ],
    ],
    
    'task_prediction' => [
        // Konfigurasi untuk prediksi durasi tugas otomatis
        'enabled' => true,
        'default_hours' => 2.0,
        'min_hours' => 0.1,
        'max_hours' => 168, // Max 1 week
    ],
    
    'task_breakdown' => [
        // Konfigurasi untuk breakdown tugas otomatis
        'enabled' => true,
        'max_subtasks' => 10,
        'default_priority' => 'medium',
    ],
    
    'privacy' => [
        // Privacy dan security settings
        'mask_sensitive_data' => true,
        'log_requests' => env('AI_LOG_REQUESTS', false),
        'filter_personal_info' => true,
    ],
];