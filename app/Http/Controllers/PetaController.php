<?php

namespace App\Http\Controllers;
use App\Models\Rumah;
use Illuminate\Http\Request;

class PetaController extends Controller
{
    public function index(Request $request)
    {
        $query = Rumah::with('kelurahan.kecamatan')
            ->whereNotNull('latitude')
            ->whereNotNull('longitude');

        if ($request->filled('kondisi')) {
            $query->where('kondisi', $request->kondisi);
        }

        if ($request->filled('status_verifikasi')) {
            $query->where('status_verifikasi', $request->status_verifikasi);
        }

        $rumah = $query->get();

        return view('peta.index', compact('rumah'));
    }
}
