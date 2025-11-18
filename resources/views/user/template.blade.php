<!DOCTYPE html>
<html>
<head>
    <title>User | Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

{{-- NAVBAR USER --}}
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">

        <a class="navbar-brand" href="{{ route('user.dashboard') }}">
            MyApp
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarUser" aria-controls="navbarUser"
            aria-expanded="false" aria-label="Toggle navigation">

            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarUser">

            {{-- MENU KIRI --}}
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                <li class="nav-item">
                    <a class="nav-link {{ request()->is('/') ? 'active' : '' }}"
                       href="{{ route('user.dashboard') }}">Home</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#">Produk</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#">Toko</a>
                </li>

            </ul>

            {{-- MENU KANAN --}}
            <ul class="navbar-nav ms-auto">

                {{-- Jika User Login --}}
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="nav-link">Login</a>
                    </li>
            </ul>
        </div>
    </div>
</nav>

{{-- CONTENT --}}
<div class="container py-4">
    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
