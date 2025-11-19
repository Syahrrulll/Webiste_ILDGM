<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kuis Melengkapi Kata - Literise</title>

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

        /* Animasi untuk quiz-card */
        .quiz-card {
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

        .quiz-card::before {
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

        .quiz-card::after {
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

        .quiz-card:hover::after {
            opacity: 0.6;
        }

        .quiz-card:hover {
            transform: translateY(-8px);
            box-shadow:
                0 30px 60px rgba(124, 58, 234, 0.25),
                inset 0 1px 0 rgba(255, 255, 255, 0.3);
        }

        .quiz-card-content {
            position: relative;
            z-index: 2;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .quiz-card-button {
            margin-top: auto;
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

        .quiz-card-button:hover:not(:disabled) {
            transform: scale(1.05);
            box-shadow: 0 12px 35px -3px rgba(116, 67, 255, 0.7);
            background: linear-gradient(135deg, #8c52ff 0%, #7443ff 100%);
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

        .floating {
            animation: float 6s ease-in-out infinite;
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

        /* Style untuk input kata yang hilang */
        .blank-input {
            border: 2px solid #7443ff;
            border-radius: 12px;
            padding: 12px 16px;
            font-weight: 600;
            font-family: 'Poppins', sans-serif;
            color: #4a2e7c;
            width: 160px;
            text-align: center;
            display: inline-block;
            vertical-align: middle;
            background: rgba(255, 255, 255, 0.95);
            transition: all 0.3s ease;
            margin: 0 6px;
            font-size: 1rem;
            box-shadow: 0 4px 15px -3px rgba(116, 67, 255, 0.2);
        }

        .blank-input:focus {
            outline: none;
            border-color: #d3a2ff;
            box-shadow: 0 0 0 3px rgba(116, 67, 255, 0.3);
            background: white;
            transform: translateY(-2px);
        }

        .blank-input::placeholder {
            color: #a78bfa;
            font-weight: 500;
        }

        .reading-text {
            line-height: 1.8;
            color: #4a2e7c;
            font-size: 1.125rem;
        }

        .reading-text p {
            margin-bottom: 1.5rem;
        }

        /* Animasi Loading */
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

        /* Animasi untuk feedback */
        @keyframes correct-answer {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        .correct-animation {
            animation: correct-answer 0.5s ease;
        }

        /* Mobile touch feedback */
        .touch-feedback:active {
            transform: scale(0.98);
            transition: transform 0.1s ease;
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
            .quiz-card {
                padding: 2rem 1.5rem;
            }
            .blank-input {
                width: 140px;
                padding: 10px 12px;
            }
            .floating-element {
                display: none;
            }
            .mobile-mission-section {
                padding-top: 6rem;
                padding-bottom: 3rem;
            }
            .mobile-quiz-header {
                flex-direction: column;
                gap: 1rem;
                text-align: center;
            }
            .mobile-input-grid {
                display: grid;
                grid-template-columns: 1fr;
                gap: 1rem;
            }
        }

        @media (max-width: 640px) {
            .literise-title { font-size: 3rem; }
            .quiz-card { padding: 1.5rem 1rem; }
            .blank-input { width: 120px; padding: 8px 10px; font-size: 0.9rem; }
            .reading-text { font-size: 1rem; }
            .mobile-mission-section {
                padding-top: 5rem;
                padding-bottom: 2rem;
            }
        }

        @media (max-width: 480px) {
            .literise-title { font-size: 2.5rem; }
            .blank-input { width: 100px; padding: 6px 8px; }
        }

        /* Mobile-specific improvements */
        .mobile-mission-section {
            padding-top: 8rem;
            padding-bottom: 4rem;
        }

        .mobile-quiz-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .mobile-input-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        /* Animasi untuk hint */
        .hint-bubble {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 16px;
            padding: 1rem;
            margin-bottom: 1.5rem;
            position: relative;
        }

        .hint-bubble::before {
            content: '';
            position: absolute;
            top: -10px;
            left: 20px;
            width: 0;
            height: 0;
            border-left: 10px solid transparent;
            border-right: 10px solid transparent;
            border-bottom: 10px solid rgba(255, 255, 255, 0.1);
        }

        /* Animasi untuk score display */
        @keyframes score-pop {
            0% { transform: scale(0.8); opacity: 0; }
            70% { transform: scale(1.1); }
            100% { transform: scale(1); opacity: 1; }
        }

        .score-pop {
            animation: score-pop 0.5s ease-out;
        }
    </style>
</head>
<audio id="missionAudio" autoplay>
    <source src="{{ asset('audio/mulai.mp3') }}" type="audio/mpeg">
</audio>
<body class="min-h-screen overflow-x-hidden">

    <!-- Background Pattern -->
    <div class="bg-pattern"></div>

    <!-- Floating Elements -->
    <div class="floating-element floating w-64 h-64 top-10 left-10 opacity-40"></div>
    <div class="floating-element floating w-48 h-48 bottom-20 right-20 opacity-30"></div>
    <div class="floating-element floating w-56 h-56 top-1/3 right-1/4 opacity-25"></div>

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
    <main class="relative z-20 mobile-mission-section flex flex-col items-center justify-center min-h-screen px-4">

        <!-- Konten Utama -->
        <div class="w-full max-w-5xl text-center relative z-10">
            <h1 class="literise-title gentle-pulse mb-6" data-aos="fade-down" data-aos-duration="1000">LITERISE</h1>



            <!-- Hint Section -->
            <div class="hint-bubble mb-6" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="150">
                <div class="flex items-start">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-400 mr-3 mt-1 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z" />
                    </svg>
                    <div class="text-left">
                        <h4 class="text-white font-semibold mb-1">Tips Mengerjakan:</h4>
                        <p class="text-gray-300 text-sm">Baca teks dengan seksama dan perhatikan konteks kalimat untuk menemukan kata yang tepat!</p>
                    </div>
                </div>
            </div>

            <div class="quiz-card max-w-4xl mx-auto" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
                <div class="quiz-card-content">
                    <div class="w-24 h-24 mx-auto mb-8 rounded-full bg-gradient-to-br from-[#7443ff] to-[#d3a2ff] flex items-center justify-center shadow-lg icon-float">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>

                    <h2 class="text-4xl font-bold text-white mb-6">🎯 Kuis: Melengkapi Kata</h2>

                    <form action="{{ route('library.submit_quiz', $quiz['game_id']) }}" method="POST" id="quiz-form">
                        @csrf

                        <!-- Countdown Timer -->
                        <div class="countdown-container" id="countdown-container">
                            <p class="text-lg text-white mb-3 font-semibold">
                                ⏳ Tunggu sebentar sebelum mengirim jawaban...
                            </p>
                            <div class="flex items-center justify-center space-x-2">
                                <span class="text-white">Tombol kirim aktif dalam</span>
                                <span class="countdown-number" id="countdown-number">5</span>
                                <span class="text-white">detik</span>
                            </div>
                            <div class="progress-bar mt-4">
                                <div class="progress-fill" id="progress-fill" style="width: 0%"></div>
                            </div>
                        </div>

                        <!-- Teks Kuis (dengan kata hilang) -->
                        <div class="mb-10 text-left">
                            <h3 class="text-2xl font-semibold text-white mb-6 text-center">Lengkapi kata yang hilang:</h3>
                            <div class="bg-white/90 p-8 rounded-2xl shadow-inner reading-text border border-white/30 backdrop-blur-sm">

                                {{-- Logika untuk mengganti [.....] dengan input --}}
                                @php
                                    $textWithInputs = $quiz['text_with_blanks'];
                                    $inputIndex = 0;
                                    // Ganti setiap [.....] dengan input field
                                    while (str_contains($textWithInputs, '[.....]')) {
                                        $inputField = '<input type="text" name="answers['.$inputIndex.']" class="blank-input touch-feedback" required placeholder="Kata '.($inputIndex + 1).'">';
                                        // Gunakan Str::replaceFirst untuk mengganti satu per satu
                                        $textWithInputs = \Illuminate\Support\Str::replaceFirst('[.....]', $inputField, $textWithInputs);
                                        $inputIndex++;
                                    }
                                @endphp

                                <!-- PERBAIKAN DI SINI: Menghapus 'e()' -->
                                <p>{!! nl2br($textWithInputs) !!}</p>

                            </div>
                        </div>

                        <!-- Tombol Submit -->
                        <div class="border-t border-white/20 pt-8 text-center">
                            <button id="submit-button"
                                    type="submit"
                                    class="quiz-card-button loading-button w-full md:w-auto py-4 px-12 text-xl font-bold transition-all transform
                                           opacity-50 cursor-not-allowed btn-glow touch-feedback"
                                    style="pointer-events: none;"
                                    disabled>
                                <span id="button-text">⏳ Kirim Jawaban (5)</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Motivational Section untuk Mobile -->
            <div class="mt-12" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="300">
                <div class="bg-gradient-to-r from-purple-500/20 to-pink-500/20 backdrop-blur-sm rounded-2xl p-6 border border-white/20">
                    <div class="flex items-center justify-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-yellow-400 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                        <h3 class="text-xl font-bold text-white">Tips Sukses Mengerjakan Kuis</h3>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-left">
                        <div class="flex items-start">
                            <div class="w-8 h-8 rounded-full bg-purple-500/30 flex items-center justify-center mr-3 mt-1 flex-shrink-0">
                                <span class="text-white font-bold text-sm">1</span>
                            </div>
                            <p class="text-gray-300">Baca seluruh teks terlebih dahulu untuk memahami konteks</p>
                        </div>
                        <div class="flex items-start">
                            <div class="w-8 h-8 rounded-full bg-purple-500/30 flex items-center justify-center mr-3 mt-1 flex-shrink-0">
                                <span class="text-white font-bold text-sm">2</span>
                            </div>
                            <p class="text-gray-300">Perhatikan kata sebelum dan sesudah bagian yang kosong</p>
                        </div>
                        <div class="flex items-start">
                            <div class="w-8 h-8 rounded-full bg-purple-500/30 flex items-center justify-center mr-3 mt-1 flex-shrink-0">
                                <span class="text-white font-bold text-sm">3</span>
                            </div>
                            <p class="text-gray-300">Gunakan kata yang sesuai dengan tema dan genre cerita</p>
                        </div>
                        <div class="flex items-start">
                            <div class="w-8 h-8 rounded-full bg-purple-500/30 flex items-center justify-center mr-3 mt-1 flex-shrink-0">
                                <span class="text-white font-bold text-sm">4</span>
                            </div>
                            <p class="text-gray-300">Periksa ejaan dan tata bahasa sebelum mengirim</p>
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
            let timeLeft = 5; // Waktu countdown dalam detik
            const submitButton = document.getElementById('submit-button');
            const countdownContainer = document.getElementById('countdown-container');
            const countdownNumber = document.getElementById('countdown-number');
            const buttonText = document.getElementById('button-text');
            const progressFill = document.getElementById('progress-fill');

            const timer = setInterval(function() {
                timeLeft--;

                // Update teks countdown
                countdownNumber.textContent = timeLeft;
                buttonText.textContent = `⏳ Kirim Jawaban (${timeLeft})`;

                // Update progress bar
                const progressPercentage = 100 - (timeLeft / 5 * 100);
                progressFill.style.width = `${progressPercentage}%`;

                if (timeLeft <= 0) {
                    clearInterval(timer);

                    // Aktifkan tombol
                    submitButton.innerHTML = '🚀 Kirim Jawaban Sekarang!';
                    submitButton.classList.remove('opacity-50', 'cursor-not-allowed');
                    submitButton.style.pointerEvents = 'auto';
                    submitButton.disabled = false;
                    submitButton.classList.add('hover:scale-105');

                    // Ubah style countdown container
                    countdownContainer.innerHTML = `
                        <div class="bg-green-500/20 border border-green-500/30 rounded-xl p-4">
                            <p class="text-lg text-green-400 mb-3 font-semibold">
                                ✅ Siap! Anda bisa mengirim jawaban sekarang
                            </p>
                            <div class="flex items-center justify-center space-x-2">
                                <span class="text-green-400">Silakan periksa kembali jawaban Anda</span>
                            </div>
                        </div>
                    `;

                    // Auto-focus pada input pertama
                    const firstInput = document.querySelector('.blank-input');
                    if (firstInput) {
                        firstInput.focus();
                    }
                }
            }, 1000); // Jalankan setiap 1 detik
        });

        // Animasi Loading untuk tombol
        document.getElementById('quiz-form').addEventListener('submit', function(e) {
            const submitButton = document.getElementById('submit-button');
            const originalText = submitButton.innerHTML;

            // Tampilkan loading state
            submitButton.innerHTML = '<span class="loading-spinner"></span>Memproses Jawaban...';
            submitButton.style.pointerEvents = 'none';
            submitButton.classList.add('opacity-50');
        });

        // Validasi input real-time
        document.addEventListener('DOMContentLoaded', function() {
            const inputs = document.querySelectorAll('.blank-input');

            inputs.forEach(input => {
                input.addEventListener('input', function() {
                    if (this.value.trim() !== '') {
                        this.classList.add('correct-animation');
                        setTimeout(() => {
                            this.classList.remove('correct-animation');
                        }, 500);
                    }
                });
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

        // Keyboard navigation untuk mobile
        document.addEventListener('DOMContentLoaded', function() {
            const inputs = document.querySelectorAll('.blank-input');

            inputs.forEach((input, index) => {
                input.addEventListener('keydown', function(e) {
                    if (e.key === 'Enter') {
                        e.preventDefault();
                        const nextInput = inputs[index + 1];
                        if (nextInput) {
                            nextInput.focus();
                        } else {
                            // Jika di input terakhir, fokus ke tombol submit
                            const submitButton = document.getElementById('submit-button');
                            if (!submitButton.disabled) {
                                submitButton.focus();
                            }
                        }
                    }
                });
            });
        });
    </script>
</body>
</html>
