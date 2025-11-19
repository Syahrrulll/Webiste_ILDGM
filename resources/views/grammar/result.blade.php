<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Kuis Tata Bahasa - Literise</title>

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

        /* Animasi untuk result-card */
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
            display: flex;
            flex-direction: column;
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

        .result-card::after {
            content: '';
            position: absolute;
            top: -2px;
            left: -2px;
            right: -2px;
            bottom: -2px;
            background: linear-gradient(45deg,
                #7443ff,
                #d3a2ff,
                #8c52ff,
                #7443ff);
            border-radius: 26px;
            z-index: -2;
            opacity: 0.3;
            transition: opacity 0.4s ease;
        }

        .result-card:hover::after {
            opacity: 0.6;
        }

        .result-card-content {
            position: relative;
            z-index: 2;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .result-button {
            display: inline-block;
            text-align: center;
            padding: 1rem 2rem;
            border-radius: 9999px;
            font-weight: 600;
            color: white;
            background: linear-gradient(135deg, #7443ff 0%, #8c52ff 100%);
            transition: all 0.3s ease;
            box-shadow: 0 8px 25px -3px rgba(116, 67, 255, 0.5);
            border: 1px solid rgba(255, 255, 255, 0.2);
            font-size: 1.1rem;
        }

        .result-button:hover {
            transform: scale(1.05);
            box-shadow: 0 12px 35px -3px rgba(116, 67, 255, 0.7);
            background: linear-gradient(135deg, #8c52ff 0%, #7443ff 100%);
        }

        /* Score card styling */
        .score-card {
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.15) 0%, rgba(37, 99, 235, 0.1) 100%);
            border: 1px solid rgba(59, 130, 246, 0.3);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            padding: 3rem;
            text-align: center;
            margin: 2rem 0;
        }

        /* Sentence result card */
        .sentence-result-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 16px;
            padding: 2rem;
            margin-bottom: 1.5rem;
            transition: all 0.3s ease;
        }

        .sentence-result-card:hover {
            background: rgba(255, 255, 255, 0.15);
            border-color: rgba(255, 255, 255, 0.3);
            transform: translateY(-2px);
        }

        .correct-card {
            border-left: 4px solid #10b981;
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.1) 0%, rgba(5, 150, 105, 0.05) 100%);
        }

        .incorrect-card {
            border-left: 4px solid #ef4444;
            background: linear-gradient(135deg, rgba(239, 68, 68, 0.1) 0%, rgba(220, 38, 38, 0.05) 100%);
        }

        .original-sentence {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            padding: 1.5rem;
            margin: 1rem 0;
            font-style: italic;
            font-size: 1.1rem;
            line-height: 1.6;
            color: rgba(255, 255, 255, 0.9);
        }

        /* Animasi floating yang lebih smooth */
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

        @keyframes float-fast {
            0%, 100% {
                transform: translateY(0px) scale(1);
            }
            50% {
                transform: translateY(-15px) scale(1.05);
            }
        }

        .floating {
            animation: float 6s ease-in-out infinite;
        }

        .floating-slow {
            animation: float-slow 8s ease-in-out infinite;
        }

        .floating-fast {
            animation: float-fast 4s ease-in-out infinite;
        }

        /* Animasi teks berkedip */
        @keyframes gentle-pulse {
            0%, 100% {
                opacity: 1;
                text-shadow: 0 0 10px #8c52ff, 0 0 20px #8c52ff;
            }
            50% {
                opacity: 0.9;
                text-shadow: 0 0 5px #8c52ff, 0 0 15px #8c52ff;
            }
        }

        .gentle-pulse {
            animation: gentle-pulse 4s ease-in-out infinite;
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

        /* Background pattern yang lebih subtle */
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

        /* Floating elements yang lebih natural */
        .floating-element {
            position: absolute;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(116, 67, 255, 0.15), transparent 70%);
            filter: blur(20px);
            z-index: -1;
            pointer-events: none;
        }

        /* Icon animation */
        @keyframes icon-float {
            0%, 100% {
                transform: translateY(0px) rotate(0deg);
            }
            33% {
                transform: translateY(-5px) rotate(2deg);
            }
            66% {
                transform: translateY(3px) rotate(-1deg);
            }
        }

        .icon-float {
            animation: icon-float 6s ease-in-out infinite;
        }

        /* Responsive adjustments */
        @media (max-width: 1024px) {
            .literise-title {
                font-size: 5rem;
            }
        }

        @media (max-width: 768px) {
            .literise-title {
                font-size: 4rem;
            }
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
                background: #2d1b69;
                padding: 1rem;
                z-index: 100;
            }
            .result-card {
                padding: 2rem 1.5rem;
            }
        }

        @media (max-width: 640px) {
            .literise-title { font-size: 3rem; }
            .result-card { padding: 1.5rem 1rem; }
            .floating-element {
                display: none;
            }
        }

        @media (max-width: 480px) {
            .literise-title { font-size: 2.5rem; }
        }
    </style>
</head>
<audio id="hasil" autoplay>
<source src="data:audio/mp3;base64,//NExAAAAANIAAAAAExBTUUzLjEwMKqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqq//NExAAAAANIAAAAAExBTUUzLjEwMKqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqq//NExAAAAANIAAAAAExBTUUzLjEwMKqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqq//NExAAAAANIAAAAAExBTUUzLjEwMKqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqq//NExAAAAANIAAAAAExBTUUzLjEwMKqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqq" type="audio/mpeg">
</audio>
<body class="min-h-screen overflow-x-hidden">

    <!-- Background Pattern -->
    <div class="bg-pattern"></div>

    <!-- Floating Elements yang lebih natural -->
    <div class="floating-element floating-slow w-64 h-64 top-10 left-10 opacity-40"></div>
    <div class="floating-element floating-fast w-48 h-48 bottom-20 right-20 opacity-30"></div>
    <div class="floating-element floating w-56 h-56 top-1/3 right-1/4 opacity-25"></div>
    <div class="floating-element floating-slow w-40 h-40 bottom-1/4 left-1/3 opacity-35"></div>

    <!-- ===== HEADER / NAVIGASI ===== -->
        <nav class="fixed top-0 left-0 right-0 z-50 bg-gradient-to-r from-[#2d1b69] to-[#1f1047] text-white shadow-lg border-b border-purple-500/20">
        <div class="container mx-auto px-4 sm:px-6 py-3 sm:py-4 flex justify-between items-center">

            <a href="{{ route('home') }}" class="flex items-center space-x-2 text-lg sm:text-2xl font-bold transition-transform hover:scale-105">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6 text-pink-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                </svg>
                <span>LITERISE</span>
            </a>

            <a href="{{ route('permainan.index') }}" class="flex items-center space-x-1 sm:space-x-2 bg-white/10 backdrop-blur-sm text-white font-semibold px-3 py-2 sm:px-5 sm:py-2 rounded-full transition-all duration-300 hover:bg-white/20 border border-white/20 btn-glow text-xs sm:text-base group">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-5 sm:w-5 group-hover:-translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>

                <span class="block sm:hidden">Kembali Ke Permainan</span>
                <span class="hidden sm:block">Kembali Ke Permainan</span>
            </a>
        </div>
    </nav>

    <!-- ===== MAIN CONTENT ===== -->
    <main class="relative z-20 pt-32 pb-20 flex flex-col items-center justify-center min-h-screen px-4">

        <!-- Konten Utama -->
        <div class="w-full max-w-6xl text-center relative z-10">
            <h1 class="literise-title gentle-pulse mb-6" data-aos="fade-down" data-aos-duration="1000">LITERISE</h1>

            <div class="result-card max-w-6xl mx-auto" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
                <div class="result-card-content">
                    <!-- Header Hasil -->
                    <div class="w-20 h-20 mx-auto mb-6 rounded-full bg-gradient-to-br from-[#7443ff] to-[#d3a2ff] flex items-center justify-center shadow-lg icon-float">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>

                    <h2 class="text-4xl font-bold text-white mb-4">📝 Hasil Kuis Tata Bahasa</h2>

                    <!-- Skor Total -->
                    <div class="score-card" data-aos="zoom-in" data-aos-delay="400">
                        <p class="text-2xl font-medium text-white mb-4">Skor Total Anda</p>
                        <div class="text-8xl font-bold text-white mb-4">{{ $result['total_score'] ?? 0 }}</div>

                        @if (($result['total_score'] ?? 0) >= 80)
                            <div class="bg-green-500/20 text-green-300 px-6 py-3 rounded-full text-lg font-semibold inline-block">
                                🎉 Luar biasa! Kemampuan tata bahasa Anda sangat baik.
                            </div>
                        @elseif (($result['total_score'] ?? 0) >= 60)
                            <div class="bg-blue-500/20 text-blue-300 px-6 py-3 rounded-full text-lg font-semibold inline-block">
                                👍 Bagus! Anda sudah teliti.
                            </div>
                        @else
                            <div class="bg-yellow-500/20 text-yellow-300 px-6 py-3 rounded-full text-lg font-semibold inline-block">
                                💪 Perlu sedikit latihan lagi, ayo coba lagi!
                            </div>
                        @endif
                    </div>

                    <!-- Detail Ulasan Jawaban -->
                    <div class="border-t border-white/20 pt-8">
                        <h2 class="text-3xl font-bold text-white mb-8 text-left">📋 Ulasan Jawaban</h2>

                        <div class="space-y-6">
                            @if (isset($result['results']) && is_array($result['results']))
                                @foreach ($result['results'] as $index => $item)
                                    <div class="sentence-result-card {{ $item['is_correct'] ? 'correct-card' : 'incorrect-card' }}"
                                         data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">

                                        <!-- Header Kalimat -->
                                        <div class="flex items-center mb-4">
                                            <span class="bg-gradient-to-r from-purple-500 to-pink-500 text-white px-4 py-2 rounded-full text-sm font-bold mr-3">
                                                {{ $index + 1 }}
                                            </span>
                                            <h3 class="text-xl font-bold text-white">Kalimat {{ $index + 1 }}</h3>
                                        </div>

                                        <!-- Kalimat Asli -->
                                        <div class="mb-4">
                                            <p class="text-lg font-semibold text-white/80 mb-2">Kalimat Asli:</p>
                                            <div class="original-sentence">
                                                <p>"{{ $item['original'] }}"</p>
                                            </div>
                                        </div>

                                        <!-- Hasil Koreksi -->
                                        <div class="space-y-3">
                                            @if ($item['is_correct'])
                                                <div class="flex items-start">
                                                    <span class="text-3xl mr-3 text-green-400">✅</span>
                                                    <div class="flex-1">
                                                        <p class="text-xl text-green-300 font-semibold">
                                                            Koreksi Anda: <span class="font-bold text-white">{{ $item['user_correction'] }}</span>
                                                        </p>
                                                        <p class="text-green-400 text-lg mt-1">🎯 Benar!</p>
                                                        @if ($item['user_correction'] == $item['original'])
                                                            <p class="text-green-300 text-sm mt-1">(Kalimat aslinya memang sudah benar)</p>
                                                        @endif
                                                    </div>
                                                </div>
                                            @else
                                                <div class="flex items-start">
                                                    <span class="text-3xl mr-3 text-red-400">❌</span>
                                                    <div class="flex-1">
                                                        <p class="text-xl text-red-300 font-semibold mb-2">
                                                            Koreksi Anda: <span class="font-bold text-white line-through">{{ $item['user_correction'] }}</span>
                                                        </p>
                                                        <p class="text-xl text-green-300 font-semibold">
                                                            Jawaban Benar: <span class="font-bold text-white">{{ $item['correct_sentence'] }}</span>
                                                        </p>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="bg-red-500/20 border-l-4 border-red-500 text-red-200 p-4 rounded-lg">
                                    <p class="font-bold">Error!</p>
                                    <p>Gagal memuat ulasan hasil.</p>
                                </div>
                            @endif
                        </div>

                        <!-- Tombol Aksi -->
                        <div class="mt-10 pt-8 border-t border-white/20 flex flex-col sm:flex-row gap-4" data-aos="fade-up" data-aos-delay="600">
                            <a href="{{ route('grammar.index') }}"
                               class="result-button btn-glow flex-1 text-center">
                                🎮 Coba Genre Lain
                            </a>
                            <a href="{{ route('permainan.index') }}"
                               class="result-button bg-transparent border-2 border-white/30 text-white hover:bg-white/10 flex-1 text-center">
                                🏠 Kembali ke Halaman Permainan
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- ===== FOOTER ===== -->
    <footer class="w-full bg-[#160b35] text-white pt-16 pb-8 relative z-10 border-t border-purple-500/20">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-12">
                <!-- Kolom 1: Tentang -->
                <div class="col-span-1 md:col-span-2">
                    <h3 class="text-xl font-bold mb-4 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-pink-400 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                        </svg>
                        Tentang Literise
                    </h3>
                    <p class="text-gray-300 mb-4 leading-relaxed">
                        Literise adalah platform edukasi interaktif yang dirancang untuk meningkatkan literasi digital
                        dan kemampuan berpikir kritis melalui permainan yang menyenangkan dan engaging.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="platform-btn text-white p-3 rounded-full transition-all duration-300 hover:scale-110">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/>
                            </svg>
                        </a>
                        <a href="#" class="platform-btn text-white p-3 rounded-full transition-all duration-300 hover:scale-110">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 3.323 3.323 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z"/>
                            </svg>
                        </a>
                        <a href="#" class="platform-btn text-white p-3 rounded-full transition-all duration-300 hover:scale-110">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.012 8.012 0 0 0 16 8c0-4.42-3.58-8-8-8z"/>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Kolom 2: Link Cepat -->
                <div>
                    <h3 class="text-xl font-bold mb-4">Link Cepat</h3>
                    <ul class="space-y-3">
                        <li><a href="{{ route('home') }}" class="text-gray-300 hover:text-pink-300 transition-colors flex items-center">
                            <span class="w-2 h-2 bg-pink-400 rounded-full mr-3"></span>
                            Beranda
                        </a></li>
                        <li><a href="{{ route('permainan.index') }}" class="text-gray-300 hover:text-pink-300 transition-colors flex items-center">
                            <span class="w-2 h-2 bg-purple-400 rounded-full mr-3"></span>
                            Permainan
                        </a></li>
                        <li><a href="{{ route('tentang.index') }}" class="text-gray-300 hover:text-pink-300 transition-colors flex items-center">
                            <span class="w-2 h-2 bg-blue-400 rounded-full mr-3"></span>
                            Tentang Kami
                        </a></li>
                        <li><a href="#" class="text-gray-300 hover:text-pink-300 transition-colors flex items-center">
                            <span class="w-2 h-2 bg-green-400 rounded-full mr-3"></span>
                            Kontak
                        </a></li>
                    </ul>
                </div>

                <!-- Kolom 3: Kontak -->
                <div>
                    <h3 class="text-xl font-bold mb-4">Kontak</h3>
                    <ul class="space-y-4 text-gray-300">
                        <li class="flex items-start">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-pink-400 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            info@literise.com
                        </li>
                        <li class="flex items-start">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-pink-400 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            +62 812 3456 7890
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Bagian bawah footer -->
            <div class="border-t border-gray-600 pt-8 flex flex-col md:flex-row justify-between items-center">
                <p class="text-sm opacity-70 mb-4 md:mb-0">© 2025 Literise. Semua hak dilindungi.</p>
                <div class="flex space-x-6 text-sm">
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
    </script>
</body>
</html>
