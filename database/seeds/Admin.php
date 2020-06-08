<?php

use App\Models\User as User;
use Illuminate\Database\Seeder;

class Admin extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pass = crc32('admin');


        User::create([
            'name' => 'admin',
            'surname' => 'admin',
            'email' => 'admin',
            'phone' => 123,
            'username' => 'admin',
            'password' => $pass,
            'experience' => 1000,
            'sallary' => 10000,
            'home' => true,
            'role' => 'admin',
            'token' => '',
            'technology' => []
        ]);
    }
}
