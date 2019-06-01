<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Library\queryTableUser;

class RoleController extends Controller
{
    use queryTableUser;

    public function __construct()
    {
        $this->middleware(['CheckRoleEditor', 'CheckRoleCensor', 'CheckRoleUser']);
    }

    public function index()
    {
        $role = $this->getRole();

        $admins = User::where('role', '0')->get();
        $countAdmin = $admins->count();
        $censors = User::where('role', '2')->get()->toArray();
        $editors = User::where('role', '1')->get()->toArray();
        return view('Admin.Role.index', compact('role', 'admins', 'censors', 'editors','countAdmin'));
    }

    public function store(Request $request)
    {
        $email = $request->email;
        $roleOfUser = User::select('id', 'role')->where('email', $email)->first();
        if ($roleOfUser['role'] === 3) {
            $roleOfUser->update(['role' => $request->role]);
        } else {
            $role = $this->getRole();
            foreach ($role as $key => $item) {
                if ($key == $roleOfUser['role']) {
                    switch ($roleOfUser['role']) {
                        case 0:
                            $roleName = $item;
                            break;
                        case 1:
                            $roleName = $item;
                            break;
                        case 2:
                            $roleName = $item;
                            break;
                    }
                }
            }
            return back()->withErrors('This user is already an ' . $roleName);
        }
        return back();
    }

    public function edit(Request $request)
    {
        $user = User::find($request->id);
        return view('Admin.Role.edit_ajax', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $role = $request->role;
        User::find($id)->update(['role' => $role]);
        return back()->with('sucess', 'Done');
    }

    public function delete($id)
    {
        User::find($id)->update(['role' => 3]);
        return back()->with('sucess', 'Done');
    }

    public function search(Request $request)
    {
        $keyWord = $request->email;
        $allUser = User::where('role', 3)->where('email', 'LIKE', '%' . $keyWord . '%')->get();
        return response()->json($allUser);

    }
}
