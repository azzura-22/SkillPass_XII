<?php

namespace App\Http\Controllers;

use App\Models\Gambar;
use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class memberController extends Controller
{
    //
    public function dashboard(){
        return view('membe.dashboard');
    }

    public function produk()
    {
        $toko_id = Auth::user()->Toko->id;
        $data['produks'] = Produk::with('Gambar')
                                ->where('toko_id', $toko_id)
                                ->get();
        $data['kategori'] = Kategori::all();
        return view('membe.produk', $data);
    }
}
