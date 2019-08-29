<?php
/**
 * Created by PhpStorm.
 * User: quan
 * Date: 28/07/19
 * Time: 12:40
 */
namespace App\Http\Controllers\library;
use App\Role;
use App\Permission;
use Illuminate\Support\Facades\Route;

trait Permissions
{
    public function sync(){
        $routes = Route::getRoutes();
        $permissions = [];

        foreach ($routes as $route) {
            $name = $route->getName();

            if (substr($name, 0, 5) == 'admin' && count(explode('.', $name)) > 2) {
                $action = $route->getAction();

                if (isset($action['role'])) {
                    $role = $action['role'];
                    $role = substr($role, 6, strlen($role));
                    $oneDot = explode('.', $role);
                    if (isset($oneDot[1])) {
                        $permissions[str_replace('-', '_', substr($role, 0, strlen($role) - strlen(end($oneDot)) - 1))][] = end($oneDot);
                    }
                } else {
                    $name = substr($name, 6, strlen($name));
                    $oneDot = explode('.', $name);
                    if (isset($oneDot[1])) {
                        $permissions[str_replace('-', '_', substr($name, 0, strlen($name) - strlen($oneDot[1]) - 1))][] = end($oneDot);
                    }
                }
            }
        }

        foreach ($permissions as $key => $value) {

            foreach ($value as $k => $v) {
                if ($v == 'index' || $v == 'view' || $v == 'show')
                    $value[$k] = 'read';

                if ($v == 'create' || $v == 'store')
                    $value[$k] = 'create';

                if ($v == 'edit' || $v == 'update')
                    $value[$k] = 'update';

                if ($v == 'delete' || $v == 'destroy')
                    $value[$k] = 'delete';

            }
            $permissions[$key] = array_unique($value);
        }

        foreach ($permissions as $module => $permission) {
            foreach ($permission as $item) {
                $permit = Permission::where('name', $item . '-' . $module)->first();
                if ($permit == null) {
                    $data = [
                        'name' => $item . '-' . $module,
                        'display_name' => ucfirst($item) . ' ' . ucfirst($module),
                        'description' => ucfirst($item) . ' ' . ucfirst($module),
                        'module' => ucfirst($module),
                        'action' => ucfirst($item),
                    ];
                    $createPermission = Permission::create($data);
                    Role::first()->attachPermission($createPermission);
                }
            }
        }
        return $permissions;
    }
}
