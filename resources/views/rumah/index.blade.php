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

            <a href="{{ route('rumah.trash') }}" class="btn btn-danger">
                Data Terhapus
            </a>

            <div>
                <span class="badge bg-dark">Total: {{$totalRumah}}</span>
                <span class="badge bg-success">Rusak Ringan: {{$rusakRingan}}</span>
                <span class="badge bg-warning text-dark">Rusak Sedang: {{$rusakSedang}}</span>
                <span class="badge bg-danger">Rusak Berat: {{$rusakBerat}}</span>
            </div>
        </div>

            <form action="{{ route('rumah.index') }}" method="GET" class="row g-2 justify-content-end">

            <!-- Search Nama/NIK -->
            <div class="col-md-3">
                <input
                        type="text"
                        name="search"
                        class="form-control"
                        placeholder="Cari Nama atau NIK"
                        value="{{ request('search') }}">
            </div>
            
            <!-- Search Kecamatan -->
             <div class="col-md-2">
                <select name="kecamatan" class="form-select"><option value="">Semua Kecamatan</option>
                    @foreach($daftarKecamatan as $item)
                    <option value="{{ $item->id }}"
                     {{ request('kecamatan') == $item->id ? 'selected' : '' }}>
                     {{ $item->nama_kecamatan }}
                    </option>
                    @endforeach
                </select>
             </div>

             <!-- Search Kelurahan -->
             <div class="col-md-2">
                <select name="kelurahan" class="form-select">
                    <option value="">Semua Kelurahan</option>
                    @foreach($daftarKelurahan as $item)
                        <option value="{{ $item->id }}"
                            {{ request('kelurahan') == $item->id ? 'selected' : '' }}>
                            {{ $item->nama_kelurahan }}
                        </option>
                    @endforeach
                </select>
             </div>


             <!-- Search Kondisi -->
             <div class="col-md-2">    
                 <select name="kondisi" class="form-select">
                     <option value="">Semua Kondisi</option>
 
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
             </div>

             <!-- Search Tahun -->
             <div class="col-md-2">
                <select name="tahun_pendataan" class="form-select"><option value="">Semua Tahun</option>

                    @for($tahun = date('Y'); $tahun >= 2000; $tahun--)
                    <option value="{{ $tahun }}"
                        {{ request('tahun_pendataan') == $tahun ? 'selected' : '' }}>
                        {{ $tahun }}
                    </option>
                    @endfor
                </select>
             </div>

             <!-- Search Status -->
             <div class="col-md-2">
                <select name="status_verifikasi" class="form-select">
                    <option value="">Semua Status</option>

                    <option value="Terverifikasi"
                        {{ request('status_verifikasi') == 'Terverifikasi' ? 'selected' : '' }}>
                        Terverifikasi
                    </option>

                    <option value="Belum Terverifikasi"
                        {{ request('status_verifikasi') == 'Belum Terverifikasi' ? 'selected' : '' }}>
                        Belum Terverifikasi
                    </option>

                    <option value="Ditolak"
                        {{ request('status_verifikasi') == 'Ditolak' ? 'selected' : '' }}>
                        Ditolak
                    </option>
                </select>
             </div>

             <!-- Sorting -->
              <div class="col-md-2">
                <select name="sorting" class="form-select">
                    <option value="terlama"
                        {{ request('sorting', 'terlama')== 'terlama' ? 'selected' : '' }}>
                        Terlama
                    </option>

                    <option value="terbaru"
                        {{ request('sorting') == 'terbaru' ? 'selected' : '' }}>
                        Terbaru
                    </option>

                    <option value="nama_az"
                        {{ request('sorting') == 'nama_az' ? 'selected' : '' }}>
                        Nama A-Z
                    </option>

                    <option value="nama_za"
                        {{ request('sorting') == 'nama_za' ? 'selected' : '' }}>
                        Nama Z-A
                    </option>
                </select>
              </div>


             <div class="col-md-2">
                <button type="submit" class="btn btn-success">
                    Cari
                </button>
                <a href="{{ route('rumah.index') }}" class="btn btn-danger">
                    Hapus
                </a>
             </div>

            </form>

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