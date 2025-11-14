<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Kuis Tata Bahasa - Literise</title>
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
            <a href="{{ route('grammar.index') }}" class="font-semibold hover:text-pink-300 transition-colors">
                &larr; Coba Game Lain
            </a>
        </div>
    </nav>

    <!-- Konten Hasil -->
    <div class="container mx-auto max-w-4xl p-6 my-10">
        <div class="bg-white rounded-2xl shadow-xl p-8 md:p-12">

            <h1 class="text-3xl md:text-4xl font-bold text-[#4a2e7c] mb-2">
                Hasil Kuis Tata Bahasa
            </h1>

            <!-- Skor Total -->
            <div class="text-center bg-blue-100 border-l-4 border-blue-500 text-blue-800 p-6 rounded-lg my-8">
                <p class="text-xl font-medium mb-2">Skor Total Anda:</p>
                <p class="text-6xl font-bold">{{ $result['total_score'] ?? 0 }}</p>
                @if (($result['total_score'] ?? 0) >= 80)
                    <p class="text-lg mt-2">Luar biasa! Kemampuan tata bahasa Anda sangat baik.</p>
                @elseif (($result['total_score'] ?? 0) >= 60)
                    <p class="text-lg mt-2">Bagus! Anda sudah teliti.</p>
                @else
                    <p class="text-lg mt-2">Perlu sedikit latihan lagi, ayo coba lagi!</p>
                @endif
            </div>

            <!-- Detail Ulasan Jawaban -->
            <div class="border-t pt-10">
                <h2 class="text-2xl font-semibold text-gray-700 mb-6">Ulasan Jawaban:</h2>

                <div class="space-y-6">
                    @if (isset($result['results']) && is_array($result['results']))
                        @foreach ($result['results'] as $index => $item)
                            <div class="border border-gray-200 rounded-lg overflow-hidden shadow-sm">
                                <div class="bg-gray-50 p-4 border-b">
                                    <p class="font-semibold text-gray-700">Kalimat {{ $index + 1 }} (Asli):</p>
                                    <p class="italic text-gray-600">"{{ $item['original'] }}"</p>
                                </div>
                                <div class="p-4 space-y-3">
                                    @if ($item['is_correct'])
                                        <div class="flex items-start">
                                            <span class="text-2xl mr-2">✅</span>
                                            <div>
                                                <p class="text-lg text-green-700">Koreksi Anda: <strong class="font-bold">{{ $item['user_correction'] }}</strong> (Benar)</p>
                                                @if ($item['user_correction'] == $item['original'])
                                                    <p class="text-sm text-gray-600">(Kalimat aslinya memang sudah benar)</p>
                                                @endif
                                            </div>
                                        </div>
                                    @else
                                        <div class="flex items-start">
                                            <span class="text-2xl mr-2">❌</span>
                                             <div>
                                                <p class="text-lg text-red-700">Koreksi Anda: <strong class="font-bold line-through">{{ $item['user_correction'] }}</strong></p>
                                                <p class="text-lg text-green-700 mt-2">Jawaban Benar: <strong class="font-bold">{{ $item['correct_sentence'] }}</strong></p>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p class="text-red-500">Gagal memuat ulasan hasil.</p>
                    @endif
                </div>

                <!-- Tombol Aksi -->
                <div class="mt-10 pt-6 border-t flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('grammar.index') }}"
                       class="w-full sm:w-auto text-center py-3 px-6 border border-transparent rounded-lg shadow-sm text-lg font-medium text-white bg-blue-600 hover:bg-blue-700">
                        Coba Genre Lain
                    </a>

                    <!-- ====================== -->
                    <!--     PERUBAHAN DI SINI    -->
                    <!-- ====================== -->
                    <a href="{{ route('permainan.index') }}"
                       class="w-full sm:w-auto text-center py-3 px-6 border border-blue-600 rounded-lg shadow-sm text-lg font-medium text-blue-700 bg-white hover:bg-blue-50">
                        Kembali ke Halaman Permainan
                    </a>
                    <!-- ====================== -->
                </div>
            </div>

        </div>
    </div>
</body>
</html>
