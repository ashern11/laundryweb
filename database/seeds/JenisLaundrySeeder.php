<?php

use Illuminate\Database\Seeder;

use App\Jenislaundry;

class JenisLaundrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Jenislaundry::create([
            'jenis' => 'Baju Kaos',
            'satuan' => 'kg',
            'harga' => '10000'
        ]);

        Jenislaundry::create([
            'jenis' => 'Celana Jeans',
            'satuan' => 'kg',
            'harga' => '20000'
        ]);

        Jenislaundry::create([
            'jenis' => 'Kaos Kaki',
            'satuan' => '1Pasang',
            'harga' => '1000'
        ]);
    }
}
