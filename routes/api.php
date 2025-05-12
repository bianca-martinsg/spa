<?php

use Illuminate\Support\Facades\Route;

Route::
        namespace('API')->group(function () {
            Route::get('/products', 'ProductController@index');
            Route::post('/products', 'ProductController@store');
            Route::put('/products/{id}', 'ProductController@update');
            Route::delete('/products/{id}', 'ProductController@destroy');
        });
