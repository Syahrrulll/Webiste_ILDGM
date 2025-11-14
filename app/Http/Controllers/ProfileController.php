<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Score;
// use Illuminate\Support\Facades\DB; // <-- HAPUS INI, kita tidak lagi pakai DB::raw

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

        // --- 4. Hitung SKOR TERTINGGI (Cara Collection, BUKAN SQL) ---
        // Ini adalah perbaikan untuk MongoDB. Kita tidak bisa pakai DB::raw.
        // Kita ambil semua skor, urutkan, lalu kelompokkan di PHP.
        $personalHighScores = Score::where('user_id', $user->id)
            ->select('game_type', 'score')
            ->orderBy('score', 'desc') // Urutkan dari skor tertinggi
            ->get() // Ambil semua skor user
            ->groupBy('game_type') // Kelompokkan di PHP (menggunakan Collection)
            ->map(function ($group) {
                // 'first()' akan menjadi skor tertinggi karena kita sudah urutkan
                $best_score = $group->first();
                return (object)[
                    'game_type' => $best_score->game_type,
                    'high_score' => $best_score->score
                ];
            })
            ->sortByDesc('high_score') // Urutkan hasil akhirnya
            ->values(); // Reset keys agar menjadi array (bukan map)

        // 5. Tambahkan game yang belum pernah dimainkan ke daftar high score (skor 0)
        // Kode ini sudah benar dan bisa bekerja dengan hasil di atas
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
