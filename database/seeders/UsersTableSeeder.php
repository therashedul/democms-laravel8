<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
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
            'role_id' => '1',
            'status_id' => '1',
            'is_email_verified' => '1',  // If email verified then use this line
            'name' => 'superAdmin',
            'email' => 'superadmin@gmail.com',
            'password' => bcrypt('123456789'),
        ]);
        DB::table('users')->insert([
            'role_id' => '2',
            'status_id' => '1',
            'is_email_verified' => '1', // If email verified then use this line
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123456789'),
        ]);
        DB::table('users')->insert([
            'role_id' => '3',
            'status_id' => '1',
            'is_email_verified' => '1',  // If email verified then use this line
            'name' => 'user',
            'email' => 'user@gmail.com',
            'password' => bcrypt('123456789'),
        ]);

    }
}
