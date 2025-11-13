<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale-1.0">
    <title>Profil Saya - Literise</title>
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
                <a href="{{ route('leaderboard.index') }}" class="font-semibold hover:text-pink-300 transition-colors">
                    Leaderboard
                </a>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault(); this.closest('form').submit();"
                       class="bg-pink-500 hover:bg-pink-600 px-3 py-1 rounded-full text-sm font-medium transition-colors">
                        Logout
                    </a>
                </form>
            </div>
        </div>
    </nav>

    <!-- Konten Profil -->
    <div class="container mx-auto max-w-6xl p-6 my-10">

        <!-- Kartu Profil Utama -->
        <div class="bg-white rounded-2xl shadow-xl p-8 md:p-12 mb-8">
            <div class="flex flex-col md:flex-row items-center">
                <!-- Foto Profil (Placeholder) -->
                <div class="flex-shrink-0 mb-6 md:mb-0 md:mr-8">
                    <div class="w-32 h-32 rounded-full bg-gradient-to-br from-blue-400 to-indigo-600 flex items-center justify-center text-white text-5xl font-bold">
                        {{-- Ambil huruf pertama dari nama --}}
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                </div>
                <!-- Info User -->
                <div>
                    <h1 class="text-3xl md:text-4xl font-bold text-[#4a2e7c]">{{ $user->name }}</h1>
                    <p class="text-lg text-gray-600 mt-1">{{ $user->email }}</p>
                    <p class="text-gray-500 mt-2">Bergabung sejak: {{ $user->created_at->format('d F Y') }}</p>

                    <!-- Info Skor & Game -->
                    <div class="flex space-x-6 mt-6 border-t pt-6">
                        <div>
                            <p class="text-sm text-gray-500">Total Poin</p>
                            <p class="text-3xl font-bold text-blue-600">{{ $total_score }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Game Dimainkan</p>
                            <p class="text-3xl font-bold text-blue-600">{{ $games_played }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bagian Grid: Skor Tertinggi dan Badge -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <!-- Kolom 1: Skor Tertinggi Pribadi (BARU) -->
            <div class="lg:col-span-1 bg-white rounded-2xl shadow-xl p-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">Skor Tertinggi Pribadi</h2>
                <div class="space-y-5">

                    @forelse ($personalHighScores as $score)
                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                            <div>
                                <p class="text-lg font-semibold text-gray-900">{{ $score->game_type }}</p>
                                <p class="text-sm text-gray-500">
                                    @if($score->high_score > 0)
                                        Skor Tertinggi
                                    @else
                                        Belum dimainkan
                                    @endif
                                </p>
                            </div>
                            <p class="text-3xl font-bold {{ $score->high_score > 0 ? 'text-blue-600' : 'text-gray-400' }}">
                                {{ $score->high_score }}
                            </p>
                        </div>
                    @empty
                        <p class="text-gray-500">Belum ada skor tercatat.</p>
                    @endforelse

                </div>
            </div>

            <!-- Kolom 2: Badge Saya (DIPERBARUI) -->
            <div class="lg:col-span-2 bg-white rounded-2xl shadow-xl p-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">Koleksi Badge Saya</h2>

                @if($badges->isEmpty())
                    <p class="text-gray-500">Belum ada badge didapat. Selesaikan game untuk mendapatkan badge!</p>
                @else
                    <!-- Tampilkan badge dalam grid -->
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-6">
                        @foreach ($badges as $badge)
                            <div class="flex flex-col items-center text-center p-4 bg-gray-50 rounded-lg border border-gray-200"
                                 title="Didapat pada: {{ $badge->pivot->created_at->format('d M Y') }}">
                                <div class="w-16 h-16 rounded-full {{ $badge->icon_color }} bg-gray-100 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        {!! $badge->icon_svg !!}
                                    </svg>
                                </div>
                                <p class="text-md font-semibold text-gray-900 mt-3">{{ $badge->name }}</p>
                                <p class="text-xs text-gray-600">{{ $badge->description }}</p>
                            </div>
                        @endforeach
                    </div>
                @endif

                <!-- Aktivitas Terakhir (Dipindah ke bawah badge) -->
                <h2 class="text-2xl font-bold text-gray-800 mb-6 mt-10 pt-6 border-t">Aktivitas Terakhir</h2>
                <div class="flow-root">
                    <ul role="list" class="-mb-8">
                        @forelse ($recent_scores as $index => $score)
                            <li>
                                <div class="relative pb-8">
                                    @if (!$loop->last)
                                        <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
                                    @endif
                                    <div class="relative flex space-x-3">
                                        <div>
                                            <span class="h-8 w-8 rounded-full bg-blue-500 flex items-center justify-center ring-8 ring-white">
                                                <svg class="h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                  <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 18.75h-9a2.25 2.25 0 00-2.25 2.25v.01c0 .69.56 1.25 1.25 1.25h12.5c.69 0 1.25-.56 1.25-1.25v-.01a2.25 2.25 0 00-2.25-2.25zM12.75 6.031a9 9 0 00-9.191 9.192h18.382a9 9 0 00-9.191-9.192zM12.75 6.031V3.75m0 2.281l-3.233-3.232m3.233 3.232l3.233-3.232m-3.233 3.232v6.75A2.25 2.25 0 0110.5 15h-3a2.25 2.25 0 01-2.25-2.25v-6.75m7.5 0v6.75A2.25 2.25 0 0015 15h3a2.25 2.25 0 002.25-2.25v-6.75m-7.5 0h7.5" />
                                                </svg>
                                            </span>
                                        </div>
                                        <div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
                                            <div>
                                                <p class="text-sm text-gray-500">
                                                    Menyelesaikan <strong class="font-medium text-gray-900">{{ $score->game_type }}</strong>
                                                </p>
                                            </div>
                                            <div class="whitespace-nowrap text-right text-sm text-gray-500">
                                                <p class="font-bold text-blue-600">+{{ $score->score }} Poin</p>
                                                <time datetime="{{ $score->created_at->toIso8601String() }}">{{ $score->created_at->diffForHumans() }}</time>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @empty
                            <li>
                                <div class="relative flex space-x-3">
                                     <div>
                                        <span class="h-8 w-8 rounded-full bg-gray-400 flex items-center justify-center ring-8 ring-white">
                                            <svg class="h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                              <path stroke-linecap="round" stroke-linejoin="round" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                                            </svg>
                                        </span>
                                    </div>
                                    <p class="text-gray-500 pt-1.5">Belum ada aktivitas. Ayo mulai mainkan game!</p>
                                </div>
                            </li>
                        @endforelse
                    </ul>
                </div>

            </div>
        </div>
    </div>
</body>
</html>
