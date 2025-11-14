<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model; // <-- UBAH INI (baris lama)
use MongoDB\Laravel\Eloquent\Model; // <-- UBAH INI (baris baru)

class Badge extends Model // <-- Ini sekarang menunjuk ke kelas MongoDB
{
    use HasFactory;

    /**
     * TAMBAHKAN INI:
     * Memberi tahu model ini untuk menggunakan koneksi 'mongodb'
     * yang Anda definisikan di config/database.php.
     */
    protected $connection = 'mongodb';

    protected $fillable = [
        'name',
        'description',
        'icon_svg',
        'icon_color',
        'criteria_code',
    ];

    /**
     * Mendapatkan semua user yang memiliki badge ini.
     */
    public function users()
    {
        // Relasi Many-to-Many
        return $this->belongsToMany(User::class, 'badge_user');
    }
}
