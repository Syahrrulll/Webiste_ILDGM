<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Validation\Rules\Password;
use App\Services\BadgeService; // <-- TAMBAHKAN INI

class AuthController extends Controller
{
    protected $badgeService;

    // Inject BadgeService
    public function __construct(BadgeService $badgeService)
    {
        $this->badgeService = $badgeService;
    }

    /**
     * Menampilkan halaman login.
     */
    public function showLogin()
    {
        return view('auth.login');
    }

    /**
     * Memproses percobaan login.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            // Arahkan ke rute 'home' (landing page) setelah login
            return redirect()->intended(route('home'));
        }

        // Jika gagal, kembalikan ke login dengan pesan error
        return back()->withErrors([
            'email' => 'Email atau Password yang Anda masukkan salah.',
        ])->onlyInput('email');
    }

    /**
     * Menampilkan halaman register.
     */
    public function showRegister()
    {
        return view('auth.register');
    }

    /**
     * Memproses pendaftaran user baru.
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Password::min(8)],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Langsung login-kan user setelah register
        Auth::login($user);

        // --- BADGE BARU ---
        // Berikan badge "Anggota Baru"
        $this->badgeService->awardNewUserBadge($user);
        // --- AKHIR BADGE BARU ---

        // Arahkan ke rute 'home' (landing page)
        return redirect(route('home'));
    }

    /**
     * Memproses logout.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Arahkan kembali ke halaman utama
        return redirect(route('home'));
    }
}
