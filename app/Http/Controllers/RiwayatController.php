<?php

namespace App\Http\Controllers;
use App\Models\Rumah;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RiwayatController extends Controller
{
    public function create(Rumah $rumah)
    {
        return view('riwayat.create', compact('rumah'));
    }

    public function store(Request $request, Rumah $rumah)
    {
        $request->validate([
            'kondisi' => 'required|in:Rusak Ringan,Rusak Sedang,Rusak Berat',
            'tanggal_survei' => 'required|date',
            'keterangan' => 'nullable|string',
        ]);

        $rumah->riwayatRumah()->create([
            'user_id' => Auth::id(),
            'kondisi' => $request->kondisi,
            'tanggal_survei' => $request->tanggal_survei,
            'keterangan' => $request->keterangan,
        ]);

        $rumah->update([
            'kondisi' => $request->kondisi,
        ]);

        return redirect()->route('rumah.show', $rumah)->with('success', 'Data berhasil disimpan.');
    }
}
