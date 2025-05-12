<?php

use Illuminate\Support\Facades\Route;

Route::
        namespace('API')->group(function () {
            Route::get('/products', 'ProductController@index');
            Route::post('/products', 'ProductController@store');
        });
