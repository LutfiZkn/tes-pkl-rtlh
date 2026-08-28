<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RumahRequest;
use App\Models\Rumah;
use App\Models\Kecamatan;
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
        $kecamatan = $request->kecamatan;
        $kelurahan = $request->kelurahan;
        $tahun = $request->tahun_pendataan;
        $status = $request->status_verifikasi;
        $sorting = $request->sorting;

        $rumah = Rumah::with('kelurahan.kecamatan')

        //Search Nama/NIK
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('nama_pemilik', 'like', "%{$search}%")
                    ->orWhere('nik', 'like', "%{$search}%");
            });
        })

        //Filter Kondisi
        ->when($kondisi, function ($query) use ($kondisi) {
                $query->where('kondisi', $kondisi);
        })

        //Filter Kecamatan
        ->when($kecamatan, function ($query) use ($kecamatan) {
                $query->whereHas('kelurahan', function ($q) use ($kecamatan) {
                    $q->where('kecamatan_id', $kecamatan);
                });
        })

        //Filter Kelurahan
        ->when($kelurahan, function ($query) use ($kelurahan) {
                $query->where('kelurahan_id', $kelurahan);
        })

        //Filter Tahun Pendataan
        ->when($tahun, function ($query) use ($tahun) {
                $query->where('tahun_pendataan', $tahun);
        })

        //Filter Status Verifikasi
        ->when($status, function ($query) use ($status) {
                $query->where('status_verifikasi', $status);
        })

        ->when($sorting, function ($query) use ($sorting) {
            switch ($sorting) {
                case 'terlama':
                    $query->oldest();
                    break;
                case 'nama_az':
                    $query->orderBy('nama_pemilik', 'asc');
                    break;
                case 'nama_za':
                    $query->orderBy('nama_pemilik', 'desc');
                    break;
                case 'terbaru':
                default:
                    $query->latest();
                    break;
            }
        })
        ->paginate(10)
        ->withQueryString();

        //Statistik
        $totalRumah = Rumah::count();
        $rusakRingan = Rumah::where('kondisi', 'Rusak Ringan')->count();
        $rusakSedang = Rumah::where('kondisi', 'Rusak Sedang')->count();
        $rusakBerat = Rumah::where('kondisi', 'Rusak Berat')->count();

        $daftarKecamatan = Kecamatan::orderBy('nama_kecamatan')->get();
        $daftarKelurahan = Kelurahan::orderBy('nama_kelurahan')->get();
        
        return view('rumah.index', compact('rumah', 'kecamatan', 'kelurahan', 'daftarKecamatan', 'daftarKelurahan', 'totalRumah', 'rusakRingan', 'rusakSedang', 'rusakBerat'));

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
        $data = $request->validated();

        unset($data['foto']);
        
        //Data baru = blum diverifikasi
        $data['status_verifikasi'] = 'Belum diverifikasi';
        $data['alasan_penolakan'] = null;

        $rumah = Rumah::create($data);

        //riwayat
        $rumah->riwayatRumah()->create([
            'user_id' => Auth::id(),
            'kondisi' => $rumah->kondisi,
            'tanggal_survei' => now(),
            'keterangan' => $rumah->keterangan,
        ]);

        if ($request->hasFile('foto')) {
            foreach ($request->file('foto') as $file) {
                $path = $file->store('foto-rumah', 'public');
                $rumah->fotoRumah()->create(['nama_file' => $file->getClientOriginalName(), 'path' => $path]);
            }
        }
        return redirect()->route('rumah.index')->with('success', 'Data rumah berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $rumah = Rumah::findOrFail($id);
        $rumah->load(['kelurahan.kecamatan', 'fotoRumah', 'riwayatRumah.user',]);
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
        $data = $request->validated();

        unset($data['foto']);

        //kondisi lama
        $kondisiLama = $rumah->kondisi;

        $rumah->update($data);

        //riwayat
        if ($kondisiLama !== $rumah->kondisi){
            $rumah->riwayatRumah()->create([
                'user_id' => Auth::id(),
                'kondisi' => $rumah->kondisi,
                'tanggal_survei' => now(),
                'keterangan' => $rumah->keterangan,
            ]);
        }

        if ($request->hasFile('foto')) {
            foreach ($request->file('foto') as $file) {
                $path = $file->store('foto-rumah', 'public');
                $rumah->fotoRumah()->create([
                    'nama_file' => $file->getClientOriginalName(),
                    'path' => $path,
                ]);
            }
        }

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

    public function forceDelete($id)
    {
        $rumah = Rumah::onlyTrashed()->findOrFail($id);
        $rumah->forceDelete();

        return redirect()->route('rumah.trash')->with('success', 'Data rumah berhasil dihapus permanen.');
    }

    public function trash()
    {
        $rumah = Rumah::onlyTrashed()
        ->with(['kelurahan', 'fotoRumah'])
        ->latest('deleted_at')
        ->get();
        return view('rumah.trash', compact('rumah'));
    }

    public function restore($id)
    {
        $rumah = Rumah::onlyTrashed()->findOrFail($id);
        $rumah->restore();

        return redirect()->route('rumah.trash')->with('success', 'Data rumah berhasil dikembalikan.');
    }

    public function updateVerifikasi(Request $request, Rumah $rumah)
    {
        $request->validate([
            'status_verifikasi' => 'required|in:Belum diverifikasi,Terverifikasi,Ditolak',
            'alasan_penolakan' => 'nullable|string|max:1000',
        ]);

        if ($request->status_verifikasi === 'Ditolak') {
            $request->validate([
                'alasan_penolakan' => 'required|string|max:1000',
            ]);
        }

        $rumah->update([
            'status_verifikasi' => $request->status_verifikasi,
            'alasan_penolakan' => $request->status_verifikasi === 'Ditolak' ? $request->alasan_penolakan : null,
        ]);

        return redirect()->route('rumah.show', $rumah)->with('success', 'Data rumah berhasil diperbarui.');
    }

    public function storeRiwayat(Request $request, Rumah $rumah)
    {
        $request->vaidate([
            'kondisi' => 'required|in:Rusak Ringan,Rusak Sedang,Rusak Berat',
            'tanggal_survei' => 'required|date',
            'keterangan' => 'nullable|string|max:1000',
        ]);

        $rumah->riwayatRumah()->create([
            'user_id' => Auth::id(),
            'kondisi' => $request->kondisi,
            'tanggal_survei' => $request->tanggal_survei,
            'keterangan' => $request->keterangan,
        ]);

        //upd kondisi utama
        $rumah->update([
            'kondisi' => $request->kondisi,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('rumah.show', $rumah)->with('success', 'Data riwayat berhasil disimpan.');
    }
}