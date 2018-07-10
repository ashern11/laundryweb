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
            CREATE FUNCTION peditharga() RETURNS TRIGGER AS $$
            BEGIN
                NEW.total := (NEW.jumlah * (SELECT harga FROM jenis_laundry WHERE id_jenis=New.id_jenis));
            END;
            $$ LANGUAGE plpgsql;
                
            CREATE TRIGGER editharga BEFORE UPDATE ON transaksi_tmp
                FOR EACH ROW EXECUTE PROCEDURE peditharga();
        ');

        DB::unprepared('
            CREATE FUNCTION ptotalharga() RETURNS TRIGGER AS $$
            BEGIN
                New.total := (New.jumlah * (SELECT harga FROM jenis_laundry WHERE id_jenis=New.id_jenis));
            END;
            $$ LANGUAGE plpgsql;
                
            CREATE TRIGGER totalharga BEFORE INSERT ON transaksi_tmp
                FOR EACH ROW EXECUTE PROCEDURE ptotalharga();
        ');

        DB::unprepared('
            CREATE FUNCTION pedithargadetail() RETURNS TRIGGER AS $$
            BEGIN
                New.total := (New.jumlah * (SELECT harga FROM jenis_laundry WHERE id_jenis=New.id_jenis));
            END;
            $$ LANGUAGE plpgsql;
                
            CREATE TRIGGER edithargadetail BEFORE INSERT ON transaksi_detail
                FOR EACH ROW EXECUTE PROCEDURE pedithargadetail();
        ');

        DB::unprepared('
            CREATE FUNCTION ptotalhargadetail() RETURNS TRIGGER AS $$
            BEGIN
                New.total := (New.jumlah * (SELECT harga FROM jenis_laundry WHERE id_jenis=New.id_jenis));

                New.total := (New.jumlah * (SELECT harga FROM jenis_laundry WHERE id_jenis=New.id_jenis));
            END;
            $$ LANGUAGE plpgsql;
                
            CREATE TRIGGER totalhargadetail BEFORE INSERT ON transaksi_detail
                FOR EACH ROW EXECUTE PROCEDURE ptotalhargadetail();
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
