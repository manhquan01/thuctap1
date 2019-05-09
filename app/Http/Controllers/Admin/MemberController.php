<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Http\Controllers\Library\queryTableUser;

class MemberController extends Controller
{
    use queryTableUser;

    public function __construct()
    {
        $this->middleware(['CheckRoleEditor','CheckRoleCensor','CheckRoleUser']);
    }

    public function index(Request $request){
        $roles = $this->getRole();
        $members = DB::table('users')->select('id', 'name', 'email', 'phone_number', 'role', 'activated')->paginate(5);
        return view('Admin.Member.index', ['members' => $members, 'roles' => $roles]);
    }

    public function updateActivatedUser(Request $request){
        $value = DB::table('users')->select('activated')->find($request->id);
        if ($value->activated == 0){
            $val = ['activated' => '1'];
            $this->updateUserTable($request, $val);
            return '1';
        }
        else{
            $val = ['activated' => '0'];
            $this->updateUserTable($request, $val);
            return '0';
        }
    }
}
