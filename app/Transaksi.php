<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksi';
    protected $primaryKey = 'tm_nota';
    protected $fillable = ['id_user','id_pelanggan', 'tm_total', 'bayar'];
    public $timestamps = true;
}
