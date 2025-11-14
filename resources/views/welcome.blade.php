<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Literise - Tingkatkan Literasi Digital dengan Cara Menyenangkan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet">

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        :root {
            --p: #7443ff;
            --pp: #d3a2ff;
            --w: #ffffff;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: #5c1d8f;
            overflow-x: hidden;
        }

        .literise-title {
            font-size: 6rem;
            font-weight: 800;
            color: #d8c4ff;
            text-shadow:
                0 0 10px #8c52ff,
                0 0 10px #8c52ff,
                0 0 30px #8c52ff,
                0 0 40px #ffffff,
                0 0 50px #ffffff;
            line-height: 1;
        }

        .subtitle-shadow {
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.3);
        }

        .header-btn {
            background: linear-gradient(90deg, #F472B6 0%, #EC4899 100%);
            box-shadow: 0 4px 15px -3px rgba(236, 72, 153, 0.5);
        }

        .platform-btn {
            background-color: rgba(255, 255, 255, 0.1);
            border: 2px solid rgba(255, 255, 255, 0.3);
            backdrop-filter: blur(5px);
            transition: all 0.3s ease;
        }
        .platform-btn:hover {
            background-color: rgba(255, 255, 255, 0.2);
            border-color: rgba(255, 255, 255, 0.5);
        }

        /* Animasi untuk feature-card */
        .feature-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
            border-radius: 24px;
            padding: 2.5rem 2rem;
            box-shadow: 0 12px 36px rgba(124, 58, 234, 0.08);
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(124, 58, 234, 0.1);
            display: flex;
            flex-direction: column;
        }

        .feature-card-content {
            position: relative;
            z-index: 2;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .feature-card::before {
            content: '';
            position: absolute;
            inset: -2px;
            border-radius: 24px;
            background: conic-gradient(from 180deg, var(--p), var(--pp), var(--p));
            animation: rotate 4s linear infinite;
            z-index: 0;
            opacity: 0.8;
        }

        .feature-card::after {
            content: '';
            position: absolute;
            inset: 2px;
            border-radius: 22px;
            background: #d9bbff;
            z-index: 1;
        }

        @keyframes rotate {
            from {
                transform: rotate(0deg);
            }
            to {
                transform: rotate(360deg);
            }
        }

        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(116, 67, 255, 0.2);
        }

        .feature-card p {
            flex-grow: 1;
            margin-bottom: 1.5rem;
        }

        .feature-card-button {
            margin-top: auto;
            display: inline-block;
            text-align: center;
            padding: 0.75rem 1.5rem;
            border-radius: 9999px;
            font-weight: 600;
            color: white;
            background: linear-gradient(90deg, #7443ff 0%, #8c52ff 100%);
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px -3px rgba(116, 67, 255, 0.5);
        }

        .feature-card-button:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 20px -3px rgba(116, 67, 255, 0.7);
        }

        .wave-bg {
            position: relative;
            overflow: hidden;
        }

        .wave-bg-flipped::before {
            transform: scaleY(-1);
        }

        /* Animasi floating */
        @keyframes float {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-10px);
            }
        }

        .floating {
            animation: float 5s ease-in-out infinite;
        }

        .floating-slow {
            animation: float 7s ease-in-out infinite;
        }

        .floating-fast {
            animation: float 3s ease-in-out infinite;
        }

        /* Animasi teks berkedip */
        @keyframes blink {
            0%, 100% {
                opacity: 1;
            }
            50% {
                opacity: 0.7;
            }
        }

        .blink {
            animation: blink 2s infinite;
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
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.5s;
        }

        .btn-glow:hover::before {
            left: 100%;
        }

        /* Animasi untuk badge - DIUBAH */
        @keyframes badge-pulse {
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
            animation: badge-pulse 3s ease-in-out infinite;
        }

        @keyframes badge-float {
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
            animation: badge-float 6s ease-in-out infinite;
        }

        /* Animasi untuk progress bar */
        .progress-bar {
            height: 8px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 4px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #7443ff, #d3a2ff);
            border-radius: 4px;
            transition: width 1s ease-in-out;
        }

        /* Animasi Loading - DITAMBAHKAN */
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .loading-spinner {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 3px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            border-top-color: #fff;
            animation: spin 1s ease-in-out infinite;
            margin-right: 8px;
        }

        /* Dropdown yang diperbaiki - DITAMBAHKAN */
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

        /* Animasi Hamburger - DIPERBAIKI */
        .hamburger-line {
            display: block;
            height: 2px;
            width: 24px;
            background-color: white;
            transition: all 0.3s ease;
        }

        .hamburger-line:nth-child(2) {
            margin: 6px 0;
        }

        .hamburger.active .hamburger-line:nth-child(1) {
            transform: rotate(45deg) translate(6px, 6px);
        }

        .hamburger.active .hamburger-line:nth-child(2) {
            opacity: 0;
        }

        .hamburger.active .hamburger-line:nth-child(3) {
            transform: rotate(-45deg) translate(6px, -6px);
        }

        /* Mobile Menu yang diperbaiki - DIPERBAIKI DENGAN ANIMASI */
        .mobile-menu {
            display: none;
            flex-direction: column;
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: #4a2e7c;
            padding: 1rem;
            z-index: 100;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            transform: translateY(-10px);
            opacity: 0;
            transition: all 0.3s ease;
        }

        .mobile-menu.active {
            display: flex;
            transform: translateY(0);
            opacity: 1;
        }

        /* Responsive adjustments */
        @media (max-width: 1024px) {
            .literise-title {
                font-size: 5rem;
            }
            .hero-section {
                /* Padding-top diatur oleh class pt-20, padding-bottom tetap */
                padding-bottom: 180px;
            }
        }

        @media (max-width: 768px) {
            .literise-title {
                font-size: 4rem;
            }
            .hero-section {
                 /* Padding-top diatur oleh class pt-20, padding-bottom tetap */
                padding-bottom: 180px;
            }

            .illustration-kepala { display: none; }
            .illustration-journal {
                position: absolute !important;
                top: 50% !important;
                left: 50% !important;
                transform: translate(-50%, -50%) rotate(-10deg) !important;
                width: 80% !important;
                max-width: 400px !important;
                height: auto !important;
                opacity: 0.7 !important;
                z-index: -1 !important;
            }
            .decorative-left { display: none; }
            .decorative-right { display: none; }
        }

        @media (max-width: 640px) {
            .literise-title { font-size: 3rem; }
            .hero-section { /* Padding-top diatur oleh class pt-20, padding-bottom tetap */ padding-bottom: 160px; }
            .illustration-journal { width: 90% !important; max-width: 350px !important; }
            .feature-card { padding: 1.5rem 1rem; }

            /* PERBAIKAN: Navbar mobile lebih compact */
            nav .container {
                padding-left: 1rem;
                padding-right: 1rem;
            }

            /* PERBAIKAN: Logo lebih kecil di mobile */
            nav .text-2xl {
                font-size: 1.25rem;
            }

            /* PERBAIKAN: Hamburger button lebih ke kiri */
            .md\\:hidden {
                margin-left: auto;
            }
        }

        @media (max-width: 480px) {
            .literise-title { font-size: 2.5rem; }
            .illustration-journal {
                width: 200% !important;
                max-width: 500px !important;
                top: 275px !important;
                opacity: 35% !important;
            }

            /* PERBAIKAN EXTRA: Pastikan hamburger tidak keluar layar */
            nav .container {
                padding-left: 0.75rem;
                padding-right: 0.75rem;
            }
        }

        /* PERBAIKAN TAMBAHAN: Padding container yang lebih aman untuk mobile */
        .container {
            padding-left: 1rem;
            padding-right: 1rem;
        }

        @media (max-width: 360px) {
            .container {
                padding-left: 0.5rem;
                padding-right: 0.5rem;
            }
        }
    </style>
</head>
<body class="min-h-screen overflow-x-hidden">

    <div class="relative min-h-screen w-full">

        <nav class="fixed top-0 left-0 right-0 z-50 bg-gradient-to-r from-[#906AF1] to-[#5438DB] text-white shadow-lg">
            <div class="container mx-auto px-4 sm:px-6 py-4 flex justify-between items-center">
                <a href="{{ route('home') }}" class="flex items-center space-x-2 text-xl sm:text-2xl font-bold">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6 text-pink-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                    </svg>
                    <span>LITERISE</span>
                </a>

                <div class="hidden md:flex items-center space-x-6">
                    <a href="{{ route('home') }}" class="hover:text-pink-300 transition-colors">Beranda</a>
                    <a href="{{ route('permainan.index') }}" class="hover:text-pink-300 transition-colors">Permainan</a>
                    <a href="{{ route('tentang.index') }}" class="hover:text-pink-300 transition-colors">Tentang</a>

                    @auth
                        <div x-data="{ open: false }" class="relative">
                            <button @click="open = !open" class="flex items-center space-x-2 bg-white/10 backdrop-blur-sm text-white font-semibold px-5 py-2 rounded-full transition-all duration-300 hover:bg-white/20 border border-white/20 btn-glow">
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
                    @else
                        <a href="{{ route('login') }}" class="hover:text-pink-300 transition-colors">Masuk</a>
                        <a href="{{ route('register') }}" class="header-btn text-white font-semibold px-5 py-2 rounded-full transition-all duration-300 hover:shadow-lg btn-glow">
                            Daftar
                        </a>
                    @endauth
                </div>

                <div class="md:hidden flex items-center">
                    <button id="mobile-menu-button" class="hamburger text-white focus:outline-none ml-2">
                        <span class="hamburger-line"></span>
                        <span class="hamburger-line"></span>
                        <span class="hamburger-line"></span>
                    </button>
                </div>
            </div>

            <div id="mobile-menu" class="mobile-menu">
                <a href="{{ route('home') }}" class="py-3 px-4 hover:text-pink-300 transition-colors border-b border-white/10">Beranda</a>
                <a href="{{ route('permainan.index') }}" class="py-3 px-4 hover:text-pink-300 transition-colors border-b border-white/10">Permainan</a>
                <a href="{{ route('tentang.index') }}" class="py-3 px-4 hover:text-pink-300 transition-colors border-b border-white/10">Tentang</a>

                @auth
                    <a href="{{ route('profile.index') }}" class="py-3 px-4 hover:text-pink-300 transition-colors border-b border-white/10">Profil Saya</a>
                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <button type="submit" class="w-full text-left py-3 px-4 hover:text-pink-300 transition-colors">
                            Logout
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="py-3 px-4 hover:text-pink-300 transition-colors border-b border-white/10">Masuk</a>
                    <a href="{{ route('register') }}" class="header-btn text-white font-semibold px-5 py-3 rounded-full transition-all duration-300 hover:shadow-lg my-2 text-center btn-glow block mx-4">
                        Daftar
                    </a>
                @endauth
            </div>
        </nav>

        <main class="relative z-20 hero-section pt-20 pb-64 md:pb-72 flex flex-col items-center justify-center text-center min-h-screen px-4">

            <div class="decorative-left absolute top-[-120px] left-[-180px] md:top-[-200px] md:left-[-300px]
                            w-[580px] h-[580px] md:w-[680px] md:h-[680px]
                            z-[-2] floating-slow">
                <img src="{{ asset('images/Elemen_Kiri_Pojok_Kanan_ATas.png') }}"
                    alt="Elemen Dekorasi Atas Kepala"
                    class="relative w-full h-full object-contain opacity-95 drop-shadow-[0_15px_40px_rgba(116,67,255,0.5)]">
            </div>

            <div class="decorative-right absolute top-[-100px] right-[-140px] md:top-[-145px] md:right-[-180px]
                            w-[400px] h-[400px] md:w-[500px] md:h-[500px]
                            z-0 floating">
                <img src="{{ asset('images/Elemen_Kanan_Atas.png') }}"
                    alt="Elemen Dekorasi Kanan Atas"
                    class="relative w-full h-full object-contain opacity-95 drop-shadow-[0_15px_40px_rgba(116,67,255,0.4)] z-[-2]">
            </div>

            <div class="illustration-kepala absolute top-[-px] left-[-100px] md:top-[-50px] md:left-[-120px]
                            w-[800px] h-[800px] sm:w-[600px] sm:h-[600px] lg:w-[900px] lg:h-[900px]
                            z-[-1] floating-slow">
                <img src="{{ asset('images/Kepala.png') }}"
                    alt="Kepala"
                    class="w-full h-full object-contain opacity-95 drop-shadow-[0_25px_60px_rgba(116,67,255,0.4)]">
            </div>

            <div class="illustration-journal absolute top-[60px] right-[-120px] md:top-[11px] md:right-[-140px]
                            w-[600px] h-[600px] sm:w-[500px] sm:h-[500px] lg:w-[750px] lg:h-[750px]
                            z-[-1] floating-fast">
                <img src="{{ asset('images/Journal.png') }}"
                    alt="Jurnal"
                    class="w-full h-full object-contain rotate-[-10deg] opacity-95 drop-shadow-[0_25px_60px_rgba(116,67,255,0.5)]">
            </div>

            <div class="relative z-10">
                <h1 class="literise-title blink" style="font-family: poppins;" data-aos="fade-down" data-aos-duration="1000">LITERISE</h1>
                <p class="bg-gradient-to-b from-[#7443ff] to-[#d3a2ff] bg-clip-text text-transparent text-lg md:text-xl max-w-lg mx-auto mt-4 subtitle-shadow 0 0 10px font-semibold" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
                    Tantang diri di Misi Baca Harian, Asah Kejelian lawan Hoax, dan Kumpulkan Badge keren!
                </p>

                <div class="flex flex-col sm:flex-row justify-center mt-10 space-y-4 sm:space-y-0 sm:space-x-4" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="400">

                    <a href="{{ route('permainan.index') }}" class="relative overflow-hidden font-semibold py-3 px-8 rounded-lg text-lg transition-all duration-300 hover:scale-105 shadow-[0_6px_20px_rgba(116,67,255,0.5)] hover:shadow-[0_8px_25px_rgba(116,67,255,0.7)] btn-glow block loading-button">
                        <span class="absolute inset-0 bg-gradient-to-b from-[#7443ff] to-[#d3a2ff] rounded-lg"></span>
                        <span class="relative bg-gradient-to-b from-[#fff7aD] to-[#ffa9f9] bg-clip-text text-transparent">Ayo Main!</span>
                    </a>

                    <a href="#fitur" class="relative overflow-hidden font-semibold py-3 px-8 rounded-lg text-lg transition-all duration-300 hover:scale-105 shadow-[0_6px_20px_rgba(116,67,255,0.5)] hover:shadow-[0_8px_25px_rgba(116,67,255,0.7)] btn-glow block loading-button">
                        <span class="absolute inset-0 bg-gradient-to-b from-[#F261A8] to-[#FD85C0] rounded-lg"></span>
                        <span class="relative bg-gradient-to-b from-[#fff7ad] to-[#ffa9f9] bg-clip-text text-transparent">Lihat selengkapnya</span>
                    </a>

                </div>
            </div>

            <div class="absolute bottom-[-40px] left-0 w-full h-full z-[-1] drop-shadow-[0_10px_25px_rgba(0,0,0,0.4)]">
                <img src="{{ asset('images/LiteRise.png') }}" class="w-full h-full object-cover" alt="Gelombang Latar Belakang">
                <img src="{{ asset('images/LiteRise.png') }}" class="w-full h-full object-cover scale-y-[-1]" alt="Gelombang Latar Belakang">
            </div>
        </main>

        <section id="fitur" class="relative py-20 wave-bg-flipped">
            <div class="container mx-auto px-6 relative z-30">
                <div class="text-center mb-16" data-aos="fade-up">
                    <div class="relative inline-block">
                        <div class="absolute inset-0 bg-gradient-to-r from-[#8f9bff]/40 to-[#f563fd]/40 blur-2xl rounded-2xl"></div>
                        <div class="relative backdrop-blur-xl bg-white/5 border border-white/10 rounded-2xl px-10 py-6 shadow-2xl">
                            <h2 class="text-4xl md:text-5xl font-bold bg-gradient-to-r from-[#f563fd] to-[#8f9bff] bg-clip-text text-transparent text-center">
                                Fitur Unggulan Literise
                            </h2>
                            <p class="text-lg text-white subtitle-shadow mx-auto">
                                Jelajahi berbagai fitur menarik yang akan meningkatkan kemampuan literasi digital Anda dengan cara yang menyenangkan
                            </p>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">

                    <div class="feature-card" data-aos="fade-up" data-aos-delay="100">
                        <div class="feature-card-content">
                            <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-gradient-to-br from-[#7443ff] to-[#d3a2ff] flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-[#4a2e7c] mb-3 text-center">Reading Mission</h3>
                            <p class="text-gray-600 text-center">
                                Cari topik, baca artikel AI, dan jawab 3 kuis pemahaman untuk mendapat poin.
                            </p>
                            <a href="{{ route('game.play') }}" class="feature-card-button loading-button">Mulai Misi</a>
                        </div>
                    </div>

                    <div class="feature-card" data-aos="fade-up" data-aos-delay="200">
                        <div class="feature-card-content">
                            <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-gradient-to-br from-[#7443ff] to-[#d3a2ff] flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-[#4a2e7c] mb-3 text-center">Hoax or Not?</h3>
                            <p class="text-gray-600 text-center">
                                Tebak berita viral ini fakta atau hoaks, lalu lihat penjelasan AI dan sumber aslinya.
                            </p>
                            <a href="{{ route('hoax.index') }}" class="feature-card-button loading-button">Cek Fakta</a>
                        </div>
                    </div>

                    <div class="feature-card" data-aos="fade-up" data-aos-delay="300">
                        <div class="feature-card-content">
                            <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-gradient-to-br from-[#7443ff] to-[#d3a2ff] flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-[#4a2e7c] mb-3 text-center">Library Hub</h3>
                            <p class="text-gray-600 text-center">
                                Baca cerpen atau artikel AI berdasarkan genre, lalu uji ingatan dengan game "Melengkapi Kata".
                            </p>
                            <a href="{{ route('library.index') }}" class="feature-card-button loading-button">Mulai Membaca</a>
                        </div>
                    </div>

                    <div class="feature-card" data-aos="fade-up" data-aos-delay="400">
                        <div class="feature-card-content">
                            <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-gradient-to-br from-[#7443ff] to-[#d3a2ff] flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-[#4a2e7c] mb-3 text-center">Zona Tata Bahasa</h3>
                            <p class="text-gray-600 text-center">
                                AI akan memberikan 5 kalimat (benar atau salah) berdasarkan genre. Tugas Anda adalah memperbaikinya!
                            </p>
                            <a href="{{ route('grammar.index') }}" class="feature-card-button loading-button">Asah Ejaan</a>
                        </div>
                    </div>

                </div>
            </div>
        </section>

                <section id="tentang" class="relative py-20 bg-gradient-to-b from-[#5c1d8f] to-[#4a2e7c]">
                <div class="container mx-auto px-6">
                    <div class="text-center mb-16" data-aos="fade-up">
                        <h2 class="text-4xl md:text-5xl font-bold bg-gradient-to-r from-[#f563fd] to-[#8f9bff] bg-clip-text text-transparent mb-4">
                            Tentang Literise
                        </h2>
                        <p class="text-lg text-white subtitle-shadow mx-auto max-w-3xl">
                            Literise adalah platform edukasi interaktif yang dirancang untuk meningkatkan literasi digital dan kemampuan berpikir kritis melalui permainan yang menyenangkan.
                        </p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                        <div data-aos="fade-right">
                            <div class="relative">
                                <div class="absolute -top-4 -left-4 w-full h-full bg-gradient-to-r from-[#7443ff] to-[#d3a2ff] rounded-2xl opacity-30"></div>
                                <div class="relative bg-white p-8 rounded-2xl shadow-xl">
                                    <h3 class="text-2xl font-bold text-[#4a2e7c] mb-4">Misi Kami</h3>
                                    <p class="text-gray-700 mb-6">
                                        Meningkatkan literasi digital masyarakat Indonesia melalui pendekatan yang menyenangkan dan interaktif. Kami percaya bahwa kemampuan literasi yang baik adalah kunci untuk menghadapi tantangan di era digital.
                                    </p>
                                    <div class="flex items-center space-x-4">
                                        <div class="flex-1">
                                            <div class="flex justify-between mb-1">
                                                <span class="text-sm font-medium text-[#4a2e7c]">Tingkat Literasi</span>
                                                <span class="text-sm font-medium text-[#4a2e7c]">65%</span>
                                            </div>
                                            <div class="progress-bar">
                                                <div class="progress-fill" style="width: 65%"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div data-aos="fade-left" data-aos-delay="200">
                            <div class="relative">
                                <div class="absolute -top-4 -left-4 w-full h-full bg-gradient-to-r from-[#7443ff] to-[#d3a2ff] rounded-2xl opacity-30"></div>
                                <div class="relative bg-white p-8 rounded-2xl shadow-xl">
                                    <h3 class="text-2xl font-bold text-[#4a2e7c] mb-4">Visi Kami</h3>
                                    <p class="text-gray-700 mb-6">
                                        Menjadi platform utama dalam meningkatkan literasi digital di Indonesia, dengan menyediakan konten berkualitas dan metode pembelajaran yang efektif serta menyenangkan bagi semua kalangan.
                                    </p>
                                    <div class="flex items-center space-x-4">
                                        <div class="flex-1">
                                            <div class="flex justify-between mb-1">
                                                <span class="text-sm font-medium text-[#4a2e7c]">Target Pengguna</span>
                                                <span class="text-sm font-medium text-[#4a2e7c]">1 Juta+</span>
                                            </div>
                                            <div class="progress-bar">
                                                <div class="progress-fill" style="width: 80%"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>


        <section class="relative py-20 bg-gradient-to-b from-[#4a2e7c] to-[#5c1d8f]">
            <div class="container mx-auto px-6">
                <div class="text-center mb-16" data-aos="fade-up">
                    <h2 class="text-4xl md:text-5xl font-bold bg-gradient-to-r from-[#f563fd] to-[#8f9bff] bg-clip-text text-transparent mb-4">
                        Koleksi Badge & Prestasi
                    </h2>
                    <p class="text-lg text-white subtitle-shadow mx-auto">
                        Kumpulkan badge menarik sebagai bukti pencapaian literasi digital Anda
                    </p>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                    <div class="text-center" data-aos="zoom-in" data-aos-delay="100">
                        <div class="relative inline-block mb-4">
                            <div class="w-24 h-24 mx-auto rounded-full bg-gradient-to-br from-[#7443ff] to-[#d3a2ff] flex items-center justify-center badge-pulse">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                        </div>
                        <h3 class="text-lg font-bold text-white">Fact Checker</h3>
                        <p class="text-gray-300 text-sm">Cek fakta 10 berita di Hoax or Not?</p>
                    </div>

                    <div class="text-center" data-aos="zoom-in" data-aos-delay="200">
                        <div class="relative inline-block mb-4">
                            <div class="w-24 h-24 mx-auto rounded-full bg-gradient-to-br from-[#7443ff] to-[#d3a2ff] flex items-center justify-center badge-float" style="animation-delay: 0.3s;">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>
                        <h3 class="text-lg font-bold text-white">Pemburu Fakta</h3>
                        <p class="text-gray-300 text-sm">Tandai 15 berita sebagai fakta</p>
                    </div>

                    <div class="text-center" data-aos="zoom-in" data-aos-delay="300">
                        <div class="relative inline-block mb-4">
                            <div class="w-24 h-24 mx-auto rounded-full bg-gradient-to-br from-[#7443ff] to-[#d3a2ff] flex items-center justify-center badge-pulse">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h11M9 21V3m0 0L5 7m4-4l4 4m6 4h2a2 2 0 012 2v6a2 2 0 01-2 2h-2M9 17h6" />
                                </svg>
                            </div>
                        </div>
                        <h3 class="text-lg font-bold text-white">Library Lover</h3>
                        <p class="text-gray-300 text-sm">Baca 20 artikel di Library Hub</p>
                    </div>
                    <div class="text-center" data-aos="zoom-in" data-aos-delay="400">
                        <div class="relative inline-block mb-4">
                            <div class="w-24 h-24 mx-auto rounded-full bg-gradient-to-br from-[#7443ff] to-[#d3a2ff] flex items-center justify-center badge-float" style="animation-delay: 0.5s;">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 17a2 2 0 104 0v-5a2 2 0 10-4 0v5zm-7 4a9 9 0 1118 0H4z" />
                                </svg>
                            </div>
                        </div>
                        <h3 class="text-lg font-bold text-white">Grammar Guru</h3>
                        <p class="text-gray-300 text-sm">Perbaiki 100 kalimat</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="relative py-20 bg-gradient-to-b from-[#5c1d8f] to-[#4a2e7c]">
            </section>

        <section class="relative py-20 bg-gradient-to-b from-[#4a2e7c] to-[#5c1d8f]">
            <div class="container mx-auto px-6">
                <div class="max-w-4xl mx-auto text-center" data-aos="fade-up">
                    <h2 class="text-4xl md:text-5xl font-bold bg-gradient-to-r from-[#f563fd] to-[#8f9bff] bg-clip-text text-transparent mb-6">
                        Bergabung dengan Literise Sekarang!
                    </h2>
                    <p class="text-lg text-white mb-8 max-w-2xl mx-auto">
                        Mulai perjalanan literasi digital Anda dan dapatkan pengalaman belajar yang menyenangkan dengan fitur-fitur interaktif kami.
                    </p>

                    @guest
                    <div class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-4">
                        <a href="{{ route('register') }}" class="relative overflow-hidden font-semibold py-3 px-8 rounded-lg text-lg transition-all duration-300 hover:scale-105 shadow-[0_6px_20px_rgba(116,67,255,0.5)] hover:shadow-[0_8px_25px_rgba(116,67,255,0.7)] btn-glow block loading-button">
                            <span class="absolute inset-0 bg-gradient-to-b from-[#7443ff] to-[#d3a2ff] rounded-lg"></span>
                            <span class="relative bg-gradient-to-b from-[#fff7aD] to-[#ffa9f9] bg-clip-text text-transparent">Daftar</span>
                        </a>

                        <a href="{{ route('login') }}" class="relative overflow-hidden font-semibold py-3 px-8 rounded-lg text-lg transition-all duration-300 hover:scale-105 shadow-[0_6px_20px_rgba(116,67,255,0.5)] hover:shadow-[0_8px_25px_rgba(116,67,255,0.7)] btn-glow block loading-button">
                            <span class="absolute inset-0 bg-gradient-to-b from-[#F261A8] to-[#FD85C0] rounded-lg"></span>
                            <span class="relative bg-gradient-to-b from-[#fff7ad] to-[#ffa9f9] bg-clip-text text-transparent">Masuk</span>
                        </a>
                    </div>
                    @endguest
                </div>
            </div>
        </section>

        <footer class="bottom-[-100px] w-full bg-[#4a2e7c] text-white pt-12 pb-6 relative z-[9999]">
            <div class="container mx-auto px-6 z-4">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-12">
                    <div class="col-span-1 md:col-span-2">
                        <h3 class="text-xl font-bold mb-4 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-pink-400 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                            </svg>
                            Tentang Literise
                        </h3>
                        <p class="text-gray-300 mb-4">
                            Literise adalah platform edukasi interaktif yang dirancang untuk meningkatkan literasi digital dan kemampuan berpikir kritis melalui permainan yang menyenangkan.
                        </p>
                        <div class="flex space-x-4">
                            <a href="#" class="platform-btn text-white p-3 rounded-full transition-all duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/>
                                </svg>
                            </a>
                            <a href="#" class="platform-btn text-white p-3 rounded-full transition-all duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z"/>
                                </svg>
                            </a>
                            <a href="#" class="platform-btn text-white p-3 rounded-full transition-all duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.012 8.012 0 0 0 16 8c0-4.42-3.58-8-8-8z"/>
                                </svg>
                            </a>
                        </div>
                    </div>

                    <div>
                        <h3 class="text-xl font-bold mb-4">Link Cepat</h3>
                        <ul class="space-y-2">
                            <li><a href="{{ route('home') }}" class="text-gray-300 hover:text-pink-300 transition-colors">Beranda</a></li>
                            <li><a href="{{ route('permainan.index') }}" class="text-gray-300 hover:text-pink-300 transition-colors">Permainan</a></li>
                            <li><a href="{{ route('tentang.index') }}" class="text-gray-300 hover:text-pink-300 transition-colors">Tentang Kami</a></li>
                            <li><a href="#" class="text-gray-300 hover:text-pink-300 transition-colors">Kontak</a></li>
                        </ul>
                    </div>

                    <div>
                        <h3 class="text-xl font-bold mb-4">Kontak</h3>
                        <ul class="space-y-2 text-gray-300">
                            <li class="flex items-start">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-pink-400 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                info@literise.com
                            </li>
                            <li class="flex items-start">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-pink-400 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                                +62 812 3456 7890
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="border-t border-gray-600 pt-6 flex flex-col md:flex-row justify-between items-center">
                    <p class="text-sm opacity-70 mb-4 md:mb-0">© 2025 Literise. Semua hak dilindungi.</p>
                    <div class="flex space-x-6 text-sm">
                        <a href="#" class="opacity-70 hover:opacity-100 transition-opacity">Kebijakan Privasi</a>
                        <a href="#" class="opacity-70 hover:opacity-100 transition-opacity">Syarat & Ketentuan</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // Inisialisasi AOS
        AOS.init({
            duration: 1000,
            once: true,
            offset: 100
        });

        // Mobile menu toggle dengan animasi hamburger - DIPERBAIKI
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            const mobileMenu = document.getElementById('mobile-menu');
            const hamburger = this;

            mobileMenu.classList.toggle('active');
            hamburger.classList.toggle('active');
        });

        // Tutup mobile menu ketika mengklik link di dalamnya
        document.querySelectorAll('#mobile-menu a').forEach(link => {
            link.addEventListener('click', function() {
                const mobileMenu = document.getElementById('mobile-menu');
                const hamburger = document.getElementById('mobile-menu-button');

                mobileMenu.classList.remove('active');
                hamburger.classList.remove('active');
            });
        });

        // Smooth scroll untuk anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();

                const targetId = this.getAttribute('href');
                if(targetId === '#') return;

                const targetElement = document.querySelector(targetId);
                if(targetElement) {
                    window.scrollTo({
                        top: targetElement.offsetTop - 80, // Offset 80px untuk fixed navbar
                        behavior: 'smooth'
                    });

                    // Tutup mobile menu jika terbuka
                    const mobileMenu = document.getElementById('mobile-menu');
                    const hamburger = document.getElementById('mobile-menu-button');
                    mobileMenu.classList.remove('active');
                    hamburger.classList.remove('active');
                }
            });
        });

        // Animasi Loading untuk tombol - DITAMBAHKAN
        document.querySelectorAll('.loading-button').forEach(button => {
            button.addEventListener('click', function(e) {
                // Simulasi loading (bisa dihapus jika menggunakan form submit asli)
                const originalText = this.innerHTML;
                this.innerHTML = '<span class="loading-spinner"></span>Loading...';
                this.style.pointerEvents = 'none';

                // Reset setelah 2 detik (simulasi)
                // Dalam aplikasi nyata, navigasi halaman akan mengambil alih
                setTimeout(() => {
                    this.innerHTML = originalText;
                    this.style.pointerEvents = 'auto';
                }, 2000);
            });
        });
    </script>
</body>
</html>
