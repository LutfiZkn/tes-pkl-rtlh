@extends('layouts.app')

@section('title', 'Peta Sebaran Rumah')

@section('content')

<div class="container py-4">
    <h2 class="fw-bold mb-4">PETA SEBARAN RTLH</h2>

    <div class="card shadow-sm">
        <div class="card-header">
            <h5 class="mb-0">Lokasi Rumah</h5>
        </div>

        <div class="card-body pt-4">
            <form method="GET" action="{{ route('peta.index') }}" class="mb-4">
                <div class="row g-3 align-items-end">
                    <div class="col-md-5">
                        <label class="form-label fw-semibold">Kondisi</label>
                        <select name="kondisi" class="form-select">
                            <option value="">Semua</option>
                            <option value="Rusak Ringan" {{ request('kondisi') == 'Rusak Ringan' ? 'selected' : '' }}>Rusak Ringan</option>
                            <option value="Rusak Sedang" {{ request('kondisi') == 'Rusak Sedang' ? 'selected' : '' }}>Rusak Sedang</option>
                            <option value="Rusak Berat" {{ request('kondisi') == 'Rusak Berat' ? 'selected' : '' }}>Rusak Berat</option>
                        </select>
                    </div>

                    <div class="col-md-5">
                        <label class="form-label fw-semibold">Status Verifikasi</label>
                        <select name="status_verifikasi" class="form-select">
                            <option value="">Semua</option>
                            <option value="Belum diverifikasi" {{ request('status_verifikasi') == 'Belum diverifikasi' ? 'selected' : '' }}>Belum Diverifikasi</option>
                            <option value="Terverifikasi" {{ request('status_verifikasi') == 'Terverifikasi' ? 'selected' : '' }}>Terverifikasi</option>
                            <option value="Ditolak" {{ request('status_verifikasi') == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                        </select>
                    </div>

                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100">Filter</button>
                    </div>
                </div>
            </form>

            <div id="mapSebaran" style="height: 600px; width: 100%;" class="rounded border"></div>
        </div>
    </div>
</div>

<!-- Leaflet -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
    const rumah = @json($rumah);
    const map = L.map('mapSebaran').setView([-0.502106, 117.153709], 12);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    const legend = L.control({ position: 'bottomright' });

    legend.onAdd = function () {
        const div=L.DomUtil.create('div');

        div.style.backgroundColor = '#ffffff';
        div.style.borderRadius = '6px';
        div.style.padding = '10px 12px';
        div.style.boxShadow = '0 1px 5px rgba(0,0,0,0.3)';
        div.style.lineHeight = '1.8';

         div.innerHTML = 
         ` <strong>Kondisi Rumah</strong><br>
            <span style="color: green;">●</span> Rusak Ringan<br>
            <span style="color: orange;">●</span> Rusak Sedang<br>
            <span style="color: red;">●</span> Rusak Berat`;

        return div;
    };

    legend.addTo(map);

    rumah.forEach(item => {
        let warna;
        if(item.kondisi === 'Rusak Berat') {
            warna = 'red';
        } else if(item.kondisi === 'Rusak Sedang') {
            warna = 'orange';
        } else {
            warna = 'green';
        }

        const marker = L.circleMarker([
            Number(item.latitude),
            Number(item.longitude)
        ], {
            radius: 7,
            color: '#ffffff',
            weight: 2,
            fillColor: warna,
            fillOpacity: 0.9,
            opacity: 1
        }).addTo(map);

        marker.bindPopup(`
            <strong>${item.nama_pemilik}</strong><br>
            Kondisi: ${item.kondisi}<br>
            Status: ${item.status_verifikasi}
            Kelurahan: ${item.kelurahan?.nama_kelurahan ?? '-'}<br>
            Kecamatan: ${item.kelurahan?.kecamatan?.nama_kecamatan ?? '-'}`);
    })
</script>

@endsection