<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth; // <-- Diperlukan
use App\Services\BadgeService;      // <-- Diperlukan
use App\Services\FastApiService;
use App\Models\Score;               // <-- Diperlukan

class HoaxController extends Controller
{
    protected $apiBaseUrl = 'https://fast-api-literise.vercel.app';
    protected $badgeService;

    // Inject BadgeService
    public function __construct(BadgeService $badgeService)
    {
        $this->badgeService = $badgeService;
        $this->apiBaseUrl = env('FASTAPI_BASE_URL', 'https://fast-api-literise.vercel.app');

    }

    /**
     * Menghasilkan kuis Hoax/Fakta baru dan menampilkannya.
     */
    public function showQuiz()
    {
        try {
            $response = Http::timeout(120)  // ← TINGKATKAN TIMEOUT
                ->retry(3, 1000)  // ← RETRY 3x dengan delay 1 detik
                ->get($this->apiBaseUrl . '/api/hoax-quiz/generate');

            if (!$response->successful()) {
                $errorData = $response->json();
                $errorMessage = $errorData['detail'] ?? $response->body();

                if ($response->status() == 503) {
                    return view('hoax.index')->with('error', 'Server AI sedang sibuk. Silakan coba lagi dalam beberapa saat.');
                }

                logger()->error('❌ API error', ['error' => $errorMessage]);
                return view('hoax.index')->with('error', 'Gagal membuat kuis. Coba lagi.');
            }

            $data = $response->json();
            return view('hoax.index', ['mission' => $data]);

        } catch (\Exception $e) {
            logger()->error('❌ Exception', ['error' => $e->getMessage()]);
            return view('hoax.index')->with('error', 'Terjadi kesalahan. Coba lagi.');
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
            // Ambil pilihan user untuk dikirim ke view
            $user_choice = $request->input('user_choice');

            // Hitung skor berdasarkan respons AI
            $user = Auth::user();
            $gameType = 'Hoax or Not?';
            $score = data_get($data, 'is_correct', false) ? 20 : 0;

            // Simpan skor dan periksa badge
            Score::create([
                'user_id' => $user->id,
                'game_type' => $gameType,
                'score' => $score
            ]);
            $this->badgeService->checkAndAwardBadges($user, $gameType, $score);

            // Siapkan result untuk view (fallback aman)
            $result = $data ?? [];
            if (!is_array($result)) {
                $result = json_decode(json_encode($result), true) ?: [];
            }
            $result['score'] = $score;

            return view('hoax.result', compact('result', 'user_choice'));

        } catch (\Exception $e) {
            Log::error('Error checkAnswer Hoax', ['error' => $e->getMessage()]);
            return redirect(route('hoax.index'))->with('error', 'Terjadi kesalahan sistem: ' . $e->getMessage());
        }
    }
}
