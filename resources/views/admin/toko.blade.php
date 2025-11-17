@extends('admin.template')

@section('content')

<style>
    /* Styling header tabel */
    #tokoTable thead th {
        color: #000 !important;
        background-color: #f8f9fa !important;
        font-weight: bold;
    }
</style>

<div class="card">

    {{-- Alert sukses --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Sukses!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card-header d-flex justify-content-between align-items-center">
        <h5>Data Toko</h5>

        {{-- Tombol buka modal tambah --}}
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addTokoModal">
            + Add Toko
        </button>
    </div>

    <div class="card-body">

        {{-- TABLE --}}
        <table id="tokoTable" class="table table-striped table-bordered nowrap" style="width:100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Toko</th>
                    <th>Owner</th>
                    <th>Kontak</th>
                    <th>Alamat</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach($tokos as $t)
                <tr>
                    <td>{{ $t->id }}</td>
                    <td>{{ $t->nama_toko }}</td>
                    <td>{{ $t->user->name }}</td>
                    <td>{{ $t->kontak_toko }}</td>
                    <td>{{ $t->alamat }}</td>
                    <td>

                        {{-- EDIT BUTTON --}}
                        <button
                            class="btn btn-warning btnEdit"
                            data-id="{{ $t->id }}"
                            data-nama="{{ $t->nama_toko }}"
                            data-deskripsi="{{ $t->deskripsi }}"
                            data-gambar="{{ $t->gambar }}"
                            data-user="{{ $t->user_id }}"
                            data-kontak="{{ $t->kontak_toko }}"
                            data-alamat="{{ $t->alamat }}"
                            data-bs-toggle="modal"
                            data-bs-target="#editTokoModal">
                            Edit
                        </button>
                        <a href="{{ route('admin.toko.delete', $t->id) }}"
                           class="btn btn-danger"
                           onclick="return confirm('Yakin ingin menghapus toko ini?')">
                           Hapus
                        </a>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>


{{-- ---------------------- MODAL ADD TOKO ---------------------- --}}
<div class="modal fade" id="addTokoModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">Tambah Toko</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <form action="{{ route('admin.toko.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="modal-body">

            <div class="mb-3">
                <label>Nama Toko</label>
                <input type="text" name="nama_toko" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Deskripsi</label>
                <textarea name="deskripsi" class="form-control" rows="3" required></textarea>
            </div>

            <div class="mb-3">
                <label>Owner (User)</label>
                <select name="user_id" class="form-control" required>
                    <option value="">-- pilih user --</option>
                    @foreach($users as $u)
                        <option value="{{ $u->id }}">{{ $u->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>Kontak Toko</label>
                <input type="text" name="kontak_toko" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Alamat</label>
                <textarea name="alamat" class="form-control" rows="2" required></textarea>
            </div>

            <div class="mb-3">
                <label>Gambar Toko</label>
                <input type="file" name="gambar" class="form-control" required>
            </div>

        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>

      </form>

    </div>
  </div>
</div>


{{-- ---------------------- MODAL EDIT TOKO ---------------------- --}}
<div class="modal fade" id="editTokoModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">Edit Toko</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <form action="{{ route('admin.toko.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <input type="hidden" name="id" id="edit_id">

        <div class="modal-body">

            <div class="mb-3">
                <label>Nama Toko</label>
                <input type="text" name="nama_toko" id="edit_nama" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Deskripsi</label>
                <textarea name="deskripsi" id="edit_deskripsi" class="form-control"></textarea>
            </div>

            <div class="mb-3">
                <label>Owner</label>
                <select name="user_id" id="edit_user" class="form-control">
                    @foreach($users as $u)
                        <option value="{{ $u->id }}">{{ $u->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>Kontak Toko</label>
                <input type="text" name="kontak_toko" id="edit_kontak" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Alamat</label>
                <textarea name="alamat" id="edit_alamat" class="form-control"></textarea>
            </div>

            <div class="mb-3">
                <label>Gambar Toko (optional)</label>
                <input type="file" name="gambar" class="form-control">
            </div>

        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary">Update</button>
        </div>

      </form>

    </div>
  </div>
</div>

<script>
$(document).ready(function () {
    $('#tokoTable').DataTable();

    // Isi modal edit
    $('.btnEdit').on('click', function() {
        $('#edit_id').val($(this).data('id'));
        $('#edit_nama').val($(this).data('nama'));
        $('#edit_deskripsi').val($(this).data('deskripsi'));
        $('#edit_kontak').val($(this).data('kontak'));
        $('#edit_alamat').val($(this).data('alamat'));
        $('#edit_user').val($(this).data('user'));
    });
});
</script>

@endsection
