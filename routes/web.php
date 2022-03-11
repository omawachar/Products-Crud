<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\SubCategoryController;
use App\Models\Subcategory;

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

// apply 
Route::group(['middleware'=>'auth'],function(){
    // Category Routes
    Route::get('categories', [CategoryController::class, 'index']);

    Route::get('createCategory', [CategoryController::class, 'create']);
    Route::post('createCategory', [CategoryController::class, 'store']);
    Route::get('edit/{id}', [CategoryController::class, 'edit']);
    Route::post('update', [CategoryController::class, 'update']);
    Route::get('delete/{id}', [CategoryController::class, 'delete']);

    // sub categories routes
    Route::get('subcategories', [SubCategoryController::class, 'index']);
    Route::get('createSubcategory', [SubCategoryController::class, 'create']);
    Route::post('createSubcategory', [SubCategoryController::class, 'store']);
    Route::get('editSubcategory/{id}', [SubCategoryController::class, 'edit']);
    Route::post('updateSubcategory', [SubCategoryController::class, 'update']);

    Route::get('subcategory/delete/{id}', [SubCategoryController::class, 'delete']);

    //Products routes
    Route::get('products', [ProductController::class, 'index'])->name('get.products');
     Route::get('addProduct',[ProductController::class,'create']);
    Route::post('addProduct', [ProductController::class, 'store']);
    Route::get('editProduct/{id}', [ProductController::class, 'edit']);
    Route::post('updateProduct', [ProductController::class, 'update']);
    Route::get('delete/{id}', [ProductController::class, 'delete']);
    Route::post('getSubCat', [ProductController::class, 'subcat']);
Route::post('get-products',[ProductController::class,'filterProducts']);

    Route::post('add-remove-variant', [ProductController::class, 'storeVariant']);
    Route::get('getProductsVariant/{id}', [ProductController::class, 'getVariants']);



});


//Register user routes
Route::get('register', [RegisterController::class, 'create'])->middleware('guest');
Route::post('register', [RegisterController::class, 'store'])->middleware('guest');

//login
//Route::get('/login', [SessionsController::class, 'create'])->middleware('guest');
Route::get('/', [SessionsController::class, 'create'])->middleware('guest');
Route::post('/', [SessionsController::class, 'store'])->middleware('guest');
Route::any('logout', [SessionsController::class, 'destroy'])->middleware('auth');
