<?php

use Illuminate\Support\Facades\Route;

Route::namespace('API')->group(function () {
    Route::get('/products', 'ProductController@index');  // Rota GET para buscar os produtos
    Route::post('/products', 'ProductController@store'); // Rota POST para salvar os produtos
});
