<?php

$apiPrefix = '/resource';
Route::group(array('prefix' => $apiPrefix), function () {
    Route::get('store-record-lesson', 'GlobalController@record');
    Route::get('verify-token', 'GlobalController@verify');
    Route::get('{route_hash}', 'GlobalController@get');

    Route::post('login', 'UserController@postLogin');
    Route::post('register', 'UserController@postRegister');
});