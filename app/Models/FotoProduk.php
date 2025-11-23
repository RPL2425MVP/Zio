<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FotoProduk extends Model
{
     protected $table = 'foto_produk';
    protected $primaryKey = 'id_foto';
    public $timestamps = false;

    protected $fillable = ['id_produkfoto', 'foto'];
}