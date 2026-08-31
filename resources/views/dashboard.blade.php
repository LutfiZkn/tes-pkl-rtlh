@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<div class="container-fluid py-4">

    <!-- Header -->
    <div class="mb-4">
        <h2 class="fw-bold mb-1">Dashboard</h2>
        <p class="text-muted mb-0">
            Halo {{ Auth::user()->name }}, Selamat Datang
        </p>
    </div>

    <!-- Stat Kondisi -->
    <div class="row g-3 mb-4">

        {{-- Total --}}
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted mb-1">Total Rumah</p>
                            <h2 class="fw-bold mb-0">{{ $totalRumah }}</h2>
                        </div>
                        <div class="bg-primary text-white rounded-circle p-3">
                            <i class="bi bi-house-door fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Kondisi Rusak Ringan -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted mb-1">Rusak Ringan</p>
                            <h2 class="fw-bold mb-0">{{ $rusakRingan }}</h2>
                        </div>
                        <span class="badge bg-success fs-6 p-3">
                            Ringan
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sedang -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted mb-1">Rusak Sedang</p>
                            <h2 class="fw-bold mb-0">{{ $rusakSedang }}</h2>
                        </div>
                        <span class="badge bg-warning text-dark fs-6 p-3">
                            Sedang
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Berat -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted mb-1">Rusak Berat</p>
                            <h2 class="fw-bold mb-0">{{ $rusakBerat }}</h2>
                        </div>
                        <span class="badge bg-danger fs-6 p-3">
                            Berat
                        </span>
                    </div>
                </div>
            </div>
        </div>

    </div>


    <!-- Verifikasi -->
    <div class="card border-0 shadow-sm mb-4">

        <div class="card-header bg-white border-0 pt-4 px-4">
            <h5 class="fw-bold mb-0">Status Verifikasi</h5>
        </div>

        <div class="card-body px-4">

            <div class="row g-3">

                <div class="col-md-4">
                    <div class="border rounded p-3">
                        <div class="d-flex justify-content-between">
                            <span>Belum Diverifikasi</span>
                            <span class="badge bg-warning text-dark">
                                {{ $belumDiverifikasi }}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="border rounded p-3">
                        <div class="d-flex justify-content-between">
                            <span>Terverifikasi</span>
                            <span class="badge bg-success">
                                {{ $terverifikasi }}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="border rounded p-3">
                        <div class="d-flex justify-content-between">
                            <span>Ditolak</span>
                            <span class="badge bg-danger">
                                {{ $ditolak }}
                            </span>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>


    <div class="row mt-4">
    <!-- Grafik Kondisi Rumah -->
        <div class="card border-0 shadow-sm">

            <div class="card-header bg-white border-0 pt-4 px-4">
                <h5 class="fw-bold mb-0">Grafik Kondisi Rumah</h5>
                <small class="text-muted">
                    Jumlah rumah berdasarkan kondisi
                </small>
            </div>

            <div class="card-body px-4">

                <div style="height: 350px;">
                    <canvas
                        id="kondisiChart"
                        data-ringan="{{ $rusakRingan }}"
                        data-sedang="{{ $rusakSedang }}"
                        data-berat="{{ $rusakBerat }}"
                    ></canvas>
                </div>
            </div>
        </div>

        <!-- Grafik Status Verifikasi -->
        <div class="card border-0 shadow-sm mt-4">
            <div class="card-header bg-white border-0 pt-4 px-4">
                <h5 class="fw-bold mb-0">Grafik Status Verifikasi</h5>
                <small class="text-muted">
                   Rasio Status Verifikasi Pada Data Rumah
                </small>
            </div>
            <div class="card-body px-4">
                <div style="height: 350px;">
                    <canvas
                        id="statusChart"
                        data-belum="{{ $belumDiverifikasi }}"
                        data-terverifikasi="{{ $terverifikasi }}"
                        data-ditolak="{{ $ditolak }}"
                    ></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm mt-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Peta Sebaran RTLH</h5>
            <a href="{{ route('peta.index') }}" class="btn btn-primary">
                Lihat Peta >
            </a>
        </div>

        <div class="card-body p-0">
            <div id="mapDashboard" style="height: 400px;"></div>
        </div>
    </div>

@vite('resources/js/dashboard.js')

</div>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
    const rumahDashboard = @json($rumahPeta);
    const mapDashboard = L.map('mapDashboard').setView([-0.502106, 117.153709], 12);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(mapDashboard);

    rumahDashboard.forEach(item => {
        const marker = L.marker([
            Number(item.latitude),
            Number(item.longitude)
        ]).addTo(mapDashboard);

        marker.bindPopup(`
        <strong>${item.nama_pemilik}</strong><br>
        Kondisi: ${item.kondisi}<br>
        Status: ${item.status_verifikasi}
        `);
    });
</script>

@endsection