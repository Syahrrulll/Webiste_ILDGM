<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    use HasFactory;

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
