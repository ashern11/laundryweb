<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'nama_pengguna' =>   'admin',
            'sandi' => bcrypt('admin123'),
            'email' => 'adminlaundry@mailinator.com',
            'nama_lengkap' => 'Admin Ganteng',
            'remember_token' => str_random(10)
        ]);
    }
}
