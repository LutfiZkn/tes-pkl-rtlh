<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RumahRequest;
use App\Models\Rumah;
use App\Models\Kelurahan;

class RumahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $kondisi = $request->kondisi;

        $rumah = Rumah::with('kelurahan.kecamatan')
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('nama_pemilik', 'like', "%{$search}%")
                    ->orWhere('nik', 'like', "%{$search}%");
            });
        })
        ->when($kondisi, function ($query) use ($kondisi) {
                $query->where('kondisi', $kondisi);
            })
        ->latest()
        ->get();

        $totalRumah = Rumah::count();
        $rusakRingan = Rumah::where('kondisi', 'Rusak Ringan')->count();
        $rusakSedang = Rumah::where('kondisi', 'Rusak Sedang')->count();
        $rusakBerat = Rumah::where('kondisi', 'Rusak Berat')->count();
        return view('rumah.index', compact('rumah', 'totalRumah', 'rusakRingan', 'rusakSedang', 'rusakBerat'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kelurahan=Kelurahan::with('kecamatan')->get();
        return view('rumah.create', compact('kelurahan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RumahRequest $request)
    {
        Rumah::create($request->validated());
        return redirect()->route('rumah.index')->with('success', 'Data rumah berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $rumah = Rumah::findOrFail($id);
        $rumah->load('kelurahan.kecamatan');
        $kelurahan=Kelurahan::with('kecamatan')->get();

        return view('rumah.show', compact('rumah', 'kelurahan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $rumah = Rumah::findOrFail($id);
        $rumah->load('kelurahan.kecamatan');

        $kelurahan=Kelurahan::with('kecamatan')->get();

        return view('rumah.edit', compact('rumah', 'kelurahan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RumahRequest $request, Rumah $rumah)
    {
        $rumah->update($request->validated());

        return redirect()->route('rumah.index')->with('success', 'Data rumah berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $rumah = Rumah::findOrFail($id);
        $rumah->delete();

        return redirect()->route('rumah.index')->with('success', 'Data rumah berhasil dihapus.');
    }
}
