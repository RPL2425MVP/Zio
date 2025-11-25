<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataProduk extends Model
{
   protected $table = 'data_produk';
    protected $primaryKey = 'id_produk';
    public $timestamps = true;

    protected $fillable = ['nama_produk', 'id_kategori', 'jenis', 'harga', 'stok', 'deskripsi'];

    public function foto()
    {
        return $this->hasOne(FotoProduk::class, 'id_produkfoto', 'id_produk');


    }
 public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id_kategori');
    }
}   