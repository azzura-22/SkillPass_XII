<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Dashboard') | AZZStore</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome (opsional untuk icon) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>

    <style>
        /* Navbar fixed */
        body {
            padding-top: 70px; /* tinggi navbar */
            background: linear-gradient(to bottom, #2c2c2c, #000000);
            color: #ffffff;
            min-height: 100vh;
        }

        .navbar-brand {
            font-weight: bold;
        }

        .nav-link.active {
            font-weight: 600;
            color: #fff !important;
            background-color: rgba(255,255,255,0.2);
            border-radius: 5px;
        }

        .nav-link:hover {
            background-color: rgba(255,255,255,0.2);
            border-radius: 5px;
        }

        .navbar {
            background-color: rgb(105, 225, 225);
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }

        .form-control:focus {
            box-shadow: none;
            border-color: #0d6efd;
        }

        footer {
            background-color: #1c1c1c;
        }
        footer a {
            color: #fff;
            text-decoration: none;
        }
        footer a:hover {
            text-decoration: underline;
        }

        /* .toko-circle {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid #ddd;
            transition: transform 0.3s, border-color 0.3s;
        }
        .toko-circle:hover {
            transform: scale(1.05);
            border-color: #0d6efd;
        }

        .card {
            border-radius: 15px;
            overflow: hidden;
            transition: transform 0.3s, box-shadow 0.3s;
            background-color: rgba(255,255,255,0.05);
            color: #fff;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.15);
        }
        .card img {
            height: 200px;
            object-fit: cover;
        } */
    </style>

    @stack('styles')
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('user.dashboard') }}">AZZStore</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarUser" aria-controls="navbarUser"
                aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarUser">

            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('user.dashboard') ? 'active' : '' }}"
                       href="{{ route('user.dashboard') }}">Home</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('user.produk') ? 'active' : '' }}"
                       href="{{ route('user.produk') }}">Produk</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('toko.user') ? 'active' : '' }}"
                       href="{{ route('toko.user') }}">Toko</a>
                </li>
            </ul>

            <form class="d-flex me-3" role="search" action="{{ route('user.search') }}" method="GET">
                <input class="form-control me-2" type="search" name="q"
                       placeholder="Cari produk atau toko" aria-label="Search"
                       value="{{ request('q') }}">
                <button class="btn btn-outline-light" type="submit">Cari</button>
            </form>

            <ul class="navbar-nav ms-auto">
                @guest
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="nav-link">Login</a>
                    </li>
                @else
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button"
                           data-bs-toggle="dropdown">{{ Auth::user()->name }}</a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('member.dahboard') }}">Toko Anda</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item text-danger" href="{{ route('logout.user') }}">
                                   Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </li>
                @endguest
            </ul>

        </div>
    </div>
</nav>

<div class="container py-4">
    @yield('content')
</div>

<footer class="mt-5 pt-5 pb-4 text-white">
    <div class="container">
        <div class="row gy-4">
            <div class="col-md-4">
                <h3 class="fw-bold mb-3">AZZStore</h3>
                <p style="max-width: 300px;">AZZStore adalah marketplace sederhana untuk memenuhi kebutuhan belanja Anda secara cepat dan mudah.</p>
                <div class="d-flex gap-3 mt-3">
                    <a href="#" class="text-white"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="text-white"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="text-white"><i class="fab fa-twitter"></i></a>
                </div>
            </div>

            <div class="col-md-4">
                <h5 class="fw-bold mb-3">Menu</h5>
                <ul class="list-unstyled">
                    <li><a href="{{ route('user.dashboard') }}">Beranda</a></li>
                    <li><a href="{{ route('user.produk') }}">Produk</a></li>
                    <li><a href="{{ route('toko.user') }}">Toko</a></li>
                </ul>
            </div>

            <div class="col-md-4">
                <h5 class="fw-bold mb-3">Kontak</h5>
                <ul class="list-unstyled">
                    <li><i class="fas fa-phone me-2"></i> +62 89526025545</li>
                    <li><i class="fas fa-envelope me-2"></i> AZZstore@gmail.com</li>
                    <li><i class="fas fa-location-dot me-2"></i> Tasikmalaya, Indonesia</li>
                </ul>
            </div>
        </div>

        <hr class="my-4">
        <div class="text-center">
            <p class="mb-0">© 2025 AZZStore. All rights reserved.</p>
        </div>
    </div>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

@stack('scripts')
</body>
</html>
