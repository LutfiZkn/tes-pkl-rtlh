<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\FotoRumah;
use Illuminate\Support\Facades\Storage;

class Rumah extends Model
{
    use SoftDeletes;

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

    public function fotoRumah(): HasMany
    {
        return $this->hasMany(FotoRumah::class);
    }

    protected static function booted(): void
    {
        static::deleting(function (Rumah $rumah) {
            // Hard delete saat Rumah delete permanen
            if ($rumah->isForceDeleting()) {
                $rumah->load('fotoRumah');

                foreach ($rumah->fotoRumah as $foto) {
                    if (
                        $foto->path &&
                        Storage::disk('public')->exists($foto->path)
                    ) {
                        Storage::disk('public')->delete($foto->path);
                    }
                }

                $rumah->fotoRumah()->delete();
            }
        });
    }
}
