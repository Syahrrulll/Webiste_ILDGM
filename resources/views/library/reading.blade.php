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

        /* Floating elements */
        .floating-element {
            position: absolute;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(116, 67, 255, 0.15), transparent 70%);
            filter: blur(20px);
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
        }

        @media (max-width: 640px) {
            .reading-card {
                padding: 1.5rem 1rem;
            }
            .text-content {
                padding: 1.5rem 1rem;
            }
        }
    </style>
</head>
<body class="min-h-screen overflow-x-hidden">

    <!-- Background Pattern -->
    <div class="bg-pattern"></div>

    <!-- Floating Elements -->
    <div class="floating-element w-64 h-64 top-10 left-10 opacity-40"></div>
    <div class="floating-element w-48 h-48 bottom-20 right-20 opacity-30"></div>
    <div class="floating-element w-56 h-56 top-1/3 right-1/4 opacity-25"></div>

    <!-- ===== HEADER / NAVIGASI ===== -->
    <nav class="fixed top-0 left-0 right-0 z-50 bg-gradient-to-r from-[#2d1b69] to-[#1f1047] text-white shadow-lg border-b border-purple-500/20">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <a href="{{ route('home') }}" class="flex items-center space-x-2 text-2xl font-bold">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-pink-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                </svg>
                <span>LITERISE</span>
            </a>

            <a href="{{ route('library.index') }}" class="flex items-center space-x-2 bg-white/10 backdrop-blur-sm text-white font-semibold px-5 py-2 rounded-full transition-all duration-300 hover:bg-white/20 border border-white/20 btn-glow">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                <span>Kembali ke Library</span>
            </a>
        </div>
    </nav>

    <!-- ===== MAIN CONTENT ===== -->
    <main class="relative z-20 pt-32 pb-20 flex flex-col items-center justify-center min-h-screen px-4">

        <!-- Konten Utama -->
        <div class="w-full max-w-6xl text-center relative z-10">
            <div class="reading-card max-w-6xl mx-auto" data-aos="fade-up" data-aos-duration="1000">
                <div class="text-center mb-10">
                    <div class="w-20 h-20 mx-auto mb-6 rounded-full bg-gradient-to-br from-[#7443ff] to-[#d3a2ff] flex items-center justify-center shadow-lg">
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
                </div>

                <!-- 1. Teks Bacaan Lengkap -->
                <div class="mb-10 text-left">
                    <h2 class="text-2xl font-semibold text-white mb-6 text-center">📚 Silakan Baca Teks Berikut:</h2>
                    <div class="text-content reading-text prose prose-lg max-w-none">

                        {!! $game_data['full_text'] ?? 'Teks bacaan tidak tersedia.' !!}
                    </div>
                </div>

                <!-- 2. Tombol Mulai Kuis -->
                <div class="border-t border-white/20 pt-8 text-center">
                    <a id="quiz-button"
                       href="{{ route('library.show_quiz', $game_data['game_id']) }}"
                       class="reading-card-button disabled btn-glow w-full md:w-auto py-4 px-12 text-xl font-bold transition-all transform"
                       style="pointer-events: none;">
                        <span id="button-text">⏳ Mulai Kuis (10)</span>
                    </a>

                    <p class="text-gray-300 mt-4 text-sm">
                        Pastikan Anda sudah membaca dan memahami teks di atas sebelum memulai kuis
                    </p>
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

            const timer = setInterval(function() {
                timeLeft--;

                // Update teks countdown
                countdownNumber.textContent = timeLeft;
                buttonText.textContent = `⏳ Mulai Kuis (${timeLeft})`;

                if (timeLeft <= 0) {
                    clearInterval(timer);

                    // Aktifkan tombol
                    quizButton.innerHTML = '🚀 Mulai Kuis "Melengkapi Kata"';
                    quizButton.classList.remove('disabled');
                    quizButton.style.pointerEvents = 'auto';
                    quizButton.classList.add('hover:scale-105');

                    // Ubah style countdown container
                    countdownContainer.innerHTML = `
                        <p class="text-lg text-green-400 mb-3 font-semibold">
                            ✅ Siap! Anda bisa memulai kuis sekarang
                        </p>
                        <div class="flex items-center justify-center space-x-2">
                            <span class="text-green-400">Selamat mengerjakan!</span>
                        </div>
                    `;
                }
            }, 1000); // Jalankan setiap 1 detik
        });

        // Progress reading indicator (opsional)
        document.addEventListener('DOMContentLoaded', function() {
            const textContent = document.querySelector('.text-content');
            const quizButton = document.getElementById('quiz-button');

            // Track scroll progress
            textContent.addEventListener('scroll', function() {
                const scrollPercentage = (this.scrollTop / (this.scrollHeight - this.clientHeight)) * 100;

                // Jika user sudah scroll 80% ke bawah, beri feedback
                if (scrollPercentage > 80) {
                    quizButton.classList.add('ring-2', 'ring-green-400');
                }
            });
        });
    </script>
</body>
</html>
