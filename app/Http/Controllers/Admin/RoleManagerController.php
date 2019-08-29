<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\library\Permissions;
use Laratrust\Traits\LaratrustUserTrait;
use App\Role;

class RoleManagerController extends Controller
{
    use Permissions;
    use LaratrustUserTrait;

    public function index()
    {
        $roles = Role::select('id', 'display_name', 'description')->paginate(10);
        return view('Admin.Role_manager.index', compact('roles'));
    }

    public function edit($id)
    {
        $role = Role::find($id);
        $permissions = $this->sync();
        return view('Admin.Role_manager.edit', compact('permissions', 'role'));
    }

    public function update(Request $request, $id)
    {
        $roleHasPermission = [];
        $roles = Role::find($id);
        foreach ($roles->role_permission->toArray() as $role) {
            $roleHasPermission[] = $role['name'];
        }

        $permissionName = $request->permission;

        if ($permissionName != null) {
            $compare = array_diff($permissionName, $roleHasPermission);
            if ($compare != []) {
                $roles->attachPermissions($compare);
            }

            $compare = array_diff($roleHasPermission, $permissionName);
            if ($compare != []) {
                $roles->detachPermissions($compare);
            }
            return redirect()->back();
        }

        if ($permissionName == null) {
            $allPermission = $roles->role_permission->toArray();
            $roles->detachPermissions($allPermission);
            return redirect()->back();
        }
        return back()->withErrors('failed');
    }
}
