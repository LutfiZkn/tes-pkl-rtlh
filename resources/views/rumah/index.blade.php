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

        <div class="d-flex justify-content-between align-items-start mb-3">

        <div>
            <a href="{{ route('rumah.create') }}" class="btn btn-primary">
                Tambah Data
            </a>

            <div>
                <span class="badge bg-dark">Total: {{$totalRumah}}</span>
                <span class="badge bg-success">Rusak Ringan: {{$rusakRingan}}</span>
                <span class="badge bg-warning text-dark">Rusak Sedang: {{$rusakSedang}}</span>
                <span class="badge bg-danger">Rusak Berat: {{$rusakBerat}}</span>
            </div>
        </div>

            <form action="{{ route('rumah.index') }}" method="GET" class="d-flex">

                <input
                    type="text"
                    name="search"
                    class="form-control me-2"
                    placeholder="Cari Nama atau NIK"
                    value="{{ request('search') }}">

                <select name="kondisi" class="form-select me-2">
                    <option value="">Semua</option>

                    <option value="Rusak Ringan"
                        {{ request('kondisi') == 'Rusak Ringan' ? 'selected' : '' }}>
                        Rusak Ringan
                    </option>

                    <option value="Rusak Sedang"
                        {{ request('kondisi') == 'Rusak Sedang' ? 'selected' : '' }}>
                        Rusak Sedang
                    </option>

                    <option value="Rusak Berat"
                        {{ request('kondisi') == 'Rusak Berat' ? 'selected' : '' }}>
                        Rusak Berat
                    </option>
                </select>

                <button type="submit" class="btn btn-success">
                    Cari
                </button>

            </form>

        </div>

        <table class="table table-striped table-hover table-bordered">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama Pemilik</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">Kelurahan</th>
                    <th scope="col">Kecamatan</th>
                    <th scope="col">Kondisi</th>
                    <th scope="col">Tahun Pendataan</th>
                    <th scope="col">Aksi</th>
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
                        <td>{{ $item->kondisi }}</td>
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
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center">Belum ada data rumah</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        
        <div class="mt-3">
            {{ $rumah->links() }}
        </div>
        
    </div>

    @endsection

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>