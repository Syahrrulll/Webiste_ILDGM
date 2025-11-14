<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class FastApiService
{
    protected $base;

    public function __construct()
    {
        $this->base = rtrim(env('FASTAPI_BASE_URL', 'https://127.0.0.1:8001'), '/');
    }

    public function generateHoax()
    {
        return Http::timeout(30)->post("{$this->base}/api/hoax-quiz/generate")->json();
    }

    public function checkHoax(array $payload)
    {
        return Http::timeout(30)->post("{$this->base}/api/hoax-quiz/check", $payload)->json();
    }

    public function generateMission(array $payload)
    {
        return Http::timeout(30)->post("{$this->base}/api/game/generate-mission", $payload)->json();
    }

    public function validateMission(string $missionId, array $payload)
    {
        return Http::timeout(30)->post("{$this->base}/api/game/validate-quiz/{$missionId}", $payload)->json();
    }
}
