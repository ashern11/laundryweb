<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = 'admin';
    protected $primaryKey = 'id_user';
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama_pengguna', 'nama_lengkap', 'email', 'sandi',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'sandi', 'remember_token',
    ];

    public function getAuthPassword()
    {
        return $this->sandi;
    }
}
