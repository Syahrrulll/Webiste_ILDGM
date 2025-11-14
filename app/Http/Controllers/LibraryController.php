<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth; // <-- Diperlukan
use App\Services\BadgeService;      // <-- Diperlukan
use App\Services\FastApiService;
use App\Models\Score;               // <-- Diperlukan

class LibraryController extends Controller
{
    protected $apiBaseUrl = "https://python-ai-service-syahrrulll-syahrrullls-projects.vercel.app";
    protected $badgeService;

    // Inject BadgeService
    public function __construct(BadgeService $badgeService)
    {
        $this->apiBaseUrl = env('FASTAPI_BASE_URL', 'https://python-ai-service-syahrrulll-syahrrullls-projects.vercel.app');

        $this->badgeService = $badgeService;
    }

    /**
     * Menampilkan halaman index Library Hub (pilihan genre/format).
     */
    public function index()
    {
        return view('library.index');
    }

    /**
     * Menghasilkan Teks Lengkap (halaman MEMBACA).
     */
    public function generateGame(Request $request)
    {
        $request->validate([
            'format' => 'required|string',
            'genre' => 'required|string',
        ]);

        try {
            $response = Http::timeout(60)
                ->post($this->apiBaseUrl . '/api/library/generate-full-text', [
                    'format' => $request->input('format'),  // ← TAMBAHKAN INI
                    'genre' => $request->input('genre'),
                ]);

            if (!$response->successful()) {
                $errorData = $response->json();
                $errorMessage = $errorData['detail'] ?? $response->body();
                Log::error('Gagal generate-full-text dari AI', ['status' => $response->status(), 'body' => $errorMessage]);
                return back()->with('error', 'Gagal membuat bacaan dari AI. Coba lagi. Detail: ' . $errorMessage);
            }

            $data = $response->json();
            return view('library.reading', ['game_data' => $data]);

        } catch (\Exception $e) {
            Log::error('Error generateGame Library', ['error' => $e->getMessage()]);
            return back()->with('error', 'Terjadi kesalahan sistem: ' . $e->getMessage());
        }
    }

    /**
     * Menampilkan halaman kuis (kata hilang).
     */
    public function showQuiz($game_id)
    {
        try {
            $response = Http::timeout(30)
                ->get($this->apiBaseUrl . "/api/library/get-quiz-text/{$game_id}");

            if (!$response->successful()) {
                $errorData = $response->json();
                $errorMessage = $errorData['detail'] ?? $response->body();
                Log::error('Gagal get-quiz-text dari AI', ['status' => $response->status(), 'body' => $errorMessage]);
                return redirect(route('library.index'))->with('error', 'Gagal memuat kuis. Sesi mungkin kedaluwarsa. Silakan buat game baru. Detail: ' . $errorMessage);
            }

            $data = $response->json();
            return view('library.mission', ['quiz' => $data]);

        } catch (\Exception $e) {
            Log::error('Error showQuiz Library', ['error' => $e->getMessage()]);
            return redirect(route('library.index'))->with('error', 'Terjadi kesalahan sistem: ' . $e->getMessage());
        }
    }

    /**
     * Menerima jawaban kata hilang dan menampilkan hasil.
     */
    public function submitQuiz(Request $request, $game_id)
    {
        $request->validate([
            'answers' => 'required|array|min:1',
            'answers.*' => 'nullable|string',
        ]);

        $user_answers = array_map(fn($answer) => $answer ?? '', $request->input('answers'));

        try {
            $response = Http::timeout(30)
                ->post($this->apiBaseUrl . "/api/library/validate-blanks/{$game_id}", [  // ← PERHATIKAN PATH
                    'user_answers' => $user_answers,
                ]);

            if (!$response->successful()) {
                $errorData = $response->json();
                $errorMessage = $errorData['detail'] ?? $response->body();
                Log::error('Gagal validate-blanks dari AI', ['status' => $response->status(), 'body' => $errorMessage]);
                return redirect(route('library.index'))->with('error', 'Gagal memvalidasi jawaban. Coba lagi. Detail: ' . $errorMessage);
            }

            $data = $response->json();
            $user = Auth::user();
            $gameType = 'Library Hub';
            $score = (int) $data['total_score'];

            Score::create(['score' => $score]);
            $this->badgeService->checkAndAwardBadges($user, $gameType, $score);

            return view('library.result', ['result' => $data]);

        } catch (\Exception $e) {
            Log::error('Error submitQuiz Library', ['error' => $e->getMessage()]);
            return redirect(route('library.index'))->with('error', 'Terjadi kesalahan sistem: ' . $e->getMessage());
        }
    }
}
