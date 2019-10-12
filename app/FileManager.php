<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FileManager extends Model
{
    protected $table = 'acl_rules';
    protected $fillable = ['user_id', 'disk', 'path', 'access'];
}
