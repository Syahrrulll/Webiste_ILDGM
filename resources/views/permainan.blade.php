<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Judul diubah untuk halaman ini -->
    <title>Daftar Permainan - Literise</title>

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

        /* ... (SEMUA CSS CUSTOM DARI welcome.blade.php DISALIN DI SINI ... ) ... */

        .literise-title {
            font-size: 6rem;
            /* ... (sisa CSS Anda) ... */
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
            display: flex; /* Tambahan untuk layout */
            flex-direction: column; /* Tambahan untuk layout */
        }
        .feature-card-content {
            position: relative;
            z-index: 2;
            flex-grow: 1; /* Tambahan untuk layout */
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
            flex-grow: 1; /* Membuat <p> mengisi ruang */
            margin-bottom: 1.5rem; /* Jarak sebelum tombol */
        }
        .feature-card-button {
            margin-top: auto; /* Mendorong tombol ke bawah */
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

        /* ... (Sisa CSS Responsive Anda) ... */
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
    </style>
</head>
<body class="min-h-screen overflow-x-hidden">

    <div class="relative min-h-screen w-full">

        <!-- ===== HEADER / NAVIGASI ===== -->
        <!-- Disalin dari welcome.blade.php -->
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

                    <!-- PERUBAHAN LINK -->
                    <a href="{{ route('permainan.index') }}" class="text-pink-300 font-bold transition-colors">Permainan</a> <!-- Tautan ini sekarang aktif -->

                    <a href="{{ route('home') }}#tentang" class="hover:text-pink-300 transition-colors">Tentang</a> <!-- Tautan ini kembali ke home#tentang -->

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
                <!-- PERUBAHAN LINK -->
                <a href="{{ route('permainan.index') }}" class="py-2 px-4 text-pink-300 font-bold transition-colors">Permainan</a>
                <a href="{{ route('home') }}#tentang" class="py-2 px-4 hover:text-pink-300 transition-colors">Tentang</a>

                @auth
                    <a href="{{ route('profile.index') }}" class="py-2 px-4 hover:text-pink-300 transition-colors">Profil Saya</a>
                    <a href="{{ route('leaderboard.index') }}" class="py-2 px-4 hover:text-pink-300 transition-colors">Leaderboard</a>
                    <form method="POST" action="{{ route('logout') }}" class="inline w-full">
                        @csrf
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault(); this.closest('form').submit();"
                           class="header-btn text-white font-semibold px-5 py-2 rounded-full transition-all duration-300 hover:shadow-lg my-2 text-center btn-glow w-full block">
                            Logout
                        </a>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="py-2 px-4 hover:text-pink-300 transition-colors">Masuk</a>
                    <a href="{{ route('register') }}" class="header-btn text-white font-semibold px-5 py-2 rounded-full transition-all duration-300 hover:shadow-lg my-2 text-center btn-glow">
                        Daftar
                    </a>
                @endauth
            </div>
        </nav>


        <!-- =================================== -->
        <!-- KONTEN BARU UNTUK HALAMAN PERMAINAN -->
        <!-- =================================== -->
        <main class="relative z-20 pt-32 pb-20"> <!-- Padding atas & bawah agar tidak tertutup nav/footer -->

            <!-- Menggunakan kembali section "fitur" dari welcome.blade.php -->
            <section id="permainan" class="relative py-20 wave-bg-flipped">
                <div class="container mx-auto px-6 relative z-30">
                    <div class="text-center mb-16" data-aos="fade-up">
                        <div class="relative inline-block">
                            <div class="absolute inset-0 bg-gradient-to-r from-[#8f9bff]/40 to-[#f563fd]/40 blur-2xl rounded-2xl"></div>
                            <div class="relative backdrop-blur-xl bg-white/5 border border-white/10 rounded-2xl px-10 py-6 shadow-2xl">

                                <!-- Judul diubah -->
                                <h2 class="text-4xl md:text-5xl font-bold bg-gradient-to-r from-[#f563fd] to-[#8f9bff] bg-clip-text text-transparent text-center">
                                    Daftar Permainan
                                </h2>
                                <p class="text-lg text-white subtitle-shadow mx-auto">
                                    Jelajahi berbagai fitur menarik yang akan meningkatkan kemampuan literasi digital Anda dengan cara yang menyenangkan
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Grid 4 kolom disalin dari welcome.blade.php -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">

                        <!-- Fitur 1: Reading Mission -->
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
                                <a href="{{ route('game.play') }}" class="feature-card-button">Mulai Misi</a>
                            </div>
                        </div>

                        <!-- Fitur 2: Hoax or Not? -->
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
                                <a href="{{ route('hoax.index') }}" class="feature-card-button">Cek Fakta</a>
                            </div>
                        </div>

                        <!-- Fitur 3: Library Hub -->
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
                                <a href="{{ route('library.index') }}" class="feature-card-button">Mulai Membaca</a>
                            </div>
                        </div>

                        <!-- Fitur 4: Zona Tata Bahasa (BARU) -->
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
                                <a href="{{ route('grammar.index') }}" class="feature-card-button">Asah Ejaan</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
        <!-- =================================== -->
        <!-- AKHIR KONTEN BARU                   -->
        <!-- =================================== -->


        <!-- ===== FOOTER ===== -->
        <!-- Disalin dari welcome.blade.php -->
        <footer class="bottom-[-100px] w-full bg-[#4a2e7c] text-white pt-12 pb-6 relative z-[9999]">
            <div class="container mx-auto px-6 z-4">
                <!-- ... (Isi Footer disalin) ... -->
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
                            <li><a href="{{ route('home') }}#tentang" class="text-gray-300 hover:text-pink-300 transition-colors">Tentang Kami</a></li>
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

        // Smooth scroll untuk anchor links (hanya untuk link #tentang di halaman ini)
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                // Modifikasi: Hanya cegah default jika itu #
                const targetId = this.getAttribute('href');
                if (targetId.startsWith('#') && targetId.length > 1) {
                    e.preventDefault();

                    // Jika link # ada di halaman ini, scroll ke sana
                    const targetElement = document.querySelector(targetId);
                    if(targetElement) {
                        window.scrollTo({
                            top: targetElement.offsetTop - 80, // Offset 80px untuk header
                            behavior: 'smooth'
                        });
                    } else {
                        // Jika tidak ada (seperti #tentang di halaman ini), pergi ke home
                        window.location.href = '{{ route("home") }}' + targetId;
                    }

                    // Tutup mobile menu jika terbuka
                    const mobileMenu = document.getElementById('mobile-menu');
                    mobileMenu.classList.remove('active');
                }
                // Jika tidak, biarkan link (seperti ke route lain) berjalan normal
            });
        });
    </script>
</body>
</html>
