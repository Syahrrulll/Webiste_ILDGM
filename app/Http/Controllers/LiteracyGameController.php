<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth; // <-- Diperlukan
use App\Services\BadgeService;      // <-- Diperlukan
use App\Services\FastApiService;
use App\Models\Score;               // <-- Diperlukan

class LiteracyGameController extends Controller
{
    protected $apiBaseUrl ="https://python-ai-service-syahrrulll-syahrrullls-projects.vercel.app/";
    protected $badgeService;

    // Inject BadgeService
    public function __construct(BadgeService $badgeService)
    {
        $this->badgeService = $badgeService;
        $this->apiBaseUrl = env('FASTAPI_BASE_URL', 'https://python-ai-service-syahrrulll-syahrrullls-projects.vercel.app');

        // Pastikan typo '$this.apiBaseUrl' diperbaiki menjadi '$this->apiBaseUrl'
    }

    /**
     * Menampilkan halaman index untuk Reading Mission (halaman search bar).
     */
    public function index()
    {
        return view('game.index');
    }

    /**
     * Menghasilkan misi baru (artikel + 3 kuis) berdasarkan topik dari AI.
     */
    public function generateMission(Request $request)
    {
        $request->validate(['topic' => 'required|string|min:3|max:100']);
        $topic = $request->input('topic');

        try {
            $response = Http::timeout(60)
                ->post($this->apiBaseUrl . '/api/game/generate-mission', ['topic' => $topic]);

            if (!$response->successful()) {
                $errorData = $response->json();
                $errorMessage = $errorData['detail'] ?? $response->body();
                Log::error('Gagal generate-mission dari AI', ['status' => $response->status(), 'body' => $errorMessage]);
                return back()->with('error', 'Gagal membuat misi dari AI. Coba lagi. Detail: ' . $errorMessage);
            }

            $data = $response->json();
            return view('game.mission', ['mission' => $data]);

        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error('Koneksi ke Python gagal (generateMission)', ['error' => $e->getMessage()]);
            return back()->with('error', 'Tidak dapat terhubung ke server AI. Pastikan server Python (port 8001) sudah berjalan.');
        } catch (\Exception $e) {
            Log::error('Error generateMission', ['error' => $e->getMessage()]);
            return back()->with('error', 'Terjadi kesalahan sistem: ' . $e->getMessage());
        }
    }

    /**
     * Menerima 3 jawaban kuis, mengirim ke AI untuk divalidasi, dan menampilkan hasil.
     */
    public function submitQuiz(Request $request, $mission_id)
    {
        $request->validate([
            'answers' => 'required|array|min:1', // Diubah ke min:1 jika AI terkadang gagal membuat 3
            'answers.*.question' => 'required|string',
            'answers.*.answer' => 'required|string',
        ]);

        try {
            $response = Http::timeout(60)
                ->post($this->apiBaseUrl . "/api/game/validate-quiz/{$mission_id}", [
                    'answers' => $request->input('answers'),
                ]);

            if (!$response->successful()) {
                $errorData = $response->json();
                $errorMessage = $errorData['detail'] ?? $response->body();
                Log::error('Gagal validate-quiz dari AI', ['status' => $response->status(), 'body' => $errorMessage]);
                return back()->with('error', 'Gagal memvalidasi kuis dengan AI. Coba lagi. Detail: ' . $errorMessage);
            }

            $data = $response->json();
            $user = Auth::user();
            $gameType = 'Reading Mission';
            $score = (int) $data['total_score'];

            // --- LOGIKA SKOR & BADGE BARU ---
            Score::create([
                'user_id' => $user->id,
                'game_type' => $gameType,
                'score' => $score
            ]);
            // Cek apakah user berhak dapat badge baru
            $this->badgeService->checkAndAwardBadges($user, $gameType, $score);
            // --- AKHIR LOGIKA BARU ---

            return view('game.result', [
                'title' => $data['title'],
                'total_score' => $data['total_score'],
                'results' => $data['results']
            ]);

        } catch (\Exception $e) {
            Log::error('Error submitQuiz Reading Mission', ['error' => $e->getMessage()]);
            // Perbaikan: Arahkan kembali ke halaman index game jika ada error
            return redirect(route('game.play'))->with('error', 'Terjadi kesalahan sistem: ' . $e->getMessage());
        }
    }
}
