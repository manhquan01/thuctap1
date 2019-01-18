<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Models\PostModel;

class CategoriesModel extends Model
{
    public $table = 'categories';
    protected $guarded = [];

    public function post()
    {
        return $this->hasMany(PostModel::class, 'category_id', 'id');
    }
}
