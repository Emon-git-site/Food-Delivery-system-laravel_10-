<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\backend\adminController;
use App\Http\Controllers\backend\categoryController;
use App\Http\Controllers\backend\subcategoryController;

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


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// admin authentication
Route::prefix('admin')->group(function(){
//    Route::get('/login', [adminController::class, 'loginShow'])->name('login_form') ;
//    Route::get('/register', [adminController::class, 'RegisterShow'])->name('register_form') ;

   Route::view('/login',  'backend.auth.admin_login')->name('login_form') ;
   Route::view('/register', 'backend.auth.admin_register')->name('register_form') ;

   Route::get('/login/owner', [adminController::class, 'login'])->name('admin.login') ;
   Route::get('/dashboard', [adminController::class, 'dashboard'])->name('admin.dashboard') ;
});

// Route::view('/dashboard', 'backend.dashboard')->name('admin.dashboard');


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

require __DIR__.'/auth.php';
