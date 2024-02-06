<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\backend\adminController;
use App\Http\Controllers\backend\blogCategoryController;
use App\Http\Controllers\backend\blogController;
use App\Http\Controllers\backend\categoryController;
use App\Http\Controllers\backend\floorController;
use App\Http\Controllers\backend\reservationController;
use App\Http\Controllers\backend\subcategoryController;
use App\Http\Controllers\backend\tableController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// admin authentication
Route::prefix('admin')->name('admin.')->group(function(){
   Route::view('/login',  'backend.auth.admin_login')->name('login_form') ;
   Route::view('/register', 'backend.auth.admin_register')->name('register_form') ;
   Route::post('/login/owner', [adminController::class, 'adminlogin'])->name('login') ;
   Route::post('/register', [adminController::class, 'adminregister'])->name('register') ;
   Route::get('/dashboard', [adminController::class, 'dashboard'])->name('dashboard')->middleware('admin');
   Route::get('/logout', [adminController::class, 'adminlogout'])->name('logout')->middleware('admin');

});


Route::middleware('')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// category routes
Route::prefix('category/')->name('category.')->group(function(){
    Route::get('index', [categoryController::class, 'index'])->name('index');

    // ajax purpose
    Route::get('categoryShow', [categoryController::class, 'categoryShow'])->name('categoryShow');
    Route::post('store', [categoryController::class, 'store'])->name('store');
    Route::get('edit/{id}', [categoryController::class, 'edit']);
    Route::post('update/{id}', [categoryController::class, 'update']);
    Route::get('delete/{id}', [categoryController::class, 'destroy'])->name('delete');
});

// subcategory routes
Route::prefix('subcategory/')->name('subcategory.')->group(function(){
    Route::get('index', [subcategoryController::class, 'index'])->name('index');
    Route::post('store', [subcategoryController::class, 'store'])->name('store');
    Route::get('edit/{id}', [subcategoryController::class, 'edit']);
    Route::post('update/{id}', [subcategoryController::class, 'update']);
    Route::get('delete/{id}', [subcategoryController::class, 'destroy'])->name('delete');
});

// Blog category routes
Route::prefix('admin/blogCategory/')->name('admin.blogCategory.')->group(function(){
    Route::get('index', [blogCategoryController::class, 'index'])->name('index');
    Route::post('store', [blogCategoryController::class, 'store'])->name('store');
    Route::get('edit/{id}', [blogCategoryController::class, 'edit']);
    Route::post('update/{id}', [blogCategoryController::class, 'update']);
    Route::get('delete/{id}', [blogCategoryController::class, 'destroy'])->name('delete');
});

// Blog post routes
Route::prefix('admin/blog/')->name('admin.blog.')->group(function(){
    Route::get('index', [blogController::class, 'index'])->name('index');
    Route::post('store', [blogController::class, 'store'])->name('store');
    Route::get('edit/{id}', [blogController::class, 'edit']);
    Route::post('update/{id}', [blogController::class, 'update']);
    Route::get('delete/{id}', [blogController::class, 'destroy'])->name('delete');
});

// Floor  routes
Route::prefix('admin/floor/')->name('admin.floor.')->group(function(){
    Route::get('index', [floorController::class, 'index'])->name('index');
    Route::post('store', [floorController::class, 'store'])->name('store');
    Route::get('edit/{id}', [floorController::class, 'edit']);
    Route::post('update', [floorController::class, 'update'])->name('update');
    Route::get('delete/{id}', [floorController::class, 'destroy'])->name('delete');
});

// table  routes
Route::prefix('admin/table/')->name('admin.table.')->group(function(){
    Route::get('index', [tableController::class, 'index'])->name('index');
    Route::post('store', [tableController::class, 'store'])->name('store');
    Route::get('edit/{id}', [tableController::class, 'edit']);
    Route::post('update', [tableController::class, 'update'])->name('update');
    Route::get('delete/{id}', [tableController::class, 'destroy'])->name('delete');
});

// reservation  routes
Route::prefix('admin/reservation/')->name('admin.reservation.')->group(function(){
    Route::get('index', [reservationController::class, 'index'])->name('index');
    Route::post('store', [reservationController::class, 'store'])->name('store');
    Route::get('edit/{id}', [reservationController::class, 'edit']);
    Route::post('update', [reservationController::class, 'update'])->name('update');
    Route::get('delete/{id}', [reservationController::class, 'destroy'])->name('delete');
});

require __DIR__.'/auth.php';
