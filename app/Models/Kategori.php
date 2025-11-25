<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    //
    protected $guarded = [];

    public function Product(){
        return $this -> hasMany(Produk::class,'kategori_id');
    }
}
