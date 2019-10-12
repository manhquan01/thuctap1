<?php
/**
 * Created by PhpStorm.
 * User: quan
 * Date: 02/09/19
 * Time: 22:31
 */

namespace App\Http\Controllers\Library;

use Alexusmai\LaravelFileManager\Services\ACLService\ACLRepository;
use Illuminate\Support\Facades\Auth;

class ConfigRuleFileManager implements ACLRepository
{

    /**
     * Get user ID
     *
     * @return mixed
     */
    public function getUserID()
    {
        // TODO: Implement getUserID() method.
        return \Auth::id();
    }

    /**
     * Get ACL rules list for user
     *
     * You need to return an array, like this:
     *
     *  0 => [
     *      "disk" => "public"
     *      "path" => "music"
     *      "access" => 0
     *  ],
     *  1 => [
     *      "disk" => "public"
     *      "path" => "images"
     *      "access" => 1
     *  ]
     *
     * OR [] - if no results for selected user
     *
     * @return array
     */
    public function getRules(): array
    {
        // TODO: Implement getRules() method.
        if (Auth::user()->hasRole('superadministrator')) {
            return [
                ['disk' => 'media', 'path' => '*', 'access' => 2],
            ];
        }

        $a = \DB::table('acl_rules')->select('*')->get()->toArray();
        $all[] = ['disk' => 'media', 'path' => '/', 'access' => 1];
        foreach($a as $item){
            $all[] = ['disk' => $item->disk, 'path' => $item->path, 'access' => $item->access];
            $all[] = ['disk' => $item->disk, 'path' => $item->path .'/00'. \Auth::user()->id, 'access' => 1];
            $all[] = ['disk' => $item->disk, 'path' => $item->path . '/00'. \Auth::user()->id .'/*/*', 'access' => 2];
            $all[] = ['disk' => $item->disk, 'path' => $item->path . '/00'. \Auth::user()->id .'/*', 'access' => 1];
        }

        return $all;
    }
}
