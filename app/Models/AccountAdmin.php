<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class AccountAdmin extends Authenticatable
{
    use Notifiable;

    protected $table = 'account_admin';
    protected $primaryKey = 'id_admin';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['nama', 'email', 'password'];
    protected $hidden = ['password', 'remember_token'];

    // Jika kamu ingin pakai remember me
    public function getAuthPassword()
    {
        return $this->password;
    }
}