<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class GenerateHoaxQuiz implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle()
    {
        $response = Http::timeout(120)
            ->retry(3, 2000)
            ->get(env('FASTAPI_BASE_URL') . '/api/hoax-quiz/generate');

        if ($response->successful()) {
            return $response->json();
        }

        $this->fail(new \Exception('Failed to generate quiz'));
    }
}
