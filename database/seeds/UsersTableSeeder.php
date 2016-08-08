<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@arevainna.com',
            'username' => 'admin',
            'phone' => '123456m',
            'address' => 'singapore',
            'role' => '1',
            'password' => bcrypt('admin'),
            'key' => uniqid(),
        ]);
    }
}
