<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategori';
    protected $primaryKey = 'id_kategori';
    public $timestamps = false; // ✅ WAJIB: karena tabel tidak punya created_at/updated_at

    protected $fillable = ['nama_kategori'];
    public function produk()
    {
        return $this->hasMany(DataProduk::class, 'kategori_id');
    }
}
