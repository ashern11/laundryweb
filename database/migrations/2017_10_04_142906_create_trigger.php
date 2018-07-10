<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
        CREATE TRIGGER editharga BEFORE UPDATE ON "transaksi_tmp" FOR EACH ROW
            BEGIN
                SET New.total = New.jumlah * (SELECT harga FROM jenis_laundry WHERE id_jenis=New.id_jenis);
            END
        ');

        DB::unprepared('
        CREATE TRIGGER totalhargad BEFORE INSERT ON "transaksi_tmp" FOR EACH ROW
            BEGIN
                SET New.total = New.jumlah * (SELECT harga FROM jenis_laundry WHERE id_jenis=New.id_jenis);
            END
        ');

        DB::unprepared('
        CREATE TRIGGER edithargadetail BEFORE UPDATE ON "transaksi_detail" FOR EACH ROW
            BEGIN
                SET New.total = New.jumlah * (SELECT harga FROM jenis_laundry WHERE id_jenis=New.id_jenis);
            END
        ');

        DB::unprepared('
        CREATE TRIGGER totalhargadetail BEFORE INSERT ON `transaksi_detail` FOR EACH ROW
            BEGIN
                SET New.total = New.jumlah * (SELECT harga FROM jenis_laundry WHERE id_jenis=New.id_jenis);
            END
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}   
