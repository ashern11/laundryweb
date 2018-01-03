<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jenislaundry extends Model
{
    protected $table = 'jenis_laundry';
    protected $primaryKey = 'id_jenis';
    protected $fillable = ['jenis','satuan', 'harga'];
    public $timestamps = false;
}
