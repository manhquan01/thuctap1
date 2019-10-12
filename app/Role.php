<?php

namespace App;

use Laratrust\Models\LaratrustRole;

class Role extends LaratrustRole
{
    protected $table  = 'roles';
    protected $guarded = [];

    public function role_permission(){
        return $this->belongsToMany(Permission::class,'permission_role','role_id', 'permission_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'role_user', 'role_id', 'user_id');
    }
}
