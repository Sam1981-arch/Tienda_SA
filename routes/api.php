<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'Users', 'controller' => UserController::class], function () {
    Route::get('/GetAllUsers', 'getAllUsers');
    Route::get('/GetUserById/{user}', 'getUserById');
    Route::post('/SaveUser', 'saveUser');
    Route::post('/UpdateUser/{user}', 'updateUser');
    Route::delete('/DeleteUser/{user}', 'deleteUser');
});

