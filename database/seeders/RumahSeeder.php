<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Rumah;

class RumahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Rumah::create([
            'kelurahan_id' => 1,
            'nama_pemilik' => 'Asep',
            'nik' => '0123456789',
            'alamat' => 'Jl. A.W Syahranie No. 10',
            'kondisi' => 'Rusak Ringan',
            'tahun_pendataan' => 2026,
            'keterangan' => 'Kondisi rumah layak huni'
        ]);

        Rumah::create([
            'kelurahan_id' => 1,
            'nama_pemilik' => 'Budi',
            'nik' => '0987654321',
            'alamat' => 'Jl. A.W Syahranie No. 20',
            'kondisi' => 'Rusak Sedang',
            'tahun_pendataan' => 2025,
            'keterangan' => 'Beberapa bagian rumah mengalami kerusakan'
        ]);

        Rumah::create([
            'kelurahan_id' => 2,
            'nama_pemilik' => 'Rani',
            'nik' => '0876543219',
            'alamat' => 'Jl. P.Suryanata No. 02',
            'kondisi' => 'Rusak Berat',
            'tahun_pendataan' => 2024,
            'keterangan' => 'Kondisi rumah kurang layak huni dan memerlukan perbaikan'
        ]);

        Rumah::create([
            'kelurahan_id' => 2,
            'nama_pemilik' => 'Rodtang',
            'nik' => '0765432198',
            'alamat' => 'Jl. A.W Syahranie No. 55',
            'kondisi' => 'Rusak Ringan',
            'tahun_pendataan' => 2026,
            'keterangan' => 'Kondisi rumah layak huni'
        ]);

        Rumah::create([
            'kelurahan_id' => 3,
            'nama_pemilik' => 'Mike',
            'nik' => '0654321987',
            'alamat' => 'Jl. Perjuangan No. 12',
            'kondisi' => 'Rusak Sedang',
            'tahun_pendataan' => 2025,
            'keterangan' => 'Kondisi rumah memerlukan perbaikan pada beberapa bagian'
        ]);

        Rumah::create([
            'kelurahan_id' => 4,
            'nama_pemilik' => 'Kimi',
            'nik' => '0543219876',
            'alamat' => 'Jl. Sentosa No. 08',
            'kondisi' => 'Rusak Ringan',
            'tahun_pendataan' => 2024,
            'keterangan' => '-'
        ]);

        Rumah::create([
            'kelurahan_id' => 4,
            'nama_pemilik' => 'Rudi',
            'nik' => '0432198765',
            'alamat' => 'Jl. Kemakmuran No. 19',
            'kondisi' => 'Rusak Ringan',
            'tahun_pendataan' => 2025,
            'keterangan' => '-'
        ]);

        Rumah::create([
            'kelurahan_id' => 5,
            'nama_pemilik' => 'Putra',
            'nik' => '0321987654',
            'alamat' => 'Jl. Slamet Riyadi No. 21',
            'kondisi' => 'Rusak Ringan',
            'tahun_pendataan' => 2026,
            'keterangan' => 'Kondisi rumah layak huni'
        ]);

        Rumah::create([
            'kelurahan_id' => 5,
            'nama_pemilik' => 'tes',
            'nik' => '0000000',
            'alamat' => 'jalan jalan dengan sepatu rodaku',
            'kondisi' => 'Rusak Sedang',
            'tahun_pendataan' => 2025,
            'keterangan' => 'Kondisi rumah memerlukan perbaikan pada beberapa bagian'
        ]);
    }
}
