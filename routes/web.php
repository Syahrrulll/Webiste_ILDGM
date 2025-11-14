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
|
| Di sinilah Anda dapat mendaftarkan rute web untuk aplikasi Anda. Rute-rute
| ini dimuat oleh RouteServiceProvider dan semuanya akan
| ditugaskan ke grup middleware "web".
|
*/

// Rute Landing Page (Publik)
Route::get('/', function () {
    return view('welcome');
})->name('home');

// === GRUP AUTENTIKASI MANUAL (GUEST) ===
// Hanya bisa diakses jika BELUM login
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
// Hanya bisa diakses jika SUDAH login
Route::middleware('auth')->group(function () {

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // --- HALAMAN PROFIL & LEADERBOARD ---
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/leaderboard', [LeaderboardController::class, 'index'])->name('leaderboard.index');

    // --- FITUR 1: READING MISSION (AI SEARCH + 3 KUIS) ---
    Route::get('/play', [LiteracyGameController::class, 'index'])->name('game.play');
    Route::post('/play/generate', [LiteracyGameController::class, 'generateMission'])->name('game.generate');
    Route::post('/play/submit-quiz/{mission_id}', [LiteracyGameController::class, 'submitQuiz'])->name('game.submit_quiz');

    // --- FITUR 2: HOAX OR NOT? (AI + GOOGLE SEARCH) ---
    Route::get('/hoax-or-not', [HoaxController::class, 'showQuiz'])->name('hoax.index');
    Route::post('/hoax-or-not/check', [HoaxController::class, 'checkAnswer'])->name('hoax.check');

    // --- FITUR 3: LIBRARY HUB (GAME MELENGKAPI KATA) ---
    Route::get('/library', [LibraryController::class, 'index'])->name('library.index');
    Route::post('/library/generate-game', [LibraryController::class, 'generateGame'])->name('library.generate_game');
    Route::get('/library/quiz/{game_id}', [LibraryController::class, 'showQuiz'])->name('library.show_quiz');
    Route::post('/library/submit-quiz/{game_id}', [LibraryController::class, 'submitQuiz'])->name('library.submit_quiz');

    // --- FITUR 4: ZONA TATA BAHASA (GAME PERBAIKI KALIMAT) ---
    Route::get('/grammar-zone', [GrammarZoneController::class, 'index'])->name('grammar.index');
    Route::post('/grammar-zone/generate-game', [GrammarZoneController::class, 'generateGame'])->name('grammar.generate_game');
    Route::post('/grammar-zone/submit-game/{game_id}', [GrammarZoneController::class, 'submitGame'])->name('grammar.submit_game');
});


// use Illuminate\Support\Facades\Artisan;

// Route::get('migrate-fresh-seed', function () {
//     try {
//         $exitCode = Artisan::call('migrate:fresh', [
//             '--seed' => true,
//              '--force' => true, // ⬅️ Tambahkan ini
//         ]);

//         $output = Artisan::output();

//         if ($exitCode === 0) {
//             return "✅ Success:\n\n" . nl2br($output);
//         } else {
//             return "❌ Failed:\n\n" . nl2br($output);
//         }
//     } catch (Exception $e) {
//         return "⚠️ Exception Caught:\n\n" . $e->getMessage();
//     }
// });

// Route::get('migrate-fresh', function () {
//     try {
//         $exitCode = Artisan::call('migrate:fresh', [
//              '--force' => true, // ⬅️ Tambahkan ini
//         ]);

//         $output = Artisan::output();

//         if ($exitCode === 0) {
//             return "✅ Success:\n\n" . nl2br($output);
//         } else {
//             return "❌ Failed:\n\n" . nl2br($output);
//         }
//     } catch (Exception $e) {
//         return "⚠️ Exception Caught:\n\n" . $e->getMessage();
//     }
// });

// Route::get('migrate', function () {
//     try {
//         $exitCode = Artisan::call('migrate', [
//              '--force' => true, // ⬅️ Tambahkan ini
//         ]);

//         $output = Artisan::output();

//         if ($exitCode === 0) {
//             return "✅ Success:\n\n" . nl2br($output);
//         } else {
//             return "❌ Failed:\n\n" . nl2br($output);
//         }
//     } catch (Exception $e) {
//         return "⚠️ Exception Caught:\n\n" . $e->getMessage();
//     }
// });

// Route::get('rollback', function () {
//     try {
//         $exitCode = Artisan::call('migrate:rollback', [
//              '--force' => true, // ⬅️ Tambahkan ini
//         ]);

//         $output = Artisan::output();

//         if ($exitCode === 0) {
//             return "✅ Success:\n\n" . nl2br($output);
//         } else {
//             return "❌ Failed:\n\n" . nl2br($output);
//         }
//     } catch (Exception $e) {
//         return "⚠️ Exception Caught:\n\n" . $e->getMessage();
//     }
// });

