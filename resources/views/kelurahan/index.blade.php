@extends('layouts.app')
@section('title','Data Kelurahan')
@section('content')

<div class="container py-4">
    <h2 class="text-center fw-bold mb-4">
        DATA KELURAHAN
    </h2>

     @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="float: right;"></button>
            </div>
        @endif

    <a href="{{ route('kelurahan.create') }}"
        class="btn btn-primary mb-3">
        Tambah Data
    </a>

    <table class="table table-bordered table-striped table-hover">
        <thead>
            <tr>
                <th width="90">No</th>
                <th>Nama Kelurahan</th>
                <th>Kecamatan</th>
                <th width="180">Aksi</th>
            </tr>
        </thead>

        <tbody>
        @forelse($kelurahan as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->nama_kelurahan }}</td>
                <td>{{ $item->kecamatan->nama_kecamatan }}</td>
                <td>
                    <a href="{{ route('kelurahan.edit',$item->id) }}"
                        class="btn btn-warning btn-sm">
                        Edit
                    </a>

                    <form
                        action="{{ route('kelurahan.destroy',$item->id) }}"
                        method="POST"
                        class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button
                            class="btn btn-danger btn-sm"
                            onclick="return confirm('Yakin ingin menghapus data ini?')">
                            Hapus
                        </button>
                    </form>
                </td>
            </tr>
        @empty

            <tr>
                <td colspan="4" class="text-center">
                    Belum ada data.
                </td>
            </tr>

        @endforelse

        </tbody>
    </table>
</div>

@endsection