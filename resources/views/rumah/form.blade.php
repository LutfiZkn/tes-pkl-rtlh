<!-- Nama -->
<div class="mb-3">
    <label for="nama_pemilik" class="form-label">Nama Lengkap</label>
    <input type="text"
    class="form-control @error('nama_pemilik') is-invalid @enderror"
    id="nama_pemilik"
    name="nama_pemilik"
    value="{{ old('nama_pemilik', $rumah->nama_pemilik ??'') }}" 
     {{ isset($readonly) ? 'readonly' : '' }}
    placeholder="Masukkan nama" required>

    @error('nama_pemilik')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<!-- NIK -->
<div class="mb-3">
    <label for="nik" class="form-label">NIK</label>
    <input type="text"
    class="form-control @error('nik') is-invalid @enderror"
    id="nik"
    name="nik"
    value="{{ old('nik', $rumah->nik ??'') }}"
     {{ isset($readonly) ? 'readonly' : '' }}
    placeholder="Masukkan NIK">

    @error('nik')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<!-- Alamat -->
<div class="mb-3">
    <label for="alamat" class="form-label">Alamat</label>
    <input type="text" 
    class="form-control" 
    id="alamat" name="alamat" 
    value="{{ old('alamat', $rumah->alamat ??'') }}" 
    {{ isset($readonly) ? 'readonly' : '' }} 
    placeholder="Masukkan alamat" required>
</div>

<!-- La/Longtitude -->
 <div class="row">
     <div class="col-md-6 mb-3">
         <label for="latitude" class="form-label">Latitude</label>
         
         <input 
         type="number"
         step="any"
         class="form-control @error('latitude') is-invalid @enderror"
         id="latitude" 
         name="latitude" 
         value="{{ old('latitude', $rumah->latitude ??'') }}" {{ isset($readonly) ? 'readonly' : '' }} 
         placeholder="Contoh: -6.123456">

         @error('latitude')
             <div class="invalid-feedback">
                 {{ $message }}
             </div>
         @enderror
     </div>

     <div class="col-md-6 mb-3">
         <label for="longitude" class="form-label">Longitude</label>

         <input
         type="number"
         step="any"
         class="form-control @error('longitude') is-invalid @enderror"
         id="longitude"
         name="longitude" 
         value="{{ old('longitude', $rumah->longitude ??'') }}" {{ isset($readonly) ? 'readonly' : '' }} 
         placeholder="Contoh: 106.123456">

         @error('longitude')
             <div class="invalid-feedback">
                 {{ $message }}
             </div>
         @enderror
     </div>
 </div>

<!-- Kelurahan -->
<div class="mb-3">
    <label for="kelurahan_id" class="form-label">Kelurahan</label>
    <select class="form-select"
    id="kelurahan_id"
    name="kelurahan_id"
        {{isset($readonly) ? 'disabled' : '' }} required>
        <option value="">Pilih kelurahan</option>
        @foreach ($kelurahan as $item)
            <option value="{{ $item->id }}"
            {{ old('kelurahan_id', $rumah->kelurahan_id ??'') == $item->id ? 'selected' : '' }}>
                {{ $item->nama_kelurahan }}
            </option>
        @endforeach
    </select>
</div>

<!-- Kondisi -->
<div class="mb-3">
    <label for="kondisi" class="form-label">Kondisi</label>
    <select class="form-select" id="kondisi" name="kondisi"
        {{isset($readonly) ? 'disabled' : '' }} required>
        <option value="">Pilih kondisi</option>
        <option value="Rusak Ringan" {{ old('kondisi', $rumah -> kondisi ??'') == 'Rusak Ringan' ? 'selected' : '' }}>Rusak Ringan</option>
        <option value="Rusak Sedang" {{ old('kondisi', $rumah -> kondisi ??'') == 'Rusak Sedang' ? 'selected' : '' }}>Rusak Sedang</option>
        <option value="Rusak Berat" {{ old('kondisi', $rumah -> kondisi ??'') == 'Rusak Berat' ? 'selected' : '' }}>Rusak Berat</option>
    </select>
</div>

<!-- Tahun Pendataan -->
<div class="mb-3">
    <label for="tahun_pendataan" class="form-label">Tahun Pendataan</label>
    <input type="number"
    class="form-control @error('tahun_pendataan') is-invalid @enderror"
    id="tahun_pendataan"
    name="tahun_pendataan"
    value="{{ old('tahun_pendataan', $rumah->tahun_pendataan ??'') }}"
    min="2000" max="{{ date('Y') }}"
    {{ isset($readonly) ? 'readonly' : '' }}
    placeholder="Masukkan tahun pendataan" required>

    @error('tahun_pendataan')
        <div class="invalid-feedback d-block">
            {{ $message }}
        </div>
    @enderror
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('input[name="tahun_pendataan"]').forEach(function (input) {
        input.addEventListener('invalid', function (event) {
            event.preventDefault();

            if (input.value === '' || Number(input.value) < 2000) {
                input.setCustomValidity('Tahun pendataan minimal adalah 2000.');
            } else if (Number(input.value) > Number(new Date().getFullYear())) {
                input.setCustomValidity('Tahun pendataan tidak boleh lebih dari tahun saat ini.');
            } else {
                input.setCustomValidity('');
            }

            input.reportValidity();
        });

        input.addEventListener('input', function () {
            input.setCustomValidity('');
        });
    });
});
</script>

<!-- Keterangan -->
<div class="mb-3">
    <label for="keterangan" class="form-label">Keterangan</label>
   <textarea
    class="form-control"
    id="keterangan"
    name="keterangan"
    rows="3"
    {{ isset($readonly) ? 'readonly' : '' }}
    placeholder="Opsional">{{ old('keterangan', $rumah->keterangan ?? '') }}</textarea>
</div>

<!-- Foto Lama -->
@if(isset($rumah) && !isset($readonly) && $rumah->fotoRumah->count() > 0)
    <div class="mb-3">
        <label class="form-label">Foto Rumah Saat Ini</label>

        <div class="row">
            @foreach($rumah->fotoRumah as $foto)
                <div class="col-md-6 mb-3">
                    <div class="card">

                        <img
                            src="{{ asset('storage/' . $foto->path) }}"
                            class="card-img-top"
                            style="height: 180px; object-fit: cover;"
                            alt="Foto rumah">

                        <div class="card-body">
                            <small class="text-muted d-block mb-2">
                                {{ $foto->nama_file }}
                            </small>

                           @if(!isset($readonly))
                            <button
                                type="button"
                                class="btn btn-danger btn-sm hapus-foto-btn"
                                data-url="{{ route('foto-rumah.destroy', $foto) }}">
                                Hapus Foto
                            </button>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endif

<script>
document.querySelectorAll('.hapus-foto-btn').forEach(function (btn) {
    btn.addEventListener('click', function () {
        const url = this.dataset.url;
        
        if (!confirm('Apakah Anda yakin ingin menghapus foto ini?')) {
            return;
        }

        fetch(url, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json'
            }
        })
        .then(response => {
            if(!response.ok) {
                throw new Error('Gagal Menghapus Foto.');
            }
            return response.json();
        })
        .then(data => {
            if(data.success) {
                this.closest('.col-md-6').remove();
            }
        })
        .catch(error => {
            console.error(error);
        });
    });
});
</script>


<!-- Tambah Foto -->
@if(!isset($readonly))
    <div class="mb-3">
        <label for="foto" class="form-label">
            Foto Rumah
        </label>

        <small class="text-muted d-block mb-2">
            Foto harus mencakup tampak depan, atap, dinding, lantai,
            atau sanitasi.
        </small>

        <input 
            type="file"
            name="foto[]"
            id="foto"
            class="form-control"
            accept="image/jpeg, image/png"
            multiple>

        <small class="text-muted">
            Maksimal 10 foto, Ukuran Maks. 2 MB, Format JPG, JPEG, PNG
        </small>

        @error('foto')
            <div class="text-danger">
                {{ $message }}
            </div>
        @enderror

        @error('foto.*')
            <div class="text-danger">
                {{ $message }}
            </div>
        @enderror
    </div>
@endif