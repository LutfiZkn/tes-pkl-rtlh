@extends('layouts.app')

@section('title', 'Tambah Kecamatan')

@section('content')

<div class="container mt-5">

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-warning">
                    <h4 class="mb-0 text-center">
                        Edit Data Kecamatan
                    </h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('kecamatan.update', $kecamatan->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        @include('kecamatan.form')

                        <a href="{{ route('kecamatan.index') }}" class="btn btn-secondary">
                            Kembali
                        </a>

                        <button class="btn btn-warning float-end">
                            Simpan
                        </button>
                    </form>
                </div>    
            </div>
        </div>
    </div>
</div>

@endsection