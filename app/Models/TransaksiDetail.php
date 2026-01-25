<?php

// app/Models/TransaksiDetail.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransaksiDetail extends Model
{
    public $timestamps = false; // ← Tambahkan ini!
    protected $table = 'transaksi_detail';
    protected $fillable = ['id_transaksi', 'id_produk', 'jumlah', 'harga_satuan'];

    public function produk()
    {
        return $this->belongsTo(DataProduk::class, 'id_produk', 'id_produk');
    }

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'id_transaksi', 'id_transaksi');
    }
}
