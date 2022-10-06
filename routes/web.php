<?php

use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;


Auth::routes();

Route::get('/test', function () {
    Role::create(['name' => 'user']);
    Role::create(['name' => 'admin']);
});

Route::get('/', function () {
    return view('garment');
})->name('garment');







Route::group(
    ['prefix' => 'Users', 'middleware' => ['auth', 'role:admin'], 'controller' => UserController::class],
    function () {
        Route::get('/', 'showUserTable')->name('show.user.table');
        Route::get('/GetAllUsersWithDT', 'getAllUsersDT')->name('get.all.user');
        Route::get('/CreateUser', 'showCreateUser')->name('show.create.user');
        Route::get('/UpdateUser/{user}', 'showUpdateUser')->name('show.update.user');
        Route::post('/CreateUser',  'saveUser')->name('save.user');
        Route::put('/UpdateUser/{user}',  'updateUser')->name('update.user');
        Route::delete('/DeleteUser/{user}',  'deleteUser')->name('delete.user');
    }
);


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

