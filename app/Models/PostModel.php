<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\CategoriesModel;
use App\User;
use App\Models\DiscussModel;

class PostModel extends Model
{
    use SoftDeletes;

    public $table = 'post';
    protected $guarded = [];
    protected $dates = ['deleted_at'];

    public function category()
    {
        return $this->belongsTo(CategoriesModel::class, 'category_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'author', 'id');
    }

    public function discuss(){
        return $this->hasMany(DiscussModel::class, 'post_id', 'id');
    }
}
