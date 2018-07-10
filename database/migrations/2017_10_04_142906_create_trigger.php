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
