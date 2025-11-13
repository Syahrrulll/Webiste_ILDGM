<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leaderboard - Literise</title>
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
            <!-- Tampilkan nama dan link logout -->
            <div class="flex items-center space-x-4">
                @auth
                    <a href="{{ route('profile.index') }}" class="font-semibold hover:text-pink-300 transition-colors">
                        Profil Saya
                    </a>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault(); this.closest('form').submit();"
                           class="bg-pink-500 hover:bg-pink-600 px-3 py-1 rounded-full text-sm font-medium transition-colors">
                            Logout
                        </a>
                    </form>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Konten Leaderboard -->
    <div class="container mx-auto max-w-4xl p-6 my-10">
        <div class="bg-white rounded-2xl shadow-xl p-8 md:p-12">

            <h1 class="text-3xl md:text-4xl font-bold text-center text-[#4a2e7c] mb-8">
                🏆 Leaderboard (Top 20) 🏆
            </h1>

            <!-- Daftar Peringkat -->
            <div class="flow-root">
                <ul role="list" class="divide-y divide-gray-200">

                    @forelse ($leaderboard as $index => $user)
                        <li class="py-4">
                            <div class="flex items-center space-x-4">
                                <!-- Peringkat (Emas, Perak, Perunggu) -->
                                <div class="flex-shrink-0 w-10 text-center">
                                    @if($index == 0)
                                        <span class="text-4xl" title="Peringkat 1">🥇</span>
                                    @elseif($index == 1)
                                        <span class="text-4xl" title="Peringkat 2">🥈</span>
                                    @elseif($index == 2)
                                        <span class="text-4xl" title="Peringkat 3">🥉</span>
                                    @else
                                        <span class="text-2xl font-bold text-gray-500">{{ $index + 1 }}</span>
                                    @endif
                                </div>

                                <!-- Foto Profil (Placeholder) -->
                                <div class="flex-shrink-0">
                                    <div class="w-12 h-12 rounded-full bg-gradient-to-br from-blue-400 to-indigo-600 flex items-center justify-center text-white text-xl font-bold">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                </div>

                                <!-- Nama -->
                                <div class="flex-1 min-w-0">
                                    <p class="text-lg font-medium text-gray-900 truncate">
                                        {{ $user->name }}
                                        @if($user->id == Auth::id())
                                            <span class="text-sm text-blue-600">(Anda)</span>
                                        @endif
                                    </p>
                                    <p class="text-sm text-gray-500 truncate">
                                        Total Poin
                                    </p>
                                </div>

                                <!-- Skor -->
                                <div>
                                    <p class="text-2xl font-bold text-blue-600">
                                        {{ $user->total_score }}
                                    </p>
                                </div>
                            </div>
                        </li>
                    @empty
                        <li class="py-4 text-center text-gray-500">
                            Belum ada skor di leaderboard. Ayo mulai mainkan game!
                        </li>
                    @endforelse

                </ul>
            </div>

            <!-- Tombol Aksi -->
            <div class="mt-10 pt-6 border-t text-center">
                <a href="{{ route('home') }}"
                   class="w-full sm:w-auto text-center py-3 px-6 border border-blue-600 rounded-lg shadow-sm text-lg font-medium text-blue-700 bg-white hover:bg-blue-50">
                    Kembali ke Beranda
                </a>
            </div>

        </div>
    </div>
</body>
</html>
