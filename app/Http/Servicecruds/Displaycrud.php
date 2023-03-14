<?php

namespace App\Http\Servicecruds;

use App\Models\User;
use DB;
use App\Models\ImageUpload;
use Image;
use Session;
use App\Models\Whitelist;
use App\Models\Blacklist;
use App\Models\menu;
use App\Models\Menuitem;
use App\Models\Category;
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
// try  catch
use App\Services\PayUService\Exception;
// Event
use App\Events\UserCreated;
// language
use App;

use Illuminate\Database\Eloquent\SoftDeletes;


class Displaycrud{
    public function postsingle($slug, $id=null){        
        //post view auto incriment
        Post::findOrFail($id)->increment('views');
        $post = Post::where('slug_' . app()->getLocale(), $slug)->first(); 
        
        $reletedcatid = Postmeta::where('post_id', $post->id)->first();     
        $reletedpost = Postmeta::where('cat_id', $reletedcatid->cat_id)->where('post_id', '!=', $post->id)->limit(3)->get(); 
        // print_r($reletedpost);
        //         die();
        $categories = Category::where('parent_id', '')->get();

        $postmeta = Postmeta::where('post_id', $post->id)->get();    
        $cat = DB::table('postmetas') 
        ->where('post_id', $post->id)
        ->get();
        return view('blog.post', compact('post','categories','postmeta','reletedpost'));
    //    $post = Post::where('slug_' . app()->getLocale(), $slug->{'slug_' . app()->getLocale()})->first(); 
    } 
    public function pagesingle($slug, $id=null){
        // dd("Select the page where you display your content");        
        Page::findOrFail($id)->increment('views');        
        $page = Page::where('slug_' . app()->getLocale(), $slug)->first();      
        return view('blog.page', compact('page'));       
    } 
    public function categorysingle($slug){
        $category = Category::where('slug_' . app()->getLocale(), $slug)        
        //  ->where('parent_id', '')
        //  ->Where('parent_id', '?!=','')
        ->get();
        $categoryies = Category::where('parent_id', '==', '')->get();  
        $postmeta = Postmeta::where('cat_id',$category[0]->id)->orderBy('id', 'DESC')->paginate(10);  
    //  print_r($categoryies[0]->id);
    //  die();
        return view('blog.category', compact('postmeta','category','categoryies'));       
    } 
    // ================== Comment =============
    public function commentsindex(){       
        $comment = DB::table('comments')->where('deleted_at', null)->orderBy('id', 'desc')->paginate(15);
        return view('comment.index',compact('comment'));
    }  
    public function commentsview($id=null){
        $comment =  Comment::findOrFail($id);
        return view('comment.show',compact('comment'));
    }
    public function commentspublish($id=null){
        $publish =  Comment::find($id);
        $publish->status = 0;
        $publish->save();
        return redirect()->back()->with('success','Comment Unpublish Succesfully');
    }
    public function commentsunpublish($id=null){   
        $unpublish =  Comment::find($id);
        $unpublish->status = 1;
        $unpublish->save();
        return redirect()->back()->with('success','Comment Published Succesfully');
    }
    public function commentarchive(){       
       $comment = Comment::onlyTrashed()->paginate(15);
       return view('comment.archivecomment', compact('comment'));
    }
    public function commentreturn($id=null){   
        Comment::withTrashed()->find($id)->restore();
       return redirect()->route('comments')->with('success','Comment Reset Succesfully');
    } 
    public function commentdistroy($id=null){
        Comment::find($id)->delete();
        return redirect()->back()->with('success','Comment Deleted Succesfully');
    }
    public function commentsstore($request){  
        $comment = new Comment();
         if(empty(auth()->user()->id)){
            $comment->user_id =  null;
        }else{
            $comment->user_id = auth()->user()->id;
        } 
        if(empty($request->get('parent_id'))){
            $comment->parent_id = null;
        }else{
            $comment->parent_id = $request->get('parent_id');
        }
        $comment->post_id = $request->get('post_id');
        $comment->comment_body = $request->get('comment_body');
        $comment->commentname = $request->get('commentname');
        $comment->commentemail = $request->get('commentemail');
        $comment->save();
        return redirect()->back();
    }
    public function replyStore($request){
        $reply = new Comment();
        $reply->comment_body = $request->get('comment_body');
        $reply->user()->associate($request->user());
        $reply->parent_id = $request->get('comment_id');
        $post = Post::find($request->get('post_id'));
        $post->comments()->save($reply);
        return back();
    }
    public function softdelete($id=null){   
        Comment::find($id)->delete();
        return redirect()->back()->with('success','Comment Deleted Succesfully');
    }  
    public function commentdelete($id=null){   
        Comment::withTrashed()->find($id)->forceDelete();
       return redirect()->back()->with('success','Comment Deleted Permanently');
    }    
    public function commentmultipledelete($request){  
        if ($request->isMethod('POST')) {
            $multiIds = $request->id;  
            if(empty($multiIds)){
                return redirect()->back()->with('error','Please selct checkbox');
            }else{
                foreach ($multiIds as $multiId)  {   
                    Comment::withTrashed()->find($multiId)->forceDelete();                                             
                } 
            }
            return redirect()->back()->with('success','Comment Deleted Succesfully');
        }
    }  
    public function ajaxcheck($data){
        $posts = Post::where('name_' . app()->getLocale(),'LIKE','%'.$data."%")->get();
        if($posts) {
            echo view('blog.search', ['posts'=>$posts]);
        } else{
            echo 'Search not found';
        }
    }
    // ========================================white list
    public function white()    {
        $userData = User::first();
        return view('white.index', compact('userData'));
    }
    public function whitecreate()    {  
        $users = DB::table('users')
        ->select('*')
        ->get();
        // dd($users);
        return view('white.create', compact('users'));
    }

    public function whitestore( $request)    {        
        Whitelist::create([
                'user_id' =>  $request->input('user_id'),
                'ip' =>  $request->input('ip'),
                ]);
        Blacklist::create([
                'user_id' => '0',
                'ip' =>  '123.0.0.0',
                ]);
        return redirect()->route('white');
    }
    public function whiteedit($id)    {
        $users = DB::table('users')
            ->select('*')
            ->get(); 
        $white = Whitelist::find($id);
        return view('white.edit', compact('white','users'));
    }
    public function whiteupdate($request)    {
        $white = Whitelist::find($request->id);
        $white->user_id = $request->input('user_id');
        $white->ip = $request->input('ip');
        $white->save();    
    return redirect()->back();
    }
    public function databasebackup(){
    
            $DbName             = env('DB_DATABASE');
            $get_all_table_query = "SHOW TABLES ";
            $result = DB::select(DB::raw($get_all_table_query));
            $tables=[];
            $prep = "Tables_in_$DbName";
            foreach ($result as $res){
                $tables[] =  $res->Tables_in_democms;
            }
            // print_r($tables);
            // die();
            $connect = DB::connection()->getPdo();

            $get_all_table_query = "SHOW TABLES";
            $statement = $connect->prepare($get_all_table_query);
            $statement->execute();
            $result = $statement->fetchAll();
            $output = '';
            foreach($tables as $table)
            {
                $show_table_query = "SHOW CREATE TABLE " . $table . "";
                $statement = $connect->prepare($show_table_query);
                $statement->execute();
                $show_table_result = $statement->fetchAll();

                foreach($show_table_result as $show_table_row)
                {
                    $output .= "\n\n" . $show_table_row["Create Table"] . ";\n\n";
                }
                $select_query = "SELECT * FROM " . $table . "";
                $statement = $connect->prepare($select_query);
                $statement->execute();
                $total_row = $statement->rowCount();
                for($count=0; $count<$total_row; $count++)
                {
                    $single_result = $statement->fetch(\PDO::FETCH_ASSOC);
                    $table_column_array = array_keys($single_result);
                    $table_value_array = array_values($single_result);
                    $output .= "\nINSERT INTO $table (";
                    $output .= "" . implode(", ", $table_column_array) . ") VALUES (";
                    $output .= "'" . implode("','", $table_value_array) . "');\n";
                }
            }
            $file_name = 'database_backup_on_' . date('y-m-d') . '.sql';
            $file_handle = fopen($file_name, 'w+');
            fwrite($file_handle, $output);
            fclose($file_handle);
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename=' . basename($file_name));
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file_name));
            ob_clean();
            flush();
            readfile($file_name);
            unlink($file_name);
    }
}