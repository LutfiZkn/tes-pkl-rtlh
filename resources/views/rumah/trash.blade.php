@extends('layouts.app')
@section('title', 'Data Rumah Terhapus')
@section('content')

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>Data Rumah Terhapus</h3>

        <a href="{{ route('rumah.index') }}" class="btn btn-secondary">
            Kembali
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($rumah->count() > 0)

        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">

                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama Pemilik</th>
                        <th>NIK</th>
                        <th>Alamat</th>
                        <th>Kelurahan</th>
                        <th>Jumlah Foto</th>
                        <th>Dihapus Pada</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($rumah as $item)
                        <tr>
                            <td>
                                {{ $loop->iteration }}
                            </td>
                            <td>
                                {{ $item->nama_pemilik }}
                            </td>
                            <td>
                                {{ $item->nik }}
                            </td>
                            <td>
                                {{ $item->alamat }}
                            </td>
                            <td>
                                {{ $item->kelurahan->nama_kelurahan ?? '-' }}
                            </td>
                            <td>
                                {{ $item->fotoRumah->count() }} foto
                            </td>
                            <td>
                                {{ $item->deleted_at->format('d-m-Y H:i') }}
                            </td>

                            <td>
                                <div class="d-flex gap-2">
                                    {{-- Pulihkan --}}
                                    <form action="{{ route('rumah.restore', $item->id) }}" method="POST" onsubmit="return confirm('Pulihkan data rumah ini?')">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-success btn-sm">Pulihkan</button>
                                    </form>

                                    {{-- Hapus Permanen --}}
                                    <form action="{{ route('rumah.forceDelete', $item->id) }}" method="POST" onsubmit="return confirm('Data rumah beserta seluruh fotonya akan dihapus permanen dan tidak dapat dikembalikan. Yakin ingin melanjutkan?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Hapus Permanen</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else

        <div class="alert alert-info text-center">
            Tidak ada data rumah yang terhapus.
        </div>

    @endif
</div>
@endsection