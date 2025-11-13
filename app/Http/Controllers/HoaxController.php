<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth; // <-- Diperlukan
use App\Services\BadgeService;      // <-- Diperlukan
use App\Models\Score;               // <-- Diperlukan

class HoaxController extends Controller
{
    protected $apiBaseUrl = 'http://127.0.0.1:8001';
    protected $badgeService;

    // Inject BadgeService
    public function __construct(BadgeService $badgeService)
    {
        $this->badgeService = $badgeService;
    }

    /**
     * Menghasilkan kuis Hoax/Fakta baru dan menampilkannya.
     */
    public function showQuiz()
    {
        try {
            $response = Http::timeout(60)
                ->get($this->apiBaseUrl . '/api/hoax-quiz/generate');

            if (!$response->successful()) {
                $errorData = $response->json();
                $errorMessage = $errorData['detail'] ?? $response->body();
                Log::error('Gagal generate-hoax dari AI', ['status' => $response->status(), 'body' => $errorMessage]);
                return view('hoax.index')->with('error', 'Gagal membuat kuis Hoax dari AI. Coba lagi. Detail: ' . $errorMessage);
            }

            $data = $response->json();
            return view('hoax.index', ['mission' => $data]);

        } catch (\Exception $e) {
            Log::error('Error showQuiz Hoax', ['error' => $e->getMessage()]);
            return view('hoax.index')->with('error', 'Terjadi kesalahan sistem: ' . $e->getMessage());
        }
    }

    /**
     * Memeriksa jawaban Hoax/Fakta dari pengguna dan menampilkan hasil.
     */
    public function checkAnswer(Request $request)
    {
        $request->validate([
            'mission_id' => 'required|string',
            'user_choice' => 'required|string|in:Hoax,Fakta',
        ]);

        try {
            $response = Http::timeout(30)
                ->post($this->apiBaseUrl . "/api/hoax-quiz/check", [
                    'mission_id' => $request->input('mission_id'),
                    'user_choice' => $request->input('user_choice'),
                ]);

            if (!$response->successful()) {
                $errorData = $response->json();
                $errorMessage = $errorData['detail'] ?? $response->body();
                Log::error('Gagal check-hoax dari AI', ['status' => $response->status(), 'body' => $errorMessage]);
                return redirect(route('hoax.index'))->with('error', 'Gagal memvalidasi kuis. Mungkin kuis sudah kedaluwarsa. Coba lagi. Detail: ' . $errorMessage);
            }

            $data = $response->json();
            $user = Auth::user();
            $gameType = 'Hoax or Not?';
            $score = $data['is_correct'] ? 100 : 0; // Skor 100 jika benar, 0 jika salah

            // --- LOGIKA SKOR & BADGE BARU ---
            Score::create([
                'user_id' => $user->id,
                'game_type' => $gameType,
                'score' => $score
            ]);
            $this->badgeService->checkAndAwardBadges($user, $gameType, $score);
            // --- AKHIR LOGIKA BARU ---

            // Tambahkan skor ke data yang dikirim ke view
            $data['score'] = $score;

            return view('hoax.result', [
                'result' => $data,
                'user_choice' => $request->input('user_choice')
            ]);

        } catch (\Exception $e) {
            Log::error('Error checkAnswer Hoax', ['error' => $e->getMessage()]);
            return redirect(route('hoax.index'))->with('error', 'Terjadi kesalahan sistem: ' . $e->getMessage());
        }
    }
}
