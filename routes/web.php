<?php

use App\Http\Controllers\adminController;
use App\Http\Controllers\GambarController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\memberController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\TokoController;
use App\Http\Controllers\UserController;
use App\Models\Produk;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;
use Termwind\Components\Raw;

Route::get('/',[UserController::class,'memberHome'])->name('user.dashboard');
Route::get('/login',[adminController::class,'loginView'])->name('login');
Route::post('/login/post',[adminController::class,'login'])->name('login.post');
Route::get('/regis',[adminController::class,'regisview'])->name('regis');
Route::post('/register/post',[adminController::class,'register'])->name('register.post');
Route::get('/produk',[UserController::class,'produk'])->name('user.produk');

Route::middleware(['admin'])->group(function () {
    Route::get('/admin/dashboard', [adminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/useradmin', [adminController::class, 'userA'])->name('admin.useradmin');
    Route::get('/logout/admin',[adminController::class,'logout'])->name('logout');
    Route::post('/admin/addmember',[adminController::class,'addmember'])->name('admin.addmember');
    Route::put('/admin/updatemember', [adminController::class, 'updateMember'])->name('admin.updateMember');
    Route::get('/admin/del/{id}', [adminController::class, 'deleteMember'])->name('admin.deleteMember');
    Route::get('/admin/kategori',[KategoriController::class,'index'])->name('admin.kategori');
    Route::post('/admin/kategori/store',[KategoriController::class,'store'])->name('admin.kategori.store');
    Route::put('/admin/kategori/update',[KategoriController::class,'Update'])->name('admin.kategori.update');
    Route::get('/admin/kategori/delete/{id}',[KategoriController::class,'delete'])->name('admin.kategori.delete');
    Route::get('/admin/toko', [TokoController::class, 'index'])->name('admin.toko.index');
    Route::post('/admin/toko/store', [TokoController::class, 'store'])->name('admin.toko.store');
    Route::put('/admin/toko/update', [TokoController::class, 'update'])->name('admin.toko.update');
    Route::get('/admin/toko/delete/{id}', [TokoController::class, 'delete'])->name('admin.toko.delete');
    Route::get('/edit/{id}', [adminController::class, 'edit'])->name('admin.kategori.edit');
    Route::get('/admin/produk', [adminController::class, 'produk'])->name('admin.produk');
    Route::get('/admin/produk/delete/{id}', [adminController::class, 'deleteproduk'])->name('admin.produk.delete');
    Route::post('/admin/toko/approve/{id}', [TokoController::class, 'approve'])->name('member.approve.toko');
    Route::post('/admin/Toko/tolak/{id}',[TokoController::class,'reject'])->name('member.tolak.toko');
    Route::get('/admin/foto',[GambarController::class,'gambar'])->name('gambar.admin');
    Route::post('/member/gambar/tambah', [GambarController::class, 'gambartambah'])->name('gambar.tambah');
    Route::post('/member/gambar/ubah/{id}', [GambarController::class, 'gambarUbah'])->name('gambar.ubah');
    Route::get('/member/gambar/hapus/{id}', [GambarController::class, 'gambarHapus'])->name('gambar.hapus');
});
Route::middleware(['member'])->group(function(){
    Route::get('/member/dashboard',[memberController::class,'dashboard'])->name('member.dahboard');
    Route::post('/member/produk/store',[ProdukController::class,'store'])->name('produk.store');
    Route::get('/member/prodak',[memberController::class,'produk'])->name('member.prodak');
    Route::put('member/produk/update',[ProdukController::class,'update'])->name('produk.update');
    Route::get('/member/delete/{id}',[ProdukController::class,'destroy'])->name('produk.delete');
    Route::post('/member/toko/store',[memberController::class,'store'])->name('member.toko.store');
    Route::put('/member/toko/update/',[memberController::class,'update'])->name('member.toko.update');
    Route::get('/member/gambar/',[GambarController::class,'index'])->name('member.gambar');
    Route::post('/member/gambar/store',[GambarController::class,'store'])->name('member.gambar.store');
    Route::get('/member/gambar/delete/{id}',[GambarController::class,'delete'])->name('member.gambar.delete');
    Route::put('/member/gambar/update/{id}',[GambarController::class,'update'])->name('member.gambar.update');
    Route::get('/member/kategori',[memberController::class,'kategori'])->name('member.kategori');
    Route::post('/member/kategori/add',[memberController::class,'addkategori'])->name('member.add.kategori');
    Route::put('/member/kategori/update',[memberController::class,'UpdateKategori'])->name('member.update.kategori');
    Route::get('/member/kategori/edit/{id}',[memberController::class,'edit'])->name('edit.view.kategori');
    Route::post('member/gambar/produk/{id}',[memberController::class,'addGambar'])->name('gambar.tambah');
    Route::get('/logout/user',[adminController::class,'logout'])->name('logout.user');
});
Route::get('/member/toko/detail/{id}',[UserController::class,'toko'])->name('member.toko.detail');
Route::get('/produk/detail/{id}',[ProdukController::class,'show'])->name('produk.detail');
Route::get('/user/toko',[TokoController::class,'toko'])->name('toko.user');
Route::get('/search', [memberController::class, 'search'])->name('user.search');
