<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Spatie\Permission\Models\Role;
use App\Http\Resources\AllRoles as AllRoleResource;

use App\Http\Resources\UserCollection as UserCollectionResource;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }
    public function createUser(Request $request) {
        $createdUuser = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        $createdUuser = User::find($createdUuser->id);
        $createdUuser->assignRole([$request->role]);


        return response()->json(['User Created Successfully']);
    }

    public function getAllUsers() {
        return new UserCollectionResource(User::all());
    }

    public function removeUser($userId) {
        User::find($userId)->delete();
    }

    public function getAllRoles() {
        return new AllRoleResource(Role::all());
    }

    public function createRole(Request $request) {
        Role::create([
            'name' => $request->roleName
        ]);
        return response()->json(['Role Created Successfully']);

    }

    public function removeRole($roleId) {
        Role::find($roleId)->delete();
        return response()->json(['Role Removed Successfully']);

    }

    public function assignRole(Request $request) {
        $user = User::find($request->userId);
        $role = Role::find($request->roleId);

        $user->assignRole([$role->name]);

        return response()->json(['Role Assigned Successfully']);

    }

    public function removeRoleForUser(Request $request, $userId, $role) {
        $user = User::find($userId);
        $user->removeRole($role);
        return response()->json(['Role Removed Successfully for The User']);

    }

}
