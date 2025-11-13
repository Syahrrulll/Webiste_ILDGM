<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale-1.0">
    <title>Kuis Melengkapi Kata - Literise</title>
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
            line-height: 1.75; /* Tambahkan jarak antar baris */
        }
        /* Style untuk input kata yang hilang */
        .blank-input {
            border: 1px solid #9ca3af;
            border-radius: 6px;
            padding: 2px 6px;
            font-weight: 600;
            font-family: 'Poppins', sans-serif;
            color: #1d4ed8;
            width: 120px; /* Lebar input */
            text-align: center;
            /* Pastikan input sejajar dengan teks */
            display: inline-block;
            vertical-align: baseline;
        }
        .blank-input:focus {
            outline: 2px solid #3b82f6;
            border-color: transparent;
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

    <!-- Konten Kuis -->
    <div class="container mx-auto max-w-4xl p-6 my-10">
        <div class="bg-white rounded-2xl shadow-xl p-8 md:p-12">

            <h1 class="text-3xl md:text-4xl font-bold text-[#4a2e7c] mb-6">
                Kuis: Melengkapi Kata
            </h1>

            <form action="{{ route('library.submit_quiz', $quiz['game_id']) }}" method="POST">
                @csrf

                <!-- 1. Teks Kuis (dengan kata hilang) -->
                <div class="mb-10">
                    <h2 class="text-2xl font-semibold text-gray-700 mb-4">Lengkapi kata yang hilang:</h2>
                    <div class="prose prose-lg max-w-none text-gray-800 bg-gray-50 p-6 rounded-lg shadow-inner reading-text">

                        {{-- Logika untuk mengganti [.....] dengan input --}}
                        @php
                            $textWithInputs = $quiz['text_with_blanks'];
                            $inputIndex = 0;
                            // Ganti setiap [.....] dengan input field
                            while (str_contains($textWithInputs, '[.....]')) {
                                $inputField = '<input type="text" name="answers['.$inputIndex.']" class="blank-input" required>';
                                // Gunakan Str::replaceFirst untuk mengganti satu per satu
                                $textWithInputs = \Illuminate\Support\Str::replaceFirst('[.....]', $inputField, $textWithInputs);
                                $inputIndex++;
                            }
                        @endphp

                        <!-- PERBAIKAN DI SINI: Menghapus 'e()' -->
                        <p>{!! nl2br($textWithInputs) !!}</p>

                    </div>
                </div>

                <!-- 2. Tombol Submit -->
                <div class="border-t pt-10 text-center">
                    <button type="submit"
                       class="w-full md:w-auto inline-block text-center py-3 px-8 border border-transparent rounded-lg shadow-lg text-xl font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-all transform hover:scale-105">
                        Kirim Jawaban
                    </button>
                </div>
            </form>

        </div>
    </div>
</body>
</html>
