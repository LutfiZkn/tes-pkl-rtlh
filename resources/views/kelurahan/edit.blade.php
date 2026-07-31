@extends('layouts.app')
@section('title','Edit Kelurahan')
@section('content')

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-warning">
                    <h4 class="mb-0 text-center">
                        Edit Data Kelurahan
                    </h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('kelurahan.update',$kelurahan->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        @include('kelurahan.form')

                        <a href="{{ route('kelurahan.index') }}" class="btn btn-secondary">
                            Kembali
                        </a>

                        <button class="btn btn-warning float-end">
                            Update
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection