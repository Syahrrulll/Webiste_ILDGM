<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hoax or Not? - Literise</title>
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

    <!-- Loading Overlay (ditampilkan by default, disembunyikan oleh JS jika mission ada) -->
    {{-- <div id="loading-overlay" class="@if(isset($mission) || session('error')) hidden @endif">
        <div class="spinner"></div>
        <p>Sedang membuat kuis baru...</p>
        <p class="text-sm">(Ini mungkin perlu beberapa detik)</p>
    </div> --}}

    <div class="w-full max-w-2xl text-center">
        <a href="{{ route('home') }}" class="block mb-6 text-4xl font-bold opacity-80 hover:opacity-100">
            LITERISE
        </a>

        <div class="bg-white text-gray-800 rounded-2xl shadow-xl p-8">
            <h1 class="text-3xl font-bold text-center text-[#4a2e7c] mb-4">🗞 Hoax or Not?</h1>
            <p class="text-gray-600 mb-8">
                AI telah membuatkan sebuah skenario berita viral. Tugas Anda adalah menebak:
                Apakah berita ini **Hoax** atau **Fakta**?
            </p>

            <!-- Menampilkan Error dari Controller -->
            @if (session('error'))
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded" role="alert">
                    <p class="font-bold">Error!</p>
                    <p>{{ session('error') }}</p>
                    <!-- Tombol Coba Lagi -->
                    <a href="{{ route('hoax.index') }}"
                       class="mt-4 inline-block bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-lg transition-all">
                        Coba Muat Ulang Kuis
                    </a>
                </div>

            <!-- Menampilkan Kuis jika berhasil dimuat -->
            @elseif (isset($mission))
                <form action="{{ route('hoax.check') }}" method="POST">
                    @csrf
                    <!-- ID Misi (tersembunyi) -->
                    <input type="hidden" name="mission_id" value="{{ $mission['mission_id'] }}">

                    <!-- Cuplikan Berita -->
                    <div class="bg-gray-100 p-6 rounded-lg shadow-inner mb-6">
                        <p class="text-lg italic text-gray-700">"{{ $mission['news_snippet'] }}"</p>
                    </div>

                    <!-- Tombol Pilihan -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <button type="submit" name="user_choice" value="Hoax"
                                class="w-full py-4 px-4 rounded-lg shadow-lg text-2xl font-bold text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-all transform hover:scale-105">
                            HOAX
                        </button>
                        <button type="submit" name="user_choice" value="Fakta"
                                class="w-full py-4 px-4 rounded-lg shadow-lg text-2xl font-bold text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-all transform hover:scale-105">
                            FAKTA
                        </button>
                    </div>
                </form>
            @endif

        </div>
    </div>
</body>
</html>
