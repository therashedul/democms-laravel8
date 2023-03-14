<?php

namespace App\Http\Servicecruds;

use App\Models\User;
use App\Models\Slider;
use App\Models\post;
use App\Models\Comment;
use App\Models\Postmeta;
use App\Models\Category;
use App\Models\ImageUpload;

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


class Postcrud
{
    public function postindex($request)
    {

        $userID = Auth::id();
        $userData = User::where('id', $userID)->get();
        $posts = Post::orderBy('id', 'desc')->paginate(10);
        //   $posts = Post::whereDate('publish_at', '<=', now()) ->where('status', 1)->orderByDesc('publish_at')->paginate(3);  // use for fornted
        $categories = DB::table('posts')
            ->select('*')
            ->join('postmetas', 'posts.id', '=', 'postmetas.post_id')
            ->join('categories', 'postmetas.cat_id', '=', 'categories.id')
            ->get();
        return view('superAdmin.post.index', compact('posts', 'userData', 'categories'));
    }

    public function postshow($slug)
    {

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

        $post = Post::where('id', $slug)->get();
        // $cat = Category::findOrFail($id);
        $categories = Category::where('parent_id', '')->get();
        $postmeta = Postmeta::where('post_id', $post[0]->id)->get();
        // print_r($postmeta);
        // die();
        return view('superAdmin.post.show', compact('post', 'categories', 'postmeta'));

    }

    public function postcreate()
    {

        // $userID = Auth::id();
        // echo $userID;


        $user = Auth::user(); // display all information in current user
        $catID = DB::table('categories')->latest('id')->first();
        $postID = DB::table('posts')->latest('id')->first();
        $metaID = DB::table('postmetas')->latest('id')->first();

        if (empty($postID)) {
            // $pid = ++$postID;
            $post = new Post();
            $post->title_en = "Post";
            $post->name_en = "post";
            $post->slug_en = "post";

            $post->title_bn = "Post";
            $post->name_bn = "post";
            $post->slug_bn = "post";
            $post->status = "1";
            $post->save();
        }
        if (empty($catID)) {
            $cat = new Category();
            $cat->title_en = "unknown";
            $cat->name_en = "unknown";
            $cat->slug_en = "unknown";

            $cat->title_bn = "unknown";
            $cat->name_bn = "unknown";
            $cat->slug_bn = "unknown";
            $cat->parent_id = "0";
            $cat->save();
        }

        if (empty($metaID)) {
            $cat = new postmeta();
            if (empty($postID->id)) {
                return redirect()->back();
            } else {
                $cat->post_id = $postID->id;
                $cat->cat_id = $catID->id;
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
        return view('superAdmin.post.create', compact('categories', 'user'));
    }
    public function poststore($request)
    {
        // print_r($request->all());
        //         die();
        $check = '';
        $url = $request->input('youtubevideo');
        // $url = 'http://www.youtube.com/watch?v=C4kxS1ksqtw&feature=relate';
        // parse_str(parse_url($url, PHP_URL_QUERY), $my_array_of_vars);
        // echo $my_array_of_vars['v'];

        preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match);

        if ($request->file('file')) {
            $file = $request->file('file');
            $fullImagename = $file->getClientOriginalName();
            $imagename = pathinfo($fullImagename, PATHINFO_FILENAME);
            $extension = pathinfo($fullImagename, PATHINFO_EXTENSION);
            $filePath = $imagename . '_' . time() . '.' . $extension;
            $allowedfileExtension = ['csv', 'txt', 'docx', 'xlx', 'xls', 'pdf'];
            $check = in_array($extension, $allowedfileExtension);
            if ($check) {
                $file->move(public_path('/files'), $filePath);
            }
        }
        $postdate = new Post();

        if ($request->method() == 'POST') {
            $postID = DB::table('posts')->latest('id')->first();
            $id = ++$postID->id;
            $subcatID = $request->input('subcat_id');
            if (empty($subcatID)) {
                $postmeta = new Postmeta();
                $postmeta->post_id = $id;
                $postmeta->cat_id = 1;
                $postmeta->save();
            } else {
                foreach ($subcatID as $value) {
                    $postmeta = new Postmeta();
                    $postmeta->post_id = $id;
                    $postmeta->cat_id = $value;
                    $postmeta->save();
                }
            }
            //  $datetime = date('Y-m-d H:i:s');
            $postdate->title_en = $request->input('name_en');
            $postdate->name_en = $request->input('name_en');
            $postdate->slug_en = $request->input('slug_en');
            $postdate->content_en = $request->input('content_en');
            $postdate->excerpt_en = $request->input('excerpt_en');


            $postdate->title_bn = $request->input('name_bn');
            $postdate->name_bn = $request->input('name_bn');
            $postdate->slug_bn = $request->input('slug_bn');
            $postdate->content_bn = $request->input('content_bn');
            $postdate->excerpt_bn = $request->input('excerpt_bn');

            $postdate->image = $request->input('image_name');
            if ($check) {
                $postdate->file = $filePath;
            }
            if ($request->hasFile('video')) {
                $file = $request->file('video');
                $fullImagename = $file->getClientOriginalName();
                $imagename = pathinfo($fullImagename, PATHINFO_FILENAME);
                $extension = pathinfo($fullImagename, PATHINFO_EXTENSION);
                $filePath = $imagename . '_' . time() . '.' . $extension;
                $allowedfileExtension = ['mp4'];
                $check = in_array($extension, $allowedfileExtension);
                if ($check) {
                    $path = $file->move(public_path('/files'), $filePath);
                }
                $postdate->video = $filePath;
            } else {
                if (!empty($match[1])) {
                    $youtube_id = $match[1];
                    $postdate->video = $youtube_id;
                }
            }
            $postdate->publish_at = Carbon::createFromFormat('Y-m-d H:i:s', $request->input('publish_at'))->format('Y-m-d H:i:s');

            if ($request->input('publish_at') >= date('Y-m-d H:i:s')) {
                $postdate->status = '0';
            } else {
                $postdate->status = $request->input('status');
            }

            $postdate->privateshow = $request->input('privateshow');
            $postdate->trending = $request->input('trending');
            $postdate->template = $request->input('template');

            $postdate->tag = $request->input('tag');
            $postdate->user_id = $request->input('userId');


            $postdate->save();
        }

        // return redirect()->back();

        return redirect()->route('superAdmin.post')->with('success', 'Post  Added successfully');

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
    public function postedit($id)
    {

        $post = post::find($id);
        // $cat = Category::findOrFail($id);
        $categories = Category::where('parent_id', '')->get();
        $postmeta = Postmeta::where('post_id', $id)->get();


        return view('superAdmin.post.edit', compact('post', 'categories', 'postmeta'));
    }

    public function postupdate($request)
    {

        $url = $request->input('youtubevideo');
        // $url = 'http://www.youtube.com/watch?v=C4kxS1ksqtw&feature=relate';
        // parse_str(parse_url($url, PHP_URL_QUERY), $my_array_of_vars);
        // echo $my_array_of_vars['v'];

        preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match);


        $postdate = Post::findOrFail($request->id);
        $subcatID = $request->input('subcat_id');
        $unsubcatID = $request->input('uncat_id');
        $hidden_cat = $request->input('hidden_cat');


        if (empty($subcatID)) {
            DB::table('postmetas')->insert([
                'post_id' => $postdate->id,
                'cat_id' => $hidden_cat,
            ]);
        } else {
            if (isset($subcatID) && isset($unsubcatID)) {
                $results = array_diff($unsubcatID, $subcatID);
                $dbcatID = '';

                foreach ($unsubcatID as $uncheck) {
                    foreach ($subcatID as $value) {
                        $dbcatID = $value;
                        //    print_r($dbcatID);
                        $metaID = DB::table('postmetas')
                            ->where('post_id', $postdate->id)
                            ->where('cat_id', $dbcatID)

                            ->updateOrInsert(
                                [
                                    'post_id' => $postdate->id,
                                    'cat_id' => $dbcatID,
                                ],
                                [
                                    'post_id' => $postdate->id,
                                    'cat_id' => $dbcatID,
                                    'updated_at' => date('Y-m-d H:i:s')
                                ]
                            );
                    }
                    foreach ($results as $result) {
                        if (($dbcatID != $uncheck) && ($postdate->id)) {
                            Postmeta::withTrashed()->where('post_id', $postdate->id)->forceDelete();
                        }
                    }
                }
            }
            if (!empty($postdate)) {
                foreach ($subcatID as $value) {
                    DB::table('postmetas')->updateOrInsert([
                        'post_id' => $postdate->id,
                        'cat_id' => $value,
                        'updated_at' => date('Y-m-d H:i:s')
                    ]);
                }
            }
        }
        $postdate->title_en = $request->input('name_en');
        $postdate->name_en = $request->input('name_en');
        // $postdate->link_en = $request->input('link');
        $postdate->slug_en = $request->input('slug_en');
        $postdate->content_en = $request->input('content_en');
        $postdate->excerpt_en = $request->input('excerpt_en');


        $postdate->title_bn = $request->input('name_bn');
        $postdate->name_bn = $request->input('name_bn');
        // $postdate->link_bn = $request->input('link');
        $postdate->slug_bn = $request->input('slug_bn');
        $postdate->content_bn = $request->input('content_bn');
        $postdate->excerpt_bn = $request->input('excerpt_bn');

        $postdate->image = $request->input('image_name');
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fullImagename = $file->getClientOriginalName();
            $imagename = pathinfo($fullImagename, PATHINFO_FILENAME);
            $extension = pathinfo($fullImagename, PATHINFO_EXTENSION);
            $filePath = $imagename . '_' . time() . '.' . $extension;
            $allowedfileExtension = ['csv', 'txt', 'docx', 'xlsx', 'pdf', 'ppt'];
            $check = in_array($extension, $allowedfileExtension);
            if ($check) {
                $path = $file->move(public_path('/files'), $filePath);
            }
            $postdate->file = $filePath;
        } else {

            $postdate->file = $request->input('editfilename');
        }
        if ($request->hasFile('video')) {
            $file = $request->file('video');
            $fullImagename = $file->getClientOriginalName();
            $imagename = pathinfo($fullImagename, PATHINFO_FILENAME);
            $extension = pathinfo($fullImagename, PATHINFO_EXTENSION);
            $filePath = $imagename . '_' . time() . '.' . $extension;
            $allowedfileExtension = ['mp4'];
            $check = in_array($extension, $allowedfileExtension);
            if ($check) {
                $path = $file->move(public_path('/files'), $filePath);
            }
            $postdate->video = $filePath;
        } else {
            if (empty($request->hasFile('video'))) {
                $video = $request->input('videoname');
                $extention = pathinfo($video, PATHINFO_EXTENSION);
                if ($extention == 'mp4') {
                    $postdate->video = $video;
                } else {
                    $postdate->video = '';
                }
            }
        }
        if (!empty($match[1])) {
            $youtube_id = $match[1];
            $postdate->video = $youtube_id;
        } else {
            $postdate->video = $request->input('edityoutubevideo');
        }

        // menu update
        $menuitem = DB::table('menuitems')->where('slug_en', '=', $request->input('slug_en'))->Orwhere('slug_bn', '=', $request->input('slug_bn'))->first();
        if (!empty($menuitem)) {
            $menuitemUpdate = Menuitem::findOrFail($menuitem->id);

            $menuitemUpdate->title_en = $request->input('name_en');
            $menuitemUpdate->name_en = $request->input('name_en');
            $menuitemUpdate->slug_en = $request->input('slug_en');

            $menuitemUpdate->title_bn = $request->input('name_bn');
            $menuitemUpdate->name_bn = $request->input('name_bn');
            $menuitemUpdate->slug_bn = $request->input('slug_bn');
            $menuitemUpdate->save();
        }
        // ====================================
        if ($request->input('publish_at') >= date('Y-m-d H:i:s')) {
            $postdate->status = '0';
        } else {
            $postdate->status = $request->input('status');
        }
        $postdate->privateshow = $request->input('privateshow');
        $postdate->slider = $request->input('slider');
        $postdate->trending = $request->input('trending');
        $postdate->template = $request->input('template');
        $postdate->tag = $request->input('tag');
        $postdate->user_id = $request->input('userId');
        // $postdate->publish_at = Carbon::createFromFormat('Y-m-d H:i:s', $request->input('publish_at'))->format('Y-m-d H:i:s');
        $postdate->publish_at = $request->input('publish_at');
        $postdate->save();
        return redirect()->route('superAdmin.post')->with('success', 'Post  Update successfully');
    }

    public function postsearch($request)
    {
        if ($request->ajax()) {
            $output = "";
            $posts = DB::table('posts')
                ->where('name_' . app()->getLocale(), 'LIKE', '%' . $request->search . "%")
                ->orwhere('content_' . app()->getLocale(), 'LIKE', '%' . $request->search . "%")
                ->get();

            $output = '<table table table-hover">';
            $output .= '<thead>' . '<tr>' .
                '<th>' . "Title" . '</th>' .
                '<th>' . "Action" . '</th>' .
                '</tr>' . '</thead>';
            if (count($posts) > 0) {
                foreach ($posts as $key => $post) {
                    $output .= '<tr>' .
                        '<td>' . $post->{'name_' . app()->getLocale()} . '</td>' .
                        '<td>
                                    <a href=' . route('superAdmin.post.edit', $post->id) . ' class=" btn btn-sm btn-primary"><i
                                                    class="fa fa-pencil-square" aria-hidden="true"></i> </a>';
                    $output .= '<a href=' . route('superAdmin.post.show', $post->id) . ' class="btn btn-sm  btn-success"><i class="fa fa-eye"
                                                    aria-hidden="true"></i></a>';

                    if ($post->status == 1) {
                        $output .= '<a href=' . route('superAdmin.post.publish', $post->id) . ' class="btn btn-sm btn-info"><i class="fa fa-arrow-circle-up"
                                                        aria-hidden="true"></i> </a>';
                    } else {
                        $output .= '<a href=' . route('superAdmin.post.unpublish', $post->id) . ' class="btn btn-sm btn-warning"> <i class="fa fa-arrow-circle-down " aria-hidden="true"></i> </a>';
                    }
                    $output .= '<a href=' . route('superAdmin.post.delete', $post->id) . ' class="btn btn-sm  btn-danger"><i class="fa fa-trash"
                                                    aria-hidden="true"></i> </a>';
                    $output .= '</td></tr>';
                }

            } else {
                $output .= '<tr>' .
                    '<td colspan="2">' . "No Data Found" . '</td>' .
                    '</tr>';
            }
            $output .= '</table>';
            return Response($output);
        }

    }

    public function postslugsearch($request)
    {
        if ($request->ajax()) {
            $output = "";
            $posts = DB::table('posts')
                ->where('name_' . app()->getLocale(), $request->slugsearch)
                ->orderBy('id', 'DESC')
                ->first();

            $output = $posts->{'slug_' . app()->getLocale()};

            $data = array(
                'slug_en' => $output,
            );

            // echo json_encode($output); // display for output
            return Response($output);


            // return Response::json($output);
        }

    }

    public function postdestroy($id)
    {
        $destroyID = Post::findOrFail($id);
        if ($destroyID->id) {
            Postmeta::where('post_id', $destroyID->id)->delete();
        }
        $destroyID->delete();
        return redirect()->route('superAdmin.post');
    }

    public function postpublish($id)
    {

        $publish = Post::find($id);
        $publish->status = 0;
        $publish->save();
        return redirect()->route('superAdmin.post');
    }
    public function postunpublish($id)
    {

        $unpublish = Post::find($id);
        $unpublish->status = 1;
        $unpublish->save();
        return redirect()->route('superAdmin.post');
    }

    public function postmultipledelete($request)
    {
        $multiIds = $request->id;
        foreach ($multiIds as $multiId) {
            Post::where('id', $multiId)->delete();
            Postmeta::where('post_id', $multiId)->delete();
        }
        return redirect()->route('superAdmin.post')->with('success', 'Post  Deleted successfully');
    }


    // public function postName($post){
    //        $post=DB::table('posts')
    //        ->where('slug',$post)
    //        ->get();
    //        $post = $post[0];
    //     return view('superAdmin.post.single-post', compact('post'));


    // }
    // ================================

    public function postupload($request)
    {
        $userName = Auth::user()->name;
        if ($request->file('file')) {
            $file = $request->file('file');
            $fullImagename = $file->getClientOriginalName();
            $imagename = pathinfo($fullImagename, PATHINFO_FILENAME);
            $extension = pathinfo($fullImagename, PATHINFO_EXTENSION);
            $filePath = $imagename . '_' . time() . '.' . $extension;
            $allowedfileExtension = ['png', 'jpg', 'gif', 'bmp', 'jpeg'];
            $check = in_array($extension, $allowedfileExtension);
            if ($check) {
                $imgFile = Image::make($file->getRealPath());
                $imagepath = public_path('/images');
                $imgFile->resize(450, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($imagepath . '/' . $filePath);

                $imagesPath = public_path('/thumbnail');
                $imgFile->resize(100, 80)->save($imagesPath . '/' . $filePath);

                $singleImagesPath = public_path('/singleimg');
                $imgFile->resize(750, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($singleImagesPath . '/' . $filePath);

                $destinationPath = public_path('/upload');
                $path = $file->move($destinationPath, $filePath);
            } else {
                $path = $file->move(public_path('/files'), $filePath);
            }
        }
        $imageUpload = new ImageUpload;
        $imageUpload->name = $filePath;
        $imageUpload->title = $imagename;
        $imageUpload->alt = $imagename;
        $imageUpload->path = $filePath;
        $imageUpload->slug = $filePath;
        $imageUpload->status = '1';
        $imageUpload->username = $userName;
        $imageUpload->extention = '.' . $extension;
        $imageUpload->save();
        return response()->json(['success' => $imageUpload], 201);
    }
    public function postsfetch($request)
    {
        $images = DB::table('image_uploads')->orderBy('id', 'DESC')->get();
        $output = '<div class="file-manager-content">';
        $output .= '<div id="image_file_upload_response">';
        foreach ($images as $image) {
            $output .= '<div class="col-file-manager" id="img_col_id_' . $image->id . '">';
            $output .= '<div class="file-box"  data-file-caption="' . $image->caption . '" data-file-description="' . $image->description . '" data-file-alt="' . $image->alt . '" data-file-title="' . $image->title . '" data-file-name="' . $image->name . '"  data-file-id="' . $image->id . '" data-file-path="' . asset('upload/' . $image->name) . '" data-file-path-editor="' . asset('upload/' . $image->name) . '">';
            $fileextention = ['.jpg', '.png', '.bmp', '.gif', '.jpeg'];
            for ($i = 0; $i < count($fileextention); $i++) {
                if ($image->extention == $fileextention[$i]) {
                    $output .= '<div class="image-container">';
                    $output .= '<img src="' . asset('images/' . $image->name) . '" alt="' . $image->alt . '" title="' . $image->title . '" loading="lazy" class="img-responsive">';
                    $name = substr($image->name, 0, 20) . '...';
                    $output .= '<span class="file-name">' . $name . '</span>';
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
    public function postuploaddelete($request)
    {
        $val = $request->name;
        $categoryNames = Post::where('image', $val)->get();
        if (!empty($categoryNames[0]->image)) {
            if (($val == $categoryNames[0]->image)) {
                $msg = '<div class="alert alert-success text-center">This image is already used.</div>';
                $action = "image";
                return response()->json(array('msg' => $msg, 'action' => $action), 200);
            }
        } else {
            ImageUpload::where('name', $val)->delete();
            $lines = ['upload/', 'images/', 'single/', 'thumbnail/'];
            for ($i = 0; $i < count($lines); $i++) {
                $value = $lines[$i];
                $path = public_path($value) . $val;
                if (file_exists($path)) {
                    unlink($path);
                }
            }
            return response()->json(['data' => $val], 200);
        }
    }
    public function postimgsearch($request)
    {
        $images = DB::table('image_uploads')
            ->where('name', 'LIKE', '%' . $request->search . "%")
            ->get();
        foreach ($images as $image):
            echo '<div class="col-file-manager" id="img_col_id_' . $image->id . '">';
            echo '<div class="file-box" data-file-name="' . $image->name . '"  data-file-id="' . $image->id . '" data-file-path="' . asset('upload/' . $image->name) . '" data-file-path-editor="' . asset('upload/' . $image->name) . '">';
            echo '<div class="image-container">';
            echo '<img src="' . asset('images/' . $image->name) . '" alt="" name="file" class="img-responsive">';
            $name = substr($image->name, 0, 20) . '...';
            echo '<span class="file-name">' . $name . '</span>';
            echo '</div>';
            echo '</div> </div>';
        endforeach;
    }
    // =========================================
    public function postarchive()
    {
        $posts = DB::table('posts')->where('deleted_at', '!=', null)->orderBy('id', 'desc')->paginate(15);
        return view('superAdmin.post.archive', compact('posts'));
    }
    public function postarchivereturn($id)
    {
        $destroyID = DB::table('posts')->where('id', $id)->first();
        if ($destroyID->id) {
            Postmeta::where('post_id', $destroyID->id)->restore();
        }
        Post::withTrashed()->find($id)->restore();
        return redirect()->route('superAdmin.post')->with('success', 'Post Reset Succesfully');
    }
    public function postarchivedistroy($id)
    {
        $destroyID = DB::table('posts')->where('id', $id)->first();
        if ($destroyID->id) {
            Postmeta::where('post_id', $destroyID->id)->forceDelete();
        }
        Post::withTrashed()->find($id)->forceDelete();
        return redirect()->back()->with('success', 'Post Deleted Succesfully');
    }

    public function postarchivemultipledelete($id)
    {
        Post::withTrashed()->find($id)->forceDelete();
        return redirect()->back()->with('success', 'Post Deleted Permanently');
    }

    // =======================================

    // ================== Comment =============
    public function commentsindex()
    {
        $comment = DB::table('comments')->where('deleted_at', null)->orderBy('id', 'desc')->paginate(15);
        return view('superAdmin.comment.index', compact('comment'));
    }
    public function commentsview($id)
    {
        $comment = Comment::findOrFail($id);
        return view('superAdmin.comment.show', compact('comment'));
    }
    public function commentspublish($id)
    {
        $publish = Comment::find($id);
        $publish->status = 0;
        $publish->save();
        return redirect()->back()->with('success', 'Comment Unpublish Succesfully');
    }
    public function commentsunpublish($id)
    {
        $unpublish = Comment::find($id);
        $unpublish->status = 1;
        $unpublish->save();
        return redirect()->back()->with('success', 'Comment Published Succesfully');
    }
    public function commentarchive()
    {
        $comment = Comment::onlyTrashed()->paginate(15);
        return view('superAdmin.comment.archivecomment', compact('comment'));
    }
    public function commentreturn($id)
    {
        Comment::withTrashed()->find($id)->restore();
        return redirect()->route('superAdmin.comments')->with('success', 'Comment Reset Succesfully');
    }
    public function commentdistroy($id)
    {
        Comment::find($id)->delete();
        return redirect()->back()->with('success', 'Comment Deleted Succesfully');
    }
    public function commentsstore($request)
    {
        $comment = new Comment();
        if (empty(auth()->user()->id)) {
            $comment->user_id = '0';
        } else {
            $comment->user_id = auth()->user()->id;
        }
        if (empty($request->get('parent_id'))) {
            $comment->parent_id = null;
        } else {
            $comment->parent_id = $request->get('parent_id');
        }
        $comment->post_id = $request->get('post_id');
        $comment->comment_body = $request->get('comment_body');
        $comment->commentname = $request->get('commentname');
        $comment->commentemail = $request->get('commentemail');
        $comment->save();

        return redirect()->back();


    }
    public function replyStore($request)
    {
        $reply = new Comment();
        $reply->comment_body = $request->get('comment_body');
        $reply->user()->associate($request->user());
        $reply->parent_id = $request->get('comment_id');
        $post = Post::find($request->get('post_id'));
        $post->comments()->save($reply);
        return back();
    }
    public function softdelete($id)
    {
        Comment::find($id)->delete();
        return redirect()->back()->with('success', 'Comment Deleted Succesfully');
    }
    public function commentdelete($id)
    {
        Comment::withTrashed()->find($id)->forceDelete();
        return redirect()->back()->with('success', 'Comment Deleted Permanently');
    }
    public function commentmultipledelete($request)
    {
        if ($request->isMethod('POST')) {
            $multiIds = $request->id;
            if (empty($multiIds)) {
                return redirect()->back()->with('error', 'Please selct checkbox');
            } else {
                foreach ($multiIds as $multiId) {
                    Comment::withTrashed()->find($multiId)->forceDelete();
                }
            }
            return redirect()->back()->with('success', 'Comment Deleted Succesfully');

        }
    }

}
