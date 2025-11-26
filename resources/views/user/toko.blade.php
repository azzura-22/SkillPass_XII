@extends('user.template')
@section('content')

<style>
    body {
        background: linear-gradient(to bottom, #4d4c4c, #000000);
        min-height: 100vh;
        color: #ffffff;
    }

    /* Card toko */
    .toko-card {
        border-radius: 15px;
        overflow: hidden;
        background-color: rgba(255,255,255,0.05);
        transition: transform 0.3s, box-shadow 0.3s;
        color: #ffffff;
    }

    .toko-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.15);
    }

    .toko-card img {
        width: 100%;
        height: 180px;
        object-fit: cover;
    }

    .toko-card-body h5 {
        margin-bottom: 10px;
    }

    .toko-card-body p {
        font-size: 0.9rem;
        margin-bottom: 5px;
    }

    .toko-card-body a {
        margin-top: 10px;
    }
</style>

<div class="container mt-4">

    <h2 class="mb-4 fw-bold text-center">semua toko</h2>

    <div class="row">
        @forelse ($tokos as $t)
        <div class="col-md-4 mb-4">
            <div class="toko-card shadow-sm">
                <img src="{{ asset('storage/logotoko/'.$t->gambar) }}" alt="{{ $t->nama_toko }}">
                <div class="toko-card-body p-3">
                    <h5>{{ $t->nama_toko }}</h5>
                    <p><strong>Deskripsi:</strong> {{ Str::limit($t->deskripsi, 80) }}</p>
                    <p><strong>Alamat:</strong> {{ $t->alamat }}</p>
                    <p><strong>Kontak:</strong> {{ $t->kontak_toko }}</p>
                    <p><strong>Status:</strong> {{ ucfirst($t->status) }}</p>
                    <a href="{{ route('member.toko.detail', $t->id) }}" class="btn btn-outline-primary w-100">Lihat Toko</a>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center text-muted">
            Belum ada toko tersedia.
        </div>
        @endforelse
    </div>

</div>

@endsection
