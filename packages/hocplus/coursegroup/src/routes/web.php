<?php
$prefix = '';
Route::group(array('prefix' => $prefix), function() {
    Route::get('/danh-sach-khoa-hoc', 'CourseGroupController@index')->name('hocplus.course-group');
});