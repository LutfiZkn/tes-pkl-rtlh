<div class="mb-3">
    <label class="form-label">Nama Kelurahan</label>
    <input
        type="text"
        name="nama_kelurahan"
        class="form-control @error('nama_kelurahan') is-invalid @enderror"
        value="{{ old('nama_kelurahan', $kelurahan->nama_kelurahan ?? '') }}"
        placeholder="Masukkan nama kelurahan"
        required>

    @error('nama_kelurahan')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label">Kecamatan</label>
    <select
        name="kecamatan_id"
        class="form-select @error('kecamatan_id') is-invalid @enderror"
        required>

        <option value="">Pilih Kecamatan</option>
        @foreach($kecamatan as $item)
            <option
                value="{{ $item->id }}"
                {{ old('kecamatan_id', $kelurahan->kecamatan_id ?? '') == $item->id ? 'selected' : '' }}>

                {{ $item->nama_kecamatan }}
            </option>
        @endforeach
    </select>

    @error('kecamatan_id')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>