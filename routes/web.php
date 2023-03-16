<?php
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use App\Models\Systemsetting;
use App\Http\Controllers\HitlogController;
// try  catch
use App\Services\PayUService\Exception;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
        try{
                if (Systemsetting::count()=='') {
                    $hitlog  = new HitlogController;      
                    $hitlog->sitehit();
                    return view('welcome');
                } else {
                    $hitlog  = new HitlogController;      
                    $hitlog->sitehit();
                    return view('welcome');
                }               
        }
        catch (\Exception $e){
                return view('env');
        }
        catch(\Error $e){
                return view('env');
        }
});

// Route::get('env', [App\Http\Controllers\DisplayController::class, 'index'])->name('env');
Route::post('envindex', [App\Http\Controllers\DisplayController::class, 'evnindex'])->name('envindex');
Route::get('install', [App\Http\Controllers\DisplayController::class, 'installmigrate'])->name('install');
Route::get('app/systemInt', [App\Http\Controllers\DisplayController::class, 'appsystemInt'])->name('app.systemInt');
Route::get('artisan', [App\Http\Controllers\DisplayController::class, 'artisancommand'])->name('artisan');

Route::get('sitemap.xml', [App\Http\Controllers\DisplayController::class, 'sitemapxml'])->name('sitemap.xml');
Route::get('sitemap.xml/category', [App\Http\Controllers\DisplayController::class, 'sitemapxmlcategory'])->name('sitemap.xml/category');

Route::get('/contact-form', [App\Http\Controllers\DisplayController::class, 'contactForm'])->name('contact-form');
Route::post('/contact-form', [App\Http\Controllers\DisplayController::class, 'storeContactForm'])->name('contact-form.store');



// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/', [App\Http\Controllers\HitlogController::class, 'index'])->name('index');

// Route::get('/time', [App\Http\Controllers\HitlogController::class, 'timespent'])->name('time');
// Route::get('/users', [App\Http\Controllers\LoginHistoriController::class, 'index'])->name('home');

// route check
//    Route::get('page.hrm', function () {
//               dd('EXAMPLE');
//           })->name('page.hrm');
//   =================


Route::get('login', [App\Http\Controllers\CustomAuthController::class, 'index'])->name('login');
Route::get('home', [App\Http\Controllers\CustomAuthController::class, 'customHome'])->name('home');
Route::post('custom-login', [App\Http\Controllers\CustomAuthController::class, 'customLogin'])->name('login.custom');

Route::get('registration', [App\Http\Controllers\CustomAuthController::class, 'registration'])->name('register-user');
Route::post('custom-registration', [App\Http\Controllers\CustomAuthController::class, 'customRegistration'])->name('register.custom');
Route::post('verificationresend/{id}', [App\Http\Controllers\CustomAuthController::class, 'verificationResend'])->name('verification.resend');
Route::get('signout', [App\Http\Controllers\CustomAuthController::class, 'signOut'])->name('signout');

/* New Added Routes */
Route::get('dashboard', [App\Http\Controllers\CustomAuthController::class, 'dashboard'])->middleware(['auth', 'is_verify_email']);
Route::get('account/verify/{token}', [App\Http\Controllers\CustomAuthController::class, 'verifyAccount'])->name('user.verify');

// Site dispaly
Route::get('post.single/{slug}/{id}', [App\Http\Controllers\DisplayController::class, 'postsingle'])->name('post.single');
Route::get('page.single/{slug}/{id}', [App\Http\Controllers\DisplayController::class, 'pagesingle'])->name('page.single');
Route::get('category.single/{slug}', [App\Http\Controllers\DisplayController::class, 'categorysingle'])->name('category.single');
Route::get('ajax-check/{data}', [App\Http\Controllers\DisplayController::class, 'ajaxcheck']);

Route::post('/submail', [App\Http\Controllers\DisplayController::class, 'submail'])->name('submail');
Route::get('/firstindex', [App\Http\Controllers\DisplayController::class, 'firstindex'])->name('firstindex');
Route::get('/databasebackup', [App\Http\Controllers\DisplayController::class, 'databasebackup'])->name('databasebackup');
// comments
Route::get('/comments', [App\Http\Controllers\DisplayController::class, 'commentsindex'])->name('comments');
Route::get('comments.view/{id}', [App\Http\Controllers\DisplayController::class, 'commentsview'])->name('comments.view');
Route::get('comments.publish/{id}', [App\Http\Controllers\DisplayController::class, 'commentspublish'])->name('comments.publish');
Route::get('comments.unpublish/{id}', [App\Http\Controllers\DisplayController::class, 'commentsunpublish'])->name('comments.unpublish');
Route::post('/comments.store', [App\Http\Controllers\DisplayController::class, 'commentsstore'])->name('comments.store');
Route::post('reply.add', [App\Http\Controllers\DisplayController::class, 'replyStore'])->name('reply.add');
Route::get('comment.return/{id}', [App\Http\Controllers\DisplayController::class, 'commentreturn'])->name('comment.return');
Route::get('comment.archive', [App\Http\Controllers\DisplayController::class, 'commentarchive'])->name('comment.archive');
Route::get('soft.delete/{id}', [App\Http\Controllers\DisplayController::class, 'softdelete'])->name('soft.delete');
Route::get('comment.delete/{id}', [App\Http\Controllers\DisplayController::class, 'commentdelete'])->name('comment.delete');
Route::get('comments.distroy/{id}', [App\Http\Controllers\DisplayController::class, 'commentdistroy'])->name('comments.distroy');
Route::post('comment.multipledelete', [App\Http\Controllers\DisplayController::class, 'commentmultipledelete'])->name('comment.multipledelete');

// One whitelist
Route::get('white', [App\Http\Controllers\DisplayController::class, 'white'])->name('white');
Route::get('white.create', [App\Http\Controllers\DisplayController::class, 'whitecreate'])->name('white.create');
Route::post('white.store', [App\Http\Controllers\DisplayController::class, 'whitestore'])->name('white.store');
// Route::get('white.edit.{id}', [App\Http\Controllers\DisplayController::class, 'whiteedit'])->name('white.edit');
// Route::post('white.update', [App\Http\Controllers\DisplayController::class, 'whiteupdate'])->name('white.update');

Auth::routes();

// Auth::routes(['verify'=> true]);
// Route::post('custom-registration', [App\Http\Controllers\CustomAuthController::class, 'customRegistration'])->name('register.custom');
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// for email verify

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware(['auth', 'verified']);

Route::get('/dbname', function () {
    return DB::getDatabaseName();
});
Route::get('/refresh', function () {
    Artisan::call('migrate:refresh');
    return "refresh done";
});
Route::get('/mysql', function () {
    Artisan::call('mysql:createdb schema_name1');
    return "Database created";
});
Route::get('/backup', function () {
    Artisan::call(' database:backup'); //  protected $signature = 'database:backup'; (app>console>commend)
    return "Database backup done";
});
Route::get('/seed', function () {
    Artisan::call('db:seed');
    // or
    // Artisan::call('db:seed', array('--class' => 'YourSeederClass'));
    return "seed done";
});

Route::get('/migrate', function () {
    Artisan::call('migrate', ['--force' => true]);
    return "migrate done";
});
Route::get('/passport', function () {
    \Artisan::call('passport:install');
    return "passport Done";
});
Route::get('/key', function () {
    \Artisan::call('key:generate');
    return "key generated";
});
Route::get('/session', function () {
    \Artisan::call('session:table');
    return "session done";
});
Route::get('/clear', function () {
    \Artisan::call('config:clear');
    \Artisan::call('route:clear');
    \Artisan::call('view:clear');
    \Artisan::call('event:clear');
    \Artisan::call('cache:clear');
    \Artisan::call('optimize:clear');
    return \redirect()->back();
});