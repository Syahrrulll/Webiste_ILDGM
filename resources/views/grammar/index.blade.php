<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zona Tata Bahasa - Literise</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #5c1d8f 0%, #4a2e7c 100%);
        }
        /* Custom style untuk loading overlay */
        #loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            color: white;
            font-size: 1.2rem;
        }
        .spinner {
            border: 8px solid rgba(255, 255, 255, 0.2);
            border-left-color: #FFF;
            border-radius: 50%;
            width: 60px;
            height: 60px;
            animation: spin 1s linear infinite;
            margin-bottom: 20px;
        }
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center text-white px-4">

    <!-- Loading Overlay (hidden by default) -->
    {{-- <div id="loading-overlay" class="hidden">
        <div class="spinner"></div>
        <p>Sedang membuat kuis tata bahasa...</p>
        <p class="text-sm">(Ini mungkin perlu beberapa detik)</p>
    </div> --}}

    <div class="w-full max-w-2xl text-center">
        <a href="{{ route('home') }}" class="block mb-6 text-4xl font-bold opacity-80 hover:opacity-100">
            LITERISE
        </a>

        <div class="bg-white text-gray-800 rounded-2xl shadow-xl p-8">
            <h1 class="text-3xl font-bold text-center text-[#4a2e7c] mb-4">📝 Zona Tata Bahasa</h1>
            <p class="text-gray-600 mb-8">
                Pilih genre favorit Anda. AI akan membuatkan 5 kalimat (beberapa benar, beberapa salah).
                Tugas Anda adalah memperbaikinya!
            </p>

            <!-- Menampilkan Error dari Controller -->
            @if (session('error'))
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded" role="alert">
                    <p class="font-bold">Error!</p>
                    <p>{{ session('error') }}</p>
                </div>
            @endif

            <!-- Form Pilihan -->
            <form action="{{ route('grammar.generate_game') }}" method="POST" id="game-form">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label for="genre" class="block text-left text-sm font-medium text-gray-700 mb-1">Pilih Genre</label>
                        <select id="genre" name="genre" required
                                class="w-full p-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 text-lg">
                            <option value="Slice of Life" selected>Slice of Life</option>
                            <option value="Romance">Romance</option>
                            <option value="Fantasy">Fantasy</option>
                            <option value="Shounen">Shounen / Aksi</option>
                            <option value="Sains Fiksi">Sains Fiksi</option>
                            <option value="Horor">Horor</option>
                            <option value="Formal">Formal / Akademik</option>
                        </select>
                    </div>

                    <div>
                        <button type="submit"
                                class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-lg font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Mulai Latihan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Tampilkan loading overlay saat form di-submit
        document.getElementById('game-form').addEventListener('submit', function() {
            document.getElementById('loading-overlay').classList.remove('hidden');
        });
    </script>
</body>
</html>
