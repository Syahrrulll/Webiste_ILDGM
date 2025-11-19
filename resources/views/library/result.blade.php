<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Kuis Library - Literise</title>

    <!-- Memuat Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Memuat Google Fonts (Poppins) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet">

    <!-- AOS Library untuk animasi scroll -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- Particle.js Library -->
    <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>

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

        .result-card-button {
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

        .result-card-button:hover {
            transform: scale(1.05);
            box-shadow: 0 12px 35px -3px rgba(116, 67, 255, 0.7);
            background: linear-gradient(135deg, #8c52ff 0%, #7443ff 100%);
        }

        .result-card-button-outline {
            background: transparent;
            border: 2px solid #7443ff;
            color: #7443ff;
        }

        .result-card-button-outline:hover {
            background: #7443ff;
            color: white;
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

        /* Score styling */
        .score-container {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.15), rgba(255, 255, 255, 0.05));
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 20px;
            padding: 2.5rem;
            margin: 2rem 0;
            position: relative;
            overflow: hidden;
        }

        .score-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg,
                rgba(116, 67, 255, 0.1),
                rgba(211, 162, 255, 0.05),
                rgba(116, 67, 255, 0.1));
            z-index: -1;
        }

        /* Answer review styling */
        .answer-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 16px;
            padding: 1.5rem;
            margin-bottom: 1rem;
            border: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 8px 25px -5px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .answer-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 30px -5px rgba(0, 0, 0, 0.15);
        }

        .answer-card.correct {
            border-left: 4px solid #10b981;
        }

        .answer-card.incorrect {
            border-left: 4px solid #ef4444;
        }

        /* Text content styling */
        .text-content {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.3);
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

        /* Score animation */
        @keyframes score-pop {
            0% {
                transform: scale(0.8);
                opacity: 0;
            }
            100% {
                transform: scale(1);
                opacity: 1;
            }
        }

        .score-pop {
            animation: score-pop 0.6s ease-out;
        }

        /* Particle container */
        #particles-js {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
        }

        /* Mobile-specific improvements */
        .mobile-glow {
            position: relative;
            overflow: hidden;
        }

        .mobile-glow::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.3) 0%, rgba(255,255,255,0) 70%);
            opacity: 0;
            transition: opacity 0.3s;
        }

        .mobile-glow:active::after {
            opacity: 1;
        }

        /* Achievement badges */
        .achievement-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #ffd700, #ffed4e);
            border-radius: 50%;
            width: 80px;
            height: 80px;
            box-shadow: 0 8px 20px rgba(255, 215, 0, 0.4);
            margin: 0 auto 1rem;
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-10px);
            }
        }

        /* Progress bar */
        .progress-container {
            width: 100%;
            height: 12px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            overflow: hidden;
            margin: 1rem 0;
        }

        .progress-bar {
            height: 100%;
            background: linear-gradient(90deg, #7443ff, #d3a2ff);
            border-radius: 10px;
            transition: width 1.5s ease-in-out;
        }

        /* Mobile swipe indicator */
        .swipe-indicator {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            align-items: center;
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.8rem;
            animation: swipe 2s infinite;
        }

        @keyframes swipe {
            0%, 100% {
                opacity: 0.5;
                transform: translateX(-50%) translateY(0);
            }
            50% {
                opacity: 1;
                transform: translateX(-50%) translateY(-5px);
            }
        }

        /* Responsive adjustments */
        @media (max-width: 1024px) {
            .result-card {
                padding: 2.5rem 2rem;
            }
        }

        @media (max-width: 768px) {
            .result-card {
                padding: 2rem 1.5rem;
                margin: 1rem;
            }
            .score-container {
                padding: 2rem 1.5rem;
            }
            .text-content {
                padding: 1.5rem;
            }
            .floating-element {
                display: none;
            }

            /* Mobile-specific particle adjustments */
            #particles-js {
                opacity: 0.7;
            }

            /* Mobile touch improvements */
            .result-card-button {
                padding: 1.2rem 2rem;
                font-size: 1.1rem;
            }

            /* Mobile animations */
            .mobile-slide-up {
                animation: slideUp 0.5s ease-out;
            }

            @keyframes slideUp {
                from {
                    opacity: 0;
                    transform: translateY(30px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
        }

        @media (max-width: 640px) {
            .result-card {
                padding: 1.5rem 1rem;
                border-radius: 20px;
            }
            .score-container {
                padding: 1.5rem 1rem;
                border-radius: 16px;
            }
            .text-content {
                padding: 1rem;
                border-radius: 16px;
            }

            /* Mobile-specific particle adjustments */
            #particles-js {
                opacity: 0.5;
            }

            /* Mobile touch improvements */
            .result-card-button {
                padding: 1rem 1.5rem;
                font-size: 1rem;
                width: 100%;
                margin-bottom: 0.5rem;
            }

            /* Mobile animations */
            .mobile-slide-up {
                animation: slideUp 0.4s ease-out;
            }
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, #7443ff, #d3a2ff);
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(135deg, #8c52ff, #e0b3ff);
        }
    </style>
</head>
<body class="min-h-screen overflow-x-hidden">

    <!-- Particle Background -->
    <div id="particles-js"></div>

    <!-- Background Pattern -->
    <div class="bg-pattern"></div>

    <!-- Floating Elements -->
    <div class="floating-element w-64 h-64 top-10 left-10 opacity-40"></div>
    <div class="floating-element w-48 h-48 bottom-20 right-20 opacity-30"></div>
    <div class="floating-element w-56 h-56 top-1/3 right-1/4 opacity-25"></div>

    <!-- ===== HEADER / NAVIGASI ===== -->
    <nav class="fixed top-0 left-0 right-0 z-50 bg-gradient-to-r from-[#2d1b69] to-[#1f1047] text-white shadow-lg border-b border-purple-500/20">
        <div class="container mx-auto px-4 sm:px-6 py-3 sm:py-4 flex justify-between items-center">

            <a href="{{ route('home') }}" class="flex items-center space-x-2 text-lg sm:text-2xl font-bold transition-transform hover:scale-105">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6 text-pink-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                </svg>
                <span>LITERISE</span>
            </a>

            <a href="{{ route('permainan.index') }}" class="flex items-center space-x-1 sm:space-x-2 bg-white/10 backdrop-blur-sm text-white font-semibold px-3 py-2 sm:px-5 sm:py-2 rounded-full transition-all duration-300 hover:bg-white/20 border border-white/20 btn-glow text-xs sm:text-base group mobile-glow">
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
            <div class="result-card max-w-6xl mx-auto mobile-slide-up" data-aos="fade-up" data-aos-duration="1000">
                <!-- Header -->
                <div class="text-center mb-8">
               
                    <h1 class="text-4xl font-bold text-white mb-4 gentle-pulse">
                        🎯 Hasil Kuis Melengkapi Kata
                    </h1>
                    <p class="text-xl text-gray-300">
                        Lihat performa Anda dalam mengingat teks bacaan
                    </p>
                </div>

                <!-- Skor Total -->
                <div class="score-container text-center score-pop">
                    <p class="text-2xl font-semibold text-white mb-4">Skor Total Anda:</p>
                    <p class="text-7xl font-bold text-white mb-6">{{ $result['total_score'] ?? 0 }}/100</p>

                    <!-- Progress Bar -->
                    <div class="progress-container mx-auto max-w-md">
                        <div class="progress-bar" style="width: {{ $result['total_score'] ?? 0 }}%"></div>
                    </div>

                    @if (($result['total_score'] ?? 0) >= 80)
                        <div class="flex items-center justify-center space-x-2 mt-4">
                            <span class="text-3xl">🎉</span>
                            <p class="text-xl text-green-300 font-semibold">Luar biasa! Ingatan Anda sangat tajam.</p>
                        </div>
                    @elseif (($result['total_score'] ?? 0) >= 60)
                        <div class="flex items-center justify-center space-x-2 mt-4">
                            <span class="text-3xl">👍</span>
                            <p class="text-xl text-blue-300 font-semibold">Bagus! Anda sudah ingat sebagian besar.</p>
                        </div>
                    @else
                        <div class="flex items-center justify-center space-x-2 mt-4">
                            <span class="text-3xl">💪</span>
                            <p class="text-xl text-yellow-300 font-semibold">Perlu sedikit latihan lagi, ayo coba lagi!</p>
                        </div>
                    @endif
                </div>

                <!-- Detail Ulasan Jawaban -->
                <div class="border-t border-white/20 pt-10">
                    <h2 class="text-3xl font-semibold text-white mb-8 text-center">📝 Ulasan Jawaban</h2>

                    <div class="space-y-4">
                        @if (isset($result['results']) && is_array($result['results']))
                            @foreach ($result['results'] as $item)
                                <div class="answer-card {{ $item['is_correct'] ? 'correct' : 'incorrect' }} mobile-slide-up" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                                    <div class="flex items-start space-x-4">
                                        <div class="flex-shrink-0">
                                            @if ($item['is_correct'])
                                                <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                                                    <span class="text-2xl text-green-600">✅</span>
                                                </div>
                                            @else
                                                <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center">
                                                    <span class="text-2xl text-red-600">❌</span>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="flex-grow">
                                            <p class="font-semibold text-gray-700 mb-2">Kata ke-{{ $item['blank_index'] }}</p>
                                            @if ($item['is_correct'])
                                                <p class="text-lg text-green-700">
                                                    Jawaban Anda: <strong class="font-bold bg-green-100 px-2 py-1 rounded">{{ $item['user_answer'] }}</strong>
                                                    <span class="text-green-600 ml-2">✓ Benar</span>
                                                </p>
                                            @else
                                                <div class="space-y-2">
                                                    <p class="text-lg text-red-700">
                                                        Jawaban Anda: <strong class="font-bold bg-red-100 px-2 py-1 rounded line-through">{{ $item['user_answer'] }}</strong>
                                                    </p>
                                                    <p class="text-lg text-green-700">
                                                        Jawaban Benar: <strong class="font-bold bg-green-100 px-2 py-1 rounded">{{ $item['correct_answer'] }}</strong>
                                                    </p>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="text-center py-8">
                                <p class="text-red-400 text-lg">Gagal memuat ulasan hasil.</p>
                            </div>
                        @endif
                    </div>

                    <!-- Tampilkan Teks Asli -->
                    <div class="mt-12 border-t border-white/20 pt-10">
                         <h2 class="text-3xl font-semibold text-white mb-6 text-center">📖 Teks Asli (untuk Review)</h2>
                         <div class="text-content prose prose-lg max-w-none">
                             <p>{!! nl2br(e($result['full_text'] ?? 'Teks asli tidak tersedia.')) !!}</p>
                         </div>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="mt-12 pt-8 border-t border-white/20 flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="{{ route('library.index') }}"
                           class="result-card-button btn-glow mobile-glow py-4 px-8 text-lg font-bold">
                            🎮 Coba Game Lain
                        </a>

                        <a href="{{ route('permainan.index') }}"
                           class="result-card-button result-card-button-outline btn-glow mobile-glow py-4 px-8 text-lg font-bold">
                            📚 Kembali ke Halaman Permainan
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mobile Swipe Indicator -->
        <div class="swipe-indicator md:hidden">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4" />
            </svg>
            Geser untuk melihat lebih banyak
        </div>
    </main>

    <!-- Script untuk AOS (Animate On Scroll) -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // Inisialisasi AOS
        AOS.init({
            duration: 800,
            once: true,
            offset: 100
        });

        // Inisialisasi Particles.js
        document.addEventListener('DOMContentLoaded', function() {
            // Setup particles
            particlesJS('particles-js', {
                particles: {
                    number: {
                        value: window.innerWidth < 768 ? 30 : 80,
                        density: {
                            enable: true,
                            value_area: 800
                        }
                    },
                    color: {
                        value: ["#7443ff", "#d3a2ff", "#8c52ff"]
                    },
                    shape: {
                        type: "circle",
                        stroke: {
                            width: 0,
                            color: "#000000"
                        }
                    },
                    opacity: {
                        value: 0.5,
                        random: true,
                        anim: {
                            enable: true,
                            speed: 1,
                            opacity_min: 0.1,
                            sync: false
                        }
                    },
                    size: {
                        value: 3,
                        random: true,
                        anim: {
                            enable: true,
                            speed: 2,
                            size_min: 0.1,
                            sync: false
                        }
                    },
                    line_linked: {
                        enable: true,
                        distance: 150,
                        color: "#7443ff",
                        opacity: 0.2,
                        width: 1
                    },
                    move: {
                        enable: true,
                        speed: window.innerWidth < 768 ? 1 : 2,
                        direction: "none",
                        random: true,
                        straight: false,
                        out_mode: "out",
                        bounce: false,
                        attract: {
                            enable: false,
                            rotateX: 600,
                            rotateY: 1200
                        }
                    }
                },
                interactivity: {
                    detect_on: "canvas",
                    events: {
                        onhover: {
                            enable: true,
                            mode: "grab"
                        },
                        onclick: {
                            enable: true,
                            mode: "push"
                        },
                        resize: true
                    },
                    modes: {
                        grab: {
                            distance: 140,
                            line_linked: {
                                opacity: 0.5
                            }
                        },
                        push: {
                            particles_nb: 4
                        }
                    }
                },
                retina_detect: true
            });

            // Animasi tambahan untuk skor
            const scoreElement = document.querySelector('.score-pop');
            if (scoreElement) {
                // Trigger reflow untuk memastikan animasi berjalan
                void scoreElement.offsetWidth;
            }

            // Confetti effect untuk skor tinggi
            const score = {{ $result['total_score'] ?? 0 }};
            if (score >= 80) {
                // Tambahkan efek visual untuk skor tinggi
                const scoreContainer = document.querySelector('.score-container');
                if (scoreContainer) {
                    scoreContainer.classList.add('ring-4', 'ring-green-500', 'ring-opacity-50');

                    // Tambahkan efek partikel tambahan untuk skor tinggi
                    setTimeout(() => {
                        particlesJS('particles-js', {
                            particles: {
                                number: {
                                    value: window.innerWidth < 768 ? 50 : 120,
                                    density: {
                                        enable: true,
                                        value_area: 800
                                    }
                                },
                                color: {
                                    value: ["#7443ff", "#d3a2ff", "#8c52ff", "#10b981"]
                                },
                                shape: {
                                    type: "circle",
                                    stroke: {
                                        width: 0,
                                        color: "#000000"
                                    }
                                },
                                opacity: {
                                    value: 0.7,
                                    random: true,
                                    anim: {
                                        enable: true,
                                        speed: 1,
                                        opacity_min: 0.1,
                                        sync: false
                                    }
                                },
                                size: {
                                    value: 4,
                                    random: true,
                                    anim: {
                                        enable: true,
                                        speed: 3,
                                        size_min: 0.1,
                                        sync: false
                                    }
                                },
                                line_linked: {
                                    enable: true,
                                    distance: 150,
                                    color: "#7443ff",
                                    opacity: 0.3,
                                    width: 1
                                },
                                move: {
                                    enable: true,
                                    speed: window.innerWidth < 768 ? 2 : 3,
                                    direction: "none",
                                    random: true,
                                    straight: false,
                                    out_mode: "out",
                                    bounce: false,
                                    attract: {
                                        enable: false,
                                        rotateX: 600,
                                        rotateY: 1200
                                    }
                                }
                            },
                            interactivity: {
                                detect_on: "canvas",
                                events: {
                                    onhover: {
                                        enable: true,
                                        mode: "grab"
                                    },
                                    onclick: {
                                        enable: true,
                                        mode: "push"
                                    },
                                    resize: true
                                },
                                modes: {
                                    grab: {
                                        distance: 140,
                                        line_linked: {
                                            opacity: 0.5
                                        }
                                    },
                                    push: {
                                        particles_nb: 4
                                    }
                                }
                            },
                            retina_detect: true
                        });
                    }, 1000);
                }
            }

            // Animasi progress bar
            const progressBar = document.querySelector('.progress-bar');
            if (progressBar) {
                // Reset width untuk memicu animasi
                const width = progressBar.style.width;
                progressBar.style.width = '0';
                setTimeout(() => {
                    progressBar.style.width = width;
                }, 500);
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

        // Mobile-specific touch improvements
        document.addEventListener('touchstart', function() {
            // Menambahkan class untuk meningkatkan responsivitas pada mobile
            document.body.classList.add('touch-device');
        });

        // Handle orientation change for particles
        window.addEventListener('orientationchange', function() {
            setTimeout(function() {
                if (window.pJSDom && window.pJSDom[0] && window.pJSDom[0].pJS) {
                    window.pJSDom[0].pJS.fn.canvasPaint();
                    window.pJSDom[0].pJS.fn.particlesRefresh();
                }
            }, 500);
        });
    </script>

    <!-- Notifikasi Error (jika ada) -->
    @if (session('error'))
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded">
            <p class="font-bold">⚠️ Terjadi Kesalahan!</p>
            <p>{{ session('error') }}</p>
            <p class="text-sm mt-2 text-red-600">
                💡 Tips: Jika server AI sedang sibuk, coba lagi dalam 1-2 menit.
            </p>
        </div>
    @endif
</body>
</html>
