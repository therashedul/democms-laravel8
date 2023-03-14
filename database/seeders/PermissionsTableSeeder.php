<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;
use DB;


class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $data = [
            'menu-users',
            'menu-roles',
            'menu-permissions', 
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',            
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
            'user-status',
            'permission-list',
            'permission-create',
            'permission-edit',
            'permission-delete',
            
            'menu-black',
            'menu-white',  
            'menu-media',
            'menu-category',
            'menu-post',
            'menu-page',
            'menu-comments',
            'menu-menus',
            'menu-csv',
            'menu-slider',
            'menu-language',
            'menu-databasebackup',
            'menu-loginhistory',
            
            'sider-status',

            'category-status',
            'category-deleted',
            'category-edit',
            'category-create',
            'category-privatecat',

           ' post-show',
            'post-status',  
	        'post-slider',
	        'post-archive',
	        'post-delete',
	        'post-edit',
	        'post-create',
	        'post-search',
	        'post-multipledelete',
	        'post-privateshow',

            'page-archive',	  
            'page-status',
            'page-multipledelete',
            'page-search',
            'page-deleted',
            'page-edit',
            'page-create',
            'page-privatepage',

            'language-create',
            'language-edit',
            
        ];

        foreach ($data as $permission) {
             Permission::create(['name' => $permission]);
        }

    }
}
