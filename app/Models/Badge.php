<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Badge extends Model
{
    use HasFactory;

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
