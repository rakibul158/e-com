<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SectionController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::prefix('admin')->namespace('Admin')->group(function (){
    Route::match(['get','post'],'/',[AdminController::class, 'login'])->name('admin.login');
    Route::group(['middleware'=>['admin']],function (){
        Route::get('/dashboard',[AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/settings',[AdminController::class, 'settings'])->name('admin.settings');
        Route::get('/logout',[AdminController::class, 'logout'])->name('admin.logout');
        Route::post('/check-current-pwd',[AdminController::class, 'checkCurrentPwd'])->name('admin.checkCurrentPwd');
        Route::post('/update-current-pwd',[AdminController::class, 'updateCurrentPwd'])->name('admin.updateCurrentPwd');
        Route::match(['get','post'],'/update-details',[AdminController::class, 'updateDetails'])->name('admin.updateDetails');

        //Sections
        Route::get('/sections',[SectionController::class,'index'])->name('sections.index');
        Route::post('/update-section-status',[SectionController::class,'updateSectionStatus'])->name('update.section.status');

        //Category
        Route::get('/category',[CategoryController::class,'index'])->name('category.index');
        Route::post('/update-category-status',[CategoryController::class,'updateCategoryStatus'])->name('update.category.status');
        Route::match(['get','post'],'/add-edit-category/{id?}',[CategoryController::class,'addEditCategory'])->name('category.add.edit');
        Route::post('/append-category-level',[CategoryController::class,'appendCategoryLevel'])->name('category.level.append');
        Route::get('/delete-category-image/{id}',[CategoryController::class,'deleteCategoryImage'])->name('category.image.delete');
        Route::get('/delete-category/{id}',[CategoryController::class,'deleteCategory'])->name('category.delete');


        // Products
        Route::get('/products',[ProductController::class,'index'])->name('product');
        Route::post('/update-product-status',[ProductController::class,'updateProductStatus'])->name('update.product.status');
        Route::get('/delete-product/{id}',[ProductController::class,'deleteProduct'])->name('product.delete');
        Route::match(['get','post'],'/add-edit-product/{id?}',[ProductController::class,'addEditProduct'])->name('product.add.edit');

    });
});
