<?php

namespace App\Http\Controllers;
use App\Models\User;
use DB;
use App\Models\ImageUpload;
use Image;
use Session;
use App\Models\Menu;
use App\Models\Menuitem;
use App\Models\Category;
use App\Models\Whitelist;
use App\Models\LangChange;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Slider;
use App\Models\Postmeta;
use App\Models\Page;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Artisan;

// try  catch
use Exception;
// use App\Services\PayUService\Exception;
// Event
use App\Events\UserCreated;
// language
use App;
// for softdelete
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Http\Servicecruds\Displaycrud;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class DisplayController extends Controller
{

public function sitemapxml($value=''){
        $posts = Post::latest()->get();       
        return response()->view('sitemap.index', [
            'posts' => $posts
        ])->header('Content-Type', 'text/xml');
}
public function sitemapxmlcategory($value=''){  
    $categories = Category::all();
        return response()->view('sitemap.categories', [
            'categories' => $categories,
        ])->header('Content-Type', 'text/xml');

}

    public function index(){
        return view('env');
    }
    /*
    [ Note: recomanded ]
        https://stackoverflow.com/questions/43040967/accessing-laravel-env-variables-in-blade
    */
    public function artisancommand(){
        try{
            Artisan::call('config:clear');
            Artisan::call('cache:clear');
            exec('composer dump-autoload');    
            Artisan::call('view:clear');
            Artisan::call('route:clear'); 
            return "ok";
        }catch(extension $e){
            return "Not execute";            
        }

    }
    public function appsystemInt(){
        sleep(5);
        // return "3";
            try {
                Artisan::call('application:install');                
                // Artisan::call('migrate');
                return 3;
                
            } 
            catch (\Exception $x) {
                return 2;
            }
            catch (\Error $x) {
                return 2;
            }

            try {
                dd(DB::table('users')->count());
            } 
            catch (\Exception $xx) {
                return 1;
            }
            catch (\Error $xx) {
                return 1;
            }
    }
    public function installmigrate(){
        return view('installApp');
    }   
    /*
    https://stackoverflow.com/questions/40450162/how-to-set-env-values-in-laravel-programmatically-on-the-fly
    */
    public function evnindex(Request $request){
        // // public function evnindex($envKey='', $envValue=''){
        // $envFile = app()->environmentFilePath();
        // $str = file_get_contents($envFile);
        // // $_ENV['APP_NAME'] = "New Project Name";
        // echo env('APP_URL');
        // die();
        $dbhostname =  $request->input('dbhostname');
        $hostvalue = $request->input('hostvalue');

        $dbport =  $request->input('dbport');
        $portvalue = $request->input('portvalue');

        $dbname =  $request->input('dbname');
        $dbvalue = $request->input('dbvalue');

        $dbusername =  $request->input('dbusername');
        $uservalue = $request->input('uservalue');

        $dbpassword =  $request->input('dbpassword');
        $dbpasswordvalue = $request->input('dbpasswordvalue');

        $appname =  $request->input('appname');
        $appvalue = $request->input('appvalue');

        $appenv =  $request->input('appenv');
        $envvalue = $request->input('envvalue');

        $appdebug =  $request->input('appdebug');
        $debugvalue = $request->input('debugvalue');

        $appurl =  $request->input('appurl');
        $urlvalue = $request->input('urlvalue');

        // print_r($request->all());
        // die();

        $values = [

            $dbhostname=>$hostvalue,
            $dbport=>$portvalue,
            $dbname=>$dbvalue,
            $dbusername=>$uservalue,
            $dbpassword=>$dbpasswordvalue,

            $appname=>$appvalue,
            $appenv=>$envvalue,
            $appdebug=>$debugvalue,
            $appurl=>$urlvalue,
        ];
        $envFile = app()->environmentFilePath();
        $str = file_get_contents($envFile);
        $str .= "\n"; // In case the searched variable is in the last line without \n
            if (count($values) > 0) {
            foreach ($values as $envKey => $envValue) {
                $keyPosition = strpos($str, "{$envKey}=");
                $endOfLinePosition = strpos($str,  "\n", $keyPosition);
                // $endOfLinePosition = strpos($str, "\n", $keyPosition); // old line
                $oldLine = substr($str, $keyPosition, $endOfLinePosition - $keyPosition);
                $str = str_replace($oldLine, "{$envKey}={$envValue}", $str);

                // If key does not exist, add it
                // if (!$keyPosition || !$endOfLinePosition || !$oldLine) {
                //     $str .= "{$envKey}={$envValue}";
                // } else {
                //     $str = str_replace($oldLine, "{$envKey}={$envValue}", $str);
                // }
            }

            $str = substr($str, 0, -1);
            $fp = fopen($envFile, 'w');
            fwrite($fp, $str);
            fclose($fp);
            if (!file_put_contents($envFile, $str)) return false;
            return redirect()->route('install')->with('success', "All information added successfully");
            // return \redirect()->back()->with('success', "All information added successfully");
        }



        // $envFile = app()->environmentFilePath();
        // $str = file_get_contents($envFile);
        // $str .= "\n"; // In case the searched variable is in the last line without \n

        // $keyPosition = strpos($str, "{$envKey}=");
        // $endOfLinePosition = strpos($str, PHP_EOL, $keyPosition);
        // $oldLine = substr($str, $keyPosition, $endOfLinePosition - $keyPosition);
        // $str = str_replace($oldLine, "{$envKey}={$envValue}", $str);

        // $str = substr($str, 0, -1);
        // $fp = fopen($envFile, 'w');
        // fwrite($fp, $str);
        // fclose($fp);
    }


    public function firstindex(Request $request, $values=[]) {


        $envFile = app()->environmentFilePath();
            $str = file_get_contents($envFile);

            if (count($values) > 0) {
                foreach ($values as $envKey => $envValue) {

                    $str .= "\n"; // In case the searched variable is in the last line without \n
                    $keyPosition = strpos($str, "{$envKey}=");
                    $endOfLinePosition = strpos($str, "\n", $keyPosition);
                    $oldLine = substr($str, $keyPosition, $endOfLinePosition - $keyPosition);

                    // If key does not exist, add it
                    if (!$keyPosition || !$endOfLinePosition || !$oldLine) {
                        $str .= "{$envKey}={$envValue}\n";
                    } else {
                        $str = str_replace($oldLine, "{$envKey}={$envValue}", $str);
                    }

                }
            }
            $str = substr($str, 0, -1);
            if (!file_put_contents($envFile, $str)) return false;
            return true;


            echo env('APP_URL');
            echo "<br/>";
            echo env('APP_ENV');
            echo "<br/>";
            echo env('APP_KEY');
            print_r($_ENV);
        die();
        // Values I want to insert 
        $data = [
            'APP_KEY'       => Str::random(32) ,
            'DB_HOST'       => 'localhost',
            'DB_DATABASE'   => 'lara_test',
            'DB_USERNAME'   => 'root',
            'DB_PASSWORD'   => ''
        ];

        // default values of .env.example that I want to change
        $defaults = ['SomeRandomString', '127.0.0.1', 'homestead', 'homestead', 'secret'];

        // get contents of .env.example file
        $content = file_get_contents(base_path() . '/.env.example');

        // replace default values with new ones
        $i = 0;
        foreach ($data as $key => $value) {

            $content = str_replace($key.'='.$defaults[$i], $key.'='.$value, $content);
            $i++;
        }

        // Create new .env file
        Storage::disk('root')->put('.env', $content);

        // run all migrations
        Artisan::call('migrate');

        // run all db seeds
        Artisan::call('db:seed');

        dd('done');

    }
    public function submail(Request $request){
        $this->validate($request, [
            'email' => 'required|unique:newsletters,email',
        ]);
        event (new UserCreated($request->input('email')));  
        return redirect()->back();    
    }
    public function databasebackup(){
        return(new Displaycrud)->databasebackup();        
    } 
    public function postsingle($slug, $id=null){
        return(new Displaycrud)->postsingle($slug, $id);        
    }   
  
     public function pagesingle($slug, $id=null){
        return(new Displaycrud)->pagesingle($slug, $id);        
    } 
    public function categorysingle($slug){
        return(new Displaycrud)->categorysingle($slug);         
    } 
    // ================== Comment =============
    public function commentsindex(){
        return(new Displaycrud)->commentsindex();           
    }  
    public function commentsview($id=null){
        return(new Displaycrud)->commentsview($id);  
    }
    public function commentspublish($id=null){
        return(new Displaycrud)->commentspublish($id);  
    }
    public function commentsunpublish($id=null){   
         return(new Displaycrud)->commentsunpublish($id); 
    }
    public function commentarchive(){   
         return(new Displaycrud)->commentarchive(); 
    }
    public function commentreturn($id=null){   
         return(new Displaycrud)->commentreturn($id); 
    } 
    public function commentdistroy($id=null){
          return(new Displaycrud)->commentdistroy($id);           
    }
    public function commentsstore( Request $request){   
            $request->validate([
            'comment_body'=>'required',
        ]);
         return(new Displaycrud)->commentsstore($request); 
    }
    public function replyStore(Request $request){
         return(new Displaycrud)->replyStore($request); 
    }
    public function softdelete( $id){   
        return(new Displaycrud)->softdelete($id); 
    }  
    public function commentdelete($id){   
        return(new Displaycrud)->commentdelete($id);         
    }    
    public function commentmultipledelete( Request $request){ 
        return(new Displaycrud)->commentmultipledelete($request); 
    }  
    public function ajaxcheck($data){
       return(new Displaycrud)->ajaxcheck($data); 
    }
 
       // ============================CSV===============================
    public function csvfile(){
        return (new Displaycrud)->csvfile(); 
    }
    public function export() {
        return (new Displaycrud)->export(); 
    }
    private $rows = [];    
    public function import(Request $request) {
        return (new Displaycrud)->import($request);         
    } 
    // ================== Ip White listed=============
    public function white()    {
        return (new Displaycrud)->white();  
    }
     public function whitecreate()    {  
        return (new Displaycrud)->whitecreate();         
    }
    public function whitestore(Request $request)    {
        return (new Displaycrud)->whitestore($request);
    }
    public function whiteedit($id)    {
         return (new Displaycrud)->whiteedit($id);
    }
    public function whiteupdate(Request $request)    {
        return (new Displaycrud)->whiteupdate($request);
    }
    public function whitedestroy($id)    {
        return (new Displaycrud)->whitedestroy($id);
    }
}