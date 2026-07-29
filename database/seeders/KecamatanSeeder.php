<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kecamatan;

class KecamatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Kecamatan::create([
            'nama_kecamatan' => 'Samarinda Ulu'
        ]);

        Kecamatan::create([
            'nama_kecamatan' => 'Samarinda Utara'
        ]);

        Kecamatan::create([
            'nama_kecamatan' => 'Sungai Pinang'
        ]);

        Kecamatan::create([
            'nama_kecamatan' => 'Sungai Kunjang'
        ]);
    }
}
