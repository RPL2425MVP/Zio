<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class AccountAdmin extends Model
{
    protected $table = 'account_admin';
    protected $primaryKey = 'id_admin';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['nama', 'email', 'password'];
}
