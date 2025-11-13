<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Baca: {{ $game_data['title'] }} - Literise</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- Tambahkan CSS untuk styling teks bacaan -->
    <link href="https://cdn.jsdelivr.net/npm/@tailwindcss/typography@0.5.x/dist/typography.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f7f9; /* Latar belakang netral */
        }
        .reading-text p {
            margin-bottom: 1.25rem;
        }
    </style>
</head>
<body class="min-h-screen">

    <!-- Header Sederhana -->
    <nav class="bg-gradient-to-r from-[#906AF1] to-[#5438DB] text-white shadow-lg">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <a href="{{ route('home') }}" class="text-2xl font-bold">LITERISE</a>
            <a href="{{ route('library.index') }}" class="font-semibold hover:text-pink-300 transition-colors">
                &larr; Kembali ke Pilihan Genre
            </a>
        </div>
    </nav>

    <!-- Konten Misi -->
    <div class="container mx-auto max-w-4xl p-6 my-10">
        <div class="bg-white rounded-2xl shadow-xl p-8 md:p-12">

            <h1 class="text-3xl md:text-4xl font-bold text-[#4a2e7c] mb-6">
                Bacaan: {{ $game_data['title'] }}
            </h1>

            <!-- 1. Teks Bacaan Lengkap -->
            <div class="mb-10">
                <h2 class="text-2xl font-semibold text-gray-700 mb-4">Silakan Baca Teks Berikut:</h2>
                <div class="prose prose-lg max-w-none text-gray-800 bg-gray-50 p-6 rounded-lg shadow-inner reading-text">
                    
                    {!! $game_data['full_text'] ?? 'Teks bacaan tidak tersedia.' !!}
                </div>
            </div>

            <!-- 2. Tombol Mulai Kuis -->
            <div class="border-t pt-10 text-center">
                <p class="text-lg text-gray-700 mb-6">Sudah selesai membaca? Uji ingatan Anda sekarang!</p>

                <a href="{{ route('library.show_quiz', $game_data['game_id']) }}"
                   class="w-full md:w-auto inline-block text-center py-3 px-8 border border-transparent rounded-lg shadow-lg text-xl font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-all transform hover:scale-105">
                    Mulai Kuis "Melengkapi Kata"
                </a>
            </div>

        </div>
    </div>
</body>
</html>
