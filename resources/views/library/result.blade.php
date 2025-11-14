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

        /* Responsive adjustments */
        @media (max-width: 1024px) {
            .result-card {
                padding: 2.5rem 2rem;
            }
        }

        @media (max-width: 768px) {
            .result-card {
                padding: 2rem 1.5rem;
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
        }

        @media (max-width: 640px) {
            .result-card {
                padding: 1.5rem 1rem;
            }
            .score-container {
                padding: 1.5rem 1rem;
            }
            .text-content {
                padding: 1rem;
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
                <span>Coba Game Lain</span>
            </a>
        </div>
    </nav>

    <!-- ===== MAIN CONTENT ===== -->
    <main class="relative z-20 pt-32 pb-20 flex flex-col items-center justify-center min-h-screen px-4">

        <!-- Konten Utama -->
        <div class="w-full max-w-6xl text-center relative z-10">
            <div class="result-card max-w-6xl mx-auto" data-aos="fade-up" data-aos-duration="1000">
                <!-- Header -->
                <div class="text-center mb-8">
                    <div class="w-20 h-20 mx-auto mb-6 rounded-full bg-gradient-to-br from-[#7443ff] to-[#d3a2ff] flex items-center justify-center shadow-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>

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

                    @if (($result['total_score'] ?? 0) >= 80)
                        <div class="flex items-center justify-center space-x-2">
                            <span class="text-3xl">🎉</span>
                            <p class="text-xl text-green-300 font-semibold">Luar biasa! Ingatan Anda sangat tajam.</p>
                        </div>
                    @elseif (($result['total_score'] ?? 0) >= 60)
                        <div class="flex items-center justify-center space-x-2">
                            <span class="text-3xl">👍</span>
                            <p class="text-xl text-blue-300 font-semibold">Bagus! Anda sudah ingat sebagian besar.</p>
                        </div>
                    @else
                        <div class="flex items-center justify-center space-x-2">
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
                                <div class="answer-card {{ $item['is_correct'] ? 'correct' : 'incorrect' }}" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
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
                           class="result-card-button btn-glow py-4 px-8 text-lg font-bold">
                            🎮 Coba Game Lain
                        </a>

                        <a href="{{ route('permainan.index') }}"
                           class="result-card-button result-card-button-outline btn-glow py-4 px-8 text-lg font-bold">
                            📚 Kembali ke Halaman Permainan
                        </a>
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
            duration: 800,
            once: true,
            offset: 100
        });

        // Animasi tambahan untuk skor
        document.addEventListener('DOMContentLoaded', function() {
            const scoreElement = document.querySelector('.score-pop');
            if (scoreElement) {
                // Trigger reflow untuk memastikan animasi berjalan
                void scoreElement.offsetWidth;
            }
        });

        // Confetti effect untuk skor tinggi
        document.addEventListener('DOMContentLoaded', function() {
            const score = {{ $result['total_score'] ?? 0 }};
            if (score >= 80) {
                // Tambahkan efek visual untuk skor tinggi
                const scoreContainer = document.querySelector('.score-container');
                if (scoreContainer) {
                    scoreContainer.classList.add('ring-4', 'ring-green-500', 'ring-opacity-50');
                }
            }
        });
    </script>
</body>
</html>
