<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaksitmp extends Model
{
    protected $table = 'transaksi_tmp';
    protected $primaryKey = 'no';
    protected $fillable = ['tm_nota','id_jenis', 'jumlah'];
    public $timestamps = false;
}
