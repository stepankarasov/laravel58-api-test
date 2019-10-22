<?php

use Illuminate\Http\Request;
use Laravel\Passport\TransientTokenController;

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

Route::prefix('/v1/auth')->group(function ()
{
    Route::post('/signin', 'Auth\LoginController@login');
    Route::post('/signout', 'Auth\LoginController@logout');
    Route::match(['get', 'post'], '/signup', 'Auth\RegisterController@register');
    Route::get('/refresh', [
        'middleware' => ['web', 'auth'],
        'uses'       => 'TransientTokenController@refresh',
        'as'         => 'passport.token.refresh',
    ]);
});

Route::prefix('/v1')->middleware('auth:api')->group(function ()
{
    Route::get('/advert', 'Api\v1\AdvertController@index');
    Route::get('/advert/{advert}', 'Api\v1\AdvertController@show');
    Route::get('/category', 'Api\v1\CategoryController@index');
    Route::get('/category/{category}', 'Api\v1\CategoryController@show');
    Route::get('/comment', 'Api\v1\CommentController@index');
    Route::get('/comment/{comment}', 'Api\v1\CommentController@show');
});

Route::prefix('/v1')->middleware('api')->group(function ()
{
    Route::resource('advert', 'Api\v1\AdvertController');
    Route::resource('category', 'Api\v1\CategoryController');
    Route::resource('comment', 'Api\v1\CommentController');
});
