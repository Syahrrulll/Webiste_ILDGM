<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LiteracyGameController;
use App\Http\Controllers\HoaxController;
use App\Http\Controllers\LibraryController;
use App\Http\Controllers\GrammarZoneController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LeaderboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Rute Landing Page (Publik)
Route::get('/', function () {
    return view('welcome');
})->name('home');

// === GRUP AUTENTIKASI MANUAL (GUEST) ===
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// Halaman tentang bisa diakses publik
Route::get('/tentang', function () {
    return view('tentang');
})->name('tentang.index');

    // Halaman permainan - DIPINDAHKAN KE DALAM AUTH
    Route::get('/permainan', function () {
        return view('permainan');
    })->name('permainan.index');

// === GRUP PERMAINAN (HARUS LOGIN) ===
Route::middleware('auth')->group(function () {

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // --- HALAMAN PROFIL & LEADERBOARD ---
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/leaderboard', [LeaderboardController::class, 'index'])->name('leaderboard.index');

    // --- FITUR 1: READING MISSION (AI SEARCH + 3 KUIS) ---
    Route::get('/play', [LiteracyGameController::class, 'index'])->name('game.play');
    Route::post('/play/generate', [LiteracyGameController::class, 'generateMission'])->name('game.generate');

    // --- TAMBAHKAN ROUTE INI ---
    Route::get('/play/quiz/{mission_id}', [LiteracyGameController::class, 'showQuiz'])->name('game.show_quiz');
    // --- AKHIR TAMBAHAN ---

    Route::post('/play/submit-quiz/{mission_id}', [LiteracyGameController::class, 'submitQuiz'])->name('game.submit_quiz');
    Route::get('/play/result/{mission_id}', [LiteracyGameController::class, 'showResult'])->name('game.result');


    // --- FITUR 3: LIBRARY HUB (GAME MELENGKAPI KATA) ---
    Route::prefix('library')->name('library.')->group(function () {
        Route::get('/', [LibraryController::class, 'index'])->name('index');
        Route::get('/generate', [LibraryController::class, 'generatePage'])->name('generate_page');
        Route::post('/generate-game', [LibraryController::class, 'generateGame'])->name('generate_game');
        Route::get('/quiz/{game_id}', [LibraryController::class, 'showQuiz'])->name('show_quiz');
        Route::post('/submit/{game_id}', [LibraryController::class, 'submitQuiz'])->name('submit_quiz');
        Route::get('/result/{game_id}', [LibraryController::class, 'showResult'])->name('result');
    });

    // Grammar Zone routes
    Route::prefix('grammar')->name('grammar.')->group(function () {
        Route::get('/', [GrammarZoneController::class, 'index'])->name('index');
        Route::get('/generate', [GrammarZoneController::class, 'generatePage'])->name('generate_page');
        Route::post('/generate-game', [GrammarZoneController::class, 'generateGame'])->name('generate_game');
        Route::get('/quiz/{game_id}', [GrammarZoneController::class, 'showQuiz'])->name('show_quiz');
        Route::post('/submit/{game_id}', [GrammarZoneController::class, 'submitGame'])->name('submit_game');
        Route::get('/result/{game_id}', [GrammarZoneController::class, 'showResult'])->name('result');
    });

    // Hoax Hunter routes
    Route::prefix('hoax')->name('hoax.')->group(function () {
        Route::get('/', [HoaxController::class, 'showQuiz'])->name('index');
        Route::post('/check', [HoaxController::class, 'checkAnswer'])->name('check');
        Route::get('/generate', [HoaxController::class, 'generatePage'])->name('generate_page');
        Route::post('/generate-game', [HoaxController::class, 'generateGame'])->name('generate_game');
        Route::get('/quiz/{game_id}', [HoaxController::class, 'showQuiz'])->name('show_quiz');
        Route::post('/submit/{game_id}', [HoaxController::class, 'submitGame'])->name('submit_game');
        Route::get('/result/{game_id}', [HoaxController::class, 'showResult'])->name('result');
    });
});
