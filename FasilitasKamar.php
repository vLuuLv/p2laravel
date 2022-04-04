<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Kamar;

class FasilitasKamar extends Model
{
    use HasFactory;

    protected $fillable = [
        'kamar_id', 'fasilitas', 'image', 'name_img',
    ];

    // Function One-to-One relationship
    public function kamar()
    {
        return $this->belongsTo(Kamar::class);
    }
}
