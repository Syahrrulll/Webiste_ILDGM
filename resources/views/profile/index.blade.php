<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya - Literise</title>
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
                /* Gradient utama dengan depth */
                linear-gradient(135deg, #5c1d8f 0%, #4a2e7c 30%, #3a1e6b 70%, #2d1658 100%),
                /* Multiple radial gradients untuk texture */
                radial-gradient(circle at 15% 15%, rgba(116, 67, 255, 0.4) 0%, transparent 40%),
                radial-gradient(circle at 85% 85%, rgba(211, 162, 255, 0.3) 0%, transparent 40%),
                radial-gradient(circle at 50% 50%, rgba(245, 99, 253, 0.2) 0%, transparent 50%),
                radial-gradient(circle at 70% 30%, rgba(143, 155, 255, 0.25) 0%, transparent 45%),
                /* Noise texture halus */
                url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noiseFilter'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.05' numOctaves='2' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noiseFilter)' opacity='0.08'/%3E%3C/svg%3E");
            background-blend-mode: overlay, screen, screen, screen, screen, normal;
            position: relative;
            min-height: 100vh;
        }

        /* Floating Orbs Background */
        .floating-orb {
            position: absolute;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
            filter: blur(20px);
            animation: orb-float 15s ease-in-out infinite;
        }

        @keyframes orb-float {
            0%, 100% {
                transform: translateY(0px) translateX(0px) scale(1);
                opacity: 0.6;
            }
            25% {
                transform: translateY(-40px) translateX(20px) scale(1.1);
                opacity: 0.8;
            }
            50% {
                transform: translateY(-20px) translateX(-20px) scale(0.9);
                opacity: 0.5;
            }
            75% {
                transform: translateY(30px) translateX(30px) scale(1.05);
                opacity: 0.7;
            }
        }

        /* Animated Grid Pattern */
        .grid-pattern {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image:
                linear-gradient(rgba(116, 67, 255, 0.1) 1px, transparent 1px),
                linear-gradient(90deg, rgba(116, 67, 255, 0.1) 1px, transparent 1px);
            background-size: 50px 50px;
            animation: grid-move 20s linear infinite;
            opacity: 0.3;
        }

        @keyframes grid-move {
            0% {
                transform: translate(0, 0);
            }
            100% {
                transform: translate(50px, 50px);
            }
        }

        /* Pulsing Rings */
        .pulse-ring {
            position: absolute;
            border: 2px solid rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: pulse-ring 4s ease-out infinite;
        }

        @keyframes pulse-ring {
            0% {
                transform: scale(0.8);
                opacity: 1;
            }
            100% {
                transform: scale(2);
                opacity: 0;
            }
        }

        /* Animated Shapes */
        .animated-shape {
            position: absolute;
            opacity: 0.1;
            animation: shape-drift 25s linear infinite;
        }

        @keyframes shape-drift {
            0%, 100% {
                transform: translate(0, 0) rotate(0deg);
            }
            25% {
                transform: translate(100px, 50px) rotate(90deg);
            }
            50% {
                transform: translate(50px, 100px) rotate(180deg);
            }
            75% {
                transform: translate(-50px, 50px) rotate(270deg);
            }
        }

        /* Glass morphism effect */
        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
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

        /* Animasi untuk badge */
        @keyframes badgePulse {
            0%, 100% {
                transform: scale(1);
                box-shadow: 0 0 0 0 rgba(116, 67, 255, 0.7);
            }
            50% {
                transform: scale(1.05);
                box-shadow: 0 0 0 10px rgba(116, 67, 255, 0);
            }
        }

        .badge-pulse {
            animation: badgePulse 3s ease-in-out infinite;
        }

        @keyframes badgeFloat {
            0%, 100% {
                transform: translateY(0) rotate(0deg);
            }
            33% {
                transform: translateY(-5px) rotate(3deg);
            }
            66% {
                transform: translateY(3px) rotate(-2deg);
            }
        }

        .badge-float {
            animation: badgeFloat 6s ease-in-out infinite;
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

        /* Progress bar */
        .progress-bar {
            height: 6px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 3px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #7443ff, #d3a2ff);
            border-radius: 3px;
            transition: width 1s ease-in-out;
        }

        /* Timeline animation */
        @keyframes timelineAppear {
            from {
                opacity: 0;
                transform: translateX(-10px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .timeline-item {
            animation: timelineAppear 0.5s ease-out forwards;
        }
    </style>
</head>
<body class="min-h-screen main-background">

    <!-- Background Elements -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none z-0">
        <!-- Animated Grid -->
        <div class="grid-pattern"></div>

        <!-- Floating Orbs -->
        <div class="floating-orb w-64 h-64 top-1/4 -left-32 bg-purple-500/20" style="animation-delay: 0s;"></div>
        <div class="floating-orb w-96 h-96 bottom-1/4 -right-48 bg-pink-500/15" style="animation-delay: -5s;"></div>
        <div class="floating-orb w-80 h-80 top-1/2 left-1/4 bg-blue-500/10" style="animation-delay: -10s;"></div>

        <!-- Pulsing Rings -->
        <div class="pulse-ring w-32 h-32 top-1/3 right-1/3 border-purple-400" style="animation-delay: 0s;"></div>
        <div class="pulse-ring w-48 h-48 bottom-1/3 left-1/4 border-pink-400" style="animation-delay: 1s;"></div>
        <div class="pulse-ring w-40 h-40 top-1/4 left-1/2 border-blue-400" style="animation-delay: 2s;"></div>

        <!-- Animated Shapes -->
        <div class="animated-shape w-24 h-24 top-20 right-20 border-2 border-purple-400 rounded-full" style="animation-duration: 30s;"></div>
        <div class="animated-shape w-16 h-16 bottom-40 left-20 border-2 border-pink-400 rotate-45" style="animation-duration: 25s; animation-direction: reverse;"></div>
        <div class="animated-shape w-20 h-20 top-60 right-40 border-2 border-blue-400 rounded-lg" style="animation-duration: 35s;"></div>
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
        </div>
    </nav>

    <!-- Konten Profil -->
    <div class="container mx-auto max-w-6xl p-6 my-10 pt-32 relative z-10">

        <!-- Kartu Profil Utama -->
        <div class="glass-effect rounded-2xl shadow-2xl p-8 md:p-12 mb-8 fade-in-up glow-effect">
            <div class="flex flex-col md:flex-row items-center">
                <!-- Foto Profil dengan Animasi -->
                <div class="flex-shrink-0 mb-6 md:mb-0 md:mr-8 relative">
                    <div class="w-32 h-32 rounded-full bg-gradient-to-br from-[#7443ff] to-[#d3a2ff] flex items-center justify-center text-white text-5xl font-bold shadow-lg relative overflow-hidden glow-effect">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        <div class="absolute inset-0 bg-gradient-to-br from-transparent to-white opacity-20"></div>
                    </div>
                    <div class="absolute -bottom-2 -right-2 w-8 h-8 bg-green-400 rounded-full border-4 border-[#5c1d8f] flex items-center justify-center glow-effect">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                </div>

                <!-- Info User -->
                <div class="flex-1 text-center md:text-left">
                    <h1 class="text-3xl md:text-4xl font-bold gradient-text">{{ Auth::user()->name }}</h1>
                    <p class="text-lg text-purple-200 mt-2 flex items-center justify-center md:justify-start">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-pink-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        {{ Auth::user()->email }}
                    </p>
                    <p class="text-purple-200 mt-2 flex items-center justify-center md:justify-start">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-pink-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Bergabung sejak: {{ Auth::user()->created_at->format('d F Y') }}
                    </p>

                    <!-- Info Skor & Game -->
                    <div class="flex space-x-8 mt-6 border-t border-purple-400 pt-6 justify-center md:justify-start">
                        <div class="text-center">
                            <p class="text-sm text-purple-300 mb-1">Total Poin</p>
                            <p class="text-3xl font-bold text-white">{{ $total_score ?? 0 }}</p>
                        </div>
                        <div class="text-center">
                            <p class="text-sm text-purple-300 mb-1">Game Dimainkan</p>
                            <p class="text-3xl font-bold text-white">{{ $games_played ?? 0 }}</p>
                        </div>
                        <div class="text-center">
                            <p class="text-sm text-purple-300 mb-1">Level</p>
                            <p class="text-3xl font-bold text-white">{{ floor(($total_score ?? 0) / 100) + 1 }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bagian Grid: Skor Tertinggi dan Badge -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <!-- Kolom 1: Skor Tertinggi Pribadi -->
            <div class="lg:col-span-1 glass-effect rounded-2xl p-8 fade-in-up" style="animation-delay: 0.2s;">
                <h2 class="text-2xl font-bold gradient-text mb-6 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                    Skor Tertinggi Pribadi
                </h2>
                <div class="space-y-4">

                    @forelse ($personalHighScores ?? [] as $index => $score)
                        <div class="flex items-center justify-between p-4 bg-gradient-to-r from-purple-900/30 to-blue-900/30 rounded-xl border border-purple-400/30 transition-all duration-300 hover:shadow-md" style="animation-delay: {{ 0.3 + ($index * 0.1) }}s;">
                            <div>
                                <p class="text-lg font-semibold text-white">{{ $score->game_type }}</p>
                                <p class="text-sm text-purple-300">
                                    @if($score->high_score > 0)
                                        Skor Tertinggi
                                    @else
                                        Belum dimainkan
                                    @endif
                                </p>
                            </div>
                            <div class="text-right">
                                <p class="text-2xl font-bold {{ $score->high_score > 0 ? 'text-white' : 'text-purple-400' }}">
                                    {{ $score->high_score }}
                                </p>
                                @if($score->high_score > 0)
                                    <div class="progress-bar mt-2 w-20">
                                        <div class="progress-fill" style="width: {{ min(($score->high_score / 100) * 100, 100) }}%"></div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-8">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-purple-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                            </svg>
                            <p class="text-purple-300">Belum ada skor tercatat.</p>
                            <a href="{{ route('permainan.index') }}" class="inline-block mt-4 bg-gradient-to-r from-[#7443ff] to-[#d3a2ff] hover:from-[#8c52ff] hover:to-[#e0b3ff] text-white px-6 py-2 rounded-full text-sm font-medium transition-all duration-300 transform hover:scale-105 shadow-lg">
                                Mainkan Game
                            </a>
                        </div>
                    @endforelse

                </div>
            </div>

            <!-- Kolom 2: Badge Saya dan Aktivitas -->
            <div class="lg:col-span-2 glass-effect rounded-2xl p-8 fade-in-up" style="animation-delay: 0.4s;">
                <h2 class="text-2xl font-bold gradient-text mb-6 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                    Koleksi Badge Saya
                </h2>

                @if(empty($badges) || $badges->isEmpty())
                    <div class="text-center py-8">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-purple-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                        <p class="text-purple-300 mb-4">Belum ada badge didapat.</p>
                        <p class="text-purple-400 text-sm">Selesaikan game untuk mendapatkan badge!</p>
                    </div>
                @else
                    <!-- Tampilkan badge dalam grid -->
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-6">
                        @foreach ($badges as $index => $badge)
                            <div class="flex flex-col items-center text-center p-6 bg-gradient-to-br from-purple-900/30 to-blue-900/30 rounded-xl border border-purple-400/30 transition-all duration-300 hover:shadow-lg transform hover:-translate-y-1 glow-effect"
                                 {{-- PERBAIKAN: Menghapus atribut 'title' yang memanggil $badge->pivot --}}
                                 style="animation-delay: {{ 0.5 + ($index * 0.1) }}s;">
                                <div class="w-20 h-20 rounded-full bg-gradient-to-br from-purple-500/20 to-blue-500/20 flex items-center justify-center mb-4 badge-pulse border-4 border-purple-400/50 shadow-lg">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-purple-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                        {!! $badge->icon_svg ?? '' !!}
                                    </svg>
                                </div>
                                <p class="text-md font-semibold text-white mb-2">{{ $badge->name }}</p>
                                <p class="text-xs text-purple-300 leading-tight">{{ $badge->description }}</p>
                                {{-- PERBAIKAN: Menghapus div yang menampilkan tanggal (memanggil $badge->pivot) --}}
                            </div>
                        @endforeach
                    </div>
                @endif

                <!-- Aktivitas Terakhir -->
                <h2 class="text-2xl font-bold gradient-text mb-6 mt-10 pt-8 border-t border-purple-400 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Aktivitas Terakhir
                </h2>
                <div class="flow-root">
                    <ul role="list" class="-mb-8">
                        @forelse ($recent_scores ?? [] as $index => $score)
                            <li class="timeline-item" style="animation-delay: {{ 0.6 + ($index * 0.1) }}s;">
                                <div class="relative pb-8">
                                    @if (!$loop->last)
                                        <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gradient-to-b from-purple-400 to-blue-400" aria-hidden="true"></span>
                                    @endif
                                    <div class="relative flex space-x-3 group">
                                        <div>
                                            <span class="h-8 w-8 rounded-full bg-gradient-to-br from-purple-500 to-blue-600 flex items-center justify-center ring-8 ring-[#5c1d8f] shadow-lg group-hover:scale-110 transition-transform duration-300">
                                                <svg class="h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 18.75h-9a2.25 2.25 0 00-2.25 2.25v.01c0 .69.56 1.25 1.25 1.25h12.5c.69 0 1.25-.56 1.25-1.25v-.01a2.25 2.25 0 00-2.25-2.25zM12.75 6.031a9 9 0 00-9.191 9.192h18.382a9 9 0 00-9.191-9.192zM12.75 6.031V3.75m0 2.281l-3.233-3.232m3.233 3.232l3.233-3.232m-3.233 3.232v6.75A2.25 2.25 0 0110.5 15h-3a2.25 2.25 0 01-2.25-2.25v-6.75m7.5 0v6.75A2.25 2.25 0 0015 15h3a2.25 2.25 0 002.25-2.25v-6.75m-7.5 0h7.5" />
                                                </svg>
                                            </span>
                                        </div>
                                        <div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
                                            <div class="transition-all duration-300 group-hover:translate-x-1">
                                                <p class="text-sm text-purple-200">
                                                    Menyelesaikan <strong class="font-medium text-white">{{ $score->game_type }}</strong>
                                                </p>
                                            </div>
                                            <div class="whitespace-nowrap text-right text-sm text-purple-200 transition-all duration-300 group-hover:translate-x-1">
                                                <p class="font-bold text-white">+{{ $score->score }} Poin</p>
                                                <time datetime="{{ $score->created_at->toIso8601String() }}" class="text-xs">{{ $score->created_at->diffForHumans() }}</time>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @empty
                            <li class="timeline-item">
                                <div class="relative flex space-x-3">
                                    <div>
                                        <span class="h-8 w-8 rounded-full bg-purple-600 flex items-center justify-center ring-8 ring-[#5c1d8f]">
                                            <svg class="h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                                            </svg>
                                        </span>
                                    </div>
                                    <p class="text-purple-300 pt-1.5">Belum ada aktivitas. Ayo mulai mainkan game!</p>
                                </div>
                            </li>
                        @endforelse
                    </ul>
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
            // Animasi untuk progress bar
            const progressBars = document.querySelectorAll('.progress-fill');
            progressBars.forEach(bar => {
                const width = bar.style.width;
                bar.style.width = '0';
                setTimeout(() => {
                    bar.style.width = width;
                }, 500);
            });

            // Efek hover untuk timeline items
            const timelineItems = document.querySelectorAll('.timeline-item');
            timelineItems.forEach((item, index) => {
                item.style.opacity = '0';
                setTimeout(() => {
                    item.style.opacity = '1';
                }, 600 + (index * 100));
            });
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
