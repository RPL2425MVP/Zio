<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ulasan extends Model
{
    protected $table = 'ulasan';
    protected $primaryKey = 'id_ulasan';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['id_user', 'id_produk', 'rating', 'komentar'];
    public $timestamps = false;
}
