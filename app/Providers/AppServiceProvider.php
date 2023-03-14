<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use App\Models\Menu;
use App\Models\Menuitem;
use View;
use DB;
use Illuminate\Support\Facades\App;

use Laravel\Passport\Console\ClientCommand;
use Laravel\Passport\Console\InstallCommand;
use Laravel\Passport\Console\KeysCommand;
use Laravel\Passport\Passport;


class AppServiceProvider extends ServiceProvider
{   
    public function register()
    {
        //
    }   
    public function boot()
    {     
    Passport::routes();

    /*ADD THIS LINES*/
    $this->commands([
        InstallCommand::class,
        ClientCommand::class,
        KeysCommand::class,
    ]);

       // view()->composer('*', function($view){
        //             $view->with('name','Md Rashedul Karim');
        // } );      
        view()->composer(            
            ['menu.header',
            'menu.footer',
            'menu.sidebar'], 
                // '*', // any where display 
                function ($view) {
                $topNavItems='';
                $topNavItems2 ='';            
                $topNavItems3 ='';            
                $topNav = Menu::where('location', 1)->first();
                $topNavItems = json_decode($topNav->content);
                $topNavItems = $topNavItems[0];             
                foreach($topNavItems as $menu){                
            
                $menu->title_en = Menuitem::where('id',$menu->id)->value('title_en');
                $menu->name_en = Menuitem::where('id',$menu->id)->value('name_en');
                $menu->slug_en = Menuitem::where('id',$menu->id)->value('slug_en');  
                
                
                $menu->title_bn = Menuitem::where('id',$menu->id)->value('title_bn');
                $menu->name_bn = Menuitem::where('id',$menu->id)->value('name_bn');
                $menu->slug_bn = Menuitem::where('id',$menu->id)->value('slug_bn');

                $menu->target = Menuitem::where('id',$menu->id)->value('target');
                $menu->type = Menuitem::where('id',$menu->id)->value('type');
                if(!empty($menu->children[0])){
                    foreach ($menu->children[0] as $child) {
                        $child->title_en = Menuitem::where('id',$child->id)->value('title_en');
                        $child->name_en = Menuitem::where('id',$child->id)->value('name_en');
                        $child->slug_en = Menuitem::where('id',$child->id)->value('slug_en');    
                        
                        $child->title_bn = Menuitem::where('id',$child->id)->value('title_bn');
                        $child->name_bn = Menuitem::where('id',$child->id)->value('name_bn');
                        $child->slug_bn = Menuitem::where('id',$child->id)->value('slug_bn');

                        $child->target = Menuitem::where('id',$child->id)->value('target');
                        $child->type = Menuitem::where('id',$child->id)->value('type');
                            if(isset($child->children[0])){
                                foreach ($child->children[0] as $chil) {
                                    $chil->title_en = Menuitem::where('id',$chil->id)->value('title_en');
                                    $chil->name_en = Menuitem::where('id',$chil->id)->value('name_en');
                                    $chil->slug_en = Menuitem::where('id',$chil->id)->value('slug_en');     
                                    
                                    
                                    $chil->title_bn = Menuitem::where('id',$chil->id)->value('title_bn');
                                    $chil->name_bn = Menuitem::where('id',$chil->id)->value('name_bn');
                                    $chil->slug_bn = Menuitem::where('id',$chil->id)->value('slug_bn');

                                    $chil->target = Menuitem::where('id',$chil->id)->value('target');
                                    $chil->type = Menuitem::where('id',$chil->id)->value('type');
                                            // print_r($chil->title);
                                } 
                            }
                        }  
                    }
                }
                // ============Footer Menu=================
                $topNav2 = Menu::where('location', 2)->first();
                if(isset($topNav2->content)){
                $topNavItems2 = json_decode($topNav2->content);
                $topNavItems2 = $topNavItems2[0];             
                foreach($topNavItems2 as $menu){

                $menu->title_en = Menuitem::where('id',$menu->id)->value('title_en');
                $menu->name_en = Menuitem::where('id',$menu->id)->value('name_en');
                $menu->slug_en = Menuitem::where('id',$menu->id)->value('slug_en');  
                
                
                $menu->title_bn = Menuitem::where('id',$menu->id)->value('title_bn');
                $menu->name_bn = Menuitem::where('id',$menu->id)->value('name_bn');
                $menu->slug_bn = Menuitem::where('id',$menu->id)->value('slug_bn');


                $menu->target = Menuitem::where('id',$menu->id)->value('target');
                $menu->type = Menuitem::where('id',$menu->id)->value('type');
                if(!empty($menu->children[0])){
                    foreach ($menu->children[0] as $child) {    

                        $child->title_en = Menuitem::where('id',$child->id)->value('title_en');
                        $child->name_en = Menuitem::where('id',$child->id)->value('name_en');
                        $child->slug_en = Menuitem::where('id',$child->id)->value('slug_en');    
                        
                        $child->title_bn = Menuitem::where('id',$child->id)->value('title_bn');
                        $child->name_bn = Menuitem::where('id',$child->id)->value('name_bn');
                        $child->slug_bn = Menuitem::where('id',$child->id)->value('slug_bn');

                        $child->target = Menuitem::where('id',$child->id)->value('target');
                        $child->type = Menuitem::where('id',$child->id)->value('type');
                            if(isset($child->children[0])){
                                foreach ($child->children[0] as $chil) {

                                    $chil->title_en = Menuitem::where('id',$chil->id)->value('title_en');
                                    $chil->name_en = Menuitem::where('id',$chil->id)->value('name_en');
                                    $chil->slug_en = Menuitem::where('id',$chil->id)->value('slug_en');     
                                    
                                    
                                    $chil->title_bn = Menuitem::where('id',$chil->id)->value('title_bn');
                                    $chil->name_bn = Menuitem::where('id',$chil->id)->value('name_bn');
                                    $chil->slug_bn = Menuitem::where('id',$chil->id)->value('slug_bn');

                                    $chil->target = Menuitem::where('id',$chil->id)->value('target');
                                    $chil->type = Menuitem::where('id',$chil->id)->value('type');
                                            // print_r($chil->title);
                                } 
                            }
                        }  
                        
                    }
                }
            }
              // =============Sidebar================
                $topNav3 = Menu::where('location', 3)->first();  
            if($topNav3){
            $topNavItems3 = json_decode($topNav3->content);
            $topNavItems3 = $topNavItems3[0];  
            foreach($topNavItems3 as $menu){  

                $menu->title_en = Menuitem::where('id',$menu->id)->value('title_en');
                $menu->name_en = Menuitem::where('id',$menu->id)->value('name_en');
                $menu->slug_en = Menuitem::where('id',$menu->id)->value('slug_en');  
                
                
                $menu->title_bn = Menuitem::where('id',$menu->id)->value('title_bn');
                $menu->name_bn = Menuitem::where('id',$menu->id)->value('name_bn');
                $menu->slug_bn = Menuitem::where('id',$menu->id)->value('slug_bn');
                
                $menu->target = Menuitem::where('id',$menu->id)->value('target');
                $menu->type = Menuitem::where('id',$menu->id)->value('type');

                if(!empty($menu->children[0])){
                    foreach ($menu->children[0] as $child) {

                        $child->title_en = Menuitem::where('id',$child->id)->value('title_en');
                        $child->name_en = Menuitem::where('id',$child->id)->value('name_en');
                        $child->slug_en = Menuitem::where('id',$child->id)->value('slug_en');    
                        
                        $child->title_bn = Menuitem::where('id',$child->id)->value('title_bn');
                        $child->name_bn = Menuitem::where('id',$child->id)->value('name_bn');
                        $child->slug_bn = Menuitem::where('id',$child->id)->value('slug_bn');

                        $child->target = Menuitem::where('id',$child->id)->value('target');
                        $child->type = Menuitem::where('id',$child->id)->value('type');
                        if(isset($child->children[0])){

                            foreach ($child->children[0] as $chil) {

                                    $chil->title_en = Menuitem::where('id',$chil->id)->value('title_en');
                                    $chil->name_en = Menuitem::where('id',$chil->id)->value('name_en');
                                    $chil->slug_en = Menuitem::where('id',$chil->id)->value('slug_en');     
                                    
                                    
                                    $chil->title_bn = Menuitem::where('id',$chil->id)->value('title_bn');
                                    $chil->name_bn = Menuitem::where('id',$chil->id)->value('name_bn');
                                    $chil->slug_bn = Menuitem::where('id',$chil->id)->value('slug_bn');

                                $chil->target = Menuitem::where('id',$chil->id)->value('target');
                                $chil->type = Menuitem::where('id',$chil->id)->value('type');
                                        // print_r($chil->title);
                                } 
                            }
                    }  
                }
            }
        }
                
                $view->with([
                    'topNavItems'=> $topNavItems,
                    'topNavItems2'=> $topNavItems2,
                    'topNavItems3'=> $topNavItems3]);
            }
        );

        // Paginator::defaultView('asset.pagination');   
        Paginator::useBootstrap();
    }
}