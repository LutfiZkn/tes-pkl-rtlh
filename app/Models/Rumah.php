<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rumah extends Model
{
    protected $table = 'rumah';

    protected $fillable = [
        'kelurahan_id',
        'nama_pemilik',
        'nik',
        'alamat',
        'kondisi',
        'tahun_pendataan',
        'keterangan',
    ];

    public function kelurahan()
    {
        return $this->belongsTo(Kelurahan::class);
    }
}
