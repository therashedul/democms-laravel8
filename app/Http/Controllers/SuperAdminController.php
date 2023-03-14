<?php
namespace App\Http\Controllers;

// language
use App;
// Event
use App\Events\UserCreated;
use App\Http\Requests\FormDataRequest;
use App\Http\Requests\PostDataRequest;
use App\Http\Servicecruds\Categorycrud;
use App\Http\Servicecruds\Mediacrud;
use App\Http\Servicecruds\Menucrud;
use App\Http\Servicecruds\Pagecrud;
use App\Http\Servicecruds\Postcrud;
use App\Http\Servicecruds\Settingcrud;
use App\Http\Servicecruds\Usercrud;
use App\Models\Category;
use App\Models\ImageUpload;
use App\Models\LangChange;
// try  catch
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\page;

class SuperAdminController extends Controller
{
    private $images, $thumbnail, $singleimg, $upload, $files;

    public function __construct()
    {
        $this->images = public_path('/images');
        $this->thumbnail = public_path('/thumbnail');
        $this->singleimg = public_path('/singleimg');
        $this->upload = public_path('/upload');
        $this->files = public_path('/files');
    }
    public function index()
    {
        // dd("Supper admin  panel");
        return view('superAdmin.index');
    }
    public function notifyread($id)
    {
        $userUnreadNotification = auth()->user()
            ->unreadNotifications
            ->where('id', $id)
            ->first();

        if ($userUnreadNotification) {
            $userUnreadNotification->markAsRead();
            return \redirect()->route('superAdmin.users');
        }
    }
    public function categorylog(Request $request)
    {
        $logfiles = file(storage_path() . '/logs/category.log');
        $collection = [];
        foreach ($logfiles as $logfile) {
            $collection[] = $logfile;
        }
        dd($collection);
    }
    public function submail(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|unique:newsletters,email',
        ]);
        event(new UserCreated($request->input('email')));
        return redirect()->back();

    }
    public function lang_change(Request $request)
    {
        // die($request->lang);
        App::setLocale($request->lang);
        session()->put('lang_code', $request->lang);
        return redirect()->back();
    }
    public function loginhistory()
    {
        $loginhistories = DB::table('loginhistories')->orderBy('id', 'DESC')->paginate(15);
        return view('superAdmin.loginhistory.index', compact('loginhistories'));
    }

    public function databasebackup()
    {
        return (new Settingcrud)->databasebackup();
    }
    // ========================================== Slider

    public function sliderindex()
    {
        return (new Settingcrud)->sliderindex();
    }
    public function slidercreate()
    {
        return (new Settingcrud)->slidercreate();
    }
    public function sliderstore(Request $request)
    {
        return (new Settingcrud)->sliderstore($request);
    }
    public function slideredit($id)
    {
        return (new Settingcrud)->slideredit($id);
    }
    public function sliderpublish($id)
    {
        return (new Settingcrud)->sliderpublish($id);
    }
    public function sliderunpublish($id)
    {
        return (new Settingcrud)->sliderunpublish($id);
    }
    public function sliderupdate(Request $request, $id)
    {
        return (new Settingcrud)->sliderupdate($request, $id);
    }
    public function sliderdelete($id)
    {
        return (new Settingcrud)->sliderdelete($id);
    }
    // ================================

    public function sliderupload(Request $request)
    {
        return (new Settingcrud)->sliderupload($request);
    }
    public function sliderfetch(Request $request)
    {
        return (new Settingcrud)->sliderfetch($request);
    }
    public function slideruploaddelete(Request $request)
    {
        return (new Settingcrud)->slideruploaddelete($request);
    }
    public function sliderimgsearch(Request $request)
    {
        return (new Settingcrud)->sliderimgsearch($request);
    }
    // ===================== Language change

    public function languageindex()
    {
        return (new Settingcrud)->languageindex();
    }
    public function languagecreate()
    {
        $categories = LangChange::get();
        return view('superAdmin.language.create', compact('categories'));
    }
    public function languagestore(Request $request)
    {
        return (new Settingcrud)->languagestore($request);
        // $request->validate([
        //     'name_en' => 'required',
        //     'name_bn' => 'required',
        // ],[
        //     'name_en.required' => 'Name English is must.',
        //     'name_bn.required' => 'Name Bangla is must.',
        // ]);

    }
    public function languageedit($id)
    {
        return (new Settingcrud)->languageedit($id);
    }
    public function languageupdate(Request $request, $id)
    {
        return (new Settingcrud)->languageupdate($request, $id);
    }
    public function languagedestroy($id)
    {
        return (new Settingcrud)->languagedestroy($id);
    }
    // ================== Category part =============

    public function categoryindex()
    {
        return (new Categorycrud)->categoryindex();
        Log::channel('categorylog')->critical('Category Log file', ['data' => $categories]);
    }
    public function categorycreate()
    {
        $categories = Category::where('parent_id', 0)->get();
        return view('superAdmin.category.create', compact('categories'));
    }
    public function categorystore(FormDataRequest $request)
    {
        // $request->validate([
        //     'name_en' => 'required',
        //     'name_bn' => 'required',
        // ],[
        //     'name_en.required' => 'Name English is must.',
        //     'name_bn.required' => 'Name Bangla is must.',
        // ]);
        return (new Categorycrud)->categorystore($request);
    }
    public function categoryedit($id)
    {
        return (new Categorycrud)->categoryedit($id);
    }
    public function categoryupdate(Request $request, $id)
    {
        return (new Categorycrud)->categoryupdate($request, $id);
    }
    public function categorypublish($id)
    {
        return (new Categorycrud)->categorypublish($id);
    }
    public function categoryunpublish($id)
    {
        return (new Categorycrud)->categoryunpublish($id);
    }
    public function categorydestroy($id)
    {
        return (new Categorycrud)->categorydestroy($id);
    }
    public function categoryName($category)
    {
        return (new Categorycrud)->categoryName($category);
    }
    public function categoryupload(Request $request)
    {
        return (new Categorycrud)->categoryupload($request);
    }
    public function categoryfetch(Request $request)
    {
        return (new Categorycrud)->categoryfetch($request);
    }
    public function categoryuploaddelete(Request $request)
    {
        return (new Categorycrud)->categoryuploaddelete($request);
    }
    public function categoryimagesearch(Request $request)
    {
        return (new Categorycrud)->categoryimagesearch($request);
    }

    // ================== Post =============
    public function postindex(Request $request)
    {
        return (new Postcrud)->postindex($request);
    }
    public function postshow($slug)
    {
        return (new Postcrud)->postshow($slug);
    }
    public function postcreate()
    {
        return (new Postcrud)->postcreate();
    }
    public function poststore(Request $request)
    {
        return (new Postcrud)->poststore($request);
    }
    public function postedit($id)
    {
        return (new Postcrud)->postedit($id);
    }
    public function postupdate(Request $request)
    {
        return (new Postcrud)->postupdate($request);
    }
    public function postsearch(Request $request)
    {
        return (new Postcrud)->postsearch($request);
    }
    public function postslugsearch(Request $request)
    {
        return (new Postcrud)->postslugsearch($request);
    }
    public function postdestroy($id)
    {
        return (new Postcrud)->postdestroy($id);
    }
    public function postpublish($id)
    {
        return (new Postcrud)->postpublish($id);
    }
    public function postunpublish($id)
    {
        return (new Postcrud)->postunpublish($id);
    }
    public function postmultipledelete(Request $request)
    {
        return (new Postcrud)->postmultipledelete($request);
    }
    // ================================
    public function postupload(Request $request)
    {
        return (new Postcrud)->postupload($request);
    }
    public function postsfetch(Request $request)
    {
        return (new Postcrud)->postsfetch($request);
    }
    public function postuploaddelete(Request $request)
    {
        return (new Postcrud)->postuploaddelete($request);
    }
    public function postimgsearch(Request $request)
    {
        return (new Postcrud)->postimgsearch($request);
    }
    // =========================================
    public function postarchive()
    {
        return (new Postcrud)->postarchive();
    }
    public function postarchivereturn($id)
    {
        return (new Postcrud)->postarchivereturn($id);
    }
    public function postarchivedistroy($id)
    {
        return (new Postcrud)->postarchivedistroy($id);
    }
    public function postarchivemultipledelete($id)
    {
        return (new Postcrud)->postarchivemultipledelete($id);
    }
    // ================== Comment =============
    public function commentsindex()
    {
        return (new Postcrud)->commentsindex();
    }
    public function commentsview($id)
    {
        return (new Postcrud)->commentsview($id);
    }
    public function commentspublish($id)
    {
        return (new Postcrud)->commentspublish($id);
    }
    public function commentsunpublish($id)
    {
        return (new Postcrud)->commentsunpublish($id);
    }
    public function commentarchive()
    {
        return (new Postcrud)->commentarchive();
    }
    public function commentreturn($id)
    {
        return (new Postcrud)->commentreturn($id);
    }
    public function commentdistroy($id)
    {
        return (new Postcrud)->commentdistroy($id);

    }
    public function commentsstore(Request $request)
    {
        $request->validate([
            'comment_body' => 'required',
        ]);
        return (new Postcrud)->commentsstore($request);
    }
    public function replyStore(Request $request)
    {
        return (new Postcrud)->replyStore($request);
    }
    public function softdelete($id)
    {
        return (new Postcrud)->softdelete($id);
    }
    public function commentdelete($id)
    {
        return (new Postcrud)->commentdelete($id);
    }
    public function commentmultipledelete(Request $request)
    {
        return (new Postcrud)->commentmultipledelete($request);
    }

    // ================== Page =============
    public function pageindex()
    {
        return (new Pagecrud)->pageindex();
    }
    public function pagecreate()
    {
        return (new Pagecrud)->pagecreate();
    }
    public function pagestore(Request $request)
    {
        return (new Pagecrud)->pagestore($request);
    }
    // public function pageshow( $id) {
    //     //
    // }
    public function pageedit($id)
    {
        return (new Pagecrud)->pageedit($id);
    }
    public function pageupdate(Request $request)
    {
        return (new Pagecrud)->pageupdate($request);
    }
    public function pagepublish($id)
    {
        return (new Pagecrud)->pagepublish($id);
    }
    public function pageunpublish($id)
    {
        return (new Pagecrud)->pageunpublish($id);
    }
    // =========================================

    public function pagearchived()
    {
        return (new Pagecrud)->pagearchived();
    }
    public function pagearchivereturn($id)
    {
        return (new Pagecrud)->pagearchivereturn($id);
    }
    public function pagearchivedistroy($id)
    {
        return (new Pagecrud)->pagearchivedistroy($id);
    }
    public function pagearchivemultipledelete($id)
    {
        return (new Pagecrud)->pagearchivemultipledelete($id);
    }
    // =======================================
    public function pagedestroy($id)
    {
        return (new Pagecrud)->pagedestroy($id);
    }
    public function pagemultipledelete(Request $request)
    {
        return (new Pagecrud)->pagemultipledelete($request);
    }
    public function pagesearch(Request $request)
    {
        return (new Pagecrud)->pagesearch($request);
    }
    public function pageslugsearch(Request $request)
    {
        return (new Pagecrud)->pageslugsearch($request);
    }
    // ================== Menu =============
    public function menuindex()
    {
        return (new Menucrud)->menuindex();
    }
    public function menustore(Request $request)
    {
        return (new Menucrud)->menustore($request);
    }
    public function menuaddCatToMenu(Request $request)
    {
        return (new Menucrud)->menuaddCatToMenu($request);
    }
    public function menuaddPostToMenu(Request $request)
    {
        return (new Menucrud)->menuaddPostToMenu($request);
    }
    public function menuaddPaseToMenu(Request $request)
    {
        return (new Menucrud)->menuaddPaseToMenu($request);
    }
    public function menuaddCustomLink(Request $request)
    {
        return (new Menucrud)->menuaddCustomLink($request);
    }
    public function menuupdateMenu(Request $request)
    {
        return (new Menucrud)->menuupdateMenu($request);
    }
    public function menuupdateMenuItem(Request $request)
    {
        return (new Menucrud)->menuupdateMenuItem($request);
    }
    public function menudeleteMenuItem($id, $key, $in = '')
    {
        return (new Menucrud)->menudeleteMenuItem($id, $key, $in = '');
    }
    public function menudestroy(Request $request)
    {
        return (new Menucrud)->menudestroy($request);
    }



    // ================== Ip White listed=============
    public function white()
    {
        return (new Settingcrud)->white();
    }
    public function whitecreate()
    {
        return (new Settingcrud)->whitecreate();
    }
    public function whitestore(Request $request)
    {
        return (new Settingcrud)->whitestore($request);
    }
    public function whiteedit($id)
    {
        return (new Settingcrud)->whiteedit($id);
    }
    public function whiteupdate(Request $request)
    {
        return (new Settingcrud)->whiteupdate($request);
    }
    public function whitedestroy($id)
    {
        return (new Settingcrud)->whitedestroy($id);
    }
    // ============================= Black listed=================
    public function black()
    {
        return (new Settingcrud)->black();
    }
    public function blackcreate()
    {
        return (new Settingcrud)->blackcreate();
    }
    public function blackstore(Request $request)
    {
        return (new Settingcrud)->blackstore($request);
    }
    public function blackedit($id)
    {
        return (new Settingcrud)->blackedit($id);
    }
    public function blackupdate(Request $request)
    {
        return (new Settingcrud)->blackupdate($request);
    }
    public function blackdestroy($id)
    {
        return (new Settingcrud)->blackdestroy($id);
    }

    // ================== User=============
    public function users()
    {
        return (new Usercrud)->users();
    }
    public function usercreate()
    {
        return view('superadmin.users.create');
    }
    public function usersupload(Request $request)
    {
        return (new Usercrud)->usersupload($request);
    }
    public function usersfetch(Request $request)
    {
        return (new Usercrud)->usersfetch($request);
    }
    public function usersuploaddelete(Request $request)
    {
        return (new Usercrud)->usersuploaddelete($request);
    }
    public function userstore(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed',
        ]);
        return (new Usercrud)->userstore($request);
    }
    public function usershow($id)
    {
        return (new Usercrud)->usershow($id);
    }
    public function useredit($id)
    {
        return (new Usercrud)->useredit($id);
    }
    public function userupdate(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'confirmed',
        ]);
        return (new Usercrud)->userupdate($request, $id);
    }
    public function userpublish($id)
    {
        return (new Usercrud)->userpublish($id);
    }
    public function userunpublish($id)
    {
        return (new Usercrud)->userunpublish($id);
    }
    public function userdestroy($id)
    {
        return (new Usercrud)->userdestroy($id);
    }
    public function userssearch(Request $request)
    {
        return (new Usercrud)->userssearch($request);
    }

    // ================== Role=============
    public function roles()
    {
        return (new Settingcrud)->roles();
    }
    public function rolecreate()
    {
        return (new Settingcrud)->rolecreate();
    }
    public function rolestore(Request $request)
    {
        return (new Settingcrud)->rolestore($request);
    }
    public function roleshow($id)
    {
        return (new Settingcrud)->roleshow($id);
    }
    public function roleedit($id)
    {
        return (new Settingcrud)->roleedit($id);
    }
    public function roleupdate(Request $request, $id)
    {
        return (new Settingcrud)->roleupdate($request, $id);
    }
    public function roledelete($id)
    {
        return (new Settingcrud)->roledelete($id);
    }

    // ================== permission=============
    public function permissions()
    {
        return (new Settingcrud)->permissions();
    }
    public function permissioncreate()
    {
        return (new Settingcrud)->permissioncreate();
    }
    public function permissionstore(Request $request)
    {
        return (new Settingcrud)->permissionstore($request);
    }
    public function permissionshow($id)
    {
        return (new Settingcrud)->permissionshow($id);
    }
    public function permissionedit($id)
    {
        return (new Settingcrud)->permissionedit($id);
    }
    public function permissionupdate(Request $request, $id)
    {
        return (new Settingcrud)->permissionupdate($request, $id);
    }
    public function permissiondelete($id)
    {
        return (new Settingcrud)->permissiondelete($id);
    }
    // ============================CSV===============================
    public function csvfile()
    {
        return (new Settingcrud)->csvfile();
    }
    public function export()
    {
        return (new Settingcrud)->export();
    }
    private $rows = [];
    public function import(Request $request)
    {
        return (new Settingcrud)->import($request);
    }

    //============================ Media ===============
    public function media()
    {
        if (!is_dir($this->images) || !is_dir($this->thumbnail) || !is_dir($this->singleimg) || !is_dir($this->upload) || !is_dir($this->files)) {
            mkdir($this->images, 0777);
            mkdir($this->thumbnail, 0777);
            mkdir($this->singleimg, 0777);
            mkdir($this->upload, 0777);
            mkdir($this->files, 0777);
        }
        $data = ImageUpload::orderBy('id', 'desc')->paginate(16);
        return view('superAdmin.media.index', compact('data'));
    }
    public function mediaupload(Request $request)
    {
        return (new Mediacrud)->mediaupload($request);
    }
    public function mediauploaddelete(Request $request)
    {
        return (new Mediacrud)->mediauploaddelete($request);
    }
    public function mediafetch(Request $request)
    {
        return (new Mediacrud)->mediafetch($request);
    }
    public function mediasearch(Request $request)
    {
        return (new Mediacrud)->mediasearch($request);
    }
    // getipcreate
    public function getipstore(Request $request)
    {

        return (new Settingcrud)->getipstore($request);
    }
}
