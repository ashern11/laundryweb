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
        DROP FUNCTION peditharga();
        DROP FUNCTION pedithargadetail();

        CREATE FUNCTION peditharga() RETURNS TRIGGER AS $$
        BEGIN
            NEW.total := (NEW.jumlah * (SELECT harga FROM jenis_laundry WHERE id_jenis=New.id_jenis));
        END;
        $$ LANGUAGE plpgsql;
            
        CREATE TRIGGER editharga BEFORE INSERT OR UPDATE ON transaksi_tmp
            FOR EACH ROW EXECUTE PROCEDURE peditharga();


        CREATE FUNCTION pedithargadetail() RETURNS TRIGGER AS $$
        BEGIN
            New.total := (New.jumlah * (SELECT harga FROM jenis_laundry WHERE id_jenis=New.id_jenis));
        END;
        $$ LANGUAGE plpgsql;
            
        CREATE TRIGGER edithargadetail BEFORE INSERT OR UPDATE ON transaksi_detail
            FOR EACH ROW EXECUTE PROCEDURE pedithargadetail();
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
