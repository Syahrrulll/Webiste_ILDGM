<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model; // <-- UBAH INI (baris lama)
use MongoDB\Laravel\Eloquent\Model; // <-- UBAH INI (baris baru)

class Score extends Model // <-- Ini sekarang menunjuk ke kelas MongoDB
{
    use HasFactory;

    /**
     * TAMBAHKAN INI:
     * Memberi tahu model ini untuk menggunakan koneksi 'mongodb'
     * yang Anda definisikan di config/database.php.
     */
    protected $connection = 'mongodb';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'game_type',
        'score',
    ];

    /**
     * Mendapatkan user yang memiliki skor ini.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
