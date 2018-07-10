<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(JenisLaundrySeeder::class);
        $this->call(PelangganSeeder::class);
        $this->call(UserSeeder::class);
    }
}
