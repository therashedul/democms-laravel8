<?php

namespace App\Http\Admincruds;

use App\Models\User;

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

use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\UserController;

use App\Models\ImageUpload;


class Usercrud{
    public function users(){   
        $data = User::orderBy('id', 'asc')->paginate(15);        
        return view('admin.users.index', compact('data'));
    } 

    public function usersupload($request){
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
                
                $singleImagesPath = public_path('/singleimg');
                $imgFile->resize(750, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($singleImagesPath.'/'.$filePath);
                $imagepath = public_path('/images');
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
        return response()->json(['success' => $imageUpload]);
    } 
    public function usersfetch( $request){
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
    public function usersuploaddelete($request) {
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
    
    public function userstore($request){   
     
    
        $input = $request->all();
        $input['profile_image'] = $request->image_name;
        $input['is_email_verified'] = '1';
        $input['password'] = Hash::make($input['password']);
    
        $user = User::create($input);
        return redirect()->route('admin.users')
            ->with('success', 'User created successfully.');
    }
    public function usershow($id){

        
        $user  = new UserController;  
        $urs = $user->show($id);
        $users = $urs[0];
        return view('admin.users.show', compact('users'));
    }
    public function useredit($id){
        
        $user = User::find($id);    
    
        // $users  = new UserController;  
        // $urs = $users->edit($id);
        // $user = $urs[0];
        return view('admin.users.edit', compact('user'));
    } 
    public function userpublish($id){
        $publish =  User::find($id);
        $publish->status_id = 0;
        $publish->save();
        return redirect('admin/users');
    } 
    public function userunpublish($id){
    
        $publish =  User::find($id);
        $publish->status_id = 1;
        $publish->save();
        return redirect('admin/users');
    }
    public function userupdate($request, $id) {   
      
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
        return redirect()->route('admin.users')
                        ->with('success','User updated successfully');

    }
    public function userdestroy($id){
        $user =  User::find($id)->delete();
        return redirect()->route('admin.users')
            ->with('success', 'User deleted successfully.');
    }
    public function userssearch($request){
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

}