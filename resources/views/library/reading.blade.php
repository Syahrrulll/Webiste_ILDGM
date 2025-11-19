<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Baca: {{ $game_data['title'] }} - Literise</title>

    <!-- Memuat Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Memuat Google Fonts (Poppins) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet">

    <!-- AOS Library untuk animasi scroll -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- Tambahkan CSS untuk styling teks bacaan -->
    <link href="https://cdn.jsdelivr.net/npm/@tailwindcss/typography@0.5.x/dist/typography.min.css" rel="stylesheet">

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

        .reading-text p {
            margin-bottom: 1.5rem;
            line-height: 1.8;
            color: #4a2e7c;
        }

        .reading-text strong {
            color: #7443ff;
            font-weight: 700;
        }

        .reading-text em {
            color: #d3a2ff;
            font-style: italic;
        }

        /* Animasi untuk reading-card */
        .reading-card {
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

        .reading-card::before {
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

        .reading-card::after {
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

        .reading-card:hover::after {
            opacity: 0.6;
        }

        .reading-card-button {
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
            text-decoration: none;
        }

        .reading-card-button:hover:not(.disabled) {
            transform: scale(1.05);
            box-shadow: 0 12px 35px -3px rgba(116, 67, 255, 0.7);
            background: linear-gradient(135deg, #8c52ff 0%, #7443ff 100%);
        }

        .disabled {
            opacity: 0.5;
            cursor: not-allowed;
            pointer-events: none;
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

        /* Countdown styling */
        .countdown-container {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 16px;
            padding: 1.5rem;
            margin-bottom: 2rem;
        }

        .countdown-number {
            font-size: 1.5rem;
            font-weight: 700;
            color: #7443ff;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 12px;
            padding: 0.5rem 1rem;
            display: inline-block;
            margin: 0 0.5rem;
            box-shadow: 0 4px 15px -3px rgba(116, 67, 255, 0.3);
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



        /* Text content styling */
        .text-content {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 2.5rem;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        /* Animasi teks berkedip */
        @keyframes gentle-pulse {
            0%, 100% {
                opacity: 1;
            }
            50% {
                opacity: 0.9;
            }
        }

        .gentle-pulse {
            animation: gentle-pulse 4s ease-in-out infinite;
        }

        /* Animasi untuk progress bar */
        .progress-bar {
            height: 6px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 3px;
            overflow: hidden;
            position: relative;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #7443ff, #d3a2ff);
            border-radius: 3px;
            transition: width 0.5s ease;
        }

        /* Mobile touch feedback */
        .touch-feedback:active {
            transform: scale(0.98);
            transition: transform 0.1s ease;
        }

        /* Responsive adjustments */
        @media (max-width: 1024px) {
            .reading-card {
                padding: 2.5rem 2rem;
            }
        }

        @media (max-width: 768px) {
            .reading-card {
                padding: 2rem 1.5rem;
            }
            .text-content {
                padding: 2rem 1.5rem;
            }
            .floating-element {
                display: none;
            }
            .mobile-reading-section {
                padding-top: 6rem;
                padding-bottom: 3rem;
            }
            .mobile-reading-header {
                flex-direction: column;
                gap: 1rem;
                text-align: center;
            }
            .mobile-reading-stats {
                grid-template-columns: repeat(2, 1fr);
                gap: 1rem;
            }
        }

        @media (max-width: 640px) {
            .reading-card {
                padding: 1.5rem 1rem;
            }
            .text-content {
                padding: 1.5rem 1rem;
            }
            .mobile-reading-section {
                padding-top: 5rem;
                padding-bottom: 2rem;
            }
        }

        /* Mobile-specific improvements */
        .mobile-reading-section {
            padding-top: 8rem;
            padding-bottom: 4rem;
        }

        .mobile-reading-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .mobile-reading-stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        /* Reading progress indicator */
        .reading-progress {
            position: fixed;
            top: 80px;
            left: 0;
            right: 0;
            height: 4px;
            background: rgba(255, 255, 255, 0.1);
            z-index: 40;
        }

        .reading-progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #7443ff, #d3a2ff);
            transition: width 0.3s ease;
            width: 0%;
        }

        /* Text selection styling */
        .text-content ::selection {
            background: rgba(116, 67, 255, 0.3);
            color: #4a2e7c;
        }

        /* Animasi untuk bookmark */
        @keyframes bookmark-pulse {
            0%, 100% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.1);
            }
        }

        .bookmark-pulse {
            animation: bookmark-pulse 2s ease-in-out infinite;
        }

        /* Reading timer */
        .reading-timer {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 12px;
            padding: 1rem;
            margin-bottom: 1.5rem;
        }

        /* Text size controls */
        .text-size-controls {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 12px;
            padding: 0.75rem;
            margin-bottom: 1.5rem;
        }
    </style>
</head>

<body class="min-h-screen overflow-x-hidden">





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
    <main class="relative z-20 mobile-reading-section flex flex-col items-center justify-center min-h-screen px-4">

        <!-- Konten Utama -->
        <div class="w-full max-w-6xl text-center relative z-10">

            <!-- Reading Controls -->
            <div class="flex justify-center gap-4 mb-6" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="150">
                <div class="text-size-controls flex items-center gap-2">
                    <button class="text-white p-2 rounded-lg bg-white/10 hover:bg-white/20 transition-colors touch-feedback" onclick="changeTextSize(-1)">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <span class="text-white text-sm">Ukuran Teks</span>
                    <button class="text-white p-2 rounded-lg bg-white/10 hover:bg-white/20 transition-colors touch-feedback" onclick="changeTextSize(1)">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7" />
                        </svg>
                    </button>
                </div>
            </div>

            <div class="reading-card max-w-6xl mx-auto" data-aos="fade-up" data-aos-duration="1000">
                <div class="text-center mb-10">
                    <div class="w-20 h-20 mx-auto mb-6 rounded-full bg-gradient-to-br from-[#7443ff] to-[#d3a2ff] flex items-center justify-center shadow-lg bookmark-pulse">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>

                    <h1 class="text-4xl font-bold text-white mb-4 gentle-pulse">
                        📖 {{ $game_data['title'] }}
                    </h1>
                    <p class="text-xl text-gray-300 mb-8">
                        Bacalah dengan seksama sebelum memulai kuis
                    </p>
                </div>

                <!-- Reading Timer -->
                <div class="reading-timer mb-6" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
                    <div class="flex items-center justify-center space-x-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span class="text-white font-semibold">Disarankan baca dengan teliti</span>
                    </div>
                </div>

                <!-- Countdown Timer -->
                <div class="countdown-container" id="countdown-container">
                    <p class="text-lg text-white mb-3 font-semibold">
                        ⏳ Tunggu sebentar sebelum memulai kuis...
                    </p>
                    <div class="flex items-center justify-center space-x-2">
                        <span class="text-white">Tombol kuis aktif dalam</span>
                        <span class="countdown-number" id="countdown-number">10</span>
                        <span class="text-white">detik</span>
                    </div>
                    <div class="progress-bar mt-4">
                        <div class="progress-fill" id="progress-fill" style="width: 0%"></div>
                    </div>
                </div>

                <!-- 1. Teks Bacaan Lengkap -->
                <div class="mb-10 text-left">
                    <h2 class="text-2xl font-semibold text-white mb-6 text-center">📚 Silakan Baca Teks Berikut:</h2>
                    <div class="text-content reading-text prose prose-lg max-w-none" id="reading-content">

                        {!! $game_data['full_text'] ?? 'Teks bacaan tidak tersedia.' !!}
                    </div>
                </div>

                <!-- Reading Completion Check -->
                <div class="bg-green-500/20 border border-green-500/30 rounded-xl p-4 mb-6 hidden" id="completion-check">
                    <div class="flex items-center justify-center space-x-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                        <span class="text-green-400 font-semibold">Bagus! Anda telah menyelesaikan membaca.</span>
                    </div>
                </div>

                <!-- 2. Tombol Mulai Kuis -->
                <div class="border-t border-white/20 pt-8 text-center">
                    <a id="quiz-button"
                       href="{{ route('library.show_quiz', $game_data['game_id']) }}"
                       class="reading-card-button disabled btn-glow w-full md:w-auto py-4 px-12 text-xl font-bold transition-all transform touch-feedback"
                       style="pointer-events: none;">
                        <span id="button-text">⏳ Mulai Kuis (10)</span>
                    </a>

                    <p class="text-gray-300 mt-4 text-sm">
                        Pastikan Anda sudah membaca dan memahami teks di atas sebelum memulai kuis
                    </p>
                </div>
            </div>

            <!-- Reading Tips Section -->
            <div class="mt-12" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="300">
                <div class="bg-gradient-to-r from-purple-500/20 to-pink-500/20 backdrop-blur-sm rounded-2xl p-6 border border-white/20">
                    <div class="flex items-center justify-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-yellow-400 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <h3 class="text-xl font-bold text-white">Tips Membaca Efektif</h3>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-left">
                        <div class="flex items-start">
                            <div class="w-8 h-8 rounded-full bg-purple-500/30 flex items-center justify-center mr-3 mt-1 flex-shrink-0">
                                <span class="text-white font-bold text-sm">1</span>
                            </div>
                            <p class="text-gray-300">Baca dengan tempo yang nyaman, jangan terburu-buru</p>
                        </div>
                        <div class="flex items-start">
                            <div class="w-8 h-8 rounded-full bg-purple-500/30 flex items-center justify-center mr-3 mt-1 flex-shrink-0">
                                <span class="text-white font-bold text-sm">2</span>
                            </div>
                            <p class="text-gray-300">Perhatikan karakter, setting, dan alur cerita</p>
                        </div>
                        <div class="flex items-start">
                            <div class="w-8 h-8 rounded-full bg-purple-500/30 flex items-center justify-center mr-3 mt-1 flex-shrink-0">
                                <span class="text-white font-bold text-sm">3</span>
                            </div>
                            <p class="text-gray-300">Catat poin-poin penting jika diperlukan</p>
                        </div>
                        <div class="flex items-start">
                            <div class="w-8 h-8 rounded-full bg-purple-500/30 flex items-center justify-center mr-3 mt-1 flex-shrink-0">
                                <span class="text-white font-bold text-sm">4</span>
                            </div>
                            <p class="text-gray-300">Pahami konteks sebelum menjawab kuis</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Script untuk AOS (Animate On Scroll) -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // Inisialisasi AOS
        AOS.init({
            duration: 1000,
            once: true,
            offset: 100
        });

        // Countdown Timer
        document.addEventListener('DOMContentLoaded', function() {
            let timeLeft = 10; // Waktu countdown dalam detik
            const quizButton = document.getElementById('quiz-button');
            const countdownContainer = document.getElementById('countdown-container');
            const countdownNumber = document.getElementById('countdown-number');
            const buttonText = document.getElementById('button-text');
            const progressFill = document.getElementById('progress-fill');

            const timer = setInterval(function() {
                timeLeft--;

                // Update teks countdown
                countdownNumber.textContent = timeLeft;
                buttonText.textContent = `⏳ Mulai Kuis (${timeLeft})`;

                // Update progress bar
                const progressPercentage = 100 - (timeLeft / 10 * 100);
                progressFill.style.width = `${progressPercentage}%`;

                if (timeLeft <= 0) {
                    clearInterval(timer);

                    // Aktifkan tombol
                    quizButton.innerHTML = '🚀 Mulai Kuis "Melengkapi Kata"';
                    quizButton.classList.remove('disabled');
                    quizButton.style.pointerEvents = 'auto';
                    quizButton.classList.add('hover:scale-105');

                    // Ubah style countdown container
                    countdownContainer.innerHTML = `
                        <div class="bg-green-500/20 border border-green-500/30 rounded-xl p-4">
                            <p class="text-lg text-green-400 mb-3 font-semibold">
                                ✅ Siap! Anda bisa memulai kuis sekarang
                            </p>
                            <div class="flex items-center justify-center space-x-2">
                                <span class="text-green-400">Selamat mengerjakan!</span>
                            </div>
                        </div>
                    `;
                }
            }, 1000); // Jalankan setiap 1 detik
        });

        // Reading Progress Tracking
        document.addEventListener('DOMContentLoaded', function() {
            const textContent = document.getElementById('reading-content');
            const progressBar = document.getElementById('reading-progress');
            const completionCheck = document.getElementById('completion-check');

            function updateProgress() {
                const scrollTop = textContent.scrollTop;
                const scrollHeight = textContent.scrollHeight - textContent.clientHeight;
                const scrollPercentage = (scrollTop / scrollHeight) * 100;

                // Update progress bar
                progressBar.style.width = `${scrollPercentage}%`;

                // Show completion check when scrolled to bottom
                if (scrollPercentage >= 95) {
                    completionCheck.classList.remove('hidden');
                    completionCheck.classList.add('flex');
                }
            }

            // Add scroll event listener
            textContent.addEventListener('scroll', updateProgress);

            // Initial progress update
            updateProgress();
        });

        // Text Size Controls
        function changeTextSize(delta) {
            const textContent = document.getElementById('reading-content');
            const currentSize = parseFloat(getComputedStyle(textContent).fontSize);
            const newSize = currentSize + (delta * 2);

            // Limit text size between 14px and 24px
            if (newSize >= 14 && newSize <= 24) {
                textContent.style.fontSize = `${newSize}px`;
            }
        }

        // Calculate reading time
        document.addEventListener('DOMContentLoaded', function() {
            const textContent = document.getElementById('reading-content');
            const wordCount = textContent.textContent.split(/\s+/).length;
            const readingTime = Math.ceil(wordCount / 200); // Average reading speed: 200 words per minute

            document.getElementById('reading-time').textContent = `${readingTime} min`;
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

        // Auto-scroll to top when page loads
        document.addEventListener('DOMContentLoaded', function() {
            window.scrollTo(0, 0);
        });
    </script>
</body>
</html>
