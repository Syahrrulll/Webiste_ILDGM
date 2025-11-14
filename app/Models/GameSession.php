<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Model; // <-- UBAH INI (baris lama)
use MongoDB\Laravel\Eloquent\Model; // <-- UBAH INI (baris baru)
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GameSession extends Model
{
    /**
     * TAMBAHKAN INI:
     * Memberi tahu model ini untuk menggunakan koneksi 'mongodb'.
     */
    protected $connection = 'mongodb';

    /**
     * UBAH INI:
     * Di MongoDB, kita menyebutnya 'collection', bukan 'table'.
     * Ini adalah cara yang lebih idiomatik untuk paket jenssegers/mongodb.
     */
    protected $collection = 'game_sessions'; // <-- Mengganti $table

    protected $fillable = [
        'game_id',
        'user_id',
        'game_type',
        'game_data',
        'status',
        'score',
        'total_questions',
        'correct_answers'
    ];

    protected $casts = [
        'game_data' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope untuk query by game_id
     */
    public function scopeByGameId($query, $gameId)
    {
        return $query->where('game_id', $gameId);
    }

    /**
     * Scope untuk query by user
     */
    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }
}
