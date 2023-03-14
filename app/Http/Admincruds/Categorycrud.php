<?php

namespace App\Http\Admincruds;

use App\Models\Category;
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
use App\Models\ImageUpload;

use App\Models\menu;
use App\Models\Menuitem;

class Categorycrud{
 public function categoryindex()
    {
        $categories = Category::where('parent_id', '==', '')->Orwhere('parent_id', '==', '')->paginate(10);
        return view('admin.category.index', compact('categories'));
    }
    public function categoryedit($id)
    {
        $cat = Category::findOrFail($id);
        $categories = Category::all();
        return view('admin.category.edit', compact('cat', 'categories'));
    }
    public function categorystore($request)
    {
        $data = $request->all();
        if ($request->method() == 'POST') {
            Category::create([
                'name_en' => $request->name_en,
                'title_en' => $request->name_en,
                'slug_en' => $request->slug_en,
                'link_bn' => $request->link_en,

                'name_bn' => $request->name_bn,
                'title_bn' => $request->name_bn,
                'slug_bn' => $request->slug_bn,
                'link_bn' => $request->link_bn,

                'parent_id' => $request->parent_id,
                'category_img' => $request->image_name,
                'status' => $request->status,
                'privatecat' => $request->privatecat,
            ]);
        }
        Log::channel('categorylog')->critical('Category Log file', ['data' => $data]);
        return redirect()->route('admin.category')
            ->with('success', 'Category created successfully.');
    }
    public function categoryupdate($request, $id)
    {

        $input = $request->all();
        $input['name_en'] = $request->name_en;
        $input['title_en'] = $request->title_en;
        $input['slug_en'] = $request->slug_en;

        $input['name_bn'] = $request->name_bn;
        $input['title_bn'] = $request->title_bn;
        $input['slug_bn'] = $request->slug_bn;

        $input['parent_id'] = $request->parent_id;
        $input['category_img'] = $request->image_name;
        $input['status'] = $request->status;
        $input['privatecat'] = $request->privatecat;
        $cateogy = Category::find($id);
        $cateogy->update($input);

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
        // ==============================================
        return redirect()->route('admin.category')
            ->with('success', 'Category Updated successfully.');
    }

    public function categorypublish($id)
    {
        $publish = Category::find($id);
        $publish->status = 0;
        $publish->save();
        return redirect()->route('admin.category')->with('success', 'Publish successfully');
    }
    public function categoryunpublish($id)
    {

        $unpublish = Category::find($id);
        $unpublish->status = 1;
        $unpublish->save();
        return redirect()->route('admin.category')->with('success', 'Unpublish successfully');
    }

    public function categorydestroy($id)
    {
        $category = Category::findOrFail($id);
        if (count($category->subcategory)) {
            $subcategories = $category->subcategory;
            foreach ($subcategories as $cat) {
                $cat = Category::findOrFail($cat->id);
                $cat->parent_id = '';
                $cat->save();
            }
        }
        $category->delete();

        return redirect()->route('admin.category')
            ->with('success', 'Category Deleted successfully.');
    }
    public function categoryName($category)
    {
        $categories = DB::table('categories')
            ->where('slug', $category)
            ->get();
        $cat = $categories[0];
        $postmetas = DB::table('postmetas')
            ->where('cat_id', $cat->id)
            ->get();
        $posts = DB::table('posts')
            ->get();
        return view('admin.category.single-cat', compact(['postmetas', 'posts', 'categories']));
    }
    public function categoryupload($request)
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
        return response()->json(['success' => $imageUpload]);
    }
    public function categoryfetch($request)
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
    public function categoryuploaddelete($request)
    {
        $val = $request->name;
        $categoryNames = Category::where('profile_image', $val)->get();
        if (!empty($categoryNames[0]->profile_image)) {
            if (($val == $categoryNames[0]->profile_image)) {
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
    public function categoryimagesearch($request)
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
}