@extends('layouts.app')

@section('title','Tambah Kelurahan')

@section('content')

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0 text-center">
                        Tambah Data Kelurahan
                    </h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('kelurahan.store') }}" method="POST">
                        @csrf
                        @include('kelurahan.form')

                        <a href="{{ route('kelurahan.index') }}" class="btn btn-secondary">
                            Kembali
                        </a>

                        <button class="btn btn-primary float-end">
                            Simpan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection