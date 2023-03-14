<?php

namespace App\Http\Servicecruds;

use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use App\Models\Role_has_permission;
use App\Models\Slider;
use App\Models\Post;
use App\Models\Page;
use App\Models\Comment;
use App\Models\Postmeta;
use App\Models\Category;
use App\Models\LangChange;
use App\Models\ImageUpload;
use App\Models\Whitelist;
use App\Models\Getip;
use App\Models\Blacklist;

use DB;
use Image;
use Hash;
use Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File; 
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Http;
use App\Models\menu;
use App\Models\Menuitem;

use App\Http\Servicecruds\RevenuesExport;

use App\Models\Artical;

use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\UserController;
// try  catch
use App\Services\PayUService\Exception;
// Event
use App\Events\UserCreated;
// language
use App;


class Settingcrud{

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
    public function sliderindex()   {
        $sliders = Slider::select('*')->paginate(5);
        return view('superAdmin.slider.index', compact('sliders'));
    }
    // ========================================== Slider   
  
    public function slidercreate(){
        return view('superAdmin.slider.create');
    }
    public function sliderstore( $request) {
        $data = $request->all();
        if($request->method()=='POST'){       
            Slider::create([               
                'imagename' => $request->imagename,
                'imagecaption' => $request->imagecaption,
                'status' => $request->status,     
                'image' => $request->image_name,     
            ]);
        }
     return redirect()->route('superAdmin.slider')
        ->with('success','slider created successfully.');
    }

    public function slideredit($id)    {
        $slider = Slider::findOrFail($id);
        return view('superAdmin.slider.edit',compact('slider'));
    }

    public function sliderpublish($id){
        $publish =  Slider::find($id);
        $publish->status = 0;
        $publish->save();
         return redirect()->route('superAdmin.slider')->with('success','Publish successfully');
    }
    public function sliderunpublish($id){
        $unpublish =  Slider::find($id);
        $unpublish->status = 1;
        $unpublish->save();
        return redirect()->route('superAdmin.slider')->with('success','Unpublish successfully');
    }

    public function sliderupdate( $request,$id)    {
        $input['imagename'] = $request->imagename;
        $input['imagecaption'] = $request->imagecaption;
        $input['image'] = $request->image_name;
        $input['status'] = $request->status;
        $slider = Slider::findOrFail($id);
        $slider->update($input);
        return redirect()->route('superAdmin.slider')
            ->with('success','slider Updated successfully.');
    }
    public function sliderdelete($id){
   
        $slider = Slider::findOrFail($id);
        $slider->delete();
         return redirect()->route('superAdmin.slider')
            ->with('success','slider Deleted successfully.');
    }
     // ================================

    public function sliderupload($request){
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
                
                $singleImagesPath = public_path('/singleimg');
                $imgFile->resize(750, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($singleImagesPath.'/'.$filePath);
                
                $imgFile->resize(450, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($imagepath.'/'.$filePath);

                $imagesPath = public_path('/thumbnail');
                $imgFile->resize(100, 80)->save($imagesPath.'/'.$filePath);   
                
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
    public function sliderfetch( $request){
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
    public function slideruploaddelete($request) {
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
    public function sliderimgsearch($request){
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
    // ================== Ip White listed=============
    public function white()    {
        $userID = Auth::id();
        $userData = User::where('id', $userID)->get();
        return view('superAdmin.white.index', compact('userData'));
    }
    public function whitecreate()    {  
        $users='';
        $users = DB::table('users')
        ->select('*')
        ->get();
        $distinks = DB::table('hitlogs')
            ->orderBy('id', 'DESC')
        ->get()
        ->unique('ip');
        return view('superAdmin.white.create', compact('users','distinks'));
    }

    public function whitestore( $request)    {
        $userId = $request->user_id;
        $whits = Whitelist::where('user_id',$userId)->get();    
        if($request->isMethod('post')){
            // if(!empty($whits[0]->user_id)){  // for all dubliket user_id loging
            if(empty($whits[0]->user_id)){      // for uniqe user_id login
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
        return view('superAdmin.white.edit', compact('white','users'));
    }
    public function whiteupdate($request)    {
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
    public function black(){
        $userID = Auth::id();
        $userData = User::where('id', $userID)->get(); 
        return view('superAdmin.black.index', compact('userData'));
    }
    public function blackcreate(){
        $users = DB::table('users')
        ->select('*')
        ->get();
        return view('superAdmin.black.create', compact('users'));
    }

    public function blackstore($request)    {
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
    public function blackedit($id)  {
        $black = Blacklist::find($id);
        $users = DB::table('users')
            ->select('*')
            ->get(); 
        return view('superAdmin.black.edit', compact('black','users'));
    }

    public function blackupdate( $request)    {
        $black = Blacklist::find($request->id);
        $black->ip = $request->input('ip');
        $black->save();    
        return redirect()->route('superAdmin.black')->with('success','Update successfully');
    }
    public function blackdestroy($id){
        $destroyID = Blacklist::findOrFail($id);
        $destroyID->delete();
        return redirect()->route('superAdmin.black')->with('success','IP and User Deleted');
    }
    // ============================CSV===============================
    public function csvfile(){
        return view('superAdmin.csv');
    }
    public function export() {
        $filename = 'blogcms.csv';
        $delimiter = ',';
        $data = Post::all();
        $f = fopen("tmp.csv", "w");
        header('Content-Type: application/csv');
        header('Content-Disposition: attachment; filename="'.$filename.'";');

        // open the "output" stream
        // see http://www.php.net/manual/en/wrappers.php.php#refsect2-wrappers.php-unknown-unknown-unknown-descriptioq
        $f = fopen('php://output', 'w');
        $line = [
                'post_title_en',
                'post_name_en',
                'post_slug_en',
                'post_content_en',  
                'post_excerpt_en',  
                
                'post_title_bn',
                'post_name_bn',
                'post_slug_bn',
                'post_content_bn',  
                'post_excerpt_bn',

                'post_tag',
                'post_trending',
                'post_template',  
                'post_views',
                'post_status',
                                
                'page_title_en',
                'page_name_en',
                'page_slug_en',                
                'page_content_en',    
                
                'page_title_bn',
                'page_name_bn',
                'page_slug_bn',                
                'page_content_bn',   

                'page_template',  
                'page_views',
                'page_status', 
                
                
                'cat_title_en',
                'cat_name_en',
                'cat_slug_en', 
                
                'cat_title_bn',
                'cat_name_bn',
                'cat_slug_bn', 

                'cat_status',

                // 'post_id',
                // 'cat_id', 
            ];        
        fputcsv($f, $line, $delimiter);
        
        // foreach ($data as $row) {
        //     $line = [$row->id,$row->service_name];
        //     fputcsv($f, $line, $delimiter);
        // }
        // return Excel::download(new RevenuesExport, 'revenue.csv');
    }
    private $rows = [];
    
    public function import($request) {        
        if(!empty($request->file('file'))){
            $path = $request->file('file')->getRealPath();
        
        $records = array_map('str_getcsv', file($path));
        if (! count($records) > 0) {
            return 'Error...';
        }
        // Get field names from header column
        $fields = array_map('strtolower', $records[0]);
        // Remove the header column
        array_shift($records);
        }else{
            return \redirect()->back()       
            ->with('success','Please upload csv file.');
        }

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

        
            $postcheck = Post::where(['slug_'. app()->getLocale()=>$data['post_slug_'. app()->getLocale()]])->get()->first();
                if($postcheck == null){
                    Post::create([
                            'title_en' => $data['post_title_en'],
                            'name_en' => $data['post_name_en'],
                            'slug_en' => $data['post_slug_en'],  
                            'excerpt_en' => $data['post_excerpt_en'],
                            'content_en' => $data['post_content_en'],    
                            
                            'title_bn' => $data['post_title_bn'],
                            'name_bn' => $data['post_name_bn'],
                            'slug_bn' => $data['post_slug_bn'],  
                            'excerpt_bn' => $data['post_excerpt_bn'],
                            'content_bn' => $data['post_content_bn'],

                            'tag' => $data['post_tag'],   
                            'trending' => $data['post_trending'],
                            'template' => $data['post_template'],  
                            'views' => $data['post_views'],
                            'status' => $data['post_status'],
                    ]);
                }    
                $pagecheck = Page::where(['slug_'. app()->getLocale()=>$data['page_slug_'. app()->getLocale()]])->get()->first();  
                if($pagecheck == null){
                    Page::create([
                            'title_en' => $data['page_title_en'],
                            'name_en' => $data['page_name_en'],
                            'slug_en' => $data['page_slug_en'],  
                            'content_en' => $data['page_content_en'],    
                            
                            'title_bn' => $data['page_title_bn'],
                            'name_bn' => $data['page_name_bn'],
                            'slug_bn' => $data['page_slug_bn'],  
                            'content_bn' => $data['page_content_bn'],

                            'template' => $data['page_template'],  
                            'views' => $data['page_views'],
                            'status' => $data['page_status'],
                    ]);
                }   
                $catcheck = Category::where(['slug_'. app()->getLocale()=>$data['cat_slug_'. app()->getLocale()]])->get()->first();  
                if($catcheck == null){
                    Category::create([
                            'title_en' => $data['cat_title_en'],
                            'name_en' => $data['cat_name_en'],
                            'slug_en' => $data['cat_slug_en'],       
                            
                            'title_bn' => $data['cat_title_bn'],
                            'name_bn' => $data['cat_name_bn'],
                            'slug_bn' => $data['cat_slug_bn'], 

                            'status' => $data['cat_status'],
                    ]);
                }   
                // Postmeta::create([
                //         'post_id' => $data['post_id'],
                //         'cat_id' => $data['cat_id'],
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


    // ================= for language change  ===========================================
    public function articalindex()   {
        $locale = app()->getLocale();
        $categories = Artical::select('*')->whereNotNull('title_'.$locale)->whereNotNull('detial_'.$locale)->paginate(5);
        return view('superAdmin.artical.index', compact('categories'));
    }
    public function articalcreate(){
        return view('superAdmin.artical.create');
    }
    public function articalstore($request)    {
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

    public function articalupdate($request,$id)    {
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
    
     // ================== Role=============
    public function roles(){ 
        $role  = new RoleController;      
        $data = $role->index();
        return view('superAdmin.roles.index', compact('data'));
    } 
    public function rolecreate(){
        $role  = new RoleController;  
        $roles = $role->create();
        $permission = $roles[0];
        $users = $roles[1];
        return view('superAdmin.roles.create', compact(['permission','users']));
    }

    public function rolestore($request){   
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
        return view('superAdmin.roles.show', compact('role', 'rolePermissions'));
    }
    public function roleedit($id){
        $role  = new RoleController;  
        $roles = $role->edit($id);
        $role = $roles[0];
        $permission = $roles[1];
        $rolePermissions = $roles[2];
        return view('superAdmin.roles.edit', compact('role', 'permission', 'rolePermissions'));
    }
    public function roleupdate( $request, $id) {   
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
        $permission = new PermissionController;      
        $data = $permission->index();
        return view('superAdmin.permissions.index', compact('data'));
    } 
    public function permissioncreate(){
        return view('superAdmin.permissions.create');
    }
    public function permissionstore($request){   
        $permissions  = new PermissionController;  
        $permissions->store($request);
        return redirect()->route('superAdmin.permissions')
            ->with('success', 'Permission created successfully.');
    }
    public function permissionshow($id){
        $permission  = new PermissionController;  
        $prms = $permission->show($id);
        $permissions = $prms[0];
        return view('superAdmin.permissions.show', compact('permissions'));
    }
    public function permissionedit($id){
        $permission  = new PermissionController;  
        $permission = $permission->edit($id);
        $permissions = $permission[0];
        return view('superAdmin.permissions.edit', compact('permissions'));
    }
    public function permissionupdate($request, $id) {   
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
     // ========================== Language change
    public function languageindex()   { 
        $languages = LangChange::get();
        return view('superAdmin.language.index', compact('languages'));
    }
    public function languagestore($request){
        $data = $request->all();
            if($request->method()=='POST'){       
                LangChange::create([
                    'deshboard_en' => $request->deshboard_en,
                    'about_en' => $request->about_en,
                    'categories_en' => $request->categories_en, 
                    'comment_en' => $request->comment_en,
                    'popular_en' => $request->popular_en,
                    'trending_en' => $request->trending_en,
                    'latest_en' => $request->latest_en, 
                    'reletive_en' => $request->reletive_en, 
                    'tags_en' => $request->tags_en,
                    'sidebar_en' => $request->sidebar_en, 
                    'footer_en' => $request->footer_en,  
                    'download_en' => $request->download_en,  
                    'subscriber_en' => $request->subscriber_en,  
                    
                    
                    'deshboard_bn' => $request->deshboard_bn,
                    'about_bn' => $request->about_bn,
                    'categories_bn' => $request->categories_bn, 
                    'comment_bn' => $request->comment_bn,
                    'popular_bn' => $request->popular_bn,
                    'trending_bn' => $request->trending_bn,
                    'latest_bn' => $request->latest_bn, 
                    'reletive_bn' => $request->reletive_bn, 
                    'tags_bn' => $request->tags_bn,
                    'sidebar_bn' => $request->sidebar_bn, 
                    'footer_bn' => $request->footer_bn,
                    'download_bn' => $request->download_bn,
                    'subscriber_bn' => $request->subscriber_bn,
                    
            
            ]);
        }
        return redirect()->route('superAdmin.language')
        ->with('success','Language created successfully.');
    }  
    public function languageedit($id){
        
        $lang = LangChange::findOrFail($id);          
        return view('superAdmin.language.edit',compact('lang'));
    } 
    public function languageupdate($request, $id){

        $input = $request->all();
        $input['deshboard_en'] = $request->deshboard_en;
        $input['about_en'] = $request->about_en;
        $input['categories_en'] = $request->categories_en;
        $input['comment_en'] = $request->comment_en;       
        $input['popular_en'] = $request->popular_en;
        $input['trending_en'] = $request->trending_en;        
        $input['latest_en'] = $request->latest_en;
        $input['reletive_en'] = $request->reletive_en;       
        $input['tags_en'] = $request->tags_en;
        $input['sidebar_en'] = $request->sidebar_en;       
        $input['footer_en'] = $request->footer_en;  
        
        $input['deshboard_bn'] = $request->deshboard_bn;
        $input['about_bn'] = $request->about_bn;
        $input['categories_bn'] = $request->categories_bn;
        $input['comment_bn'] = $request->comment_bn;       
        $input['popular_bn'] = $request->popular_bn;
        $input['trending_bn'] = $request->trending_bn;        
        $input['latest_bn'] = $request->latest_bn;
        $input['reletive_bn'] = $request->reletive_bn;       
        $input['tags_bn'] = $request->tags_bn;
        $input['sidebar_bn'] = $request->sidebar_bn;       
        $input['footer_bn'] = $request->footer_bn;
        
        $cateogy = LangChange::find($id);
        $cateogy->update($input);
        return redirect()->route('superAdmin.language')
            ->with('success','Language Updated successfully.');
    }
    
    public function languagedestroy($id){
        $language = LangChange::findOrFail($id);
        $language->delete();

        return redirect()->route('superAdmin.language')
            ->with('success','Language Deleted successfully.');
    }

    public function getipstore($request){
        $users = DB::table('users')
        ->select('*')
        ->get();
        $distinks = DB::table('hitlogs')
        ->orderBy('id', 'DESC')
        ->get()
        ->unique('ip');
        Getip::create([
            'setip' => $request->setip,
        ]);
        return view('superAdmin.white.create',compact('users','distinks'));
    }
}