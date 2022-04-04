<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tamu;

class Reservasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'tamu_id', 'jumlah', 'tipe_kamar', 'tanggal_in', 'tanggal_out',
    ];

    // Function One-to-One relationship
    public function tamu()
    {
        return $this->belongsTo(Tamu::class);
    }
}
