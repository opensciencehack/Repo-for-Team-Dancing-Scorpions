<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Api Routes
|--------------------------------------------------------------------------
|
| Here is where you can register Api routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your Api!
|
*/

Route::group([], function () {
    Route::get('/import', ['uses' => 'Api\ImportController@get']);
    Route::get('/charts/tweets', ['uses' => 'Api\ChartsController@getTweets']);
    Route::get('/charts/popular_hashtags', ['uses' => 'Api\ChartsController@getPopularHashtags']);
    Route::get('/charts/active', ['uses' => 'Api\ChartsController@getActive']);
});

