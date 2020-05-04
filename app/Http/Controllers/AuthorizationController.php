<?php

namespace App\Http\Controllers;

use App\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AuthorizationController extends Controller
{

    public function login()
    {
//        $role = Role::create(['name' => 'administrator']);
//        $permission = Permission::create(['name' => 'Administrator']);
//        $role->givePermissionTo($permission);
//        $role = Role::create(['name' => 'customer']);
//        $permission = Permission::create(['name' => 'Customer']);
//        $role->givePermissionTo($permission);
//        $user = User::findOrFail(1);
//        $user->assignRole('administrator');
        return view('authorization.signin');
    }

    public function registration()
    {

        return view('authorization.registration');
    }

    public function registered()
    {
        return view('authorization.registered');
    }
}
