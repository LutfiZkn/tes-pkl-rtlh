<div class="mb-3">

<label class="form-label">Nama Kecamatan</label>

<input type="text"
    name="nama_kecamatan"
    class="form-control @error('nama_kecamatan') is-invalid @enderror" 
    value="{{ old('nama_kecamatan', $kecamatan->nama_kecamatan ?? '') }}"
    placeholder="Masukkan Nama Kecamatan" required>

    @error('nama_kecamatan')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>