<?php
// app/Models/User.php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $table = 'pengguna';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nama', 'email', 'password', 'no_telepon', 'alamat', 'role'
    ];

    protected $hidden = [
        'password',
    ];

    public function getIdAttribute()
    {
        return $this->attributes[$this->primaryKey];
    }
}
