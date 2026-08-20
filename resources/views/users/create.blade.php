@extends('layouts.app')
@section('title', 'Tambah Pengguna')
@section('content')

<div class="container mt-4">
    <h2 class="mb-4">Tambah Pengguna</h2>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('user.store') }}" method="POST">
                @csrf

                @include('users.form')

                <div class="mt-4">
                    <a href="{{ route('user.index') }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection