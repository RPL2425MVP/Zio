<?php


// app/Models/Transaksi.php
namespace App\Models;
use Illuminate\Support\Str;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{   
     public $timestamps = false; // ← Tambahkan ini!
    protected $table = 'transaksi';
    protected $primaryKey = 'id_transaksi';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'id_transaksi',
        'id_user',
        'tanggal_transaksi',
        'total_harga',
        'status'
    ];

    public function detail()
    {
        return $this->hasMany(TransaksiDetail::class, 'id_transaksi', 'id_transaksi');
    }

    public function user()
    {
        return $this->belongsTo(Guest::class, 'id_user', 'id_user');
    }
}