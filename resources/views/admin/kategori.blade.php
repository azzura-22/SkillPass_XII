@extends('admin.template')
@section('content')
<style>
    /* Styling header tabel */
    #userTable thead th {
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
        <h5>Data Kategori</h5>

        {{-- Tombol membuka modal tambah --}}
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addKategoriModal">
            + Add Kategori
        </button>
    </div>

    <div class="card-body">

        {{-- TABLE --}}
        <table id="kategoriTable" class="table table-striped table-bordered nowrap" style="width:100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach($kategori as $u)
                <tr>
                    <td>{{ $u->id }}</td>
                    <td>{{ $u->nama_katgori }}</td>
                    <td>

                        {{-- BUTTON EDIT: bawa data ke modal lewat data-* --}}
                        <button
                            class="btn btn-warning btnEdit"
                            data-id="{{ $u->id }}"
                            data-name="{{ $u->nama_katgori }}"
                            data-bs-toggle="modal"
                            data-bs-target="#editMemberModal">
                            Edit
                        </button>

                        <a href="{{ route('admin.kategori.delete', $u->id) }}"
                           class="btn btn-danger"
                           onclick="return confirm('Yakin ingin menghapus?')">
                           Hapus
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>

<div class="modal fade" id="addKategoriModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">Tambah kategori</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <form action="{{ route('admin.kategori.store') }}" method="POST">
        @csrf

        <div class="modal-body">

            <div class="mb-3">
                <label>Nama</label>
                <input type="text" name="nama_katgori" class="form-control" required>
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

<div class="modal fade" id="editMemberModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">Edit Member</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      {{-- FORM UPDATE (PUT) --}}
      <form action="{{ route('admin.kategori.update') }}" method="POST">
        @csrf
        @method('PUT') {{-- Penting untuk request UPDATE --}}

        {{-- Untuk mengirim ID ke backend --}}
        <input type="hidden" name="id" id="edit_id">

        <div class="modal-body">

            <div class="mb-3">
                <label>Nama</label>
                <input type="text" name="nama_katgori" id="edit_name" class="form-control" required>
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
    $(document).ready(function(){
        $('#kategoriTable').DataTable();

        $('.btnEdit').on('click', function(){
            $('#edit_id').val($(this).data('id'));
            $('#edit_name').val($(this).data('name'));
        });
    });
</script>
@endsection
