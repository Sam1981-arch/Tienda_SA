<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getAllUsers(){
		$users= User::get();
		return response()->json(['users' => $users], 200);
	  }

	public function getUserById(User $user){
        return response()->json(['user' => $user], 200);
	}

	public function saveUser(Request $request){
     $user = new User($request->all());
	 $user->save();
	 return response()->json(['newUser' => $user],201);

	}

	public function updateUser(User $user, Request $request){

		$user->update($request->all());
		return response()->json(['UpdateUser' => $user->refresh()],201);

	}


	public function deleteUser(User $user){
		$user->delete();
		return response()->json(['deleted'=> true],204);
	}


}
