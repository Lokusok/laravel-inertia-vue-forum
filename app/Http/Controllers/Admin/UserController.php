<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\ToggleRoleRequest;
use App\Http\Resources\Role\RoleResource;
use App\Http\Resources\User\UserWithRolesResource;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = UserWithRolesResource::collection(User::query()->get())->resolve();
        $roles = RoleResource::collection(Role::query()->get())->resolve();

        return inertia('Admin/User/Index', compact('users', 'roles'));
    }

    public function toggleRole(ToggleRoleRequest $request, User $user)
    {
        $data = $request->validated();

        $user->roles()->toggle($data);

        $user->load('roles');

        return UserWithRolesResource::make($user)->resolve();
    }
}
