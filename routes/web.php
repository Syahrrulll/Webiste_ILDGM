<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LiteracyGameController;

Route::get('/', function () {
    // Memberikan soal dan level awal
    return view('game.index', [
        'level' => 1,
        'question' => 'Bacalah teks berikut (teks panjang yang disiapkan). Apa ide pokok dari paragraf kedua? Tulis jawaban Anda minimal 30 kata.'
    ]);
});

Route::post('/submit-answer', [LiteracyGameController::class, 'submitAnswer']);
