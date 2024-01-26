<?php

use Illuminate\Support\Facades\Route;



Route::view('/', 'welcome');


// admin login 
// Route::view('/login', 'loginView')->name('login');

// user login
Route::view('/user/login-register', 'auth.login')->name('user.login');


Route::get('/home', function () {
    return view('home');
})->middleware(['auth', 'verified'])->name('home');




require __DIR__.'/auth.php';
require __DIR__.'/admin.php';