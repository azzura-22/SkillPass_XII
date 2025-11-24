@extends('user.template')
@section('content')

<style>
    /* BACKGROUND HALAMAN */
    body {
        background: linear-gradient(to bottom, #4d4c4c, #000000);
        min-height: 100vh;
        color: #ffffff; /* warna default teks putih */
    }

    /* Override untuk teks di dalam hero */
    .benner, .benner h2, .benner p, .benner a {
        color: #ffffff;
    }

    /* Override teks toko */
    .toko-circle + h5 {
        color: #ffffff;
    }

    /* Override teks produk */
    .card h6,
    .card p,
    .card a {
        color: #ffffff !important;
    }

    /* Hero */
    .benner {
        background: url('/assets/banner.jpg') center/cover no-repeat;
        padding: 100px 20px;
        border-radius: 15px;
        color: white;
        position: relative;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0,0,0,0.2);
    }
    .benner::before {
        content: '';
        position: absolute;
        inset: 0;
        background: rgba(0,0,0,0.5);
        border-radius: 15px;
    }
    .benner-overlay {
        position: relative;
        z-index: 1;
        text-align: center;
    }

    /* TOKO CARD */
    .toko-card img {
        height: 180px;
        object-fit: cover;
        border-radius: 10px;
        transition: transform 0.3s;
    }
    .toko-card img:hover {
        transform: scale(1.05);
    }

    /* TOKO CIRCLE */
    .toko-circle {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid #ddd;
        transition: transform 0.3s, border-color 0.3s;
    }
    .toko-circle:hover {
        transform: scale(1.05);
        border-color: #007bff;
    }

    /* PRODUK CARD */
    .card {
        border-radius: 15px;
        overflow: hidden;
        transition: transform 0.3s, box-shadow 0.3s;
        background-color: rgba(255,255,255,0.05); /* semi-transparent card agar tetap terlihat */
    }
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.15);
    }
    .card img {
        height: 200px;
        object-fit: cover;
    }

    /* Heading */
    h4, h5, h6, p, a {
        color: #ffffff;
    }
</style>

<div class="container mt-4">

    {{-- benner --}}
    <div class="benner mb-5">
        <div class="benner-overlay">
            <h2 class="fw-bold">Halaman Produk lengkap</h2>
            <p>Temukan produk yang anda cari</p>
        </div>
    </div>

    {{-- PRODUK TERBARU --}}
    <h4 class="mt-5 mb-3 fw-bold">Produk Terbaru</h4>
    <div class="row">
        @forelse ($produks as $p)
        <div class="col-md-3 mb-4">
            <div class="card shadow-sm">
                <img src="{{ asset('storage/imageproduk/'.$p->Gambar->first()->path_gambar) }}" class="card-img-top">
                <div class="card-body">
                    <h6 class="fw-bold">{{ $p->nama_produk }}</h6>
                    <p class="text-muted small mb-1">Toko: {{ $p->toko->nama_toko }}</p>
                    <p class="text-primary fw-bold">Rp {{ number_format($p->harga_produk, 0, ',', '.') }}</p>
                    <a href="{{route('produk.detail',$p->id)}}" class="btn btn-outline-primary w-100">Detail Produk</a>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center text-muted">
            Belum ada produk tersedia.
        </div>
        @endforelse
    </div>

</div>


@endsection
