<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kelurahan;

class KelurahanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Kelurahan::create([
            'kecamatan_id' => 1,
            'nama_kelurahan' => 'Air Hitam'
        ]);

        Kelurahan::create([
            'kecamatan_id' => 1,
            'nama_kelurahan' => 'Air Putih'
        ]);

        Kelurahan::create([
            'kecamatan_id' => 2,
            'nama_kelurahan' => 'Sempaja Selatan'
        ]);

        Kelurahan::create([
            'kecamatan_id' => 3,
            'nama_kelurahan' => 'Sungai Pinang Dalam'
        ]);

        Kelurahan::create([
            'kecamatan_id' => 4,
            'nama_kelurahan' => 'Karang Asam Ulu'
        ]);
    }
}
