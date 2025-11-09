<?php

namespace App\Services\LLM;

interface LLMProviderInterface
{
    /**
     * Send a request ke LLM Provider
     * 
     * @param string $prompt The input prompt
     * @param array $options Additional options for the request
     * @return string The response from the LLM
     */
    public function generate(string $prompt, array $options = []): string;
    
    /**
     * Get provider name
     * 
     * @return string The name of the provider
     */
    public function getName(): string;
}