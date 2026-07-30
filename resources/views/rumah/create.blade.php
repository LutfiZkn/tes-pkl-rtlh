<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>


<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-6 col-lg-5">
      <div class="card shadow border-0">
        <div class="card-header bg-primary text-white text-center py-3">
          <h4 class="mb-0">Form Data Rumah</h4>
        </div>
        <div class="card-body p-4">
          <form action="{{ route('rumah.store') }}" method="POST">
            @csrf

            <div class="mb-3">
              <label for="nama_pemilik" class="form-label">Nama Lengkap</label>
              <input type="text" class="form-control" id="nama_pemilik" name="nama_pemilik" value="{{ old('nama_pemilik') }}" placeholder="Masukkan nama" required>
            </div>

            <div class="mb-3">
              <label for="nik" class="form-label">NIK</label>
              <input type="text"
                class="form-control @error('nik') is-invalid @enderror"
                id="nik"
                name="nik"
                value="{{ old('nik') }}"
                placeholder="Masukkan NIK">

                @error('nik')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
              <label for="alamat" class="form-label">Alamat</label>
              <input type="text" class="form-control" id="alamat" name="alamat" value="{{ old('alamat') }}" placeholder="Masukkan alamat" required>
            </div>

            <div class="mb-3">
              <label for="kelurahan_id" class="form-label">Kelurahan</label>
              <select class="form-select" id="kelurahan_id" name="kelurahan_id" required>
                <option value="">Pilih kelurahan</option>
                @foreach ($kelurahan as $item)
                  <option value="{{ $item->id }}" {{ old('kelurahan_id') == $item->id ? 'selected' : '' }}>
                    {{ $item->nama_kelurahan }}
                  </option>
                @endforeach
              </select>
            </div>

            <div class="mb-3">
              <label for="kondisi" class="form-label">Kondisi</label>
              <select class="form-select" id="kondisi" name="kondisi" required>
                <option value="">Pilih kondisi</option>
                <option value="Rusak Ringan" {{ old('kondisi') == 'Rusak Ringan' ? 'selected' : '' }}>Rusak Ringan</option>
                <option value="Rusak Sedang" {{ old('kondisi') == 'Rusak Sedang' ? 'selected' : '' }}>Rusak Sedang</option>
                <option value="Rusak Berat" {{ old('kondisi') == 'Rusak Berat' ? 'selected' : '' }}>Rusak Berat</option>
              </select>
            </div>

            <div class="mb-3">
              <label for="tahun_pendataan" class="form-label">Tahun Pendataan</label>
              <input type="number" class="form-control" id="tahun_pendataan" name="tahun_pendataan" value="{{ old('tahun_pendataan') }}" placeholder="Masukkan tahun pendataan" required>
            </div>

            <div class="mb-3">
              <label for="keterangan" class="form-label">Keterangan</label>
              <textarea class="form-control" id="keterangan" name="keterangan" value="{{ old('keterangan') }}" rows="3" placeholder="Opsional"></textarea>
            </div>

            <button type="button" class="btn btn-secondary" onclick="history.back()">Kembali</button>
            <button type="submit" class="btn btn-primary" style="float: right;">Simpan</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>