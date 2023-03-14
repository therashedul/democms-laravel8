<?php

use Illuminate\Support\Facades\Route;
use App\Notifications\MyFirstNotification;
use Illuminate\Support\Facades\Notification;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| superAdmin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Super admin block

Route::group(['prefix' => 'superAdmin', 'as' => 'superAdmin.','middleware' => ['auth','superAdmin','priventBackHistory']], function() {
    
    Route::get('/superAdmin', [App\Http\Controllers\SuperAdminController::class, 'index'])->name('index');
    
    // All Custom log
    // Route::get('lang', [App\Http\Controllers\SuperAdminController::class, 'lang'])->name('lang');
    // Route::get('lang/change', [App\Http\Controllers\SuperAdminController::class, 'lang_change'])->name('lang.change');
    Route::get('/notifyread/{id}', [App\Http\Controllers\SuperAdminController::class, 'notifyread']);
    Route::get('/databasebackup', [App\Http\Controllers\SuperAdminController::class, 'databasebackup'])->name('databasebackup');
    Route::get('/loginhistory', [App\Http\Controllers\SuperAdminController::class, 'loginhistory'])->name('loginhistory');
    // Route::post('/submail', [App\Http\Controllers\SuperAdminController::class, 'submail'])->name('submail');

    // Users
    Route::get('users', [App\Http\Controllers\SuperAdminController::class, 'users'])->name('users');
    Route::get('users.create',  [App\Http\Controllers\SuperAdminController::class, 'usercreate'])->name('users.create');
    Route::post('users.store', [App\Http\Controllers\SuperAdminController::class, 'userstore'])->name('users.store');
    Route::get('users.show.{id}', [App\Http\Controllers\SuperAdminController::class, 'usershow'])->name('users.show');
    Route::get('users.edit.{id}', [App\Http\Controllers\SuperAdminController::class, 'useredit'])->name('users.edit');
    Route::get('users.publish.{id}', [App\Http\Controllers\SuperAdminController::class, 'userpublish'])->name('users.publish');
    Route::get('users.unpublish.{id}', [App\Http\Controllers\SuperAdminController::class, 'userunpublish'])->name('users.unpublish');
    Route::patch('users.update.{id}', [App\Http\Controllers\SuperAdminController::class, 'userupdate'])->name('users.update');
    Route::delete('/users.destroy.{id}', [App\Http\Controllers\SuperAdminController::class, 'userdestroy'])->name('users.destroy');

    Route::post('/users.upload', [App\Http\Controllers\SuperAdminController::class, 'usersupload'])->name('users.upload');    
    Route::get('/users.fetch', [App\Http\Controllers\SuperAdminController::class, 'usersfetch'])->name('users.fetch');
    Route::get('/users.delete', [App\Http\Controllers\SuperAdminController::class, 'usersuploaddelete'])->name('users.delete');
    Route::post('/users.search', [App\Http\Controllers\SuperAdminController::class, 'userssearch'])->name('users.search'); 
    
    // Admin role
     Route::get('/roles', [App\Http\Controllers\SuperAdminController::class, 'roles'])->name('roles');
    Route::get('/roles.create', [App\Http\Controllers\SuperAdminController::class, 'rolecreate'])->name('roles.create');
    Route::post('/roles.store', [App\Http\Controllers\SuperAdminController::class, 'rolestore'])->name('roles.store');
    Route::get('/roles.show.{id}', [App\Http\Controllers\SuperAdminController::class, 'roleshow'])->name('roles.show');
    Route::get('/roles.edit.{id}', [App\Http\Controllers\SuperAdminController::class, 'roleedit'])->name('roles.edit');
    Route::patch('/roles.update.{id}', [App\Http\Controllers\SuperAdminController::class, 'roleupdate'])->name('roles.update');
    Route::delete('/roles.destroy.{id}', [App\Http\Controllers\SuperAdminController::class, 'roledelete'])->name('roles.destroy');
    
    // Media
    Route::get('/media', [App\Http\Controllers\SuperAdminController::class, 'media'])->name('media');
    Route::post('/media.upload', [App\Http\Controllers\SuperAdminController::class, 'mediaupload'])->name('media.upload');
    Route::get('/media.fetch', [App\Http\Controllers\SuperAdminController::class, 'mediafetch'])->name('media.fetch');
    Route::get('/media.delete', [App\Http\Controllers\SuperAdminController::class, 'mediauploaddelete'])->name('media.delete');
    Route::post('/media.search', [App\Http\Controllers\SuperAdminController::class, 'mediasearch'])->name('media.search'); 

   // whitelist
	Route::get('/white', [App\Http\Controllers\SuperAdminController::class, 'white'])->name('white');
	Route::get('white.create', [App\Http\Controllers\SuperAdminController::class, 'whitecreate'])->name('white.create');
	Route::post('white.store', [App\Http\Controllers\SuperAdminController::class, 'whitestore'])->name('white.store');
	Route::get('white.edit.{id}', [App\Http\Controllers\SuperAdminController::class, 'whiteedit'])->name('white.edit');
	Route::post('white.update', [App\Http\Controllers\SuperAdminController::class, 'whiteupdate'])->name('white.update');
	Route::get('white.delete.{id}', [App\Http\Controllers\SuperAdminController::class, 'whitedestroy'])->name('white.delete');

    // Black list
	Route::get('/black', [App\Http\Controllers\SuperAdminController::class, 'black'])->name('black');
	Route::get('black.create', [App\Http\Controllers\SuperAdminController::class, 'blackcreate'])->name('black.create');
	Route::post('black.store', [App\Http\Controllers\SuperAdminController::class, 'blackstore'])->name('black.store');
	Route::get('black.edit.{id}', [App\Http\Controllers\SuperAdminController::class, 'blackedit'])->name('black.edit');
	Route::post('black.update', [App\Http\Controllers\SuperAdminController::class, 'blackupdate'])->name('black.update');
	Route::get('black.delete.{id}', [App\Http\Controllers\SuperAdminController::class, 'blackdestroy'])->name('black.delete');

    // Menu
    Route::get('menus/{id?}',[App\Http\Controllers\SuperAdminController::class,'menuindex'])->name('menus');
	Route::post('menus.create',[App\Http\Controllers\SuperAdminController::class,'menustore'])->name('menus.create');	
	Route::post('menus.update-menuitem.{id}',[App\Http\Controllers\SuperAdminController::class,'menuupdateMenuItem'])->name('menus.update-menuitem');
	Route::get('menus.add-categories-to-menu',[App\Http\Controllers\SuperAdminController::class,'menuaddCatToMenu'])->name('menus.add-categories-to-menu');
	Route::get('menus.add-page-to-menu',[App\Http\Controllers\SuperAdminController::class,'menuaddPaseToMenu'])->name('menus.add-page-to-menu');
	Route::get('menus.add-post-to-menu',[App\Http\Controllers\SuperAdminController::class,'menuaddPostToMenu'])->name('menus.add-post-to-menu');
	Route::get('menus.add-custom-link',[App\Http\Controllers\SuperAdminController::class,'menuaddCustomLink'])->name('menus.add-custom-link');	
	// Route::get('menus.save-menu',[App\Http\Controllers\SuperAdminController::class,'menusaveMenu'])->name('menus.save-menu');
	Route::get('menus.update-menu',[App\Http\Controllers\SuperAdminController::class,'menuupdateMenu'])->name('menus.update-menu');	
	Route::get('menus.delete-menuitem.{id}.{key}/{in?}',[App\Http\Controllers\SuperAdminController::class,'menudeleteMenuItem'])->name('menus.delete-menuitem');
	Route::get('menus.delete-menu.{id}',[App\Http\Controllers\SuperAdminController::class,'menudestroy'])->name('menus.delete-menu');	


    // ===========================================
        Route::get('/artical', [App\Http\Controllers\SuperAdminController::class, 'articalindex'])->name('artical');
        Route::get('artical.create', [App\Http\Controllers\SuperAdminController::class, 'articalcreate'])->name('artical.create');
        Route::post('artical.store', [App\Http\Controllers\SuperAdminController::class, 'articalstore'])->name('artical.store');
        Route::get('artical.edit/{id}', [App\Http\Controllers\SuperAdminController::class, 'articaledit'])->name('artical.edit');                
        Route::patch('artical.update.{id}', [App\Http\Controllers\SuperAdminController::class, 'articalupdate'])->name('artical.update');
        Route::get('artical.deleted.{id}', [App\Http\Controllers\SuperAdminController::class, 'articaldelete'])->name('artical.deleted');


    // category
        Route::get('/category', [App\Http\Controllers\SuperAdminController::class, 'categoryindex'])->name('category');
        Route::get('category.create', [App\Http\Controllers\SuperAdminController::class, 'categorycreate'])->name('category.create');
        Route::post('category.store', [App\Http\Controllers\SuperAdminController::class, 'categorystore'])->name('category.store');
        Route::get('category.edit/{id}', [App\Http\Controllers\SuperAdminController::class, 'categoryedit'])->name('category.edit');
                
        Route::patch('category.update.{id}', [App\Http\Controllers\SuperAdminController::class, 'categoryupdate'])->name('category.update');

        Route::get('category.deleted/{id}', [App\Http\Controllers\SuperAdminController::class, 'categorydestroy'])->name('category.deleted');
        Route::get('category.{category}', [App\Http\Controllers\SuperAdminController::class, 'categorycategoryName'])->name('category.categoryName');;
        Route::get('category.publish/{id}', [App\Http\Controllers\SuperAdminController::class, 'categorypublish'])->name('category.publish');
        Route::get('category.unpublish/{id}', [App\Http\Controllers\SuperAdminController::class, 'categoryunpublish'])->name('category.unpublish');

        Route::post('category.upload', [App\Http\Controllers\SuperAdminController::class, 'categoryupload'])->name('category.upload');    
        Route::get('category.fetch', [App\Http\Controllers\SuperAdminController::class, 'categoryfetch'])->name('category.fetch');
        Route::get('category.delete', [App\Http\Controllers\SuperAdminController::class, 'categoryuploaddelete'])->name('category.delete');
        Route::post('category.search', [App\Http\Controllers\SuperAdminController::class, 'categoryimagesearch'])->name('category.search'); 

    // post
        Route::get('/post', [App\Http\Controllers\SuperAdminController::class, 'postindex'])->name('post');
        Route::get('post.create', [App\Http\Controllers\SuperAdminController::class, 'postcreate'])->name('post.create');
        Route::post('post.store', [App\Http\Controllers\SuperAdminController::class, 'poststore'])->name('post.store');
        Route::get('post.show/{slug}', [App\Http\Controllers\SuperAdminController::class, 'postshow'])->name('post.show');
        
        Route::get('post.archive', [App\Http\Controllers\SuperAdminController::class, 'postarchive'])->name('post.archive');
        Route::get('post.archivereturn/{id}', [App\Http\Controllers\SuperAdminController::class, 'postarchivereturn'])->name('post.archivereturn');
        Route::get('post.archivedistroy/{id}', [App\Http\Controllers\SuperAdminController::class, 'postarchivedistroy'])->name('post.archivedistroy');
        Route::post('post.archivemultipledelete', [App\Http\Controllers\SuperAdminController::class, 'postarchivemultipledelete'])->name('post.archivemultipledelete');

        Route::get('post.edit/{id}', [App\Http\Controllers\SuperAdminController::class, 'postedit'])->name('post.edit');
        Route::post('post.update', [App\Http\Controllers\SuperAdminController::class, 'postupdate'])->name('post.update');
        Route::get('post.delete/{id}', [App\Http\Controllers\SuperAdminController::class, 'postdestroy'])->name('post.delete');
        Route::get('post.publish/{id}', [App\Http\Controllers\SuperAdminController::class, 'postpublish'])->name('post.publish');
        Route::get('post.unpublish/{id}', [App\Http\Controllers\SuperAdminController::class, 'postunpublish'])->name('post.unpublish');
        Route::post('post.multipledelete', [App\Http\Controllers\SuperAdminController::class, 'postmultipledelete'])->name('post.multipledelete');
        Route::get('post.search', [App\Http\Controllers\SuperAdminController::class, 'postsearch'])->name('post.search'); 
        
        // Route::get('page.search', [App\Http\Controllers\SuperAdminController::class, 'pagesearch'])->name('page.search');

        Route::get('post.slugsearch', [App\Http\Controllers\SuperAdminController::class, 'postslugsearch'])->name('post.slugsearch');
        Route::get('post.{post}', [App\Http\Controllers\SuperAdminController::class, 'postpostName'])->name('posts.postpostName');;
        
        Route::post('/post.upload', [App\Http\Controllers\SuperAdminController::class, 'postupload'])->name('post.upload');    
        Route::get('/posts.fetch', [App\Http\Controllers\SuperAdminController::class, 'postsfetch'])->name('posts.fetch');
        Route::get('/posts.deleted', [App\Http\Controllers\SuperAdminController::class, 'postuploaddelete'])->name('posts.deleted');
        Route::post('/posts.imgsearch', [App\Http\Controllers\SuperAdminController::class, 'postimgsearch'])->name('posts.imgsearch'); 
        
    

        // comments
        Route::get('/comments', [App\Http\Controllers\SuperAdminController::class, 'commentsindex'])->name('comments');            
        Route::get('comments.view/{id}', [App\Http\Controllers\SuperAdminController::class, 'commentsview'])->name('comments.view');
        Route::get('comments.publish/{id}', [App\Http\Controllers\SuperAdminController::class, 'commentspublish'])->name('comments.publish');
        Route::get('comments.unpublish/{id}', [App\Http\Controllers\SuperAdminController::class, 'commentsunpublish'])->name('comments.unpublish');
        Route::post('/comments.store', [App\Http\Controllers\SuperAdminController::class, 'commentsstore'])->name('comments.store');            
        Route::post('reply.add', [App\Http\Controllers\SuperAdminController::class, 'replyStore'])->name('reply.add');        
        Route::get('comment.return/{id}', [App\Http\Controllers\SuperAdminController::class, 'commentreturn'])->name('comment.return');
        Route::get('comment.archive', [App\Http\Controllers\SuperAdminController::class, 'commentarchive'])->name('comment.archive');
        Route::get('soft.delete/{id}', [App\Http\Controllers\SuperAdminController::class, 'softdelete'])->name('soft.delete');
        Route::get('comment.delete/{id}', [App\Http\Controllers\SuperAdminController::class, 'commentdelete'])->name('comment.delete');
        Route::get('comments.distroy/{id}', [App\Http\Controllers\SuperAdminController::class, 'commentdistroy'])->name('comments.distroy');
        Route::post('comment.multipledelete', [App\Http\Controllers\SuperAdminController::class, 'commentmultipledelete'])->name('comment.multipledelete');

  
        
    // page
        Route::get('page', [App\Http\Controllers\SuperAdminController::class, 'pageindex'])->name('page');
        Route::get('page.create', [App\Http\Controllers\SuperAdminController::class, 'pagecreate'])->name('page.create');
        Route::post('page.store', [App\Http\Controllers\SuperAdminController::class, 'pagestore'])->name('page.store');
        
        Route::get('page.edit/{id}', [App\Http\Controllers\SuperAdminController::class, 'pageedit'])->name('page.edit');
        Route::post('page.update', [App\Http\Controllers\SuperAdminController::class, 'pageupdate'])->name('page.update');
        Route::get('page.publish/{id}', [App\Http\Controllers\SuperAdminController::class, 'pagepublish'])->name('page.publish');
        Route::get('page.unpublish/{id}', [App\Http\Controllers\SuperAdminController::class, 'pageunpublish'])->name('page.unpublish');
        Route::get('page.delete/{id}', [App\Http\Controllers\SuperAdminController::class, 'pagedestroy'])->name('page.delete');;
        Route::post('page.multipledelete', [App\Http\Controllers\SuperAdminController::class, 'pagemultipledelete'])->name('page.multipledelete');
        Route::get('page.search', [App\Http\Controllers\SuperAdminController::class, 'pagesearch'])->name('page.search');
        Route::get('page.slugsearch', [App\Http\Controllers\SuperAdminController::class, 'pageslugsearch'])->name('page.slugsearch');
     
        
        Route::get('page.archived', [App\Http\Controllers\SuperAdminController::class, 'pagearchived'])->name('page.archived');
        Route::get('page.archivereturn/{id}', [App\Http\Controllers\SuperAdminController::class, 'pagearchivereturn'])->name('page.archivereturn');
        Route::get('page.archivedistroy/{id}', [App\Http\Controllers\SuperAdminController::class, 'pagearchivedistroy'])->name('page.archivedistroy');
        Route::post('page.archivemultipledelete', [App\Http\Controllers\SuperAdminController::class, 'pagearchivemultipledelete'])->name('page.archivemultipledelete');


        //Slider part
        // ===========================================
       Route::get('/slider', [App\Http\Controllers\SuperAdminController::class, 'sliderindex'])->name('slider');
        Route::get('slider.create', [App\Http\Controllers\SuperAdminController::class, 'slidercreate'])->name('slider.create');
        Route::post('slider.store', [App\Http\Controllers\SuperAdminController::class, 'sliderstore'])->name('slider.store');
        Route::get('slider.edit/{id}', [App\Http\Controllers\SuperAdminController::class, 'slideredit'])->name('slider.edit');                
        Route::post('slider.update.{id}', [App\Http\Controllers\SuperAdminController::class, 'sliderupdate'])->name('slider.update');
        Route::get('slider.deleted.{id}', [App\Http\Controllers\SuperAdminController::class, 'sliderdelete'])->name('slider.deleted');
         Route::get('slider.publish/{id}', [App\Http\Controllers\SuperAdminController::class, 'sliderpublish'])->name('slider.publish');
        Route::get('slider.unpublish/{id}', [App\Http\Controllers\SuperAdminController::class, 'sliderunpublish'])->name('slider.unpublish');

        
        Route::get('slider.slugsearch', [App\Http\Controllers\SuperAdminController::class, 'sliderlugsearch'])->name('slider.slugsearch');

        // Route::get('slider.{slider}', [App\Http\Controllers\SuperAdminController::class, 'slidersliderName'])->name('slider.slidersliderName');;
        
        Route::post('/slider.upload', [App\Http\Controllers\SuperAdminController::class, 'sliderupload'])->name('slider.upload');    
        Route::get('/slider.fetch', [App\Http\Controllers\SuperAdminController::class, 'sliderfetch'])->name('slider.fetch');
        Route::get('/slider.distroy', [App\Http\Controllers\SuperAdminController::class, 'slideruploaddelete'])->name('slider.distroy');
        Route::post('/slider.imgsearch', [App\Http\Controllers\SuperAdminController::class, 'sliderimgsearch'])->name('slider.imgsearch'); 

    // All Custom log
       Route::get('/categorylog', [App\Http\Controllers\SuperAdminController::class, 'categorylog']);
    //    Get ip
       Route::post('getip.store', [App\Http\Controllers\SuperAdminController::class, 'getipstore'])->name('getip.store');

       //Import and Export
        Route::get('csv',  [App\Http\Controllers\SuperAdminController::class, 'csvfile'])->name('csv');
        // Route::get('csv.upload',  [App\Http\Controllers\AdminController::class, 'csvupload'])->name('csv.upload');
        Route::get('csv.export',  [App\Http\Controllers\SuperAdminController::class, 'export'])->name('csv.export');
        Route::post('csv.store', [App\Http\Controllers\SuperAdminController::class, 'import'])->name('csv.store');

    // Language chagne
        Route::get('/language', [App\Http\Controllers\SuperAdminController::class, 'languageindex'])->name('language');
        Route::get('language.create', [App\Http\Controllers\SuperAdminController::class, 'languagecreate'])->name('language.create');
        Route::post('language.store', [App\Http\Controllers\SuperAdminController::class, 'languagestore'])->name('language.store');
        Route::get('language.edit/{id}', [App\Http\Controllers\SuperAdminController::class, 'languageedit'])->name('language.edit');
        Route::patch('language.update.{id}', [App\Http\Controllers\SuperAdminController::class, 'languageupdate'])->name('language.update');
        Route::get('language.deleted/{id}', [App\Http\Controllers\SuperAdminController::class, 'languagedestroy'])->name('language.deleted');
    

    // SuperAdmin permission
    Route::get('/permissions', [App\Http\Controllers\SuperAdminController::class, 'permissions'])->name('permissions');
    Route::get('/permissions.create', [App\Http\Controllers\SuperAdminController::class, 'permissioncreate'])->name('permissions.create');
    Route::post('/permissions.store', [App\Http\Controllers\SuperAdminController::class, 'permissionstore'])->name('permissions.store');
    Route::get('/permissions.show.{id}', [App\Http\Controllers\SuperAdminController::class, 'permissionshow'])->name('permissions.show');
    Route::get('/permissions.edit.{id}', [App\Http\Controllers\SuperAdminController::class, 'permissionedit'])->name('permissions.edit');
    Route::patch('/permissions.update.{id}', [App\Http\Controllers\SuperAdminController::class, 'permissionupdate'])->name('permissions.update');
    Route::delete('/permissions.destroy.{id}', [App\Http\Controllers\SuperAdminController::class, 'permissiondelete'])->name('permissions.destroy');
    Route::post('/permissions.search', [App\Http\Controllers\SuperAdminController::class, 'permissionsearch'])->name('permissons.search');
    Route::get('/permissions.permissiondelete.{id}', [App\Http\Controllers\SuperAdminController::class, 'deletepermission'])->name('permissions.permissiondelete');  

});