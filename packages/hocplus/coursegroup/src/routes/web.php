<?php
$prefix = '';
Route::group(array('prefix' => $prefix), function() {
    Route::get('/danh-sach-khoa-hoc', 'CourseGroupController@index')->name('hocplus.course.list');
    Route::get('/khoa-hoc/{course_id?}', 'CourseController@index')->name('hocplus.course.detail');
    Route::get('/get-stream', 'CourseController@getStream')->name('hocplus.course.get.stream');
});