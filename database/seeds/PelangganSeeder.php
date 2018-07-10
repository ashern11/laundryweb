<?php

use Illuminate\Database\Seeder;
use App\Pelanggan;

class PelangganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pelanggan::create([
            'nama' => 'Udin Margodin',
            'alamat' => 'Jl Timur Tengah No 15',
            'telp' => '081441551881'
        ]);

        Pelanggan::create([
            'nama' => 'Ujang Jaeladin',
            'alamat' => 'Jl Margodong No 45',
            'telp' => '089118115112'
        ]);
    }
}
