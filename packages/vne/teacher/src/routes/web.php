<?php
$adminPrefix = config('site.admin_prefix');
Route::group(array('prefix' => $adminPrefix), function() {
    Route::group(['middleware' => ['adtech.auth', 'adtech.acl']], function () {
        Route::group(array('prefix' => 'vne/teacher/teacher'), function() {
            Route::get('log', 'TeacherController@log')->name('vne.teacher.teacher.log');
            Route::get('data', 'TeacherController@data')->name('vne.teacher.teacher.data');
            Route::get('manage', 'TeacherController@manage')->name('vne.teacher.teacher.manage')->where('as','Giáo viên - Danh sách');
            Route::get('create', 'TeacherController@create')->name('vne.teacher.teacher.create');
            Route::post('add', 'TeacherController@add')->name('vne.teacher.teacher.add');
            Route::get('show', 'TeacherController@show')->name('vne.teacher.teacher.show');
            Route::put('update', 'TeacherController@update')->name('vne.teacher.teacher.update');
            Route::get('delete', 'TeacherController@delete')->name('vne.teacher.teacher.delete');
            Route::get('confirm-delete', 'TeacherController@getModalDelete')->name('vne.teacher.teacher.confirm-delete');
        });
    });
});