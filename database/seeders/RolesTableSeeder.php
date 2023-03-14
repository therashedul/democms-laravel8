<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
  public function run()
    {
        DB::table('roles')->insert([
            'name' => 'superAdmin',
            'slug' => 'superAdmin',
        ]);

        DB::table('roles')->insert([
            'name' => 'admin',
            'slug' => 'admin',
        ]);
        
        DB::table('roles')->insert([
            'name' => 'user',
            'slug' => 'user',
        ]);
    }

}
