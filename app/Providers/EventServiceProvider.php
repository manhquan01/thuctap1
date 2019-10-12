<?php

namespace App\Providers;

use App\Permission;
use App\Role;
use DB;
use App\User;
use App\Models\FileManager;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\Event' => [
            'App\Listeners\EventListener',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
        \Event::listen('Alexusmai\LaravelFileManager\Events\DirectoryCreated',
            function ($event) {
                \Log::info('DirectoryCreated:', [
                    $event->disk(),
                    $event->path(),
                    $event->name(),
                ]);

                if ($event->path() == null) {
                    $data = [
                        'disk' => $event->disk(),
                        'path' => $event->name(),
                        'access' => 1
                    ];
                    DB::table('acl_rules')->insert($data);
                }



                $path = $event->disk() . '/' . $event->name();
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
                            }
                        }
                    }
                }
            }
        );

        \Event::listen('Alexusmai\LaravelFileManager\Events\Deleting',
            function ($event) {
                \Log::info('Deleting:', [
                    $event->disk(),
                    $event->items(),
                ]);
                $folder = \DB::table('acl_rules')->whereIn('path', $event->items())->exists();
                if ($folder) {
                    foreach ($event->items() as $item) {
                        \DB::table('acl_rules')->where('path', $item)->delete();
                    }
                }
            }
        );

    }
}
