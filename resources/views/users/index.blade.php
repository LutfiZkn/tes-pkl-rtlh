@extends('layouts.app')
@section('title', 'Data Pengguna')
@section('content')

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Data Pengguna</h2>

        <a href="{{ route('user.create') }}" class="btn btn-primary">Tambah Pengguna</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="float: right;"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-striped">

            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($users as $user)

                <tr>
                    <td>{{ $users->firstItem() + $loop->index }}</td>

                    <td>{{ $user->name }}</td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->email }}</td>

                    <td>
                        @if($user->role === 'Admin')
                            <span class="badge bg-danger">Admin</span>
                        @else
                            <span class="badge bg-primary">Petugas</span>
                        @endif
                    </td>

                    <td>
                        <a href="{{ route('user.show', $user) }}" class="btn btn-primary btn-sm">Detail</a>
                        <a href="{{ route('user.edit', $user) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('user.destroy', $user) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>

                @empty
                <tr>
                    <td colspan="6" class="text-center">Belum ada data pengguna</td>
                </tr>

                @endforelse
            </tbody>
        </table>
    </div>

    {{ $users->links() }}
</div>

@endsection