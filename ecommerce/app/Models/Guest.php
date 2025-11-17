<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Guest extends Authenticatable
{
    use Notifiable;

    protected $table = 'account_user';
    protected $primaryKey = 'id_user';
    public $timestamps = true;

    protected $fillable = [
        'nama',
        'no_telp',
        'email',
        'password',
        'provinsi',
        'kota',
        'daerah',
        'kode_pos',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}