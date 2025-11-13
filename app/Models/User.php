<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable; // HasApiTokens dihapus

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
     */
    public function scores()
    {
        return $this->hasMany(Score::class)->orderBy('created_at', 'desc');
    }

    /**
     * BARU: Mendapatkan semua badge yang dimiliki user ini.
     */
    public function badges()
    {
        // Relasi Many-to-Many
        return $this->belongsToMany(Badge::class, 'badge_user')
                    ->withTimestamps(); // Sertakan timestamp (kapan didapat)
    }
}
