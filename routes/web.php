<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;




Route::get('/', function () {
    return view('index');
})->name('index');


Route::prefix(['prefix' => 'Users','controller'=>UserController::class],function () {

Route::get('/','showUserTable')->name('show.user.table');
Route::get('/CreateUser','showCreateUserTable')->name('show.create.user');
Route::post('/CreateUser','saveUser')->name('create.user');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


