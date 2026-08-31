<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FotoRumah;
use Illuminate\Support\Facades\Storage;

class FotoRumahController extends Controller
{
    public function destroy(FotoRumah $fotoRumah)
    {
        if (Storage::disk('public')->exists($fotoRumah->path)) {
            Storage::disk('public')->delete($fotoRumah->path);
        }

        $fotoRumah->delete();

        return response()->json([
            'success' => true,
            'message' => 'Foto berhasil dihapus.',
            ]);
    }
}
