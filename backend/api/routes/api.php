<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'public'] , function () use ($routes){
    Route::group(['prefix' => 'clients'], function() {
            Route::get('/',                             'ClientsController@index');
			Route::get('/{id}',                         'ClientsController@getId');
            Route::post('/store',                       'ClientsController@store');
            Route::post('/update/{id}',                  'ClientsController@update');
            Route::delete('/delete/{id}',               'ClientsController@destroy');
        });
});