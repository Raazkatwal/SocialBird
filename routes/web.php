<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return inertia('App', ['isLoggedIn' => Auth::check(), 'loggedUser' => Auth::user()]);
})->name('home');

Route::controller(Usercontroller::class)->group(function() {
    Route::post('/signup', 'signup')->name('signup');
    Route::post('/logout', 'logout')->name('logout');
    Route::post('/login', 'login')->name('login');

});

