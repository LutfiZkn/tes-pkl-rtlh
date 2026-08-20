@extends('layouts.app')
@section('title', 'Detail Pengguna')
@section('content')

<div class="container mt-4">
    <h2 class="mb-4">Detail Pengguna</h2>

    <div class="card">
        <div class="card-body">

            @include('users.form', ['readonly' => true])

            <div class="mt-4">
                <a href="{{ route('user.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </div>
</div>

@endsection