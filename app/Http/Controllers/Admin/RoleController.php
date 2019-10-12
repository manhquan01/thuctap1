<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Library\queryTableUser;
use App\Role;
use Illuminate\Support\Facades\Auth;
use Laratrust\Traits\LaratrustUserTrait;

class RoleController extends Controller
{
    use queryTableUser;
    use LaratrustUserTrait;

    public function __construct()
    {
//        $this->middleware(['CheckRoleEditor', 'CheckRoleCensor', 'CheckRoleUser']);
    }

    public function index()
    {
    //    dd(Auth::user()->can('update-role_manager'));
        $role = Role::select('id','display_name')->get()->toArray();

        $superadministrator = Role::where('name', 'superadministrator')->first()->users;
        $countAdmin = $superadministrator->count();
        $admins = Role::where('name', 'administrator')->first()->users;
        $censors = Role::where('name', 'moderator')->first()->users;
        $editors = Role::where('name', 'editor')->first()->users;
        return view('Admin.Role.index', compact('role','superadministrator','admins', 'censors', 'editors','countAdmin'));
    }

    public function store(Request $request)
    {
        $email = $request->email;
        $user = User::select('id')->where('email', $email)->first();
//        dd($user->hasRole(['superadministrator', 'editor', 'administrator', 'moderator']));
        if ($user->hasRole(['superadministrator', 'editor', 'administrator', 'moderator']))
        {
            return back()->withErrors('This user is already an Role');
        } else {
            $user->syncRoles([$request->role]);
        }
        return back();
    }

    public function edit(Request $request)
    {
        $userID = $request->id;
        $role = Role::select('id','display_name')->get()->toArray();
        return view('Admin.Role.edit_ajax', compact('userID', 'role'));
    }

    public function update(Request $request, $id)
    {
        $role = $request->role;
        User::find($id)->syncRoles([$role]);
        return back()->with('sucess', 'Done');
    }

    public function delete($id)
    {
        User::find($id)->syncRoles(['user']);
        return back()->with('sucess', 'Done');
    }

    public function search(Request $request)
    {
        $keyWord = $request->email;
        $allUser = User::where('email', 'LIKE', '%' . $keyWord . '%')->get();
        return response()->json($allUser);

    }
}
