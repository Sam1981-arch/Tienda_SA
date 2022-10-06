<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function showUserTable()
    {
        $users = $this->getAllUsers()->original['users'];
        return view('users.table', compact('users'));

    }

    public function showCreateUser()
    {
        return view('users.create-user');
    }

    public function showUpdateUser(User $user)
    {
        return view('users.update-user', compact('user'));
    }

    public function getAllUsers()
    {
		
		$users = User::with('roles:id,name', 'garmentHasUser.garment.brand', 'garmentHasUser.garment.category')->get();
        return response()->json(['users' => $users], 200);
    }


    public function getAllUsersDT()
    {
        $data = User::with('roles:id,name', 'garmentHasUser.garment.brand', 'garmentHasUser.garment.category');

        return Datatables::of($data)
            ->addColumn('action', function ($row) {
                $actionBtn = "<a href='#' onclick='event.preventDefault();' data-id='{$row->id}' role='edit' class='edit btn btn-warning btn-sm'>Edit</a>
                <a href='#' onclick='event.preventDefault();' data-id='{$row->id}' role='delete' class='delete btn btn-danger btn-sm'>Delete</a>";
                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function getUserById(User $user)
    {
        $user->load('roles');
        return response()->json(['user' => $user], 200);
    }

    public function saveUser(CreateUserRequest $request)
    {
        try {
            DB::beginTransaction();
            $user = new User($request->all());
            $this->uploadAvatar($request, $user);
            $user->save();

            $user->assignRole($request->role);

            DB::commit();
            if ($request->ajax()) {
                return response()->json(['newUser' => $user], 201);
            }
            return back()->with('success', 'Usuario Creado con exito');
        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }
    }

    private function uploadAvatar($request, &$user)
    {
        if (!isset($request->avatar_file)) return;
        $avatar = "{$request->number_id}_{$request->avatar_file->getClientOriginalName()}.{$request->avatar_file->clientExtension()}";
        $request->avatar_file->move(storage_path('app/public/images'), $avatar);
        $user->avatar = $avatar;
    }

    public function updateUser(User $user, UpdateUserRequest $request)
    {
        try {

            DB::beginTransaction();
            $allRequest = $request->all();

            if (isset($allRequest['password'])) {
                if (!$allRequest['password']) unset($allRequest['password']);
            }

            $this->uploadAvatar($request, $user);
            $user->update($allRequest);
            $user->syncRoles([$request->role]);

            DB::commit();
            if ($request->ajax()) {
                return response()->json(['updatedUser' => $user->refresh()], 201);
            }
            return back()->with('success', 'Usuario Actualizado con exito');
        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }
    }

    public function deleteUser(User $user, Request $request)
    {
        $user->delete();
        if ($request->ajax()) {
            return response()->json([], 204);
        }
        return back()->with('success', 'Usuario Eliminado con exito');
    }
}
