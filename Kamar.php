<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\FasilitasKamar;

class Kamar extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipe_kamar', 'jumlah', 'image', 'name_img',
    ];

    // Function One-to-One relationship
    public function fasilitasKamar()
    {
        return $this->hasMany(FasilitasKamar::class);
    }
}
