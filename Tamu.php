<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Reservasi;

class Tamu extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'nama', 'email', 'no_telp',
    ];

    // Function One-to-One relationship
    public function reservasi()
    {
        return $this->hasMany(Reservasi::class);
    }
}
