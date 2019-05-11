<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Models\PostModel;

class DiscussModel extends Model
{
    protected $table = 'discuss';
    protected $guarded;
//    protected $fillable = ['comment'];

    public function user_d(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function post(){
        return $this->belongsTo(PostModel::class, 'post_id', 'id');
    }
}
