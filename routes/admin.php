<?php

use Illuminate\Support\Facades\Route;

use App\Notifications\MyFirstNotification;
use Illuminate\Support\Facades\Notification;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(['prefix' => 'admin', 'as' => 'admin.','middleware' => ['auth','admin','priventBackHistory']], function() {
    
    
    Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('index');

        
    
    // All Custom log
    // Route::get('lang', [App\Http\Controllers\AdminController::class, 'lang'])->name('lang');
    // Route::get('lang/change', [App\Http\Controllers\AdminController::class, 'lang_change'])->name('lang.change');
    Route::get('/notifyread/{id}', [App\Http\Controllers\AdminController::class, 'notifyread']);
    Route::get('/databasebackup', [App\Http\Controllers\AdminController::class, 'databasebackup'])->name('databasebackup');
    Route::get('/loginhistory', [App\Http\Controllers\AdminController::class, 'loginhistory'])->name('loginhistory');
    // Route::post('/submail', [App\Http\Controllers\AdminController::class, 'submail'])->name('submail');

    // Users
    Route::get('users', [App\Http\Controllers\AdminController::class, 'users'])->name('users');
    Route::get('users.create',  [App\Http\Controllers\AdminController::class, 'usercreate'])->name('users.create');
    Route::post('users.store', [App\Http\Controllers\AdminController::class, 'userstore'])->name('users.store');
    Route::get('users.show.{id}', [App\Http\Controllers\AdminController::class, 'usershow'])->name('users.show');
    Route::get('users.edit.{id}', [App\Http\Controllers\AdminController::class, 'useredit'])->name('users.edit');
    Route::get('users.publish.{id}', [App\Http\Controllers\AdminController::class, 'userpublish'])->name('users.publish');
    Route::get('users.unpublish.{id}', [App\Http\Controllers\AdminController::class, 'userunpublish'])->name('users.unpublish');
    Route::patch('users.update.{id}', [App\Http\Controllers\AdminController::class, 'userupdate'])->name('users.update');
    Route::delete('/users.destroy.{id}', [App\Http\Controllers\AdminController::class, 'userdestroy'])->name('users.destroy');

    Route::post('/users.upload', [App\Http\Controllers\AdminController::class, 'usersupload'])->name('users.upload');    
    Route::get('/users.fetch', [App\Http\Controllers\AdminController::class, 'usersfetch'])->name('users.fetch');
    Route::get('/users.delete', [App\Http\Controllers\AdminController::class, 'usersuploaddelete'])->name('users.delete');
    Route::post('/users.search', [App\Http\Controllers\AdminController::class, 'userssearch'])->name('users.search'); 
    
    // Admin role
     Route::get('/roles', [App\Http\Controllers\AdminController::class, 'roles'])->name('roles');
    Route::get('/roles.create', [App\Http\Controllers\AdminController::class, 'rolecreate'])->name('roles.create');
    Route::post('/roles.store', [App\Http\Controllers\AdminController::class, 'rolestore'])->name('roles.store');
    Route::get('/roles.show.{id}', [App\Http\Controllers\AdminController::class, 'roleshow'])->name('roles.show');
    Route::get('/roles.edit.{id}', [App\Http\Controllers\AdminController::class, 'roleedit'])->name('roles.edit');
    Route::patch('/roles.update.{id}', [App\Http\Controllers\AdminController::class, 'roleupdate'])->name('roles.update');
    Route::delete('/roles.destroy.{id}', [App\Http\Controllers\AdminController::class, 'roledelete'])->name('roles.destroy');
    
    // Media
    Route::get('/media', [App\Http\Controllers\AdminController::class, 'media'])->name('media');
    Route::post('/media.upload', [App\Http\Controllers\AdminController::class, 'mediaupload'])->name('media.upload');
    Route::get('/media.fetch', [App\Http\Controllers\AdminController::class, 'mediafetch'])->name('media.fetch');
    Route::get('/media.delete', [App\Http\Controllers\AdminController::class, 'mediauploaddelete'])->name('media.delete');
    Route::post('/media.search', [App\Http\Controllers\AdminController::class, 'mediasearch'])->name('media.search'); 

   // whitelist
	Route::get('/white', [App\Http\Controllers\AdminController::class, 'white'])->name('white');
	Route::get('white.create', [App\Http\Controllers\AdminController::class, 'whitecreate'])->name('white.create');
	Route::post('white.store', [App\Http\Controllers\AdminController::class, 'whitestore'])->name('white.store');
	Route::get('white.edit.{id}', [App\Http\Controllers\AdminController::class, 'whiteedit'])->name('white.edit');
	Route::post('white.update', [App\Http\Controllers\AdminController::class, 'whiteupdate'])->name('white.update');
	Route::get('white.delete.{id}', [App\Http\Controllers\AdminController::class, 'whitedestroy'])->name('white.delete');

    // Black list
	Route::get('/black', [App\Http\Controllers\AdminController::class, 'black'])->name('black');
	Route::get('black.create', [App\Http\Controllers\AdminController::class, 'blackcreate'])->name('black.create');
	Route::post('black.store', [App\Http\Controllers\AdminController::class, 'blackstore'])->name('black.store');
	Route::get('black.edit.{id}', [App\Http\Controllers\AdminController::class, 'blackedit'])->name('black.edit');
	Route::post('black.update', [App\Http\Controllers\AdminController::class, 'blackupdate'])->name('black.update');
	Route::get('black.delete.{id}', [App\Http\Controllers\AdminController::class, 'blackdestroy'])->name('black.delete');

    // Menu
    Route::get('menus/{id?}',[App\Http\Controllers\AdminController::class,'menuindex'])->name('menus');
	Route::post('menus.create',[App\Http\Controllers\AdminController::class,'menustore'])->name('menus.create');	
	Route::post('menus.update-menuitem.{id}',[App\Http\Controllers\AdminController::class,'menuupdateMenuItem'])->name('menus.update-menuitem');
	Route::get('menus.add-categories-to-menu',[App\Http\Controllers\AdminController::class,'menuaddCatToMenu'])->name('menus.add-categories-to-menu');
	Route::get('menus.add-page-to-menu',[App\Http\Controllers\AdminController::class,'menuaddPaseToMenu'])->name('menus.add-page-to-menu');
	Route::get('menus.add-post-to-menu',[App\Http\Controllers\AdminController::class,'menuaddPostToMenu'])->name('menus.add-post-to-menu');
	Route::get('menus.add-custom-link',[App\Http\Controllers\AdminController::class,'menuaddCustomLink'])->name('menus.add-custom-link');	
	// Route::get('menus.save-menu',[App\Http\Controllers\AdminController::class,'menusaveMenu'])->name('menus.save-menu');
	Route::get('menus.update-menu',[App\Http\Controllers\AdminController::class,'menuupdateMenu'])->name('menus.update-menu');	
	Route::get('menus.delete-menuitem.{id}.{key}/{in?}',[App\Http\Controllers\AdminController::class,'menudeleteMenuItem'])->name('menus.delete-menuitem');
	Route::get('menus.delete-menu.{id}',[App\Http\Controllers\AdminController::class,'menudestroy'])->name('menus.delete-menu');	


    // ===========================================
        Route::get('/artical', [App\Http\Controllers\AdminController::class, 'articalindex'])->name('artical');
        Route::get('artical.create', [App\Http\Controllers\AdminController::class, 'articalcreate'])->name('artical.create');
        Route::post('artical.store', [App\Http\Controllers\AdminController::class, 'articalstore'])->name('artical.store');
        Route::get('artical.edit/{id}', [App\Http\Controllers\AdminController::class, 'articaledit'])->name('artical.edit');                
        Route::patch('artical.update.{id}', [App\Http\Controllers\AdminController::class, 'articalupdate'])->name('artical.update');
        Route::get('artical.deleted.{id}', [App\Http\Controllers\AdminController::class, 'articaldelete'])->name('artical.deleted');


    // category
        Route::get('/category', [App\Http\Controllers\AdminController::class, 'categoryindex'])->name('category');
        Route::get('category.create', [App\Http\Controllers\AdminController::class, 'categorycreate'])->name('category.create');
        Route::post('category.store', [App\Http\Controllers\AdminController::class, 'categorystore'])->name('category.store');
        Route::get('category.edit/{id}', [App\Http\Controllers\AdminController::class, 'categoryedit'])->name('category.edit');
                
        Route::patch('category.update.{id}', [App\Http\Controllers\AdminController::class, 'categoryupdate'])->name('category.update');

        Route::get('category.deleted/{id}', [App\Http\Controllers\AdminController::class, 'categorydestroy'])->name('category.deleted');
        Route::get('category.{category}', [App\Http\Controllers\AdminController::class, 'categorycategoryName'])->name('category.categoryName');;
        Route::get('category.publish/{id}', [App\Http\Controllers\AdminController::class, 'categorypublish'])->name('category.publish');
        Route::get('category.unpublish/{id}', [App\Http\Controllers\AdminController::class, 'categoryunpublish'])->name('category.unpublish');

        Route::post('category.upload', [App\Http\Controllers\AdminController::class, 'categoryupload'])->name('category.upload');    
        Route::get('category.fetch', [App\Http\Controllers\AdminController::class, 'categoryfetch'])->name('category.fetch');
        Route::get('category.delete', [App\Http\Controllers\AdminController::class, 'categoryuploaddelete'])->name('category.delete');
        Route::post('category.search', [App\Http\Controllers\AdminController::class, 'categoryimagesearch'])->name('category.search'); 

    // post
        Route::get('/post', [App\Http\Controllers\AdminController::class, 'postindex'])->name('post');
        Route::get('post.create', [App\Http\Controllers\AdminController::class, 'postcreate'])->name('post.create');
        Route::post('post.store', [App\Http\Controllers\AdminController::class, 'poststore'])->name('post.store');
        Route::get('post.show/{slug}', [App\Http\Controllers\AdminController::class, 'postshow'])->name('post.show');
        
        Route::get('post.archive', [App\Http\Controllers\AdminController::class, 'postarchive'])->name('post.archive');
        Route::get('post.archivereturn/{id}', [App\Http\Controllers\AdminController::class, 'postarchivereturn'])->name('post.archivereturn');
        Route::get('post.archivedistroy/{id}', [App\Http\Controllers\AdminController::class, 'postarchivedistroy'])->name('post.archivedistroy');
        Route::post('post.archivemultipledelete', [App\Http\Controllers\AdminController::class, 'postarchivemultipledelete'])->name('post.archivemultipledelete');

        Route::get('post.edit/{id}', [App\Http\Controllers\AdminController::class, 'postedit'])->name('post.edit');
        Route::post('post.update', [App\Http\Controllers\AdminController::class, 'postupdate'])->name('post.update');
        Route::get('post.delete/{id}', [App\Http\Controllers\AdminController::class, 'postdestroy'])->name('post.delete');
        Route::get('post.publish/{id}', [App\Http\Controllers\AdminController::class, 'postpublish'])->name('post.publish');
        Route::get('post.unpublish/{id}', [App\Http\Controllers\AdminController::class, 'postunpublish'])->name('post.unpublish');
        Route::post('post.multipledelete', [App\Http\Controllers\AdminController::class, 'postmultipledelete'])->name('post.multipledelete');
        Route::get('post.search', [App\Http\Controllers\AdminController::class, 'postsearch'])->name('post.search'); 
        
        // Route::get('page.search', [App\Http\Controllers\AdminController::class, 'pagesearch'])->name('page.search');

        Route::get('post.slugsearch', [App\Http\Controllers\AdminController::class, 'postslugsearch'])->name('post.slugsearch');
        Route::get('post.{post}', [App\Http\Controllers\AdminController::class, 'postpostName'])->name('posts.postpostName');;
        
        Route::post('/post.upload', [App\Http\Controllers\AdminController::class, 'postupload'])->name('post.upload');    
        Route::get('/posts.fetch', [App\Http\Controllers\AdminController::class, 'postsfetch'])->name('posts.fetch');
        Route::get('/posts.deleted', [App\Http\Controllers\AdminController::class, 'postuploaddelete'])->name('posts.deleted');
        Route::post('/posts.imgsearch', [App\Http\Controllers\AdminController::class, 'postimgsearch'])->name('posts.imgsearch'); 
        
    

        // comments
        Route::get('/comments', [App\Http\Controllers\AdminController::class, 'commentsindex'])->name('comments');            
        Route::get('comments.view/{id}', [App\Http\Controllers\AdminController::class, 'commentsview'])->name('comments.view');
        Route::get('comments.publish/{id}', [App\Http\Controllers\AdminController::class, 'commentspublish'])->name('comments.publish');
        Route::get('comments.unpublish/{id}', [App\Http\Controllers\AdminController::class, 'commentsunpublish'])->name('comments.unpublish');
        Route::post('/comments.store', [App\Http\Controllers\AdminController::class, 'commentsstore'])->name('comments.store');            
        Route::post('reply.add', [App\Http\Controllers\AdminController::class, 'replyStore'])->name('reply.add');        
        Route::get('comment.return/{id}', [App\Http\Controllers\AdminController::class, 'commentreturn'])->name('comment.return');
        Route::get('comment.archive', [App\Http\Controllers\AdminController::class, 'commentarchive'])->name('comment.archive');
        Route::get('soft.delete/{id}', [App\Http\Controllers\AdminController::class, 'softdelete'])->name('soft.delete');
        Route::get('comment.delete/{id}', [App\Http\Controllers\AdminController::class, 'commentdelete'])->name('comment.delete');
        Route::get('comments.distroy/{id}', [App\Http\Controllers\AdminController::class, 'commentdistroy'])->name('comments.distroy');
        Route::post('comment.multipledelete', [App\Http\Controllers\AdminController::class, 'commentmultipledelete'])->name('comment.multipledelete');

  
        
    // page
        Route::get('page', [App\Http\Controllers\AdminController::class, 'pageindex'])->name('page');
        Route::get('page.create', [App\Http\Controllers\AdminController::class, 'pagecreate'])->name('page.create');
        Route::post('page.store', [App\Http\Controllers\AdminController::class, 'pagestore'])->name('page.store');
        
        Route::get('page.edit/{id}', [App\Http\Controllers\AdminController::class, 'pageedit'])->name('page.edit');
        Route::post('page.update', [App\Http\Controllers\AdminController::class, 'pageupdate'])->name('page.update');
        Route::get('page.publish/{id}', [App\Http\Controllers\AdminController::class, 'pagepublish'])->name('page.publish');
        Route::get('page.unpublish/{id}', [App\Http\Controllers\AdminController::class, 'pageunpublish'])->name('page.unpublish');
        Route::get('page.delete/{id}', [App\Http\Controllers\AdminController::class, 'pagedestroy'])->name('page.delete');;
        Route::post('page.multipledelete', [App\Http\Controllers\AdminController::class, 'pagemultipledelete'])->name('page.multipledelete');
        Route::get('page.search', [App\Http\Controllers\AdminController::class, 'pagesearch'])->name('page.search');
        Route::get('page.slugsearch', [App\Http\Controllers\AdminController::class, 'pageslugsearch'])->name('page.slugsearch');
     
        
        Route::get('page.archived', [App\Http\Controllers\AdminController::class, 'pagearchived'])->name('page.archived');
        Route::get('page.archivereturn/{id}', [App\Http\Controllers\AdminController::class, 'pagearchivereturn'])->name('page.archivereturn');
        Route::get('page.archivedistroy/{id}', [App\Http\Controllers\AdminController::class, 'pagearchivedistroy'])->name('page.archivedistroy');
        Route::post('page.archivemultipledelete', [App\Http\Controllers\AdminController::class, 'pagearchivemultipledelete'])->name('page.archivemultipledelete');


        //Slider part
        // ===========================================
       Route::get('/slider', [App\Http\Controllers\AdminController::class, 'sliderindex'])->name('slider');
        Route::get('slider.create', [App\Http\Controllers\AdminController::class, 'slidercreate'])->name('slider.create');
        Route::post('slider.store', [App\Http\Controllers\AdminController::class, 'sliderstore'])->name('slider.store');
        Route::get('slider.edit/{id}', [App\Http\Controllers\AdminController::class, 'slideredit'])->name('slider.edit');                
        Route::post('slider.update.{id}', [App\Http\Controllers\AdminController::class, 'sliderupdate'])->name('slider.update');
        Route::get('slider.deleted.{id}', [App\Http\Controllers\AdminController::class, 'sliderdelete'])->name('slider.deleted');
         Route::get('slider.publish/{id}', [App\Http\Controllers\AdminController::class, 'sliderpublish'])->name('slider.publish');
        Route::get('slider.unpublish/{id}', [App\Http\Controllers\AdminController::class, 'sliderunpublish'])->name('slider.unpublish');

        
        Route::get('slider.slugsearch', [App\Http\Controllers\AdminController::class, 'sliderlugsearch'])->name('slider.slugsearch');

        // Route::get('slider.{slider}', [App\Http\Controllers\AdminController::class, 'slidersliderName'])->name('slider.slidersliderName');;
        
        Route::post('/slider.upload', [App\Http\Controllers\AdminController::class, 'sliderupload'])->name('slider.upload');    
        Route::get('/slider.fetch', [App\Http\Controllers\AdminController::class, 'sliderfetch'])->name('slider.fetch');
        Route::get('/slider.distroy', [App\Http\Controllers\AdminController::class, 'slideruploaddelete'])->name('slider.distroy');
        Route::post('/slider.imgsearch', [App\Http\Controllers\AdminController::class, 'sliderimgsearch'])->name('slider.imgsearch'); 

    // All Custom log
       Route::get('/categorylog', [App\Http\Controllers\AdminController::class, 'categorylog']);
    //    Get ip
       Route::post('getip.store', [App\Http\Controllers\AdminController::class, 'getipstore'])->name('getip.store');

       //Import and Export
        Route::get('csv',  [App\Http\Controllers\AdminController::class, 'csvfile'])->name('csv');
        // Route::get('csv.upload',  [App\Http\Controllers\AdminController::class, 'csvupload'])->name('csv.upload');
        Route::get('csv.export',  [App\Http\Controllers\AdminController::class, 'export'])->name('csv.export');
        Route::post('csv.store', [App\Http\Controllers\AdminController::class, 'import'])->name('csv.store');

    // Language chagne
        Route::get('/language', [App\Http\Controllers\AdminController::class, 'languageindex'])->name('language');
        Route::get('language.create', [App\Http\Controllers\AdminController::class, 'languagecreate'])->name('language.create');
        Route::post('language.store', [App\Http\Controllers\AdminController::class, 'languagestore'])->name('language.store');
        Route::get('language.edit/{id}', [App\Http\Controllers\AdminController::class, 'languageedit'])->name('language.edit');
        Route::patch('language.update.{id}', [App\Http\Controllers\AdminController::class, 'languageupdate'])->name('language.update');
        Route::get('language.deleted/{id}', [App\Http\Controllers\AdminController::class, 'languagedestroy'])->name('language.deleted');
    

    // admin permission
    Route::get('/permissions', [App\Http\Controllers\AdminController::class, 'permissions'])->name('permissions');
    Route::get('/permissions.create', [App\Http\Controllers\AdminController::class, 'permissioncreate'])->name('permissions.create');
    Route::post('/permissions.store', [App\Http\Controllers\AdminController::class, 'permissionstore'])->name('permissions.store');
    Route::get('/permissions.show.{id}', [App\Http\Controllers\AdminController::class, 'permissionshow'])->name('permissions.show');
    Route::get('/permissions.edit.{id}', [App\Http\Controllers\AdminController::class, 'permissionedit'])->name('permissions.edit');
    Route::patch('/permissions.update.{id}', [App\Http\Controllers\AdminController::class, 'permissionupdate'])->name('permissions.update');
    Route::delete('/permissions.destroy.{id}', [App\Http\Controllers\AdminController::class, 'permissiondelete'])->name('permissions.destroy');
    Route::post('/permissions.search', [App\Http\Controllers\AdminController::class, 'permissionsearch'])->name('permissons.search');
    Route::get('/permissions.permissiondelete.{id}', [App\Http\Controllers\AdminController::class, 'deletepermission'])->name('permissions.permissiondelete');  

});