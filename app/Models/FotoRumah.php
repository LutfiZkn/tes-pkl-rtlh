<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Rumah;

class FotoRumah extends Model
{
    protected $table = 'foto_rumah';

    protected $fillable = [
        'rumah_id',
        'nama_file',
        'path',
    ];

    public function rumah(): BelongsTO
    {
        return $this->belongsTo(Rumah::class);
    }
}
