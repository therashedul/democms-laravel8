<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use DB;
use Illuminate\Support\Facades\Log;

class postUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'minute:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Post update every minute';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle() {  
       
    //   \Log::info("This is log");
    
            $this->postupdate();
            $this->pageupdate();
       
        // $now=date("Y-m-d H:i");
        // $posts = DB::table('posts')
        //         ->where('status','=', '0')
        //         ->whereDate('publish_at','<=', $now)                  
        //         ->get();
        //     // update statistics table 
        //   foreach($posts as $post)
        //     {
        //         if($post->publish_at == $now){
        //             DB::table('posts')
        //             ->where('id', $post->id)
        //             ->update(['status' => '1']);
        //         }
        //     }

        // 2nd way post update
        //    $now=date("Y-m-d H:i");
        //     $data=DB::table('posts')->where('status',0)->whereRaw("date(publish_at)<'$now'")->get();
        //     $data->each(function ($item){
        //     DB::table('posts')->where('id',$item->id)->update(['status'=>1]);
        //     });
        // return $data;
    }
    
    
    public function postupdate(){
          $now=date("Y-m-d H:i");
        $posts = DB::table('posts')
                 ->where('status','=', '0')
                 ->whereDate('publish_at','<=', $now)                  
                 ->get();
             // update statistics table 
            foreach($posts as $post){
                 if($post->publish_at == $now){
                     DB::table('posts')
                     ->where('id', $post->id)
                    ->update(['status' => '1']);
                 }
             }

    }
     public function pageupdate(){
          $now=date("Y-m-d H:i");
        $pages = DB::table('pages')
                 ->where('status','=', '0')
                 ->whereDate('publish_at','<=', $now)                  
                 ->get();
             // update statistics table 
            foreach($pages as $page){
                 if($page->publish_at == $now){
                     DB::table('pages')
                     ->where('id', $page->id)
                    ->update(['status' => '1']);
                 }
             }
     }

}
