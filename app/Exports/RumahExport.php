<?php

namespace App\Exports;

use App\Models\Rumah;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class RumahExport implements FromCollection, WithHeadings, WithMapping
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function collection(): Collection
    {
        $request = $this->request;

        return Rumah::with('kelurahan.kecamatan')

        // Search Nama / NIK
            ->when($request->search, function ($query) use ($request) {
                $query->where(function ($q) use ($request) {
                    $q->where('nama_pemilik', 'like', '%' . $request->search . '%')
                      ->orWhere('nik', 'like', '%' . $request->search . '%');
                });
            })

            // Filter Kondisi
            ->when($request->kondisi, function ($query) use ($request) {
                $query->where('kondisi', $request->kondisi);
            })

            // Filter Kecamatan
            ->when($request->kecamatan, function ($query) use ($request) {
                $query->whereHas('kelurahan', function ($q) use ($request) {
                    $q->where('kecamatan_id', $request->kecamatan);
                });
            })

            // Filter Kelurahan
            ->when($request->kelurahan, function ($query) use ($request) {
                $query->where('kelurahan_id', $request->kelurahan);
            })

            // Filter Tahun
            ->when($request->tahun_pendataan, function ($query) use ($request) {
                $query->where('tahun_pendataan', $request->tahun_pendataan);
            })

            // Filter Status
            ->when($request->status_verifikasi, function ($query) use ($request) {
                $query->where('status_verifikasi', $request->status_verifikasi);
            })

             // Sorting
            ->when($request->sorting, function ($query) use ($request) {
                switch ($request->sorting) {
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
            }, function ($query) {
                $query->latest();
            })

            ->get();
    }

     public function headings(): array
    {
        return [
            'Nama Pemilik',
            'NIK',
            'Alamat',
            'Kelurahan',
            'Kecamatan',
            'Kondisi',
            'Tahun Pendataan',
            'Status Verifikasi',
            'Keterangan',
        ];
    }

    public function map($rumah): array
    {
        return [
            $rumah->nama_pemilik,
            $rumah->nik,
            $rumah->alamat,
            $rumah->kelurahan->nama_kelurahan ?? '-',
            $rumah->kelurahan->kecamatan->nama_kecamatan ?? '-',
            $rumah->kondisi,
            $rumah->tahun_pendataan,
            $rumah->status_verifikasi,
            $rumah->keterangan ?? '-',
        ];
    }
}