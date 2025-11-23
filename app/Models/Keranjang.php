<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    protected $table = 'keranjang';
    protected $primaryKey = 'id_keranjang';
    public $timestamps = false; // karena pakai timestamp manual

    // Kolom yang boleh diisi mass assignment
    protected $fillable = ['id_user', 'id_produk', 'jumlah'];

    // Relasi ke User (asumsi tabel users)
    public function user()
    {
        return $this->belongsTo(Guest::class, 'id_user', 'id_user');
    }

    // Relasi ke Produk
    public function produk()
    {
        return $this->belongsTo(DataProduk::class, 'id_produk', 'id_produk');
    }

        public function foto()
    {
        return $this->hasMany(FotoProduk::class, 'id_produkfoto', 'id_produk');


    }

}
