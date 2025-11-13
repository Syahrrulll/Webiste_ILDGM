<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Misi: {{ $mission['title'] }} - Literise</title>
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
            <a href="{{ route('game.play') }}" class="font-semibold hover:text-pink-300 transition-colors">
                &larr; Kembali ke Pilihan Misi
            </a>
        </div>
    </nav>

    <!-- Konten Misi -->
    <div class="container mx-auto max-w-4xl p-6 my-10">
        <div class="bg-white rounded-2xl shadow-xl p-8 md:p-12">

            <h1 class="text-3xl md:text-4xl font-bold text-[#4a2e7c] mb-6">
                Misi: {{ $mission['title'] }}
            </h1>

            <!-- 1. Teks Bacaan -->
            <div class="mb-10">
                <h2 class="text-2xl font-semibold text-gray-700 mb-4">Silakan Baca Teks Berikut:</h2>
                <div class="prose prose-lg max-w-none text-gray-800 bg-gray-50 p-6 rounded-lg shadow-inner reading-text">

                    {!! $mission['reading_text'] ?? 'Teks bacaan tidak tersedia.' !!}
                </div>
            </div>

            <!-- 2. Form Kuis -->
            <div class="border-t pt-10">
                <h2 class="text-2xl font-semibold text-gray-700 mb-6">Kuis Pemahaman (3 Pertanyaan):</h2>

                <form action="{{ route('game.submit_quiz', $mission['mission_id']) }}" method="POST">
                    @csrf
                    <div class="space-y-8">

                        @if (isset($mission['quiz_questions']) && is_array($mission['quiz_questions']))
                            @foreach ($mission['quiz_questions'] as $index => $quiz)
                                <div class="bg-indigo-50 p-5 rounded-lg shadow-sm">
                                    <label for="answer_{{ $index }}" class="block text-lg font-semibold text-indigo-800 mb-3">
                                        Pertanyaan {{ $index + 1 }}: {{ $quiz['question'] }}
                                    </label>

                                    <!-- Kirim pertanyaan asli (tersembunyi) -->
                                    <input type="hidden" name="answers[{{ $index }}][question]" value="{{ $quiz['question'] }}">

                                    <!-- Gunakan textarea untuk jawaban esai singkat -->
                                    <textarea id="answer_{{ $index }}" name="answers[{{ $index }}][answer]" required
                                           class="w-full p-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                                           rows="3"
                                           placeholder="Tulis jawaban Anda di sini..."></textarea>
                                </div>
                            @endforeach
                        @else
                            <p class="text-red-500">Gagal memuat pertanyaan kuis.</p>
                        @endif

                        <button type="submit"
                                class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-lg font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                            Kirim Jawaban Kuis
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</body>
</html>
