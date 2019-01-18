<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\CategoriesModel;
use App\Models\PostModel;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $data['category'] = CategoriesModel::all();
        $data['pin'] = PostModel::orderBy('id', 'DESC')->limit(6)->offset(5)->where('status', '0')->get()->toArray();
        view()->share($data);

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        require_once __DIR__ . '/../Helpers/simple_html_dom.php';
    }
}
