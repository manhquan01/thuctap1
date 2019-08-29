<?php

use Illuminate\Http\Request;
use App\CategoriesModel;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

//Route::get('quan/dao/1', function() {
//    $arr = ['dao'=> 'quan',
//            'hong' => 'phuc',
//            'xuan' => 'truong'];
//    $cate = CategoriesModel::all();
//    return response()->json($cate);
//});
Route::group(['prefix' => 'v1', 'middleware' => ['cors']], function () {
    Route::resource('user', 'API\UserController');

});
