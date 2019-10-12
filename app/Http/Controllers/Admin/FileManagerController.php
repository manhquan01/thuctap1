<?php

namespace App\Http\Controllers\Admin;

use App\Permission;
use App\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\FileManager;
use App\User;

class FileManagerController extends Controller
{
    public function index()
    {

        $folderName = FileManager::select('id', 'disk', 'path', 'access')->get()->toArray();
        foreach ($folderName as $item) {
            $path = $item['disk'] . '/' . $item['path'];
            if (file_exists($path)) {
                $permit = Permission::select('id','name')->where('name', 'fm-file')->with('role')->first()->toArray();
                foreach ($permit['role'] as $roles) {
                    $users = Role::select('id')->where('id', $roles)->with('users')->first()->toArray();
                    foreach ($users['users'] as $user){
                        if (!file_exists($path . '/00' . $user['id'])) {
                            mkdir($path . '/00' . $user['id'], 0777, true);
                            if (!file_exists($path . '/00' . $user['id'] . '/' . date('ymd'))) {
                                mkdir($path . '/00' . $user['id'] . '/' . date('ymd'), 0777, true);
                            }
                        } else {
                            if (!file_exists($path . '/00' . $user['id'] . '/' . date('ymd'))) {
                                mkdir($path . '/00' . $user['id'] . '/' . date('ymd'), 0777, true);
                            }
                        }
                    }
                }
            }

        }

//        $folderName = FileManager::select('id', 'disk', 'path', 'access')->get()->toArray();
//        foreach ($folderName as $item) {
//            $path = $item['disk'] . '/' . $item['path'];
//            if (file_exists($path)) {
//                $users = User::select('id', 'name')->get();
//                foreach ($users as $user) {
//                    if (!file_exists($path . '/00' . $user['id'])) {
//                        mkdir($path . '/00' . $user['id'], 0777, true);
//                        if (!file_exists($path . '/00' . $user['id'] . '/' . date('ymd'))) {
//                            mkdir($path . '/00' . $user['id'] . '/' . date('ymd'), 0777, true);
//                        }
//                    } else {
//                        if (!file_exists($path . '/00' . $user['id'] . '/' . date('ymd'))) {
//                            mkdir($path . '/00' . $user['id'] . '/' . date('ymd'), 0777, true);
//                        }
//                    }
//                }
//            }
//
//        }
        return view('Admin.File_manager.index');
    }

    public function ckEditor()
    {
        return view('Admin.file-manager.ck_editor');
    }
}
