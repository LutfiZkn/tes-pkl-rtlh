@extends('layouts.app')

@section('title', 'Detail Rumah')

@section('content')

@php
    $readonly = true;
@endphp

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">

            <div class="card shadow border-0">

                <div class="card-header bg-info text-white text-center">
                    <h4 class="mb-0">Detail Data Rumah</h4>
                </div>

                <div class="card-body">

                    @include('rumah.form')

                    <div class="d-flex justify-content-end mb-3">
                        <a href="{{ route('rumah.riwayat.create', $rumah) }}" class="btn btn-primary">Tambah Riwayat</a>
                    </div>

                    <!-- Foto Rumah -->
                    @if ($rumah->fotoRumah->isNotEmpty())
                        <div class="mt-4">
                            <h5>Foto Rumah</h5>
                            <div class="row g-3">
                                @foreach ($rumah->fotoRumah as $foto)
                                    <div class="col-6">
                                        <a href="{{ asset('storage/' . $foto->path) }}" target="_blank" rel="noopener">
                                            <img
                                                src="{{ asset('storage/' . $foto->path) }}"
                                                alt="{{ $foto->nama_file }}"
                                                class="img-fluid rounded border"
                                            >
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Histori Verif -->
                     <hr class="my-4">
                     <h5 class="mb-3">Riwayat Kondisi</h5>
                     @if ($rumah->riwayatRumah->isNotEmpty())

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal Survey</th>
                                        <th>Kondisi</th>
                                        <th>Keterangan</th>
                                        <th>Petugas</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($rumah->riwayatRumah->sortByDesc('tanggal_survei') as $riwayat)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $riwayat->tanggal_survei->format('d-m-y') }}</td>
                                            <td>
                                                @if($riwayat->kondisi == 'Rusak Ringan') 
                                                    <span class="badge bg-success">Rusak Ringan</span>
                                                @elseif($riwayat->kondisi == 'Rusak Sedang') 
                                                    <span class="badge bg-warning text-dark">Rusak Sedang</span>
                                                @else 
                                                    <span class="badge bg-danger">Rusak Berat</span>
                                                @endif
                                            </td>
                                            <td>{{ $riwayat->keterangan ?? '-' }}</td>
                                            <td>{{ $riwayat->user?->name ?? '-' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @else
                            <div class="alert alert-secondary">Belum ada riwayat survei</div>
                        @endif

                    <!-- Status Verif -->
                    <div class="mt-4">
                        <h5>Status Verifikasi</h5>
                        
                        @if ($rumah->status_verifikasi == 'Terverifikasi')
                            <span class="badge bg-success">Terverifikasi</span>
                        @elseif ($rumah->status_verifikasi == 'Ditolak')
                            <span class="badge bg-danger">Ditolak</span>
                        @else
                            <span class="badge bg-warning text-dark">Belum diverifikasi</span>
                        @endif
                    </div>

                    <!-- Alasan Ditolak -->
                    @if (
                        $rumah->status_verifikasi == 'Ditolak' &&
                        $rumah->alasan_penolakan
                    )
                        <div class="alert alert-danger mt-3">
                            <strong>Alasan Penolakan:</strong><br>{{ $rumah->alasan_penolakan }}
                        </div>
                    @endif

                    <!-- Form Admin -->
                     @if(auth ()->user()->role === 'Admin')

                        <div class="card mt-4">

                            <div class="card-header">
                                <strong>Verifikasi Data Rumah</strong>
                            </div>

                            <div class="card-body">
                                <form action="{{ route('rumah.verifikasi', $rumah) }}" method="POST">
                                    @csrf
                                    @method('PATCH')

                                    <div class="mb-3">
                                        <label for="status_verifikasi" class="form-label">
                                            Status Verifikasi
                                        </label>

                                        <select name="status_verifikasi" id="status_verifikasi" class="form-select" required>

                                            <option value="Belum diverifikasi" {{ $rumah->status_verifikasi === 'Belum diverifikasi' ? 'selected' : '' }}>
                                                Belum diverifikasi
                                            </option>

                                            <option value="Terverifikasi" {{ $rumah->status_verifikasi === 'Terverifikasi' ? 'selected' : '' }}>
                                                Terverifikasi
                                            </option>

                                            <option value="Ditolak" {{ $rumah->status_verifikasi === 'Ditolak' ? 'selected' : '' }}>
                                                Ditolak
                                            </option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="alasan_penolakan" class="form-label">
                                            Alasan Penolakan
                                        </label>

                                        <textarea name="alasan_penolakan" id="alasan_penolakan" class="form-control" rows="3" placeholder="Isi alasan jika ditolak">{{ old('alasan_penolakan', $rumah->alasan_penolakan) }}</textarea>
                                    </div>

                                    <div class="d-grid gap-2">
                                        <button type="submit" class="btn btn-primary">
                                            Verifikasi
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endif
                    
                    <div class="d-grid gap-2 mt-3">
                        <a href="{{ route('rumah.index') }}" class="btn btn-secondary btn-lg">
                            Kembali
                        </a>
                    </div>

                </div>

            </div>

        </div>
    </div>
</div>

@endsection