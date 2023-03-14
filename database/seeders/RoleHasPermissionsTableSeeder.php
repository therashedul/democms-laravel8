<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class RoleHasPermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('role_has_permissions')->insert([
            'role_id' => '1',
            'permission_id' => '1',
        ]);
        DB::table('role_has_permissions')->insert([
            'role_id' => '1',
            'permission_id' => '2',
        ]); 
        DB::table('role_has_permissions')->insert([
            'role_id' => '1',
            'permission_id' => '3',
        ]);
        DB::table('role_has_permissions')->insert([
           'role_id' => '1',
           'permission_id' => '4',
        ]);
         DB::table('role_has_permissions')->insert([
            'role_id' => '1',
            'permission_id' => '5',
        ]);
       DB::table('role_has_permissions')->insert([
            'role_id' => '1',
            'permission_id' => '6',
        ]);
        DB::table('role_has_permissions')->insert([
            'role_id' => '1',
            'permission_id' => '9',
        ]);
        DB::table('role_has_permissions')->insert([
           'role_id' => '1',
           'permission_id' => '10',
        ]);   
        DB::table('role_has_permissions')->insert([
           'role_id' => '1',
           'permission_id' => '11',
        ]);   
        DB::table('role_has_permissions')->insert([
           'role_id' => '1',
           'permission_id' => '13',
        ]);
        DB::table('role_has_permissions')->insert([
           'role_id' => '1',
           'permission_id' => '16',
        ]);       
         DB::table('role_has_permissions')->insert([
           'role_id' => '1',
           'permission_id' => '17',
        ]);     
           DB::table('role_has_permissions')->insert([
           'role_id' => '1',
           'permission_id' => '18',
        ]);      
          DB::table('role_has_permissions')->insert([
           'role_id' => '1',
           'permission_id' => '19',
        ]);      
          DB::table('role_has_permissions')->insert([
           'role_id' => '1',
           'permission_id' => '20',
        ]);      
          DB::table('role_has_permissions')->insert([
           'role_id' => '1',
           'permission_id' => '21',
        ]);     
           DB::table('role_has_permissions')->insert([
           'role_id' => '1',
           'permission_id' => '22',
        ]);       
         DB::table('role_has_permissions')->insert([
           'role_id' => '1',
           'permission_id' => '23',
        ]);

        

    }
}
