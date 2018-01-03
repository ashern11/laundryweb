<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaksidetail extends Model
{
    protected $table = 'transaksi_detail';
    protected $fillable = ['tm_nota','id_jenis', 'jumlah'];
    public $timestamps = false;
}
