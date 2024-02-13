<?php

use App\Http\Controllers\Front\frontendController;
use Illuminate\Support\Facades\Route;



Route::view('/', 'welcome');

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


require __DIR__.'/auth.php';
require __DIR__.'/admin.php';