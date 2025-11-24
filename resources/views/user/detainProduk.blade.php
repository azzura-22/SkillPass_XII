@extends('user.template')
@section('content')

<style>
    body {
        background: linear-gradient(to bottom, #2c2c2c, #000000);
        color: #ffffff;
        min-height: 100vh;
    }

    .product-detail {
        margin-top: 40px;
    }

    .product-images img {
        width: 100%;
        height: 400px;
        object-fit: cover;
        border-radius: 15px;
    }

    .product-info h2 {
        font-weight: bold;
        margin-bottom: 20px;
    }

    .product-info p {
        color: #ccc;
    }

    .price {
        font-size: 1.5rem;
        color: #0d6efd;
        font-weight: bold;
        margin-bottom: 20px;
    }

    .btn-buy {
        width: 100%;
    }
</style>

<div class="container product-detail">
    <div class="row">
        {{-- Gambar Produk --}}
        <div class="col-md-6 product-images mb-3">
            @if($produk->Gambar->count() > 0)
                <img src="{{ asset('storage/imageproduk/'.$produk->Gambar->first()->path_gambar) }}" alt="{{ $produk->nama_produk }}">
            @else
                <img src="{{ asset('assets/no-image.png') }}" alt="No Image">
            @endif
        </div>

        {{-- Info Produk --}}
        <div class="col-md-6 product-info">
            <h2>{{ $produk->nama_produk }}</h2>
            <p class="price">Rp {{ number_format($produk->harga_produk, 0, ',', '.') }}</p>
            <p>Toko: <strong>{{ $produk->toko->nama_toko }}</strong></p>
            <p>{{ $produk->deskripsi ?? 'Belum ada deskripsi untuk produk ini.' }}</p>
            <a href="#" class="btn btn-primary btn-buy mt-3">Beli Sekarang</a>
        </div>
    </div>

    {{-- Produk Lain dari Toko Sama --}}
    <h4 class="mt-5 mb-3">Produk Lain dari {{ $produk->toko->nama_toko }}</h4>
    <div class="row">
        @forelse ($allProdukToko as $p)
            <div class="col-md-3 mb-4">
                <div class="card shadow-sm" style="background-color: rgba(255,255,255,0.05); color: #fff;">
                    <img src="{{ asset('storage/imageproduk/'.$p->Gambar->first()->path_gambar) }}" class="card-img-top" style="height:200px; object-fit:cover;">
                    <div class="card-body">
                        <h6 class="fw-bold">{{ $p->nama_produk }}</h6>
                        <p class="text-primary fw-bold">Rp {{ number_format($p->harga_produk, 0, ',', '.') }}</p>
                        <a href="{{ route('produk.detail', $p->id) }}" class="btn btn-outline-primary w-100">Detail Produk</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center text-muted">
                Tidak ada produk lain dari toko ini.
            </div>
        @endforelse
    </div>
</div>

@endsection
