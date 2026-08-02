@extends('layouts.app')

@section('title', 'Data Kecamatan')

@section('content')

<div class="container py-4">

    <h2 class="text-center fw-bold mb-4">DATA KECAMATAN</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('kecamatan.create') }}" class="btn btn-primary mb-3">Tambah Data</a>

    <table class="table table-bordered table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th width="90">No</th>
                <th>Nama Kecamatan</th>
                <th width="180">Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse($kecamatan as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->nama_kecamatan }}</td>
                    <td>
                        <a href="{{ route('kecamatan.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>

                        <form action="{{ route('kecamatan.destroy', $item->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center">Belum Ada Data</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection