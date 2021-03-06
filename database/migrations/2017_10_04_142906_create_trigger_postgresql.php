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

        CREATE FUNCTION peditharga() RETURNS TRIGGER AS $$
        BEGIN
            NEW.total := (NEW.jumlah * (SELECT harga FROM jenis_laundry WHERE id_jenis=NEW.id_jenis));
            RETURN NEW;
        END;
        $$ LANGUAGE plpgsql;
            
        CREATE TRIGGER editharga BEFORE INSERT OR UPDATE ON transaksi_tmp
            FOR EACH ROW EXECUTE PROCEDURE peditharga();

        CREATE TRIGGER edithargadetail BEFORE INSERT OR UPDATE ON transaksi_detail
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
