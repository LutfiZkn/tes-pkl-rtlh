<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>

    @extends('layouts.app')
    @section('title', 'Data Rumah')
    @section('content')

    <div class="container py-4">
        <h2 class="text-center fw-bold mb-4">PENDATAAN KONDISI RUMAH</h2>

        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="float: right;"></button>
            </div>
        @endif


        <div class="mx-auto mb-4" style="max-width: 1200px; width: 100%;">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white d-flex justify-content-between align-items-center flex-wrap gap-2">
                    <h5 class="fw-bold mb-0">Ringkasan Data Rumah</h5>

                    <!-- Button Tambah/Sampah -->
                    <div class="d-flex gap-2">
                        <a href="{{ route('rumah.create') }}" class="btn btn-primary btn-sm">
                            Tambah Data
                        </a>
                        <a href="{{ route('rumah.trash') }}" class="btn btn-danger btn-sm">
                            Data Terhapus
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row g-3 justify-content-center">
                        <div class="col-6 col-md-3">
                            <div class="border rounded p-3 text-center h-100">
                                <div class="text-muted small">Total Rumah</div>
                                <div class="fs-3 fw-bold">{{ $totalRumah }}</div>
                            </div>
                        </div>

                        <div class="col-6 col-md-3">
                            <div class="border rounded p-3 text-center h-100">
                                <div class="text-muted small">Rusak Ringan</div>
                                <div class="fs-3 fw-bold">{{ $rusakRingan }}</div>
                            </div>
                        </div>

                        <div class="col-6 col-md-3">
                            <div class="border rounded p-3 text-center h-100">
                                <div class="text-muted small">Rusak Sedang</div>
                                <div class="fs-3 fw-bold">{{ $rusakSedang }}</div>
                            </div>
                        </div>

                        <div class="col-6 col-md-3">
                            <div class="border rounded p-3 text-center h-100">
                                <div class="text-muted small">Rusak Berat</div>
                                <div class="fs-3 fw-bold">{{ $rusakBerat }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter Data -->
        <div class="card shadow-sm border-0 mb-4">

            <div class="card-header bg-white">
                <h5 class="fw-bold mb-0">Filter Data Rumah</h5>
            </div>

            <div class="card-body">
                <form action="{{ route('rumah.index') }}" method="GET">

                    <div class="row g-3">

                        <!-- Search -->
                        <div class="col-md-4">
                            <label class="form-label">Cari Nama / NIK</label>
                            <input
                             type="text"
                             name="search"
                             class="form-control"
                             placeholder="Masukkan Nama / NIK"
                             value="{{ request('search') }}">
                        </div>

                        <!-- Kecamatan -->
                        <div class="col-md-2">
                            <label class="form-label">Kecamatan</label>
                            <select name="kecamatan" class="form-select">
                                <option value="">Semua</option>

                                @foreach($daftarKecamatan ?? [] as $item)
                                    <option value="{{ $item->id }}" {{ request('kecamatan') == $item->id ? 'selected' : '' }}>
                                        {{ $item->nama_kecamatan }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Kelurahan -->
                        <div class="col-md-2">
                            <label class="form-label">Kelurahan</label>
                            <select name="kelurahan" class="form-select">
                                <option value="">Semua</option>

                                @foreach($daftarKelurahan ?? [] as $item)
                                    <option value="{{ $item->id }}" {{ request('kelurahan') == $item->id ? 'selected' : '' }}>
                                        {{ $item->nama_kelurahan }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Kondisi -->
                        <div class="col-md-2">
                            <label class="form-label">Kondisi</label>
                            <select name="kondisi" class="form-select">
                                <option value="">Semua</option>
                                <option value="rusak ringan" {{ request('kondisi') == 'rusak ringan' ? 'selected' : '' }}>
                                    Rusak Ringan
                                </option>
                                <option value="rusak sedang" {{ request('kondisi') == 'rusak sedang' ? 'selected' : '' }}>
                                    Rusak Sedang
                                </option>
                                <option value="rusak berat" {{ request('kondisi') == 'rusak berat' ? 'selected' : '' }}>
                                    Rusak Berat
                                </option>
                            </select>
                        </div>

                        <!-- Tahun -->
                        <div class="col-md-2">
                            <label class="form-label">Tahun</label>
                            <input
                            type="number"
                            name="tahun_pendataan"
                            class="form-control"
                            min="2000"
                            max="{{ date('Y') }}"
                            placeholder="Masukkan tahun pendataan"
                            value="{{ request('tahun_pendataan',) }}">
                        </div>

                        <script>
                            document.addEventListener('DOMContentLoaded', function () {
                                const yearFilter = document.querySelector('input[name="tahun_pendataan"]');

                                if (!yearFilter) {
                                    return;
                                }

                                yearFilter.addEventListener('invalid', function (event) {
                                    event.preventDefault();

                                    if (Number(yearFilter.value) < 2000) {
                                        yearFilter.setCustomValidity('Tahun pendataan minimal adalah 2000.');
                                    } else if (Number(yearFilter.value) > Number(new Date().getFullYear())) {
                                        yearFilter.setCustomValidity('Tahun pendataan tidak boleh lebih dari tahun saat ini.');
                                    } else {
                                        yearFilter.setCustomValidity('');
                                    }

                                    yearFilter.reportValidity();
                                });

                                yearFilter.addEventListener('input', function () {
                                    yearFilter.setCustomValidity('');
                                });
                            });
                        </script>

                        <!-- Status -->
                        <div class="col-md-2">
                            <label class="form-label">Status</label>
                            <select name="status_verifikasi" class="form-select">
                                <option value="">Semua</option>
                                <option value="Belum diverifikasi" {{ request('status_verifikasi') == 'Belum diverifikasi' ? 'selected' : '' }}>
                                    Belum diverifikasi
                                </option>
                                <option value="Terverifikasi" {{ request('status_verifikasi') == 'Terverifikasi' ? 'selected' : '' }}>
                                    Terverifikasi
                                </option>
                                <option value="Ditolak" {{ request('status_verifikasi') == 'Ditolak' ? 'selected' : '' }}>
                                    Ditolak
                                </option>
                            </select>
                        </div>

                        <!-- Sorting -->
                        <div class="col-md-3">
                            <label class="form-label">Urutkan</label>
                            <select name="sorting" class="form-select">
                                <option value="terbaru" {{ request('sorting') == 'terbaru' ? 'selected' : '' }}>
                                    Terbaru
                                </option>
                                <option value="terlama" {{ request('sorting') == 'terlama' ? 'selected' : '' }}>
                                    Terlama
                                </option>
                                <option value="nama_az" {{ request('sorting') == 'nama_az' ? 'selected' : '' }}>
                                    Nama A-Z
                                </option>
                                <option value="nama_za" {{ request('sorting') == 'nama_za' ? 'selected' : '' }}>
                                    Nama Z-A
                                </option>
                            </select>
                        </div>

                        <!-- Button -->
                        <div class="col-md-7 d-flex justify-content-end align-items-end gap-2">
                            <button type="submit" class="btn btn-success">Cari</button>
                            <a href="{{ route('rumah.index') }}" class="btn btn-secondary">Reset</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <table class="table table-striped table-hover table-bordered">
            <thead>
                <tr>
                    <th scope="col" style="width: 50px">No</th>
                    <th scope="col" style="width: 150px">Nama Pemilik</th>
                    <th scope="col" style="width: 250px">Alamat</th>
                    <th scope="col" style="width: 160px">Kelurahan</th>
                    <th scope="col" style="width: 160px">Kecamatan</th>
                    <th scope="col" style="width: 140px">Kondisi</th>
                    <th scope="col" style="width: 150px">Tahun Pendataan</th>
                    <th scope="col" style="width: 250px">Aksi</th>
                    <th scope="col" style="width: 150px">Status</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($rumah as $item)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $item->nama_pemilik }}</td>
                        <td>{{ $item->alamat }}</td>
                        <td>{{ $item->kelurahan?->nama_kelurahan ?? '-' }}</td>
                        <td>{{ $item->kelurahan?->kecamatan?->nama_kecamatan ?? '-' }}</td>
                        <td>
                            @if($item->kondisi == 'Rusak Ringan') 
                                <span class="badge bg-success">{{$item->kondisi}}</span>
                            @elseif($item->kondisi == 'Rusak Sedang') 
                                <span class="badge bg-warning text-dark">{{$item->kondisi}}</span>
                            @else 
                                <span class="badge bg-danger">{{$item->kondisi}}</span>
                            @endif
                        </td>
                        <td>{{ $item->tahun_pendataan }}</td>
                        <td>
                            <a href="{{ route('rumah.show', $item->id) }}" class="btn btn-primary btn-sm">Detail</a>
                            <a href="{{ route('rumah.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('rumah.destroy', $item->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
                            </form>
                        </td>
                        
                            <td>
                                @if($item->status_verifikasi === 'Terverifikasi')
                                    <span class="badge bg-success">Terverifikasi</span>
                                @elseif($item->status_verifikasi === 'Ditolak')
                                    <span class="badge bg-danger">Ditolak</span>
                                @else
                                    <span class="badge bg-warning text-dark">Belum Terverifikasi</span>
                                @endif
                            </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center">Belum ada data rumah</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        
        <!-- Pagination -->
        <div class="mt-3">
            {{ $rumah->links() }}
        </div>

    </div>

    @endsection

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>