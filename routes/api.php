<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['middleware' => ['api' , 'checkPassword' ,'changeLanguage'] ,'namespace' => 'Api'] , function()
{
    Route::post('get-main-categories','CategoryController@index');
    Route::post('get-category_byId','CategoryController@getCategory');
    Route::post('change-category_status','CategoryController@changeStatus');
    
    Route::group(['prefix' => 'admin' ,'namespace' => 'Admin'] , function()
    {
        Route::post('login','AuthController@login');
    });
});


Route::group(['middleware' => ['api' , 'checkPassword' ,'changeLanguage','checkAdminToken:admin-api'] ,'namespace' => 'Api'] , function()
{
    Route::get('offer','CategoryController@index');
});