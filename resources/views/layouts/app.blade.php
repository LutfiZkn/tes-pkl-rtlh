<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-secondary">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('dashboard') }}">DATA RUMAH</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <ul class="navbar-nav me-auto">

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('dashboard') }}">
                        Dashboard
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('rumah.index') }}">
                        Rumah
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('kelurahan.index') }}">
                        Kelurahan
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('kecamatan.index') }}">
                        Kecamatan
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('peta.index') }}">
                        Peta Sebaran
                    </a>
                </li>

                @if (Auth::user()->role === 'Admin')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.index') }}">
                            User
                        </a>
                    </li>
                @endif

            </ul>

        </div>
        <span class="me-3">
            {{ Auth::user()->name }}
        </span>
        <form action="{{ route('logout') }}" method="POST" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin keluar?')">Logout</button>
        </form>
    </div>
</nav>

<div class="container mt-4">

    @yield('content')

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>