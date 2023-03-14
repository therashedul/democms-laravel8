<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use App\Models\Role_has_permission;
use DB;
use App\Models\ImageUpload;
use App\Models\Whitelist;
use App\Models\Blacklist;
use Image;
use Hash;
use Session;
use Illuminate\Support\Arr;
use App\Models\menu;
use App\Models\Menuitem;
use App\Models\Category;
use App\Models\Artical;
use App\Models\post;
use App\Models\Comment;
use App\Models\Postmeta;
use App\Models\Page;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\UserController;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Mail;
// try  catch
use App\Services\PayUService\Exception;
// Event
use App\Events\UserCreated;
// language
use App;

use Illuminate\Database\Eloquent\SoftDeletes;

class SuperAdminController extends Controller
{
    private $images, $thumbnail, $singleimg, $upload, $files;

    public function __construct() {
        $this->images = public_path('/images');
        $this->thumbnail = public_path('/thumbnail');
        $this->singleimg = public_path('/singleimg');
        $this->upload = public_path('/upload');
        $this->files = public_path('/files');
    }
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){  
        // dd("Supper admin  panel");   
   
        return view('superadmin.index');
    } 
    public function notifyread($id){
          $userUnreadNotification = auth()->user()
                                        ->unreadNotifications
                                        ->where('id', $id)
                                        ->first();
    
        if($userUnreadNotification) {
            $userUnreadNotification->markAsRead();
            return \redirect()->route('superAdmin.users');
        }
    }
    public function categorylog(Request $request){        
        $logfiles = file(storage_path().'/logs/category.log');
        $collection=[];
        foreach($logfiles as  $logfile){
           $collection[]=$logfile;
        }
        dd($collection);
    }
   public function submail(Request $request){
        $this->validate($request, [
            'email' => 'required|unique:newsletters,email',
        ]);
        event (new UserCreated($request->input('email')));  
        return redirect()->back();
    
    }

    public function lang()
    {
        return view('lang');
    }

    public function lang_change(Request $request)
    {
        // die($request->lang);
      App::setLocale($request->lang);
        session()->put('lang_code',$request->lang);
        return redirect()->back();
    }



















    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function users(){
    //     echo "user";
    // }  
    // public function roles(){
    //     echo "role";
    // }  
    // public function permissions(){
    //     echo "permission";
    // }   
    // public function test(){
    //     echo "test";
    // }

    // public function create()
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Admin $admin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        //
    }



    public function articalindex()   {
        $locale = app()->getLocale();
        $categories = Artical::select('*')->whereNotNull('title_'.$locale)->whereNotNull('detial_'.$locale)->paginate(5);
        return view('superAdmin.artical.index', compact('categories'));
    }
    public function articalcreate(){
        return view('superAdmin.artical.create');
    }
    public function articalstore(Request $request)    {
        $data = $request->all();
   
        if($request->method()=='POST'){       
            Artical::create([               
                'title_en' => $request->title_en,
                'detial_en' => $request->detial_en,     
                
                'title_bn' => $request->title_bn,
                'detial_bn' => $request->detial_bn,
              
            ]);
        }
     return redirect()->route('superAdmin.artical')
        ->with('success','artical created successfully.');
    }

    public function articaledit($id)    {
        $cat = Artical::findOrFail($id);
        return view('superAdmin.artical.edit',compact('cat'));
    }

    public function articalupdate(Request $request,$id)    {
        $input = $request->all();
        $cateogy = Artical::findOrFail($id);
        $cateogy->update($input);
        return redirect()->route('superAdmin.artical')
            ->with('success','artical Updated successfully.');
    }
    public function articaldelete($id){
   
        $category = Artical::findOrFail($id);
        $category->delete();
         return redirect()->route('superAdmin.artical')
            ->with('success','artical Deleted successfully.');
    }

// =============================================
// ================== Category part =============

    public function categoryindex()   {
        //  $categories = Category::where('parent_id', 0)->get();
     
        $categories = Category::where('parent_id', '==', '')->Orwhere('parent_id', '==', '')->paginate(10);
        Log::channel('categorylog')->critical('Category Log file',['data'=>$categories] );

        return view('superAdmin.category.index', compact('categories'));
    }
    public function categorycreate()    {
          $categories = Category::where('parent_id', 0)->get();
        return view('superAdmin.category.create',compact('categories'));
    }
    public function categorystore(Request $request)    {
        $data = $request->all();
        if($request->method()=='POST'){       
            Category::create([
                'name' => $request->name,
                'title' => $request->title,
                'slug' => $request->slug,
                'parent_id' =>$request->parent_id,
                'category_img' =>$request->image_name,
                'link' =>$request->link
            ]);
        }
        Log::channel('categorylog')->critical('Category Log file',['data'=>$data] );



     return redirect()->route('superAdmin.category')
        ->with('success','Category created successfully.');
    }

    public function categoryedit($id)    {
        $cat = Category::findOrFail($id);
        $categories = Category::all();
        return view('superAdmin.category.edit',compact('cat','categories'));
    }

    public function categoryupdate(Request $request,$id)    {
        $input = $request->all();
        $input['category_img'] = $request->image_name;
        $cateogy = Category::find($id);
        $cateogy->update($input);
        return redirect()->route('superAdmin.category')
            ->with('success','Category Updated successfully.');
    }

    public function categorypublish($id){
        $publish =  Category::find($id);
        $publish->status = 0;
        $publish->save();
         return redirect()->route('superAdmin.category')->with('success','Publish successfully');
    }
    public function categoryunpublish($id){
        
        $unpublish =  Category::find($id);
        $unpublish->status = 1;
          $unpublish->save();
         return redirect()->route('superAdmin.category')->with('success','Unpublish successfully');
    }

    public function categorydestroy($id)    {
        $category = Category::findOrFail($id);
        if(count($category->subcategory))
        {
            $subcategories = $category->subcategory;
            foreach($subcategories as $cat)
            {
                $cat = Category::findOrFail($cat->id);
                $cat->parent_id = '';
                $cat->save();
            }
        }
        $category->delete();

         return redirect()->route('superAdmin.category')
            ->with('success','Category Deleted successfully.');
    }
    public function categoryName($category){   
           $categories=DB::table('categories')
           ->where('slug', $category)
           ->get();  
           $cat=$categories[0];
               $postmetas=DB::table('postmetas')
               ->where('cat_id',$cat->id)
               ->get();
            $posts=DB::table('posts')
           ->get();
           return view('superAdmin.category.single-cat', compact(['postmetas', 'posts','categories']));


    }
    public function categoryupload(Request $request){
       $userName = Auth::user()->name;
        if ($request->file('file')) {
          $file = $request->file('file');
            $fullImagename = $file->getClientOriginalName();
            $imagename = pathinfo($fullImagename, PATHINFO_FILENAME);
            $extension = pathinfo($fullImagename, PATHINFO_EXTENSION);
            $filePath = $imagename.'_'.time().'.'.$extension;
            $allowedfileExtension=['png','jpg','gif','bmp','jpeg'];
            $check=in_array($extension,$allowedfileExtension);
            if($check){
                $imgFile = Image::make($file->getRealPath());

                $imagepath = public_path('/images');
                $imgFile->resize(450, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($imagepath.'/'.$filePath);

                $imagesPath = public_path('/thumbnail');
                $imgFile->resize(100, 80)->save($imagesPath.'/'.$filePath);    

                $singleImagesPath = public_path('/singleimg');
                $imgFile->resize(750, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($singleImagesPath.'/'.$filePath);
          
                $destinationPath = public_path('/upload');
                $path = $file->move($destinationPath, $filePath); 
            }
            else{
                $path =  $file->move(public_path('/files'), $filePath);
            }
        }
        $imageUpload = new ImageUpload;
        $imageUpload->name = $filePath;
        $imageUpload->title = $imagename;
        $imageUpload->alt = $imagename;
        $imageUpload->path =  $filePath;
        $imageUpload->slug = $filePath;
        $imageUpload->status = '1';
        $imageUpload->username = $userName;
        $imageUpload->extention = '.'.$extension;
        $imageUpload->save();
     return response()->json(['success' => $imageUpload]);
    } 
    public function categoryfetch(Request $request){
        $images = DB::table('image_uploads')->orderBy('id', 'DESC')->get();
        $output = '<div class="file-manager-content">';        
            $output .= '<div id="image_file_upload_response">';
            foreach ($images as $image){
                    $output .= '<div class="col-file-manager" id="img_col_id_'. $image->id .'">';
                        $output .= '<div class="file-box"  data-file-caption="'. $image->caption .'" data-file-description="'. $image->description .'" data-file-alt="'. $image->alt .'" data-file-title="'. $image->title .'" data-file-name="'. $image->name .'"  data-file-id="'. $image->id .'" data-file-path="'.asset('upload/' . $image->name).'" data-file-path-editor="'.asset('upload/' . $image->name).'">';
                        $fileextention = ['.jpg','.png','.bmp','.gif','.jpeg'];
                    for($i=0; $i<count($fileextention); $i++){
                        if($image->extention == $fileextention[$i]){
                          $output .= '<div class="image-container">';  
                                $output .= '<img src="'.asset('images/' . $image->name).'" alt="'. $image->alt .'" title="'. $image->title .'" loading="lazy" class="img-responsive">';
                                    $name = substr($image->name, 0, 20).'...';
                                    $output .= '<span class="file-name">'.$name.'</span>';
                            $output .= '</div>';
                        }
                    }
                    $output .= '</div>';
                $output .= '</div>';			        
            }
           $output .= '</div>';
        $output .= '</div>';
        echo $output;
    }
    public function categoryuploaddelete(Request $request) {
        $val = $request->name;
        $categoryNames =  Category::where('profile_image', $val)->get();
        if(!empty($categoryNames[0]->profile_image)){
            if(($val == $categoryNames[0]->profile_image)){
                $msg = '<div class="alert alert-success text-center">This image is already used.</div>';
                $action = "image";
                return response()->json(array('msg'=> $msg, 'action'=>$action), 200);
            }
            }else{
                ImageUpload::where('name', $val)->delete();
                $lines = ['upload/','images/','single/','thumbnail/'];
                for($i = 0; $i < count($lines); $i++) {
                    $value =  $lines[$i];
                    $path = public_path($value).$val;
                    if (file_exists($path)) {
                        unlink($path);
                        }
                    }    
                return response()->json(['data'=>$val],200);
            }        
    } 
    public function categoryimagesearch(){
          $images=DB::table('image_uploads')
                ->where('name','LIKE','%'.$request->search."%")
                ->get(); 
            foreach ($images as $image):
                echo '<div class="col-file-manager" id="img_col_id_' . $image->id . '">';
                    echo '<div class="file-box" data-file-name="'. $image->name .'"  data-file-id="'. $image->id .'" data-file-path="'.asset('upload/' . $image->name).'" data-file-path-editor="'.asset('upload/' . $image->name).'">';
                   echo '<div class="image-container">';
                            echo '<img src="'.asset('images/' . $image->name).'" alt="" name="file" class="img-responsive">';
                                $name = substr($image->name, 0, 20).'...';
                            echo '<span class="file-name">'.$name.'</span>';
                    echo '</div>';
                echo '</div> </div>';
            endforeach;
    }


    // ================== Post =============
    public function postindex(Request $request) {  
      $postID='';
      $metaID='';
      $catID='';
      $cat='';
      $metaData ='';
      $catNames='';
      $userID = Auth::id();
      $userData = User::where('id', $userID)->get();
      $posts = Post::orderBy('id', 'desc')->paginate(10);
         //   $posts = Post::whereDate('publish_at', '<=', now()) ->where('status', 1)->orderByDesc('publish_at')->paginate(3);  // use for fornted
        $categories = DB::table('posts')
                ->select('*')
                ->join('postmetas', 'posts.id', '=', 'postmetas.post_id')
                 ->join('categories', 'postmetas.cat_id', '=', 'categories.id')
                ->get();
      return view('superAdmin.post.index', compact('posts','userData','categories'));
    }

    public function postshow($slug){

 

        /***
         * 
         * public function show($id)
            {
            if(($pasienpoli = PasienPoli::find($id)) == NULL)
            return view('pasienpoli.notfound', []);  
            $pasien = Pasien::find($id)->PasienPoli;

            return view('pasienpoli.show', compact('pasienpoli','pasien'));  
            }
         */
        
        $post = Post::where('slug',$slug)->get();
        // $cat = Category::findOrFail($id);
        $categories = Category::where('parent_id', '')->get();
        $postmeta = Postmeta::where('post_id', $post[0]->id)->get();
        // print_r($postmeta);
        // die();
        return view('superAdmin.post.show', compact('post','categories','postmeta'));
       
    }    
 
    public function postcreate() {
        
        // $userID = Auth::id();
        // echo $userID;
        
        
        $user = Auth::user();  // display all information in current user
        $catID = DB::table('categories')->latest('id')->first();
        $postID = DB::table('posts')->latest('id')->first();
        $metaID = DB::table('postmetas')->latest('id')->first();       
 
            if(empty($postID)){
                // $pid = ++$postID;
                $post = New Post();
                $post->title = "Post";  
                $post->name = "post"; 
                $post->slug = "post";  
                $post->status = "1";  
                $post->save();
            }  
            if(empty($catID)){
                $cat = New Category();
                $cat->title =  "unknown";  
                $cat->name =  "unknown";  
                $cat->slug =  "unknown";  
                $cat->parent_id = "0";  
                $cat->save();
            }

            if(empty($metaID)){
                    $cat = New postmeta();
                    if(empty($postID->id)){
                       return redirect()->back();
                    }else{
                        $cat->post_id =  $postID->id;  
                        $cat->cat_id =  $catID->id;  
                        $cat->save();

                    }
                }
                // else{
                //     $cat = New postmeta();
                //     $cat->post_id =   $postID->id;  
                //     $cat->cat_id =   $catID->id;  
                //     $cat->save();
                // }
       $categories = Category::where('parent_id', '')->get();
       return view('superAdmin.post.create', compact('categories','user'));
    }
    public function poststore(Request $request) {
        
        // print_r($request->all());
        // die();

            $this->validate($request, [
             'name' => 'required',
             'content' => 'required',
        ]);
        try {
        //  if ($request->file('file')) {
        //     $file = $request->file('file');
        //         $fullImagename = $file->getClientOriginalName();
        //         $imagename = pathinfo($fullImagename, PATHINFO_FILENAME);
        //         $extension = pathinfo($fullImagename, PATHINFO_EXTENSION);
        //         $filePath = $imagename.'_'.time().'.'.$extension;
        //         $allowedfileExtension=['csv','txt','docx','xlx','xls','pdf'];
        //         $check=in_array($extension,$allowedfileExtension);
        //         // print_r($fullImagename);
        //         if($check){
        //             $path =  $file->move(public_path('/files'), $filePath);
        //         }
        //     }

    
            $postdate = New Post();
            if($request->method()=='POST'){    
                $postID = DB::table('posts')->latest('id')->first();
                $id = ++$postID->id;
                $subcatID = $request->input('subcat_id');  
                    if(empty($subcatID)){
                            $postmeta = New Postmeta();
                            $postmeta->post_id =  $id;  
                            $postmeta->cat_id =  1;  
                            $postmeta->save();
                    }
                    else{
                        foreach ($subcatID as $value) {
                            $postmeta = New Postmeta();
                            $postmeta->post_id =  $id;  
                            $postmeta->cat_id =  $value;  
                            $postmeta->save();
                        }
                    }      
                //  $datetime = date('Y-m-d H:i:s');
                $postdate->title = $request->input('name');
                $postdate->name = $request->input('name');
                $postdate->link = $request->input('link'); 
                $postdate->slug = $request->input('slug');        
                $postdate->content = $request->input('content');
                $postdate->image = $request->input('image_name');
                // if($check){
                //     $postdate->file = $fullImagename;
                // }
                $postdate->video = $request->input('video');
                $postdate->status = $request->input('status');
                $postdate->trending = $request->input('trending');
                $postdate->template = $request->input('template');
                $postdate->excerpt = $request->input('excerpt');
                $postdate->tag = $request->input('tag');
                $postdate->user_id = $request->input('userId');
                $postdate->publish_at = Carbon::createFromFormat('Y-m-d H:i:s', $request->input('publish_at'))->format('Y-m-d H:i:s');
                $postdate->save();
            } 
        } catch (\Exception $e) {
            \Log::channel('categorylog')->critical('Category Log file',['data'=>$postdate] );
            // \Log::error( $e->getMessage() );

            // return $e->getMessage();
        }         
        // return redirect()->back();

        return redirect()->route('superAdmin.post')->with('success','Post  Added successfully');

             // print_r($request->input('publish_at')?$request->input('publish_at'): $datetime);
        // die();     
        // $publishTime = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $request->input('publish_at'))->format('Y-m-d H:i:s');
                // $request->validate([
                    //         'title' => 'required',
                    //         'body' => 'required',
                    //         'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                    //     ]);
                    //  $enddate = date('Y-m-d H:i:s');
        //  $enddate = DB::table('posts')->get();
    }
    public function postedit($id){

        $post = post::find($id);
        // $cat = Category::findOrFail($id);
         $categories = Category::where('parent_id', '')->get();
        $postmeta = Postmeta::where('post_id', $id)->get();

      
        return view('superAdmin.post.edit', compact('post','categories','postmeta'));
    }

    public function postupdate(Request $request){
        $postdate = Post::findOrFail($request->id);
        $subcatID = $request->input('subcat_id');  
        $unsubcatID = $request->input('uncat_id');  
        // print_r($request->publish_at);
        
        if(isset($subcatID) && isset($unsubcatID)){
            $results=array_diff($unsubcatID,$subcatID);
            $dbcatID = '';  
          
        foreach($unsubcatID as $uncheck) {
                foreach ($subcatID as $value) {      
                        $dbcatID = $value;            
                        //    print_r($dbcatID);
                        $metaID =  DB::table('postmetas')
                                ->where('post_id', $postdate->id)
                                ->where('cat_id', $dbcatID)
                              
                                ->updateOrInsert([
                                'post_id'=> $postdate->id,
                                'cat_id' => $dbcatID,
                            ],
                            [
                                'post_id'=> $postdate->id,
                                'cat_id' => $dbcatID,
                                'updated_at'=>date('Y-m-d H:i:s')       
                            ]);
                        }
                foreach($results as $result){
                    if(($dbcatID != $uncheck) && ($postdate->id)){       
                        // echo $postdate->id;
                        Postmeta::withTrashed()->where('post_id',  $postdate->id)->forceDelete() ;    
                                        
                    }  
                }  
            }
            // die();
        
        // print_r($postdate);
        // die();
        }
        if(!empty($postdate)){
                foreach ($subcatID as $value) {  
                    DB::table('postmetas')->updateOrInsert([
                        'post_id'=> $postdate->id,
                        'cat_id' => $value,
                        'updated_at'=>date('Y-m-d H:i:s')   
                    ]);
                }
        }    
        $postdate->title = $request->input('name');
        $postdate->name = $request->input('name');
        $postdate->link = $request->input('link'); 
        $postdate->slug = $request->input('slug');        
        $postdate->content = $request->input('content');
        $postdate->image = $request->input('image_name');
        $postdate->status = $request->input('status');
        $postdate->trending = $request->input('trending');
        $postdate->template = $request->input('template');
        $postdate->excerpt = $request->input('excerpt');
        $postdate->tag = $request->input('tag');
        $postdate->user_id = $request->input('userId');
        // $postdate->publish_at = Carbon::createFromFormat('Y-m-d H:i:s', $request->input('publish_at'))->format('Y-m-d H:i:s');
        $postdate->publish_at = $request->input('publish_at');
        $postdate->save();


   
   
            if($request->hasfile('image')){ 
            $destination = $postdate->image;
            if(File::exists($destination)){
                file::delete($destination);
            }
                $image = $request->file('image');
                $filename = time().'.'.$image->extension();
                $destinationPath = public_path('/thumbnail');
                $img = Image::make($image->path());   
                $img->resize(100, 100, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPath.'/'.$filename);   
                $destinationPath = public_path('/image');
                $image->move($destinationPath, $filename);
                $postdate->image = '/image/'.$filename;
        }


        $postdate->save();
    
        return redirect()->route('superAdmin.post');
    }

    public function postsearch(Request $request) {     
        if($request->ajax()) {
                $output="";
                $posts=DB::table('posts')
                ->where('name','LIKE','%'.$request->search."%")
                ->orwhere('content','LIKE','%'.$request->search."%")
                ->get(); 

                $output = '<table table table-hover">';   
                 $output.='<thead>'.'<tr>'.                                  
                                    '<th>'."Title".'</th>'.
                                    '<th>'."Action".'</th>'.
                                '</tr>'.'</thead>';           
                if (count($posts)>0) { 
                        foreach ($posts as $key => $post) {
                                $output.='<tr>'.
                                    '<td>'.$post->title.'</td>'.
                                    '<td> 
                                    <a href='. route('superAdmin.post.edit', $post->id).' class=" btn btn-sm btn-primary"><i
                                                    class="fa fa-pencil-square" aria-hidden="true"></i> </a>';
                                    $output.= '<a href='. route('superAdmin.post.show', $post->id).' class="btn btn-sm  btn-success"><i class="fa fa-eye"
                                                    aria-hidden="true"></i></a>';
                               
                                    if($post->status == 1){
                                             $output.= '<a href='. route('superAdmin.post.publish', $post->id).' class="btn btn-sm btn-info"><i class="fa fa-arrow-circle-up"
                                                        aria-hidden="true"></i> </a>';
                                    }else{
                                         $output.= '<a href='. route('superAdmin.post.unpublish', $post->id).' class="btn btn-sm btn-warning"> <i class="fa fa-arrow-circle-down " aria-hidden="true"></i> </a>';
                                    }
                                        $output.= '<a href='. route('superAdmin.post.delete', $post->id).' class="btn btn-sm  btn-danger"><i class="fa fa-trash"
                                                    aria-hidden="true"></i> </a>';
                                   $output.= '</td></tr>';
                        }
                
                    }else{
                          $output.='<tr>'.
                                    '<td colspan="2">'."No Data Found".'</td>'.
                                '</tr>';
                    }
                    $output .= '</table>'; 
               return Response($output);
        }

    }

    public function postslugsearch(Request $request){
         if($request->ajax()) {
                $output="";
                $posts=DB::table('posts')
                ->where('name',  $request->slugsearch)
                ->first(); 

                $output = $posts->name;      
               return Response($output);
        }

    }

    public function postdestroy( $id)    {
        $destroyID = Post::findOrFail($id);
        if($destroyID->id){       
            Postmeta::where('post_id',  $destroyID->id)->delete();                         
        }  
        $destroyID->delete();
        return redirect()->route('superAdmin.post');
    }

    public function postpublish($id){
 
        $publish =  Post::find($id);
        $publish->status = 0;
        $publish->save();
        return redirect()->route('superAdmin.post');
    }
    public function postunpublish($id){
        
        $unpublish =  Post::find($id);
        $unpublish->status = 1;
          $unpublish->save();
        return redirect()->route('superAdmin.post');
    }

    public function postmultipledelete(Request $request){
        $multiIds = $request->id;
        foreach ($multiIds as $multiId) 
            {         
                Post::where('id', $multiId)->delete();
                Postmeta::where('post_id',  $multiId)->delete();                                     
            }        
        return redirect()->route('superAdmin.post')->with('success','Post  Deleted successfully');
        }


    public function postName($post){
           $post=DB::table('posts')
           ->where('slug',$post)
           ->get();
           $post = $post[0]; 
        return view('superAdmin.post.single-post', compact('post'));


    }
    // ================================

    public function postupload(Request $request){
       $userName = Auth::user()->name;
        if ($request->file('file')) {
          $file = $request->file('file');
            $fullImagename = $file->getClientOriginalName();
            $imagename = pathinfo($fullImagename, PATHINFO_FILENAME);
            $extension = pathinfo($fullImagename, PATHINFO_EXTENSION);
            $filePath = $imagename.'_'.time().'.'.$extension;
            $allowedfileExtension=['png','jpg','gif','bmp','jpeg'];
            $check=in_array($extension,$allowedfileExtension);
            if($check){
                $imgFile = Image::make($file->getRealPath());
                $imagepath = public_path('/images');
                $imgFile->resize(450, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($imagepath.'/'.$filePath);

                $imagesPath = public_path('/thumbnail');
                $imgFile->resize(100, 80)->save($imagesPath.'/'.$filePath);    

                $singleImagesPath = public_path('/singleimg');
                $imgFile->resize(750, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($singleImagesPath.'/'.$filePath);
          
                $destinationPath = public_path('/upload');
                $path = $file->move($destinationPath, $filePath); 
            }
            else{
                $path =  $file->move(public_path('/files'), $filePath);
            }
        }
        $imageUpload = new ImageUpload;
        $imageUpload->name = $filePath;
        $imageUpload->title = $imagename;
        $imageUpload->alt = $imagename;
        $imageUpload->path =  $filePath;
        $imageUpload->slug = $filePath;
        $imageUpload->status = '1';
        $imageUpload->username = $userName;
        $imageUpload->extention = '.'.$extension;
        $imageUpload->save();
     return response()->json(['success' => $imageUpload],201);
    } 
    public function postsfetch(Request $request){
        $images = DB::table('image_uploads')->orderBy('id', 'DESC')->get();
        $output = '<div class="file-manager-content">';        
            $output .= '<div id="image_file_upload_response">';
            foreach ($images as $image){
                    $output .= '<div class="col-file-manager" id="img_col_id_'. $image->id .'">';
                        $output .= '<div class="file-box"  data-file-caption="'. $image->caption .'" data-file-description="'. $image->description .'" data-file-alt="'. $image->alt .'" data-file-title="'. $image->title .'" data-file-name="'. $image->name .'"  data-file-id="'. $image->id .'" data-file-path="'.asset('upload/' . $image->name).'" data-file-path-editor="'.asset('upload/' . $image->name).'">';
                        $fileextention = ['.jpg','.png','.bmp','.gif','.jpeg'];
                    for($i=0; $i<count($fileextention); $i++){
                        if($image->extention == $fileextention[$i]){
                          $output .= '<div class="image-container">';  
                                $output .= '<img src="'.asset('images/' . $image->name).'" alt="'. $image->alt .'" title="'. $image->title .'" loading="lazy" class="img-responsive">';
                                    $name = substr($image->name, 0, 20).'...';
                                    $output .= '<span class="file-name">'.$name.'</span>';
                            $output .= '</div>';
                        }
                    }
                    $output .= '</div>';
                $output .= '</div>';			        
            }
           $output .= '</div>';
        $output .= '</div>';
        echo $output;
    }
    public function postuploaddelete(Request $request) {
        $val = $request->name;
        $categoryNames =  Post::where('image', $val)->get();
        if(!empty($categoryNames[0]->image)){
            if(($val == $categoryNames[0]->image)){
                $msg = '<div class="alert alert-success text-center">This image is already used.</div>';
                $action = "image";
                return response()->json(array('msg'=> $msg, 'action'=>$action), 200);
            }
            }else{
                ImageUpload::where('name', $val)->delete();
                $lines = ['upload/','images/','single/','thumbnail/'];
                for($i = 0; $i < count($lines); $i++) {
                    $value =  $lines[$i];
                    $path = public_path($value).$val;
                    if (file_exists($path)) {
                        unlink($path);
                        }
                    }    
                return response()->json(['data'=>$val],200);
            }        
    } 
    public function postimgsearch(Request $request){
             $images=DB::table('image_uploads')
                ->where('name','LIKE','%'.$request->search."%")
                ->get(); 
            foreach ($images as $image):
                echo '<div class="col-file-manager" id="img_col_id_' . $image->id . '">';
                    echo '<div class="file-box" data-file-name="'. $image->name .'"  data-file-id="'. $image->id .'" data-file-path="'.asset('upload/' . $image->name).'" data-file-path-editor="'.asset('upload/' . $image->name).'">';
                   echo '<div class="image-container">';
                            echo '<img src="'.asset('images/' . $image->name).'" alt="" name="file" class="img-responsive">';
                                $name = substr($image->name, 0, 20).'...';
                            echo '<span class="file-name">'.$name.'</span>';
                    echo '</div>';
                echo '</div> </div>';
            endforeach;
    }
    // =========================================
    public function postarchive(){
        $posts = DB::table('posts')->where('deleted_at','!=', null)->orderBy('id', 'desc')->paginate(15);
        return view('superAdmin.post.archive',compact('posts'));        
    }
    public function postarchivereturn($id){   
        $destroyID = DB::table('posts')->where('id',$id)->first();
        if($destroyID->id){       
            Postmeta::where('post_id',  $destroyID->id)->restore();                         
        } 
        Post::withTrashed()->find($id)->restore();
       return redirect()->route('superAdmin.post')->with('success','Post Reset Succesfully');
    } 
    public function postarchivedistroy($id){
        $destroyID = DB::table('posts')->where('id',$id)->first();
        if($destroyID->id){       
            Postmeta::where('post_id',  $destroyID->id)->forceDelete();                         
        } 
        Post::withTrashed()->find($id)->forceDelete();
        return redirect()->back()->with('success','Post Deleted Succesfully');  
    }

    public function postarchivemultipledelete(){
        Post::withTrashed()->find($id)->forceDelete();
        return redirect()->back()->with('success','Post Deleted Permanently');
    }

// =======================================
  



    // ================== Comment =============
    public function commentsindex(){
        $comment = DB::table('comments')->where('deleted_at', null)->orderBy('id', 'desc')->paginate(15);
        return view('superAdmin.comment.index',compact('comment'));
    }  
    public function commentsview($id){
        $comment =  Comment::findOrFail($id);
        return view('superAdmin.comment.show',compact('comment'));
    }
    public function commentspublish($id){
        $publish =  Comment::find($id);
        $publish->status = 0;
        $publish->save();
        return redirect()->back()->with('success','Comment Unpublish Succesfully');
    }
    public function commentsunpublish($id){   
        $unpublish =  Comment::find($id);
        $unpublish->status = 1;
        $unpublish->save();
        return redirect()->back()->with('success','Comment Published Succesfully');
    }
    public function commentarchive(){       
       $comment = Comment::onlyTrashed()->paginate(15);
       return view('superAdmin.comment.archivecomment', compact('comment'));
    }
    public function commentreturn($id){   
        Comment::withTrashed()->find($id)->restore();
       return redirect()->route('superAdmin.comments')->with('success','Comment Reset Succesfully');
    } 
    public function commentdistroy($id){
        Comment::find($id)->delete();
        return redirect()->back()->with('success','Comment Deleted Succesfully');
    }
    public function commentsstore( Request $request){   
        $request->validate([
            'comment_body'=>'required',
        ]);
        $input = $request->all();
        $input['user_id'] = auth()->user()->id;
        Comment::create($input);
        return redirect()->back();
       
   
    }
    public function replyStore(Request $request){
        $reply = new Comment();
        $reply->comment_body = $request->get('comment_body');
        $reply->user()->associate($request->user());
        $reply->parent_id = $request->get('comment_id');
        $post = Post::find($request->get('post_id'));
        $post->comments()->save($reply);
        return back();
    }
    public function softdelete( $id){   
        Comment::find($id)->delete();
        return redirect()->back()->with('success','Comment Deleted Succesfully');
    }  
    public function commentdelete($id){   
        Comment::withTrashed()->find($id)->forceDelete();
       return redirect()->back()->with('success','Comment Deleted Permanently');
    }    
    public function commentmultipledelete( Request $request){  
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

    // ================== Page =============
    public function pageindex(){
      $userID = Auth::id();
      $userData = User::where('id', $userID)->get();
      $pages = Page::where('id', '>=', 1)->orderBy('id', 'desc')->paginate(10);
    //   print_r($pages);
    //         die();
     
      return view('superAdmin.page.index', compact('pages','userData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function pagecreate()
    {
      
        $user = Auth::user();  // display all information in current user
        // $pages = Page::where('id', '>', 5)->get(); // display all page for parent
        $pages = Page::where('parent_id', 0)->get();
        
        return view('superAdmin.page.create',compact('user','pages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function pagestore(Request $request)    {
        $pagedata = New Page();
        $pagedata->title = $request->input('name');
        $pagedata->name = $request->input('name');
        $pagedata->link = $request->input('link'); 
        $pagedata->slug = $request->input('slug');
        $pagedata->content = $request->input('content');
        $pagedata->parent_id = $request->input('parent_id');
        $pagedata->image = $request->input('image_name');
        $pagedata->template = $request->input('template');
        $pagedata->status = $request->input('status');
        $pagedata->user_id = $request->input('userId');
        $pagedata->publish_at = $request->input('publish_at');          
        $pagedata->save();
        return redirect()->route('superAdmin.page')->with('success','Page  Added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function pageshow( $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function pageedit( $id)
    { 
       $user = Auth::user();  
       $pages = Page::where('id','>=', 1)->get();
       $page = Page::find($id);
    return view('superAdmin.page.edit', compact('page','pages','user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function pageupdate(Request $request){
        $pagedata = Page::find($request->id);
        $pagedata->name = $request->input('name');
        $pagedata->title = $request->input('title');
        $pagedata->status = $request->input('status');
        $pagedata->link = $request->input('link'); 
        $pagedata->slug = $request->input('slug');  
        $pagedata->template = $request->input('template');
        $pagedata->content = $request->input('content');
        $pagedata->parent_id = $request->input('parent_id');
        $pagedata->image = $request->input('image_name');
        $pagedata->user_id = $request->input('userId');
        $pagedata->publish_at = $request->input('publish_at');
        $pagedata->save();

    
        return redirect()->back();
    }

    public function pagepublish($id){

        $publish =  Page::find($id);
        $publish->status = 0;
         $publish->save();
        return redirect()->back();
    }
    public function pageunpublish($id){
        
        $unpublish =  Page::find($id);
        $unpublish->status = 1;
          $unpublish->save();
        return redirect()->back();
    }


     // =========================================
    public function pagearchive(){
        $pages = DB::table('pages')->where('deleted_at','!=', null)->orderBy('id', 'desc')->paginate(15);
        return view('superAdmin.page.archive',compact('pages'));        
    }
    public function pagearchivereturn($id){   
        Page::withTrashed()->find($id)->restore();
       return redirect()->route('superAdmin.page')->with('success','Page Reset Succesfully');
    } 
    public function pagearchivedistroy($id){
        Page::withTrashed()->find($id)->forceDelete();
        return redirect()->back()->with('success','Page Deleted Succesfully');  
    }

    public function pagearchivemultipledelete(){
        Page::withTrashed()->find($id)->forceDelete();
        return redirect()->back()->with('success','Page Deleted Permanently');
    }

// =======================================

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function pagedestroy($id)
    {
        $destroyID = Page::findOrFail($id);
        $destroyID->delete();
       return redirect()->back();
    }
    public function pagemultipledelete(Request $request){
        $multiIds = $request->id;
		foreach ($multiIds as $multiId) 
		{         
			Page::where('id', $multiId)->delete();                                
		}        
	  return redirect()->back();
    }

     /**
     * Auto search  data.
     *
     * @param  \App\Models\page
     * @return \Illuminate\Http\Response
     */
     public function pagesearch(Request $request) {     
        if($request->ajax()) {
                $output="";
                $pages=DB::table('pages')
                ->where('name','LIKE','%'.$request->search."%")
                 ->orwhere('content','LIKE','%'.$request->search."%")
                ->get(); 

                $output = '<table table table-hover">';   
                 $output.='<thead>'.'<tr>'.                                  
                                    '<th>'."Title".'</th>'.
                                    '<th>'."Action".'</th>'.
                                '</tr>'.'</thead>';           
                if (count($pages)>0) { 
                        foreach ($pages as $key => $page) {
                                $output.='<tr>'.
                                    '<td>'.$page->name.'</td>'.                                    
                                    '<td> <a href='. route('superAdmin.page.edit', $page->id).' class="btn btn-sm btn-primary"><i
                                                    class="fa fa-pencil-square" aria-hidden="true"></i> </a>';
                                                    
                                            if($page->status == 1){
                                                   $output.= '<a href='. route('superAdmin.page.publish', $page->id).' class="btn btn-sm btn-info"><i class="fa fa-arrow-circle-up"
                                                    aria-hidden="true"></i> </a>';
                                             }else{
                                                  $output.= '<a href='. route('superAdmin.page.unpublish', $page->id).' class="btn btn-sm btn-warning"> <i class="fa fa-arrow-circle-down " aria-hidden="true"></i> </a>';
                                                }
                                            $output.='<a href='. route('superAdmin.page.delete', $page->id).'  class="btn btn-sm btn-info  btn-danger"><i class="fa fa-trash"
                                               aria-hidden="true"></a>';


                                $output.= '</td></tr>';
                        }
                
                    }else{
                          $output.='<tr>'.
                                    '<td colspan="2">'."No Data Found".'</td>'.
                                '</tr>';
                    }
                    $output .= '</table>'; 
               return Response($output);
        }
         return redirect()->back();

    }


    public function pageslugsearch(Request $request){
         if($request->ajax()) {
                $output="";
                $pages=DB::table('pages')
                ->where('title',  $request->slugsearch)
                ->first(); 

                $output = $pages->name;          
                // if (count($pages)>0) { 
                //         foreach ($pages as $key => $page) {
                //               $output.=$page->name;
                //         }
                
                //     }else{
                //           $output.='No date here';
                //     }
               return Response($output);
        }

    }
    public function pagesName($page){

        $page=DB::table('pages')
                ->where('slug',$page)
                ->get();
        $page = $page[0]; 
        return view('superAdmin.page.single-page', compact('page'));


    }

    
    // ================== Menu =============
        
    public function menuindex(){    
     
        $desiredMenu = '';
        $menuitems='';
      if(isset($_GET['id']) && $_GET['id'] != 'new'){
        $id = $_GET['id'];
        $desiredMenu = menu::where('id',$id)->first();
        if(!empty($desiredMenu->content)) {
            $menuitems = json_decode($desiredMenu->content);
            $menuitems = $menuitems[0]; 
            
            foreach($menuitems as $menu){
            
            $menu->title = menuitem::where('id',$menu->id)->value('title');
            $menu->name = menuitem::where('id',$menu->id)->value('name');
            $menu->slug = menuitem::where('id',$menu->id)->value('slug');
            $menu->target = menuitem::where('id',$menu->id)->value('target');
            $menu->type = menuitem::where('id',$menu->id)->value('type');
            if(!empty($menu->children[0])){
                foreach ($menu->children[0] as $child) {
            
                $child->title = menuitem::where('id',$child->id)->value('title');
                $child->name = menuitem::where('id',$child->id)->value('name');
                $child->slug = menuitem::where('id',$child->id)->value('slug');
                $child->target = menuitem::where('id',$child->id)->value('target');
                $child->type = menuitem::where('id',$child->id)->value('type');
                // echo "<pre>";
                if(isset($child->children[0])){
                    foreach ($child->children[0] as $chil) {
                    $chil->title = menuitem::where('id',$chil->id)->value('title');
                    $chil->name = menuitem::where('id',$chil->id)->value('name');
                    $chil->slug = menuitem::where('id',$chil->id)->value('slug');
                    $chil->target = menuitem::where('id',$chil->id)->value('target');
                    $chil->type = menuitem::where('id',$chil->id)->value('type');
                            // print_r($chil->type);
                    } 
                }           
                }  
            }
            }
        }else{
            $menuitems = menuitem::where('menu_id',$desiredMenu->id)->get();                    
        }             
        }elseif($_GET['id'] = 'new'){

        }
        else{

        }
        //     print_r($menuitems);
        //    die();
        return view ('menu',[
            'pages'=>page::all(),
            'categories'=>category::all(),
            'posts'=>post::all(),
            'menus'=>menu::all(),
            'desiredMenu'=>$desiredMenu,
            'menuitems'=> $menuitems
        ]);
    }	

    public function menustore(Request $request){
  

        $data = $request->all(); 
        if(menu::create($data)){ 
        $newdata = menu::orderby('id','DESC')->first();      
        return redirect()->back();
        return redirect()->back()->with('error','Failed to save menu !');
        }
    }	

    public function menuaddCatToMenu(Request $request){
        $data = $request->all();
        $menuid = $request->menuid;
        $ids = $request->ids;
        $menu = menu::findOrFail($menuid);


        if($menu->content == ''){
        foreach($ids as $id){
            $data['title'] = category::where('id',$id)->value('title');
            $data['slug'] = category::where('id',$id)->value('slug');
            $data['type'] = 'category';
            $data['menu_id'] = $menuid;
            $data['updated_at'] = NULL;
            menuitem::create($data);
        }
        }else{
        $olddata = json_decode($menu->content,true); 
        foreach($ids as $id){
            $data['title'] = category::where('id',$id)->value('title');
            $data['slug'] = category::where('id',$id)->value('slug');
            $data['type'] = 'category';
            $data['menu_id'] = $menuid;
            $data['updated_at'] = NULL;
            menuitem::create($data);
        }
        foreach($ids as $id){
            $array['title'] = category::where('id',$id)->value('title');
            $array['slug'] = category::where('id',$id)->value('slug');
            $array['name'] = NULL;
            $array['type'] = 'category';
            $array['target'] = NULL;
            $array['id'] = menuitem::where('slug',$array['slug'])->where('name',$array['name'])->where('type',$array['type'])->orderby('id','DESC')->value('id');
            $array['children'] = [[]];
            array_push($olddata[0],$array);
            $oldata = json_encode($olddata);
            $menu->update(['content'=>$olddata]);
        }
        }
    }

    public function menuaddPostToMenu(Request $request){
        $data = $request->all();
        $menuid = $request->menuid;
        $ids = $request->ids;
        $menu = menu::findOrFail($menuid);
        if($menu->content == ''){
        foreach($ids as $id){
            $data['title'] = post::where('id',$id)->value('title');
            $data['slug'] = post::where('id',$id)->value('slug');
            $data['type'] = 'post';
            $data['menu_id'] = $menuid;
            $data['updated_at'] = NULL;
            menuitem::create($data);
        }
        }else{
        $olddata = json_decode($menu->content,true); 
        foreach($ids as $id){
            $data['title'] = post::where('id',$id)->value('title');
            $data['slug'] = post::where('id',$id)->value('slug');
            $data['type'] = 'post';
            $data['menu_id'] = $menuid;
            $data['updated_at'] = NULL;
            menuitem::create($data);
        }
        foreach($ids as $id){
            $array['title'] = post::where('id',$id)->value('title');
            $array['slug'] = post::where('id',$id)->value('slug');
            $array['name'] = NULL;
            $array['type'] = 'post';
            $array['target'] = NULL;
            $array['id'] = menuitem::where('slug',$array['slug'])->where('name',$array['name'])->where('type',$array['type'])->orderby('id','DESC')->value('id');                
            $array['children'] = [[]];
            array_push($olddata[0],$array);
            $oldata = json_encode($olddata);
            $menu->update(['content'=>$olddata]);
        }
        }
    } 
    
    public function menuaddPaseToMenu(Request $request){
        $data = $request->all();
        $menuid = $request->menuid;
        $ids = $request->ids;
        $menu = menu::findOrFail($menuid);
        if($menu->content == ''){
        foreach($ids as $id){
            $data['title'] = page::where('id',$id)->value('title');
            $data['slug'] = page::where('id',$id)->value('slug');
            $data['type'] = 'page';
            $data['menu_id'] = $menuid;
            $data['updated_at'] = NULL;
            menuitem::create($data);
        }
        }else{
        $olddata = json_decode($menu->content,true); 
        foreach($ids as $id){
            $data['title'] = page::where('id',$id)->value('title');
            $data['slug'] = page::where('id',$id)->value('slug');
            $data['type'] = 'page';
            $data['menu_id'] = $menuid;
            $data['updated_at'] = NULL;
            menuitem::create($data);
        }
        foreach($ids as $id){
            $array['title'] = page::where('id',$id)->value('title');
            $array['slug'] = page::where('id',$id)->value('slug');
            $array['name'] = NULL;
            $array['type'] = 'page';
            $array['target'] = NULL;
            $array['id'] = menuitem::where('slug',$array['slug'])->where('name',$array['name'])->where('type',$array['type'])->orderby('id','DESC')->value('id');                
            $array['children'] = [[]];
            array_push($olddata[0],$array);
            $oldata = json_encode($olddata);
            $menu->update(['content'=>$olddata]);
        }
        }
  }

  public function menuaddCustomLink(Request $request){
    $data = $request->all();
    $menuid = $request->menuid;
    $menu = menu::findOrFail($menuid);
    if($menu->content == ''){
      $data['title'] = $request->link;
      $data['slug'] = $request->url;
      $data['type'] = 'custom';
      $data['menu_id'] = $menuid;
      $data['updated_at'] = NULL;
      menuitem::create($data);
    }else{
      $olddata = json_decode($menu->content,true); 
      $data['title'] = $request->link;
      $data['slug'] = $request->url;
      $data['type'] = 'custom';
      $data['menu_id'] = $menuid;
      $data['updated_at'] = NULL;
      menuitem::create($data);
      
            $array = [];
            $array['title'] = $request->link;
            $array['slug'] = $request->url;
            $array['name'] = NULL;
            $array['type'] = 'custom';
            $array['target'] = NULL;
            $array['id'] = menuitem::where('slug',$array['slug'])->where('name',$array['name'])->where('type',$array['type'])->orderby('id','DESC')->value('id');                
            $array['children'] = [[]];
            array_push($olddata[0],$array);
            $oldata = json_encode($olddata);
            $menu->update(['content'=>$olddata]);
       
    }
  }

  public function menuupdateMenu(Request $request){
    $newdata = $request->all(); 
    $menu=menu::findOrFail($request->menuid);            
    $content = $request->data; 
    $newdata = [];  
    $newdata['location'] = $request->location;       
    $newdata['content'] = json_encode($content);
    $menu->update($newdata); 
  }

  public function menuupdateMenuItem(Request $request){

    $data = $request->all();    
    if( $data){
        $item = menuitem::findOrFail($request->id);
        $item->update($data);
    }    
    return redirect()->back();
  }

  public function menudeleteMenuItem($id, $key, $in=''){    
     
   
        $menuitem = Menuitem::findOrFail($id);
        //   print_r($menuitem);
        //       die();
        $menu = Menu::where('id',$menuitem->menu_id)->first();
        if($menu->content != ''){
        $data = json_decode($menu->content,true);            
        $maindata = $data[0];            
        if($in == ''){
            unset($data[0][$key]);
            $newdata = json_encode($data); 
            $menu->update(['content'=>$newdata]);                         
        }else{
            unset($data[0][$key]['children'][0][$in]);
            $newdata = json_encode($data);
            $menu->update(['content'=>$newdata]); 
        }
        }
        $menuitem->delete();
        return redirect()->back();
  }	

    public function menudestroy(Request $request){  
        if($request->id){
            menuitem::where('menu_id',$request->id)->delete();  
            menu::findOrFail($request->id)->delete();
        }    
        return redirect()->route('superAdmin.menus')->with('success','Menu deleted successfully');
    }		
    // ================== Ip White listed=============
    public function white()    {
      $userID = Auth::id();
      $userData = User::where('id', $userID)->get();
      return view('superadmin.white.index', compact('userData'));
    }
     public function whitecreate()    {  
        $users = DB::table('users')
        ->select('*')
        ->get();
        return view('superadmin.white.create', compact('users'));
    }

    public function whitestore(Request $request)    {
       $userId = $request->user_id;
       $whits = Whitelist::where('user_id',$userId)->get();    
        if($request->isMethod('post')){
            if(empty($whits[0]->user_id)){
                $user = Whitelist::create([
                'user_id' =>  $request->input('user_id'),
                'ip' =>  $request->input('ip'),
                ]);
                return redirect()->route('superAdmin.white')->with('success','IP added white listed');
            }else{
                return redirect()->route('superAdmin.white')->with('error','Allredy added');
              
            }
        }
        
    }
    public function whiteedit($id)    {
        $users = DB::table('users')
            ->select('*')
            ->get(); 
        $white = Whitelist::find($id);
        return view('superadmin.white.edit', compact('white','users'));
    }
    public function whiteupdate(Request $request)    {
        $white = Whitelist::find($request->id);
        $white->user_id = $request->input('user_id');
        $white->ip = $request->input('ip');
        $white->save();    
     return redirect()->route('superAdmin.white')->with('success','Update successfully');
    }
    public function whitedestroy($id)    {
        $destroyID = Whitelist::findOrFail($id);
        $destroyID->delete();
        return redirect()->route('superAdmin.white')->with('success','IP and User Deleted');

    }
    // ============================= Black listed=================
    public function black()
    {
      $userID = Auth::id();
      $userData = User::where('id', $userID)->get(); 
      return view('superadmin.black.index', compact('userData'));
    }
    public function blackcreate(){
         $users = DB::table('users')
        ->select('*')
        ->get();
        return view('superadmin.black.create', compact('users'));
    }

    public function blackstore(Request $request)
    {
        $userId = $request->user_id;
        $black = Blacklist::where('user_id',$userId)->get();    
        if($request->isMethod('post')){
            if(empty($black[0]->user_id) || empty($black[0]->ip)){
           Blacklist::create([
                 'user_id' =>  $request->input('user_id'),
                 'ip' =>  $request->input('ip'),
                ]);

                return redirect()->route('superAdmin.black')->with('success','IP added black listed');
            }else{
                return redirect()->route('superAdmin.black')->with('error','Allredy added');
              
            }
        }
    }
    public function blackedit($id)
    {
        $black = Blacklist::find($id);
        $users = DB::table('users')
            ->select('*')
            ->get(); 
        return view('superadmin.black.edit', compact('black','users'));
    }

    public function blackupdate(Request $request)
    {
        $black = Blacklist::find($request->id);
        $black->ip = $request->input('ip');
        $black->save();    
        return redirect()->route('superAdmin.black')->with('success','Update successfully');
    }
    public function blackdestroy($id)
    {
        $destroyID = Blacklist::findOrFail($id);
        $destroyID->delete();
          return redirect()->route('superAdmin.black')->with('success','IP and User Deleted');
    }
    
    // ================== User=============
    public function users(){   
        $data = User::orderBy('id', 'asc')->paginate(15);        
        return view('superadmin.users.index', compact('data'));
    } 
    public function usercreate(){
        return view('superadmin.users.create');
    }

    public function usersupload(Request $request){
       $userName = Auth::user()->name;
        if ($request->file('file')) {
          $file = $request->file('file');
            $fullImagename = $file->getClientOriginalName();
            $imagename = pathinfo($fullImagename, PATHINFO_FILENAME);
            $extension = pathinfo($fullImagename, PATHINFO_EXTENSION);
            $filePath = $imagename.'_'.time().'.'.$extension;
            $allowedfileExtension=['png','jpg','gif','bmp','jpeg'];
            $check=in_array($extension,$allowedfileExtension);
            if($check){
                $imgFile = Image::make($file->getRealPath());

                $imagepath = public_path('/images');
                $imgFile->resize(450, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($imagepath.'/'.$filePath);

                $imagesPath = public_path('/thumbnail');
                $imgFile->resize(100, 80)->save($imagesPath.'/'.$filePath);    

                $singleImagesPath = public_path('/singleimg');
                $imgFile->resize(750, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($singleImagesPath.'/'.$filePath);
          
                $destinationPath = public_path('/upload');
                $path = $file->move($destinationPath, $filePath); 
            }
            else{
                $path =  $file->move(public_path('/files'), $filePath);
            }
        }
        $imageUpload = new ImageUpload;
        $imageUpload->name = $filePath;
        $imageUpload->title = $imagename;
        $imageUpload->alt = $imagename;
        $imageUpload->path =  $filePath;
        $imageUpload->slug = $filePath;
        $imageUpload->status = '1';
        $imageUpload->username = $userName;
        $imageUpload->extention = '.'.$extension;
        $imageUpload->save();
     return response()->json(['success' => $imageUpload]);
    } 
    public function usersfetch(Request $request){
        $images = DB::table('image_uploads')->orderBy('id', 'DESC')->get();
        $output = '<div class="file-manager-content">';        
            $output .= '<div id="image_file_upload_response">';
            foreach ($images as $image){
                    $output .= '<div class="col-file-manager" id="img_col_id_'. $image->id .'">';
                        $output .= '<div class="file-box"  data-file-caption="'. $image->caption .'" data-file-description="'. $image->description .'" data-file-alt="'. $image->alt .'" data-file-title="'. $image->title .'" data-file-name="'. $image->name .'"  data-file-id="'. $image->id .'" data-file-path="'.asset('upload/' . $image->name).'" data-file-path-editor="'.asset('upload/' . $image->name).'">';
                        $fileextention = ['.jpg','.png','.bmp','.gif','.jpeg'];
                    for($i=0; $i<count($fileextention); $i++){
                        if($image->extention == $fileextention[$i]){
                          $output .= '<div class="image-container">';  
                                $output .= '<img src="'.asset('images/' . $image->name).'" alt="'. $image->alt .'" title="'. $image->title .'" loading="lazy" class="img-responsive">';
                                    $name = substr($image->name, 0, 20).'...';
                                    $output .= '<span class="file-name">'.$name.'</span>';
                            $output .= '</div>';
                        }
                    }
                    $output .= '</div>';
                $output .= '</div>';			        
            }
           $output .= '</div>';
        $output .= '</div>';
        echo $output;
    }
    public function usersuploaddelete(Request $request) {
        $val = $request->name;
        $userNames =  User::where('profile_image', $val)->get();
        if(!empty($userNames[0]->profile_image)){
            if(($val == $userNames[0]->profile_image)){
                $msg = '<div class="alert alert-success text-center">This image is already used.</div>';
                $action = "image";
                return response()->json(array('msg'=> $msg, 'action'=>$action), 200);
            }
            }else{
                ImageUpload::where('name', $val)->delete();
                $lines = ['upload/','images/','single/','thumbnail/'];
                for($i = 0; $i < count($lines); $i++) {
                    $value =  $lines[$i];
                    $path = public_path($value).$val;
                    if (file_exists($path)) {
                        unlink($path);
                        }
                    }    
                return response()->json(['data'=>$val],200);
            }        
    } 
    
    public function userstore(Request $request){   
            $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed',
        ]);
    
        $input = $request->all();
        $input['profile_image'] = $request->image_name;
        $input['is_email_verified'] = '1';
        $input['password'] = Hash::make($input['password']);
    
        $user = User::create($input);
        return redirect()->route('superAdmin.users')
            ->with('success', 'User created successfully.');
    }
    public function usershow($id){
        $user  = new UserController;  
        $urs = $user->show($id);
        $users = $urs[0];
        return view('superadmin.users.show', compact('users'));
    }
    public function useredit($id){
        
        $user = User::find($id);    
    
        // $users  = new UserController;  
        // $urs = $users->edit($id);
        // $user = $urs[0];
        return view('superadmin.users.edit', compact('user'));
    } 
    public function userpublish($id){
        $publish =  User::find($id);
        $publish->status_id = 0;
        $publish->save();
        return redirect('superAdmin/users');
    } 
    public function userunpublish($id){
    
        $publish =  User::find($id);
        $publish->status_id = 1;
        $publish->save();
        return redirect('superAdmin/users');
    }
    public function userupdate(Request $request, $id) {   
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'confirmed',
        ]);
        $input = $request->all();
        $input['role_id'] = $request->role_id;
        $input['status_id'] = $request->status_id;
        $input['password'] = $request->password;
        $input['profile_image'] = $request->image_name;
        if(!empty($input['password'])){ 
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));    
        }
        $user = User::find($id);
        $user->update($input);
        return redirect()->route('superAdmin.users')
                        ->with('success','User updated successfully');

    }
    public function userdestroy($id){
        $user =  User::find($id)->delete();
        return redirect()->route('superAdmin.users')
            ->with('success', 'User deleted successfully.');
    }
    public function userssearch(Request $request){
             $images=DB::table('image_uploads')
                ->where('name','LIKE','%'.$request->search."%")
                ->get(); 
            foreach ($images as $image):
                echo '<div class="col-file-manager" id="img_col_id_' . $image->id . '">';
                    echo '<div class="file-box" data-file-name="'. $image->name .'"  data-file-id="'. $image->id .'" data-file-path="'.asset('upload/' . $image->name).'" data-file-path-editor="'.asset('upload/' . $image->name).'">';
                   echo '<div class="image-container">';
                            echo '<img src="'.asset('images/' . $image->name).'" alt="" name="file" class="img-responsive">';
                                $name = substr($image->name, 0, 20).'...';
                            echo '<span class="file-name">'.$name.'</span>';
                    echo '</div>';
                echo '</div> </div>';
            endforeach;
    }

    // ================== Role=============
    public function roles(){ 
        $role  = new RoleController;      
        $data = $role->index();
        return view('superadmin.roles.index', compact('data'));
    } 
     public function rolecreate(){
        $role  = new RoleController;  
        $roles = $role->create();
        $permission = $roles[0];
        $users = $roles[1];
        return view('superadmin.roles.create', compact(['permission','users']));
    }

    public function rolestore(Request $request){   
        $role  = new RoleController;  
        $role->store($request);
        return redirect()->route('superAdmin.roles')
            ->with('success', 'Role created successfully.');
    }
    public function roleshow($id){
        $role  = new RoleController;  
        $roles = $role->show($id);
        $role = $roles[0];
        $rolePermissions = $roles[1];
        return view('superadmin.roles.show', compact('role', 'rolePermissions'));
    }
    public function roleedit($id){
        $role  = new RoleController;  
        $roles = $role->edit($id);
        $role = $roles[0];
        $permission = $roles[1];
        $rolePermissions = $roles[2];
        return view('superadmin.roles.edit', compact('role', 'permission', 'rolePermissions'));
    }
    public function roleupdate(Request $request, $id) {   
        $role  = new RoleController;  
        $role->update($request, $id);
        return redirect()->route('superAdmin.roles')
            ->with('success', 'Role updated successfully.');
    } 
      public function roledelete($id){
        $user =  Role::find($id)->delete();
        return redirect()->route('superAdmin.users')
            ->with('success', 'User deleted successfully.');
    }

    // ================== permission=============
    public function permissions(){     
        
        // dd("ok");

        $permission = new PermissionController;      
        $data = $permission->index();
        return view('superadmin.permissions.index', compact('data'));
    } 
     public function permissioncreate(){
        return view('superadmin.permissions.create');
    }
    public function permissionstore(Request $request){   
        $permissions  = new PermissionController;  
        $permissions->store($request);
        return redirect()->route('superAdmin.permissions')
            ->with('success', 'Permission created successfully.');
    }
    public function permissionshow($id){
        $permission  = new PermissionController;  
        $prms = $permission->show($id);
        $permissions = $prms[0];
        return view('superadmin.permissions.show', compact('permissions'));
    }
    public function permissionedit($id){
        $permission  = new PermissionController;  
        $permission = $permission->edit($id);
        $permissions = $permission[0];
        return view('superadmin.permissions.edit', compact('permissions'));
    }
    public function permissionupdate(Request $request, $id) {   
        $role  = new PermissionController;  
        $role->update($request, $id);
        return redirect()->route('superAdmin.permissions')
            ->with('success', 'Permission updated successfully.');
    }
    public function permissiondelete($id)
    {
        $permission  = new PermissionController;  
        $permission->destroy($id);
        return redirect()->route('superAdmin.permissions')
            ->with('success', 'Pemission deleted successfully.');
    }


    // ============================CSV===============================
    public function csvfile(){
       return view('csv');
    }
    public function export() {
        $filename = 'blogcms.csv';
        $delimiter = ',';
        // $data = Post::all();
        $f = fopen("tmp.csv", "w");
        header('Content-Type: application/csv');
        header('Content-Disposition: attachment; filename="'.$filename.'";');

        // open the "output" stream
        // see http://www.php.net/manual/en/wrappers.php.php#refsect2-wrappers.php-unknown-unknown-unknown-descriptioq
        $f = fopen('php://output', 'w');
        $line = [
                'post_title',
                'post_name',
                'post_slug',
                'post_excerpt',
                'post_content',  
                'post_tag',
                'post_trending',
                'post_template',  
                'post_views',
                'post_status',
                                
                'page_title',
                'page_name',
                'page_slug',                
                'page_content',                  
                'page_template',  
                'page_views',
                'page_status', 
                
                
                'cat_title',
                'cat_name',
                'cat_slug', 
                'cat_status',
            ];
        
        fputcsv($f, $line, $delimiter);
        // foreach ($data as $row) {
        //     $line = [$row->id,$row->service_name];
        //     fputcsv($f, $line, $delimiter);
        // }
        //return Excel::download(new RevenuesExport, 'revenue.csv');
    }
    private $rows = [];
    
    public function import(Request $request) {
        $path = $request->file('file')->getRealPath();
        $records = array_map('str_getcsv', file($path));
        if (! count($records) > 0) {
            return 'Error...';
        }
        // Get field names from header column
        $fields = array_map('strtolower', $records[0]);
        // Remove the header column
        array_shift($records);

        foreach ($records as $record) {
            if (count($fields) != count($record)) {
                return 'csv_upload_invalid_data';
            }

            // Decode unwanted html entities
            $record =  array_map("html_entity_decode", $record);

            // Set the field name as key
            $record = array_combine($fields, $record);

            // Get the clean data
            $this->rows[] = $this->clear_encoding_str($record);
        }
        foreach ($this->rows as $data) { 

           
            $postcheck = Post::where(['slug'=>$data['post_slug']])->get()->first();
                if($postcheck == null){
                    Post::create([
                            'title' => $data['post_title'],
                            'name' => $data['post_name'],
                            'slug' => $data['post_slug'],  
                            'excerpt' => $data['post_excerpt'],
                            'content' => $data['post_content'],
                            'tag' => $data['post_tag'],   
                            'trending' => $data['post_trending'],
                            'template' => $data['post_template'],  
                            'views' => $data['post_views'],
                            'status' => $data['post_status'],
                    ]);
                }    
                $pagecheck = Page::where(['slug'=>$data['page_slug']])->get()->first();  
                if($pagecheck == null){
                    Page::create([
                            'title' => $data['page_title'],
                            'name' => $data['page_name'],
                            'slug' => $data['page_slug'],  
                            'content' => $data['page_content'],
                            'template' => $data['page_template'],  
                            'views' => $data['page_views'],
                            'status' => $data['page_status'],
                    ]);
                }   
                $catcheck = Category::where(['slug'=>$data['cat_slug']])->get()->first();  
                if($catcheck == null){
                    Category::create([
                            'title' => $data['cat_title'],
                            'name' => $data['cat_name'],
                            'slug' => $data['cat_slug'], 
                            'status' => $data['cat_status'],
                    ]);
                }   
                // Postmeta::create([
                //         'post_id' => $data['meta_post_id'],
                //         'cat_id' => $data['meta_cat_id'],
                // ]);                     
        }
        return \redirect()->back()       
           ->with('success','Data added successfully.');
        
    }    
    private function clear_encoding_str($value) {
        if (is_array($value)) {
            $clean = [];
            foreach ($value as $key => $val) {
                $clean[$key] = mb_convert_encoding($val, 'UTF-8', 'UTF-8');
            }
            return $clean;
        }
        return mb_convert_encoding($value, 'UTF-8', 'UTF-8');
    }
 

    //============================ Media ===============
    public function media(){
         if (!is_dir($this->images) || !is_dir($this->thumbnail)||!is_dir($this->singleimg) || !is_dir($this->upload)|| !is_dir($this->files)) {
             mkdir($this->images, 0777);
             mkdir($this->thumbnail, 0777);   
             mkdir($this->singleimg, 0777);
             mkdir($this->upload, 0777);
             mkdir($this->files, 0777);
         }
        $data = ImageUpload::orderBy('id', 'desc')->paginate(16);   
        return view('superadmin.media.index', compact('data'));
    }    
    public function mediaupload(Request $request){
        $userName = Auth::user()->name;
        if ($request->file('file')) {
          $file = $request->file('file');
            $fullImagename = $file->getClientOriginalName();
            $imagename = pathinfo($fullImagename, PATHINFO_FILENAME);
            $extension = pathinfo($fullImagename, PATHINFO_EXTENSION);
            $filePath = $imagename.'_'.time().'.'.$extension;
            $allowedfileExtension=['png','jpg','gif','bmp','jpeg'];
            $check=in_array($extension,$allowedfileExtension);
            if($check){
                $imgFile = Image::make($file->getRealPath());

                $imagepath = public_path('/images');
                $imgFile->resize(450, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($imagepath.'/'.$filePath);

                $imagesPath = public_path('/thumbnail');
                $imgFile->resize(100, 80)->save($imagesPath.'/'.$filePath);    

                $singleImagesPath = public_path('/singleimg');
                $imgFile->resize(750, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($singleImagesPath.'/'.$filePath);
          
                $destinationPath = public_path('/upload');
                $path = $file->move($destinationPath, $filePath); 
            }
            else{
                $path =  $file->move(public_path('/files'), $filePath);
            }
        }
        $imageUpload = new ImageUpload;
        $imageUpload->name = $filePath;
        $imageUpload->title = $imagename;
        $imageUpload->alt = $imagename;
        $imageUpload->path =  $filePath;
        $imageUpload->slug = $filePath;
        $imageUpload->status = '1';
        $imageUpload->username = $userName;
        $imageUpload->extention = '.'.$extension;

        $imageUpload->save();
     return response()->json(['success' => $imageUpload]);
    } 
    public function mediauploaddelete(Request $request) {
        $val = $request->name;
        $imageId = $request->id;  
            ImageUpload::where('name', $val)->delete();
                $lines = ['upload/','images/','single/','thumbnail/','files/'];
                for($i = 0; $i < count($lines); $i++) {
                    $value =  $lines[$i];
                    $path = public_path($value).$val;
                    if (file_exists($path)) {
                        unlink($path);
                        }
                    }    
                return response()->json(['data'=>$val],200);    


        // Below the code use never Delete any one becouse that image already use 

        // $projecntNames =  Project::where('project_logo', $val)->get();
        // if(!empty($projecntNames[0]->project_logo)){
        //     if(($val == $projecntNames[0]->project_logo)){
        //         $msg = '<div class="alert alert-success text-center">This image is already used.</div>';
        //         $action = "image";
        //         return response()->json(array('msg'=> $msg, 'action'=>$action), 200);
        //     }
        // } 
        // $documents =  Document::where('document_image_id', $imageId)->get();
        //     if(!empty($documents[0]->document_image_id)){
        //         if(($imageId == $documents[0]->document_image_id)){
        //             $msg = '<div class="alert alert-success text-center">This file is already used.</div>';
        //             $action = "file";
        //             return response()->json(array('msg'=> $msg, 'action'=>$action), 200);     
        //         }
        //      } 
        //      else{
        //         ImageUpload::where('name', $val)->delete();
        //         $lines = ['upload/','images/','single/','thumbnail/','files/'];
        //         for($i = 0; $i < count($lines); $i++) {
        //             $value =  $lines[$i];
        //             $path = public_path($value).$val;
        //             if (file_exists($path)) {
        //                 unlink($path);
        //                 }
        //             }    
        //         return response()->json(['data'=>$val],200);              
        //     } 
    }
    public function mediafetch(Request $request){
    //  $images =\File::allFiles(public_path('upload'));
     $images = DB::table('image_uploads')->orderBy('id', 'DESC')->get();
     $output = '<div class="file-manager-content">';        
        $output .= '<div id="image_file_upload_response">';
        foreach ($images as $image){
                $output .= '<div class="col-file-manager" id="img_col_id_'. $image->id .'">';
                    $output .= '<div class="file-box"  data-file-caption="'. $image->caption .'" data-file-description="'. $image->description .'" data-file-alt="'. $image->alt .'" data-file-title="'. $image->title .'" data-file-name="'. $image->name .'"  data-file-id="'. $image->id .'" data-file-path="'.asset('upload/' . $image->name).'" data-file-path-editor="'.asset('upload/' . $image->name).'">';
                       if($image->extention == '.pdf'){
                        $output .= '<div class="image-container">';  
                            $output .= '<img src="'.asset('img/' . 'pdf.png').'" id="'. $image->id .'" loading="lazy" class="img-responsive">';
                            $name = substr($image->name, 0, 15).'...';
                            $output .= '<span class="file-name">'.$name.'</span>';
                            $output .= '</div>';
                        }     
                        elseif($image->extention == '.docx'){
                            $output .= '<div class="image-container">';  
                                $output .= '<img src="'.asset('img/' . 'docx.png').'"  loading="lazy" class="img-responsive">';
                                $name = substr($image->name, 0, 15).'...';
                                $output .= '<span class="file-name">'.$name.'</span>';
                            $output .= '</div>';
                        }    
                        elseif($image->extention == '.xlsx'){
                            $output .= '<div class="image-container">';  
                                $output .= '<img src="'.asset('img/' . 'xlsx.png').'"  loading="lazy" class="img-responsive">';
                                $name = substr($image->name, 0, 15).'...';
                                $output .= '<span class="file-name">'.$name.'</span>';
                            $output .= '</div>';
                        } else{
                            $output .= '<div class="image-container">';  
                                $output .= '<img src="'.asset('images/' . $image->name).'" alt="'. $image->alt .'" title="'. $image->title .'" loading="lazy" class="img-responsive">';
                                    $name = substr($image->name, 0, 20).'...';
                                    // $name = mb_strimwidth($image->image, 0, 10, "...");  // another way
                                    // $output .= '<button type="button" class="btn btn-link remove_image" id="'.$image->id.'">Remove</button>';
                                    $output .= '<span class="file-name">'.$name.'</span>';
                            $output .= '</div>';
                        }
                    $output .= '</div>';
                $output .= '</div>';			        
            }
           $output .= '</div>';
        $output .= '</div>';
        echo $output;
    }
    public function mediasearch(Request $request){
            $images=DB::table('image_uploads')
                ->where('name','LIKE','%'.$request->search."%")
                ->get(); 
           if (!empty($images[0]->name)){
            foreach ($images as $image):
                echo '<div class="col-file-manager col-sm-6 col-md-2 col-lg-2 mb-5" id="img_col_id_' . $image->id . '">';
                    echo '<div class="file-box" data-file-name="'. $image->name .'"  data-file-id="'. $image->id .'" data-file-path="'.asset('upload/' . $image->name).'" data-file-path-editor="'.asset('upload/' . $image->name).'">';
                    if($image->extention == '.pdf'){
                      
                        echo '<div class="image-container-file">';
                            echo '<input type="hidden" id="selected_img_name_'. $image->name .'" value="'. $image->name .'">';
                            echo     '<a id="btn_delete_post_main_image" onclick="myFunction_'. $image->id .'()"
                                     class="btn btn-danger btn_img_delete btn-sm">
                                     <i class="fa fa-times"></i>
                                 </a>';
                               echo '<button type="button" class="btn-field" id="file_manager_'. $image->id .'"
                                     data-toggle="modal" data-target="#image_file_manager_'. $image->id .'">
                                         <figure>
                                         <img src="'.asset('img/' . 'pdf.png').'"  loading="lazy" class="img-responsive search-img file-image" style="max-height:200px">
                                        <figcaption class="text-center">
                                            '. mb_strimwidth($image->title, 0, 20, '...') .' </figcaption>
                                     </figure>
                                 </button>';

                    echo '</div>';
                    } elseif($image->extention == '.docx'){
                          echo '<div class="image-container-file">';
                            echo '<input type="hidden" id="selected_img_name_'. $image->name .'" value="'. $image->name .'">';
                            echo     '<a id="btn_delete_post_main_image" onclick="myFunction_'. $image->id .'()"
                                     class="btn btn-danger btn_img_delete btn-sm">
                                     <i class="fa fa-times"></i>
                                 </a>';
                               echo '<button type="button" class="btn-field" id="file_manager_'. $image->id .'"
                                     data-toggle="modal" data-target="#image_file_manager_'. $image->id .'">
                                         <figure>
                                         <img src="'.asset('img/' . 'docx.png').'"  loading="lazy" class="img-responsive search-img file-image" style="max-height:200px">
                                        <figcaption class="text-center">
                                            '. mb_strimwidth($image->title, 0, 20, '...') .' </figcaption>
                                     </figure>
                                 </button>';

                    echo '</div>';
                    } elseif($image->extention == '.xlsx'){
                        echo '<div class="image-container-file">';
                            echo '<input type="hidden" id="selected_img_name_'. $image->name .'" value="'. $image->name .'">';
                            echo     '<a id="btn_delete_post_main_image" onclick="myFunction_'. $image->id .'()"
                                     class="btn btn-danger btn_img_delete btn-sm">
                                     <i class="fa fa-times"></i>
                                 </a>';
                               echo '<button type="button" class="btn-field" id="file_manager_'. $image->id .'"
                                     data-toggle="modal" data-target="#image_file_manager_'. $image->id .'">
                                         <figure>
                                         <img src="'.asset('img/' . 'xlsx.png').'"  loading="lazy" class="img-responsive search-img file-image" style="max-height:200px">
                                        <figcaption class="text-center">
                                            '. mb_strimwidth($image->title, 0, 20, '...') .' </figcaption>
                                     </figure>
                                 </button>';

                    echo '</div>';
                    }else{
                    echo '<div class="image-container-file">';
                            echo '<input type="hidden" id="selected_img_name_'. $image->name .'" value="'. $image->name .'">';
                            echo     '<a id="btn_delete_post_main_image" onclick="myFunction_'. $image->id .'()"
                                     class="btn btn-danger btn_img_delete btn-sm">
                                     <i class="fa fa-times"></i>
                                 </a>';
                               echo '<button type="button" class="btn-field" id="file_manager_'. $image->id .'"
                                     data-toggle="modal" data-target="#image_file_manager_'. $image->id .'">
                                         <figure>
                                         <img src="'.asset('images/' . $image->name).'" alt="" name="file" class="img-responsive search-img">
                                         
                                        <figcaption class="text-center">
                                            '. mb_strimwidth($image->title, 0, 20, '...') .' </figcaption>
                                     </figure>
                                 </button>';
                    echo '</div>';
                    }

                echo '</div> </div>';
                
            endforeach;
             }else{
                        echo '<h2 class="text-center">No data found</h2>';
                    }
             echo '<div id="image_file_bottom">';
            echo '</div>';

    }
  
   
  
  


}
