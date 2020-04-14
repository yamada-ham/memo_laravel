<?php

Route::get('/', 'IndexController@get');
Route::post('/', 'IndexController@post');

Route::get('/archive', 'IndexController@get');
Route::post('/archive', 'IndexController@post');

Route::get('/trash', 'IndexController@get');
Route::post('/trash', 'IndexController@post');
