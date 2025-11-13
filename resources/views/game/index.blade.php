<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reading Mission - Literise</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #5c1d8f 0%, #4a2e7c 100%);
        }

        /* CSS UNTUK LOADING OVERLAY DIBAWAH INI SAYA HAPUS SEMENTARA
        #loading-overlay { ... }
        .spinner { ... }
        @keyframes spin { ... }
        */
    </style>
</head>
<body class="min-h-screen flex items-center justify-center text-white px-4">

    <!-- Loading Overlay (DIHAPUS SEMENTARA) -->
    <!--
    <div id="loading-overlay" class="hidden">
        <div class="spinner"></div>
        <p>Sedang membuat misi bacaan...</p>
        <p class="text-sm">(Ini mungkin perlu beberapa detik)</p>
    </div>
    -->

    <div class="w-full max-w-2xl text-center">
        <a href="{{ route('home') }}" class="block mb-6 text-4xl font-bold opacity-80 hover:opacity-100">
            LITERISE
        </a>

        <div class="bg-white text-gray-800 rounded-2xl shadow-xl p-8">
            <h1 class="text-3xl font-bold text-center text-[#4a2e7c] mb-4">🧠 Reading Mission</h1>
            <p class="text-gray-600 mb-8">
                Masukkan topik apapun yang Anda ingin pelajari. AI akan membuatkan artikel pendek
                dan 3 pertanyaan kuis pemahaman untuk Anda.
            </p>

            <!-- Menampilkan Error dari Controller -->
            @if (session('error'))
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded" role="alert">
                    <p class="font-bold">Error!</p>
                    <p>{{ session('error') }}</p>
                </div>
            @endif

            <!-- Form Search Bar -->
            <form action="{{ route('game.generate') }}" method="POST" id="game-form">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label for="topic" class="block text-left text-sm font-medium text-gray-700 mb-1">Topik Bacaan</label>
                        <input type="text" id="topic" name="topic" required value="{{ old('topic') }}"
                               class="w-full p-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 text-lg"
                               placeholder="Contoh: Sejarah Kerajaan Majapahit">
                        @error('topic')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <button type="submit"
                                class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-lg font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Buat Misi Bacaan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- SCRIPT UNTUK LOADING OVERLAY DIHAPUS SEMENTARA
    <script>
        document.getElementById('game-form').addEventListener('submit', function() {
            document.getElementById('loading-overlay').classList.remove('hidden');
        });
    </script>
    -->
</body>
</html>
