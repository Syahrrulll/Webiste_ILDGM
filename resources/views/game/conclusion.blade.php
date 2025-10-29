<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Permainan Selesai!</title>
    <style>
        body { font-family: sans-serif; margin: 40px; background-color: #f4f7f9; text-align: center; }
        .container { max-width: 600px; margin: auto; background: #fff; padding: 40px; border-radius: 8px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2); }
        h1 { color: #28a745; margin-bottom: 20px; }
        .message { font-size: 1.2em; color: #333; margin-bottom: 30px; }
        .restart-btn { background-color: #007bff; color: white; padding: 12px 25px; border: none; border-radius: 6px; cursor: pointer; text-decoration: none; font-weight: bold; }
        .restart-btn:hover { background-color: #0056b3; }
        .trophy { font-size: 4em; margin-bottom: 15px; display: block; }
    </style>
</head>
<body>
    <div class="container">
        <span class="trophy">🏆</span>
        <h1>SELAMAT! PERMAINAN SELESAI!</h1>
        <p class="message">
            Anda telah berhasil menyelesaikan semua {{ \App\Http\Controllers\LiteracyGameController::MAX_LEVEL }} level tantangan literasi.
            Hasil analisis AI menunjukkan Anda memiliki kemampuan literasi yang kuat dan adaptif.
        </p>
        <a href="{{ url('/') }}" class="restart-btn">Mulai Permainan Baru</a>
    </div>
</body>
</html>
