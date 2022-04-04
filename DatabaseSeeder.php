<?php

namespace Database\Seeders;

use App\Models\FasilitasHotel;
use App\Models\FasilitasKamar;
use App\Models\Kamar;
use App\Models\Reservasi;
use App\Models\Tamu;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'username' => 'admin123',
            'password' => Hash::make('luulhotel2022'),
            'role' => 'admin',
        ]);

        User::create([
            'username' => 'ninym',
            'password' => Hash::make('luulhotel2022'),
            'role' => 'resepsionis',
        ]);

        $user = User::create([
            'username' => 'elaina',
            'password' => Hash::make('luulhotel2022'),
            'role' => 'tamu',
        ]);

        $tamu = Tamu::create([
            'user_id' => $user->id,
            'nama' => 'elainaWangy',
            'email' => 'elaina@gmail.com',
            'no_telp' => '085161714757',
        ]);

        $kamar = Kamar::create([
            'tipe_kamar' => 'Premium',
            'jumlah' => '2',
            'image' => 'C:\xampp\htdocs\UKOM\p2laravel\hotel\public\images\20220222_181334_waifu2x_art_noise2_scale_tta_1.png',
            'name_img' => '20220222_181334_waifu2x_art_noise2_scale_tta_1.png',
        ]);

        Reservasi::create([
            'tamu_id' => $tamu->id,
            'jumlah' => '1',
            'tipe_kamar' => $kamar->tipe_kamar,
            'tanggal_in' => date('Y-m-d'),
            'tanggal_out' => date('Y-m-d'),
        ]);

        FasilitasKamar::create([
            'kamar_id' => $kamar->id,
            'fasilitas' => 'AC',
            'image' => 'C:\xampp\htdocs\UKOM\p2laravel\hotel\public\images/fasilitas\20220222_181334_waifu2x_art_noise2_scale_tta_1.png',
            'name_img' => '20220222_181334_waifu2x_art_noise2_scale_tta_1.png',
        ]);

        FasilitasHotel::create([
            'fasilitas' => 'AC',
            'keterangan' => 'AC 3pk',
            'image' => 'C:\xampp\htdocs\UKOM\p2laravel\hotel\public\images/fasilitas-hotel\20220222_181334_waifu2x_art_noise2_scale_tta_1.png',
            'name_img' => '20220222_181334_waifu2x_art_noise2_scale_tta_1.png',
        ]);
    }
}
