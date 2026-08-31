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

                    <!-- Long/Latitude -->
                     @if($rumah->latitude !== null && $rumah->longitude !== null)

                     <div class="mt-4">
                        <h5>Lokasi Rumah</h5>

                        <div class="row">
                            <div class="col-md-6">
                                <strong>Latitude</strong>
                                <p>{{ $rumah->latitude }}</p>
                            </div>

                            <div class="col-md-6">
                                <strong>Longitude</strong>
                                <p>{{ $rumah->longitude }}</p>
                            </div>
                        </div>
                     </div>

                     <!-- Map -->
                     <div class="mt-3">
                        <div class="mt-3">
                            <div
                                id="map"
                                data-latitude="{{ $rumah->latitude }}"
                                data-longitude="{{ $rumah->longitude }}"
                                data-nama-pemilik="{{ $rumah->nama_pemilik }}"
                                data-kondisi="{{ $rumah->kondisi }}"
                                data-status-verifikasi="{{ $rumah->status_verifikasi }}"
                                style="height: 400px;"
                                class="rounded border"
                            ></div>
                        </div>
                     </div>
                     @endif

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
                     <div class="d-flex justify-content-end mb-3">
                        <a href="{{ route('rumah.riwayat.create', $rumah) }}" class="btn btn-primary">Tambah Riwayat</a>
                    </div>
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

@if($rumah->latitude !== null && $rumah->longitude !== null)

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <script>
        const mapElement = document.getElementById('map');
        const latitude = Number(mapElement.dataset.latitude);
        const longitude = Number(mapElement.dataset.longitude);
        const namaPemilik = mapElement.dataset.namaPemilik;
        const kondisi = mapElement.dataset.kondisi;
        const statusVerifikasi = mapElement.dataset.statusVerifikasi;

        const map = L.map(mapElement).setView([latitude, longitude], 16);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        L.marker([latitude, longitude]).addTo(map)
            .bindPopup(
                '<strong>' + namaPemilik + '</strong><br>' +
                'Kondisi: ' + kondisi + '<br>' +
                'Status: ' + statusVerifikasi
            )
            .openPopup();
    </script>
@endif
@endsection