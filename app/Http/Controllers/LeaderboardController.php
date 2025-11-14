<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Score;
// Hapus 'use Illuminate\Support\Facades\DB;' (tidak diperlukan)

class LeaderboardController extends Controller
{
    /**
     * Menampilkan halaman leaderboard.
     */
    public function index()
    {
        // --- LOGIKA BARU (KOMPATIBEL DENGAN MONGODB) ---

        // 1. Ambil semua user yang memiliki skor (has)
        // 2. Sertakan (eager load) semua data skor mereka (with)
        $usersWithScores = User::has('scores')
            ->with('scores')
            ->get();

        // 3. Hitung total skor untuk setiap user di sisi PHP (collection)
        //    dan urutkan hasilnya.
        $topUsers = $usersWithScores->each(function ($user) {
            // Buat properti baru 'total_score' di setiap objek user
            $user->total_score = $user->scores->sum('score');
        })
        ->sortByDesc('total_score') // Urutkan berdasarkan properti baru
        ->take(20) // Ambil 20 teratas
        ->values(); // Reset keys (penting untuk array di view)

        // --- AKHIR LOGIKA BARU ---

        return view('leaderboard.index', [
            'leaderboard' => $topUsers,
        ]);
    }
}
