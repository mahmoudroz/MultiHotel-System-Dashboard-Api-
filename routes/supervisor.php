<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/clear-cache',function(){
    Artisan::call('config:cache');
    Artisan::call('cache:clear');
    // Artisan::call('jwt:secret');
    return "cache clear";
});
Route::group(['middleware'=>['authLang']],function(){
    Route::post('login','authenticationController@authenticate');
    Route::group(['middleware'=>['supervisor']],function(){
        Route::post('logout','authenticationController@logout');
        Route::post('getOrders','OrderController@getOrders');
        Route::post('changeStatusToProcess','OrderController@changeStatusToProcess');
        Route::post('changeStatusToEnd','OrderController@changeStatusToEnd');
        Route::get('getAuthCategory','OrderController@getAuthCategory');
        Route::post('getAvaEmployee','OrderController@getAvaEmployee');
        Route::post('AssignEmployeeToOrder','OrderController@AssignEmployeeToOrder');
        Route::get('getMyEmployee','OrderController@getMyEmployee');
        Route::post('changeEmployeeStatus','OrderController@changeEmployeeStatus');

    });
});

