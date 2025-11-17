<?php

use App\Http\Controllers\adminController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\TokoController;
use App\Http\Controllers\UserController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;

Route::get('/',[UserController::class,'memberHome'])->name('user.dashboard');
Route::get('/login',[adminController::class,'loginView'])->name('login');
Route::post('/login/post',[adminController::class,'login'])->name('login.post');
Route::get('/regis',[adminController::class,'regisview'])->name('regis');
Route::post('/register/post',[adminController::class,'register'])->name('register.post');
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
});
Route::middleware(['user'])->group(function(){
    Route::get('/logout/user',[adminController::class,'logout'])->name('logout.user');
});
