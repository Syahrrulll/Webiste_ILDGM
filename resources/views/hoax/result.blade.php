<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil: Hoax or Not? - Literise</title>
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
            <a href="{{ route('hoax.index') }}" class="font-semibold hover:text-pink-300 transition-colors">
                &larr; Coba Kuis Lain
            </a>
        </div>
    </nav>

    <!-- Konten Hasil -->
    <div class="container mx-auto max-w-4xl p-6 my-10">
        <div class="bg-white rounded-2xl shadow-xl p-8 md:p-12">

            <!-- Hasil Benar / Salah -->
            @if ($result['is_correct'])
                <div class="text-center bg-green-100 border-l-4 border-green-500 text-green-800 p-6 rounded-lg mb-8">
                    <p class="text-6xl font-bold">BENAR!</p>
                    <p class="text-xl mt-2">Jawaban Anda ({{ $user_choice }}) tepat sekali.</p>
                </div>
            @else
                <div class="text-center bg-red-100 border-l-4 border-red-500 text-red-800 p-6 rounded-lg mb-8">
                    <p class="text-6xl font-bold">SALAH</p>
                    <p class="text-xl mt-2">Jawaban Anda ({{ $user_choice }}) kurang tepat. Jawaban yang benar adalah **{{ $result['correct_answer'] }}**.</p>
                </div>
            @endif

            <!-- Penjelasan AI -->
            <div class="border-t pt-10">
                <h2 class="text-2xl font-semibold text-gray-700 mb-4">Penjelasan:</h2>

                <div class="prose prose-lg max-w-none text-gray-800 bg-gray-50 p-6 rounded-lg shadow-inner">
                    <p>{{ $result['explanation'] }}</p>

                    @if (isset($result['source_url']) && $result['source_url'] != 'N/A')
                        <p class="mt-4 border-t pt-4">
                            <strong>Sumber Referensi:</strong>
                            <a href="{{ $result['source_url'] }}" target="_blank" rel="noopener noreferrer"
                               class="text-blue-600 hover:underline break-words">
                                {{ $result['source_url'] }}
                            </a>
                        </p>
                    @endif
                </div>

                <!-- Tombol Aksi -->
                <div class="mt-10 pt-6 border-t flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('hoax.index') }}"
                       class="w-full sm:w-auto text-center py-3 px-6 border border-transparent rounded-lg shadow-sm text-lg font-medium text-white bg-blue-600 hover:bg-blue-700">
                        Coba Kuis Lain
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
