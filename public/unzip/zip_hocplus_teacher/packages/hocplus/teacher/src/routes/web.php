<?php
$adminPrefix = '';
//$adminPrefix = config('site.admin_prefix');
Route::group(array('prefix' => $adminPrefix), function() {

    Route::get('hocplus/teacher/demo/log', 'DemoController@log')->name('hocplus.teacher.demo.log');
    Route::get('hocplus/teacher/demo/data', 'DemoController@data')->name('hocplus.teacher.demo.data');
    Route::get('hocplus/teacher/demo/manage', 'DemoController@manage')->name('hocplus.teacher.demo.manage');
    Route::get('hocplus/teacher/demo/create', 'DemoController@create')->name('hocplus.teacher.demo.create');
    Route::post('hocplus/teacher/demo/add', 'DemoController@add')->name('hocplus.teacher.demo.add');
    Route::get('hocplus/teacher/demo/show', 'DemoController@show')->name('hocplus.teacher.demo.show');
    Route::put('hocplus/teacher/demo/update', 'DemoController@update')->name('hocplus.teacher.demo.update');
    Route::get('hocplus/teacher/demo/delete', 'DemoController@delete')->name('hocplus.teacher.demo.delete');
    Route::get('hocplus/teacher/demo/confirm-delete', 'DemoController@getModalDelete')->name('hocplus.teacher.demo.confirm-delete');
});

Route::any('/teacher', 'TeacherController@index')->name('home.teacher.index');

Route::get('/teacher/detail/{id}', 'TeacherController@detail')->name('home.teacher.detail');