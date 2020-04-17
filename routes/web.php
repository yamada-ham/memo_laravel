<?php

Route::get('/', 'IndexController@get');
Route::post('/', 'IndexController@post');

Route::get('/archive', 'archiveController@get');
Route::post('/archive', 'archiveController@post');

Route::get('/trash', 'IndexController@get');
Route::post('/trash', 'IndexController@post');
