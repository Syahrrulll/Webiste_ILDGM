<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Kami - Literise</title>

    <!-- Semua <head> disalin dari welcome.blade.php untuk konsistensi -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- Semua <style> disalin dari welcome.blade.php -->
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
        /* ... (SEMUA CSS CUSTOM DARI welcome.blade.php DISALIN DI SINI) ... */
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
            background: #d9bbff; /* Warna dasar kartu */
            z-index: 1;
        }
        @keyframes rotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
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
        .wave-bg { position: relative; overflow: hidden; }
        .wave-bg-flipped::before { transform: scaleY(-1); }
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }
        .floating { animation: float 5s ease-in-out infinite; }
        .floating-slow { animation: float 7s ease-in-out infinite; }
        .floating-fast { animation: float 3s ease-in-out infinite; }
        @keyframes blink {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.7; }
        }
        .blink { animation: blink 2s infinite; }
        .btn-glow { position: relative; overflow: hidden; }
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
        .btn-glow:hover::before { left: 100%; }
        @keyframes badge-rotate {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        .badge-rotate { animation: badge-rotate 10s linear infinite; }
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
        @media (max-width: 768px) {
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
        }
        /* ... (sisa CSS responsive) ... */
    </style>
</head>
<body class="min-h-screen overflow-x-hidden">

    <div class="relative min-h-screen w-full">

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

                    <!-- Tautan "Tentang" sekarang aktif -->
                    <a href="{{ route('tentang.index') }}" class="text-pink-300 font-bold transition-colors">Tentang</a>

                    <!-- LOGIKA AUTH (Disalin) -->
                    @auth
                        <div x-data="{ open: false }" class="relative">
                            <button @click="open = !open" class="flex items-center space-x-2 header-btn text-white font-semibold px-5 py-2 rounded-full transition-all duration-300 hover:shadow-lg btn-glow">
                                <span>{{ Str::limit(Auth::user()->name, 10) }}</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                            <div x-show="open"
                                 @click.away="open = false"
                                 x-transition
                                 class="absolute right-0 mt-2 w-56 bg-white rounded-lg shadow-xl z-50 overflow-hidden"
                                 style="display: none;">

                                <div class="px-4 py-3 border-b border-gray-200">
                                    <p class="text-sm font-medium text-gray-900 truncate">{{ Auth::user()->name }}</p>
                                    <p class="text-xs text-gray-500 truncate">{{ Auth::user()->email }}</p>
                                </div>
                                <a href="{{ route('profile.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profil & Badge Saya</a>
                                <a href="{{ route('leaderboard.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Leaderboard</a>
                                <form method="POST" action="{{ route('logout') }}" class="inline">
                                    @csrf
                                    <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault(); this.closest('form').submit();"
                                       class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100 border-t border-gray-200">
                                        Logout
                                    </a>
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
                <a href="{{ route('tentang.index') }}" class="py-2 px-4 text-pink-300 font-bold transition-colors">Tentang</a>

                @auth
                    <!-- ... (Menu mobile auth disalin) ... -->
                @else
                    <a href="{{ route('login') }}" class="py-2 px-4 hover:text-pink-300 transition-colors">Masuk</a>
                    <a href="{{ route('register') }}" class="header-btn text-white font-semibold px-5 py-2 rounded-full transition-all duration-300 hover:shadow-lg my-2 text-center btn-glow">
                        Daftar
                    </a>
                @endauth
            </div>
        </nav>


        <!-- =================================== -->
        <!-- KONTEN BARU UNTUK HALAMAN TENTANG   -->
        <!-- =================================== -->
        <main class="relative z-20 pt-32 pb-20"> <!-- Padding atas & bawah -->

            <!-- SECTION TENTANG (Dipindahkan dari Welcome) -->
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

            <!-- SECTION TIM KAMI (BARU) -->
            <section id="tim" class="relative py-20 bg-gradient-to-b from-[#4a2e7c] to-[#5c1d8f]">
                <div class="container mx-auto px-6">
                    <div class="text-center mb-16" data-aos="fade-up">
                        <h2 class="text-4xl md:text-5xl font-bold bg-gradient-to-r from-[#f563fd] to-[#8f9bff] bg-clip-text text-transparent mb-4">
                            Tim Kami
                        </h2>
                        <p class="text-lg text-white subtitle-shadow mx-auto max-w-3xl">
                            Orang-orang di balik layar yang berdedikasi mewujudkan Literise.
                        </p>
                    </div>

                    <!--  -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <!-- Anggota Tim 1 -->
                        <div class="text-center text-white" data-aos="fade-up" data-aos-delay="100">
                            <img src="https://placehold.co/400x400/d3a2ff/4a2e7c?text=Foto+Tim+1" alt="Anggota Tim 1" class="w-48 h-48 rounded-full mx-auto mb-6 border-4 border-[#d3a2ff] shadow-lg">
                            <h3 class="text-2xl font-bold">Nama Pembuat 1</h3>
                            <p class="text-pink-300">Project Manager & Lead Developer</p>
                            <p class="text-gray-300 text-sm mt-2 max-w-xs mx-auto">Bertanggung jawab atas visi produk dan pengembangan inti aplikasi.</p>
                        </div>

                        <!-- Anggota Tim 2 -->
                        <div class="text-center text-white" data-aos="fade-up" data-aos-delay="200">
                            <img src="https://placehold.co/400x400/d3a2ff/4a2e7c?text=Foto+Tim+2" alt="Anggota Tim 2" class="w-48 h-48 rounded-full mx-auto mb-6 border-4 border-[#d3a2ff] shadow-lg">
                            <h3 class="text-2xl font-bold">Nama Pembuat 2</h3>
                            <p class="text-pink-300">UI/UX Designer</p>
                            <p class="text-gray-300 text-sm mt-2 max-w-xs mx-auto">Mendesain antarmuka yang cantik dan pengalaman pengguna yang intuitif.</p>
                        </div>

                        <!-- Anggota Tim 3 -->
                        <div class="text-center text-white" data-aos="fade-up" data-aos-delay="300">
                            <img src="https://placehold.co/400x400/d3a2ff/4a2e7c?text=Foto+Tim+3" alt="Anggota Tim 3" class="w-48 h-48 rounded-full mx-auto mb-6 border-4 border-[#d3a2ff] shadow-lg">
                            <h3 class="text-2xl font-bold">Nama Pembuat 3</h3>
                            <p class="text-pink-300">Content & AI Specialist</p>
                            <p class="text-gray-300 text-sm mt-2 max-w-xs mx-auto">Membuat konten permainan yang edukatif dan mengintegrasikan AI.</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- SECTION BADGE (Dipindahkan dari Welcome) -->
            <section class="relative py-20 bg-gradient-to-b from-[#5c1d8f] to-[#4a2e7c]">
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
                        <!-- Badge 1 -->
                        <div class="text-center" data-aos="zoom-in" data-aos-delay="100">
                            <div class="relative inline-block mb-4">
                                <div class="w-24 h-24 mx-auto rounded-full bg-gradient-to-br from-[#7443ff] to-[#d3a2ff] flex items-center justify-center badge-rotate">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                    </svg>
                                </div>
                            </div>
                            <h3 class="text-lg font-bold text-white">Pembaca Aktif</h3>
                            <p class="text-gray-300 text-sm">Selesaikan 10 misi membaca</p>
                        </div>

                        <!-- Badge 2 -->
                        <div class="text-center" data-aos="zoom-in" data-aos-delay="200">
                            <div class="relative inline-block mb-4">
                                <div class="w-24 h-24 mx-auto rounded-full bg-gradient-to-br from-[#7443ff] to-[#d3a2ff] flex items-center justify-center badge-rotate">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                    </svg>
                                </div>
                            </div>
                            <h3 class="text-lg font-bold text-white">Hoax Buster</h3>
                            <p class="text-gray-300 text-sm">Identifikasi 50 berita hoax</p>
                        </div>

                        <!-- Badge 3 -->
                        <div class="text-center" data-aos="zoom-in" data-aos-delay="300">
                            <div class="relative inline-block mb-4">
                                <div class="w-24 h-24 mx-auto rounded-full bg-gradient-to-br from-[#7443ff] to-[#d3a2ff] flex items-center justify-center badge-rotate">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                    </svg>
                                </div>
                            </div>
                            <h3 class="text-lg font-bold text-white">Literasi Expert</h3>
                            <p class="text-gray-300 text-sm">Capai level tertinggi</p>
                        </div>

                        <!-- Badge 4 -->
                        <div class="text-center" data-aos="zoom-in" data-aos-delay="400">
                            <div class="relative inline-block mb-4">
                                <div class="w-24 h-24 mx-auto rounded-full bg-gradient-to-br from-[#7443ff] to-[#d3a2ff] flex items-center justify-center badge-rotate">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                </div>
                            </div>
                            <h3 class="text-lg font-bold text-white">Komunitas Aktif</h3>
                            <p class="text-gray-300 text-sm">Bergabung dengan komunitas</p>
                        </div>
                    </div>
                </div>
            </section>
        </main>
        <!-- =================================== -->
        <!-- AKHIR KONTEN BARU                   -->
        <!-- =================================== -->


        <!-- ===== FOOTER ===== -->
        <footer class="bottom-[-100px] w-full bg-[#4a2e7c] text-white pt-12 pb-6 relative z-[9999]">
            <div class="container mx-auto px-6 z-4">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-12">
                    <!-- Kolom 1: Tentang -->
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
                        <!-- ... (Ikon sosmed) ... -->
                    </div>

                    <!-- Kolom 2: Link Cepat -->
                    <div>
                        <h3 class="text-xl font-bold mb-4">Link Cepat</h3>
                        <ul class="space-y-2">
                            <li><a href="{{ route('home') }}" class="text-gray-300 hover:text-pink-300 transition-colors">Beranda</a></li>
                            <li><a href="{{ route('permainan.index') }}" class="text-gray-300 hover:text-pink-300 transition-colors">Permainan</a></li>
                            <li><a href="{{ route('tentang.index') }}" class="text-gray-300 hover:text-pink-300 transition-colors">Tentang Kami</a></li>
                            <li><a href="#" class="text-gray-300 hover:text-pink-300 transition-colors">Kontak</a></li>
                        </ul>
                    </div>

                    <!-- Kolom 3: Kontak -->
                    <div>
                        <h3 class="text-xl font-bold mb-4">Kontak</h3>
                        <!-- ... (Info kontak) ... -->
                    </div>
                </div>
                <!-- Bagian bawah footer -->
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

        // Hapus script smooth scroll (atau modifikasi jika masih ada #)
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                const targetId = this.getAttribute('href');
                // Hanya jalankan smooth scroll jika # BUKAN #
                if (targetId.startsWith('#') && targetId.length > 1) {
                    e.preventDefault();

                    const targetElement = document.querySelector(targetId);
                    if(targetElement) {
                        window.scrollTo({
                            top: targetElement.offsetTop - 80, // Offset 80px
                            behavior: 'smooth'
                        });
                    } else {
                        // Jika target tidak ada di halaman ini, navigasi ke home + hash
                         window.location.href = '{{ route("home") }}' + targetId;
                    }

                    // Tutup mobile menu
                    const mobileMenu = document.getElementById('mobile-menu');
                    mobileMenu.classList.remove('active');
                }
                // Jika href BUKAN # (misal: /permainan), biarkan browser navigasi normal
            });
        });
    </script>
</body>
</html>
