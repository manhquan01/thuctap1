<?php
/**
 * Created by PhpStorm.
 * User: quan
 * Date: 22/04/19
 * Time: 22:18
 */

namespace App\Http\Controllers\Library;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;

trait QueryTableUser
{
    protected $user_role;

    protected $role = array(
        '0' => 'Admin',
        '1' => 'Editor',
        '2' => 'Censor',
        '3' => 'User');

    protected function getRole()
    {
        return $this->role;
    }

    protected function getUserRole()
    {
        $this->user_role = Auth::user()->role;
        return $this->user_role;
    }

    public function role()
    {
        $role = $this->getRole()[$this->getUserRole()];

        switch ($role) {
            case 'Admin':
                return 'Admin';
                break;

            case 'Editor':
                return 'Editor';
                break;

            case 'Censor':
                return 'Censor';
                break;

            default:
                return 'User';
                break;
        }
    }

    protected function updateUserTable(Request $request, $value)
    {
        DB::table('users')->where('id', $request->id)->update($value);
    }
}