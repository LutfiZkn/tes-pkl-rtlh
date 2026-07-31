@extends('layouts.app')

@section('title', 'Detail Rumah')

@section('content')

@php
    $readonly = true;
@endphp

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">

            <div class="card shadow border-0">

                <div class="card-header bg-info text-white text-center">
                    <h4 class="mb-0">Detail Data Rumah</h4>
                </div>

                <div class="card-body">

                    @include('rumah.form')

                    <div class="d-grid gap-2 mt-3">
                        <a href="{{ route('rumah.index') }}" class="btn btn-secondary btn-lg">
                            Kembali
                        </a>
                    </div>

                </div>

            </div>

        </div>
    </div>
</div>

@endsection