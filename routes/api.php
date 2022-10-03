<?php

use App\Controllers\UserController;
use Illuminate\Support\Facades\Route;



Route::group(['prefix' => 'Users', 'controller' => UserController::class], function(){

	Route::get('/GetAllUsers','getAllUsers');
	Route::get('/getUserById/{user}','getUserById');
	Route::post('/SaveUser','saveUser');
	Route::put('/UpdateUser/{user}','updateUser');
	Route::delete('/DeleteUser/{user}','deleteUser');

});

