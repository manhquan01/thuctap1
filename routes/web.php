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

Route::group(['namespace' => 'Frontend'], function () {
    Route::get('/', [
        'as' => 'frontend_index',
        'uses' => 'ArticleController@index'
    ]);

    Route::get('/category/{slug}.html', [
        'as' => 'frontend_category_post',
        'uses' => 'ArticleController@showPostOfCategory'
    ]);
    Route::get('{slug}', [
        'as' => 'frontend_article',
        'uses' => 'ArticleController@showArticle'
    ]);
    Route::post('{slug}', [
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

Route::group(['namespace' => 'Admin'], function () {

    Route::group([
        'prefix' => 'admin/uae',
        'middleware' => ['auth', 'CheckActivated', 'check.permission'],
        'as' => 'admin.'
    ], function () {
        Route::get('/', 'HomeController@index')->name('dashboard.index');


//        Route::group(['prefix' => 'multilevel-category'], function () {
//            Route::get('/', 'MultilevelCategoryController@index');
//            Route::post('store', 'MultilevelCategoryController@store')->name('store_category');
//            Route::get('/edit/{id}', 'MultilevelCategoryController@edit')->name('edit_category');
//            Route::post('/update', 'MultilevelCategoryController@update')->name('update_category');
//            Route::get('parent/{id}', 'MultilevelCategoryController@parent')->name('get_parent');
//        });

        Route::group(['prefix' => 'category'], function () {
            Route::get('/', 'CategoryController@index')->name('category.index');
            Route::post('store', 'CategoryController@store')->name('category.store');
            Route::post('update', 'CategoryController@update')->name('category.update');
            Route::get('destroy', 'CategoryController@delete')->name('category.destroy');
            Route::get('change_status', [
                'as' => 'category.status',
                'uses' => 'CategoryController@change_status'
            ]);
        });

        Route::group(['prefix' => 'post'], function () {
            Route::get('/', 'PostController@index')->name('post.index');
            Route::get('create-new-post', [
                'as' => 'post.create',
                'uses' => 'PostController@create',
            ]);
            Route::post('store-new-post', [
                'as' => 'post.store',
                'uses' => 'PostController@store'
            ]);
            Route::get('edit/{id}', [
                'as' => 'post.edit',
                'uses' => 'PostController@edit'
            ]);
            Route::post('update/{id}', [
                'as' => 'post.update',
                'uses' => 'PostController@update'
            ]);

            Route::post('delete', [
                'as' => 'post.delete',
                'uses' => 'PostController@delete'
            ]);

            Route::post('destroy', [
                'as' => 'post.remove',
                'uses' => 'PostController@destroy'
            ]);
            Route::get('trash', [
                'as' => 'post.trash',
                'uses' => 'PostController@trash'
            ]);
            Route::post('restore', [
                'as' => 'post.restore',
                'uses' => 'PostController@restore'
            ]);

            Route::post('status_posted', [
                'as' => 'post.status',
                'uses' => 'PostController@posted'
            ]);

            Route::get('search', [
                'as' => 'post.search',
                'uses' => 'PostController@search'
            ]);

            Route::get('search-ajax', [
                'as' => 'post.search-ajax',
                'uses' => 'PostController@searchAjax'
            ]);

        });

        Route::group(['prefix' => 'member'], function () {
            Route::get('/', [
                'as' => 'member.index',
                'uses' => 'MemberController@index'
            ]);
            Route::get('change_activated', [
                'as' => 'member.activated',
                'uses' => 'MemberController@updateActivatedUser'
            ]);
        });

        Route::group(['prefix' => 'discuss'], function () {
            Route::get('/', [
                'as' => 'discuss.index',
                'uses' => 'DiscussController@index'
            ]);
        });

        Route::group(['prefix' => 'role'], function () {
            Route::get('/', [
                'as' => 'role.index',
                'uses' => 'RoleController@index',
            ]);

            Route::post('/store', [
                'as' => 'role.store',
                'uses' => 'RoleController@store',
            ]);

            Route::get('/edit', [
                'as' => 'role.edit',
                'uses' => 'RoleController@edit',
            ]);

            Route::post('/update/{id}', [
                'as' => 'role.update',
                'uses' => 'RoleController@update',
            ]);

            Route::post('/delete/{id}', [
                'as' => 'role.delete',
                'uses' => 'RoleController@delete',
            ]);

            Route::get('/search', [
                'as' => 'role.search-ajax',
                'uses' => 'RoleController@search',
            ]);
        });

        Route::get('/role-manager',[
            'as' => 'rolemanager.index',
            'uses' => 'RoleManagerController@index',
        ]);

        Route::get('/role-manager/edit/{id}',[
            'as' =>'rolemanager.edit',
            'uses' => 'RoleManagerController@edit',
        ]);

        Route::post('/role-manager/update/{id}',[
            'as'  => 'rolemanager.update',
            'uses' => 'RoleManagerController@update'
        ]);

        Route::get('/file', [
            'as' => 'file.fm',
            'uses' => 'FileManagerController@index',
        ]);
    });
});

Route::get('/home/admin', 'HomeController@index')->name('home');
