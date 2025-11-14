<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth; // <-- Diperlukan
use App\Services\BadgeService;      // <-- Diperlukan
use App\Services\FastApiService;
use App\Models\Score;               // <-- Diperlukan

class GrammarZoneController extends Controller
{
    protected $apiBaseUrl = "https://python-ai-service-syahrrulll-syahrrullls-projects.vercel.app/";
    protected $badgeService;

    // Inject BadgeService
    public function __construct(BadgeService $badgeService)
    {
        $this->badgeService = $badgeService;
        $this->apiBaseUrl = env('FASTAPI_BASE_URL', 'https://python-ai-service-syahrrulll-syahrrullls-projects.vercel.app');

    }

    /**
     * Menampilkan halaman index Zona Tata Bahasa (pilihan genre).
     */
    public function index()
    {
        try {
            $response = Http::timeout(60)
                ->post($this->apiBaseUrl . '/api/grammar-zone/generate-mission', [  // ← UBAH INI
                    'difficulty' => 'intermediate'
                ]);

            if (!$response->successful()) {
                return view('grammar.index')->with('error', 'Gagal membuat misi grammar');
            }

            $data = $response->json();
            return view('grammar.mission', ['mission' => $data]);

        } catch (\Exception $e) {
            return view('grammar.index')->with('error', 'Error: ' . $e->getMessage());
        }
    }

    /**
     * Menghasilkan game (5 kalimat acak) berdasarkan Genre.
     */
    public function generateGame(Request $request)
    {
        $request->validate(['genre' => 'required|string']);

        try {
            $response = Http::timeout(60)
                ->post($this->apiBaseUrl . '/api/grammar-zone/generate-game', [
                    'genre' => $request->input('genre'),
                ]);

            if (!$response->successful()) {
                $errorData = $response->json();
                $errorMessage = $errorData['detail'] ?? $response->body();
                Log::error('Gagal generate-game (Grammar) dari AI', ['status' => $response->status(), 'body' => $errorMessage]);
                return back()->with('error', 'Gagal membuat game dari AI. Coba lagi. Detail: ' . $errorMessage);
            }

            $data = $response->json();
            return view('grammar.mission', ['game' => $data]);

        } catch (\Exception $e) {
            Log::error('Error generateGame Grammar', ['error' => $e->getMessage()]);
            return back()->with('error', 'Terjadi kesalahan sistem: ' . $e->getMessage());
        }
    }

    /**
     * Menerima 5 kalimat koreksi dan menampilkan hasil.
     */
    public function submitGame(Request $request, $game_id)
    {
        $request->validate([
            'sentences' => 'required|array|min:1',
            'sentences.*' => 'nullable|string',
        ]);

        $user_corrections = array_map(fn($sentence) => $sentence ?? '', $request->input('sentences'));

        try {
            $response = Http::timeout(30)
                ->post($this->apiBaseUrl . "/api/grammar-zone/submit-game/{$game_id}", [
                    'user_corrections' => $user_corrections,
                ]);

            if (!$response->successful()) {
                $errorData = $response->json();
                $errorMessage = $errorData['detail'] ?? $response->body();
                Log::error('Gagal submit-game (Grammar) dari AI', ['status' => $response->status(), 'body' => $errorMessage]);
                return redirect(route('grammar.index'))->with('error', 'Gagal memvalidasi jawaban. Coba lagi. Detail: ' . $errorMessage);
            }

            $data = $response->json();
            $user = Auth::user();
            $gameType = 'Zona Tata Bahasa';
            $score = (int) $data['total_score'];

            Score::create(['score' => $score]);
            $this->badgeService->checkAndAwardBadges($user, $gameType, $score);

            return view('grammar.result', ['result' => $data]);

        } catch (\Exception $e) {
            Log::error('Error submitGame Grammar', ['error' => $e->getMessage()]);
            return redirect(route('grammar.index'))->with('error', 'Terjadi kesalahan sistem: ' . $e->getMessage());
        }
    }
}
