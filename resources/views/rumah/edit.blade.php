@extends('layouts.app')

@section('title', 'Edit Data Rumah')

@section('content')

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">

            <div class="card shadow border-0">

                <div class="card-header bg-warning">
                    <h4 class="mb-0 text-center">
                        Edit Data Rumah
                    </h4>
                </div>

                <div class="card-body">

                    <form action="{{ route('rumah.update', $rumah->id) }}" method="POST">

                        @csrf
                        @method('PUT')

                        @include('rumah.form')

                        <button type="button"
                            class="btn btn-secondary"
                            onclick="history.back()">
                            Kembali
                        </button>

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