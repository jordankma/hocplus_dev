<?php
$adminPrefix = config('site.admin_prefix');
Route::group(array('prefix' => $adminPrefix), function() {
    Route::group(['middleware' => ['adtech.auth', 'adtech.acl']], function () {

        Route::get('ptest/mtest/demo/log', 'DemoController@log')->name('ptest.mtest.demo.log');
        Route::get('ptest/mtest/demo/data', 'DemoController@data')->name('ptest.mtest.demo.data');
        Route::get('ptest/mtest/demo/manage', 'DemoController@manage')->name('ptest.mtest.demo.manage');
        Route::get('ptest/mtest/demo/create', 'DemoController@create')->name('ptest.mtest.demo.create');
        Route::post('ptest/mtest/demo/add', 'DemoController@add')->name('ptest.mtest.demo.add');
        Route::get('ptest/mtest/demo/show', 'DemoController@show')->name('ptest.mtest.demo.show');
        Route::put('ptest/mtest/demo/update', 'DemoController@update')->name('ptest.mtest.demo.update');
        Route::get('ptest/mtest/demo/delete', 'DemoController@delete')->name('ptest.mtest.demo.delete');
        Route::get('ptest/mtest/demo/confirm-delete', 'DemoController@getModalDelete')->name('ptest.mtest.demo.confirm-delete');
    });
});