<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rumah;
use App\Models\Kelurahan;
use App\Models\Kecamatan;
use App\Http\Requests\KelurahanRequest;

class KelurahanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('kelurahan.index', [
            'kelurahan' => Kelurahan::with('kecamatan')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kelurahan.create', [
            'kecamatan' => Kecamatan::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(KelurahanRequest $request)
    {

        Kelurahan::create($request->validated());

        return redirect()->route('kelurahan.index')->with('success', 'Data berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('kelurahan.show', [
            'kelurahan' => Kelurahan::with('kecamatan')->findOrFail($id),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('kelurahan.edit', [
            'kelurahan' => Kelurahan::with('kecamatan')->findOrFail($id),
            'kecamatan' => Kecamatan::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(KelurahanRequest $request, string $id)
    {
        $kelurahan = Kelurahan::findOrFail($id);
        $kelurahan->update($request->validated());

        return redirect()->route('kelurahan.index')->with('success', 'Data berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kelurahan = Kelurahan::findOrFail($id);

        $adaRumah = Rumah::where('kelurahan_id', $kelurahan->id)->exists();

        if ($adaRumah) {
            return redirect()->route('kelurahan.index')->with('error', 'Kelurahan tidak dapat dihapus karena masih memiliki data rumah.');
        }
        $kelurahan->delete();

        return redirect()->route('kelurahan.index')->with('success', 'Data kelurahan berhasil dihapus.');
    }
}
