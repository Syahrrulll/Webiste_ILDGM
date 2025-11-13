<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kuis Tata Bahasa: {{ $game['genre'] }} - Literise</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f7f9; /* Latar belakang netral */
        }
    </style>
</head>
<body class="min-h-screen">

    <!-- Header Sederhana -->
    <nav class="bg-gradient-to-r from-[#906AF1] to-[#5438DB] text-white shadow-lg">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <a href="{{ route('home') }}" class="text-2xl font-bold">LITERISE</a>
            <a href="{{ route('grammar.index') }}" class="font-semibold hover:text-pink-300 transition-colors">
                &larr; Kembali ke Pilihan Genre
            </a>
        </div>
    </nav>

    <!-- Konten Kuis -->
    <div class="container mx-auto max-w-4xl p-6 my-10">
        <div class="bg-white rounded-2xl shadow-xl p-8 md:p-12">

            <h1 class="text-3xl md:text-4xl font-bold text-[#4a2e7c] mb-6">
                Kuis Tata Bahasa: Genre {{ $game['genre'] }}
            </h1>
            <p class="text-lg text-gray-700 mb-8">
                Perbaiki 5 kalimat berikut. Jika menurut Anda kalimatnya sudah benar,
                tulis ulang saja kalimat tersebut apa adanya.
            </p>

            <!-- Form Kuis -->
            <div class="border-t pt-10">
                <form action="{{ route('grammar.submit_game', $game['game_id']) }}" method="POST">
                    @csrf
                    <div class="space-y-8">

                        @if (isset($game['sentences_to_fix']) && is_array($game['sentences_to_fix']))
                            @foreach ($game['sentences_to_fix'] as $index => $sentence)
                                <div class="bg-indigo-50 p-5 rounded-lg shadow-sm">
                                    <label for="sentence_{{ $index }}" class="block text-lg font-semibold text-indigo-800 mb-3">
                                        Kalimat {{ $index + 1 }}:
                                    </label>

                                    <!-- Kalimat Asli -->
                                    <p class="text-lg italic text-gray-700 mb-4 p-3 bg-white rounded border border-indigo-200">"{{ $sentence }}"</p>

                                    <!-- Input Koreksi -->
                                    <label for="sentence_{{ $index }}" class="block text-sm font-medium text-gray-700">Koreksi Anda:</label>
                                    <input type="text" id="sentence_{{ $index }}" name="sentences[{{ $index }}]" required
                                           class="w-full p-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                                           placeholder="Tulis versi benarnya di sini...">
                                </div>
                            @endforeach
                        @else
                            <p class="text-red-500">Gagal memuat kalimat kuis.</p>
                        @endif

                        <button type="submit"
                                class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-lg font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                            Kirim Koreksi
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</body>
</html>
