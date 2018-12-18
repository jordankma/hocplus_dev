<?php
$adminPrefix = config('site.admin_prefix');
Route::group(array('prefix' => $adminPrefix), function() {
    Route::group(['middleware' => ['adtech.auth', 'adtech.acl']], function () {

        Route::get('vne/classes/classes/log', 'ClassesController@log')->name('vne.classes.classes.log');
        Route::get('vne/classes/classes/data', 'ClassesController@data')->name('vne.classes.classes.data');
        Route::get('vne/classes/classes/manage', 'ClassesController@manage')->name('vne.classes.classes.manage')->where('as','Lớp - Danh sách');
        Route::get('vne/classes/classes/create', 'ClassesController@create')->name('vne.classes.classes.create');
        Route::post('vne/classes/classes/add', 'ClassesController@add')->name('vne.classes.classes.add');
        Route::get('vne/classes/classes/show', 'ClassesController@show')->name('vne.classes.classes.show');
        Route::post('vne/classes/classes/update', 'ClassesController@update')->name('vne.classes.classes.update');
        Route::get('vne/classes/classes/delete', 'ClassesController@delete')->name('vne.classes.classes.delete');
        Route::get('vne/classes/classes/confirm-delete', 'ClassesController@getModalDelete')->name('vne.classes.classes.confirm-delete');
    });
});