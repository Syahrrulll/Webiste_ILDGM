<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Score;
use Illuminate\Support\Facades\DB; // Kita perlu DB Facade untuk query yang kompleks

class LeaderboardController extends Controller
{
    /**
     * Menampilkan halaman leaderboard.
     */
    public function index()
    {
        // Kita akan mengambil 20 user teratas berdasarkan total skor mereka
        $topUsers = User::select('users.id', 'users.name', DB::raw('SUM(scores.score) as total_score'))
            ->join('scores', 'users.id', '=', 'scores.user_id') // Gabungkan tabel user dan score
            ->groupBy('users.id', 'users.name') // Kelompokkan berdasarkan user
            ->orderByDesc('total_score') // Urutkan dari skor tertinggi
            ->take(20) // Ambil 20 teratas
            ->get();

        return view('leaderboard.index', [
            'leaderboard' => $topUsers,
        ]);
    }
}
