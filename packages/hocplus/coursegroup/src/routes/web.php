<?php
$adminPrefix = config('site.admin_prefix');
Route::group(array('prefix' => $adminPrefix), function() {
    Route::group(['middleware' => ['adtech.auth', 'adtech.acl']], function () {

        Route::get('hocplus/coursegroup/demo/log', 'DemoController@log')->name('hocplus.coursegroup.demo.log');
        Route::get('hocplus/coursegroup/demo/data', 'DemoController@data')->name('hocplus.coursegroup.demo.data');
        Route::get('hocplus/coursegroup/demo/manage', 'DemoController@manage')->name('hocplus.coursegroup.demo.manage');
        Route::get('hocplus/coursegroup/demo/create', 'DemoController@create')->name('hocplus.coursegroup.demo.create');
        Route::post('hocplus/coursegroup/demo/add', 'DemoController@add')->name('hocplus.coursegroup.demo.add');
        Route::get('hocplus/coursegroup/demo/show', 'DemoController@show')->name('hocplus.coursegroup.demo.show');
        Route::put('hocplus/coursegroup/demo/update', 'DemoController@update')->name('hocplus.coursegroup.demo.update');
        Route::get('hocplus/coursegroup/demo/delete', 'DemoController@delete')->name('hocplus.coursegroup.demo.delete');
        Route::get('hocplus/coursegroup/demo/confirm-delete', 'DemoController@getModalDelete')->name('hocplus.coursegroup.demo.confirm-delete');
    });
});