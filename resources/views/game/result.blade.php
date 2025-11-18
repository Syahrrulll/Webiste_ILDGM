<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Misi: {{ $title }} - Literise</title>
    
    <!-- Memuat Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Alpine.js untuk dropdown -->
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- Memuat Google Fonts (Poppins) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet">
    
    <!-- AOS Library untuk animasi scroll -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <style>
        :root {
            --p: #7443ff;
            --pp: #d3a2ff;
            --w: #ffffff;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #2d1b69 0%, #1f1047 50%, #160b35 100%);
            overflow-x: hidden;
            min-height: 100vh;
        }
        
        .literise-title {
            font-size: 2.5rem;
            font-weight: 800;
            color: #d8c4ff;
            text-shadow:
                0 0 10px #8c52ff,
                0 0 10px #8c52ff,
                0 0 30px #8c52ff;
            line-height: 1;
        }
        
        .result-card {
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.15);
            transition: all 0.4s ease;
            border-radius: 24px;
            padding: 3rem 2.5rem;
            box-shadow:
                0 20px 50px rgba(124, 58, 234, 0.15),
                inset 0 1px 0 rgba(255, 255, 255, 0.2);
            position: relative;
            overflow: hidden;
            z-index: 1;
        }
        
        .result-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg,
                rgba(116, 67, 255, 0.1) 0%,
                rgba(211, 162, 255, 0.05) 50%,
                rgba(116, 67, 255, 0.1) 100%);
            z-index: -1;
            border-radius: 24px;
        }
        
        .score-section {
            background: linear-gradient(135deg, rgba(116, 67, 255, 0.2), rgba(211, 162, 255, 0.1));
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 20px;
            padding: 2.5rem;
            text-align: center;
        }
        
        .review-card {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 16px;
            overflow: hidden;
            transition: all 0.3s ease;
        }
        
        .review-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(124, 58, 234, 0.2);
        }
        
        .review-header {
            background: rgba(116, 67, 255, 0.1);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            padding: 1.5rem;
        }
        
        .review-content {
            padding: 1.5rem;
        }
        
        .score-badge {
            display: inline-flex;
            align-items: center;
            padding: 0.5rem 1rem;
            border-radius: 9999px;
            font-weight: 600;
            font-size: 0.875rem;
        }
        
        .score-excellent {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
        }
        
        .score-good {
            background: linear-gradient(135deg, #f59e0b, #d97706);
            color: white;
        }
        
        .score-needs-improvement {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            color: white;
        }
        
        .action-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 1rem 2rem;
            border-radius: 9999px;
            font-weight: 600;
            color: white;
            transition: all 0.3s ease;
            text-decoration: none;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .primary-button {
            background: linear-gradient(135deg, #7443ff 0%, #8c52ff 100%);
            box-shadow: 0 8px 25px -3px rgba(116, 67, 255, 0.5);
        }
        
        .primary-button:hover {
            transform: scale(1.05);
            box-shadow: 0 12px 35px -3px rgba(116, 67, 255, 0.7);
            background: linear-gradient(135deg, #8c52ff 0%, #7443ff 100%);
        }
        
        .secondary-button {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
        }
        
        .secondary-button:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
        }
        
        .back-button {
            display: inline-flex;
            align-items: center;
            padding: 0.75rem 1.5rem;
            border-radius: 9999px;
            font-weight: 600;
            color: white;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
            text-decoration: none;
        }
        
        .back-button:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateX(-5px);
        }
        
        .header-btn {
            background: linear-gradient(90deg, #F472B6 0%, #EC4899 100%);
            box-shadow: 0 4px 15px -3px rgba(236, 72, 153, 0.5);
        }
        
        /* Background pattern */
        .bg-pattern {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image:
                radial-gradient(circle at 10% 20%, rgba(120, 119, 198, 0.08) 0%, transparent 40%),
                radial-gradient(circle at 90% 80%, rgba(255, 119, 198, 0.05) 0%, transparent 40%),
                radial-gradient(circle at 50% 50%, rgba(120, 219, 255, 0.06) 0%, transparent 50%);
            z-index: -1;
        }
        
        /* Floating elements */
        .floating-element {
            position: absolute;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(116, 67, 255, 0.15), transparent 70%);
            filter: blur(20px);
            z-index: -1;
        }
        
        /* Animasi floating */
        @keyframes float {
            0%, 100% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-20px);
            }
        }
        
        @keyframes float-slow {
            0%, 100% {
                transform: translateY(0px) rotate(0deg);
            }
            33% {
                transform: translateY(-10px) rotate(1deg);
            }
            66% {
                transform: translateY(5px) rotate(-1deg);
            }
        }
        
        .floating {
            animation: float 6s ease-in-out infinite;
        }
        
        .floating-slow {
            animation: float-slow 8s ease-in-out infinite;
        }

        /* Mobile Menu Styling */
        .mobile-menu {
            display: none;
            background: rgba(45, 27, 105, 0.95);
            backdrop-filter: blur(10px);
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding: 1rem;
            flex-direction: column;
            gap: 0.5rem;
        }
        
        .mobile-menu.active {
            display: flex;
        }
        
        /* Animasi untuk tombol */
        .btn-glow {
            position: relative;
            overflow: hidden;
        }
        
        .btn-glow::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
            transition: left 0.7s;
        }
        
        .btn-glow:hover::before {
            left: 100%;
        }
        
        /* Responsive adjustments */
        @media (max-width: 1024px) {
            .literise-title {
                font-size: 2.25rem;
            }
        }
        
        @media (max-width: 768px) {
            .result-card {
                padding: 2rem 1.5rem;
            }
            .score-section {
                padding: 2rem 1.5rem;
            }
            .literise-title {
                font-size: 2rem;
            }
            .action-button {
                padding: 0.875rem 1.5rem;
                font-size: 1rem;
                width: 100%;
            }
            .review-header, .review-content {
                padding: 1.25rem;
            }
        }
        
        @media (max-width: 640px) {
            .result-card {
                padding: 1.5rem 1rem;
                border-radius: 20px;
            }
            .score-section {
                padding: 1.5rem 1rem;
                border-radius: 16px;
            }
            .back-button {
                padding: 0.625rem 1.25rem;
                font-size: 0.9rem;
            }
            .review-card {
                border-radius: 12px;
            }
            .review-header, .review-content {
                padding: 1rem;
            }
        }
        
        @media (max-width: 480px) {
            .literise-title {
                font-size: 1.75rem;
            }
            .result-card {
                padding: 1.25rem 0.75rem;
            }
            .score-section {
                padding: 1.25rem 0.75rem;
            }
        }

        @keyframes fadeOut {
            from { opacity: 1; transform: translate(-50%, -50%) scale(1); }
            to { opacity: 0; transform: translate(-50%, -100%) scale(1.5); }
        }
    </style>
</head>
<body class="min-h-screen overflow-x-hidden">

    <!-- Background Pattern -->
    <div class="bg-pattern"></div>

    <!-- Floating Elements -->
    <div class="floating-element floating-slow w-64 h-64 top-10 left-10 opacity-40"></div>
    <div class="floating-element floating w-48 h-48 bottom-20 right-20 opacity-30"></div>
    <div class="floating-element floating-slow w-56 h-56 top-1/3 right-1/4 opacity-25"></div>

    <!-- ===== HEADER / NAVIGASI ===== -->
    <nav class="fixed top-0 left-0 right-0 z-50 bg-gradient-to-r from-[#2d1b69] to-[#1f1047] text-white shadow-lg border-b border-purple-500/20">
        <div class="container mx-auto px-4 sm:px-6 py-3 sm:py-4 flex justify-between items-center">
            <a href="{{ route('home') }}" class="flex items-center space-x-2 text-xl sm:text-2xl font-bold">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6 text-pink-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                </svg>
                <span>LITERISE</span>
            </a>

            <div class="hidden md:flex items-center space-x-4 lg:space-x-6">
                <a href="{{ route('home') }}" class="hover:text-pink-300 transition-colors text-sm lg:text-base">Beranda</a>
                <a href="{{ route('permainan.index') }}" class="hover:text-pink-300 transition-colors text-sm lg:text-base">Permainan</a>
                <a href="{{ route('library.index') }}" class="hover:text-pink-300 transition-colors text-sm lg:text-base">Library</a>
                <a href="{{ route('tentang.index') }}" class="hover:text-pink-300 transition-colors text-sm lg:text-base">Tentang</a>

                <!-- LOGIKA AUTH DENGAN DROPDOWN PROFIL -->
                @auth
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" class="flex items-center space-x-2 bg-white/10 backdrop-blur-sm text-white font-semibold px-4 py-2 lg:px-5 lg:py-2 rounded-full transition-all duration-300 hover:bg-white/20 border border-white/20 btn-glow">
                            <span class="text-sm lg:text-base">{{ Str::limit(Auth::user()->name, 10) }}</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 lg:h-5 lg:w-5 transition-transform duration-300" :class="{'rotate-180': open}" viewBox="0 0 20 20" fill="currentColor">
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
                            class="absolute right-0 mt-2 w-48 lg:w-56 bg-white rounded-xl shadow-xl z-50"
                            style="display: none;">

                            <div class="px-4 py-3 border-b border-gray-200 bg-gradient-to-r from-purple-50 to-pink-50">
                                <p class="text-sm font-semibold text-gray-900 truncate">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-gray-500 truncate">{{ Auth::user()->email }}</p>
                            </div>

                            <a href="{{ route('profile.index') }}" class="block px-4 py-3 text-sm text-gray-700 hover:bg-purple-50 hover:text-purple-700 transition-colors flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                Profil & Badge Saya
                            </a>
                            <a href="{{ route('leaderboard.index') }}" class="block px-4 py-3 text-sm text-gray-700 hover:bg-purple-50 hover:text-purple-700 transition-colors flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                </svg>
                                Leaderboard
                            </a>

                            <div class="border-t border-gray-200"></div>

                            <form method="POST" action="{{ route('logout') }}" class="w-full">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-3 text-sm text-red-600 hover:bg-red-50 transition-colors flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                    </svg>
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="hover:text-pink-300 transition-colors text-sm lg:text-base">Masuk</a>
                    <a href="{{ route('register') }}" class="header-btn text-white font-semibold px-4 py-2 lg:px-5 lg:py-2 rounded-full transition-all duration-300 hover:shadow-lg btn-glow text-sm lg:text-base">
                        Daftar
                    </a>
                @endauth
            </div>

            <div class="md:hidden">
                <button id="mobile-menu-button" class="text-white p-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16m-7 6h7" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="mobile-menu md:hidden">
            <a href="{{ route('home') }}" class="py-3 px-4 hover:text-pink-300 transition-colors border-b border-white/10">Beranda</a>
            <a href="{{ route('permainan.index') }}" class="py-3 px-4 hover:text-pink-300 transition-colors border-b border-white/10">Permainan</a>
            <a href="{{ route('library.index') }}" class="py-3 px-4 hover:text-pink-300 transition-colors border-b border-white/10">Library</a>
            <a href="{{ route('tentang.index') }}" class="py-3 px-4 hover:text-pink-300 transition-colors border-b border-white/10">Tentang</a>

            @auth
                <a href="{{ route('profile.index') }}" class="py-3 px-4 hover:text-pink-300 transition-colors border-b border-white/10">Profil Saya</a>
                <a href="{{ route('leaderboard.index') }}" class="py-3 px-4 hover:text-pink-300 transition-colors border-b border-white/10">Leaderboard</a>
                <form method="POST" action="{{ route('logout') }}" class="inline w-full border-b border-white/10">
                    @csrf
                    <a href="{{ route('logout') }}"
                    onclick="event.preventDefault(); this.closest('form').submit();"
                    class="header-btn text-white font-semibold px-5 py-3 rounded-lg transition-all duration-300 hover:shadow-lg my-2 text-center btn-glow w-full block">
                        Logout
                    </a>
                </form>
            @else
                <a href="{{ route('login') }}" class="py-3 px-4 hover:text-pink-300 transition-colors border-b border-white/10">Masuk</a>
                <a href="{{ route('register') }}" class="header-btn text-white font-semibold px-5 py-3 rounded-lg transition-all duration-300 hover:shadow-lg my-2 text-center btn-glow">
                    Daftar
                </a>
            @endauth
        </div>
    </nav>

    <!-- ===== MAIN CONTENT ===== -->
    <main class="relative z-20 pt-24 sm:pt-28 md:pt-32 pb-16 sm:pb-20 min-h-screen px-4 sm:px-6">
        <div class="container mx-auto max-w-4xl">
            
            <!-- Header Hasil -->
            <div class="text-center mb-6 sm:mb-8" data-aos="fade-down">
                <a href="{{ route('game.play') }}" class="back-button inline-flex items-center mb-4 sm:mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-5 sm:w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Coba Misi Lain
                </a>
                
                <h1 class="literise-title mb-3 sm:mb-4">Hasil Misi</h1>
                <h2 class="text-xl sm:text-2xl md:text-3xl font-bold text-white mb-2">{{ $title }}</h2>
                <p class="text-gray-300 text-base sm:text-lg">Lihat performa dan ulasan jawaban Anda</p>
            </div>

            <div class="result-card" data-aos="fade-up" data-aos-duration="1000">
                
                <!-- Skor Total -->
                <div class="score-section mb-8 sm:mb-10" data-aos="zoom-in" data-aos-delay="200">
                    <div class="w-16 h-16 sm:w-20 sm:h-20 mx-auto mb-4 sm:mb-6 rounded-full bg-gradient-to-br from-[#7443ff] to-[#d3a2ff] flex items-center justify-center shadow-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 sm:h-10 sm:w-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    
                    <p class="text-lg sm:text-xl font-medium text-white mb-2">Skor Total Anda</p>
                    <p class="text-4xl sm:text-5xl md:text-6xl font-bold text-white mb-3 sm:mb-4">{{ $total_score ?? 0 }}/100</p>
                    
                    @if (($total_score ?? 0) >= 80)
                        <p class="text-base sm:text-lg text-green-300 font-semibold">🎉 Luar biasa! Pemahaman Anda sangat baik.</p>
                    @elseif (($total_score ?? 0) >= 60)
                        <p class="text-base sm:text-lg text-yellow-300 font-semibold">👍 Bagus! Anda sudah paham konsepnya.</p>
                    @else
                        <p class="text-base sm:text-lg text-orange-300 font-semibold">💪 Perlu sedikit latihan lagi, ayo coba lagi!</p>
                    @endif
                </div>

                <!-- Detail Ulasan Jawaban -->
                <div class="border-t border-white/20 pt-6 sm:pt-10">
                    <div class="flex items-center mb-4 sm:mb-6">
                        <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-full bg-gradient-to-br from-[#ff6b6b] to-[#ffa36b] flex items-center justify-center shadow-lg mr-3 sm:mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <h2 class="text-xl sm:text-2xl font-bold text-white">Ulasan Jawaban</h2>
                    </div>

                    <div class="space-y-4 sm:space-y-6">
                        @if (isset($results) && is_array($results))
                            @foreach ($results as $index => $result)
                                <div class="review-card" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                                    <div class="review-header">
                                        <p class="font-semibold text-white text-sm sm:text-base">
                                            <span class="text-yellow-300">Pertanyaan {{ $index + 1 }}:</span> {{ $result['question'] }}
                                        </p>
                                    </div>
                                    <div class="review-content space-y-3 sm:space-y-4">
                                        <div>
                                            <span class="text-xs sm:text-sm font-semibold text-gray-300">Jawaban Anda:</span>
                                            <p class="text-white italic mt-1 bg-white/5 rounded-lg p-3 text-sm sm:text-base">"{{ $result['user_answer'] }}"</p>
                                        </div>
                                        <div class="border-t border-white/10 pt-3">
                                            <span class="text-xs sm:text-sm font-semibold text-gray-300">Umpan Balik AI:</span>
                                            <p class="text-white mt-1 bg-white/5 rounded-lg p-3 text-sm sm:text-base">{{ $result['feedback'] }}</p>
                                        </div>
                                        <div class="flex justify-between items-center">
                                            <span class="text-xs sm:text-sm font-semibold text-gray-300">Skor:</span>
                                            <span class="score-badge {{ 
                                                $result['score'] >= 80 ? 'score-excellent' : 
                                                ($result['score'] >= 60 ? 'score-good' : 'score-needs-improvement') 
                                            }}">
                                                {{ $result['score'] }}/100
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="bg-red-500/20 border-l-4 border-red-500 text-red-200 p-4 rounded-lg" data-aos="fade-up">
                                <p class="font-bold">Error!</p>
                                <p>Gagal memuat ulasan hasil.</p>
                            </div>
                        @endif
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="mt-8 sm:mt-10 pt-4 sm:pt-6 border-t border-white/20 flex flex-col sm:flex-row gap-3 sm:gap-4 justify-center" data-aos="fade-up" data-aos-delay="300">
                        <a href="{{ route('game.play') }}" class="action-button primary-button btn-glow">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-5 sm:w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                            Coba Topik Lain
                        </a>
                        <a href="{{ route('home') }}" class="action-button secondary-button">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-5 sm:w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                            Kembali ke Beranda
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </main>

    <!-- ===== FOOTER ===== -->
    <footer class="w-full bg-[#160b35] text-white pt-12 sm:pt-16 pb-6 sm:pb-8 relative z-10 border-t border-purple-500/20">
        <div class="container mx-auto px-4 sm:px-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 sm:gap-8 mb-8 sm:mb-12">
                <!-- Kolom 1: Tentang -->
                <div class="col-span-1 md:col-span-2">
                    <h3 class="text-lg sm:text-xl font-bold mb-3 sm:mb-4 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6 text-pink-400 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                        </svg>
                        Tentang Literise
                    </h3>
                    <p class="text-gray-300 mb-3 sm:mb-4 leading-relaxed text-sm sm:text-base">
                        Literise adalah platform edukasi interaktif yang dirancang untuk meningkatkan literasi digital
                        dan kemampuan berpikir kritis melalui permainan yang menyenangkan dan engaging.
                    </p>
                </div>

                <!-- Kolom 2: Link Cepat -->
                <div>
                    <h3 class="text-lg sm:text-xl font-bold mb-3 sm:mb-4">Link Cepat</h3>
                    <ul class="space-y-2 sm:space-y-3">
                        <li><a href="{{ route('home') }}" class="text-gray-300 hover:text-pink-300 transition-colors flex items-center text-sm sm:text-base">
                            <span class="w-2 h-2 bg-pink-400 rounded-full mr-2 sm:mr-3"></span>
                            Beranda
                        </a></li>
                        <li><a href="{{ route('permainan.index') }}" class="text-gray-300 hover:text-pink-300 transition-colors flex items-center text-sm sm:text-base">
                            <span class="w-2 h-2 bg-purple-400 rounded-full mr-2 sm:mr-3"></span>
                            Permainan
                        </a></li>
                        <li><a href="{{ route('library.index') }}" class="text-gray-300 hover:text-pink-300 transition-colors flex items-center text-sm sm:text-base">
                            <span class="w-2 h-2 bg-blue-400 rounded-full mr-2 sm:mr-3"></span>
                            Library
                        </a></li>
                    </ul>
                </div>

                <!-- Kolom 3: Kontak -->
                <div>
                    <h3 class="text-lg sm:text-xl font-bold mb-3 sm:mb-4">Kontak</h3>
                    <ul class="space-y-3 sm:space-y-4 text-gray-300 text-sm sm:text-base">
                        <li class="flex items-start">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-5 sm:w-5 mr-2 sm:mr-3 text-pink-400 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            info@literise.com
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Bagian bawah footer -->
            <div class="border-t border-gray-600 pt-6 sm:pt-8 flex flex-col md:flex-row justify-between items-center">
                <p class="text-xs sm:text-sm opacity-70 mb-3 sm:mb-0 text-center md:text-left">© 2025 Literise. Semua hak dilindungi.</p>
                <div class="flex space-x-4 sm:space-x-6 text-xs sm:text-sm">
                    <a href="#" class="opacity-70 hover:opacity-100 transition-opacity hover:text-pink-300">Kebijakan Privasi</a>
                    <a href="#" class="opacity-70 hover:opacity-100 transition-opacity hover:text-pink-300">Syarat & Ketentuan</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Script untuk AOS (Animate On Scroll) -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // Inisialisasi AOS
        AOS.init({
            duration: 1000,
            once: true,
            offset: 100
        });

        // Mobile menu toggle
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            const mobileMenu = document.getElementById('mobile-menu');
            mobileMenu.classList.toggle('active');
        });

        // Close mobile menu when clicking outside
        document.addEventListener('click', function(event) {
            const mobileMenu = document.getElementById('mobile-menu');
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            
            if (!mobileMenu.contains(event.target) && !mobileMenuButton.contains(event.target) && mobileMenu.classList.contains('active')) {
                mobileMenu.classList.remove('active');
            }
        });

        // Animasi untuk tombol
        document.querySelectorAll('.action-button').forEach(button => {
            button.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-2px)';
            });

            button.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });

        // Confetti effect untuk skor tinggi
        @if(($total_score ?? 0) >= 80)
        setTimeout(() => {
            // Simple confetti effect
            const confetti = document.createElement('div');
            confetti.innerHTML = '🎉';
            confetti.style.position = 'fixed';
            confetti.style.top = '50%';
            confetti.style.left = '50%';
            confetti.style.transform = 'translate(-50%, -50%)';
            confetti.style.fontSize = '4rem';
            confetti.style.zIndex = '1000';
            confetti.style.pointerEvents = 'none';
            confetti.style.animation = 'fadeOut 2s forwards';
            
            document.body.appendChild(confetti);
            
            setTimeout(() => {
                confetti.remove();
            }, 2000);
        }, 1000);
        @endif
    </script>
</body>
</html>