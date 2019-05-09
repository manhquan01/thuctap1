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

Route::group(['namespace' => 'Frontend'], function (){
    Route::get('/',[
        'as' => 'frontend_index',
        'uses' => 'ArticleController@index'
    ]);

    Route::get('/category/{slug}.html', [
        'as' => 'frontend_category_post',
        'uses' => 'ArticleController@showPostOfCategory'
    ]);
    Route::get('{slug}',[
        'as' => 'frontend_article',
        'uses' => 'ArticleController@showArticle'
    ]);
    Route::post('{slug}',[
        'as' => 'discuss_article',
        'uses' => 'ArticleController@comment'
    ]);

});
//Auth::routes();

Route::get('login/admin', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login/admin', 'Auth\LoginController@login');
Route::get('logout/admin', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('register/admin', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register/admin', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

Route::group(['namespace' => 'Admin'],function(){

//    Route::get('login/admin', 'UserController@getLogin')->name('login')->middleware('logedin');
//    Route::post('loged-in/admin', 'UserController@postLogin')->name('logged-in')->middleware('logedin');
//    Route::get('logout/admin', 'UserController@logout')->name('logout');

    Route::group(['prefix' => 'admin/uae', 'middleware' => ['auth','CheckActivated']],function(){
        Route::get('/', 'HomeController@index')->name('index');


        Route::group(['prefix' => 'multilevel-category'], function(){
            Route::get('/', 'MultilevelCategoryController@index');
            Route::post('store', 'MultilevelCategoryController@store')->name('store_category');
            Route::get('/edit/{id}', 'MultilevelCategoryController@edit')->name('edit_category');
            Route::post('/update', 'MultilevelCategoryController@update')->name('update_category');
            Route::get('parent/{id}', 'MultilevelCategoryController@parent')->name('get_parent');
        });

        Route::group(['prefix' => 'category'], function (){
            Route::get('/', 'CategoryController@index')->name('category_dashboard');
            Route::post('store', 'CategoryController@store')->name('store_menu_item');
            Route::post('update', 'CategoryController@update')->name('update_menu_item');
            Route::get('destroy', 'CategoryController@delete')->name('destroy_menu_item');
            Route::get('change_status',[
                'as' => 'change_status_category',
                'uses' => 'CategoryController@change_status'
            ]);
        });

        Route::group(['prefix' => 'post'], function(){
            Route::get('/', 'PostController@index')->name('post_dashboard');
            Route::get('create-new-post', [
                'as' => 'create_new_post',
                'uses' => 'PostController@create',
            ]);
            Route::post('store-new-post', [
                'as' => 'store_new_post',
                'uses' => 'PostController@store'
            ]);
            Route::get('edit/{id}', [
                'as' => 'edit_post',
                'uses' => 'PostController@edit'
            ]);
            Route::post('update/{id}', [
                'as' => 'update_post',
                'uses' => 'PostController@update'
            ]);
            Route::post('destroy', [
                'as' => 'destroy_post',
                'uses' => 'PostController@destroy'
            ]);
            Route::get('trash', [
                'as' => 'trash_post',
                'uses' => 'PostController@trash'
            ]);
            Route::post('restore',[
                'as' => 'restore_post',
                'uses' => 'PostController@restore'
            ]);

            Route::post('delete',[
               'as' => 'delete_post',
               'uses' => 'PostController@delete'
            ]);

            Route::post('status_posted', [
                'as' => 'stranfer_status_posted',
                'uses' => 'PostController@posted'
            ]);

            Route::get('search', [
               'as' => 'search_post',
               'uses' => 'PostController@search'
            ]);
        });

        Route::group(['prefix' => 'member'], function (){
            Route::get('/', [
                'as' => 'member_dashboard',
                'uses' => 'MemberController@index'
            ]);
            Route::get('change_activated',[
                'as' => 'change_activated',
                'uses' => 'MemberController@updateActivatedUser'
            ]);
        });

        Route::group(['prefix' => 'discuss'], function (){
            Route::get('/',[
                'as' => 'discuss_index',
                'uses' => 'DiscussController@index'
            ]);
        });
    });
});

Route::get('/home/admin', 'HomeController@index')->name('home');
