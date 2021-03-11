<?php

use App\Http\Controllers\WebSiteController;
use Illuminate\Support\Facades\Route;

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

Route::prefix('/adminLogin')->group(function () {
    Route::get('/', [App\Http\Controllers\Auth\AdminLoginController::class,'showLoginForm'])->name('admin.auth.login');
   Route::post('', [App\Http\Controllers\Auth\AdminLoginController::class,'login'])->name('admin.auth');
    Route::view('register', [App\Http\Controllers\Auth\AdminLoginController::class,'register'])->name("admin.auth.register");
    Route::view('password/forget', 'cms.auth.forgot_password')->name("admin.auth.forgot_password");
    Route::view('password/recover', 'cms.auth.recover_password')->name("admin.auth.recover_password");
});

Route::prefix('/admin')->middleware(['auth:admin'])->group(function () {
    Route::view('', 'cms.dashboard')->name("cms.dashboard");
    Route::get('logout', [App\Http\Controllers\Auth\AdminLoginController::class,'logout'])->name("admin.logout");
    Route::view('lock', 'cms.auth.lock_screen')->name("admin.auth.lock_screen");
});
Route::prefix('adminView/')->middleware(['auth:admin'])->group(function(){

    Route::get('/',[App\Http\Controllers\AdminController::class,'index'])->name('cms.admin.index');
    Route::put('update/{id}\profile',[App\Http\Controllers\AdminController::class,'updateProfile'])->name('cms.admin.profileEdit');
    Route::put('update/{id}\password',[App\Http\Controllers\AdminController::class,'updatepassword'])->name('cms.admin.passwordEdit');
    Route::get('edit/{id}\password',[App\Http\Controllers\AdminController::class,'editpassword'])->name('profile.password');
    Route::get('show/{id}',[App\Http\Controllers\AdminController::class,'show'])->name('admin.show');
    Route::get('edit/profile/{id}\user',[App\Http\Controllers\AdminController::class,'editProfile'])->name('admin.profileEdit');
    Route::get('create',[App\Http\Controllers\AdminController::class,'create'])->name('admin.create');
    Route::post('store',[App\Http\Controllers\AdminController::class,'store'])->name('admin.store');
    Route::get('{id}',[App\Http\Controllers\AdminController::class,'edit'])->name('admin.edit');
    Route::put('{id}\update',[App\Http\Controllers\AdminController::class,'update'])->name('admin.update');
    Route::get('destroy/{id}\delete',[App\Http\Controllers\AdminController::class,'destroy'])->name('admin.destroy');
    // Route::resource('roles', [App\Http\Controllers\RoleController::class]);
    // Route::resource('permissions', [App\Http\Controllers\PermissionController::class]);



});

Route::prefix('categoryView/')->middleware(['auth:admin'])->group(function(){

    Route::get('/',[App\Http\Controllers\CategoryController::class,'index'])->name('cms.category.index');
    Route::get('create',[App\Http\Controllers\CategoryController::class,'create'])->name('category.create');
    Route::post('ajax/store',[App\Http\Controllers\CategoryController::class,'ajaxStore'])->name('category.ajax.store');
    Route::post('store',[App\Http\Controllers\CategoryController::class,'store'])->name('category.store');
    Route::get('{id}',[App\Http\Controllers\CategoryController::class,'edit'])->name('category.edit');
    Route::put('{id}\update',[App\Http\Controllers\CategoryController::class,'update'])->name('category.update');
    Route::get('destroy/{id}\delete',[App\Http\Controllers\CategoryController::class,'destroy'])->name('category.destroy');



});
Route::prefix('BlogView/')->middleware(['auth:admin'])->group(function(){

    Route::get('/',[App\Http\Controllers\BlogController::class,'index'])->name('cms.blog.index');
    Route::get('create',[App\Http\Controllers\BlogController::class,'create'])->name('blog.create');
    Route::post('store',[App\Http\Controllers\BlogController::class,'store'])->name('blog.store');
    Route::get('{id}',[App\Http\Controllers\BlogController::class,'edit'])->name('blog.edit');
    Route::put('{id}\update',[App\Http\Controllers\BlogController::class,'update'])->name('blog.update');
    Route::get('destroy/{id}\delete',[App\Http\Controllers\BlogController::class,'destroy'])->name('blog.destroy');



});

Route::prefix('/')->group(function(){
    Route::get('',[App\Http\Controllers\WebSiteController::class,'indexBlog'])->name('website.blog.index');
    Route::get('post/{id}',[App\Http\Controllers\WebSiteController::class,'showBlog'])->name('website.blog.post');
    Route::post('store/comment',[App\Http\Controllers\WebSiteController::class,'commentStore'])->name('website.blog.store');
    Route::put('update/{id}\visit',[App\Http\Controllers\WebSiteController::class,'updateVisit'])->name('update.visit');




});


