<?php

use App\Http\Controllers\BarangController;



$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('/barang', 'BarangController@index');
$router->post('/barang', 'BarangController@store');
$router->get('/barang/{id}', 'BarangController@show');
$router->put('/barang/{id}', 'BarangController@update');
$router->delete('/barang/{id}', 'BarangController@destroy');
