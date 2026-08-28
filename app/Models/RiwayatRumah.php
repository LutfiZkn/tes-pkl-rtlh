<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RiwayatRumah extends Model
{
    protected $table = 'riwayat_rumah';

    protected $fillable = [
        'rumah_id',
        'user_id',
        'kondisi',
        'tanggal_survei',
        'keterangan',
    ];

    protected $casts = [
        'tanggal_survei' => 'date',
    ];

    public function rumah(): BelongsTo
    {
        return $this->belongsTo(Rumah::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
