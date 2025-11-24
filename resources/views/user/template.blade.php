<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title') | User Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* Navbar fixed */
        body {
            padding-top: 70px; /* tinggi navbar */
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

        /* Optional: shadow bawah navbar */
        .navbar {
            background-color: rgb(105, 225, 225);
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>

{{-- NAVBAR USER --}}
<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
    <div class="container-fluid">

        <a class="navbar-brand" href="#">
            AZZStore
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
                    <a class="nav-link {{ request()->routeIs('user.dashboard') ? 'active' : '' }}"
                       href="#">Home</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->is('produk*') ? 'active' : '' }}" href="#">Produk</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->is('toko*') ? 'active' : '' }}" href="#">Toko</a>
                </li>

            </ul>

            {{-- MENU KANAN --}}
            <ul class="navbar-nav ms-auto">
                @guest
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="nav-link">Login</a>
                    </li>
                @else
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{route('member.dahboard')}}">Toko anda</a></li>
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

{{-- CONTENT --}}
<div class="container py-4">
    @yield('content')
</div>
<footer class="mt-5 pt-5 pb-4 footer-fstore text-white">
    <div class="container">
        <div class="row gy-4">

            <!-- Brand -->
            <div class="col-md-4">
                <h3 class="fw-bold mb-3">Fstore</h3>
                <p style="max-width: 300px;">
                    AZZStore adalah marketplace sederhana untuk memenuhi kebutuhan belanja Anda secara cepat dan mudah.
                </p>

                <div class="d-flex gap-3 mt-3">
                    <a href="#" class="footer-social"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="footer-social"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="footer-social"><i class="fab fa-twitter"></i></a>
                </div>
            </div>

            <!-- Menu -->
            <div class="col-md-4">
                <h5 class="fw-bold mb-3">Menu</h5>
                <ul class="list-unstyled">
                    <li><a href="#" class="footer-link">Beranda</a></li>
                    <li><a href="#" class="footer-link">Kategori</a></li>
                    <li><a href="#" class="footer-link">Produk</a></li>
                    <li><a href="#" class="footer-link">Tentang Kami</a></li>
                </ul>
            </div>

            <!-- Kontak -->
            <div class="col-md-4">
                <h5 class="fw-bold mb-3">Kontak</h5>
                <ul class="list-unstyled">
                    <li><i class="fas fa-phone me-2"></i> +62 82315818637</li>
                    <li><i class="fas fa-envelope me-2"></i> Fstore@gmail.com</li>
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

</body>
</html>
