@extends('user.template')
@section('content')

<style>
    body {
        background: linear-gradient(to bottom, #2c2c2c, #000000);
        color: #ffffff;
        min-height: 100vh;
    }

    /* HERO TOKO */
    .toko-bener {
        background: url('{{ asset("storage/logotoko/".$toko->gambar) }}') center/cover no-repeat;
        height: 300px;
        border-radius: 15px;
        position: relative;
        overflow: hidden;
        margin-bottom: 30px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.3);
    }
    .toko-bener::before {
        content: '';
        position: absolute;
        inset: 0;
        background: rgba(0,0,0,0.5);
        border-radius: 15px;
    }
    .toko-bener-overlay {
        position: relative;
        z-index: 1;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        height: 100%;
        text-align: center;
        color: #fff;
    }
    .toko-bener h2 {
        font-size: 2.5rem;
        font-weight: bold;
    }
    .toko-bener p {
        font-size: 1.1rem;
    }

    /* INFO TOKO */
    .toko-info {
        margin-bottom: 40px;
    }
    .toko-info h4 {
        font-weight: bold;
        margin-bottom: 10px;
    }
    .toko-info p {
        color: #ccc;
    }

    /* PRODUK CARD */
    .card {
        border-radius: 15px;
        overflow: hidden;
        transition: transform 0.3s, box-shadow 0.3s;
        background-color: rgba(255,255,255,0.05);
        color: #fff;
    }
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.3);
    }
    .card img {
        height: 200px;
        object-fit: cover;
    }
    .card h6, .card p, .card a {
        color: #ffffff !important;
    }
</style>

<div class="container mt-4">

    <div class="toko-bener mb-4">
        <div class="toko-bener-overlay">
            <h2>{{ $toko->nama_toko }}</h2>
            <p>{{ $toko->deskripsi ?? 'Belum ada deskripsi untuk toko ini.' }}</p>
        </div>
    </div>

    {{-- INFO TOKO --}}
    <div class="toko-info">
        <h4>Informasi Toko</h4>
        <p>Alamat: {{ $toko->alamat ?? '-' }}</p>
        <p>Kontak: {{ $toko->kontak_toko ?? '-' }}</p>
        <p>Status: {{ ucfirst($toko->status) }}</p>
    </div>

    {{-- PRODUK TOKO --}}
    <h4 class="mb-3">Produk dari {{ $toko->nama_toko }}</h4>
    <div class="row">
        @forelse ($toko->produk as $produk)
        <div class="col-md-3 mb-4">
            <div class="card shadow-sm">
                <img src="{{ asset('storage/imageproduk/'.$produk->Gambar->first()->path_gambar) }}" class="card-img-top">
                <div class="card-body">
                    <h6 class="fw-bold">{{ $produk->nama_produk }}</h6>
                    <p class="text-primary fw-bold">Rp {{ number_format($produk->harga_produk, 0, ',', '.') }}</p>
                    <a href="{{route('produk.detail',$produk->id)}}" class="btn btn-outline-primary w-100">Detail Produk</a>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center text-muted">
            Belum ada produk tersedia di toko ini.
        </div>
        @endforelse
    </div>

</div>

@endsection

