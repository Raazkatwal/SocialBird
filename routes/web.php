<?php

use App\Http\Controllers\UserController;
use App\Http\Middleware\guestOnly;
use App\Http\Middleware\userOnly;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return inertia('App', ['isLoggedIn' => false]);
})->name('home')->middleware(guestOnly::class);

Route::get('/home', function() {
    return inertia('App', ['isLoggedIn' => true, 'loggedUser' => Auth::user()]);
})->middleware(userOnly::class);

Route::controller(Usercontroller::class)->group(function() {
    Route::post('/signup', 'signup')->name('signup');
    Route::post('/logout', 'logout')->name('logout');
    Route::post('/login', 'login')->name('login');

});

