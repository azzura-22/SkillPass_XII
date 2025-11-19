@extends('membe.tamplate')
@section('title', 'Dashboard Member')

@section('content')
@csrf

<div class="container mt-4">

    @php
        $toko = Auth::user()->Toko;
        $jumlahProduk = $toko ? $toko->Produk->count() : 0;
        $jumlahGambar = $toko ? \App\Models\Gambar::whereIn('produk_id', $toko->Produk->pluck('id'))->count() : 0;
    @endphp


    {{-- Jika belum punya toko --}}
    @if (!$toko)
    <div class="card shadow">
        <div class="card-body text-center">

            <h4 class="fw-bold">Anda Belum Memiliki Toko</h4>
            <p class="text-muted">Silakan buat toko untuk mulai menjual produk Anda.</p>

            <button class="btn btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#createTokoModal">
                + Buat Toko
            </button>

        </div>
    </div>
    @elseif ($toko && $toko->status == 'pending')
    <div>
        <div class="alert alert-info mt-3" role="alert">
            <strong>Info:</strong> Toko Anda sedang dalam proses verifikasi. Mohon tunggu hingga status toko Anda diubah menjadi "active" oleh admin.
        </div>
    </div>
    @else
    {{-- Profil Toko --}}
    <div class="card shadow mb-4">
        <div class="card-body d-flex align-items-center justify-content-between">

            <div class="d-flex">
                <div class="me-3">
                    @if ($toko->gambar)
                        <img src="{{ asset('storage/image/'.$toko->gambar) }}"
                             width="100" height="100" class="rounded-circle shadow">
                    @else
                        <img src="https://via.placeholder.com/100"
                             class="rounded-circle shadow">
                    @endif
                </div>

                <div>
                    <h4 class="fw-bold mb-1">{{ $toko->nama_toko }}</h4>
                    <p class="text-muted mb-0" style="max-width: 500px;">
                        {{ $toko->deskripsi }}
                    </p>
                </div>
            </div>

            <button class="btn btn-warning btnEditToko"
                data-id="{{ $toko->id }}"
                data-nama="{{ $toko->nama_toko }}"
                data-deskripsi="{{ $toko->deskripsi }}"
                data-bs-toggle="modal"
                data-bs-target="#EditToko">
                Edit Toko
            </button>

        </div>
    </div>

    {{-- Statistik --}}
    <div class="row">

        <div class="col-md-4">
            <div class="card text-white bg-primary shadow mb-3">
                <div class="card-body">
                    <h5 class="card-title">Jumlah Produk</h5>
                    <h2>{{ $jumlahProduk }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-white bg-success shadow mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Gambar Produk</h5>
                    <h2>{{ $jumlahGambar }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <a href="#" class="text-decoration-none">
                <div class="card text-white bg-dark shadow mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Kelola Produk</h5>
                        <h2><i class="fa-solid fa-box"></i></h2>
                    </div>
                </div>
            </a>
        </div>

    </div>

    @endif

</div>



{{-- Modal Create Toko --}}
<div class="modal fade" id="createTokoModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Buat Toko Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form action="{{ route('member.toko.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="modal-body">

                    <div class="mb-3">
                        <label class="form-label">Nama Toko</label>
                        <input type="text" name="nama_toko" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">alamat Toko</label>
                        <input type="text" name="alamat" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Deskripsi Toko</label>
                        <textarea name="deskripsi" class="form-control" rows="3" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Logo Toko (Opsional)</label>
                        <input type="file" name="logo_toko" class="form-control">
                        <small class="text-muted">Format JPG, PNG, Max 2 MB</small>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Batal
                    </button>
                    <button type="submit" class="btn btn-primary">
                        Simpan Toko
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

{{-- Modal Edit Toko --}}
<div class="modal fade" id="EditToko" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Edit Toko</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form action="{{ route('member.toko.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="modal-body">

                    <input type="hidden" name="id" id="edit_id">

                    <div class="mb-3">
                        <label>Nama Toko</label>
                        <input type="text" name="nama_toko" id="edit_nama_toko" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Deskripsi Toko</label>
                        <textarea name="deskripsi" id="edit_deskripsi" class="form-control" rows="3" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label>Ganti Logo (Opsional)</label>
                        <input type="file" name="logo_toko" class="form-control">
                    </div>

                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button class="btn btn-primary">Update</button>
                </div>

            </form>

        </div>
    </div>
</div>

<script>
    $(document).on("click", ".btnEditToko", function () {
        $("#edit_id").val($(this).data("id"));
        $("#edit_nama_toko").val($(this).data("nama"));
        $("#edit_deskripsi").val($(this).data("deskripsi"));
    });
</script>

@endsection
