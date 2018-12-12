<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//Route::prefix('admin')->group(function(){
//    Route::get('/', 'HomeController@index');
//    Route::get('/dashboard', 'HomeController@index');
//
//    Route::get('category', 'HomeController@show');
//
//});

Route::group(['namespace' => 'Admin'],function(){
    Route::group(['prefix' => 'admin'],function(){
        Route::get('/', 'HomeController@index');


        Route::group(['prefix' => 'multilevel-category'], function(){
            Route::get('/', 'MultilevelCategoryController@index');
            Route::post('store', 'MultilevelCategoryController@store')->name('store_category');
            Route::get('/edit/{id}', 'MultilevelCategoryController@edit')->name('edit_category');
            Route::post('/update', 'MultilevelCategoryController@update')->name('update_category');
            Route::get('parent/{id}', 'MultilevelCategoryController@parent')->name('get_parent');
        });

        Route::group(['prefix' => 'category'], function (){
            Route::get('/', 'CategoryController@index');
            Route::post('store', 'CategoryController@store')->name('store_menu_item');
            Route::post('update', 'CategoryController@update')->name('update_menu_item');
            Route::get('destroy', 'CategoryController@delete')->name('destroy_menu_item');
        });

        Route::group(['prefix' => 'post'], function(){
            Route::get('/', 'PostController@index');
        });
    });
});
