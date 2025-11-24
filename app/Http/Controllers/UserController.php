<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Toko;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function memberHome(){
    $data['tokos'] = Toko::latest()->where('status','active')->take(9)->get();

    $data['produks'] = Produk::with(['toko', 'kategori', 'Gambar'])
                              ->latest()
                              ->get();

    return view('user.home', $data);
    }

    public function toko($id){
        $toko = Toko::findOrFail($id);
        $produks = Produk::with('Gambar')->where('toko_id', $toko->id)->get();

        return view('user.tokodetail', compact('toko', 'produks'));
    }
    public function produk(){
        $data['produks'] = Produk::with(['toko', 'kategori', 'Gambar'])
                                  ->latest()
                                  ->get();

        return view('user.produk', $data);
    }
}
