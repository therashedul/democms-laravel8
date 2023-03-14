<?php

use Illuminate\Support\Facades\Route;

use App\Notifications\MyFirstNotification;
use Illuminate\Support\Facades\Notification;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| User Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(['prefix' => 'user', 'as' => 'user.','middleware' => ['auth','user','priventBackHistory']], function() {
    Route::get('/', [App\Http\Controllers\UserController::class, 'index']);
    // Users
    Route::get('users', [App\Http\Controllers\UserController::class, 'users'])->name('users');
    Route::get('users.create',  [App\Http\Controllers\UserController::class, 'usercreate'])->name('users.create');
    Route::post('users.store', [App\Http\Controllers\UserController::class, 'userstore'])->name('users.store');
    Route::get('users.show.{id}', [App\Http\Controllers\UserController::class, 'usershow'])->name('users.show');
    Route::get('users.edit.{id}', [App\Http\Controllers\UserController::class, 'useredit'])->name('users.edit');
    Route::get('users.publish.{id}', [App\Http\Controllers\UserController::class, 'userpublish'])->name('users.publish');
    Route::get('users.unpublish.{id}', [App\Http\Controllers\UserController::class, 'userunpublish'])->name('users.unpublish');
    Route::patch('users.update.{id}', [App\Http\Controllers\UserController::class, 'userupdate'])->name('users.update');
    Route::delete('/users.destroy.{id}', [App\Http\Controllers\UserController::class, 'userdestroy'])->name('users.destroy');

    Route::post('/users.upload', [App\Http\Controllers\UserController::class, 'usersupload'])->name('users.upload');    
    Route::get('/users.fetch', [App\Http\Controllers\UserController::class, 'usersfetch'])->name('users.fetch');
    Route::get('/users.delete', [App\Http\Controllers\UserController::class, 'usersuploaddelete'])->name('users.delete');
    Route::post('/users.search', [App\Http\Controllers\UserController::class, 'userssearch'])->name('users.search'); 
    
    // Admin role
     Route::get('/roles', [App\Http\Controllers\UserController::class, 'roles'])->name('roles');
    Route::get('/roles.create', [App\Http\Controllers\UserController::class, 'rolecreate'])->name('roles.create');
    Route::post('/roles.store', [App\Http\Controllers\UserController::class, 'rolestore'])->name('roles.store');
    Route::get('/roles.show.{id}', [App\Http\Controllers\UserController::class, 'roleshow'])->name('roles.show');
    Route::get('/roles.edit.{id}', [App\Http\Controllers\UserController::class, 'roleedit'])->name('roles.edit');
    Route::patch('/roles.update.{id}', [App\Http\Controllers\UserController::class, 'roleupdate'])->name('roles.update');
    Route::delete('/roles.destroy.{id}', [App\Http\Controllers\UserController::class, 'roledelete'])->name('roles.destroy');
    
    // Media
    Route::get('/media', [App\Http\Controllers\UserController::class, 'media'])->name('media');
    Route::post('/media.upload', [App\Http\Controllers\UserController::class, 'mediaupload'])->name('media.upload');
    Route::get('/media.fetch', [App\Http\Controllers\UserController::class, 'mediafetch'])->name('media.fetch');
    Route::get('/media.delete', [App\Http\Controllers\UserController::class, 'mediauploaddelete'])->name('media.delete');
    Route::post('/media.search', [App\Http\Controllers\UserController::class, 'mediasearch'])->name('media.search'); 






    // SuperAdmin permission
    Route::get('/permissions', [App\Http\Controllers\UserController::class, 'permissions'])->name('permissions');
    Route::get('/permissions.create', [App\Http\Controllers\UserController::class, 'permissioncreate'])->name('permissions.create');
    Route::post('/permissions.store', [App\Http\Controllers\UserController::class, 'permissionstore'])->name('permissions.store');
    Route::get('/permissions.show.{id}', [App\Http\Controllers\UserController::class, 'permissionshow'])->name('permissions.show');
    Route::get('/permissions.edit.{id}', [App\Http\Controllers\UserController::class, 'permissionedit'])->name('permissions.edit');
    Route::patch('/permissions.update.{id}', [App\Http\Controllers\UserController::class, 'permissionupdate'])->name('permissions.update');
    Route::delete('/permissions.destroy.{id}', [App\Http\Controllers\UserController::class, 'permissiondelete'])->name('permissions.destroy');
    Route::post('/permissions.search', [App\Http\Controllers\UserController::class, 'permissionsearch'])->name('permissons.search');
    Route::get('/permissions.permissiondelete.{id}', [App\Http\Controllers\UserController::class, 'deletepermission'])->name('permissions.permissiondelete');  
});