<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Foundation\Auth\User as Authenticatable; // <-- UBAH INI (baris lama)
use MongoDB\Laravel\Auth\User as Authenticatable; // <-- UBAH INI (baris baru)
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable // <-- Ini sekarang menunjuk ke kelas MongoDB
{
    use HasFactory, Notifiable;

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
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Mendapatkan semua skor untuk user ini.
     * Catatan: Relasi ini didukung oleh paket mongodb/laravel-mongodb
     */
    public function scores()
    {
        return $this->hasMany(Score::class)->orderBy('created_at', 'desc');
    }

    /**
     * Mendapatkan semua badge yang dimiliki user ini.
     * Catatan: Relasi ini juga didukung.
     */
    public function badges()
    {
        // Relasi Many-to-Many
        return $this->belongsToMany(Badge::class, 'badge_user')
                    ->withTimestamps(); // Sertakan timestamp (kapan didapat)
    }
}
