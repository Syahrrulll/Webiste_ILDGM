<?php

namespace App\Services;

use App\Models\User;
use App\Models\Badge;
use App\Models\Score;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BadgeService
{
    /**
     * Berikan badge "Anggota Baru" saat registrasi.
     */
    public function awardNewUserBadge(User $user)
    {
        try {
            $badge = Badge::where('criteria_code', 'NEW_USER')->first();
            if ($badge) {
                // --- PERBAIKAN ---
                // Metode 'syncWithoutDetaching' (dan 'attach') untuk MongoDB
                // mengharapkan sebuah ARRAY, bahkan untuk satu ID.
                //
                // $user->badges()->syncWithoutDetaching($badge->id); // <-- INI PENYEBAB ERROR
                $user->badges()->syncWithoutDetaching([$badge->id]); // <-- INI PERBAIKANNYA
            }
        } catch (\Exception $e) {
            Log::error('Gagal memberikan badge NEW_USER', ['user_id' => $user->id, 'error' => $e->getMessage()]);
        }
    }

    /**
     * Cek dan berikan semua badge yang mungkin didapat user setelah menyelesaikan game.
     *
     * @param User $user User yang sedang login
     * @param string $gameType Tipe game (misal: "Reading Mission", "Hoax or Not?")
     * @param int $newScore Skor yang baru didapat
     */
    public function checkAndAwardBadges(User $user, string $gameType, int $newScore)
    {
        try {
            // 1. Ambil semua data yang relevan dalam satu query
            $user->load(['badges', 'scores']);

            $userBadgeCodes = $user->badges->pluck('criteria_code')->toArray();
            $allBadges = Badge::all()->keyBy('criteria_code');

            // 2. Filter badge yang belum dimiliki user
            $neededBadges = $allBadges->except($userBadgeCodes);

            if ($neededBadges->isEmpty()) {
                return; // User sudah punya semua badge, tidak perlu dicek
            }

            $badgesToAward = []; // Kumpulkan ID badge baru di sini

            // 3. Hitung statistik user (kita lakukan di PHP agar efisien)
            $totalScore = $user->scores->sum('score');

            // Hitung game per tipe
            $gameCounts = $user->scores->groupBy('game_type')->map->count();
            $gamePlayCount = $gameCounts->get('Reading Mission', 0);
            $hoaxPlayCount = $gameCounts->get('Hoax or Not?', 0);
            $libPlayCount = $gameCounts->get('Library Hub', 0);
            $grammarPlayCount = $gameCounts->get('Zona Tata Bahasa', 0);

            // 4. Loop dan Cek Kriteria
            foreach ($neededBadges as $criteria => $badge) {
                switch ($criteria) {
                    // --- Badge Game Pertama ---
                    case 'GAME_PLAY_1':
                        if ($gameType == 'Reading Mission' && $gamePlayCount >= 1) $badgesToAward[] = $badge->id;
                        break;
                    case 'HOAX_PLAY_1':
                        if ($gameType == 'Hoax or Not?' && $hoaxPlayCount >= 1) $badgesToAward[] = $badge->id;
                        break;
                    case 'LIB_PLAY_1':
                        if ($gameType == 'Library Hub' && $libPlayCount >= 1) $badgesToAward[] = $badge->id;
                        break;
                    case 'GRAMMAR_PLAY_1':
                        if ($gameType == 'Zona Tata Bahasa' && $grammarPlayCount >= 1) $badgesToAward[] = $badge->id;
                        break;

                    // --- Badge Kuantitas ---
                    case 'GAME_PLAY_10':
                        if ($gamePlayCount >= 10) $badgesToAward[] = $badge->id;
                        break;
                    case 'HOAX_PLAY_10':
                        if ($hoaxPlayCount >= 10) $badgesToAward[] = $badge->id;
                        break;
                    case 'GRAMMAR_PLAY_10':
                        if ($grammarPlayCount >= 10) $badgesToAward[] = $badge->id;
                        break;

                    // --- Badge Skor ---
                    case 'SCORE_100':
                        if ($newScore >= 100) $badgesToAward[] = $badge->id;
                        break;
                    case 'SCORE_5000':
                        if ($totalScore >= 5000) $badgesToAward[] = $badge->id;
                        break;
                }
            }

            // 5. Simpan badge baru ke database
            // Kode ini sudah benar karena $badgesToAward adalah sebuah array
            if (!empty($badgesToAward)) {
                $user->badges()->attach($badgesToAward);
            }

        } catch (\Exception $e) {
            Log::error('Gagal memproses BadgeService', ['user_id' => $user->id, 'error' => $e->getMessage()]);
        }
    }
}
