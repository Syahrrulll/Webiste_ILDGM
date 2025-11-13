<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Score;
use Illuminate\Support\Facades\DB; // <-- Diperlukan untuk MAX(score)

class ProfileController extends Controller
{
    /**
     * Menampilkan halaman profil pengguna.
     */
    public function index()
    {
        // Ambil user yang sedang login, dan muat relasi scores + badges
        $user = Auth::user()->load(['scores', 'badges']);

        // 1. Ambil 5 skor terakhir (untuk "Aktivitas Terakhir")
        // Kita bisa ambil dari relasi yang sudah dimuat
        $recent_scores = $user->scores->sortByDesc('created_at')->take(5);

        // 2. Hitung statistik Total
        $total_score = $user->scores->sum('score');
        $games_played = $user->scores->count();

        // 3. Ambil Badge yang dimiliki
        $badges = $user->badges;

        // 4. Hitung SKOR TERTINGGI PRIBADI (Sesuai permintaan Anda)
        $personalHighScores = Score::where('user_id', $user->id)
            ->select('game_type', DB::raw('MAX(score) as high_score'))
            ->groupBy('game_type')
            ->orderByDesc('high_score')
            ->get();

        // 5. Tambahkan game yang belum pernah dimainkan ke daftar high score (skor 0)
        $playedGames = $personalHighScores->pluck('game_type')->all();
        $allGames = ['Reading Mission', 'Hoax or Not?', 'Library Hub', 'Zona Tata Bahasa'];

        foreach ($allGames as $game) {
            if (!in_array($game, $playedGames)) {
                // Tambahkan sebagai objek standar agar konsisten
                $personalHighScores->push((object)[
                    'game_type' => $game,
                    'high_score' => 0
                ]);
            }
        }

        return view('profile.index', [
            'user' => $user,
            'recent_scores' => $recent_scores,
            'total_score' => $total_score,
            'games_played' => $games_played,
            'badges' => $badges,
            'personalHighScores' => $personalHighScores,
        ]);
    }
}
