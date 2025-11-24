@extends('user.template')

@section('content')
<div class="container mt-4">
    <h4>Hasil pencarian untuk: "{{ $q }}"</h4>

    <h5 class="mt-4">Produk</h5>
    <div class="row">
        @forelse($produks as $p)
            <div class="col-md-3 mb-4">
                <div class="card shadow-sm" style="background-color: rgba(255,255,255,0.05);">
                    <img src="{{ asset('storage/imageproduk/'.$p->Gambar->first()->path_gambar) }}" class="card-img-top" style="height:200px; object-fit:cover;">
                    <div class="card-body">
                        <h6 class="fw-bold">{{ $p->nama_produk }}</h6>
                        <p class="text-primary fw-bold">Rp {{ number_format($p->harga_produk, 0, ',', '.') }}</p>
                        <a href="{{ route('produk.detail', $p->id) }}" class="btn btn-outline-primary w-100">Detail Produk</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-muted">Produk tidak ditemukan.</div>
        @endforelse
    </div>

    <h5 class="mt-5">Toko</h5>
    <div class="row">
        @forelse($tokos as $t)
            <div class="col-md-3 mb-4 text-center">
                <a href="{{ route('member.toko.detail', $t->id) }}">
                    <img src="{{ asset('storage/logotoko/'.$t->gambar) }}" class="toko-circle mb-2" style="width:150px; height:150px; object-fit:cover;">
                </a>
                <h6 class="fw-bold">{{ $t->nama_toko }}</h6>
            </div>
        @empty
            <div class="col-12 text-muted">Toko tidak ditemukan.</div>
        @endforelse
    </div>
</div>
@endsection
