<?php

use Illuminate\Support\Facades\Route;
use App\Models\Product;
use App\Models\Photo;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PhotoContoller;
use App\Http\Controllers\MainController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ImageGalleryController;
use App\Http\Controllers\InfoController;
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



Route::get('/login',[App\Http\Controllers\MainController::class,'index']);


Route::get('/',[App\Http\Controllers\MainController::class,'home']);

Route::post('/login/checklogin',[App\Http\Controllers\MainController::class,'checklogin']);

Route::get('/home',[App\Http\Controllers\MainController::class,'successlogin']);

Route::get('/products/{word}',[HomeController::class,'show'])->name('show');

Route::get('/products/delete/{id}',[HomeController::class,'delete']);

Route::get('home/logout',[App\Http\Controllers\MainController::class,'logout']);

Route::post('/posts',[App\Http\Controllers\PostsController::class,'store']);

Route::post('/addcategories',[App\Http\Controllers\CategoryController::class,'store']);

//images
Route::delete('/destroy/{id}',[App\Http\Controllers\FormController::class,'destroy']);

Route::get('/order',[App\Http\Controllers\HomeController::class,'order']);

Route::get('/search',[App\Http\Controllers\SearchController::class,'search'])->name('search');

Route::get('/updateproduct/{id}',[App\Http\Controllers\UpdateController::class,'update']);
Route::put('/changeproduct/{id}',[App\Http\Controllers\UpdateController::class,'change']);

Route::get('/category', function () {
    return view('categories');
});



//forma
Route::get('/addproduct', function () {
    return view('create');
});
Route::get('/form',[App\Http\Controllers\FormController::class,'create']);
Route::post('/form',[App\Http\Controllers\FormController::class,'store']);

//category
Route::get('/category',[App\Http\Controllers\ShopController::class,'index'])->name('category');

Route::get('/archive',[App\Http\Controllers\FormController::class,'archive'])->name('archive');

//add categories
Route::get('/addcategory', function () {
    return view('addcategory');
});