<?php

namespace App\Providers;
// use Illuminate\Support\ServiceProvider;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class CustomRouteServiceProvider extends ServiceProvider
{
    public function register()
    {
       
    }
    public function boot()
    {
        $this->superAdmin();
        $this->admin();
        $this->user();
    }
    // superAdmin
    private function superAdmin(){
             Route::middleware('web','superAdmin')             
                ->namespace($this->namespace)
                ->group(base_path('routes/superAdmin.php')); 
    }   
    // admin
     private function admin(){
            Route::middleware('web','admin')             
                ->namespace($this->namespace)
                ->group(base_path('routes/admin.php')); 
    }  
    // user
    private  function user(){
             Route::middleware('web','user')             
                ->namespace($this->namespace)
                ->group(base_path('routes/user.php')); 
    }

     
}
