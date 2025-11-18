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
    @if (session('succsess'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Sukses!</strong> {{ session('succsess') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card-header d-flex justify-content-between align-items-center">
        <h5>Data User</h5>

        {{-- Tombol membuka modal tambah --}}
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addMemberModal">
            + Add Member
        </button>
    </div>

    <div class="card-body">

        {{-- TABLE --}}
        <table id="userTable" class="table table-striped table-bordered nowrap" style="width:100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Kontak</th>
                    <th>Username</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach($users as $u)
                <tr>
                    <td>{{ $u->id }}</td>
                    <td>{{ $u->name }}</td>
                    <td>{{ $u->kontak }}</td>
                    <td>{{ $u->username }}</td>
                    <td>{{ $u->role }}</td>
                    <td>

                        {{-- BUTTON EDIT: bawa data ke modal lewat data-* --}}
                        <button
                            class="btn btn-warning btnEdit"
                            data-id="{{ $u->id }}"
                            data-name="{{ $u->name }}"
                            data-kontak="{{ $u->kontak }}"
                            data-password="{{$u->password}}"
                            data-username="{{ $u->username }}"
                            data-role="{{ $u->role }}"
                            data-bs-toggle="modal"
                            data-bs-target="#editMemberModal">
                            Edit
                        </button>
                        <a href="{{ route('admin.deleteMember', $u->id) }}"
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


{{-- ---------------------- MODAL ADD MEMBER ---------------------- --}}
<div class="modal fade" id="addMemberModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">Tambah Member</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <form action="{{ route('admin.addmember') }}" method="POST">
        @csrf

        <div class="modal-body">

            <div class="mb-3">
                <label>Nama</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Kontak</label>
                <input type="text" name="kontak" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Username</label>
                <input type="text" name="username" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Role</label>
                <select name="role" class="form-control">
                    <option value="member">Member</option>
                    <option value="admin">Admin</option>
                </select>
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


{{-- ---------------------- MODAL EDIT MEMBER ---------------------- --}}
<div class="modal fade" id="editMemberModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">Edit Member</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      {{-- FORM UPDATE (PUT) --}}
      <form action="{{ route('admin.updateMember') }}" method="POST">
        @csrf
        @method('PUT') {{-- Penting untuk request UPDATE --}}

        {{-- Untuk mengirim ID ke backend --}}
        <input type="hidden" name="id" id="edit_id">

        <div class="modal-body">

            <div class="mb-3">
                <label>Nama</label>
                <input type="text" name="name" id="edit_name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Kontak</label>
                <input type="text" name="kontak" id="edit_kontak" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Username</label>
                <input type="text" name="username" id="edit_username" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Password</label>
                <input type="text" name="password" id="edit_password" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Role</label>
                <select name="role" id="edit_role" class="form-control">
                    <option value="member">Member</option>
                    <option value="admin">Admin</option>
                </select>
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
    $('#userTable').DataTable();

    // ----------------------------------------
    // FUNGSI UNTUK MENGISI MODAL EDIT
    // ----------------------------------------
    $('.btnEdit').on('click', function() {

        // Ambil data dari atribut tombol edit
        $('#edit_id').val($(this).data('id'));
        $('#edit_password').val($(this).data('password'))
        $('#edit_name').val($(this).data('name'));
        $('#edit_kontak').val($(this).data('kontak'));
        $('#edit_username').val($(this).data('username'));
        $('#edit_role').val($(this).data('role'));
    });
});
</script>

@endsection

