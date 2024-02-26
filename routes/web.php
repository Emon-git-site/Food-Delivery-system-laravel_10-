<?php

use App\Http\Controllers\Front\frontendController;
use App\Http\Controllers\user\userController;
use Illuminate\Support\Facades\Route;


// root page show
Route::get('/', [frontendController::class, 'index']);

// user login
Route::view('/user/login-register', 'auth.login')->name('user.login');
Route::view('/home', 'home')->middleware(['auth', 'verified'])->name('home');

// reservation store
Route::post('/reservation-store', [frontendController::class, 'reservationStore'])->name('user.reservation.store');


// Route::name('profile.')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('destroy');
// });

// review controller
Route::name('customer.')->prefix('customer/')->middleware(['auth', 'verified'])->group(function () {
    Route::get('comment', [userController::class, 'comment'])->name('comment');
    Route::post('/comment/store', [userController::class, 'storeComment'])->name('comment.store');
    Route::post('/comment/update', [userController::class, 'updateComment'])->name('comment.update');
    Route::delete('/profile', [userController::class, 'destroy'])->name('destroy');
});

require __DIR__.'/auth.php';
require __DIR__.'/admin.php';