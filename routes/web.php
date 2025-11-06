<?php

use App\Http\Controllers\adminController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/admin/dashboard', [adminController::class, 'dashboard'])->name('admin.dashboard');
