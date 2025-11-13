<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Misi: {{ $title }} - Literise</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f7f9;
        }
    </style>
</head>
<body class="min-h-screen">

    <!-- Header Sederhana -->
    <nav class="bg-gradient-to-r from-[#906AF1] to-[#5438DB] text-white shadow-lg">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <a href="{{ route('home') }}" class="text-2xl font-bold">LITERISE</a>
            <a href="{{ route('game.play') }}" class="font-semibold hover:text-pink-300 transition-colors">
                &larr; Coba Misi Lain
            </a>
        </div>
    </nav>

    <!-- Konten Hasil -->
    <div class="container mx-auto max-w-4xl p-6 my-10">
        <div class="bg-white rounded-2xl shadow-xl p-8 md:p-12">

            <h1 class="text-3xl md:text-4xl font-bold text-[#4a2e7c] mb-2">
                Hasil Misi: {{ $title }}
            </h1>

            <!-- Skor Total -->
            <div class="text-center bg-blue-100 border-l-4 border-blue-500 text-blue-800 p-6 rounded-lg my-8">
                <p class="text-xl font-medium mb-2">Skor Total Anda:</p>
                <p class="text-6xl font-bold">{{ $total_score ?? 0 }}</p>
                @if (($total_score ?? 0) >= 80)
                    <p class="text-lg mt-2">Luar biasa! Pemahaman Anda sangat baik.</p>
                @elseif (($total_score ?? 0) >= 60)
                    <p class="text-lg mt-2">Bagus! Anda sudah paham.</p>
                @else
                    <p class="text-lg mt-2">Perlu sedikit latihan lagi, ayo coba lagi!</p>
                @endif
            </div>

            <!-- Detail Ulasan Jawaban -->
            <div class="border-t pt-10">
                <h2 class="text-2xl font-semibold text-gray-700 mb-6">Ulasan Jawaban:</h2>

                <div class="space-y-6">
                    @if (isset($results) && is_array($results))
                        @foreach ($results as $index => $result)
                            <div classclass="border border-gray-200 rounded-lg overflow-hidden shadow-sm">
                                <div class="bg-gray-50 p-4 border-b">
                                    <p class="font-semibold text-gray-700">Pertanyaan {{ $index + 1 }}: {{ $result['question'] }}</p>
                                </div>
                                <div class="p-4 space-y-3">
                                    <div>
                                        <span class="text-xs font-semibold text-gray-500">Jawaban Anda:</span>
                                        <p class="text-gray-800 italic">"{{ $result['user_answer'] }}"</p>
                                    </div>
                                    <div class="border-t pt-3">
                                        <span class="text-xs font-semibold text-gray-500">Umpan Balik AI:</span>
                                        <p class="text-gray-800">{{ $result['feedback'] }}</p>
                                    </div>
                                    <div class="{{ $result['score'] >= 80 ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }} inline-block px-3 py-1 rounded-full font-bold text-sm">
                                        Skor: {{ $result['score'] }}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p class="text-red-500">Gagal memuat ulasan hasil.</p>
                    @endif
                </div>

                <!-- Tombol Aksi -->
                <div class="mt-10 pt-6 border-t flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('game.play') }}"
                       class="w-full sm:w-auto text-center py-3 px-6 border border-transparent rounded-lg shadow-sm text-lg font-medium text-white bg-blue-600 hover:bg-blue-700">
                        Coba Topik Lain
                    </a>
                    <a href="{{ route('home') }}"
                       class="w-full sm:w-auto text-center py-3 px-6 border border-blue-600 rounded-lg shadow-sm text-lg font-medium text-blue-700 bg-white hover:bg-blue-50">
                        Kembali ke Beranda
                    </a>
                </div>
            </div>

        </div>
    </div>
</body>
</html>
