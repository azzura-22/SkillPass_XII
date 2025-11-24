<?php

namespace App\Http\Controllers;

use App\Models\Gambar;
use App\Models\Kategori;
use App\Models\Produk;
use App\Models\Toko;
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
        $data['produks'] = Produk::with(['toko', 'kategori', 'Gambar'])
                         ->where('toko_id', $toko_id)
                         ->latest()
                         ->get();
        $data['kategori'] = Kategori::all();
        return view('membe.produk', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_toko' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'logo_toko' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'alamat'    => 'required|string',
        ]);

        $logo = null;

        if ($request->hasFile('logo_toko')) {
            $file = $request->file('logo_toko');
            $logo = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('storage/logotoko'), $logo);
        }

        Toko::create([
            'user_id' => Auth::id(),
            'alamat' => $request->alamat,
            'kontak_toko' => Auth::user()->kontak,
            'nama_toko' => $request->nama_toko,
            'status' => 'pending',
            'deskripsi' => $request->deskripsi,
            'gambar' => $logo,
        ]);

        return back()->with('success', 'Toko berhasil dibuat!');
    }
    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'nama_toko' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'logo_toko' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $toko = Toko::findOrFail($request->id);

        $fileName = $toko->gambar;

        if ($request->hasFile('logo_toko')) {
            if ($toko->gambar && file_exists(public_path('storage/logotoko/'.$toko->gambar))) {
                unlink(public_path('storage/logotoko/'.$toko->gambar));
            }

            $file = $request->file('logo_toko');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('storage/logotoko'), $fileName);
        }

        $toko->update([
            'nama_toko' => $request->nama_toko,
            'deskripsi' => $request->deskripsi,
            'gambar'    => $fileName
        ]);

        return back()->with('success','Toko berhasil diperbarui!');
    }
    public function kategori (){
        $data['kategori'] = Kategori::all();
        return view('membe.kategori',$data);
    }
    public function addkategori (Request $request){
        $request -> validate([
            'nama_kategori' => 'required'
        ]);
        Kategori::create([
            'nama_katgori' => $request -> nama_kategori
        ]);
        return redirect() -> back() -> with ('success', 'Kategori Berhasil Ditambahkan');
    }
    public function UpdateKategori (Request $request){
        Kategori::where('id',$request -> id)->Update([
            'nama_katgori' => $request -> nama_katgori
        ]);
        return redirect() -> back() -> with ('success', 'Kategori Berhasil Diupdate');
    }
    public function edit($id)
    {
        $kategoriEdit = Kategori::findOrFail($id);
        $kategori = Kategori::all();

        return view('membe.kategori', compact('kategori', 'kategoriEdit'));
    }

    public function addGambar ( Request $request ,$id){
        $produk = Produk::find($id);

        $request->validate([
            'gambar_produk.*'  => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        foreach ($request->file('gambar_produk') as $file) {

            $namaFile = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('storage/imageproduk'), $namaFile);

            Gambar::create([
                'produk_id'   => $produk->id,
                'path_gambar' => $namaFile,
            ]);
        }

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan!');
    }
    public function search(Request $request)
    {
        $q = $request->input('q');

        // Cari produk berdasarkan nama
        $produks = Produk::with('toko', 'Gambar')
            ->where('nama_produk', 'like', "%$q%")
            ->get();

        // Cari toko berdasarkan nama
        $tokos = Toko::where('nama_toko', 'like', "%$q%")
            ->get();

        return view('user.search', compact('produks', 'tokos', 'q'));
    }
}
