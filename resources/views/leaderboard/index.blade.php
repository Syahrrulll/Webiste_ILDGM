<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leaderboard - Literise</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Alpine.js untuk dropdown -->
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #5c1d8f;
            color: white;
            overflow-x: hidden;
        }

        /* BACKGROUND UTAMA YANG TIDAK POLOS */
        .main-background {
            background:
                /* Gradient utama */
                linear-gradient(135deg, #5c1d8f 0%, #4a2e7c 50%, #3a1e6b 100%),
                /* Pattern dots */
                radial-gradient(circle at 20% 80%, rgba(116, 67, 255, 0.3) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(211, 162, 255, 0.2) 0%, transparent 50%),
                radial-gradient(circle at 40% 40%, rgba(245, 99, 253, 0.15) 0%, transparent 50%),
                /* Noise texture */
                url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noiseFilter'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.65' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noiseFilter)' opacity='0.1'/%3E%3C/svg%3E");
            background-blend-mode: overlay, screen, screen, normal;
            position: relative;
        }

        /* Efek glowing particles di background */
        .glowing-particle {
            position: absolute;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.8) 0%, transparent 70%);
            filter: blur(5px);
            animation: particle-float 8s ease-in-out infinite;
        }

        @keyframes particle-float {
            0%, 100% {
                transform: translateY(0px) translateX(0px);
                opacity: 0.3;
            }
            25% {
                transform: translateY(-20px) translateX(10px);
                opacity: 0.6;
            }
            50% {
                transform: translateY(-10px) translateX(-10px);
                opacity: 0.4;
            }
            75% {
                transform: translateY(10px) translateX(15px);
                opacity: 0.5;
            }
        }

        /* Geometric shapes background */
        .geometric-shape {
            position: absolute;
            opacity: 0.1;
            animation: shape-rotate 20s linear infinite;
        }

        @keyframes shape-rotate {
            from {
                transform: rotate(0deg);
            }
            to {
                transform: rotate(360deg);
            }
        }

        /* Wave effect */
        .wave-background {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 30%;
            background: linear-gradient(180deg, transparent 0%, rgba(116, 67, 255, 0.1) 100%);
            clip-path: polygon(0 30%, 100% 0%, 100% 100%, 0% 100%);
        }

        /* Animasi untuk kartu */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in-up {
            animation: fadeInUp 0.6s ease-out forwards;
        }

        /* Glass morphism effect */
        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        /* Gradien teks */
        .gradient-text {
            background: linear-gradient(135deg, #f563fd 0%, #8f9bff 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Glow effect */
        .glow-effect {
            box-shadow: 0 0 20px rgba(116, 67, 255, 0.5);
        }

        /* Animasi untuk ranking */
        @keyframes rankPulse {
            0%, 100% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.1);
            }
        }

        .rank-pulse {
            animation: rankPulse 2s ease-in-out infinite;
        }

        /* Dropdown styles */
        .dropdown-menu {
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
            min-width: 200px;
            overflow: hidden;
        }

        .dropdown-item {
            display: block;
            width: 100%;
            padding: 12px 16px;
            text-align: left;
            border: none;
            background: none;
            color: #4a5568;
            transition: all 0.2s ease;
            cursor: pointer;
        }

        .dropdown-item:hover {
            background-color: #f7fafc;
            color: #7443ff;
        }

        .dropdown-divider {
            height: 1px;
            background-color: #e2e8f0;
            margin: 4px 0;
        }

        /* Mobile menu */
        .mobile-menu {
            display: none;
        }

        .mobile-menu.active {
            display: flex;
            flex-direction: column;
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: #4a2e7c;
            padding: 1rem;
            z-index: 100;
        }

        /* Efek hover untuk user item */
        .user-item {
            transition: all 0.3s ease;
            border-radius: 12px;
            padding: 1rem;
            margin-bottom: 0.5rem;
        }

        .user-item:hover {
            background: rgba(255, 255, 255, 0.1);
            transform: translateX(5px);
        }

        /* Highlight untuk user saat ini */
        .current-user {
            background: linear-gradient(135deg, rgba(116, 67, 255, 0.3), rgba(211, 162, 255, 0.3));
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        /* Ranking badge styles */
        .ranking-badge {
            position: relative;
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            font-weight: bold;
            font-size: 1.2rem;
        }

        .ranking-1 {
            background: linear-gradient(135deg, #FFD700, #FFA500);
            box-shadow: 0 0 20px rgba(255, 215, 0, 0.5);
        }

        .ranking-2 {
            background: linear-gradient(135deg, #C0C0C0, #A0A0A0);
            box-shadow: 0 0 20px rgba(192, 192, 192, 0.5);
        }

        .ranking-3 {
            background: linear-gradient(135deg, #CD7F32, #A0522D);
            box-shadow: 0 0 20px rgba(205, 127, 50, 0.5);
        }

        .ranking-other {
            background: linear-gradient(135deg, rgba(116, 67, 255, 0.3), rgba(211, 162, 255, 0.3));
            border: 2px solid rgba(255, 255, 255, 0.2);
        }

        /* Trophy animation */
        @keyframes trophyGlow {
            0%, 100% {
                filter: drop-shadow(0 0 5px rgba(255, 215, 0, 0.5));
            }
            50% {
                filter: drop-shadow(0 0 20px rgba(255, 215, 0, 0.8));
            }
        }

        .trophy-glow {
            animation: trophyGlow 2s ease-in-out infinite;
        }
    </style>
</head>
<body class="min-h-screen main-background">

    <!-- Background Elements -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none z-0">
        <!-- Glowing Particles -->
        <div class="glowing-particle w-4 h-4 top-1/4 left-1/4" style="animation-delay: 0s;"></div>
        <div class="glowing-particle w-6 h-6 top-1/3 right-1/3" style="animation-delay: 2s;"></div>
        <div class="glowing-particle w-3 h-3 bottom-1/4 left-1/3" style="animation-delay: 4s;"></div>
        <div class="glowing-particle w-5 h-5 top-2/3 right-1/4" style="animation-delay: 6s;"></div>

        <!-- Geometric Shapes -->
        <div class="geometric-shape w-32 h-32 top-10 left-10 border-2 border-purple-400 rounded-full" style="animation-duration: 25s;"></div>
        <div class="geometric-shape w-24 h-24 bottom-20 right-20 border-2 border-pink-400 rotate-45" style="animation-duration: 30s; animation-direction: reverse;"></div>
        <div class="geometric-shape w-40 h-40 top-40 right-10 border-2 border-blue-400 rounded-lg" style="animation-duration: 35s;"></div>

        <!-- Wave Background -->
        <div class="wave-background"></div>
    </div>

    <!-- ===== HEADER / NAVIGASI ===== -->
    <nav class="fixed top-0 left-0 right-0 z-50 bg-gradient-to-r from-[#906AF1] to-[#5438DB] text-white shadow-lg">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <a href="{{ route('home') }}" class="flex items-center space-x-2 text-2xl font-bold">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-pink-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                </svg>
                <span>LITERISE</span>
            </a>

            <div class="hidden md:flex items-center space-x-6">
                <a href="{{ route('home') }}" class="hover:text-pink-300 transition-colors">Beranda</a>
                <a href="{{ route('permainan.index') }}" class="hover:text-pink-300 transition-colors">Permainan</a>
                <a href="{{ route('tentang.index') }}" class="hover:text-pink-300 transition-colors">Tentang</a>

                <!-- DROPDOWN PROFIL -->
                @auth
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open" class="flex items-center space-x-2 bg-white/10 backdrop-blur-sm text-white font-semibold px-5 py-2 rounded-full transition-all duration-300 hover:bg-white/20 border border-white/20">
                        <span>{{ Str::limit(Auth::user()->name, 10) }}</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transition-transform duration-300" :class="{'rotate-180': open}" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>

                    <div x-show="open"
                         @click.away="open = false"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 transform -translate-y-2"
                         x-transition:enter-end="opacity-100 transform translate-y-0"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="opacity-100 transform translate-y-0"
                         x-transition:leave-end="opacity-0 transform -translate-y-2"
                         class="absolute right-0 mt-2 w-56 dropdown-menu z-50"
                         style="display: none;">

                        <div class="px-4 py-3 border-b border-gray-200 bg-gradient-to-r from-purple-50 to-pink-50">
                            <p class="text-sm font-semibold text-gray-900 truncate">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-gray-500 truncate">{{ Auth::user()->email }}</p>
                        </div>

                        <a href="{{ route('profile.index') }}" class="dropdown-item flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            Profil & Badge Saya
                        </a>
                        <a href="{{ route('leaderboard.index') }}" class="dropdown-item flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                            </svg>
                            Leaderboard
                        </a>

                        <div class="dropdown-divider"></div>

                        <form method="POST" action="{{ route('logout') }}" class="w-full">
                            @csrf
                            <button type="submit" class="dropdown-item flex items-center text-red-600 w-full text-left">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg>
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
                @endauth
            </div>

            <div class="md:hidden">
                <button id="mobile-menu-button" class="text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16m-7 6h7" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="mobile-menu md:hidden">
            <a href="{{ route('home') }}" class="py-2 px-4 hover:text-pink-300 transition-colors">Beranda</a>
            <a href="{{ route('permainan.index') }}" class="py-2 px-4 hover:text-pink-300 transition-colors">Permainan</a>
            <a href="{{ route('tentang.index') }}" class="py-2 px-4 hover:text-pink-300 transition-colors">Tentang</a>
            @auth
            <a href="{{ route('profile.index') }}" class="py-2 px-4 hover:text-pink-300 transition-colors">Profil Saya</a>
            <a href="{{ route('leaderboard.index') }}" class="py-2 px-4 hover:text-pink-300 transition-colors">Leaderboard</a>
            <form method="POST" action="{{ route('logout') }}" class="inline w-full">
                @csrf
                <a href="{{ route('logout') }}"
                   onclick="event.preventDefault(); this.closest('form').submit();"
                   class="bg-pink-500 text-white font-semibold px-5 py-2 rounded-full transition-all duration-300 hover:shadow-lg my-2 text-center w-full block">
                    Logout
                </a>
            </form>
            @endauth
        </div>
    </nav>

    <!-- Konten Leaderboard -->
    <div class="container mx-auto max-w-4xl p-6 my-10 pt-32 relative z-10">
        <div class="glass-effect rounded-2xl shadow-2xl p-8 md:p-12 fade-in-up glow-effect">

            <div class="relative z-10">
                <h1 class="text-4xl md:text-5xl font-bold text-center gradient-text mb-4 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mr-4 text-yellow-400 trophy-glow" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                    Leaderboard Top 20
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 ml-4 text-yellow-400 trophy-glow" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </h1>

                <p class="text-center text-purple-200 mb-8 text-lg">
                    Lihat peringkat pemain terbaik di Literise!
                </p>

                <!-- Statistik Leaderboard -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
                    <div class="glass-effect rounded-xl p-4 text-center">
                        <p class="text-sm text-purple-300">Total Pemain</p>
                        <p class="text-2xl font-bold text-white">{{ $leaderboard->count() }}</p>
                    </div>
                    <div class="glass-effect rounded-xl p-4 text-center">
                        <p class="text-sm text-purple-300">Skor Tertinggi</p>
                        <p class="text-2xl font-bold text-white">{{ $leaderboard->first()->total_score ?? 0 }}</p>
                    </div>
                    <div class="glass-effect rounded-xl p-4 text-center">
                        <p class="text-sm text-purple-300">Peringkat Anda</p>
                        <p class="text-2xl font-bold text-white">
                            @php
                                $userRank = $leaderboard->search(function($user) {
                                    return $user->id == Auth::id();
                                });
                                $userRank = $userRank !== false ? $userRank + 1 : '-';
                            @endphp
                            {{ $userRank }}
                        </p>
                    </div>
                </div>

                <!-- Daftar Peringkat -->
                <div class="flow-root">
                    <ul role="list" class="space-y-3">

                        @forelse ($leaderboard as $index => $user)
                            <li class="user-item fade-in-up {{ $user->id == Auth::id() ? 'current-user glow-effect' : '' }}"
                                style="animation-delay: {{ $index * 0.1 }}s;">
                                <div class="flex items-center space-x-4">
                                    <!-- Peringkat dengan Design Baru -->
                                    <div class="flex-shrink-0">
                                        @if($index == 0)
                                            <div class="ranking-badge ranking-1 rank-pulse">
                                                <span class="text-white">1</span>
                                            </div>
                                        @elseif($index == 1)
                                            <div class="ranking-badge ranking-2 rank-pulse" style="animation-delay: 0.5s">
                                                <span class="text-white">2</span>
                                            </div>
                                        @elseif($index == 2)
                                            <div class="ranking-badge ranking-3 rank-pulse" style="animation-delay: 1s">
                                                <span class="text-white">3</span>
                                            </div>
                                        @else
                                            <div class="ranking-badge ranking-other">
                                                <span class="text-white">{{ $index + 1 }}</span>
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Foto Profil -->
                                    <div class="flex-shrink-0">
                                        <div class="w-12 h-12 rounded-full bg-gradient-to-br from-[#7443ff] to-[#d3a2ff] flex items-center justify-center text-white text-xl font-bold shadow-lg">
                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                        </div>
                                    </div>

                                    <!-- Nama dan Info -->
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center space-x-2">
                                            <p class="text-lg font-semibold text-white truncate">
                                                {{ $user->name }}
                                            </p>
                                            @if($user->id == Auth::id())
                                                <span class="bg-gradient-to-r from-pink-500 to-purple-600 text-white text-xs px-2 py-1 rounded-full glow-effect">Anda</span>
                                            @endif
                                        </div>
                                        <p class="text-sm text-purple-300">
                                            Level {{ floor($user->total_score / 100) + 1 }}
                                        </p>
                                    </div>

                                    <!-- Skor -->
                                    <div class="text-right">
                                        <p class="text-2xl font-bold text-white">
                                            {{ $user->total_score }}
                                        </p>
                                        <p class="text-xs text-purple-300">Poin</p>
                                    </div>
                                </div>
                            </li>
                        @empty
                            <li class="text-center py-8">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-purple-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                                </svg>
                                <p class="text-purple-300 text-lg mb-4">Belum ada skor di leaderboard.</p>
                                <a href="{{ route('permainan.index') }}" class="inline-block bg-gradient-to-r from-[#7443ff] to-[#d3a2ff] hover:from-[#8c52ff] hover:to-[#e0b3ff] text-white px-6 py-3 rounded-full font-medium transition-all duration-300 transform hover:scale-105 shadow-lg">
                                    Mainkan Game Pertama
                                </a>
                            </li>
                        @endforelse

                    </ul>
                </div>

                <!-- Informasi Peringkat User -->
                @php
                    $userRank = $leaderboard->search(function($user) {
                        return $user->id == Auth::id();
                    });
                @endphp

                @if($userRank !== false && $userRank >= 20)
                    <div class="mt-8 p-4 glass-effect rounded-xl border border-purple-400/30 glow-effect">
                        <div class="flex items-center space-x-4">
                            <div class="flex-shrink-0">
                                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-purple-600 to-pink-600 flex items-center justify-center text-white font-bold shadow-lg">
                                    {{ $userRank + 1 }}
                                </div>
                            </div>
                            <div class="flex-1">
                                <p class="text-white font-semibold">Peringkat Anda: {{ $userRank + 1 }}</p>
                                <p class="text-purple-300 text-sm">Terus tingkatkan skor untuk masuk Top 20!</p>
                            </div>
                            <div class="text-right">
                                <p class="text-xl font-bold text-white">{{ Auth::user()->total_score ?? 0 }}</p>
                                <p class="text-xs text-purple-300">Poin Anda</p>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Tombol Aksi -->
                <div class="mt-10 pt-8 border-t border-purple-400 text-center">
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="{{ route('permainan.index') }}"
                           class="bg-gradient-to-r from-[#7443ff] to-[#d3a2ff] hover:from-[#8c52ff] hover:to-[#e0b3ff] text-white px-8 py-3 rounded-full font-medium transition-all duration-300 transform hover:scale-105 shadow-lg glow-effect">
                            🎮 Main Game
                        </a>
                        <a href="{{ route('home') }}"
                           class="border border-purple-400 text-purple-300 hover:bg-purple-400 hover:text-white px-8 py-3 rounded-full font-medium transition-all duration-300 transform hover:scale-105">
                            🏠 Kembali ke Beranda
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script>
        // Mobile menu toggle
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            const mobileMenu = document.getElementById('mobile-menu');
            mobileMenu.classList.toggle('active');
        });

        // Animasi saat halaman dimuat
        document.addEventListener('DOMContentLoaded', function() {
            // Highlight user saat ini dengan efek scroll
            const currentUser = document.querySelector('.current-user');
            if (currentUser) {
                setTimeout(() => {
                    currentUser.scrollIntoView({
                        behavior: 'smooth',
                        block: 'center'
                    });
                }, 1000);
            }

            // Create dynamic glowing particles
            function createGlowingParticle() {
                const particle = document.createElement('div');
                particle.className = 'glowing-particle';
                particle.style.width = Math.random() * 6 + 2 + 'px';
                particle.style.height = particle.style.width;
                particle.style.top = Math.random() * 100 + '%';
                particle.style.left = Math.random() * 100 + '%';
                particle.style.animationDelay = Math.random() * 8 + 's';
                particle.style.animationDuration = (Math.random() * 4 + 6) + 's';
                document.querySelector('.fixed.inset-0').appendChild(particle);
            }

            // Create multiple particles
            for (let i = 0; i < 12; i++) {
                createGlowingParticle();
            }
        });
        // 1. Setup Audio Context (Hanya dibuat sekali)
    const audioCtx = new (window.AudioContext || window.webkitAudioContext)();

    // 2. Fungsi Membuat Suara "Click" Digital (Nol Delay)
    function playClickSound() {
        // Bangunkan Audio Context jika tertidur (kebijakan browser)
        if (audioCtx.state === 'suspended') {
            audioCtx.resume();
        }

        const oscillator = audioCtx.createOscillator();
        const gainNode = audioCtx.createGain();

        // Setting Nada: Mulai tinggi (800Hz) turun cepat ke (100Hz) -> Efek "Pluk"
        oscillator.type = 'sine';
        oscillator.frequency.setValueAtTime(800, audioCtx.currentTime);
        oscillator.frequency.exponentialRampToValueAtTime(100, audioCtx.currentTime + 0.1);

        // Setting Volume: Cepat hilang (Short decay)
        gainNode.gain.setValueAtTime(0.3, audioCtx.currentTime); // Volume 30%
        gainNode.gain.exponentialRampToValueAtTime(0.01, audioCtx.currentTime + 0.1);

        oscillator.connect(gainNode);
        gainNode.connect(audioCtx.destination);

        oscillator.start();
        oscillator.stop(audioCtx.currentTime + 0.1);
    }

    // 3. Event Listener Spesifik Tombol
    document.addEventListener('DOMContentLoaded', function() {

        // Gunakan 'pointerdown' agar suara muncul SAAT JARI MENEMPEL (bukan saat dilepas)
        document.addEventListener('pointerdown', function(e) {

            // DAFTAR SELECTOR YANG DIANGGAP TOMBOL
            // Hanya elemen di dalam list ini yang akan bunyi
            const isButton = e.target.closest(`
                button,                 /* Semua tag <button> */
                .btn-game-3d,           /* Class tombol game Anda */
                .btn-game-secondary,    /* Class tombol secondary */
                .result-button,         /* Tombol di halaman hasil */
                .header-btn,            /* Tombol login/register di header */
                .feature-card-button,   /* Tombol di kartu fitur */
                .platform-btn,          /* Tombol sosmed di footer */
                .back-button,           /* Tombol kembali */
                .submit-button          /* Tombol kirim kuis */
            `);

            // Jika yang ditekan adalah salah satu dari daftar di atas -> BUNYI
            if (isButton) {
                playClickSound();
            }
        });
    });
    </script>
</body>
</html>
