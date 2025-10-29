<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Literasi Cerdas AI - Level {{ $level ?? 1 }}</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Menggunakan font Inter */
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen p-4">
    <div class="container max-w-2xl mx-auto bg-white p-6 md:p-10 rounded-xl shadow-2xl">
        <div class="text-center mb-8">
            <h1 class="text-4xl font-extrabold text-blue-600">Literasi Cerdas AI 🧠</h1>
            <p class="text-gray-600 mt-2">Tingkatkan kemampuan literasi Anda melalui tantangan adaptif!</p>
        </div>

        <div class="flex justify-between items-center mb-6 border-b pb-4">
            <span class="text-sm font-semibold text-gray-700">Level Saat Ini:</span>
            <span class="text-3xl font-bold text-green-600">{{ $level ?? 1 }}</span>
        </div>

        <!-- Pesan Feedback (Success/Error) -->
        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-md shadow-sm" role="alert">
                <p class="font-bold">Sukses!</p>
                <p>{{ session('success') }}</p>
            </div>
        @elseif (session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-md shadow-sm" role="alert">
                <p class="font-bold">Error!</p>
                <p>{{ session('error') }}</p>
            </div>
        @endif

        <!-- Bagian Soal -->
        <div class="bg-indigo-50 border-l-4 border-indigo-500 p-5 mb-8 rounded-lg shadow-inner">
            <p class="text-lg font-semibold text-indigo-700 mb-2">Soal ke-{{ $level ?? 1 }}:</p>
            <p class="text-gray-800 leading-relaxed font-medium">{!! $question ?? 'Belum ada soal. Klik mulai!' !!}</p>
        </div>

        <!-- Form Jawaban -->
        <form action="{{ url('/submit-answer') }}" method="POST">
            @csrf

            <!-- Input tersembunyi untuk level saat ini -->
            <input type="hidden" name="level" value="{{ $level ?? 1 }}">

            <label for="user_answer" class="block text-sm font-medium text-gray-700 mb-2">Tulis Jawaban Anda di bawah ini:</label>
            <textarea id="user_answer" name="user_answer" required rows="6"
                      class="w-full p-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 shadow-sm"
                      placeholder="Tulis jawaban atau esai Anda di sini..."></textarea>

            <div class="mt-6">
                <button type="submit"
                        class="w-full py-3 px-4 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-lg shadow-lg transition duration-150 ease-in-out">
                    Kirim Jawaban & Lanjut
                </button>
            </div>
        </form>

    </div>
</body>
</html>
