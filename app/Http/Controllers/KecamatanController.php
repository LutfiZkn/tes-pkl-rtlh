<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rumah;
use App\Models\Kecamatan;
use App\Http\Requests\KecamatanRequest;

class KecamatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('kecamatan.index', [
            'kecamatan' => Kecamatan::latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kecamatan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(KecamatanRequest $request)
    {
        Kecamatan::create($request->validated());

        return redirect()->route('kecamatan.index')->with('success', 'Data berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('kecamatan.show', [
            'kecamatan' => Kecamatan::findOrFail($id),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('kecamatan.edit', [
            'kecamatan' => Kecamatan::findOrFail($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(KecamatanRequest $request, string $id)
    {
        $kecamatan = Kecamatan::findOrFail($id);
        $kecamatan->update($request->validated());

        return redirect()->route('kecamatan.index')->with('success', 'Data berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kecamatan = Kecamatan::findOrFail($id);

        $adaRumah = Rumah::whereHas('kelurahan', function ($query) use ($kecamatan) {
            $query->where('kecamatan_id', $kecamatan->id);
        })->exists();

        if ($adaRumah) {
            return redirect()->route('kecamatan.index')->with('error', 'Kecamatan tidak dapat dihapus karena masih memiliki data rumah.');
        }

        //Hapus kelurahan yg ada di kecamatan
        $kecamatan->kelurahan()->delete();

        $kecamatan->delete();

        return redirect()->route('kecamatan.index')->with('success', 'Data berhasil dihapus.');
    }
}
