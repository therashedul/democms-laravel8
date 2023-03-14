<?php

namespace App\Http\Admincruds;

use App\Models\User;
use App\Models\Page;
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

class Pagecrud{

    
    public function pageindex()
    {
        $userID = Auth::id();
        $userData = User::where('id', $userID)->get();
        $pages = Page::where('id', '>=', 1)->orderBy('id', 'desc')->paginate(10);
        //   print_r($pages);
        //         die();

        return view('admin.page.index', compact('pages', 'userData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function pagecreate()
    {

        $user = Auth::user(); // display all information in current user
        // $pages = Page::where('id', '>', 5)->get(); // display all page for parent
        $pages = Page::where('parent_id', 0)->get();

        return view('admin.page.create', compact('user', 'pages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function pagestore($request)
    {
        // print_r($request->all());
        // die();

        $url = $request->input('youtubevideo');
        // $url = 'http://www.youtube.com/watch?v=C4kxS1ksqtw&feature=relate';
        // parse_str(parse_url($url, PHP_URL_QUERY), $my_array_of_vars);
        // echo $my_array_of_vars['v'];

        preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match);

        $pagedata = new Page();
        $pagedata->title_en = $request->input('name_en');
        $pagedata->name_en = $request->input('name_en');
        // $pagedata->link_en = $request->input('link_en');
        $pagedata->slug_en = $request->input('slug_en');
        $pagedata->content_en = $request->input('content_en');


        $pagedata->title_bn = $request->input('name_bn');
        $pagedata->name_bn = $request->input('name_bn');
        // $pagedata->link_bn = $request->input('link_bn');
        $pagedata->slug_bn = $request->input('slug_bn');
        $pagedata->content_bn = $request->input('content_bn');


        $pagedata->parent_id = $request->input('parent_id');
        $pagedata->image = $request->input('image_name');
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
            $pagedata->file = $filePath;
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

            $pagedata->video = $filePath;
        }
        if (!empty($match[1])) {
            $youtube_id = $match[1];
            $pagedata->video = $youtube_id;
        }

        // $pagedata->status = $request->input('status');
         if ($request->input('publish_at') >= date('Y-m-d H:i:s')) {
                $pagedata->status = '0';
            } else {
                $pagedata->status = $request->input('status');
            }
        $pagedata->template = $request->input('template');
        $pagedata->privatepage = $request->input('privatepage');
        $pagedata->user_id = $request->input('userId');
        $pagedata->publish_at = $request->input('publish_at');
        $pagedata->save();
        return redirect()->route('admin.page')->with('success', 'Page  Added successfully');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function pageedit($id)
    {
        $user = Auth::user();
        $pages = Page::where('id', '>=', 1)->get();
        $page = Page::find($id);
        return view('admin.page.edit', compact('page', 'pages', 'user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function pageupdate($request)
    {
        $url = $request->input('youtubevideo');
        // $url = 'http://www.youtube.com/watch?v=C4kxS1ksqtw&feature=relate';
        // parse_str(parse_url($url, PHP_URL_QUERY), $my_array_of_vars);
        // echo $my_array_of_vars['v'];

        preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match);


        $pagedata = Page::find($request->id);
        $pagedata->name_en = $request->input('name_en');
        $pagedata->title_en = $request->input('name_en');
        $pagedata->slug_en = $request->input('slug_en');
        $pagedata->content_en = $request->input('content_en');

        $pagedata->name_bn = $request->input('name_bn');
        $pagedata->title_bn = $request->input('name_bn');
        $pagedata->slug_bn = $request->input('slug_bn');
        $pagedata->content_bn = $request->input('content_bn');

        // $pagedata->link = $request->input('link');

        // $pagedata->status = $request->input('status');
        $pagedata->privatepage = $request->input('privatepage');
        $pagedata->template = $request->input('template');
        $pagedata->parent_id = $request->input('parent_id');
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
            $pagedata->file = $filePath;
        } else {

            $pagedata->file = $request->input('editfilename');
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
            $pagedata->video = $filePath;
        } else {
            if (empty($request->hasFile('video'))) {
                $video = $request->input('videoname');
                $extention = pathinfo($video, PATHINFO_EXTENSION);
                if ($extention == 'mp4') {
                    $pagedata->video = $video;
                } else {
                    $pagedata->video = '';
                }
            }
        }
        if (!empty($match[1])) {
            $youtube_id = $match[1];
            $pagedata->video = $youtube_id;
        } else {
            $pagedata->video = $request->input('edityoutubevideo');
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
        // ================================================
        if ($request->input('publish_at') >= date('Y-m-d H:i:s')) {
            $pagedata->status = '0';
        } else {
            $pagedata->status = $request->input('status');
        }
        $pagedata->image = $request->input('image_name');
        $pagedata->user_id = $request->input('userId');
        $pagedata->publish_at = $request->input('publish_at');
        $pagedata->save();
        return redirect()->route('admin.page')->with('success', 'Page  Update successfully');
    }

    public function pagepublish($id)
    {

        $publish = Page::find($id);
        $publish->status = 0;
        $publish->save();
        return redirect()->back();
    }
    public function pageunpublish($id)
    {

        $unpublish = Page::find($id);
        $unpublish->status = 1;
        $unpublish->save();
        return redirect()->back();
    }


    // =========================================

    public function pagearchived()
    {

        $pages = DB::table('pages')->where('deleted_at', '!=', null)->orderBy('id', 'desc')->paginate(15);
        return view('admin.page.archive', compact('pages'));
    }
    public function pagearchivereturn($id)
    {
        Page::withTrashed()->find($id)->restore();
        return redirect()->route('admin.page')->with('success', 'Page Reset Succesfully');
    }
    public function pagearchivedistroy($id)
    {
        Page::withTrashed()->find($id)->forceDelete();
        return redirect()->back()->with('success', 'Page Deleted Succesfully');
    }

    public function pagearchivemultipledelete($id)
    {
        Page::withTrashed()->find($id)->forceDelete();
        return redirect()->back()->with('success', 'Page Deleted Permanently');
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
    public function pagemultipledelete($request)
    {
        $multiIds = $request->id;
        foreach ($multiIds as $multiId) {
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
    public function pagesearch($request)
    {
        if ($request->ajax()) {
            $output = "";
            $pages = DB::table('pages')
                ->where('name_' . app()->getLocale(), 'LIKE', '%' . $request->search . "%")
                ->orwhere('content_' . app()->getLocale(), 'LIKE', '%' . $request->search . "%")
                ->get();

            $output = '<table table table-hover">';
            $output .= '<thead>' . '<tr>' .
                '<th>' . "Title" . '</th>' .
                '<th>' . "Action" . '</th>' .
                '</tr>' . '</thead>';
            if (count($pages) > 0) {
                foreach ($pages as $key => $page) {
                    $output .= '<tr>' .
                        '<td>' . $page->{'name_' . app()->getLocale()} . '</td>' .
                        '<td> <a href=' . route('admin.page.edit', $page->id) . ' class="btn btn-sm btn-primary"><i
                                                    class="fa fa-pencil-square" aria-hidden="true"></i> </a>';

                    if ($page->status == 1) {
                        $output .= '<a href=' . route('admin.page.publish', $page->id) . ' class="btn btn-sm btn-info"><i class="fa fa-arrow-circle-up"
                                                    aria-hidden="true"></i> </a>';
                    } else {
                        $output .= '<a href=' . route('admin.page.unpublish', $page->id) . ' class="btn btn-sm btn-warning"> <i class="fa fa-arrow-circle-down " aria-hidden="true"></i> </a>';
                    }
                    $output .= '<a href=' . route('admin.page.delete', $page->id) . '  class="btn btn-sm btn-info  btn-danger"><i class="fa fa-trash"
                                            aria-hidden="true"></a>';


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
        return redirect()->back();

    }


    public function pageslugsearch($request)
    {
        if ($request->ajax()) {
            $output = "";
            $posts = DB::table('pages')
                ->where('name_' . app()->getLocale(), $request->slugsearch)
                ->orderBy('id', 'DESC')
                ->first();

            $output = $posts->{'slug_' . app()->getLocale()};

            // $data = array(
            //     'slug_en'  => $output,
            //     );

            // echo json_encode($data); // display for output
            return Response($output);


            // return Response::json($output);
        }

        //  if($request->ajax()) {
        //         $output="";
        //         $pages=DB::table('pages')
        //         ->where('title',  $request->slugsearch)
        //         ->first();

        //         $output = $pages->name;
        //         if (count($pages)>0) {
        //                 foreach ($pages as $key => $page) {
        //                       $output.=$page->name;
        //                 }

        //             }else{
        //                   $output.='No date here';
        //             }
        //        return Response($output);
        // }

    }
}