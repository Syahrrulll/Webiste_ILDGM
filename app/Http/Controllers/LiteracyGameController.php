<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;


use Illuminate\Http\Request;

class LiteracyGameController extends Controller
{
    // Tentukan Level Maksimum
    const MAX_LEVEL = 10;

    public function submitAnswer(Request $request)
    {
        // 1. Panggil API Python
        $response = Http::post('http://localhost:8001/api/next-question', [
            'user_id' => auth()->id() ?? 0,
            'current_level' => $request->level,
            'answer' => $request->user_answer,
        ]);

        if ($response->successful()) {
            $data = $response->json();
            $newLevel = $data['new_level'];

            // === LOGIKA BARU UNTUK MENGAKHIRI PERMAINAN ===
            if ($newLevel > self::MAX_LEVEL) {
                return view('game.conclusion');
            }
            // =============================================

            // 2. Berikan Feedback dan Tampilkan Soal Baru dari AI
            return view('game.index', [
                // Mengambil nilai new_level dari respons Python (misal: 2)
                'level' => $newLevel,
                'question' => $data['next_question']
            ])->with('success', 'Jawaban berhasil dianalisis! Tingkat kesulitan soal berikutnya: ' . strtoupper($data['difficulty']));

        }

        // 3. Tangani kegagalan komunikasi dengan server Python
        // Ganti 'return back()' dengan rendering view yang lebih stabil untuk menampilkan error
        $error_message = 'Gagal memproses jawaban. Status HTTP Python: ' . $response->status();

        // Mengambil kembali soal awal (hardcoded di route /) jika tidak ada cara untuk mengambil soal sebelumnya dari database/sesi.
        $default_question = 'Bacalah teks berikut (teks panjang yang disiapkan). Apa ide pokok dari paragraf kedua? Tulis jawaban Anda minimal 30 kata.';

        return view('game.index', [
            // Tetap pada level saat ini agar pengguna bisa mencoba lagi
            'level' => $request->level,
            'question' => $request->level == 1 ? $default_question : 'Soal tidak dapat dimuat karena Error. Coba kirim ulang.'
        ])->with('error', $error_message);
    }
}
