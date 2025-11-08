<?php

return [
    /*
    |--------------------------------------------------------------------------
    | LLM Provider Configuration
    |--------------------------------------------------------------------------
    |
    | This configuration file defines the different LLM providers that can
    | be used by the AI services in the application. Each provider can be
    | configured with its specific settings and credentials.
    |
    */
    
    'default' => env('LLM_PROVIDER', 'mock'),
    
    'providers' => [
        'mock' => [
            'class' => App\Services\LLM\MockProvider::class,
        ],
        
        'openai' => [
            'class' => App\Services\LLM\OpenAIProvider::class,
            'api_key' => env('OPENAI_API_KEY'),
            'model' => env('LLM_MODEL', 'gpt-4-turbo'),
            'temperature' => env('OPENAI_TEMPERATURE', 0.7),
            'max_tokens' => env('OPENAI_MAX_TOKENS', 1000),
        ],
        
        'anthropic' => [
            'class' => App\Services\LLM\AnthropicProvider::class,
            'api_key' => env('ANTHROPIC_API_KEY'),
            'model' => env('LLM_MODEL', 'claude-3-opus-20240229'),
            'temperature' => env('ANTHROPIC_TEMPERATURE', 0.7),
        ],
        
        'ollama' => [
            'class' => App\Services\LLM\OllamaProvider::class,
            'base_url' => env('OLLAMA_BASE_URL', 'http://localhost:11434'),
            'model' => env('LLM_MODEL', 'llama3'),
        ],
    ],
    
    'timeout' => env('LLM_TIMEOUT', 30),
    'max_retries' => env('LLM_MAX_RETRIES', 3),
];