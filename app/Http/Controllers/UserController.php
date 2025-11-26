<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Produk;
use App\Models\Toko;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function memberHome(Request $request){
    $kategori_id = $request->query('kategori_id');

    $fillkat = Produk::with(['Gambar', 'toko', 'kategori'])->latest();

    if ($kategori_id) {
        $fillkat->where('kategori_id', $kategori_id);
    }

    $produks = $fillkat->take(8)->get();
    $tokos = Toko::latest()->take(4)->where('status','active')->get();
    $kategori = Kategori::all();

    return view('user.home', compact('produks', 'tokos', 'kategori', 'kategori_id'));
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
