@extends('layouts.app')

@section('title', 'Tambah Riwayat')

@section('content')

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow border-0">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0 text-center">Tambah Riwayat</h4>
                </div>

                <div class="card-body">
                    <div class="alert alert-info">
                        <strong>Rumah:</strong>
                        {{ $rumah->nama_pemilik }}
                        <br>
                        <strong>Alamat:</strong>
                        {{ $rumah->alamat }}
                    </div>
                    
                    <form action="{{ route('rumah.riwayat.store', $rumah) }}" method="POST">
                        @csrf

                        <!-- Kondisi -->
                        <div class="mb-3">
                            <label for="kondisi" class="form-label">Kondisi</label>

                            <select name="kondisi" id="kondisi" class="form-select @error('kondisi') is-invalid @enderror" required>
                                <option value="Rusak Ringan" {{ old('kondisi') == 'Rusak Ringan' ? 'selected' : '' }}>Rusak Ringan</option>
                                <option value="Rusak Sedang" {{ old('kondisi') == 'Rusak Sedang' ? 'selected' : '' }}>Rusak Sedang</option>
                                <option value="Rusak Berat" {{ old('kondisi') == 'Rusak Berat' ? 'selected' : '' }}>Rusak Berat</option>
                            </select>

                            @error('kondisi')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Tanggal Survei -->
                        <div class="mb-3">
                            <label for="tanggal_survei" class="form-label">Tanggal Survei</label>

                            <input
                            type="date" 
                            name="tanggal_survei" 
                            id="tanggal_survei" 
                            class="form-control @error('tanggal_survei') is-invalid @enderror" 
                            value="{{ old('tanggal_survei', date('Y-m-d')) }}" required>

                            @error('tanggal_survei')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Keterangan -->
                        <div class="mb-3">
                            <label for="keterangan" class="form-label">Keterangan</label>

                            <textarea
                            name="keterangan" 
                            id="keterangan"
                            rows="3" 
                            class="form-control 
                            @error('keterangan') is-invalid @enderror"
                            placeholder="Masukkan keterangan">{{ old('keterangan') }}</textarea>

                            @error('keterangan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('rumah.show', $rumah) }}" class="btn btn-secondary">Kembali</a>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection