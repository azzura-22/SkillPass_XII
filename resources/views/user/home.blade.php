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

    h4, h5, h6, p, a {
        color: #ffffff;
    }

    .filter-form select {
        background-color: #333;
        color: #fff;
        border: 1px solid #555;
    }
    .filter-form select option {
        background-color: #333;
        color: #fff;
    }
</style>

<div class="container mt-4">

    <div class="benner mb-5">
        <div class="benner-overlay">
            <h2 class="fw-bold">Selamat Datang di Aplikasi Kami</h2>
            <p>Nikmati layanan terbaik dan temukan toko pilihan Anda.</p>
        </div>
    </div>

    {{-- LIST TOKO --}}
    <h4 id="tokoList" class="mb-4 fw-bold">Toko Pilihan</h4>
    <div class="row">
        @forelse ($tokos as $t)
        <div class="col-md-3 mb-4 text-center">
            <a href="{{ route('member.toko.detail', $t->id) }}">
                <img src="{{ asset('storage/logotoko/'.$t->gambar) }}" class="toko-circle mb-3">
            </a>
            <h5 class="fw-bold">{{ $t->nama_toko }}</h5>
            <p class="small text-white">{{ $t->deskripsi }}</p>
        </div>
        @empty
        <div class="col-12 text-center">
            <p class="text-muted">Belum ada toko tersedia.</p>
        </div>
        @endforelse
    </div>

    <div class="d-flex justify-content-between align-items-center mb-3 mt-5">
        <h4 class="fw-bold">Produk Terbaru</h4>
        <form action="{{ route('user.dashboard') }}" method="GET" class="mb-3">
            <select name="kategori_id" class="form-select" onchange="this.form.submit()">
            <option value="">Semua Kategori</option>
                @foreach($kategori as $k)
                    <option value="{{ $k->id }}" {{ ($kategori_id == $k->id) ? 'selected' : '' }}>
                        {{ $k->nama_katgori }}
                    </option>
                @endforeach
            </select>
        </form>
    </div>

    {{-- Produk terbaru --}}
    <div class="row">
        @forelse ($produks as $p)
        <div class="col-md-3 mb-4">
            <div class="card shadow-sm">
                @if($p->Gambar->count() > 0)
                    <img src="{{ asset('storage/imageproduk/'.$p->Gambar->first()->path_gambar) }}" class="card-img-top">
                @else
                    <img src="{{ asset('assets/no-image.png') }}" class="card-img-top">
                @endif
                <div class="card-body">
                    <h6 class="fw-bold">{{ $p->nama_produk }}</h6>
                    <p class="text-muted small mb-1">Toko: {{ $p->toko->nama_toko }}</p>
                    <p class="text-primary fw-bold">Rp {{ number_format($p->harga_produk, 0, ',', '.') }}</p>
                    <a href="{{ route('produk.detail', $p->id) }}" class="btn btn-outline-primary w-100">Detail Produk</a>
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
